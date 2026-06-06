<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'منو ' . ($header->cafe_name ?? 'کافه بدون نام') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/dynamic-style.css">
    <link rel="stylesheet" href="assets/css/style.css" />

    <style>
        /* سبد خرید شناور */
        #floatingCart {
            position: fixed; top: 20px; left: 20px;
            background: #fff; padding: 10px 15px;
            border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            z-index: 1000;
        }
        .increase-btn, .decrease-btn, .add-to-cart-btn {
            cursor: pointer; padding: 5px 10px; border: none; border-radius:5px;
        }
        .increase-btn, .decrease-btn { background: #3498db; color: white; }
        .add-to-cart-btn { background: #27ae60; color:white; margin-top:5px; }
    </style>
</head>
<body>
    {{-- هدر کافه --}}

    @php
        // تنظیمات سفارش (MenuSettings)
        use App\Models\MenuSetting;

        $menuSettings = MenuSetting::first();
        $orderingEnabled = $menuSettings?->ordering_enabled ?? 1;
        $showPrices = $menuSettings?->show_prices ?? 1;
        $showCalories = $menuSettings?->show_calories ?? 1;
    @endphp

    <div class="header-banner">
        <div class="cafe-info">

            @if(!empty($header->logo))
                <div class="cafe-logo">
                    <img src="{{ asset('storage/' . $header->logo) }}" alt="لوگو کافه">
                </div>
            @endif

            <h1 class="cafe-name">{{ $header->cafe_name ?? 'کافه بدون نام' }}</h1>
            <p class="cafe-tagline">{{ $header->cafe_tagline ?? 'توضیحی ثبت نشده است' }}</p>

        </div>

        <div class="header-design">
            <div class="coffee-steam">{{ $header->coffee_emoji ?? '☕' }}</div>
        </div>
    </div>

    {{-- 🛒 سبد خرید فقط اگر فعال باشد --}}
    @if($orderingEnabled)
        <div id="floatingCart">
            <span>🛒 سبد خرید: <strong id="cartCount">0</strong> آیتم</span>
            <button id="checkoutBtn">ثبت نهایی</button>
        </div>
    @endif

    {{-- 📂 دسته‌بندی‌ها --}}
    <nav class="category-nav" id="categoryNav">
        <div class="nav-container">
            <button class="nav-btn active" data-category="all">🍽️ همه محصولات</button>

            @foreach($categories as $cat)
                <button class="nav-btn" data-category="category-{{ $cat->id }}">
                    {{ $cat->icon ?? '📌' }} {{ $cat->name }}
                </button>
            @endforeach
        </div>
    </nav>

    {{-- 🍽️ لیست محصولات --}}
    <main class="menu-container">
        <div class="menu-content"
             style="display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">

            @foreach($items as $item)

            <div class="menu-card"
                 data-category="category-{{ $item->category_id }}"
                 style="width:250px; border-radius:15px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.1); background:rgba(255,255,255,0.1); backdrop-filter:blur(8px); text-align:center; display:flex; flex-direction:column;">

                {{-- 📸 تصویر --}}
                @if($item->image)
                    <img src="{{ asset('storage/' . $item->image) }}"
                         alt="{{ $item->name }}"
                         style="width:100%; height:180px; object-fit:cover;">
                @else
                    <div style="width:100%; height:180px; background:#f5f5f5; display:flex; align-items:center; justify-content:center;">
                        <span>🍽️ بدون تصویر</span>
                    </div>
                @endif

                <div style="padding:15px; display:flex; flex-direction:column; gap:10px; align-items:center;">

                    <h3 style="font-size:22px; margin:0;">
                        {{ $item->name }}
                    </h3>

                    @if($item->tags)
                        <p style="margin:0; font-size:15px; color:#0d00ff;">
                            🏷️ {{ str_replace(',', ' • ', $item->tags) }}
                        </p>
                    @endif

                    @if($item->description)
                        <p style="margin:0; font-size:16px;">
                            {{ $item->description }}
                        </p>
                    @endif

                    {{-- 🔥 کالری (از MenuSettings) --}}
                    @if($showCalories && $item->calories)
                        <p style="margin:0; font-size:14px;">
                            🔥 {{ $item->calories }} کالری
                        </p>
                    @endif

                    {{-- 💰 قیمت (از MenuSettings) --}}
                    @if($showPrices)
                        <div style="display:flex; gap:10px; justify-content:center; align-items:center; flex-wrap:wrap;">

                            @if($item->discount_price)
                                <span style="text-decoration:line-through;">
                                    {{ number_format($item->price) }} تومان
                                </span>

                                <span style="color:#e74c3c; font-weight:bold; font-size:18px;">
                                    {{ number_format($item->discount_price) }} تومان
                                </span>
                            @else
                                <span style="font-weight:bold;">
                                    {{ number_format($item->price) }} تومان
                                </span>
                            @endif

                            @if(!$item->is_available)
                                <span style="background:#e74c3c; color:#fff; padding:2px 6px; border-radius:6px; font-size:12px;">
                                    ❌ ناموجود
                                </span>
                            @endif

                        </div>
                    @endif

                    {{-- 🛒 سفارش فقط اگر فعال باشد --}}
                    @if($orderingEnabled)

                        <div class="qty-box">
                            <button class="increase-btn" data-id="{{ $item->id }}">+</button>
                            <span class="quantity" id="qty-{{ $item->id }}">1</span>
                            <button class="decrease-btn" data-id="{{ $item->id }}">-</button>
                        </div>

                        <button class="add-to-cart-btn"
                            data-id="{{ $item->id }}"
                            data-name="{{ $item->name }}"
                            data-price="{{ $item->discount_price ?? $item->price }}">
                            افزودن به سبد خرید
                        </button>

                    @endif

                </div>
            </div>

            @endforeach
        </div>
    </main>

    {{-- 📞 Footer --}}
    <footer class="cafe-footer">
        <div class="footer-content">
            <div class="contact-info">
                <h3>تماس با ما</h3>
                <p>{{ $contact->address ?? 'آدرس تعریف نشده' }}</p>
                <p>{{ $contact->phone ?? 'شماره تعریف نشده' }}</p>
                <p>همه روزه: {{ $contact->working_hours ?? 'ساعات کاری تعریف نشده' }}</p>
            </div>
        </div>
    </footer>
</body>

    {{-- JS --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cart = {};

            // افزایش تعداد
            document.querySelectorAll('.increase-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const qtyEl = document.getElementById('qty-' + id);
                    qtyEl.innerText = parseInt(qtyEl.innerText) + 1;
                });
            });

            // کاهش تعداد
            document.querySelectorAll('.decrease-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const qtyEl = document.getElementById('qty-' + id);
                    if(parseInt(qtyEl.innerText) > 1) qtyEl.innerText = parseInt(qtyEl.innerText) - 1;
                });
            });

            // افزودن به سبد
            document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const name = btn.dataset.name;
                    const price = parseInt(btn.dataset.price);
                    const qty = parseInt(document.getElementById('qty-' + id).innerText);

                    if(cart[id]) {
                        cart[id].qty += qty;
                    } else {
                        cart[id] = {id, name, price, qty};
                    }

                    updateCartCount();
                    alert(`${qty} عدد از ${name} به سبد خرید اضافه شد`);
                });
            });

            // آپدیت شمارنده سبد
            function updateCartCount() {
                const countEl = document.getElementById('cartCount');
                countEl.innerText = Object.values(cart).reduce((sum, item) => sum + item.qty, 0);
            }

            // ثبت نهایی
            document.getElementById('checkoutBtn').addEventListener('click', () => {
                localStorage.setItem('cart', JSON.stringify(cart));
                window.location.href = '/checkout';
            });

            // فیلتر دسته‌ها
            const categoryButtons = document.querySelectorAll('.nav-btn');
            const menuCards = document.querySelectorAll('.menu-card');

            categoryButtons.forEach(btn => {
                btn.addEventListener('click', () => {
                    categoryButtons.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    const category = btn.dataset.category;

                    menuCards.forEach(card => {
                        card.style.display = (category === 'all' || card.dataset.category === category) ? 'block' : 'none';
                    });
                });
            });
        });
    </script>
</body>
</html>