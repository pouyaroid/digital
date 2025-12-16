@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4 text-center">ویرایش آیتم</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form action="{{ route('admin.cafe.items.update', $item->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="card p-4 glass-card">

    @csrf
    @method('PUT')

    <div class="row g-3">

        <div class="col-md-4">
            <label>دسته‌بندی</label>
            <select name="category_id" class="form-control glass-input">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        @selected($item->category_id == $cat->id)>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>نام آیتم</label>
            <input type="text" name="name"
                   value="{{ $item->name }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>قیمت</label>
            <input type="number" name="price"
                   value="{{ $item->price }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>قیمت با تخفیف</label>
            <input type="number" name="discount_price"
                   value="{{ $item->discount_price }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>کالری</label>
            <input type="number" name="calories"
                   value="{{ $item->calories }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>ترتیب نمایش</label>
            <input type="number" name="order"
                   value="{{ $item->order }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-12">
            <label>توضیحات</label>
            <textarea name="description"
                      class="form-control glass-input">{{ $item->description }}</textarea>
        </div>

        <div class="col-md-12">
            <label>تگ‌ها</label>
            <input type="text" name="tags"
                   value="{{ $item->tags }}"
                   class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>عکس جدید</label>
            <input type="file" name="image" class="form-control glass-input">
        </div>

        @if($item->image)
            <div class="col-md-4">
                <label>عکس فعلی</label><br>
                <img src="/storage/{{ $item->image }}" width="80">
            </div>
        @endif

        <div class="col-md-4 d-flex align-items-center mt-2">
            <input type="checkbox" name="is_available" value="1"
                   @checked($item->is_available)
                   class="me-2">
            <label>موجود؟</label>
        </div>

    </div>

    <button class="btn btn-primary mt-3">ذخیره تغییرات</button>
    <a href="{{ route('admin.cafe.items.index') }}" class="btn btn-secondary mt-3">
        بازگشت
    </a>
</form>

@endsection
