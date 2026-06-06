@extends('admin.layouts.main')

@section('title', 'تایید کد')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">

        <div class="col-12 col-md-5 col-lg-4">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-md-5">

                    {{-- Header --}}
                    <div class="text-center mb-4">
                        <h4 class="fw-bold mb-1">تایید شماره موبایل</h4>
                        <p class="text-muted small mb-0">
                            کد ارسال شده به {{ $phone }} را وارد کنید
                        </p>
                    </div>

                    {{-- Form --}}
                    <form method="POST" action="{{ route('otp.verify') }}">
                        @csrf

                        {{-- Hidden Phone --}}
                        <input type="hidden" name="phone" value="{{ $phone }}">

                        {{-- OTP Input --}}
                        <div class="mb-3">
                            <label class="form-label fw-semibold">کد تایید</label>

                            <input
                                type="text"
                                name="code"
                                class="form-control form-control-lg text-center letter-spacing bg-light border-0 shadow-none"
                                placeholder="------"
                                maxlength="6"
                                dir="ltr"
                                style="letter-spacing: 8px; font-size: 20px;"
                            >

                            @error('code')
                                <small class="text-danger d-block mt-2">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        {{-- Submit --}}
                        <button type="submit"
                                class="btn btn-success w-100 btn-lg rounded-3 fw-bold shadow-sm"
                                style="background: linear-gradient(135deg, #00c853, #64dd17); border: none;">
                            ورود
                        </button>

                        {{-- Back --}}
                        <div class="text-center mt-3">
                            <a href="{{ url()->previous() }}" class="text-decoration-none small">
                                تغییر شماره موبایل
                            </a>
                        </div>

                    </form>

                </div>
            </div>

        </div>

    </div>
</div>

@endsection