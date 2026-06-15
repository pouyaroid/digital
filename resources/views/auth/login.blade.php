@extends('admin.layouts.login')

@section('title', 'ورود به حساب کاربری')

@section('content')

<div class="login-wrapper">

    <div class="glass-card">

        <div class="text-center mb-4">

            <div class="logo-circle mb-4">
                <i class="fas fa-coffee"></i>
            </div>

            <h1 class="h2 fw-bold neon-title">
                ورود به حساب کاربری
            </h1>

            <p class="text-muted-custom mb-0">
                به کافه رستوران ما خوش آمدید
            </p>

        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">

                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-1"></i>
                    ایمیل
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email') }}"
                    class="form-control"
                    placeholder="example@email.com"
                    required
                >

                @error('email')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="mb-3">

                <label for="password" class="form-label">
                    <i class="fas fa-lock me-1"></i>
                    رمز عبور
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control"
                    placeholder="••••••••"
                    required
                >

                @error('password')
                    <div class="text-danger small mt-2">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div class="form-check">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        name="remember"
                        id="remember"
                    >

                    <label class="form-check-label" for="remember">
                        مرا به خاطر بسپار
                    </label>

                </div>

                @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                       class="text-info text-decoration-none">
                        فراموشی رمز عبور؟
                    </a>
                @endif

            </div>

            <button type="submit" class="btn btn-neon w-100">

                <i class="fas fa-sign-in-alt me-2"></i>

                ورود به حساب

            </button>

        </form>

        <div class="text-center mt-4">

            <span class="text-muted-custom">
                حساب کاربری ندارید؟
            </span>

            <a href="{{ route('register') }}"
               class="text-info fw-bold text-decoration-none">

                ثبت نام کنید

            </a>

        </div>

    </div>

</div>

<div class="floating-dot dot-1"></div>
<div class="floating-dot dot-2"></div>

@endsection