@extends('admin.layouts.main')

@section('title', 'پنل کاربری')

@push('styles')
<style>
    /* --- استایل‌های اختصاصی پنل کاربری (اسنپ فود استایل) --- */
    :root {
        --primary: #ef394e;
        --primary-light: #fff0f1;
        --text-dark: #2c3e50;
        --text-gray: #7e8b99;
        --bg-body: #f7f8fa;
        --bg-card: #ffffff;
        --border: #eff2f7;
        --radius: 16px;
        --shadow: 0 2px 16px rgba(0,0,0,0.04);
        --shadow-hover: 0 8px 24px rgba(0,0,0,0.08);
    }

    /* کانتینر اصلی */
    .profile-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 16px;
    }

    .grid-layout {
        display: grid;
        gap: 24px;
        grid-template-columns: 1fr;
    }

    /* --- ناوبری (موبایل/دسکتاپ) --- */
    .mobile-nav {
        display: flex;
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 8px;
        margin-bottom: 20px;
        scrollbar-width: none;
    }
    .mobile-nav::-webkit-scrollbar { display: none; }

    .nav-item {
        white-space: nowrap;
        padding: 10px 20px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 50px;
        color: var(--text-gray);
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 8px;
        transition: all 0.2s;
    }
    .nav-item.active {
        background: var(--primary);
        color: #fff;
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(239, 57, 78, 0.3);
    }

    /* سایدبار دسکتاپ */
    .sidebar { display: none; }
    .profile-card {
        background: var(--bg-card);
        border-radius: var(--radius);
        padding: 24px;
        text-align: center;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }
    .desktop-menu {
        list-style: none; padding: 0; margin-top: 16px;
        background: #fff; border-radius: var(--radius); overflow: hidden; border: 1px solid var(--border);
    }
    .desktop-menu li a {
        display: flex; align-items: center; padding: 14px 16px;
        color: var(--text-dark); text-decoration: none; border-bottom: 1px solid var(--border);
        transition: 0.2s; font-weight: 500;
    }
    .desktop-menu li a:last-child { border-bottom: none; }
    .desktop-menu li a:hover, .desktop-menu li a.active {
        background: var(--primary-light); color: var(--primary);
    }
    .desktop-menu i { margin-left: 12px; font-size: 1.2rem; }

    /* --- کارت‌های محتوا --- */
    .card {
        background: var(--bg-card);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        padding: 20px;
        margin-bottom: 24px;
    }

    .section-header {
        display: flex; justify-content: space-between; align-items: center;
        margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--border);
    }
    .section-title {
        font-size: 1.1rem; font-weight: 800; color: var(--text-dark); margin: 0;
    }

    /* --- فرم آدرس --- */
    .add-address-form {
        display: flex; flex-direction: column; gap: 12px;
        background: #f9fafc; padding: 16px; border-radius: 12px; border: 1px dashed var(--border); margin-bottom: 24px;
    }
    .form-input {
        width: 100%; padding: 12px 16px; border: 2px solid transparent;
        background: #fff; border-radius: 10px; font-family: inherit; font-size: 0.95rem;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02); transition: 0.2s;
    }
    .form-input:focus { background: #fff; border-color: var(--primary); }
    .btn-submit {
        background: var(--primary); color: #fff; border: none; padding: 12px;
        border-radius: 10px; font-weight: 700; cursor: pointer; font-family: inherit;
        box-shadow: 0 4px 10px rgba(239, 57, 78, 0.2); transition: 0.2s;
    }

    /* --- لیست آدرس‌ها (گرید) --- */
    .address-grid { display: grid; grid-template-columns: 1fr; gap: 16px; }

    .address-card {
        background: #fff; border: 1px solid var(--border); border-radius: 12px;
        padding: 16px; position: relative; border-right: 4px solid transparent; transition: all 0.2s;
    }
    .address-card:hover {
        border-color: var(--primary-light); box-shadow: var(--shadow-hover); transform: translateY(-2px);
        border-right-color: var(--primary);
    }
    .addr-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 8px; }
    .addr-title { font-weight: 700; font-size: 1rem; }
    .addr-text { color: var(--text-gray); font-size: 0.9rem; line-height: 1.7; }

    /* --- جدول سفارشات (ریسپانسیو) --- */
    .table-responsive { width: 100%; overflow-x: auto; border-radius: 12px; border: 1px solid var(--border); }
    table { width: 100%; border-collapse: separate; border-spacing: 0; background: #fff; }
    th { text-align: right; padding: 14px 16px; background: #f8f9fa; color: var(--text-gray); font-weight: 600; font-size: 0.9rem; border-bottom: 2px solid var(--border); }
    td { padding: 16px; border-bottom: 1px solid var(--border); color: var(--text-dark); vertical-align: middle; }
    
    /* بج‌ها */
    .badge { padding: 4px 10px; border-radius: 6px; font-size: 0.75rem; font-weight: 700; }
    /* تنظیم رنگ بج‌ها برای استایل جدید */
    .bg-success { background: #e6f9ec !important; color: #00a83e !important; }
    .bg-warning { background: #fff8e1 !important; color: #ff8f00 !important; }
    .bg-info { background: #e1f5fe !important; color: #0288d1 !important; }
    .bg-primary { background: #edf2f7 !important; color: #4a5568 !important; }
    .bg-danger { background: #fee2e2 !important; color: #dc3545 !important; }

    /* --- ریسپانسیو دسکتاپ --- */
    @media (min-width: 992px) {
        .grid-layout { grid-template-columns: 280px 1fr; align-items: start; }
        .mobile-nav { display: none; }
        .sidebar { display: block; }
        .address-grid { grid-template-columns: 1fr 1fr; }
    }

    /* --- جادوی جدول برای موبایل (تبدیل تیتر به کارت) --- */
    @media (max-width: 768px) {
        table, thead, tbody, th, td, tr { display: block; }
        thead { display: none; }
        tr {
            background: #fff; border-radius: 12px; border: 1px solid var(--border);
            margin-bottom: 16px; padding: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.03);
        }
        td { border: none; padding: 8px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px dashed var(--border); }
        td:last-child { border-bottom: none; }
        /* نمایش برچسب‌ها در موبایل */
        td::before {
            content: attr(data-label); font-weight: 600; color: var(--text-gray); font-size: 0.85rem;
        }
        td:first-child { flex-direction: row; }
        td:first-child::before { order: 2; margin-right: auto; margin-left: 8px; }
    }
</style>
@endpush

@section('content')

<div class="profile-container">
    
    <!-- ناوبری موبایل -->
    <nav class="mobile-nav d-lg-none">
        <a href="#addresses" class="nav-item active" onclick="switchSection(this)">
            <i class="ri-map-pin-line"></i> آدرس‌ها
        </a>
        <a href="#orders" class="nav-item" onclick="switchSection(this)">
            <i class="ri-file-list-3-line"></i> سفارش‌ها
        </a>
    </nav>

    <div class="grid-layout">
        
        {{-- Sidebar (Desktop Only) --}}
        <aside class="sidebar">
            <div class="profile-card">
                <div style="width: 70px; height: 70px; background: linear-gradient(135deg, #ff9966, #ff5e62); border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; color: white; font-size: 28px; font-weight: bold;">
                    {{ mb_substr($customer->name ?? 'م', 0, 1) }}
                </div>
                <h3 style="margin: 0; font-size: 1.2rem;">{{ $customer->name ?? 'کاربر' }}</h3>
                <p style="margin: 5px 0 0; color: var(--text-gray); direction: ltr;">{{ $customer->phone ?? '' }}</p>
            </div>

            <ul class="desktop-menu">
                <li><a href="#addresses" class="active"><i class="ri-map-pin-line"></i> مدیریت آدرس‌ها</a></li>
                <li><a href="#orders"><i class="ri-file-list-3-line"></i> سفارش‌های من</a></li>
            </ul>
        </aside>

        {{-- Main Content --}}
        <main class="content">

            {{-- Addresses --}}
            <section id="addresses">
                <div class="card">
                    <div class="section-header">
                        <h5 class="section-title"><i class="ri-map-pin-add-fill" style="color: var(--primary)"></i> مدیریت آدرس‌ها</h5>
                    </div>

                    {{-- Add Address Form --}}
                    <form id="addressForm" class="add-address-form">
                        <input type="hidden" name="phone" value="{{ $customer->phone }}">
                        <input type="text" name="title" class="form-input" placeholder="عنوان (مثلاً خانه)" required>
                        <input type="text" name="address" class="form-input" placeholder="آدرس کامل را وارد کنید..." required>
                        <button type="submit" class="btn-submit">ثبت آدرس جدید</button>
                    </form>

                    {{-- List (Loaded via AJAX) --}}
                    <div id="addressList" class="address-grid"></div>
                </div>
            </section>

            {{-- Orders --}}
            <section id="orders">
                <div class="card">
                    <div class="section-header">
                        <h5 class="section-title"><i class="ri-shopping-bag-3-fill" style="color: var(--primary)"></i> سفارش‌های من</h5>
                    </div>

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>شماره</th>
                                    <th>مبلغ</th>
                                    <th>وضعیت</th>
                                    <th>وضعیت پرداخت</th>
                                    <th>تاریخ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($customer->orders ?? [] as $order)
                                <tr>
                                    {{-- اضافه کردن data-label برای نمایش صحیح در موبایل --}}
                                    <td data-label="شماره سفارش">#{{ $order->id }}</td>
                                    <td data-label="مبلغ کل">{{ number_format($order->total_price) }} تومان</td>
                                    <td data-label="وضعیت سفارش">
                                        @if($order->status == 'pending')
                                            <span class="badge bg-warning">در انتظار</span>
                                        @elseif($order->status == 'preparing')
                                            <span class="badge bg-info">در حال آماده‌سازی</span>
                                        @else
                                            <span class="badge bg-success">تحویل شده</span>
                                        @endif
                                    </td>
                                    <td data-label="وضعیت پرداخت">
                                        @if($order->payment_method == 'cash')
                                            <span class="badge bg-primary">پرداخت در محل</span>
                                        @elseif(optional($order->payments)->status == 'success')
                                            <span class="badge bg-success">پرداخت شده</span>
                                        @elseif(optional($order->payments)->status == 'pending')
                                            <span class="badge bg-warning">در انتظار پرداخت</span>
                                        @else
                                            <span class="badge bg-danger">ناموفق</span>
                                        @endif
                                    </td>
                                    <td data-label="تاریخ" style="color: var(--text-gray); font-size: 0.85rem;">
                                        {{ \Hekmatinasser\Verta\Verta::instance($order->created_at)->format('Y/m/d H:i') }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" style="text-align:center; padding: 30px; color: var(--text-gray);">
                                        <i class="ri-shopping-basket-line" style="font-size: 40px; opacity: 0.5; display:block; margin-bottom:10px;"></i>
                                        سفارشی ثبت نشده است
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

        </main>
    </div>
</div>

@endsection

@push('scripts')
<script>
// --- منطق افزودن آدرس ---
document.getElementById('addressForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let formData = new FormData(this);

    fetch("{{ route('address.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        loadAddresses();
        // فرم را پاک کن
        this.reset();
    })
    .catch(err => console.error(err));
});

// --- لود کردن آدرس‌ها (با قالب HTML جدید) ---
function loadAddresses() {
    fetch("{{ route('address.index') }}")
    .then(res => res.json())
    .then(data => {
        const container = document.getElementById('addressList');
        container.innerHTML = '';

        if (data.length === 0) {
            container.innerHTML = '<div style="grid-column: 1/-1; text-align:center; color:var(--text-gray);">آدرسی ثبت نشده است.</div>';
            return;
        }

        data.forEach(item => {
            // ساخت HTML کارت جدید
            let html = `
                <div class="address-card">
                    <div class="addr-header">
                        <span class="addr-title">${item.title ?? 'بدون عنوان'}</span>
                    </div>
                    <div class="addr-text">${item.address}</div>
                </div>
            `;
            container.innerHTML += html;
        });
    })
    .catch(err => {
        console.error(err);
    });
}

// --- تغییر تب در موبایل ---
function switchSection(element) {
    // آپدیت کلاس active
    document.querySelectorAll('.mobile-nav .nav-item').forEach(el => el.classList.remove('active'));
    element.classList.add('active');
}

// مقداردهی اولیه
loadAddresses();
</script>
@endpush