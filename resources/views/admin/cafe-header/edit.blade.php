@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4 text-center">ویرایش هدر</h3>


<form method="POST" action="{{ route('admin.cafe-header.update') }}" class="glass-card p-4" enctype="multipart/form-data">
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

        {{-- لوگو --}}
        <div class="col-md-6">
            <label>لوگوی کافه</label>
            <input type="file" name="logo" class="form-control glass-input">

            @if(!empty($header?->logo))
                <div class="mt-3">
                    <p class="mb-1">لوگوی فعلی:</p>
                    <img src="{{ asset('storage/' . $header->logo) }}"
                         alt="لوگو کافه"
                         style="width:100px; height:100px; object-fit:cover; border-radius:12px; border:2px solid #ddd;">
                </div>
            @endif
        </div>

    </div>

    <button class="btn btn-primary mt-3">ذخیره</button>
</form>

{{-- فرم حذف --}}
@if($header)
<form method="POST" action="{{ route('admin.cafe-header.destroy') }}" class="mt-3 glass-card p-3">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger">حذف هدر</button>
</form>
@endif

{{-- استایل --}}
<style>
    .emoji-item {
        font-size: 26px;
        cursor: pointer;
    }

    #emojiPicker {
        background: white;
        border-radius: 10px;
        padding: 10px;
        position: absolute;
        width: 260px;
        max-height: 200px;
        overflow-y: scroll;
        box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        z-index: 20;
        display: none;
    }
</style>

{{-- جاوااسکریپت --}}
<script>
    const emojiInput = document.getElementById("emojiInput");
    const emojiPicker = document.getElementById("emojiPicker");

    emojiInput.addEventListener("click", () => {
        emojiPicker.style.display =
            emojiPicker.style.display === "none" ? "block" : "none";
    });

    document.querySelectorAll(".emoji-item").forEach(item => {
        item.addEventListener("click", () => {
            emojiInput.value = item.textContent.trim();
            emojiPicker.style.display = "none";
        });
    });

    document.addEventListener("click", e => {
        if (!emojiPicker.contains(e.target) && !emojiInput.contains(e.target)) {
            emojiPicker.style.display = "none";
        }
    });
</script>

@endsection
