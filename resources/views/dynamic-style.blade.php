*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

:root {
    --brand: {{ setting('brand_color', '#FF5722') }};
    --brand-soft:    rgba(255,87,34,0.12);
    --brand-glow:    rgba(255,87,34,0.25);
    --accent:        #FF8A65;
    --bg: {{ setting('bg', '#F7F3EE') }};
    --bg2: {{ setting('bg', '#F7F3EE') }};
    --surface: {{ setting('surface_color', '#FFFFFF') }};
    --surface-hover: {{ setting('surface_hover', 'rgba(255,255,255,0.88)') }};
    --surface-solid: #FFFFFF;
    --glass-border: {{ setting('glass_border', 'rgba(255,255,255,0.9)') }};
    --glass-border2: {{ setting('glass_border2', 'rgba(0,0,0,0.06)') }};
    --text-h: {{ setting('text_h', '#1A1208') }};
    --text-b: {{ setting('text_b', '#4A3F34') }};
    --text-m: {{ setting('text_m', '#8C7B6A') }};
    --text-l: {{ setting('text_l', '#B8A898') }};
    --green:         #22C55E;
    --green-soft:    rgba(34,197,94,0.1);
    --red:           #EF4444;
    --red-soft:      rgba(239,68,68,0.1);
    --shadow-sm:     0 2px 8px rgba(0,0,0,0.06);
    --shadow-md:     0 8px 30px rgba(0,0,0,0.1);
    --shadow-lg:     0 20px 60px rgba(0,0,0,0.14);
    --shadow-brand: {{ setting('shadow_brand', '0 8px 24px rgba(255,87,34,0.35)') }};
    --r-sm:  10px;
    --r-md:  16px;
    --r-lg:  22px;
    --r-xl:  30px;
    --r-2xl: 40px;
    --font:  'Vazirmatn', sans-serif;
    --ease:  cubic-bezier(0.4, 0, 0.2, 1);
    --spring: cubic-bezier(0.34, 1.56, 0.64, 1);
    --nav-active-color: {{ setting('nav_active_color', '#000000') }};
}

html { scroll-behavior: smooth; }

body {
    font-family: var(--font);
    background: var(--bg);
    color: var(--text-b);
    min-height: 100vh;
    overflow-x: hidden;
}

/* ══════════════ BG BLOBS ══════════════ */
body::before {
    content: '';
    position: fixed;
    top: -120px; right: -80px;
    width: 520px; height: 520px;
    background: radial-gradient(circle, rgba(255,87,34,0.18) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
}
body::after {
    content: '';
    position: fixed;
    bottom: -100px; left: -60px;
    width: 400px; height: 400px;
    background: radial-gradient(circle, rgba(255,138,101,0.13) 0%, transparent 65%);
    border-radius: 50%;
    pointer-events: none;
    z-index: 0;
}

/* ══════════════ HERO ══════════════ */
.hero {
    position: relative;
    z-index: 1;
    padding: 40px 24px 32px;
    max-width: 1100px;
    margin: 0 auto;
}

.hero-glass {
    background: var(--surface);
    backdrop-filter: blur(24px) saturate(1.6);
    -webkit-backdrop-filter: blur(24px) saturate(1.6);
    border: 1px solid var(--glass-border);
    border-radius: var(--r-2xl);
    box-shadow: var(--shadow-lg), inset 0 1px 0 rgba(255,255,255,0.8);
    padding: 28px 32px;
    display: flex;
    align-items: center;
    gap: 24px;
}

.hero-logo-ring {
    flex-shrink: 0;
    width: 88px; height: 88px;
    border-radius: 50%;
    background: linear-gradient(135deg, #FF7043, #FF5722, #E64A19);
    padding: 3px;
    box-shadow: var(--shadow-brand);
}

.hero-logo-ring img {
    width: 100%; height: 100%;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #fff;
}

.hero-logo-placeholder {
    width: 100%; height: 100%;
    border-radius: 50%;
    background: linear-gradient(135deg, #FFF3E0, #FFE0B2);
    border: 3px solid #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 34px;
}

.hero-info { flex: 1; }

.hero-name {
    font-size: clamp(24px, 5vw, 32px);
    font-weight: 900;
    color: var(--text-h);
    letter-spacing: -0.8px;
    line-height: 1.1;
}

.hero-tagline {
    font-size: 14px;
    color: var(--text-m);
    margin-top: 6px;
    font-weight: 400;
}

.hero-pills {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 14px;
}

.hero-pill {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 5px 13px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 600;
}

.pill-open {
    background: var(--green-soft);
    color: #15803D;
    border: 1px solid rgba(34,197,94,0.25);
}

.pill-open::before {
    content: '';
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--green);
    animation: blink 2s infinite;
}

@keyframes blink {
    0%,100%{ opacity:1; } 50%{ opacity:0.3; }
}

.pill-info {
    background: rgba(255,87,34,0.08);
    color: #B83A15;
    border: 1px solid rgba(255,87,34,0.15);
}

/* ══════════════ STICKY NAV ══════════════ */
.cat-nav {
    position: sticky;
    top: 0;
    z-index: 200;
    padding: 14px 20px;
}

.cat-nav-glass {
    max-width: 1100px;
    margin: 0 auto;
    background: rgba(247,243,238,0.82);
    backdrop-filter: blur(20px) saturate(1.8);
    -webkit-backdrop-filter: blur(20px) saturate(1.8);
    border: 1px solid rgba(255,255,255,0.85);
    border-radius: var(--r-xl);
    box-shadow: var(--shadow-md), inset 0 1px 0 rgba(255,255,255,0.9);
    display: flex;
    align-items: center;
    gap: 6px;
    padding: 6px 8px;
    overflow-x: auto;
    scrollbar-width: none;
}

.cat-nav-glass::-webkit-scrollbar { display: none; }

.nav-btn {
    flex-shrink: 0;
    padding: 8px 18px;
    border-radius: 50px;
    border: none;
    background: transparent;
    color: var(--text-m);
    font-size: 13px;
    font-weight: 600;
    font-family: var(--font);
    cursor: pointer;
    transition: all 0.22s var(--ease);
    white-space: nowrap;
}

.nav-btn:hover {
    background: rgba(255,87,34,0.08);
    color: var(--brand);
}

.nav-btn.active {
    background: var(--brand);
    color: var(--nav-active-color);
    box-shadow: var(--shadow-brand);
    transform: scale(1.03);
}

/* ══════════════ SEARCH ══════════════ */
.search-wrap {
    max-width: 1100px;
    margin: 16px auto 0;
    padding: 0 20px;
    position: relative;
    z-index: 1;
}

.search-glass {
    background: var(--surface);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1.5px solid rgba(255,255,255,0.9);
    border-radius: var(--r-lg);
    box-shadow: var(--shadow-sm), inset 0 1px 0 rgba(255,255,255,0.8);
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 18px;
    transition: border-color 0.2s, box-shadow 0.2s;
}

.search-glass:focus-within {
    border-color: rgba(255,87,34,0.4);
    box-shadow: 0 0 0 4px rgba(255,87,34,0.08), var(--shadow-sm);
}

.search-icon { color: var(--text-l); font-size: 18px; flex-shrink: 0; }

.search-input {
    flex: 1;
    background: none;
    border: none;
    outline: none;
    font-family: var(--font);
    font-size: 14px;
    color: var(--text-h);
}

.search-input::placeholder { color: var(--text-l); }

/* ══════════════ MENU CONTAINER ══════════════ */
.menu-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 24px 20px 140px;
    position: relative;
    z-index: 1;
}

.menu-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(290px, 1fr));
    gap: 18px;
}

/* ══════════════ MENU CARD ══════════════ */
.menu-card {
    background: var(--surface);
    backdrop-filter: blur(20px) saturate(1.5);
    -webkit-backdrop-filter: blur(20px) saturate(1.5);
    border: 1px solid rgba(255,255,255,0.85);
    border-radius: var(--r-xl);
    overflow: hidden;
    box-shadow: var(--shadow-md), inset 0 1px 0 rgba(255,255,255,0.7);
    transition: transform 0.3s var(--spring), box-shadow 0.3s var(--ease), border-color 0.2s;
    display: flex;
    flex-direction: column;
    animation: cardIn 0.45s var(--ease) both;
}

.menu-card:hover {
    transform: translateY(-5px) scale(1.01);
    box-shadow: var(--shadow-lg), inset 0 1px 0 rgba(255,255,255,0.7);
    border-color: rgba(255,87,34,0.25);
}

.menu-card.unavailable { opacity: 0.6; }

@keyframes cardIn {
    from { opacity: 0; transform: translateY(20px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

/* image */
.card-img-wrap {
    position: relative;
    height: 195px;
    overflow: hidden;
    border-radius: var(--r-xl) var(--r-xl) 0 0;
}

.card-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.55s var(--ease);
}

.menu-card:hover .card-img-wrap img { transform: scale(1.07); }

.card-img-placeholder {
    width: 100%; height: 100%;
    background: linear-gradient(135deg, #F5EFE6, #EDE0D0);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 54px;
}

.badge-discount {
    position: absolute;
    top: 12px; left: 12px;
    background: var(--brand);
    color: #fff;
    font-size: 11px;
    font-weight: 800;
    padding: 4px 11px;
    border-radius: 50px;
    box-shadow: 0 3px 10px rgba(255,87,34,0.4);
    letter-spacing: 0.3px;
}

.badge-unavail {
    position: absolute;
    inset: 0;
    background: rgba(255,255,255,0.55);
    backdrop-filter: blur(3px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.badge-unavail span {
    background: var(--red);
    color: #fff;
    font-size: 13px;
    font-weight: 700;
    padding: 8px 22px;
    border-radius: 50px;
    box-shadow: 0 4px 12px rgba(239,68,68,0.35);
}

/* card body */
.card-body {
    padding: 18px 18px 12px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    flex: 1;
}

.card-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--text-h);
    line-height: 1.35;
}

.card-desc {
    font-size: 13px;
    color: var(--text-m);
    line-height: 1.65;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.card-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
}

.ctag {
    font-size: 11px;
    font-weight: 600;
    color: #B83A15;
    background: rgba(255,87,34,0.1);
    border: 1px solid rgba(255,87,34,0.18);
    padding: 3px 9px;
    border-radius: 50px;
}

.card-cal {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: var(--text-l);
    font-weight: 500;
}

/* card footer */
.card-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    padding: 12px 18px 16px;
}

/* price */
.price-col { display: flex; flex-direction: column; gap: 2px; }

.price-old {
    font-size: 11px;
    color: var(--text-l);
    text-decoration: line-through;
}

.price-new {
    font-size: 18px;
    font-weight: 800;
    color: var(--text-h);
    line-height: 1;
}

.price-new small {
    font-size: 11px;
    font-weight: 500;
    color: var(--text-m);
    margin-right: 2px;
}

/* order controls */
.order-controls {
    display: flex;
    align-items: center;
    gap: 8px;
}

.qty-wrap {
    display: flex;
    align-items: center;
    background: rgba(255,255,255,0.7);
    border: 1.5px solid rgba(255,87,34,0.2);
    border-radius: 50px;
    overflow: hidden;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.9);
}

.qty-btn {
    width: 32px; height: 34px;
    border: none;
    background: transparent;
    color: var(--brand);
    font-size: 20px;
    font-weight: 600;
    cursor: pointer;
    font-family: var(--font);
    display: flex; align-items: center; justify-content: center;
    transition: background 0.15s;
}

.qty-btn:hover { background: rgba(255,87,34,0.08); }

.qty-num {
    min-width: 28px;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: var(--text-h);
}

.add-btn {
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 0 20px;
    height: 38px;
    font-size: 13px;
    font-weight: 700;
    font-family: var(--font);
    cursor: pointer;
    box-shadow: 0 4px 14px rgba(255,87,34,0.35);
    transition: transform 0.2s var(--spring), box-shadow 0.2s, background 0.15s;
    white-space: nowrap;
}

.add-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(255,87,34,0.45);
}

.add-btn:active { transform: scale(0.97); }

.add-btn.added {
    background: var(--green);
    box-shadow: 0 4px 14px rgba(34,197,94,0.35);
}

/* ══════════════ FLOATING CART ══════════════ */
#floatingCart {
    position: fixed;
    bottom: 28px;
    left: 50%;
    transform: translateX(-50%) translateY(120px);
    z-index: 900;
    width: min(400px, calc(100vw - 40px));
    background: rgba(26,18,8,0.92);
    backdrop-filter: blur(24px) saturate(1.5);
    -webkit-backdrop-filter: blur(24px) saturate(1.5);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: var(--r-xl);
    box-shadow: 0 12px 48px rgba(0,0,0,0.35), inset 0 1px 0 rgba(255,255,255,0.08);
    opacity: 0;
    pointer-events: none;
    transition: transform 0.45s var(--spring), opacity 0.3s var(--ease);
}

#floatingCart.show {
    transform: translateX(-50%) translateY(0);
    opacity: 1;
    pointer-events: all;
}

.fcart-inner {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 16px;
}

.fcart-bubble {
    background: var(--brand);
    color: #fff;
    font-size: 12px;
    font-weight: 800;
    width: 28px; height: 28px;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 2px 8px rgba(255,87,34,0.5);
    flex-shrink: 0;
}

.fcart-text {
    flex: 1;
    font-size: 14px;
    font-weight: 600;
    color: rgba(255,255,255,0.9);
}

.fcart-total {
    font-size: 13px;
    font-weight: 700;
    color: rgba(255,255,255,0.6);
}

#checkoutBtn {
    background: var(--brand);
    color: #fff;
    border: none;
    border-radius: 50px;
    padding: 9px 20px;
    font-size: 13px;
    font-weight: 700;
    font-family: var(--font);
    cursor: pointer;
    box-shadow: 0 3px 12px rgba(255,87,34,0.4);
    transition: transform 0.2s var(--spring), box-shadow 0.2s;
    white-space: nowrap;
}

#checkoutBtn:hover {
    transform: scale(1.04);
    box-shadow: 0 5px 18px rgba(255,87,34,0.5);
}

/* ══════════════ TOAST ══════════════ */
#toast {
    position: fixed;
    top: 20px;
    right: -320px;
    z-index: 9999;
    background: rgba(255,255,255,0.9);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.95);
    border-radius: var(--r-md);
    padding: 12px 18px;
    box-shadow: var(--shadow-lg);
    display: flex;
    align-items: center;
    gap: 10px;
    max-width: 290px;
    font-size: 13px;
    font-weight: 600;
    color: var(--text-h);
    transition: right 0.4s var(--spring);
}

#toast.show { right: 20px; }

.toast-dot {
    width: 8px; height: 8px;
    border-radius: 50%;
    background: var(--green);
    flex-shrink: 0;
}

/* ══════════════ EMPTY STATE ══════════════ */
.empty-state {
    display: none;
    text-align: center;
    padding: 70px 20px;
}

.empty-icon { font-size: 64px; margin-bottom: 14px; }

.empty-text {
    font-size: 16px;
    color: var(--text-m);
}

/* ══════════════ FOOTER ══════════════ */
footer {
    position: relative;
    z-index: 1;
    background: var(--surface);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-top: 1px solid rgba(255,255,255,0.7);
    padding: 40px 24px 32px;
}

.footer-inner {
    max-width: 1100px;
    margin: 0 auto;
}

.footer-brand {
    font-size: 20px;
    font-weight: 800;
    color: var(--text-h);
    margin-bottom: 18px;
}

.footer-brand span { color: var(--brand); }

.footer-rows { display: flex; flex-direction: column; gap: 11px; }

.footer-row {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    font-size: 13.5px;
    color: var(--text-m);
}

.footer-row-icon {
    font-size: 17px;
    margin-top: 1px;
    flex-shrink: 0;
}

.footer-sep {
    border: none;
    border-top: 1px solid rgba(0,0,0,0.06);
    margin: 24px 0 16px;
}

.footer-copy {
    font-size: 12px;
    color: var(--text-l);
    text-align: center;
}

/* ══════════════ RESPONSIVE ══════════════ */
@media (max-width: 640px) {
    .hero { padding: 20px 14px 18px; }
    .hero-glass { padding: 20px 18px; flex-wrap: wrap; }
    .menu-grid { grid-template-columns: 1fr; }
    .menu-wrap { padding: 16px 14px 120px; }
    .cat-nav { padding: 10px 14px; }
}