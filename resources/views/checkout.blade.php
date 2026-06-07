<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>تکمیل سفارش</title>

<link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@400;600;700&display=swap" rel="stylesheet">

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

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    padding: 16px;
    font-family: 'Vazirmatn', sans-serif;
    background: var(--bg);
    color: var(--text);
}

/* Container */
.checkout-container {
    max-width: 480px;
    margin: auto;
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

/* Title */
.section-title {
    font-size: 18px;
    font-weight: 700;
    margin: 20px 0 10px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Cart Items */
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

/* User Info Box */
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
    width: 40px; height: 40px; background: var(--primary); color: white;
    border-radius: 50%; display: flex; align-items: center; justify-content: center;
    font-weight: bold;
}
.user-details div { font-size: 14px; }
.user-details .name { font-weight: bold; color: var(--text); }
.user-details .phone { font-size: 12px; color: var(--muted); }

/* Address List */
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
.address-item.selected { border-color: var(--primary); background: #dcfce7; box-shadow: 0 0 0 2px var(--primary); }

.address-item input[type="radio"] {
    position: absolute; top: 15px; left: 15px;
    width: 20px; height: 20px; accent-color: var(--primary);
}
.address-text { margin: 0 25px 0 0; font-size: 14px; line-height: 1.6; }

/* Forms */
.form-group { margin-bottom: 12px; }
label { font-size: 13px; color: var(--muted); display: block; margin-bottom: 5px; }
input, textarea {
    width: 100%; padding: 12px; border-radius: 12px;
    border: 1px solid var(--border); font-family: 'Vazirmatn';
    font-size: 14px; outline: none; resize: vertical;
}
input:focus, textarea:focus { border-color: var(--primary); }

/* Buttons */
.btn {
    padding: 12px 20px; border-radius: 12px; border: none;
    font-family: 'Vazirmatn'; font-size: 14px; font-weight: 600;
    cursor: pointer; transition: 0.2s;
    display: inline-flex; align-items: center; justify-content: center; gap: 5px;
}
.btn-primary {
    background: var(--primary); color: white; width: 100%;
}
.btn-primary:hover { background: var(--primary-dark); }

.btn-outline {
    background: transparent; border: 1px dashed var(--primary); color: var(--primary);
    width: 100%; margin-top: 10px;
}
.btn-outline:hover { background: #f0fdf4; }

.btn-sm { padding: 8px 16px; font-size: 13px; }

/* Utilities */
.hidden { display: none !important; }
.loading { text-align: center; color: var(--muted); padding: 20px; font-size: 13px; }

</style>
</head>
<body>

<div class="checkout-container">
    <h1 class="section-title">🛒 مرور سفارش</h1>

    <!-- لیست آیتم‌های سبد خرید -->
    <div id="cartItems"></div>
    <div class="total" id="cartTotal">جمع کل: ۰ تومان</div>

    <!-- اطلاعات کاربر (خواندن از Customer) -->
    @php
        $customer = auth()->guard('customer')->user();
    @endphp
    
    @if($customer)
    <div class="user-info-box">
        <div class="user-avatar">
            {{ mb_substr($customer->name ?? 'کاربر', 0, 1) }}
        </div>
        <div class="user-details">
            <div class="name">{{ $customer->name ?? 'کاربر عزیز' }}</div>
            <div class="phone">{{ $customer->phone }}</div>
        </div>
    </div>
    @else
    <div class="user-info-box" style="background: #fef2f2; border-color: #fecaca; color: #b91c1c;">
        کاربر شناسایی نشد. لطفا مجددا وارد شوید.
    </div>
    @endif

    <h2 class="section-title">📍 انتخاب آدرس تحویل</h2>

    <!-- لیست آدرس‌های ثبت شده -->
    <div id="addressContainer">
        <div class="loading">در حال دریافت آدرس‌ها...</div>
    </div>

    <!-- دکمه افزودن آدرس جدید -->
    <button type="button" id="toggleNewAddressBtn" class="btn btn-outline">
        + افزودن آدرس جدید
    </button>

    <!-- فرم ثبت آدرس جدید -->
    <div id="newAddressForm" class="hidden" style="margin-top: 15px; background: #f9fafb; padding: 15px; border-radius: 12px; border: 1px solid var(--border);">
        <div class="form-group">
            <label>عنوان آدرس (اختیاری)</label>
            <input type="text" id="addressTitle" placeholder="مثال: منزل، محل کار">
        </div>
        <div class="form-group">
            <label>آدرس کامل</label>
            <textarea id="newAddressText" rows="3" placeholder="آدرس دقیق خود را وارد کنید..."></textarea>
        </div>
        <button type="button" id="saveAddressBtn" class="btn btn-primary btn-sm">ثبت و انتخاب آدرس</button>
        <button type="button" id="cancelAddressBtn" class="btn btn-sm" style="color: var(--muted); margin-right: 10px;">انصراف</button>
    </div>

    <!-- دکمه ثبت نهایی -->
    <form id="checkoutForm" style="margin-top: 25px;">
        @csrf
        <input type="hidden" name="address_id" id="selectedAddressId">
        <button type="submit" id="submitOrderBtn" class="btn btn-primary" style="padding: 15px; font-size: 16px;">
            ثبت نهایی سفارش
        </button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function(){

    // 1. نمایش سبد خرید از LocalStorage
    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    const cartItemsEl = document.getElementById('cartItems');
    const cartTotalEl = document.getElementById('cartTotal');
    let total = 0;

    // رندر کردن آیتم‌ها
    Object.values(cart).forEach(item => {
        const itemTotal = item.price * item.qty;
        total += itemTotal;
        const div = document.createElement('div');
        div.classList.add('cart-item');
        div.innerHTML = `
            <span>${item.name} <span style="color:#666; font-size:12px;">(x${item.qty})</span></span> 
            <span class="price">${itemTotal.toLocaleString()} تومان</span>
        `;
        cartItemsEl.appendChild(div);
    });
    cartTotalEl.innerText = 'جمع کل: ' + total.toLocaleString() + ' تومان';

    if(Object.keys(cart).length === 0) {
        cartItemsEl.innerHTML = '<div style="text-align:center; padding:20px; color:red;">سبد خرید خالی است</div>';
        document.getElementById('submitOrderBtn').disabled = true;
    }

    // 2. مدیریت آدرس‌ها
    const addressContainer = document.getElementById('addressContainer');
    const newAddressForm = document.getElementById('newAddressForm');
    const toggleBtn = document.getElementById('toggleNewAddressBtn');
    const cancelBtn = document.getElementById('cancelAddressBtn');
    const saveAddressBtn = document.getElementById('saveAddressBtn');
    const selectedAddressInput = document.getElementById('selectedAddressId');

    // تابع بارگذاری آدرس‌ها از سرور
    function loadAddresses() {
    fetch("{{ route('address.index') }}")
    .then(res => res.json())
    .then(data => {

        addressContainer.innerHTML = '';

        if (data.length > 0) {

            const listDiv = document.createElement('div');
            listDiv.className = 'address-list';

            data.forEach(addr => {
                const label = document.createElement('label');
                label.className = 'address-item';
                label.innerHTML = `
                    <input type="radio" name="address" value="${addr.id}" onchange="selectAddress(${addr.id}, this)">
                    <div class="address-text">
                        <strong>${addr.title || 'آدرس'}</strong><br>
                        ${addr.address}
                    </div>
                `;
                listDiv.appendChild(label);
            });

            addressContainer.appendChild(listDiv);

        } else {
            addressContainer.innerHTML = '<div style="text-align:center;color:#999">آدرسی ثبت نشده</div>';
        }
    })
    .catch(err => {
        console.error(err);
    });
}

    // انتخاب آدرس (استایل دهی)
    window.selectAddress = function(id, radioBtn) {
        document.querySelectorAll('.address-item').forEach(el => el.classList.remove('selected'));
        radioBtn.parentElement.classList.add('selected');
        selectedAddressInput.value = id;
    };

    // باز/بستن فرم آدرس جدید
    toggleBtn.addEventListener('click', () => {
        newAddressForm.classList.remove('hidden');
        toggleBtn.classList.add('hidden');
    });

    cancelBtn.addEventListener('click', () => {
        newAddressForm.classList.add('hidden');
        // اگر آدرسی وجود دارد دکمه را نشان بده، وگرنه نه
        if(document.querySelector('.address-list')) {
            toggleBtn.classList.remove('hidden');
        }
    });

    // ثبت آدرس جدید
    saveAddressBtn.addEventListener('click', () => {
        const title = document.getElementById('addressTitle').value;
        const address = document.getElementById('newAddressText').value;

        if(!address) {
            alert('لطفا آدرس را وارد کنید');
            return;
        }

        // ارسال آدرس جدید به سرور
        fetch('/customer/addresses', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ title: title, address: address })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                // آدرس جدید را انتخاب کن
                selectedAddressInput.value = data.id;
                alert('آدرس با موفقیت ثبت شد');
                // بارگذاری مجدد لیست
                loadAddresses();
                newAddressForm.classList.add('hidden');
            } else {
                alert('خطا در ثبت آدرس');
            }
        })
        .catch(err => alert('خطا در ارتباط با سرور'));
    });

    // 3. ثبت نهایی سفارش
    document.getElementById('checkoutForm').addEventListener('submit', function(e){
        e.preventDefault();

        const addressId = selectedAddressInput.value;

        if(!addressId) {
            alert('لطفا یک آدرس برای تحویل سفارش انتخاب کنید');
            return;
        }

        const submitBtn = document.getElementById('submitOrderBtn');
        submitBtn.innerText = 'در حال ثبت...';
        submitBtn.disabled = true;

        const payload = {
            cart: cart,
            address_id: addressId,
            total_price: total
        };

        fetch('{{ route("order.submit") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert(`سفارش شما با شماره پیگیری ${data.order_id} ثبت شد.`);
                localStorage.removeItem('cart');
                window.location.href = '/profile'; // بازگشت به صفحه اصلی یا سفارشات من
            } else {
                alert(data.message || 'خطا در ثبت سفارش');
                submitBtn.innerText = 'ثبت نهایی سفارش';
                submitBtn.disabled = false;
            }
        })
        .catch(err => {
            console.error(err);
            alert('خطا در ارتباط با سرور');
            submitBtn.innerText = 'ثبت نهایی سفارش';
            submitBtn.disabled = false;
        });
    });

    // شروع برنامه: بارگذاری آدرس‌ها
    loadAddresses();

});
</script>
</body>
</html>