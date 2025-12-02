@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4">ویرایش هدر</h3>

<form method="POST" action="{{ route('cafe-header.update') }}" class="glass-card p-4">
    @csrf
    @method('PUT')

    <div class="row g-3">

        {{-- نام کافه --}}
        <div class="col-md-6">
            <label>نام کافه</label>
            <input type="text" name="cafe_name" value="{{ $header->cafe_name ?? '' }}" class="form-control glass-input">
        </div>

        {{-- توضیح کوتاه --}}
        <div class="col-md-6">
            <label>توضیح کوتاه</label>
            <input type="text" name="cafe_tagline" value="{{ $header->cafe_tagline ?? '' }}" class="form-control glass-input">
        </div>

        {{-- ایموجی --}}
        <div class="col-md-6 position-relative">
            <label>ایموجی قهوه / غذا</label>

            <input
                type="text"
                name="coffee_emoji"
                id="emojiInput"
                value="{{ $header->coffee_emoji ?? '' }}"
                class="form-control glass-input"
                readonly
                style="cursor: pointer;"
            >

            {{-- پنل ایموجی --}}
            <div id="emojiPicker" class="emoji-picker">
                @php
                    $emojis = [
                        '🍔','🍟','🌭','🍕','🥪','🥙','🌮','🌯','🥗','🥘','🍝','🥩','🍗','🍖','🍤','🍱','🍣','🍛','🍜',
                        '🍚','🍙','🍘','🥫','🧆','🧇','🥞','🍳','🥚',
                        '🍦','🍧','🍨','🍩','🍪','🎂','🍰','🧁','🥧','🍫','🍬','🍭','🍮','🍯',
                        '🍎','🍏','🍐','🍊','🍋','🍌','🍉','🍇','🍓','🫐','🥝','🍒','🍍',
                        '🥐','🥖','🫓','🥯','🍞',
                        '☕','🍵','🍺','🍻','🥂','🍷','🍸','🍹','🧉','🧃','🥤','🧋','🥛','🍶',
                        '❤️','🧡','💛','💚','💙','💜','🖤','🤍','🤎','💖','💗','💓','💞','💕','💘',
                        '✨','🔥','🌿','🤎','💛'
                    ];
                @endphp

                <div style="display:flex; flex-wrap:wrap; gap:10px;">
                    @foreach($emojis as $emoji)
                        <span class="emoji-item">{{ $emoji }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary mt-3">ذخیره</button>
</form>

{{-- فرم حذف --}}
@if($header)
<form method="POST" action="{{ route('cafe-header.destroy') }}" class="mt-3 glass-card p-3">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">حذف هدر</button>
</form>
@endif

{{-- استایل شیشه‌ای --}}
<style>


    .emoji-item {
        font-size: 26px;
        cursor: pointer;
    }
</style>

{{-- جاوااسکریپت --}}
<script>
    const emojiInput = document.getElementById("emojiInput");
    const emojiPicker = document.getElementById("emojiPicker");

    // باز/بسته شدن پنل
    emojiInput.addEventListener("click", () => {
        emojiPicker.style.display =
            emojiPicker.style.display === "none" ? "block" : "none";
    });

    // انتخاب ایموجی
    document.querySelectorAll(".emoji-item").forEach(item => {
        item.addEventListener("click", () => {
            emojiInput.value = item.textContent.trim();
            emojiPicker.style.display = "none";
        });
    });

    // بستن هنگام کلیک خارج
    document.addEventListener("click", e => {
        if (!emojiPicker.contains(e.target) && !emojiInput.contains(e.target)) {
            emojiPicker.style.display = "none";
        }
    });
</script>

@endsection
