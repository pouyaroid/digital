<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>پنل مدیریت کافه</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet">
    <style>
        @font-face {
            font-family: 'Vazirmatn';
            src: url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-Regular.woff2') format('woff2');
            font-weight: normal;
            font-style: normal;
        }

        :root {
            /* Material Design Blue Palette */
            --md-blue-50: #e3f2fd;
            --md-blue-100: #bbdefb;
            --md-blue-200: #90caf9;
            --md-blue-300: #64b5f6;
            --md-blue-400: #42a5f5;
            --md-blue-500: #2196f3;
            --md-blue-600: #1e88e5;
            --md-blue-700: #1976d2;
            --md-blue-800: #1565c0;
            --md-blue-900: #0d47a1;
            
            /* Enhanced Glass Effect */
            --glass-bg: rgba(255, 255, 255, 0.02);
            --glass-border: rgba(255, 255, 255, 0.08);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Vazirmatn', sans-serif;
            background: linear-gradient(135deg, #0a192f 0%, #112240 50%, #0a192f 100%);
            min-height: 100vh;
            color: #e6f1ff;
            overflow-x: hidden;
            position: relative;
        }

        /* Animated background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 20% 50%, rgba(33, 150, 243, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(25, 118, 210, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(66, 165, 245, 0.03) 0%, transparent 50%);
            z-index: -1;
        }

        /* Enhanced Glass Effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--glass-shadow);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            position: relative;
            overflow: hidden;
        }

        .glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .glass:hover::before {
            opacity: 1;
        }

        .glass:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.12);
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 280px;
            height: 100vh;
            background: rgba(13, 71, 161, 0.05);
            backdrop-filter: blur(30px);
            -webkit-backdrop-filter: blur(30px);
            border-left: 1px solid var(--glass-border);
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            z-index: 1000;
            box-shadow: -5px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar-header {
            padding: 2rem;
            text-align: center;
            border-bottom: 1px solid var(--glass-border);
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.05), rgba(21, 101, 192, 0.05));
        }

        .sidebar-header h3 {
            color: var(--md-blue-300);
            font-weight: 700;
            font-size: 1.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-item {
            display: block;
            padding: 1rem 2rem;
            color: #e6f1ff;
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            border: none;
            background: none;
            width: 100%;
            text-align: right;
            position: relative;
            border-radius: 0;
            margin: 0.25rem 0;
        }

        .menu-item::before {
            content: '';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: var(--md-blue-500);
            border-radius: 4px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .menu-item:hover {
            background: rgba(33, 150, 243, 0.08);
            color: var(--md-blue-300);
            border-radius: 12px 0 0 12px;
        }

        .menu-item:hover::before {
            height: 70%;
        }

        .menu-item.active {
            background: rgba(33, 150, 243, 0.12);
            color: var(--md-blue-300);
            border-radius: 12px 0 0 12px;
        }

        .menu-item.active::before {
            height: 70%;
        }

        /* Main content */
        .main-content {
            margin-right: 280px;
            padding: 2rem;
            min-height: 100vh;
        }

        .content-header {
            margin-bottom: 2rem;
        }

        .content-header h1 {
            color: var(--md-blue-300);
            font-weight: 700;
            font-size: 2.5rem;
            letter-spacing: 0.5px;
            position: relative;
            display: inline-block;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }

        .content-header h1::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, var(--md-blue-500), var(--md-blue-300));
            border-radius: 2px;
            box-shadow: 0 2px 8px rgba(33, 150, 243, 0.3);
        }

        /* Material Design Buttons with Glass Effect */
        .md-btn {
            background: rgba(33, 150, 243, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(33, 150, 243, 0.3);
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
            position: relative;
            overflow: hidden;
            text-transform: uppercase;
        }

        .md-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .md-btn:hover::before {
            left: 100%;
        }

        .md-btn:hover {
            background: rgba(33, 150, 243, 0.2);
            border-color: rgba(33, 150, 243, 0.5);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3);
            transform: translateY(-2px);
        }

        .md-btn:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(33, 150, 243, 0.2);
        }

        .md-btn-secondary {
            background: rgba(25, 118, 210, 0.1);
            border-color: rgba(25, 118, 210, 0.3);
            box-shadow: 0 4px 15px rgba(25, 118, 210, 0.2);
        }

        .md-btn-secondary:hover {
            background: rgba(25, 118, 210, 0.2);
            border-color: rgba(25, 118, 210, 0.5);
            box-shadow: 0 6px 20px rgba(25, 118, 210, 0.3);
        }

        /* Form styling */
        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--glass-border);
            color: #e6f1ff;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-weight: 500;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--md-blue-400);
            box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1), 0 4px 15px rgba(33, 150, 243, 0.1);
            color: #e6f1ff;
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(230, 241, 255, 0.4);
        }

        .form-label {
            color: var(--md-blue-300);
            font-weight: 600;
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* Table styling */
        .table {
            color: #e6f1ff;
        }

        .table thead th {
            border-color: var(--glass-border);
            color: var(--md-blue-300);
            font-weight: 600;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background: rgba(33, 150, 243, 0.03);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .table tbody td {
            border-color: var(--glass-border);
            vertical-align: middle;
            padding: 1rem;
        }

        .table tbody tr {
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .table tbody tr:hover {
            background: rgba(33, 150, 243, 0.05);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
        }

        /* Action buttons */
        .action-btn {
            padding: 0.5rem 1rem;
            border-radius: 10px;
            border: none;
            font-size: 0.875rem;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            margin: 0 0.25rem;
            font-weight: 600;
            letter-spacing: 0.25px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .edit-btn {
            background: rgba(33, 150, 243, 0.1);
            color: var(--md-blue-300);
            border: 1px solid rgba(33, 150, 243, 0.3);
            box-shadow: 0 2px 8px rgba(33, 150, 243, 0.2);
        }

        .edit-btn:hover {
            background: rgba(33, 150, 243, 0.2);
            border-color: rgba(33, 150, 243, 0.5);
            box-shadow: 0 4px 12px rgba(33, 150, 243, 0.3);
            transform: translateY(-2px);
        }

        .delete-btn {
            background: rgba(239, 83, 80, 0.1);
            color: #ef5350;
            border: 1px solid rgba(239, 83, 80, 0.3);
            box-shadow: 0 2px 8px rgba(239, 83, 80, 0.2);
        }

        .delete-btn:hover {
            background: rgba(239, 83, 80, 0.2);
            border-color: rgba(239, 83, 80, 0.5);
            box-shadow: 0 4px 12px rgba(239, 83, 80, 0.3);
            transform: translateY(-2px);
        }

        /* Card styling */
        .menu-card {
            background: rgba(255, 255, 255, 0.02);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.4s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: var(--glass-shadow);
            position: relative;
            overflow: hidden;
        }

        .menu-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(33, 150, 243, 0.03), rgba(25, 118, 210, 0.03));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .menu-card:hover::before {
            opacity: 1;
        }

        .menu-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: rgba(255, 255, 255, 0.12);
        }

        .menu-card h4 {
            color: var(--md-blue-300);
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Mobile toggle */
        .mobile-toggle {
            display: none;
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1001;
            background: rgba(33, 150, 243, 0.1);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(33, 150, 243, 0.3);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.2);
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
        }

        .mobile-toggle:hover {
            background: rgba(33, 150, 243, 0.2);
            border-color: rgba(33, 150, 243, 0.5);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(100%);
            }

            .sidebar.active {
                transform: translateX(0);
            }

            .main-content {
                margin-right: 0;
            }

            .mobile-toggle {
                display: block;
            }

            .content-header h1 {
                font-size: 2rem;
            }
        }

        /* Toast notification */
        .toast-container {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1050;
        }

        .custom-toast {
            background: rgba(13, 71, 161, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(33, 150, 243, 0.3);
            color: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }

        .custom-toast .toast-body {
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* Image styling */
        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            object-fit: cover;
            border: 2px solid var(--glass-border);
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .item-image:hover {
            transform: scale(1.05);
            border-color: var(--md-blue-400);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.2);
        }

        /* Price styling */
        .price {
            color: var(--md-blue-300);
            font-weight: 700;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .discount-price {
            color: #ef5350;
            font-weight: 600;
            text-decoration: line-through;
            margin-left: 0.5rem;
        }

        /* Badge styling */
        .badge-available {
            background: rgba(76, 175, 80, 0.2);
            color: #4caf50;
            border: 1px solid rgba(76, 175, 80, 0.3);
        }

        .badge-unavailable {
            background: rgba(244, 67, 54, 0.2);
            color: #f44336;
            border: 1px solid rgba(244, 67, 54, 0.3);
        }

        /* Icon styling */
        .category-icon {
            font-size: 1.5rem;
            color: var(--md-blue-400);
        }

        /* Tags styling */
        .tag {
            display: inline-block;
            background: rgba(33, 150, 243, 0.1);
            color: var(--md-blue-300);
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            margin: 0.25rem;
            border: 1px solid rgba(33, 150, 243, 0.2);
        }

        /* File input styling */
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }

        .file-input-wrapper input[type=file] {
            position: absolute;
            left: -9999px;
        }

        .file-input-label {
            background: rgba(33, 150, 243, 0.1);
            border: 1px solid rgba(33, 150, 243, 0.3);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
            display: inline-block;
            font-weight: 600;
        }

        .file-input-label:hover {
            background: rgba(33, 150, 243, 0.2);
            border-color: rgba(33, 150, 243, 0.5);
        }

        /* Switch styling */
        .form-switch .form-check-input {
            background-color: rgba(33, 150, 243, 0.1);
            border-color: rgba(33, 150, 243, 0.3);
        }

        .form-switch .form-check-input:checked {
            background-color: var(--md-blue-500);
            border-color: var(--md-blue-500);
        }
    </style>
</head>
<body>
    <!-- Mobile Toggle Button -->
    <button class="mobile-toggle" onclick="toggleSidebar()">
        <i class="bi bi-list"></i>
    </button>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="bi bi-cup-hot"></i> مدیریت کافه</h3>
        </div>
        <nav class="sidebar-menu">
            <button class="menu-item active" onclick="showSection('categories')">
                <i class="bi bi-tags"></i> دسته‌بندی‌ها
            </button>
            <button class="menu-item" onclick="showSection('items')">
                <i class="bi bi-basket2"></i> آیتم‌ها
            </button>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <div class="content-header">
            <h1 id="sectionTitle">مدیریت دسته‌بندی‌ها</h1>
        </div>

        <!-- Categories Section -->
        <div id="categoriesSection" class="content-section">
            <div class="menu-card glass">
                <h4><i class="bi bi-plus-circle"></i> افزودن دسته‌بندی جدید</h4>
                <form id="categoryForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">نام دسته‌بندی</label>
                            <input type="text" class="form-control" id="categoryName" placeholder="نام دسته‌بندی را وارد کنید" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">آیکون (Bootstrap Icons)</label>
                            <input type="text" class="form-control" id="categoryIcon" placeholder="مثال: bi bi-cup-hot">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ترتیب نمایش</label>
                            <input type="number" class="form-control" id="categoryOrder" placeholder="ترتیب نمایش را وارد کنید" value="0">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="md-btn">
                                <i class="bi bi-plus-circle"></i> افزودن دسته‌بندی
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="menu-card glass">
                <h4><i class="bi bi-list-ul"></i> لیست دسته‌بندی‌ها</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>آیکون</th>
                                <th>نام</th>
                                <th>ترتیب</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody id="categoryTableBody">
                            <!-- Categories will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Items Section -->
        <div id="itemsSection" class="content-section" style="display: none;">
            <div class="menu-card glass">
                <h4><i class="bi bi-plus-circle"></i> افزودن آیتم جدید</h4>
                <form id="itemForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">دسته‌بندی</label>
                            <select class="form-select" id="itemCategory" required>
                                <option value="">انتخاب کنید</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">نام آیتم</label>
                            <input type="text" class="form-control" id="itemName" placeholder="نام آیتم را وارد کنید" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">قیمت (تومان)</label>
                            <input type="number" class="form-control" id="itemPrice" placeholder="قیمت را وارد کنید" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">قیمت با تخفیف (تومان)</label>
                            <input type="number" class="form-control" id="itemDiscountPrice" placeholder="قیمت با تخفیف را وارد کنید">
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">توضیحات</label>
                            <textarea class="form-control" id="itemDescription" rows="3" placeholder="توضیحات آیتم را وارد کنید"></textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">برچسب‌ها</label>
                            <input type="text" class="form-control" id="itemTags" placeholder="برچسب‌ها را با کاما جدا کنید">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">کالری</label>
                            <input type="number" class="form-control" id="itemCalories" placeholder="مقدار کالری را وارد کنید">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">ترتیب نمایش</label>
                            <input type="number" class="form-control" id="itemOrder" placeholder="ترتیب نمایش را وارد کنید" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">تصویر</label>
                            <div class="file-input-wrapper">
                                <label for="itemImage" class="file-input-label">
                                    <i class="bi bi-upload"></i> انتخاب تصویر
                                </label>
                                <input type="file" id="itemImage" accept="image/*">
                            </div>
                            <small class="text-muted">فرمت‌های مجاز: jpg, png, jpeg</small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">وضعیت</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="itemAvailable" checked>
                                <label class="form-check-label" for="itemAvailable">
                                    موجود است
                                </label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="md-btn md-btn-secondary">
                                <i class="bi bi-plus-circle"></i> افزودن آیتم
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="menu-card glass">
                <h4><i class="bi bi-list-ul"></i> لیست آیتم‌ها</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>تصویر</th>
                                <th>نام</th>
                                <th>دسته‌بندی</th>
                                <th>قیمت</th>
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody id="itemTableBody">
                            <!-- Items will be added here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <!-- Toast Container -->
    <div class="toast-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Data storage
        let categories = JSON.parse(localStorage.getItem('categories')) || [];
        let items = JSON.parse(localStorage.getItem('items')) || [];
        let editingIndex = -1;
        let editingType = '';

        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            renderCategoryTable();
            renderItemTable();
            updateCategoryDropdown();
        });

        // Toggle sidebar
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
        }

        // Show section
        function showSection(section) {
            // Update active menu item
            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });
            event.target.classList.add('active');

            // Show/hide sections
            if (section === 'categories') {
                document.getElementById('categoriesSection').style.display = 'block';
                document.getElementById('itemsSection').style.display = 'none';
                document.getElementById('sectionTitle').textContent = 'مدیریت دسته‌بندی‌ها';
            } else {
                document.getElementById('categoriesSection').style.display = 'none';
                document.getElementById('itemsSection').style.display = 'block';
                document.getElementById('sectionTitle').textContent = 'مدیریت آیتم‌ها';
            }

            // Close sidebar on mobile
            if (window.innerWidth <= 768) {
                document.getElementById('sidebar').classList.remove('active');
            }
        }

        // Category form submit
        document.getElementById('categoryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const category = {
                id: editingIndex === -1 ? Date.now() : categories[editingIndex].id,
                name: document.getElementById('categoryName').value,
                icon: document.getElementById('categoryIcon').value || 'bi bi-tag',
                order: parseInt(document.getElementById('categoryOrder').value) || 0
            };

            if (editingIndex === -1) {
                categories.push(category);
                showToast('دسته‌بندی جدید اضافه شد', 'success');
            } else {
                categories[editingIndex] = category;
                showToast('دسته‌بندی ویرایش شد', 'success');
                editingIndex = -1;
            }

            localStorage.setItem('categories', JSON.stringify(categories));
            renderCategoryTable();
            updateCategoryDropdown();
            this.reset();
        });

        // Item form submit
        document.getElementById('itemForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const item = {
                id: editingIndex === -1 ? Date.now() : items[editingIndex].id,
                category_id: parseInt(document.getElementById('itemCategory').value),
                name: document.getElementById('itemName').value,
                price: parseInt(document.getElementById('itemPrice').value),
                discount_price: document.getElementById('itemDiscountPrice').value ? parseInt(document.getElementById('itemDiscountPrice').value) : null,
                description: document.getElementById('itemDescription').value,
                tags: document.getElementById('itemTags').value,
                image: document.getElementById('itemImage').files[0] ? URL.createObjectURL(document.getElementById('itemImage').files[0]) : `https://picsum.photos/seed/item${Date.now()}/100/100.jpg`,
                calories: document.getElementById('itemCalories').value ? parseInt(document.getElementById('itemCalories').value) : null,
                order: parseInt(document.getElementById('itemOrder').value) || 0,
                is_available: document.getElementById('itemAvailable').checked
            };

            if (editingIndex === -1) {
                items.push(item);
                showToast('آیتم با موفقیت اضافه شد', 'success');
            } else {
                items[editingIndex] = item;
                showToast('آیتم با موفقیت ویرایش شد', 'success');
                editingIndex = -1;
            }

            localStorage.setItem('items', JSON.stringify(items));
            renderItemTable();
            this.reset();
        });

        // Render category table
        function renderCategoryTable() {
            const tbody = document.getElementById('categoryTableBody');
            tbody.innerHTML = '';

            categories.sort((a, b) => a.order - b.order).forEach((category, index) => {
                const row = `
                    <tr>
                        <td><i class="${category.icon} category-icon"></i></td>
                        <td>${category.name}</td>
                        <td>${category.order}</td>
                        <td>
                            <button class="action-btn edit-btn" onclick="editCategory(${index})">
                                <i class="bi bi-pencil"></i> ویرایش
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteCategory(${index})">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Render item table
        function renderItemTable() {
            const tbody = document.getElementById('itemTableBody');
            tbody.innerHTML = '';

            items.sort((a, b) => a.order - b.order).forEach((item, index) => {
                const category = categories.find(c => c.id === item.category_id);
                const categoryName = category ? category.name : 'نامشخص';
                
                const row = `
                    <tr>
                        <td><img src="${item.image}" alt="${item.name}" class="item-image"></td>
                        <td>
                            <div>${item.name}</div>
                            ${item.tags ? `<div>${item.tags.split(',').map(tag => `<span class="tag">${tag.trim()}</span>`).join('')}</div>` : ''}
                        </td>
                        <td>${categoryName}</td>
                        <td>
                            <span class="price">${item.price.toLocaleString()}</span> تومان
                            ${item.discount_price ? `<span class="discount-price">${item.discount_price.toLocaleString()}</span>` : ''}
                        </td>
                        <td>
                            <span class="badge ${item.is_available ? 'badge-available' : 'badge-unavailable'}">
                                ${item.is_available ? 'موجود' : 'ناموجود'}
                            </span>
                        </td>
                        <td>
                            <button class="action-btn edit-btn" onclick="editItem(${index})">
                                <i class="bi bi-pencil"></i> ویرایش
                            </button>
                            <button class="action-btn delete-btn" onclick="deleteItem(${index})">
                                <i class="bi bi-trash"></i> حذف
                            </button>
                        </td>
                    </tr>
                `;
                tbody.innerHTML += row;
            });
        }

        // Update category dropdown
        function updateCategoryDropdown() {
            const select = document.getElementById('itemCategory');
            select.innerHTML = '<option value="">انتخاب کنید</option>';
            
            categories.sort((a, b) => a.order - b.order).forEach(category => {
                const option = `<option value="${category.id}">${category.name}</option>`;
                select.innerHTML += option;
            });
        }

        // Edit category
        function editCategory(index) {
            const category = categories[index];
            document.getElementById('categoryName').value = category.name;
            document.getElementById('categoryIcon').value = category.icon;
            document.getElementById('categoryOrder').value = category.order;
            
            editingIndex = index;
            editingType = 'category';
            
            // Scroll to form
            document.getElementById('categoryForm').scrollIntoView({ behavior: 'smooth' });
        }

        // Edit item
        function editItem(index) {
            const item = items[index];
            document.getElementById('itemCategory').value = item.category_id;
            document.getElementById('itemName').value = item.name;
            document.getElementById('itemPrice').value = item.price;
            document.getElementById('itemDiscountPrice').value = item.discount_price || '';
            document.getElementById('itemDescription').value = item.description;
            document.getElementById('itemTags').value = item.tags;
            document.getElementById('itemCalories').value = item.calories || '';
            document.getElementById('itemOrder').value = item.order;
            document.getElementById('itemAvailable').checked = item.is_available;
            
            editingIndex = index;
            editingType = 'item';
            
            // Scroll to form
            document.getElementById('itemForm').scrollIntoView({ behavior: 'smooth' });
        }

        // Delete category
        function deleteCategory(index) {
            if (confirm('آیا از حذف این دسته‌بندی مطمئن هستید؟')) {
                categories.splice(index, 1);
                localStorage.setItem('categories', JSON.stringify(categories));
                renderCategoryTable();
                updateCategoryDropdown();
                showToast('دسته‌بندی با موفقیت حذف شد', 'danger');
            }
        }

        // Delete item
        function deleteItem(index) {
            if (confirm('آیا از حذف این آیتم مطمئن هستید؟')) {
                items.splice(index, 1);
                localStorage.setItem('items', JSON.stringify(items));
                renderItemTable();
                showToast('آیتم با موفقیت حذف شد', 'danger');
            }
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            const toastContainer = document.querySelector('.toast-container');
            const toastId = 'toast-' + Date.now();
            
            const toastHTML = `
                <div id="${toastId}" class="toast custom-toast" role="alert">
                    <div class="toast-body">
                        <i class="bi bi-${type === 'success' ? 'check-circle-fill' : type === 'danger' ? 'x-circle-fill' : 'info-circle-fill'}"></i>
                        ${message}
                    </div>
                </div>
            `;
            
            toastContainer.insertAdjacentHTML('beforeend', toastHTML);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 3000
            });
            
            toast.show();
            
            toastElement.addEventListener('hidden.bs.toast', () => {
                toastElement.remove();
            });
        }
    </script>
</body>
</html>