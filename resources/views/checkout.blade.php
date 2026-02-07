<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ثبت سفارش</title>
<style>
body { font-family: Vazirmatn, sans-serif; padding: 20px; }
.cart-item { display:flex; justify-content: space-between; padding:10px 0; border-bottom:1px solid #ddd; }
.total { font-weight:bold; font-size:18px; margin-top:20px; }
.form-group { margin-bottom:15px; display:flex; flex-direction:column; }
input, select, button { padding:10px; border-radius:5px; border:1px solid #ccc; width:100%; box-sizing:border-box; }
button { background:#27ae60; color:white; border:none; cursor:pointer; }
#newAddressGroup { display:none; margin-top:10px; }
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