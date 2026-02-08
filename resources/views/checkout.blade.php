<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ثبت سفارش</title>

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

/* container */
.checkout-container {
    max-width: 480px;
    margin: auto;
    background: var(--card);
    border-radius: 20px;
    padding: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
}

/* title */
.checkout-title {
    font-size: 20px;
    font-weight: 700;
    margin-bottom: 16px;
    text-align: center;
}

/* cart items */
.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid var(--border);
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item span {
    font-size: 14px;
}

.cart-item .price {
    font-weight: 600;
}

/* total */
.total {
    display: flex;
    justify-content: space-between;
    font-size: 18px;
    font-weight: 700;
    margin: 20px 0;
}

/* form */
.form-group {
    margin-bottom: 14px;
    display: flex;
    flex-direction: column;
}

label {
    font-size: 13px;
    margin-bottom: 6px;
    color: var(--muted);
}

input,
select {
    padding: 12px;
    border-radius: 12px;
    border: 1px solid var(--border);
    font-size: 14px;
    outline: none;
    transition: all 0.2s ease;
}

input:focus,
select:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 2px rgba(34,197,94,0.15);
}

/* new address */
#newAddressGroup {
    display: none;
    margin-top: 10px;
}

/* submit button */
button {
    width: 100%;
    padding: 14px;
    border-radius: 16px;
    border: none;
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: #fff;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
}

button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(34,197,94,0.35);
}

button:active {
    transform: translateY(0);
}

/* responsive */
@media (max-width: 480px) {
    body {
        padding: 10px;
    }

    .checkout-container {
        padding: 16px;
        border-radius: 16px;
    }

    .checkout-title {
        font-size: 18px;
    }
}
</style>
</head>
<body>

<h1>🛒 سبد خرید شما</h1>

<div id="cartItems"></div>
<div class="total" id="cartTotal">جمع کل: ۰ تومان</div>

<h2>اطلاعات تحویل</h2>
<form id="checkoutForm">
    @csrf

    <div class="form-group">
        <label>شماره تماس:</label>
        <input type="text" id="phone" name="phone" required placeholder="مثال: 09123456789">
    </div>

    <div class="form-group" id="addressGroup" style="display:none;">
        <label>آدرس تحویل:</label>
        <select id="addressSelect" name="address_id">
            <option value="">انتخاب کنید</option>
        </select>
    </div>

    <div class="form-group" id="newAddressGroup">
        <label>آدرس جدید:</label>
        <input type="text" id="newAddress" name="new_address" placeholder="آدرس خود را وارد کنید">
        <button type="button" id="saveAddressBtn" style="margin-top:5px;">ثبت آدرس</button>
    </div>

    <button type="submit" id="submitOrderBtn" style="margin-top:15px;">ثبت نهایی سفارش</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function(){

    const cart = JSON.parse(localStorage.getItem('cart') || '{}');
    const cartItemsEl = document.getElementById('cartItems');
    const cartTotalEl = document.getElementById('cartTotal');

    let total = 0;
    Object.values(cart).forEach(item => {
        const itemTotal = item.price * item.qty;
        total += itemTotal;
        const div = document.createElement('div');
        div.classList.add('cart-item');
        div.innerHTML = `<span>${item.name} × ${item.qty}</span> <span>${itemTotal.toLocaleString()} تومان</span>`;
        cartItemsEl.appendChild(div);
    });
    cartTotalEl.innerText = 'جمع کل: ' + total.toLocaleString() + ' تومان';

    const phoneInput = document.getElementById('phone');
    const addressGroup = document.getElementById('addressGroup');
    const addressSelect = document.getElementById('addressSelect');
    const newAddressGroup = document.getElementById('newAddressGroup');
    const newAddressInput = document.getElementById('newAddress');
    const saveAddressBtn = document.getElementById('saveAddressBtn');
    const checkoutForm = document.getElementById('checkoutForm');

    let newAddressSavedId = null;

    // وقتی شماره موبایل وارد شد، بررسی مشتری
    phoneInput.addEventListener('blur', function(){
        const phone = phoneInput.value.trim();
        if(!phone) return;

        fetch(`/addresses/by-phone?phone=${phone}`)
        .then(res => res.json())
        .then(data => {
            if(data.length > 0){
                addressSelect.innerHTML = '<option value="">انتخاب کنید</option>';
                data.forEach(addr => {
                    const option = document.createElement('option');
                    option.value = addr.id;
                    option.textContent = addr.address;
                    addressSelect.appendChild(option);
                });
                addressGroup.style.display = 'block';
                newAddressGroup.style.display = 'none';
                newAddressInput.value = '';
                newAddressSavedId = null;
            } else {
                addressGroup.style.display = 'none';
                newAddressGroup.style.display = 'block';
                addressSelect.value = '';
                newAddressSavedId = null;
            }
        });
    });

    // ثبت آدرس جدید
    saveAddressBtn.addEventListener('click', function(){
        const phone = phoneInput.value.trim();
        const address = newAddressInput.value.trim();
        if(!phone || !address){
            alert('شماره موبایل و آدرس لازم است');
            return;
        }

        fetch('/addresses/store', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify({phone: phone, address: address})
        })
        .then(res => res.json())
        .then(data => {
            if(data.id){
                addressSelect.innerHTML = `<option value="${data.id}">${data.address}</option>`;
                addressSelect.value = data.id;
                addressGroup.style.display = 'block';
                newAddressGroup.style.display = 'none';
                newAddressSavedId = data.id;
                alert('آدرس جدید ثبت شد، حالا می‌توانید سفارش را نهایی کنید.');
            } else {
                alert('خطا در ثبت آدرس');
            }
        });
    });

    // ثبت نهایی سفارش
    checkoutForm.addEventListener('submit', function(e){
        e.preventDefault();

        if(Object.keys(cart).length === 0){
            alert('سبد خرید خالی است');
            return;
        }

        const selectedAddress = addressGroup.style.display === 'block' ? addressSelect.value : newAddressSavedId;
        if(!selectedAddress){
            alert('لطفاً آدرس را انتخاب یا ثبت کنید');
            return;
        }

        const payload = {
            phone: phoneInput.value.trim(),
            cart: cart,
            address_id: selectedAddress,
            total_price: total
        };

        fetch('{{ route("order.submit") }}', {
            method:'POST',
            headers:{
                'Content-Type':'application/json',
                'X-CSRF-TOKEN':'{{ csrf_token() }}'
            },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(data => {
            if(data.success){
                alert(`سفارش شما با شماره ${data.order_id} به مبلغ ${total.toLocaleString()} تومان ثبت شد و در حال پیگیری است.`);
                localStorage.removeItem('cart');
                window.location.href = '/';
            } else {
                alert('خطا در ثبت سفارش');
            }
        })
        .catch(err => {
            console.error(err);
            alert('خطا در ثبت سفارش');
        });
    });

});
</script>
</body>
</html>


