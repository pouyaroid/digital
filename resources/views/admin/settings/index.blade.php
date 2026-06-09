@extends("admin.layouts.app")

@section('content')

<!-- استایل‌های مخصوص این صفحه (اصلاح شده برای ریسپانسیو بهتر) -->
<style>
    @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css');

    :root {
        --radius: 16px;
        --bg-admin: #f3f4f6;
    }

    body {
        font-family: 'Vazirmatn', sans-serif;
        background-color: var(--bg-admin);
        margin: 0; /* حذف مارجین پیش‌فرض بدن برای نمایش بهتر موبایل */
    }

    .theme-builder {
        max-width: 1200px;
        margin: auto;
        padding: 20px;
    }

    .theme-header {
        margin-bottom: 30px;
        text-align: center;
    }
    .theme-header h2 { margin: 0; color: #333; font-size: 1.5rem; }
    .theme-header p { margin: 5px 0 0; color: #666; font-size: 0.9rem; }

    .builder-grid {
        display: grid;
        grid-template-columns: 1fr 400px; /* دسکتاپ: تنظیمات (اتوماتیک) | پیش‌نمایش (۴۰۰ پیکسل) */
        gap: 30px;
        align-items: start;
    }

    /* --- پنل تنظیمات --- */
    .settings-panel {
        background: #fff;
        padding: 25px;
        border-radius: var(--radius);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }

    .settings-group {
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
    }
    .settings-group:last-child { border-bottom: none; }

    .settings-group h3 {
        font-size: 1.1rem;
        margin-bottom: 15px;
        color: #111;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .field {
        margin-bottom: 20px;
    }
    .field label {
        display: block;
        margin-bottom: 8px;
        font-size: 0.9rem;
        color: #555;
        font-weight: 600;
    }

    .color-row {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f9fafb;
        padding: 5px;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }

    input[type="color"] {
        -webkit-appearance: none;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 8px;
        cursor: pointer;
        background: none;
        flex-shrink: 0; /* جلوگیری از کوچک شدن رنگ‌پیکر */
    }
    input[type="color"]::-webkit-color-swatch-wrapper { padding: 0; }
    input[type="color"]::-webkit-color-swatch { border: none; border-radius: 6px; }

    input[type="text"] {
        flex: 1;
        border: none;
        background: transparent;
        font-family: monospace;
        direction: ltr;
        text-align: left;
        font-size: 0.9rem;
        color: #333;
        min-width: 0; /* جلوگیری از overflow در فلکس */
    }
    
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 10px;
        font-family: monospace;
        font-size: 0.85rem;
        direction: ltr;
    }

    .save-btn {
        width: 100%;
        padding: 15px;
        background: #222;
        color: #fff;
        border: none;
        border-radius: 12px;
        font-size: 1rem;
        font-weight: bold;
        cursor: pointer;
        transition: 0.2s;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
    }
    .save-btn:hover { background: #000; }
    .save-btn:disabled { opacity: 0.7; cursor: wait; }

    /* --- پنل پیش‌نمایش --- */
    .preview-panel {
        position: sticky;
        top: 20px;
    }

    .preview-label {
        text-align: center;
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #888;
        background: rgba(255,255,255,0.5);
        padding: 5px;
        border-radius: 20px;
    }

    .preview-card {
        border-radius: var(--radius);
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        overflow: hidden;
        min-height: 500px; /* ارتفاع دسکتاپ */
        display: flex;
        flex-direction: column;
        transition: background 0.3s ease;
        position: relative;
    }

    .preview-header {
        padding: 25px;
        text-align: center;
        color: #fff;
        font-size: 1.1rem;
        font-weight: bold;
        transition: background 0.3s ease;
    }

    .preview-body {
        padding: 30px;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .pv-heading { margin-bottom: 10px; transition: color 0.3s; font-size: 1.4rem; }
    .pv-text { margin-bottom: 25px; line-height: 1.6; transition: color 0.3s; max-width: 90%; font-size: 0.95rem; }
    .pv-muted { font-size: 0.85rem; margin-top: 15px; transition: color 0.3s; }

    .pv-btn {
        padding: 12px 30px;
        border: none;
        border-radius: 12px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
        transition: all 0.3s;
        font-family: inherit;
    }

    /* Toast Message */
    .toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #10B981;
        color: white;
        padding: 15px 25px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transform: translateY(150%);
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        z-index: 1000;
        font-weight: bold;
        right: 50%;
        transform: translateX(50%) translateY(150%); /* وسط چین کردن در موبایل */
    }
    @media(min-width: 768px) {
        .toast {
            right: 20px;
            transform: translateY(150%); /* حالت عادی دسکتاپ */
        }
    }
    .toast.show { 
        bottom: 30px;
        transform: translateX(50%) translateY(0);
    }
    @media(min-width: 768px) {
        .toast.show {
            transform: translateY(0);
        }
    }

    /* --- ریسپانسیو (اصلاحات اصلی) --- */
    
    /* 1. تبلت و لپ‌تاپ کوچک */
    @media (max-width: 1024px) {
        .builder-grid {
            grid-template-columns: 1fr 320px; /* کاهش عرض پیش‌نمایش */
            gap: 20px;
        }
        .theme-builder {
            padding: 15px;
        }
    }

    /* 2. موبایل */
    @media (max-width: 768px) {
        .builder-grid {
            grid-template-columns: 1fr; /* تک ستون */
            gap: 20px;
        }

        /* پیش‌نمایش بالا قرار می‌گیرد */
        .preview-panel {
            position: static;
            order: -1; /* بالا آوردن */
            margin-bottom: 10px;
        }

        .preview-card {
            min-height: 350px; /* کاهش ارتفاع پیش‌نمایش در موبایل */
            border-radius: 12px;
        }

        .preview-header { padding: 15px; font-size: 1rem; }
        .preview-body { padding: 20px; }
        .pv-heading { font-size: 1.2rem; }
        .pv-btn { padding: 10px 20px; font-size: 0.9rem; }

        /* تنظیمات */
        .settings-panel {
            padding: 20px;
            border-radius: 12px;
        }
        
        .field {
            margin-bottom: 15px;
        }

        .theme-header h2 { font-size: 1.3rem; }
    }

</style>

<div class="theme-builder">

    <div class="theme-header">
        <h2>🎨 تنظیمات ظاهری سایت</h2>
        <p>تغییرات را به صورت زنده مشاهده و سپس ذخیره کنید</p>
    </div>

    <form id="themeForm" method="POST" action="/admin/settings">
        @csrf

        <div class="builder-grid">

            {{-- پنل تنظیمات --}}
            <div class="settings-panel">

                <!-- رنگ‌های اصلی -->
                <div class="settings-group">
                    <h3>🎨 رنگ‌های اصلی</h3>

                    <div class="field">
                        <label>رنگ برند (Primary)</label>
                        <div class="color-row">
                            <input type="color" id="inp_brand_color" name="brand_color" value="{{ setting('brand_color','#FF5722') }}">
                            <input type="text" id="txt_brand_color" value="{{ setting('brand_color','#FF5722') }}" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>رنگ پس‌زمینه (Background)</label>
                        <div class="color-row">
                            <input type="color" id="inp_bg" name="bg" value="{{ setting('bg','#F7F3EE') }}">
                            <input type="text" id="txt_bg" value="{{ setting('bg','#F7F3EE') }}" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>رنگ Surface (کارت‌ها)</label>
                        <div class="color-row">
                            <input type="color" id="inp_surface_color" name="surface_color" value="{{ setting('surface_color','#FFFFFF') }}">
                            <input type="text" id="txt_surface_color" value="{{ setting('surface_color','#FFFFFF') }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- رنگ‌های متون -->
                <div class="settings-group">
                    <h3>📝 رنگ متون</h3>

                    <div class="field">
                        <label>عنوان (Heading)</label>
                        <div class="color-row">
                            <input type="color" id="inp_text_h" name="text_h" value="{{ setting('text_h','#1A1208') }}">
                            <input type="text" id="txt_text_h" value="{{ setting('text_h','#1A1208') }}" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>متن پررنگ (Bold)</label>
                        <div class="color-row">
                            <input type="color" id="inp_text_b" name="text_b" value="{{ setting('text_b','#4A3F34') }}">
                            <input type="text" id="txt_text_b" value="{{ setting('text_b','#4A3F34') }}" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>متن معمولی (Muted)</label>
                        <div class="color-row">
                            <input type="color" id="inp_text_m" name="text_m" value="{{ setting('text_m','#8C7B6A') }}">
                            <input type="text" id="txt_text_m" value="{{ setting('text_m','#8C7B6A') }}" readonly>
                        </div>
                    </div>

                    <div class="field">
                        <label>متن کم‌رنگ (Light)</label>
                        <div class="color-row">
                            <input type="color" id="inp_text_l" name="text_l" value="{{ setting('text_l','#B8A898') }}">
                            <input type="text" id="txt_text_l" value="{{ setting('text_l','#B8A898') }}" readonly>
                        </div>
                    </div>
                </div>

                <!-- مقادیر پیشرفته -->
                <div class="settings-group">
                    <h3>✨ افکت‌ها</h3>

                    <div class="field">
                        <label>سایه دکمه/برند (Shadow)</label>
                        <input type="text" id="inp_shadow" name="shadow_brand" class="form-control"
                               value="{{ setting('shadow_brand','0 8px 24px rgba(255,87,34,0.35)') }}">
                    </div>

                    <div class="field">
                        <label>رنگ هاور (Surface Hover)</label>
                        <input type="text" id="inp_hover" name="surface_hover" class="form-control"
                               value="{{ setting('surface_hover','rgba(255,255,255,0.88)') }}">
                    </div>

                    <div class="field">
                        <label>Glass Border 1</label>
                        <input type="text" id="inp_glass1" name="glass_border" class="form-control"
                               value="{{ setting('glass_border','rgba(255,255,255,0.9)') }}">
                    </div>

                    <div class="field">
                        <label>Glass Border 2</label>
                        <input type="text" id="inp_glass2" name="glass_border2" class="form-control"
                               value="{{ setting('glass_border2','rgba(0,0,0,0.06)') }}">
                    </div>
                </div>

                <button type="submit" class="save-btn" id="saveBtn">
                    ذخیره تنظیمات
                </button>

            </div>

            {{-- پنل پیش‌نمایش --}}
            <div class="preview-panel">
                <div class="preview-label">پیش‌نمایش زنده</div>
                
                <div class="preview-card" id="previewCard">
                    
                    <div class="preview-header" id="prevHeader">
                        هدر سایت
                    </div>

                    <div class="preview-body">

                        <h3 class="pv-heading" id="prevHeading">
                            عنوان نمونه سایت
                        </h3>

                        <p class="pv-text" id="prevText">
                            این یک متن نمونه است تا بتوانید کنتراست و خوانایی متون را با رنگ پس‌زمینه بررسی کنید.
                        </p>

                        <button class="pv-btn" id="prevBtn">
                            دکمه اکشن
                        </button>
                        
                        <p class="pv-muted" id="prevMuted">
                            متن کم‌رنگ (کپشن یا تاریخ)
                        </p>

                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<div class="toast" id="toast">تنظیمات با موفقیت ذخیره شد! ✓</div>

<script>
    // --- کدهای قبلی (همگام‌سازی رنگ‌ها و آپدیت پیش‌نمایش) بدون تغییر باقی می‌ماند ---
    
    function updatePreview() {
        const brandColor = document.getElementById('inp_brand_color').value;
        const bgColor = document.getElementById('inp_bg').value;
        const headingColor = document.getElementById('inp_text_h').value;
        const textColor = document.getElementById('inp_text_m').value;
        const boldColor = document.getElementById('inp_text_b').value;
        const lightColor = document.getElementById('inp_text_l').value;
        const shadow = document.getElementById('inp_shadow').value;
        const hoverColor = document.getElementById('inp_hover').value;
        const glassBorder2 = document.getElementById('inp_glass2').value;

        const previewCard = document.getElementById('previewCard');
        previewCard.style.backgroundColor = bgColor;
        previewCard.style.borderColor = glassBorder2;

        const prevHeader = document.getElementById('prevHeader');
        prevHeader.style.backgroundColor = brandColor;

        document.getElementById('prevHeading').style.color = headingColor;
        document.getElementById('prevText').style.color = textColor;
        document.getElementById('prevMuted').style.color = lightColor;

        const prevBtn = document.getElementById('prevBtn');
        prevBtn.style.backgroundColor = brandColor;
        prevBtn.style.boxShadow = shadow;

        previewCard.onmouseenter = function() {
            this.style.backgroundColor = hoverColor;
        };
        previewCard.onmouseleave = function() {
            this.style.backgroundColor = bgColor;
        };
    }

    document.querySelectorAll('input[type="color"]').forEach(input => {
        input.addEventListener('input', function() {
            const textInput = this.parentElement.querySelector('input[type="text"]');
            if(textInput) textInput.value = this.value.toUpperCase();
            updatePreview();
        });
    });

    document.querySelectorAll('input[type="text"]').forEach(input => {
        input.addEventListener('input', updatePreview);
    });

    // --- تابع نمایش پیام موفقیت ---
    function showToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('show');
        setTimeout(() => toast.classList.remove('show'), 3000);
    }

    // --- مدیریت ارسال فرم (اصلاح شده) ---
    const form = document.getElementById('themeForm');
    const saveBtn = document.getElementById('saveBtn');

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        saveBtn.disabled = true;
        saveBtn.innerHTML = 'در حال ذخیره...';

        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            }
        })
        .then(response => {
            if (response.ok || response.redirected) {
                showToast();
            } else {
                alert('خطا در پردازش اطلاعات روی سرور');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('خطا در ارتباط با سرور');
        })
        .finally(() => {
            saveBtn.disabled = false;
            saveBtn.innerHTML = 'ذخیره تنظیمات';
        });
    });

    document.addEventListener('DOMContentLoaded', updatePreview);

</script>

@endsection