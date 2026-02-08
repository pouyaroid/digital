<!DOCTYPE html>
<html lang="fa" direction="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: "Vazir", sans-serif;
            color: #fff;
            direction: rtl;
            text-align: right;
            background: linear-gradient(135deg, #292e55 0%, #006aff 100%);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
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
    <a href="{{ route('admin.cafe.categories.index') }}" class="menu-item">📂 دسته‌بندی‌ها</a>
    <a href="{{ route('admin.cafe.items.index') }}" class="menu-item">🍽 آیتم‌های منو</a>
    <a href="{{ route('admin.contact.edit') }}" class="menu-item">📞 بخش تماس</a>
    <a href="{{ route('admin.customers.index') }}" class="menu-item">👥 مشتریان</a>
    <a href="{{ route('admin.settings.index') }}" class="menu-item">⚙️ تنظیمات استایل</a>
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