<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>منو کافه آریا</title>
    {{-- <link rel="stylesheet" href="style.css"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('assets/style.css') }}"> --}}
    <link rel="stylesheet" href="/dynamic-style.css">

    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="/dynamic-style.css">
  

</head>
<body>
    <div class="header-banner">
        
        <div class="cafe-info">

            {{-- لوگو --}}
            @if(!empty($header->logo))
                <div class="cafe-logo">
                    <img src="{{ asset('storage/' . $header->logo) }}" alt="لوگو کافه">
                </div>
            @endif

            {{-- نام کافه --}}
            <h1 class="cafe-name">
                {{ $header->cafe_name ?? 'کافه بدون نام' }}
            </h1>

            {{-- توضیح کافه --}}
            <p class="cafe-tagline">
                {{ $header->cafe_tagline ?? 'توضیحی ثبت نشده است' }}
            </p>
        </div>

        <div class="header-design">
            <div class="coffee-steam">
                {{ $header->coffee_emoji ?? '☕' }}
            </div>
        </div>
    </div>
    
    

    <nav class="category-nav" id="categoryNav">
        <div class="nav-container">
            {{-- دکمه همه محصولات --}}
            <button class="nav-btn active" data-category="all">
                <span class="nav-icon">🍽️</span>
                همه محصولات
            </button>
    
            {{-- دکمه‌های داینامیک --}}
            @foreach($categories as $cat)
                <button class="nav-btn" data-category="category-{{ $cat->id }}">
                    <span class="nav-icon">{{ $cat->icon ?? '📌' }}</span>
                    {{ $cat->name }}
                </button>
            @endforeach
        </div>
    </nav>
    
    <main class="menu-container">
        <div class="menu-content" id="menuContent" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center;">
    
            @foreach($items as $item)
                <div class="menu-card" data-category="category-{{ $item->category_id }}" 
                     style="width: 250px; border-radius: 15px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.1); background: rgba(255,255,255,0.1); backdrop-filter: blur(8px); text-align:center; display:flex; flex-direction:column;">
                    
                    {{-- تصویر --}}
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}" 
                             style="width:100%; height:180px; object-fit: cover; border-bottom:1px solid rgba(255,255,255,0.2);">
                    @else
                        <div style="width:100%; height:180px; background:#f5f5f5; display:flex; align-items:center; justify-content:center; border-bottom:1px solid rgba(255,255,255,0.2);">
                            <span>🍽️ بدون تصویر</span>
                        </div>
                    @endif
    
                    <div style="padding: 15px; display:flex; flex-direction: column; gap:10px; align-items:center; justify-content:center;">
                        
                        {{-- نام آیتم --}}
                        <h3 style="font-size: 22px; margin:0; font-weight:bold;">{{ $item->name }}</h3>
    
                        {{-- تگ‌ها با ایموجی --}}
                        @if($item->tags)
                            <p style="margin:0; font-size: 15px; color:#0d00ff;">
                                🏷️ {{ str_replace(',', ' • ', $item->tags) }}
                            </p>
                        @endif
    
                        {{-- توضیحات --}}
                        @if($item->description)
                            <p style="margin:0; font-size: 16px; color:#000000;">{{ $item->description }}</p>
                        @endif
    
                        {{-- کالری --}}
                        @if($item->calories)
                            <p style="margin:0; font-size: 14px; color:#000000;">🔥 {{ $item->calories }} کالری</p>
                        @endif
    
                        {{-- قیمت --}}
                        <div style="display:flex; justify-content:center; align-items:center; gap:10px; margin-top:5px; flex-wrap: wrap;">
                            @if($item->discount_price)
                                <span style="text-decoration: line-through; color:#000000;">{{ number_format($item->price) }} تومان</span>
                                <span style="color:#e74c3c; font-weight:bold; font-size:18px;">{{ number_format($item->discount_price) }} تومان</span>
                            @else
                                <span style="font-weight:bold; font-size:16px;">{{ number_format($item->price) }} تومان</span>
                            @endif
    
                            {{-- موجود بودن --}}
                            @if(!$item->is_available)
                                <span style="background:#e74c3c; color:white; padding:2px 6px; border-radius:6px; font-size:12px;">❌ ناموجود</span>
                            @endif
                        </div>
    
                    </div>
                </div>
            @endforeach
    
        </div>
    </main>
    

    <script>
        const categoryButtons = document.querySelectorAll('.nav-btn');
        const menuCards = document.querySelectorAll('.menu-card');
    
        categoryButtons.forEach(btn => {
            btn.addEventListener('click', () => {
                
                // فعال/غیرفعال کردن کلاس active
                categoryButtons.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
    
                const category = btn.dataset.category;
    
                menuCards.forEach(card => {
                    if(category === 'all') {
                        card.style.display = 'block';
                    } else {
                        if(card.dataset.category === category) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    }
                });
            });
        });
    </script>
    
    

    <footer class="cafe-footer">
        <div class="footer-content">
            <div class="contact-info">
                <h3>تماس با ما</h3>
                <p>
                    <svg class="contact-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                    </svg>
                    {{ $contact->address ?? 'آدرس تعریف نشده' }}
                </p>
                <p>
                    <svg class="contact-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                    </svg>
                    {{ $contact->phone ?? 'شماره تعریف نشده' }}
                </p>
                <p>
                    <svg class="contact-icon" width="16" height="16" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    همه روزه: {{ $contact->working_hours ?? 'ساعات کاری تعریف نشده' }}
                </p>
            </div>
    
            <div class="social-links">
             
                <div class="social-icons">
                    @if(!empty($contact->instagram_url))
                    <a href="{{ $contact->instagram_url }}" class="social-link" target="_blank">
                        اینستاگرام: {{ $contact->instagram_label ?? 'Instagram' }}
                    </a>
                    @endif
    
                    @if(!empty($contact->telegram_url))
                    <a href="{{ $contact->telegram_url }}" class="social-link" target="_blank">
                        تلگرام: {{ $contact->telegram_label ?? 'Telegram' }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    
        <div class="footer-bottom">
            <p>
                © {{ date('Y') }} {{ $header->cafe_name ?? 'نام کافه' }} - تمامی حقوق محفوظ است
            </p>
        </div>
        
    </footer>
    
    {{-- <div class="floating-cart" id="floatingCart" style="display: none;">
        <div class="cart-content">
            <div class="cart-header">
                <h3>سفارش شما</h3>
                <button class="close-cart" id="closeCart">×</button>
            </div>
            <div class="cart-items" id="cartItems"></div>
            <div class="cart-total" id="cartTotal">
                <span class="total-label">جمع کل:</span>
                <span class="total-amount">۰ تومان</span>
                <button class="view-total-btn" id="viewTotalBtn">👁️ مشاهده جزئیات</button>
            </div>
            <button class="order-btn">ثبت سفارش</button>
        </div>
    </div>

    <!-- مدال جمع کل -->
    <div class="total-modal" id="totalModal" style="display: none;">
        <div class="modal-overlay" id="modalOverlay"></div>
        <div class="modal-content">
            <div class="modal-header">
                <h2>📊 جزئیات سفارش</h2>
                <button class="modal-close" id="modalClose">×</button>
            </div>
            <div class="modal-body">
                <div class="order-summary" id="orderSummary"></div>
                <div class="total-breakdown" id="totalBreakdown"></div>
            </div>
            <div class="modal-footer">
                <button class="modal-btn secondary" id="modalCancel">انصراف</button>
                <button class="modal-btn primary" id="modalConfirm">تأیید سفارش</button>
            </div>
        </div>
    </div> --}}

    <!-- مدال تأیید سفارش -->
    {{-- <div class="order-success-modal" id="orderSuccessModal" style="display: none;">
        <div class="modal-overlay" id="successModalOverlay"></div>
        <div class="success-modal-content">
            <div class="success-icon">🎉</div>
            <div class="success-header">
                <h2>سفارش شما ثبت شد!</h2>
                <p>سفارش شما با موفقیت ثبت شده و در حال آماده‌سازی است</p>
            </div>
            <div class="order-details" id="orderDetails"></div>
            <div class="success-footer">
                <button class="success-btn" id="successOkBtn">باشه، متوجه شدم</button>
            </div>
        </div>
    </div> --}}

    <script src="{{ asset('assets/script.js') }}"></script>
</body>
</html>
