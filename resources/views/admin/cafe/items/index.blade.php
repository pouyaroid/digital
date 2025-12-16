@extends('admin.layouts.app')

@section('content')

<h3 class="mb-4 text-center">مدیریت آیتم‌های منو</h3>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- فرم افزودن آیتم --}}
<form method="POST" enctype="multipart/form-data" class="card p-4 mb-4 glass-card">
    @csrf
    <div class="row g-3">

        <div class="col-md-4">
            <label>دسته‌بندی</label>
            <select name="category_id" class="form-control glass-input">
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label>نام آیتم</label>
            <input type="text" name="name" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>قیمت</label>
            <input type="number" name="price" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>قیمت با تخفیف</label>
            <input type="number" name="discount_price" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>کالری</label>
            <input type="number" name="calories" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>ترتیب نمایش</label>
            <input type="number" name="order" class="form-control glass-input">
        </div>

        <div class="col-md-12">
            <label>توضیحات</label>
            <textarea name="description" class="form-control glass-input"></textarea>
        </div>

        <div class="col-md-12">
            <label>تگ‌ها (با , جدا کنید)</label>
            <input type="text" name="tags" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label>عکس</label>
            <input type="file" name="image" class="form-control glass-input">
        </div>

        <div class="col-md-4 d-flex align-items-center mt-2">
            <input type="checkbox" name="is_available" value="1" class="me-2">
            <label>موجود؟</label>
        </div>

    </div>

    <button class="btn btn-success mt-3">ثبت آیتم</button>
</form>

<hr>

{{-- جدول آیتم‌ها --}}
{{-- جدول آیتم‌ها --}}
<div class="glass-card p-3">
    <table class="table table-bordered mb-0 align-middle">
        <thead>
            <tr>
                <th>عکس</th>
                <th>نام</th>
                <th>قیمت</th>
                <th>دسته</th>
                <th width="180">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="/storage/{{ $item->image }}" width="60">
                        @endif
                    </td>

                    <td>{{ $item->name }}</td>

                    <td>{{ number_format($item->price) }} تومان</td>

                    <td>{{ $item->category->name }}</td>

                    {{-- ⬇️ فقط این قسمت اصلاح شده --}}
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.cafe.items.edit', $item->id) }}"
                               class="btn btn-warning btn-sm">
                                ویرایش
                            </a>

                            <form action="{{ route('admin.cafe.items.destroy', $item->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('حذف شود؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">
                                    حذف
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
