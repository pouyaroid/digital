<!DOCTYPE html>
<html lang="fa" direction="rtl">
<head>
    <meta charset="UTF-8">
    <title>پنل مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <style>
   body {
    font-family: "Vazir", sans-serif;
    color: #fff;
    direction: rtl;
    text-align: right;
}
.sidebar, .content, .glass-card {
    direction: rtl;
    text-align: right;
}
input, textarea, select {
    text-align: right;
}

        /* Sidebar شیشه‌ای */
        .sidebar {
            width: 250px;
            position: fixed;
            right: 0;
            top: 0;
            bottom: 0;
            padding: 20px 15px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-radius: 15px 0 0 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.25);
        }

        .sidebar h4 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar hr {
            border-color: rgba(149, 149, 149, 0.3);
        }

        .sidebar a {
            color: #fff;
            display: block;
            padding: 12px 18px;
            margin-bottom: 10px;
            text-decoration: none;
            border-radius: 12px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar a:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(-5px);
        }

        /* Content شیشه‌ای */
        .content {
            margin-right: 270px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            min-height: 100vh;
        }

        /* Scrollbar زیبا */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255,255,255,0.5);
        }
        .glass-card {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border-radius: 20px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        margin-bottom: 20px;
    }

    .glass-input {
        background: rgba(255, 255, 255, 0.05);
        border: none;
        border-radius: 10px;
        padding: 8px 12px;
        color: #fff;
        backdrop-filter: blur(6px);
        width: 100%;
    }

    .glass-input:focus {
        background: rgba(255, 255, 255, 0.15);
        outline: none;
        box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
        color: #fff;
    }

    body {
        background: linear-gradient(135deg, #292e55 0%, #006aff 100%);
        color: #fff;
    }

    table.table thead th {
        background: rgba(255, 255, 255, 0.1);
    }

    table.table tbody tr {
        background: rgba(255, 255, 255, 0.05);
    }

    table.table tbody tr:hover {
        background: rgba(255, 255, 255, 0.15);
    }
    








    
    </style>
</head>
<body>

<div class="sidebar">
    <h4>پنل مدیریت</h4>
    <hr>

    {{-- <a href="{{ route('admin.dashboard') }}">🏠 داشبورد</a> --}}
    <a href="{{ route('admin.cafe-header.edit') }}">📝 ویرایش هدر</a>
    <a href="{{ route('admin.cafe.categories.index') }}">📂 دسته‌بندی‌ها</a>
    <a href="{{ route('admin.cafe.items.index') }}">🍽 آیتم‌های منو</a>
    <a href="{{ route('admin.contact.edit') }}">📞 بخش تماس</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
