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
                <input type="hidden" name="ordering_enabled" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="ordering_enabled" value="1"
                        {{ $settings->ordering_enabled ? 'checked' : '' }}>
                    <label class="form-check-label">فعال بودن سفارش آنلاین</label>
                </div>

                {{-- نمایش قیمت --}}
                <input type="hidden" name="show_prices" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="show_prices" value="1"
                        {{ $settings->show_prices ? 'checked' : '' }}>
                    <label class="form-check-label">نمایش قیمت‌ها</label>
                </div>

                {{-- نمایش کالری --}}
                <input type="hidden" name="show_calories" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="show_calories" value="1"
                        {{ $settings->show_calories ? 'checked' : '' }}>
                    <label class="form-check-label">نمایش کالری</label>
                </div>

                <hr>

                {{-- پرداخت آنلاین --}}
                <input type="hidden" name="online_payment_enabled" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="online_payment_enabled" value="1"
                        {{ $settings->online_payment_enabled ? 'checked' : '' }}>
                    <label class="form-check-label">فعال بودن پرداخت آنلاین</label>
                </div>

                {{-- پرداخت نقدی --}}
                <input type="hidden" name="cash_payment_enabled" value="0">
                <div class="form-check form-switch mb-3">
                    <input class="form-check-input" type="checkbox"
                        name="cash_payment_enabled" value="1"
                        {{ $settings->cash_payment_enabled ? 'checked' : '' }}>
                    <label class="form-check-label">فعال بودن پرداخت در محل</label>
                </div>

                <button class="btn btn-primary">
                    ذخیره تنظیمات
                </button>

            </form>

        </div>
    </div>

</div>
@endsection