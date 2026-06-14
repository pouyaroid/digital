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