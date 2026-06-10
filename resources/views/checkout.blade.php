@extends('admin.layouts.main')

@push('styles')
<style>
:root {
    --primary: #22c55e;
    --primary-dark: #16a34a;
    --bg: #f9fafb;
    --card: #ffffff;
    --text: #111827;
    --muted: #6b7280;
    --border: #e5e7eb;
}

* { box-sizing: border-box; }

body {
    margin: 0;
    padding: 16px;
    font-family: 'Vazirmatn', sans-serif;
    background: var(--bg);
    color: var(--text);
}

.checkout-container {
    max-width: 480px;
    margin: auto;
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

.section-title {
    font-size: 18px;
    font-weight: 700;
    margin: 20px 0 10px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
}
.cart-item:last-child { border-bottom: none; }
.cart-item span { font-size: 14px; }
.cart-item .price { font-weight: 600; }

.total {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 700;
    margin: 20px 0;
    padding-top: 10px;
    border-top: 2px dashed var(--border);
}

.user-info-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    padding: 15px;
    border-radius: 12px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.user-avatar {
    width: 40px;
    height: 40px;
    background: var(--primary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    flex-shrink: 0;
}
.user-details div { font-size: 14px; }
.user-details .name { font-weight: bold; color: var(--text); }
.user-details .phone { font-size: 12px; color: var(--muted); }

.address-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-bottom: 15px;
}
.address-item {
    position: relative;
    border: 1px solid var(--border);
    padding: 15px;
    border-radius: 12px;
    cursor: pointer;
    transition: all 0.2s;
}
.address-item:hover { border-color: var(--primary); background: #f0fdf4; }
.address-item.selected {
    border-color: var(--primary);
    background: #dcfce7;
    box-shadow: 0 0 0 2px var(--primary);
}
.address-item input[type="radio"] {
    position: absolute;
    top: 15px;
    left: 15px;
    width: 20px;
    height: 20px;
    accent-color: var(--primary);
}
.address-text {
    margin: 0 25px 0 0;
    font-size: 14px;
    line-height: 1.6;
}

.form-group { margin-bottom: 12px; }
label { font-size: 13px; color: var(--muted); display: block; margin-bottom: 5px; }
input[type="text"], textarea {
    width: 100%;
    padding: 12px;
    border-radius: 12px;
    border: 1px solid var(--border);
    font-family: 'Vazirmatn';
    font-size: 14px;
    outline: none;
    resize: vertical;
}
input[type="text"]:focus, textarea:focus { border-color: var(--primary); }

.btn {
    padding: 12px 20px;
    border-radius: 12px;
    border: none;
    font-family: 'Vazirmatn';
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 5px;
}
.btn-primary { background: var(--primary); color: white; width: 100%; }
.btn-primary:hover { background: var(--primary-dark); }
.btn-primary:disabled { opacity: 0.6; cursor: not-allowed; }
.btn-outline {
    background: transparent;
    border: 1px dashed var(--primary);
    color: var(--primary);
    width: 100%;
    margin-top: 10px;
}
.btn-outline:hover { background: #f0fdf4; }
.btn-sm { padding: 8px 16px; font-size: 13px; }

.payment-method-wrapper {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
}
.payment-option {
    flex: 1;
    border: 1px solid var(--border);
    padding: 10px;
    border-radius: 10px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    transition: all 0.2s;
}
.payment-option:has(input:checked) {
    border-color: var(--primary);
    background: #f0fdf4;
}
.payment-option input { accent-color: var(--primary); }

.hidden { display: none !important; }

.loading-state {
    text-align: center;
    color: var(--muted);
    padding: 20px;
    font-size: 13px;
}
.error-state {
    text-align: center;
    color: #dc2626;
    padding: 15px;
    font-size: 13px;
    background: #fef2f2;
    border-radius: 8px;
    border: 1px solid #fecaca;
}
.empty-state {
    text-align: center;
    color: var(--muted);
    padding: 15px;
    font-size: 13px;
}
</style>
@endpush

@php
    $customer = auth()->guard('customer')->user();
@endphp

<div class="checkout-container">
    <h1 class="section-title">🛒 مرور سفارش</h1>

    <div id="cartItems"></div>
    <div class="total" id="cartTotal">جمع کل: ۰ تومان</div>

    {{-- اطلاعات کاربر --}}
    @if($customer)
        <div class="user-info-box">
            <div class="user-avatar">
                {{ mb_substr($customer->name ?? 'ک', 0, 1) }}
            </div>
            <div class="user-details">
                <div class="name">{{ $customer->name ?? 'کاربر عزیز' }}</div>
                <div class="phone">{{ $customer->phone }}</div>
            </div>
        </div>
    @else
        <div class="user-info-box" style="background: #fef2f2; border-color: #fecaca; color: #b91c1c;">
            ⚠️ کاربر شناسایی نشد. لطفا مجددا وارد شوید.
        </div>
    @endif

    <h2 class="section-title">📍 انتخاب آدرس تحویل</h2>

    {{-- لیست آدرس‌ها --}}
    <div id="addressContainer">
        <div class="loading-state">در حال دریافت آدرس‌ها...</div>
    </div>

    {{-- دکمه افزودن آدرس جدید --}}
    <button type="button" id="toggleNewAddressBtn" class="btn btn-outline">
        + افزودن آدرس جدید
    </button>

    {{-- فرم ثبت آدرس جدید --}}
    <div id="newAddressForm" class="hidden" style="margin-top: 15px; background: #f9fafb; padding: 15px; border-radius: 12px; border: 1px solid var(--border);">
        <div class="form-group">
            <label>عنوان آدرس (اختیاری)</label>
            <input type="text" id="addressTitle" placeholder="مثال: منزل، محل کار">
        </div>
        <div class="form-group">
            <label>آدرس کامل <span style="color: #dc2626;">*</span></label>
            <textarea id="newAddressText" rows="3" placeholder="آدرس دقیق خود را وارد کنید..."></textarea>
        </div>
        <div style="display: flex; gap: 10px; align-items: center;">
            <button type="button" id="saveAddressBtn" class="btn btn-primary btn-sm" style="width: auto;">
                ثبت و انتخاب آدرس
            </button>
            <button type="button" id="cancelAddressBtn" class="btn btn-sm" style="color: var(--muted);">
                انصراف
            </button>
        </div>
    </div>

    <h2 class="section-title">💳 روش پرداخت</h2>

    <div class="payment-method-wrapper">
        <label class="payment-option">
            <input type="radio" name="payment_method" value="online" checked>
            پرداخت آنلاین
        </label>
        <label class="payment-option">
            <input type="radio" name="payment_method" value="cash">
            پرداخت در محل
        </label>
    </div>

    {{-- فرم ثبت نهایی --}}
    <div style="margin-top: 25px;">
        <input type="hidden" id="selectedAddressId">
        <button type="button" id="submitOrderBtn" class="btn btn-primary" style="padding: 15px; font-size: 16px;">
            ثبت نهایی سفارش
        </button>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const CSRF_TOKEN = '{{ csrf_token() }}';
    const ADDRESS_INDEX_URL = '{{ route("address.index") }}';
    const ADDRESS_STORE_URL = '{{ route("address.store") }}';
    const ORDER_SUBMIT_URL = '{{ route("order.submit") }}';

    // ─── ۱. نمایش سبد خرید از localStorage ─────────────────────────────────

    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    const cartItemsEl = document.getElementById('cartItems');
    const cartTotalEl = document.getElementById('cartTotal');
    const submitBtn = document.getElementById('submitOrderBtn');
    let total = 0;

    const cartItems = Object.values(cart);

    if (cartItems.length === 0) {
        cartItemsEl.innerHTML = '<div style="text-align:center; padding:20px; color:#dc2626;">سبد خرید خالی است</div>';
        submitBtn.disabled = true;
    } else {
        cartItems.forEach(item => {
            const itemTotal = item.price * item.qty;
            total += itemTotal;
            const div = document.createElement('div');
            div.classList.add('cart-item');
            div.innerHTML = `
                <span>${item.name} <span style="color:#666; font-size:12px;">(x${item.qty})</span></span>
                <span class="price">${itemTotal.toLocaleString('fa-IR')} تومان</span>
            `;
            cartItemsEl.appendChild(div);
        });
        cartTotalEl.textContent = 'جمع کل: ' + total.toLocaleString('fa-IR') + ' تومان';
    }

    // ─── ۲. مدیریت آدرس‌ها ───────────────────────────────────────────────────

    const addressContainer = document.getElementById('addressContainer');
    const newAddressForm   = document.getElementById('newAddressForm');
    const toggleBtn        = document.getElementById('toggleNewAddressBtn');
    const cancelBtn        = document.getElementById('cancelAddressBtn');
    const saveAddressBtn   = document.getElementById('saveAddressBtn');
    const selectedAddressInput = document.getElementById('selectedAddressId');

    /**
     * دریافت و نمایش لیست آدرس‌ها از سرور
     * @param {number|null} autoSelectId - اگر آدرسی تازه ثبت شده، id آن را پاس بده تا auto-select شود
     */
    function loadAddresses(autoSelectId = null) {
        addressContainer.innerHTML = '<div class="loading-state">در حال دریافت آدرس‌ها...</div>';

        fetch(ADDRESS_INDEX_URL, {
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            }
        })
        .then(res => {
            if (!res.ok) throw new Error('server_error');
            return res.json();
        })
        .then(response => {
            // پشتیبانی از هر دو فرمت: { data: [...] } یا [...]
            const addresses = Array.isArray(response) ? response : (response.data ?? []);

            addressContainer.innerHTML = '';

            if (addresses.length === 0) {
                addressContainer.innerHTML = '<div class="empty-state">آدرسی ثبت نشده است. یک آدرس جدید اضافه کنید.</div>';
                return;
            }

            const listDiv = document.createElement('div');
            listDiv.className = 'address-list';

            addresses.forEach(addr => {
                const label = document.createElement('label');
                label.className = 'address-item';
                label.dataset.id = addr.id;

                label.innerHTML = `
                    <input type="radio" name="address" value="${addr.id}">
                    <div class="address-text">
                        <strong>${addr.title || 'آدرس'}</strong><br>
                        ${addr.address}
                    </div>
                `;

                // انتخاب آدرس با کلیک روی کل label
                label.querySelector('input[type="radio"]').addEventListener('change', function () {
                    selectAddress(addr.id, label);
                });

                listDiv.appendChild(label);
            });

            addressContainer.appendChild(listDiv);

            // اگر باید auto-select شود (بعد از ثبت آدرس جدید)
            if (autoSelectId) {
                const targetLabel = listDiv.querySelector(`label[data-id="${autoSelectId}"]`);
                if (targetLabel) {
                    const radio = targetLabel.querySelector('input[type="radio"]');
                    radio.checked = true;
                    selectAddress(autoSelectId, targetLabel);
                }
            }
        })
        .catch(err => {
            console.error('Address load error:', err);
            addressContainer.innerHTML = `
                <div class="error-state">
                    خطا در دریافت آدرس‌ها.
                    <button onclick="loadAddresses()" style="margin-right: 8px; background: none; border: none; color: #dc2626; cursor: pointer; text-decoration: underline; font-size: 13px;">
                        تلاش مجدد
                    </button>
                </div>
            `;
        });
    }

    function selectAddress(id, labelEl) {
        document.querySelectorAll('.address-item').forEach(el => el.classList.remove('selected'));
        labelEl.classList.add('selected');
        selectedAddressInput.value = id;
    }

    // باز/بستن فرم آدرس جدید
    toggleBtn.addEventListener('click', () => {
        newAddressForm.classList.remove('hidden');
        toggleBtn.classList.add('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        newAddressForm.classList.add('hidden');
        toggleBtn.classList.remove('hidden');
        document.getElementById('addressTitle').value = '';
        document.getElementById('newAddressText').value = '';
    });

    // ثبت آدرس جدید
    saveAddressBtn.addEventListener('click', () => {
        const title   = document.getElementById('addressTitle').value.trim();
        const address = document.getElementById('newAddressText').value.trim();

        if (!address) {
            alert('لطفا آدرس را وارد کنید');
            return;
        }

        saveAddressBtn.textContent = 'در حال ثبت...';
        saveAddressBtn.disabled = true;

        fetch(ADDRESS_STORE_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({ title, address })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success || data.id) {
                newAddressForm.classList.add('hidden');
                toggleBtn.classList.remove('hidden');
                document.getElementById('addressTitle').value = '';
                document.getElementById('newAddressText').value = '';
                // بارگذاری مجدد و auto-select آدرس جدید
                loadAddresses(data.id ?? null);
            } else {
                alert(data.message || 'خطا در ثبت آدرس');
            }
        })
        .catch(() => alert('خطا در ارتباط با سرور'))
        .finally(() => {
            saveAddressBtn.textContent = 'ثبت و انتخاب آدرس';
            saveAddressBtn.disabled = false;
        });
    });

    // ─── ۳. ثبت نهایی سفارش ─────────────────────────────────────────────────

    submitBtn.addEventListener('click', function () {
        const addressId = selectedAddressInput.value;

        if (!addressId) {
            alert('لطفا یک آدرس برای تحویل سفارش انتخاب کنید');
            return;
        }

        if (Object.keys(cart).length === 0) {
            alert('سبد خرید خالی است');
            return;
        }

        submitBtn.textContent = 'در حال ثبت...';
        submitBtn.disabled = true;

        const paymentMethod = document.querySelector('input[name="payment_method"]:checked').value;

        fetch(ORDER_SUBMIT_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN
            },
            body: JSON.stringify({
                cart,
                address_id: addressId,
                payment_method: paymentMethod
            })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                alert(data.message || 'خطا در ثبت سفارش');
                submitBtn.textContent = 'ثبت نهایی سفارش';
                submitBtn.disabled = false;
                return;
            }

            // پرداخت آنلاین → ریدایرکت به درگاه
            if (data.redirect) {
                window.location.href = data.redirect;
                return;
            }

            // پرداخت نقدی
            localStorage.removeItem('cart');
            alert(`سفارش شما با موفقیت ثبت شد.\nشماره سفارش: ${data.order_id}`);
            window.location.href = '/profile';
        })
        .catch(err => {
            console.error('Order submit error:', err);
            alert('خطا در ارتباط با سرور');
            submitBtn.textContent = 'ثبت نهایی سفارش';
            submitBtn.disabled = false;
        });
    });

    // ─── ۴. بارگذاری اولیه آدرس‌ها ─────────────────────────────────────────
    loadAddresses(); // 👈 این بود که در کد قبلی فراموش شده بود!

});
</script>
@endpush