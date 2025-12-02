class CafeMenu {
    constructor() {
        this.menuItems = [
            // نوشیدنی گرم
            {
                id: 1,
                name: 'اسپرسو کلاسیک',
                category: 'hot-drinks',
                price: 35000,
                description: 'طعم اصیل قهوه ایتالیایی با عطر بی‌نظیر دانه‌های آربیکا',
                image: 'images/espresso.jpg',
                available: true
            },
            {
                id: 2,
                name: 'کاپوچینو',
                category: 'hot-drinks',
                price: 45000,
                description: 'ترکیب فوق‌العاده اسپرسو با شیر بخارپز شده و فوم نرم',
                image: 'images/cappuccino.jpg',
                available: true
            },
            {
                id: 3,
                name: 'لته هنری',
                category: 'hot-drinks',
                price: 50000,
                description: 'لته زیبا با طرح‌های هنری روی فوم شیر',
                image: 'images/latte-art.jpg',
                available: true
            },
            {
                id: 4,
                name: 'آمریکانو',
                category: 'hot-drinks',
                price: 40000,
                description: 'اسپرسو رقیق شده با آب داغ برای عاشقان قهوه سبک',
                image: 'images/americano.jpg',
                available: true
            },
            {
                id: 5,
                name: 'موکا شکلاتی',
                category: 'hot-drinks',
                price: 55000,
                description: 'ترکیب لذیذ قهوه و شکلات با خامه فرم زده',
                image: 'images/mocha.jpg',
                available: true
            },
            {
                id: 6,
                name: 'هات چاکلت',
                category: 'hot-drinks',
                price: 48000,
                description: 'شکلات داغ غنی با کرم شانتی و پودر کاکائو',
                image: 'images/hot-chocolate.jpg',
                available: true
            },
            
            // نوشیدنی سرد
            {
                id: 7,
                name: 'آیس لته',
                category: 'cold-drinks',
                price: 50000,
                description: 'لته سرد با یخ، مناسب روزهای گرم تابستان',
                image: 'images/ice-latte.jpg',
                available: true
            },
            {
                id: 8,
                name: 'فراپوچینو کارامل',
                category: 'cold-drinks',
                price: 60000,
                description: 'نوشیدنی خنک و شیرین با طعم کارامل',
                image: 'images/frappuccino.jpg',
                available: true
            },
            {
                id: 9,
                name: 'آیس آمریکانو',
                category: 'cold-drinks',
                price: 45000,
                description: 'آمریکانو سرد مناسب برای تمرکز بیشتر',
                image: 'images/ice-americano.jpg',
                available: true
            },
            {
                id: 10,
                name: 'شیک شکلات',
                category: 'cold-drinks',
                price: 55000,
                description: 'شیک خنک شکلاتی با بستنی وانیل',
                image: 'images/chocolate-shake.jpg',
                available: false
            },
            {
                id: 11,
                name: 'اسموتی توت فرنگی',
                category: 'cold-drinks',
                price: 52000,
                description: 'اسموتی طبیعی توت فرنگی با یوگورت',
                image: 'images/strawberry-smoothie.jpg',
                available: true
            },
            
            // کیک و شیرینی
            {
                id: 12,
                name: 'کیک شکلاتی',
                category: 'desserts',
                price: 85000,
                description: 'کیک رطب شکلاتی با گاناش تلخ و شیرین',
                image: 'images/chocolate-cake.jpg',
                available: true
            },
            {
                id: 13,
                name: 'چیزکیک توت فرنگی',
                category: 'desserts',
                price: 95000,
                description: 'چیزکیک کرمی با سس توت فرنگی طبیعی',
                image: 'images/strawberry-cheesecake.jpg',
                available: true
            },
            {
                id: 14,
                name: 'تیرامیسو',
                category: 'desserts',
                price: 105000,
                description: 'دسر ایتالیایی کلاسیک با طعم قهوه و ماسکارپونه',
                image: 'images/tiramisu.jpg',
                available: true
            },
            {
                id: 15,
                name: 'کوکی شکلاتی',
                category: 'desserts',
                price: 25000,
                description: 'کوکی تازه پخت با تکه‌های شکلات',
                image: 'images/chocolate-cookies.jpg',
                available: true
            },
            {
                id: 16,
                name: 'کاپ کیک وانیل',
                category: 'desserts',
                price: 35000,
                description: 'کاپ کیک نرم وانیلی با کرم باتر',
                image: 'images/vanilla-cupcake.jpg',
                available: true
            },
            {
                id: 17,
                name: 'اکلر شکلاتی',
                category: 'desserts',
                price: 45000,
                description: 'اکلر فرانسوی با کرم پاستری و روکش شکلات',
                image: 'images/chocolate-eclair.jpg',
                available: true
            },
            
            // اسنک و صبحانه
            {
                id: 18,
                name: 'ساندویچ کلاب',
                category: 'snacks',
                price: 125000,
                description: 'ساندویچ چند لایه با مرغ، بیکن، کاهو و گوجه',
                image: 'images/club-sandwich.jpg',
                available: true
            },
            {
                id: 19,
                name: 'کروسان کره‌ای',
                category: 'snacks',
                price: 65000,
                description: 'کروسان تازه با کره تازه و مربای خانگی',
                image: 'images/butter-croissant.jpg',
                available: true
            },
            {
                id: 20,
                name: 'پنکیک عسلی',
                category: 'snacks',
                price: 85000,
                description: 'پنکیک نرم با عسل طبیعی و کره',
                image: 'images/honey-pancakes.jpg',
                available: true
            },
            {
                id: 21,
                name: 'سالاد سزار',
                category: 'snacks',
                price: 95000,
                description: 'سالاد تازه با سس سزار خانگی و پارمزان',
                image: 'images/caesar-salad.jpg',
                available: true
            },
            {
                id: 22,
                name: 'بگت مرغ و پنیر',
                category: 'snacks',
                price: 110000,
                description: 'بگت فرانسوی با مرغ گریل و پنیر چدار',
                image: 'images/chicken-baguette.jpg',
                available: true
            },
            {
                id: 23,
                name: 'کوآسان شکلاتی',
                category: 'snacks',
                price: 55000,
                description: 'کروسان با شکلات داخل، گرم و لذیذ',
                image: 'images/chocolate-croissant.jpg',
                available: true
            },
            {
                id: 24,
                name: 'توست فرانسوی',
                category: 'snacks',
                price: 75000,
                description: 'توست فرانسوی با دارچین و پودر قند',
                image: 'images/french-toast.jpg',
                available: true
            }
        ];
        
        this.cart = [];
        this.currentCategory = 'all';
        
        this.initializeElements();
        this.bindEvents();
        this.renderMenu();
    }

    initializeElements() {
        this.menuContent = document.getElementById('menuContent');
        this.searchInput = document.getElementById('searchInput');
        this.searchBtn = document.getElementById('searchBtn');
        this.navBtns = document.querySelectorAll('.nav-btn');
        this.cartElement = document.getElementById('floatingCart');
        this.cartItems = document.getElementById('cartItems');
        this.cartTotal = document.getElementById('cartTotal');
        this.closeCart = document.getElementById('closeCart');
        
        // مدال عناصر
        this.totalModal = document.getElementById('totalModal');
        this.modalOverlay = document.getElementById('modalOverlay');
        this.modalClose = document.getElementById('modalClose');
        this.viewTotalBtn = document.getElementById('viewTotalBtn');
        this.orderSummary = document.getElementById('orderSummary');
        this.totalBreakdown = document.getElementById('totalBreakdown');
        this.modalCancel = document.getElementById('modalCancel');
        this.modalConfirm = document.getElementById('modalConfirm');
        
        // مدال تأیید سفارش
        this.orderSuccessModal = document.getElementById('orderSuccessModal');
        this.successModalOverlay = document.getElementById('successModalOverlay');
        this.orderDetails = document.getElementById('orderDetails');
        this.successOkBtn = document.getElementById('successOkBtn');
    }

    bindEvents() {
        // Navigation
        this.navBtns.forEach(btn => {
            btn.addEventListener('click', (e) => this.handleCategoryChange(e));
        });

        // Search
        this.searchBtn.addEventListener('click', () => this.performSearch());
        this.searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') this.performSearch();
        });
        this.searchInput.addEventListener('input', () => this.performSearch());

        // Cart
        this.closeCart.addEventListener('click', () => this.hideCart());
        
        // مدال
        this.viewTotalBtn.addEventListener('click', () => this.showTotalModal());
        this.modalClose.addEventListener('click', () => this.hideTotalModal());
        this.modalOverlay.addEventListener('click', () => this.hideTotalModal());
        this.modalCancel.addEventListener('click', () => this.hideTotalModal());
        this.modalConfirm.addEventListener('click', () => this.confirmOrder());
        
        // مدال تأیید سفارش
        this.successOkBtn.addEventListener('click', () => this.hideSuccessModal());
        this.successModalOverlay.addEventListener('click', () => this.hideSuccessModal());
        
        // Order button
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('order-btn')) {
                this.placeOrder();
            }
        });
    }

    handleCategoryChange(e) {
        this.navBtns.forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
        
        this.currentCategory = e.target.dataset.category;
        this.searchInput.value = '';
        this.renderMenu();
    }

    performSearch() {
        const query = this.searchInput.value.trim().toLowerCase();
        this.renderMenu(query);
    }

    getFilteredItems(searchQuery = '') {
        let items = this.menuItems;

        // Filter by category
        if (this.currentCategory !== 'all') {
            items = items.filter(item => item.category === this.currentCategory);
        }

        // Filter by search query
        if (searchQuery) {
            items = items.filter(item => 
                item.name.toLowerCase().includes(searchQuery) ||
                item.description.toLowerCase().includes(searchQuery)
            );
        }

        return items;
    }

    renderMenu(searchQuery = '') {
        const items = this.getFilteredItems(searchQuery);
        
        if (items.length === 0) {
            this.renderEmptyState(searchQuery);
            return;
        }

        // Group items by category for display
        const groupedItems = this.groupItemsByCategory(items);
        
        let html = '';
        Object.entries(groupedItems).forEach(([category, categoryItems]) => {
            html += this.renderCategorySection(category, categoryItems);
        });

        this.menuContent.innerHTML = html;
        this.bindCartButtons();
    }

    groupItemsByCategory(items) {
        const categories = {
            'hot-drinks': 'نوشیدنی‌های گرم',
            'cold-drinks': 'نوشیدنی‌های سرد', 
            'desserts': 'کیک و شیرینی',
            'snacks': 'اسنک و صبحانه'
        };

        const grouped = {};
        
        items.forEach(item => {
            const categoryName = categories[item.category];
            if (!grouped[categoryName]) {
                grouped[categoryName] = [];
            }
            grouped[categoryName].push(item);
        });

        return grouped;
    }

    renderCategorySection(categoryName, items) {
        return `
            <div class="category-section">
                <h2 class="category-title">${categoryName}</h2>
                <div class="items-grid">
                    ${items.map(item => this.renderMenuItem(item)).join('')}
                </div>
            </div>
        `;
    }

    renderMenuItem(item) {
        const availabilityClass = item.available ? 'available' : 'unavailable';
        const statusClass = item.available ? 'status-available' : 'status-unavailable';
        const statusText = item.available ? '✅ موجود' : '❌ ناموجود';

        return `
            <div class="menu-item ${availabilityClass}" data-id="${item.id}">
                <div class="item-image">
                    <img src="${item.image}" alt="${item.name}" loading="lazy">
                </div>
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">${item.name}</h3>
                        </div>
                        <div class="item-price">${this.formatPrice(item.price)} تومان</div>
                    </div>
                    <p class="item-description">${item.description}</p>
                    <div class="item-actions">
                        ${item.available ? `
                            <button class="add-to-cart" data-id="${item.id}">
                                <span>🛒</span>
                                افزودن به سبد
                            </button>
                        ` : `
                            <div class="item-status ${statusClass}">${statusText}</div>
                        `}
                    </div>
                </div>
            </div>
        `;
    }

    renderEmptyState(searchQuery) {
        const message = searchQuery 
            ? `هیچ محصولی با عبارت "${searchQuery}" یافت نشد.`
            : 'محصولی در این دسته‌بندی موجود نیست.';
            
        this.menuContent.innerHTML = `
            <div class="empty-state">
                <h3>😔 ${message}</h3>
                <p>لطفاً دسته‌بندی دیگری انتخاب کنید یا عبارت جستجوی دیگری امتحان کنید.</p>
            </div>
        `;
    }

    bindCartButtons() {
        document.querySelectorAll('.add-to-cart:not([disabled])').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const itemId = parseInt(e.target.dataset.id);
                this.addToCart(itemId);
            });
        });
    }

    addToCart(itemId) {
        const item = this.menuItems.find(i => i.id === itemId);
        if (!item || !item.available) return;

        const existingItem = this.cart.find(i => i.id === itemId);
        
        if (existingItem) {
            existingItem.quantity += 1;
        } else {
            this.cart.push({
                ...item,
                quantity: 1
            });
        }

        this.updateCartDisplay();
        this.showCart();
        this.showNotification(`${item.name} به سبد اضافه شد! 🛒`);
    }

    removeFromCart(itemId) {
        this.cart = this.cart.filter(item => item.id !== itemId);
        this.updateCartDisplay();
        
        // فقط وقتی سبد کاملاً خالی شود، آن را مخفی کن
        if (this.cart.length === 0) {
            this.hideCart();
        }
    }

    updateCartDisplay() {
        if (this.cart.length === 0) {
            this.hideCart();
            return;
        }

        let cartHTML = '';
        let total = 0;

        this.cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            cartHTML += `
                <div class="cart-item">
                    <div>
                        <div style="font-weight: 600;">${item.name}</div>
                        <div style="font-size: 0.9rem; color: #666;">
                            ${this.formatPrice(item.price)} × ${item.quantity}
                        </div>
                    </div>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-weight: 600;">${this.formatPrice(itemTotal)}</span>
                        <button onclick="cafeMenu.removeFromCart(${item.id})" 
                                style="background: none; border: none; color: #f44336; cursor: pointer; font-size: 1.2rem;">×</button>
                    </div>
                </div>
            `;
        });

        this.cartItems.innerHTML = cartHTML;
        this.cartTotal.innerHTML = `
            <span class="total-label">جمع کل:</span>
            <span class="total-amount">${this.formatPrice(total)} تومان</span>
            <button class="view-total-btn" id="viewTotalBtn">👁️ مشاهده جزئیات</button>
        `;
        
        // دوباره event listener اضافه کن
        document.getElementById('viewTotalBtn').addEventListener('click', () => this.showTotalModal());
    }

    showCart() {
        this.cartElement.style.display = 'block';
    }

    hideCart() {
        this.cartElement.style.display = 'none';
    }

    formatPrice(price) {
        return price.toLocaleString('fa-IR');
    }

    showTotalModal() {
        if (this.cart.length === 0) {
            this.showNotification('سبد خرید شما خالی است! 🛒');
            return;
        }

        let summaryHTML = '<h3>📋 خلاصه سفارش</h3>';
        let breakdownHTML = '<h3>💰 محاسبه قیمت</h3>';
        let subtotal = 0;

        this.cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            
            summaryHTML += `
                <div class="order-item">
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <div class="item-info">${this.formatPrice(item.price)} × ${item.quantity}</div>
                    </div>
                    <div class="item-price">${this.formatPrice(itemTotal)} تومان</div>
                </div>
            `;
        });

        // محاسبه مالیات و هزینه‌های اضافی
        const tax = Math.round(subtotal * 0.09); // 9% مالیات
        const serviceCharge = Math.round(subtotal * 0.05); // 5% هزینه سرویس
        const total = subtotal + tax + serviceCharge;

        breakdownHTML += `
            <div class="breakdown-item">
                <span>جمع فرعی:</span>
                <span>${this.formatPrice(subtotal)} تومان</span>
            </div>
            <div class="breakdown-item">
                <span>مالیات (9%):</span>
                <span>${this.formatPrice(tax)} تومان</span>
            </div>
            <div class="breakdown-item">
                <span>هزینه سرویس (5%):</span>
                <span>${this.formatPrice(serviceCharge)} تومان</span>
            </div>
            <div class="breakdown-item">
                <span>جمع کل:</span>
                <span>${this.formatPrice(total)} تومان</span>
            </div>
        `;

        this.orderSummary.innerHTML = summaryHTML;
        this.totalBreakdown.innerHTML = breakdownHTML;
        this.totalModal.style.display = 'flex';
    }

    hideTotalModal() {
        this.totalModal.style.display = 'none';
    }

    confirmOrder() {
        const total = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = Math.round(total * 0.09);
        const serviceCharge = Math.round(total * 0.05);
        const finalTotal = total + tax + serviceCharge;
        
        this.showNotification('سفارش شما با موفقیت ثبت شد! ✅');
        this.hideTotalModal();
        
        // نمایش مدال تأیید زیبا
        this.showSuccessModal(finalTotal, tax, serviceCharge);
        
        // پاک کردن سبد خرید
        this.cart = [];
        this.updateCartDisplay();
        this.hideCart();
    }

    showSuccessModal(finalTotal, tax, serviceCharge) {
        const subtotal = finalTotal - tax - serviceCharge;
        
        let detailsHTML = '<h3>📋 جزئیات سفارش</h3>';
        detailsHTML += `
            <div class="detail-item">
                <span>جمع فرعی:</span>
                <span>${this.formatPrice(subtotal)} تومان</span>
            </div>
            <div class="detail-item">
                <span>مالیات (9%):</span>
                <span>${this.formatPrice(tax)} تومان</span>
            </div>
            <div class="detail-item">
                <span>هزینه سرویس (5%):</span>
                <span>${this.formatPrice(serviceCharge)} تومان</span>
            </div>
            <div class="detail-item">
                <span>جمع کل:</span>
                <span>${this.formatPrice(finalTotal)} تومان</span>
            </div>
        `;
        
        this.orderDetails.innerHTML = detailsHTML;
        this.orderSuccessModal.style.display = 'flex';
    }

    hideSuccessModal() {
        this.orderSuccessModal.style.display = 'none';
    }

    placeOrder() {
        if (this.cart.length === 0) {
            this.showNotification('سبد خرید شما خالی است! 🛒');
            return;
        }

        const total = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = Math.round(total * 0.09);
        const serviceCharge = Math.round(total * 0.05);
        const finalTotal = total + tax + serviceCharge;
        
        // نمایش پیام موفقیت
        this.showNotification('سفارش شما با موفقیت ثبت شد! ✅');
        
        // نمایش مدال تأیید زیبا
        this.showSuccessModal(finalTotal, tax, serviceCharge);
        
        // پاک کردن سبد خرید
        this.cart = [];
        this.updateCartDisplay();
        this.hideCart();
    }

    showNotification(message) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        notification.textContent = message;
        
        Object.assign(notification.style, {
            position: 'fixed',
            top: '100px',
            right: '20px',
            background: 'linear-gradient(135deg, #4CAF50, #45a049)',
            color: 'white',
            padding: '1rem 2rem',
            borderRadius: '50px',
            boxShadow: '0 10px 30px rgba(76, 175, 80, 0.3)',
            zIndex: '10000',
            fontSize: '1rem',
            fontWeight: '600',
            animation: 'slideIn 0.3s ease forwards, slideOut 0.3s ease 2.7s forwards'
        });

        document.body.appendChild(notification);

        setTimeout(() => {
            if (notification.parentElement) {
                notification.remove();
            }
        }, 3000);
    }
}

// Add notification animations
const notificationStyles = `
    @keyframes slideIn {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOut {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = notificationStyles;
document.head.appendChild(styleSheet);

// Initialize the menu
document.addEventListener('DOMContentLoaded', () => {
    window.cafeMenu = new CafeMenu();

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
});
