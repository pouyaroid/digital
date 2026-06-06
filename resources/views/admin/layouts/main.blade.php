<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title', 'پروژه')</title>

    {{-- Bootstrap RTL --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <style>
        @font-face {
            font-family: 'Vazir';
            src: url("{{ asset('assets/fonts/vazir/Vazir.woff2') }}") format('woff2'),
                 url("{{ asset('assets/fonts/vazir/Vazir.woff') }}") format('woff');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Vazir', sans-serif;
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