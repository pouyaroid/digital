@extends('admin.layouts.main')

@section('title', 'ورود به حساب کاربری')

@push('styles')
<style>
    body{
        background: linear-gradient(135deg,#1a1a2e 0%,#0c0a5b 50%,#0f3460 100%);
        min-height:100vh;
    }

    .login-wrapper{
        min-height:100vh;
        display:flex;
        align-items:center;
        justify-content:center;
        padding:20px;
    }

    .glass-card{
        width:100%;
        max-width:500px;
        background:rgba(255,255,255,.08);
        backdrop-filter:blur(15px);
        border:1px solid rgba(255,255,255,.15);
        border-radius:24px;
        padding:40px;
        box-shadow:0 8px 32px rgba(0,0,0,.25);
    }

    .logo-circle{
        width:90px;
        height:90px;
        margin:auto;
        border-radius:50%;
        display:flex;
        align-items:center;
        justify-content:center;
        border:2px solid #8b7fff;
        box-shadow:0 0 20px rgba(139,127,255,.7);
    }

    .logo-circle i{
        font-size:40px;
        color:#fff;
    }

    .neon-title{
        color:#fff;
        text-shadow:
            0 0 10px rgba(255,255,255,.7),
            0 0 20px rgba(116,116,255,.7);
    }

    .form-control{
        background:rgba(255,255,255,.08);
        border:1px solid rgba(255,255,255,.15);
        color:#fff;
    }

    .form-control:focus{
        background:rgba(255,255,255,.12);
        color:#fff;
        border-color:#6ea8fe;
        box-shadow:0 0 15px rgba(13,110,253,.5);
    }

    .form-control::placeholder{
        color:#adb5bd;
    }

    .form-label,
    .form-check-label{
        color:#dee2e6;
    }

    .btn-neon{
        background:linear-gradient(45deg,#7d73ff,#2f1fd3);
        border:none;
        color:#fff;
        font-weight:700;
        padding:12px;
        transition:.3s;
    }

    .btn-neon:hover{
        transform:translateY(-2px);
        box-shadow:0 0 20px rgba(125,115,255,.8);
        color:#fff;
    }

    .text-muted-custom{
        color:#adb5bd;
    }

    .floating-dot{
        position:fixed;
        border-radius:50%;
        filter:blur(50px);
        z-index:-1;
    }

    .dot-1{
        width:150px;
        height:150px;
        background:#ff00ff;
        top:50px;
        left:50px;
        opacity:.25;
    }

    .dot-2{
        width:220px;
        height:220px;
        background:#0d6efd;
        bottom:50px;
        right:50px;
        opacity:.2;
    }
</style>
@endpush

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