@extends('admin.layouts.app')

@section('content')
<div class="container mt-4">

    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            تنظیمات منوی دیجیتال
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.menu-settings.update') }}">
                @csrf

                {{-- سفارش آنلاین --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="ordering_enabled"
                        {{ $settings->ordering_enabled ? 'checked' : '' }}>
                    <label class="form-check-label">فعال بودن سفارش آنلاین</label>
                </div>

                {{-- قیمت --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="show_prices"
                        {{ $settings->show_prices ? 'checked' : '' }}>
                    <label class="form-check-label">نمایش قیمت‌ها</label>
                </div>

                {{-- کالری --}}
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="show_calories"
                        {{ $settings->show_calories ? 'checked' : '' }}>
                    <label class="form-check-label">نمایش کالری</label>
                </div>

          

                <button class="btn btn-primary">
                    ذخیره تنظیمات
                </button>

            </form>

        </div>
    </div>

</div>
@endsection