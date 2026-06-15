<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', ' ')</title>

  
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url("{{ asset('assets/fonts/vazir/Vazir.woff2') }}") format('woff2'),
                 url("{{ asset('assets/fonts/vazir/Vazir.woff') }}") format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body {
            background: linear-gradient(135deg,#1a1a2e 0%,#0c0a5b 50%,#0f3460 100%);
            min-height:100vh;
            font-family: 'Vazir';
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

    {{-- Custom Styles --}}
    @stack('styles')
 
</head>

<body class="bg-light">

    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Bootstrap JS Bundle (ضروری) --}}
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    {{-- Custom Scripts --}}
    @stack('scripts')

</body>

</html>