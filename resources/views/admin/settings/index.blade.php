@extends("admin.layouts.app")

@section('content')

<!-- استایل‌های مخصوص این صفحه (اصلاح شده برای ریسپانسیو بهتر) -->
<style>
    @import url('https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css');

   

    
    

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