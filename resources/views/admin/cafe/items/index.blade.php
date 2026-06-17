@extends('admin.layouts.app')

@section('content')

<div class="container-fluid px-2 px-md-4 py-3">

    <h3 class="mb-4 text-center fs-5 fs-md-3">مدیریت آیتم‌های منو</h3>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
        </div>
    @endif

    {{-- فرم افزودن آیتم --}}
    <form method="POST" enctype="multipart/form-data" class="card p-3 p-md-4 mb-4 glass-card">
        @csrf
        <div class="row g-2 g-md-3">

            <div class="col-12 col-md-6 col-lg-4">
                <label class="form-label small">دسته‌بندی</label>
                <select name="category_id" class="form-control glass-input form-select">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label class="form-label small">نام آیتم</label>
                <input type="text" name="name" class="form-control glass-input">
            </div>

            <div class="col-6 col-md-6 col-lg-4">
                <label class="form-label small">قیمت</label>
                <input type="number" name="price" class="form-control glass-input" inputmode="numeric">
            </div>

            <div class="col-6 col-md-6 col-lg-4">
                <label class="form-label small">قیمت با تخفیف</label>
                <input type="number" name="discount_price" class="form-control glass-input" inputmode="numeric">
            </div>

            <div class="col-6 col-md-6 col-lg-4">
                <label class="form-label small">کالری</label>
                <input type="number" name="calories" class="form-control glass-input" inputmode="numeric">
            </div>

            <div class="col-6 col-md-6 col-lg-4">
                <label class="form-label small">ترتیب نمایش</label>
                <input type="number" name="order" class="form-control glass-input" inputmode="numeric">
            </div>

            <div class="col-12">
                <label class="form-label small">توضیحات</label>
                <textarea name="description" class="form-control glass-input" rows="3"></textarea>
            </div>

            <div class="col-12">
                <label class="form-label small">تگ‌ها (با , جدا کنید)</label>
                <input type="text" name="tags" class="form-control glass-input">
            </div>

            <div class="col-12 col-md-6 col-lg-4">
                <label class="form-label small">عکس</label>
                <input type="file" name="image" class="form-control glass-input">
            </div>

            <div class="col-12 col-md-6 col-lg-4 d-flex align-items-center mt-3 mt-md-4">
                <div class="form-check">
                    <input type="checkbox" name="is_available" value="1" class="form-check-input me-2" id="isAvailable">
                    <label class="form-check-label" for="isAvailable">موجود؟</label>
                </div>
            </div>

        </div>

        <button class="btn btn-success mt-3 w-100 w-md-auto">
            <i class="bi bi-plus-lg"></i> ثبت آیتم
        </button>
    </form>

    <hr class="my-3 my-md-4">

    {{-- جدول آیتم‌ها --}}
    <div class="glass-card p-2 p-md-3">
        {{-- نسخه دسکتاپ: جدول --}}
        <div class="table-responsive d-none d-md-block">
            <table class="table table-bordered table-hover mb-0 align-middle">
                <thead class="table-light">
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
                                    <img src="{{ asset('storage/' . $item->image) }}" 
                                         width="60" height="60" 
                                         class="rounded object-fit-cover" 
                                         alt="{{ $item->name }}">
                                @endif
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ number_format($item->price) }} تومان</td>
                            <td>{{ $item->category->name }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.cafe.items.edit', $item->id) }}"
                                       class="btn btn-warning btn-sm flex-fill text-center">
                                        ویرایش
                                    </a>
                                    <form action="{{ route('admin.cafe.items.destroy', $item->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('حذف شود؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm flex-fill">
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

        {{-- نسخه موبایل: کارت --}}
        <div class="d-md-none">
            @foreach($items as $item)
                <div class="card mb-2 border-0 shadow-sm">
                    <div class="card-body p-2">
                        <div class="d-flex gap-2">
                            @if($item->image)
                                <img src="{{ asset('storage/' . $item->image) }}" 
                                     width="64" height="64" 
                                     class="rounded object-fit-cover flex-shrink-0" 
                                     alt="{{ $item->name }}">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0" 
                                     style="width:64px;height:64px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                            @endif

                            <div class="flex-grow-1 min-w-0">
                                <h6 class="mb-1 text-truncate fw-bold">{{ $item->name }}</h6>
                                <div class="text-muted small">{{ $item->category->name }}</div>
                                <div class="fw-bold text-success small">
                                    {{ number_format($item->price) }} تومان
                                </div>
                            </div>
                        </div>

                        <div class="d-flex gap-2 mt-2">
                            <a href="{{ route('admin.cafe.items.edit', $item->id) }}"
                               class="btn btn-warning btn-sm flex-fill">
                                ویرایش
                            </a>
                            <form action="{{ route('admin.cafe.items.destroy', $item->id) }}"
                                  method="POST"
                                  class="flex-fill"
                                  onsubmit="return confirm('حذف شود؟')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm w-100">حذف</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection