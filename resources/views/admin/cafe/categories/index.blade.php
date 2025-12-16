@extends('admin.layouts.app')

@section('content')
<h3 class="mb-4 text-center">مدیریت دسته‌بندی‌ها</h3>

@if(session('success'))
    <div class="alert alert-success glass-card p-2">{{ session('success') }}</div>
@endif

{{-- فرم افزودن دسته --}}
<form method="POST" class="glass-card p-4 mb-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label>نام دسته‌بندی</label>
            <input type="text" name="name" class="form-control glass-input">
        </div>

        <div class="col-md-4 position-relative">
            <label>آیکن (Emoji)</label>
            <input type="text" id="emojiInput" name="icon" class="form-control glass-input" readonly style="cursor:pointer;">
        </div>

        <div class="col-md-4">
            <label>ترتیب نمایش</label>
            <input type="number" name="order" class="form-control glass-input">
        </div>
    </div>

    <button class="btn btn-primary mt-3">افزودن دسته</button>
</form>

{{-- پنل ایموجی (یکبار در فرم) --}}
@php
    $foodEmojis = [
        '🍔','🍟','🌭','🍕','🥪','🥙','🌮','🌯','🥗','🥘','🍝','🥩','🍗','🍖','🍤','🍱','🍣','🍛','🍜',
        '🍚','🍙','🍘','🥫','🧆','🧇','🥞','🍳','🥚',
        '🍦','🍧','🍨','🍩','🍪','🎂','🍰','🧁','🥧','🍫','🍬','🍭','🍮','🍯',
        '🍎','🍏','🍐','🍊','🍋','🍌','🍉','🍇','🍓','🫐','🥝','🍒','🍍',
        '🥐','🥖','🫓','🥯','🍞',
        '☕','🍵','🍺','🍻','🥂','🍷','🍸','🍹','🧉','🧃','🥤','🧋','🥛','🍶'
    ];
@endphp
<div id="emojiPicker" style="
    display:none;
    position:absolute;
    width:300px;
    background:#fff;
    border:1px solid #ddd;
    padding:10px;
    border-radius:10px;
    box-shadow:0 4px 20px rgba(0,0,0,0.2);
    max-height:250px;
    overflow-y:auto;
    z-index:9999;
">
    <div style="display:flex; flex-wrap:wrap; gap:8px;">
        @foreach($foodEmojis as $emoji)
            <span class="emoji-item" style="font-size:24px; cursor:pointer;">{{ $emoji }}</span>
        @endforeach
    </div>
</div>

{{-- جدول دسته‌ها --}}
<div class="glass-card p-4">
    <table class="table table-bordered table-striped text-white mb-0">
        <thead>
            <tr>
                <th>آیکن</th>
                <th>نام</th>
                <th>ترتیب</th>
                <th width="120">عملیات</th> {{-- ستون عملیات --}}
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                <tr>
                    <td style="font-size:24px; text-align:center;">{{ $cat->icon }}</td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->order }}</td>
                    <td>
                        <div class="d-flex gap-2">
                            {{-- حذف --}}
                            <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">حذف</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const emojiInput = document.getElementById('emojiInput');
    const emojiPicker = document.getElementById('emojiPicker');

    emojiInput.addEventListener('click', () => {
        const rect = emojiInput.getBoundingClientRect();
        emojiPicker.style.top = (rect.bottom + window.scrollY + 5) + 'px';
        emojiPicker.style.left = (rect.left + window.scrollX) + 'px';
        emojiPicker.style.display = emojiPicker.style.display === 'block' ? 'none' : 'block';
    });

    document.querySelectorAll('.emoji-item').forEach(item => {
        item.addEventListener('click', () => {
            emojiInput.value = item.textContent;
            emojiPicker.style.display = 'none';
        });
    });

    document.addEventListener('click', e => {
        if (!emojiPicker.contains(e.target) && e.target !== emojiInput) {
            emojiPicker.style.display = 'none';
        }
    });
</script>
@endsection
