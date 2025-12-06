@extends("admin.layouts.app")

@section('content')
<div class="settings-container">
    <div class="settings-header">
        <h2>تنظیمات استایل سایت</h2>
        <p>ظاهر سایت را مطابق سلیقه خود شخصی‌سازی کنید</p>
    </div>

    <form method="POST" action="/admin/settings" class="settings-form">
        @csrf


        <!-- ========================================================= -->
        <!-- ✅ 1. استایل ناوبری -->
        <!-- ========================================================= -->

        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🎨</div>
                <h3>استایل ناوبری</h3>
            </div>
            <div class="card-body">

                <!-- گرادیانت دکمه فعال -->
                <div class="form-group gradient-builder">
                    <label>گرادینت دکمه فعال</label>

                    <div class="gradient-controls">
                        <label>زاویه گرادینت</label>
                        <input type="number" class="gradient-angle" value="135" min="0" max="360">
                    </div>

                    <div class="gradient-colors">
                        <input type="color" class="gcolor" value="#8d6e63">
                        <input type="color" class="gcolor" value="#a1887f">
                        <input type="color" class="gcolor" value="#bcaaa4">
                    </div>

                    <div class="input-group">
                        <input type="text" name="nav_active_gradient"
                               class="form-control gradient-output"
                               value="{{ old('nav_active_gradient', setting('nav_active_gradient')) }}">
                        <div class="color-preview"></div>
                    </div>
                </div>

                <!-- رنگ متن دکمه فعال -->
                <div class="form-group">
                    <label>رنگ متن دکمه فعال</label>
                    <div class="input-group">
                        <input type="color" name="nav_active_text"
                               value="{{ old('nav_active_text', setting('nav_active_text', '#ffffff')) }}"
                               class="color-input">
                        <input type="text"
                               value="{{ old('nav_active_text', setting('nav_active_text', '#ffffff')) }}"
                               class="form-control color-text" readonly>
                    </div>
                </div>

                <!-- رنگ متن دکمه‌ها -->
                <div class="form-group">
                    <label>رنگ متن دکمه‌ها</label>
                    <div class="input-group">
                        <input type="color" name="nav_btn_text"
                               value="{{ old('nav_btn_text', setting('nav_btn_text', '#8d6e63')) }}"
                               class="color-input">
                        <input type="text"
                               value="{{ old('nav_btn_text', setting('nav_btn_text', '#8d6e63')) }}"
                               class="form-control color-text" readonly>
                    </div>
                </div>

            </div>
        </div>




        <!-- ========================================================= -->
        <!-- ✅ 2. استایل هدر -->
        <!-- ========================================================= -->

        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🏷️</div>
                <h3>استایل هدر</h3>
            </div>
            <div class="card-body">

                <!-- گرادیانت هدر -->
                <div class="form-group gradient-builder">
                    <label>گرادینت هدر</label>

                    <div class="gradient-controls">
                        <label>زاویه گرادینت</label>
                        <input type="number" class="gradient-angle" value="135" min="0" max="360">
                    </div>

                    <div class="gradient-colors">
                        <input type="color" class="gcolor" value="#8d6e63">
                        <input type="color" class="gcolor" value="#a1887f">
                        <input type="color" class="gcolor" value="#bcaaa4">
                    </div>

                    <div class="input-group">
                        <input type="text" name="header_banner_gradient"
                               class="form-control gradient-output"
                               value="{{ old('header_banner_gradient', setting('header_banner_gradient')) }}">
                        <div class="color-preview"></div>
                    </div>
                </div>

            </div>
        </div>





        <!-- ========================================================= -->
        <!-- ✅ 3. استایل بدنه -->
        <!-- ========================================================= -->

        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🖼️</div>
                <h3>استایل بدنه سایت</h3>
            </div>
            <div class="card-body">

                <!-- گرادیانت بدنه -->
                <div class="form-group gradient-builder">
                    <label>گرادینت پس‌زمینه</label>

                    <div class="gradient-controls">
                        <label>زاویه گرادینت</label>
                        <input type="number" class="gradient-angle" value="135" min="0" max="360">
                    </div>

                    <div class="gradient-colors">
                        <input type="color" class="gcolor" value="#f5f1eb">
                        <input type="color" class="gcolor" value="#ff7700">
                        <input type="color" class="gcolor" value="#d4b08c">
                    </div>

                    <div class="input-group">
                        <input type="text" name="body_background"
                               class="form-control gradient-output"
                               value="{{ old('body_background', setting('body_background')) }}">
                        <div class="color-preview"></div>
                    </div>
                </div>

                <!-- رنگ متن -->
                <div class="form-group">
                    <label>رنگ متن</label>
                    <div class="input-group">
                        <input type="color" name="body_text_color"
                               value="{{ old('body_text_color', setting('body_text_color', '#3e2723')) }}"
                               class="color-input">
                        <input type="text"
                               value="{{ old('body_text_color', setting('body_text_color', '#3e2723')) }}"
                               class="form-control color-text" readonly>
                    </div>
                </div>

                <!-- فونت -->
                <div class="form-group">
                    <label>فونت</label>
                    <input type="text" name="font_family"
                           value="{{ old('font_family', setting('font_family', '\'Vazirmatn\', \'Tajawal\', \'Cairo\'')) }}"
                           class="form-control"
                           placeholder="مثال: 'Vazirmatn', 'Tajawal', 'Cairo'">
                </div>

            </div>
        </div>




        <!-- ========================================================= -->
        <!-- ✅ 4. استایل فوتر -->
        <!-- ========================================================= -->

        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">📋</div>
                <h3>استایل فوتر</h3>
            </div>
            <div class="card-body">

                <!-- گرادیانت فوتر -->
                <div class="form-group gradient-builder">
                    <label>گرادینت فوتر</label>

                    <div class="gradient-controls">
                        <label>زاویه گرادینت</label>
                        <input type="number" class="gradient-angle" value="135" min="0" max="360">
                    </div>

                    <div class="gradient-colors">
                        <input type="color" class="gcolor" value="#ff4400">
                        <input type="color" class="gcolor" value="#6d4c41">
                        <input type="color" class="gcolor" value="#3e2723">
                    </div>

                    <div class="input-group">
                        <input type="text" name="footer_gradient"
                               class="form-control gradient-output"
                               value="{{ old('footer_gradient', setting('footer_gradient')) }}">
                        <div class="color-preview"></div>
                    </div>
                </div>

                <!-- رنگ متن فوتر -->
                <div class="form-group">
                    <label>رنگ متن فوتر</label>
                    <div class="input-group">
                        <input type="color" name="footer_text_color"
                               value="{{ old('footer_text_color', setting('footer_text_color', '#000000')) }}"
                               class="color-input">
                        <input type="text"
                               value="{{ old('footer_text_color', setting('footer_text_color', '#000000')) }}"
                               class="form-control color-text" readonly>
                    </div>
                </div>

            </div>
        </div>



        <!-- دکمه‌ها -->
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                <span class="btn-icon">💾</span>
                ذخیره تنظیمات
            </button>
            <button type="reset" class="btn btn-secondary">
                <span class="btn-icon">🔄</span>
                بازنشانی
            </button>
        </div>

    </form>
</div>





<!-- ========================================================= -->
<!-- 🎨 استایل‌ها -->
<!-- ========================================================= -->
<style>
.settings-container { max-width: 900px; margin:0 auto; padding:20px; direction:rtl; }
.settings-header { text-align:center; margin-bottom:30px; padding:20px; background:linear-gradient(135deg,#f8f9fa,#e9ecef); border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.05); }
.settings-header h2{ font-size:28px; font-weight:700; color:#333; margin-bottom:8px; }
.settings-header p{ color:#666; font-size:16px; }

.settings-card{ background:white; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); margin-bottom:25px; overflow:hidden; transition:0.3s; }
.settings-card:hover{ transform:translateY(-3px); box-shadow:0 8px 25px rgba(0,0,0,0.12); }

.card-header{ display:flex; align-items:center; padding:18px 20px; background:linear-gradient(135deg,#6c757d,#495057); color:white; }
.header-icon{ font-size:24px; margin-left:15px; }
.card-body{ padding:20px; }

.form-group{ margin-bottom:25px; }
.input-group{ display:flex; align-items:center; border:1px solid #ddd; border-radius:8px; overflow:hidden; }
.form-control{ flex:1; border:none; padding:12px; background:transparent; }
.color-preview{ width:60px; height:50px; border-left:1px solid #eee; }

.color-input{ width:50px; height:50px; border:none; cursor:pointer; }
.color-text{ width:120px; text-align:center; font-family:monospace; }

.form-actions{ display:flex; justify-content:center; gap:15px; margin-top:30px; }
.btn{ padding:12px 25px; border-radius:8px; cursor:pointer; font-size:16px; }

.gradient-builder { background:#fafafa; padding:15px; border-radius:10px; border:1px solid #eee; }
.gradient-colors{ display:flex; gap:10px; margin:10px 0; }
.gradient-colors input{ width:50px; height:50px; border-radius:8px; }
.gradient-controls{ margin-bottom:10px; }
.gradient-controls input{ width:90px; padding:8px; border-radius:8px; }

</style>




<!-- ========================================================= -->
<!-- 🔥 اسکریپت ساخت گرادیانت -->
<!-- ========================================================= -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    
        // تابع کمکی برای استخراج (angle, colors[]) از یک رشته linear-gradient
        function parseLinearGradient(str) {
            try {
                // نمونه‌هایی که می‌خواهیم پشتیبانی کنیم:
                // linear-gradient(135deg, #8d6e63 0%, #a1887f 50%, #bcaaa4 100%)
                // linear-gradient(180deg,#fff,#000)
                // linear-gradient(45deg, rgba(255,0,0,0.5) 0%, rgba(0,0,0,0.5) 100%)
    
                const re = /linear-gradient\s*\(\s*([0-9.+-]+)deg\s*,\s*(.+)\)/i;
                const m = str.match(re);
                if (!m) return null;
    
                const angle = m[1].trim();
                const colorsPart = m[2].trim();
    
                // تقسیم بر کاما اما مراقب پارانتزهای rgba(...) باش
                let parts = [];
                let cur = '';
                let depth = 0;
                for (let i = 0; i < colorsPart.length; i++) {
                    const ch = colorsPart[i];
                    if (ch === '(') depth++;
                    if (ch === ')') depth = Math.max(0, depth-1);
                    if (ch === ',' && depth === 0) {
                        parts.push(cur);
                        cur = '';
                    } else {
                        cur += ch;
                    }
                }
                if (cur.trim() !== '') parts.push(cur);
    
                // از هر قسمت رنگ را استخراج می‌کنیم (حذف درصدها و فاصله‌ها)
                const colors = parts.map(p => {
                    // اولین مقدار که شبیه #hex یا rgba(...) یا نام رنگ باشه را بگیر
                    const colorMatch = p.match(/(rgba?\([^\)]+\)|hsla?\([^\)]+\)|#[0-9a-fA-F]{3,8}|\b[a-zA-Z]+\b)/);
                    return colorMatch ? colorMatch[0].trim() : p.trim();
                }).filter(c => c !== '');
    
                return { angle, colors };
            } catch (e) {
                return null;
            }
        }
    
        // سازنده گرادیانت از angle و colors
        function buildLinearGradient(angle, colors) {
            return `linear-gradient(${angle}deg, ${colors.join(', ')})`;
        }
    
        function updateGradient(builder) {
            const angleInput = builder.querySelector(".gradient-angle");
            const colorInputs = Array.from(builder.querySelectorAll(".gcolor"));
    
            const angle = angleInput ? angleInput.value : 135;
            const colors = colorInputs.map(c => c.value);
    
            const gradient = buildLinearGradient(angle, colors);
    
            const output = builder.querySelector(".gradient-output");
            const preview = builder.querySelector(".color-preview");
    
            if (output) output.value = gradient;
            if (preview) preview.style.background = gradient;
        }
    
        // برای هر builder: مقدار اولیه را از output.parse کن و مقداردهی کن
        document.querySelectorAll(".gradient-builder").forEach(builder => {
    
            const output = builder.querySelector(".gradient-output");
            const angleInput = builder.querySelector(".gradient-angle");
            const colorInputs = Array.from(builder.querySelectorAll(".gcolor"));
    
            // اگر مقدار ذخیره شده وجود دارد، تلاش کن آن را parse کنی
            if (output && output.value && output.value.trim() !== '') {
                const parsed = parseLinearGradient(output.value.trim());
                if (parsed) {
                    // زاویه را قرار بده (اگر ورودی زاویه داریم)
                    if (angleInput) angleInput.value = parsed.angle;
    
                    // رنگ‌ها را در color pickers قرار بده (تا سه رنگ)
                    parsed.colors.forEach((col, idx) => {
                        if (colorInputs[idx]) {
                            colorInputs[idx].value = col;
                        }
                    });
    
                    // اگر تعداد parsed colors کمتر یا بیشتر از گرافیک‌های موجود بود
                    // و colorInputs بیشتر هست، بقیه را بگذار روی اولین رنگ یا مقدار پیش‌فرض
                    if (parsed.colors.length < colorInputs.length) {
                        for (let i = parsed.colors.length; i < colorInputs.length; i++) {
                            colorInputs[i].value = parsed.colors[parsed.colors.length - 1] || colorInputs[i].value;
                        }
                    }
                } else {
                    // اگر parse نشد، حالت fallback: سعی کن خروجی را بازنویسی کنی
                    // (مهم تا preview و input ها با هم سینک شوند)
                    updateGradient(builder);
                }
            } else {
                // اگر خروجی خالیه، مقداردهی اولیه کن
                updateGradient(builder);
            }
    
            // event listeners برای هر input
            if (angleInput) {
                angleInput.addEventListener('input', function() {
                    updateGradient(builder);
                });
            }
    
            colorInputs.forEach(ci => {
                ci.addEventListener('input', function() {
                    updateGradient(builder);
                });
            });
    
        });
    
        // رنگ‌های ساده (برای متن‌ها) — همون قبلی
        document.querySelectorAll('.color-input').forEach(input => {
            input.addEventListener('input', function() {
                const next = this.nextElementSibling;
                if (next) next.value = this.value;
            });
        });
    
    });
    </script>
    

@endsection
