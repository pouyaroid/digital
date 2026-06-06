@extends('admin.layouts.main')

@section('title', 'ورود با شماره موبایل')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col-12 col-md-5 col-lg-4">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">ورود / ثبت‌نام</h4>
                        <p class="text-muted small mb-0">
                            شماره موبایل خود را وارد کنید تا کد تایید ارسال شود
                        </p>
                    </div>

                    {{-- Form --}}
                    <form method="POST" action="{{ route('phone.send') }}">
                        @csrf

                        {{-- Phone Input --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">شماره موبایل</label>

                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-light border-0">
                                    📱
                                </span>

                                <input
                                    type="text"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    class="form-control border-0 bg-light shadow-none"
                                    placeholder="09123456789"
                                    dir="ltr"
                                >
                            </div>

                            @error('phone')
                                <small class="text-danger mt-2 d-block">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit"
                                class="btn btn-success w-100 btn-lg rounded-3 fw-bold shadow-sm mt-3"
                                style="background: linear-gradient(135deg, #00c853, #64dd17); border: none;">
                            ارسال کد تایید
                        </button>

                        {{-- Footer --}}
                        <p class="text-center text-muted small mt-3 mb-0">
                            ورود شما به معنای پذیرش
                            <a href="#" class="text-decoration-none">قوانین و مقررات</a>
                            است
                        </p>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection