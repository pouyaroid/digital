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

  
</style>

@endsection
