<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    @PwaHead
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/all.css') }}">
    <style>
        body {
            font-family: "Vazir", sans-serif;
            color: #c1c1c1;
            direction: rtl;
            text-align: right;
            background: linear-gradient(135deg, #292e55 0%, #006aff 100%);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            direction: rtl !important;
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
            transition: transform 0.3s ease;
            z-index: 1000;
            overflow-y: auto;
        }

        .sidebar.collapsed {
            transform: translateX(100%);
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
            margin-right: 250px;
            padding: 30px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
            min-height: 100vh;
            transition: margin-right 0.3s ease;
        }

        .content.expanded {
            margin-right: 0;
        }

        /* هامبورگر منو برای موبایل */
        .hamburger {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1001;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 8px;
            padding: 10px;
            cursor: pointer;
            display: none;
            backdrop-filter: blur(6px);
        }

        .hamburger i {
            color: white;
            font-size: 20px;
        }

        /* اورلی برای موبایل */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
            backdrop-filter: blur(4px);
        }

        .overlay.show {
            display: block;
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
            padding: 20px;
        }

        .glass-input {
            background: rgba(255, 255, 255, 0.05);
            border: none;
            border-radius: 10px;
            padding: 12px;
            color: #fff;
            backdrop-filter: blur(6px);
            width: 100%;
            font-size: 1rem;
        }

        .glass-input:focus {
            background: rgba(255, 255, 255, 0.15);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255,255,255,0.2);
            color: #fff;
        }

        table.table thead th {
            background: rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }

        table.table tbody tr {
            background: rgba(255, 255, 255, 0.05);
        }

        table.table tbody tr:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        /* Media Queries برای موبایل */
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                border-radius: 0;
                transform: translateX(100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .content {
                margin-right: 0;
                padding: 20px;
            }

            .hamburger {
                display: block;
                right: 20px;
                top: 15px;
            }

            .overlay {
                display: none;
            }

            .overlay.show {
                display: block;
            }
        }

        @media (max-width: 480px) {
            .glass-card {
                padding: 15px;
            }

            .glass-input {
                padding: 10px;
                font-size: 0.9rem;
            }
        }
        theme-builder {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .theme-header {
        margin-bottom: 30px;
        text-align: center;
    }
    .theme-header h2 { margin: 0; color: #333; font-size: 1.5rem; }
    .theme-header p { margin: 5px 0 0; color: #666; font-size: 0.9rem; }

    .builder-grid {
        display: grid;
        grid-template-columns: 1fr 400px; /* دسکتاپ: تنظیمات (اتوماتیک) | پیش‌نمایش (۴۰۰ پیکسل) */
        gap: 30px;
        align-items: start;
    }

    /* --- پنل تنظیمات --- */
    .settings-panel {
        background: #fff;
        padding: 25px;
        border-radius: var(--radius);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .settings-group {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .settings-group:last-child { border-bottom: none; }

    .settings-group h3 {
        font-size: 1.1rem;
        margin-bottom: 15px;
        color: #111;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .field {
        margin-bottom: 20px;
    }
    .field label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #555;
        font-weight: 600;
    }

    .color-row {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f9fafb;
        padding: 5px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        cursor: pointer;
        background: none;
        flex-shrink: 0; /* جلوگیری از کوچک شدن رنگ‌پیکر */
    }
    input[type="color"]::-webkit-color-swatch-wrapper { padding: 0; }
    input[type="color"]::-webkit-color-swatch { border: none; border-radius: 6px; }

    input[type="text"] {
        flex: 1;
        border: none;
        background: transparent;
        font-family: monospace;
        direction: ltr;
        text-align: left;
        font-size: 0.9rem;
        color: #333;
        min-width: 0; /* جلوگیری از overflow در فلکس */
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #a0a0a0;
        border-radius: 10px;
        font-family: monospace;
        font-size: 0.85rem;
        direction: rtl !important;
    }
    select.glass-input {
    color: #000; /* رنگ متن اصلی */
    background-color: rgba(255, 255, 255, 0.8);
}

/* گزینه‌ها داخل dropdown */
select.glass-input option {
    color: #000;
    background-color: #fff;
}

    .save-btn {
        width: 100%;
        padding: 15px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .save-btn:hover { background: #000; }
    .save-btn:disabled { opacity: 0.7; cursor: wait; }

    /* --- پنل پیش‌نمایش --- */
    .preview-panel {
        position: sticky;
        top: 20px;
    }

    .preview-label {
        text-align: center;
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #888;
        background: rgba(255,255,255,0.5);
        padding: 5px;
        border-radius: 20px;
    }

    .preview-card {
        border-radius: var(--radius);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        min-height: 500px; /* ارتفاع دسکتاپ */
        display: flex;
        flex-direction: column;
        transition: background 0.3s ease;
        position: relative;
    }

    .preview-header {
        padding: 25px;
        text-align: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .preview-body {
        padding: 30px;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .pv-heading { margin-bottom: 10px; transition: color 0.3s; font-size: 1.4rem; }
    .pv-text { margin-bottom: 25px; line-height: 1.6; transition: color 0.3s; max-width: 90%; font-size: 0.95rem; }
    .pv-muted { font-size: 0.85rem; margin-top: 15px; transition: color 0.3s; }

    .pv-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
    }

    /* Toast Message */
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #10B981;
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transform: translateY(150%);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 1000;
        font-weight: bold;
        right: 50%;
        transform: translateX(50%) translateY(150%); /* وسط چین کردن در موبایل */
    }
    @media(min-width: 768px) {
        .toast {
            right: 20px;
            transform: translateY(150%); /* حالت عادی دسکتاپ */
        }
    }
    .toast.show { 
        bottom: 30px;
        transform: translateX(50%) translateY(0);
    }
    @media(min-width: 768px) {
        .toast.show {
            transform: translateY(0);
        }
    }

    /* --- ریسپانسیو (اصلاحات اصلی) --- */
    
    /* 1. تبلت و لپ‌تاپ کوچک */
    @media (max-width: 1024px) {
        .builder-grid {
            grid-template-columns: 1fr 320px; /* کاهش عرض پیش‌نمایش */
            gap: 20px;
        }
        .theme-builder {
            padding: 15px;
        }
    }

    /* 2. موبایل */
    @media (max-width: 768px) {
        .builder-grid {
            grid-template-columns: 1fr; /* تک ستون */
            gap: 20px;
        }

        /* پیش‌نمایش بالا قرار می‌گیرد */
        .preview-panel {
            position: static;
            order: -1; /* بالا آوردن */
            margin-bottom: 10px;
        }

        .preview-card {
            min-height: 350px; /* کاهش ارتفاع پیش‌نمایش در موبایل */
            border-radius: 12px;
        }

        .preview-header { padding: 15px; font-size: 1rem; }
        .preview-body { padding: 20px; }
        .pv-heading { font-size: 1.2rem; }
        .pv-btn { padding: 10px 20px; font-size: 0.9rem; }

        /* تنظیمات */
        .settings-panel {
            padding: 20px;
            border-radius: 12px;
        }
        
        .field {
            margin-bottom: 15px;
        }

        .theme-header h2 { font-size: 1.3rem; }
    }
    
    </style>
</head>
<body>

<div class="overlay" id="overlay"></div>

<button class="hamburger" id="hamburger">
    <i class="fas fa-bars"></i>
</button>

<div class="sidebar" id="sidebar">
    <h4>پنل مدیریت</h4>
    <hr>

    <a href="{{ route('admin.dashboard') }}" class="menu-item">📱 QRCode</a>
    <a href="{{ route('admin.orders.index') }}" class="menu-item">📋 مشاهده سفارشات</a>
    <a href="{{ route('admin.cafe-header.edit') }}" class="menu-item">📝 ویرایش هدر</a>
    <a href="{{ route('admin.categories.index') }}" class="menu-item">📂 دسته‌بندی‌ها</a>
    <a href="{{ route('admin.items.index') }}" class="menu-item">🍽 آیتم‌های منو</a>
    <a href="{{ route('admin.contact.edit') }}" class="menu-item">📞 بخش تماس</a>
    <a href="{{ route('admin.customers.index') }}" class="menu-item">👥 مشتریان</a>
    <a href="{{ route('admin.settings.index') }}" class="menu-item">⚙️ تنظیمات استایل</a>
    <a href="{{ route('admin.menu-settings.index') }}" class="menu-item">⚙️ تنظیمات منو</a>
    <a href="{{ route('admin.customers.smsForm') }}" class="menu-item">✉️ ارسال SMS</a>
    <a href="{{ route('home') }}" class="menu-item">👀 مشاهده منو</a>
    
</div>

<div class="content" id="content">
    @yield('content')
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburger = document.getElementById('hamburger');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const overlay = document.getElementById('overlay');
        const menuItems = document.querySelectorAll('.menu-item');

        // تابع باز کردن/بستن منو
        function toggleSidebar() {
            sidebar.classList.toggle('show');
            overlay.classList.toggle('show');
        }

        // رویداد کلیک روی هامبورگر
        hamburger.addEventListener('click', toggleSidebar);

        // رویداد کلیک روی اورلی
        overlay.addEventListener('click', toggleSidebar);

        // رویداد کلیک روی گزینه‌های منو
        menuItems.forEach(item => {
            item.addEventListener('click', function(e) {
                // اگر روی لینک کلیک شد، ابتدا منو را ببند
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
                
                // سپس لینک را اجرا کن
                // لینک به صورت خودکار اجرا میشه
            });
        });

        // بستن منو با اسکرول
        let lastScrollTop = 0;
        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && window.innerWidth <= 768) {
                // در حال اسکرول کردن پایین
                if (sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            }
            lastScrollTop = scrollTop;
        });

        // بستن منو با کلیک خارج از آن
        document.addEventListener('click', function(event) {
            const isClickInsideSidebar = sidebar.contains(event.target);
            const isClickOnHamburger = hamburger.contains(event.target);
            const isClickOnMenuItem = Array.from(menuItems).some(item => item.contains(event.target));
            
            if (!isClickInsideSidebar && !isClickOnHamburger && !isClickOnMenuItem && window.innerWidth <= 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });

        // مدیریت ریسپانسیو
        function handleResize() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        }

        window.addEventListener('resize', handleResize);

        // بستن منو با دکمه back در موبایل
        window.addEventListener('popstate', function() {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            }
        });
    });
</script>

</body>
</html>