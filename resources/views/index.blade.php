<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ 'منو ' . ($header->cafe_name ?? 'کافه بدون نام') }}</title>

    {{-- <link rel="stylesheet" href="/dynamic-style.css"> --}}
    {{-- <link rel="stylesheet" href="assets/css/style.css" /> --}}
    <link rel="stylesheet" href="/dynamic-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
       
    </style>
</head>
<body>

    @php
        use App\Models\MenuSetting;
        $menuSettings       = MenuSetting::first();
        $orderingEnabled    = $menuSettings?->ordering_enabled ?? 1;
        $showPrices         = $menuSettings?->show_prices ?? 1;
        $showCalories       = $menuSettings?->show_calories ?? 1;
        $isCustomerLoggedIn = auth()->guard('customer')->check();
    @endphp

    {{-- ───── HERO ───── --}}
    <header class="hero">
        <div class="hero-glass">

            <div class="hero-logo-ring">
                @if(!empty($header->logo))
                    <img src="{{ asset('storage/' . $header->logo) }}" alt="لوگو">
                @else
                    <div class="hero-logo-placeholder">{{ $header->coffee_emoji ?? '☕' }}</div>
                @endif
            </div>

            <div class="hero-info">
                <h1 class="hero-name">{{ $header->cafe_name ?? 'کافه بدون نام' }}</h1>
                <p class="hero-tagline">{{ $header->cafe_tagline ?? 'توضیحی ثبت نشده است' }}</p>
                <div class="hero-pills">
                    <span class="hero-pill pill-open">الان باز است</span>
                    <span class="hero-pill pill-info">📍 {{ $contact->address ?? 'آدرس ثبت نشده' }}</span>
                </div>
            </div>

        </div>
    </header>

    {{-- ───── CATEGORY NAV ───── --}}
    <nav class="cat-nav" id="categoryNav">
        <div class="cat-nav-glass">
            <button class="nav-btn active" data-category="all">🍽️ همه</button>
            @foreach($categories as $cat)
                <button class="nav-btn" data-category="category-{{ $cat->id }}">
                    {{ $cat->icon ?? '📌' }} {{ $cat->name }}
                </button>
            @endforeach
        </div>
    </nav>

    {{-- ───── SEARCH ───── --}}
    <div class="search-wrap">
        <div class="search-glass">
            <span class="search-icon">🔍</span>
            <input
                id="searchInput"
                class="search-input"
                type="text"
                placeholder="جستجو در منو…"
                autocomplete="off"
            >
        </div>
    </div>

    {{-- ───── TOAST ───── --}}
    <div id="toast">
        <div class="toast-dot"></div>
        <span id="toastMsg"></span>
    </div>

    {{-- ───── FLOATING CART ───── --}}
    @if($orderingEnabled)
    <div id="floatingCart">
        <div class="fcart-inner">
            <div class="fcart-bubble" id="cartBubble">0</div>
            <span class="fcart-text">سبد خرید شما</span>
            <span class="fcart-total" id="cartTotal"></span>
            <button id="checkoutBtn" data-is-logged-in="{{ $isCustomerLoggedIn ? 'true' : 'false' }}">
                @if($isCustomerLoggedIn) ثبت سفارش @else ورود @endif
            </button>
        </div>
    </div>
    @endif

    {{-- ───── MENU GRID ───── --}}
    <main class="menu-wrap">
        <div class="menu-grid" id="menuGrid">

            @foreach($items as $index => $item)

            @php
                $hasDisc   = !empty($item->discount_price);
                $finalPrice= $hasDisc ? $item->discount_price : $item->price;
                $discPct   = $hasDisc ? round((($item->price - $item->discount_price) / $item->price) * 100) : 0;
                $avail     = (bool)$item->is_available;
            @endphp

            <div
                class="menu-card{{ !$avail ? ' unavailable' : '' }}"
                data-category="category-{{ $item->category_id }}"
                data-name="{{ mb_strtolower($item->name) }}"
                style="animation-delay: {{ ($index % 12) * 0.055 }}s"
            >
                {{-- Image --}}
                <div class="card-img-wrap">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" loading="lazy">
                    @else
                        <div class="card-img-placeholder">🍽️</div>
                    @endif

                    @if($hasDisc && $discPct > 0)
                        <span class="badge-discount">٪{{ $discPct }} تخفیف</span>
                    @endif

                    @if(!$avail)
                        <div class="badge-unavail"><span>ناموجود</span></div>
                    @endif
                </div>

                {{-- Body --}}
                <div class="card-body">
                    <h2 class="card-name">{{ $item->name }}</h2>

                    @if($item->description)
                        <p class="card-desc">{{ $item->description }}</p>
                    @endif

                    @if($item->tags)
                        <div class="card-tags">
                            @foreach(explode(',', $item->tags) as $tag)
                                <span class="ctag">{{ trim($tag) }}</span>
                            @endforeach
                        </div>
                    @endif

                    @if($showCalories && $item->calories)
                        <span class="card-cal">🔥 {{ $item->calories }} کالری</span>
                    @endif
                </div>

                {{-- Footer --}}
                <div class="card-footer">

                    @if($showPrices)
                        <div class="price-col">
                            @if($hasDisc)
                                <span class="price-old">{{ number_format($item->price) }} تومان</span>
                                <span class="price-new">{{ number_format($item->discount_price) }}<small>تومان</small></span>
                            @else
                                <span class="price-new">{{ number_format($item->price) }}<small>تومان</small></span>
                            @endif
                        </div>
                    @else
                        <div></div>
                    @endif

                    @if($orderingEnabled && $avail)
                        <div class="order-controls">
                            <div class="qty-wrap">
                                <button class="qty-btn decrease-btn" data-id="{{ $item->id }}">−</button>
                                <span class="qty-num" id="qty-{{ $item->id }}">1</span>
                                <button class="qty-btn increase-btn" data-id="{{ $item->id }}">+</button>
                            </div>
                            <button
                                class="add-btn"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-price="{{ $finalPrice }}"
                            >افزودن</button>
                        </div>
                    @endif

                </div>
            </div>

            @endforeach

        </div>

        <div class="empty-state" id="emptyState">
            <div class="empty-icon">🔍</div>
            <p class="empty-text">موردی پیدا نشد</p>
        </div>
    </main>

    {{-- ───── FOOTER ───── --}}
    <footer>
        <div class="footer-inner">
            <div class="footer-brand">{{ $header->cafe_name ?? 'کافه' }} <span>•</span></div>
            <div class="footer-rows">
                <div class="footer-row">
                    <span class="footer-row-icon">📍</span>
                    <span>{{ $contact->address ?? 'آدرس تعریف نشده' }}</span>
                </div>
                <div class="footer-row">
                    <span class="footer-row-icon">📞</span>
                    <span>{{ $contact->phone ?? 'شماره تعریف نشده' }}</span>
                </div>
                <div class="footer-row">
                    <span class="footer-row-icon">🕐</span>
                    <span>{{ $contact->working_hours ?? 'ساعات کاری تعریف نشده' }}</span>
                </div>
            </div>
            <hr class="footer-sep">
            <p class="footer-copy">طراحی شده با ❤️</p>
        </div>
    </footer>

    {{-- ───── JS ───── --}}
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        let cart = {};
        const floatCart   = document.getElementById('floatingCart');
        const cartBubble  = document.getElementById('cartBubble');
        const cartTotalEl = document.getElementById('cartTotal');
        const toastEl     = document.getElementById('toast');
        const toastMsg    = document.getElementById('toastMsg');
        let toastTimer;

        function toFarsiNum(n) {
            return String(n).replace(/\d/g, d => '۰۱۲۳۴۵۶۷۸۹'[d]);
        }

        function showToast(msg) {
            clearTimeout(toastTimer);
            toastMsg.textContent = msg;
            toastEl.classList.add('show');
            toastTimer = setTimeout(() => toastEl.classList.remove('show'), 2600);
        }

        function updateCart() {
            const count = Object.values(cart).reduce((s, i) => s + i.qty, 0);
            const total = Object.values(cart).reduce((s, i) => s + i.qty * i.price, 0);
            if (cartBubble)  cartBubble.textContent  = toFarsiNum(count);
            if (cartTotalEl) cartTotalEl.textContent = count > 0 ? (new Intl.NumberFormat('fa-IR').format(total) + ' تومان') : '';
            if (floatCart) {
                count > 0 ? floatCart.classList.add('show') : floatCart.classList.remove('show');
            }
        }

        document.querySelectorAll('.increase-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const el = document.getElementById('qty-' + btn.dataset.id);
                el.textContent = toFarsiNum(parseInt(el.textContent.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d))) + 1);
            });
        });

        document.querySelectorAll('.decrease-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const el  = document.getElementById('qty-' + btn.dataset.id);
                const cur = parseInt(el.textContent.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d)));
                if (cur > 1) el.textContent = toFarsiNum(cur - 1);
            });
        });

        document.querySelectorAll('.add-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const id    = btn.dataset.id;
                const name  = btn.dataset.name;
                const price = parseInt(btn.dataset.price);
                const qtyEl = document.getElementById('qty-' + id);
                const qty   = parseInt(qtyEl.textContent.replace(/[۰-۹]/g, d => '۰۱۲۳۴۵۶۷۸۹'.indexOf(d)));

                cart[id] ? (cart[id].qty += qty) : (cart[id] = { id, name, price, qty });
                updateCart();

                btn.textContent = '✓ اضافه شد';
                btn.classList.add('added');
                setTimeout(() => {
                    btn.textContent = 'افزودن';
                    btn.classList.remove('added');
                }, 1400);

                showToast(`«${name}» به سبد اضافه شد`);
            });
        });

        const checkoutBtn = document.getElementById('checkoutBtn');
        if (checkoutBtn) {
            checkoutBtn.addEventListener('click', () => {
                localStorage.setItem('cart', JSON.stringify(cart));
                window.location.href = checkoutBtn.dataset.isLoggedIn === 'true' ? '/checkout' : '/login/phone';
            });
        }

        const navBtns    = document.querySelectorAll('.nav-btn');
        const cards      = document.querySelectorAll('.menu-card');
        const emptyState = document.getElementById('emptyState');
        let   activeCat  = 'all';

        function filterCards(cat, query) {
            let vis = 0;
            cards.forEach(c => {
                const mc = cat === 'all' || c.dataset.category === cat;
                const mq = !query || c.dataset.name.includes(query.trim().toLowerCase());
                const show = mc && mq;
                c.style.display = show ? '' : 'none';
                if (show) vis++;
            });
            emptyState.style.display = vis === 0 ? 'block' : 'none';
        }

        navBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                navBtns.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
                activeCat = btn.dataset.category;
                filterCards(activeCat, document.getElementById('searchInput')?.value ?? '');
                document.querySelector('.menu-wrap')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('input', () => filterCards(activeCat, searchInput.value));
        }
    });
    </script>
</body>
</html>