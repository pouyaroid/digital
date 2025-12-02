@extends("admin.layouts.app")

@section('content')
<div class="settings-container">
    <div class="settings-header">
        <h2>تنظیمات استایل سایت</h2>
        <p>ظاهر سایت را مطابق سلیقه خود شخصی‌سازی کنید</p>
    </div>

    <form method="POST" action="/admin/settings" class="settings-form">
        @csrf

        <!-- ناوبری -->
        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🎨</div>
                <h3>استایل ناوبری</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label>گرادینت دکمه فعال</label>
                    <div class="input-group">
                        <input type="text" name="nav_active_gradient" 
                               value="{{ old('nav_active_gradient', setting('nav_active_gradient', 'linear-gradient(135deg, #8d6e63, #a1887f)')) }}" 
                               class="form-control">
                        <div class="color-preview" style="background: {{ old('nav_active_gradient', setting('nav_active_gradient', 'linear-gradient(135deg, #8d6e63, #a1887f)')) }}"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>رنگ متن دکمه فعال</label>
                    <div class="input-group">
                        <input type="color" name="nav_active_text" 
                               value="{{ old('nav_active_text', setting('nav_active_text', '#ffffff')) }}" 
                               class="color-input">
                        <input type="text" value="{{ old('nav_active_text', setting('nav_active_text', '#ffffff')) }}" 
                               class="form-control color-text" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>رنگ متن دکمه‌ها</label>
                    <div class="input-group">
                        <input type="color" name="nav_btn_text" 
                               value="{{ old('nav_btn_text', setting('nav_btn_text', '#8d6e63')) }}" 
                               class="color-input">
                        <input type="text" value="{{ old('nav_btn_text', setting('nav_btn_text', '#8d6e63')) }}" 
                               class="form-control color-text" readonly>
                    </div>
                </div>
            </div>
        </div>

        <!-- هدر -->
        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🏷️</div>
                <h3>استایل هدر</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label>گرادینت هدر</label>
                    <div class="input-group">
                        <input type="text" name="header_banner_gradient" 
                               value="{{ old('header_banner_gradient', setting('header_banner_gradient', 'linear-gradient(135deg, #8d6e63 0%, #a1887f 50%, #bcaaa4 100%)')) }}" 
                               class="form-control">
                        <div class="color-preview" style="background: {{ old('header_banner_gradient', setting('header_banner_gradient', 'linear-gradient(135deg, #8d6e63 0%, #a1887f 50%, #bcaaa4 100%)')) }}"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- بدنه -->
        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">🖼️</div>
                <h3>استایل بدنه سایت</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label>گرادینت پس‌زمینه</label>
                    <div class="input-group">
                        <input type="text" name="body_background" 
                               value="{{ old('body_background', setting('body_background', 'linear-gradient(135deg, #f5f1eb 0%, #ff7700 50%, #d4b08c 100%)')) }}" 
                               class="form-control">
                        <div class="color-preview" style="background: {{ old('body_background', setting('body_background', 'linear-gradient(135deg, #f5f1eb 0%, #ff7700 50%, #d4b08c 100%)')) }}"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>رنگ متن</label>
                    <div class="input-group">
                        <input type="color" name="body_text_color" 
                               value="{{ old('body_text_color', setting('body_text_color', '#3e2723')) }}" 
                               class="color-input">
                        <input type="text" value="{{ old('body_text_color', setting('body_text_color', '#3e2723')) }}" 
                               class="form-control color-text" readonly>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>فونت</label>
                    <input type="text" name="font_family" 
                           value="{{ old('font_family', setting('font_family', '\'Vazirmatn\', \'Tajawal\', \'Cairo\'')) }}" 
                           class="form-control" 
                           placeholder="مثال: 'Vazirmatn', 'Tajawal', 'Cairo'">
                </div>
            </div>
        </div>

        <!-- فوتر -->
        <div class="settings-card">
            <div class="card-header">
                <div class="header-icon">📋</div>
                <h3>استایل فوتر</h3>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label>گرادینت فوتر</label>
                    <div class="input-group">
                        <input type="text" name="footer_gradient" 
                               value="{{ old('footer_gradient', setting('footer_gradient', 'linear-gradient(135deg, #ff4400 0%, #6d4c41 100%)')) }}" 
                               class="form-control">
                        <div class="color-preview" style="background: {{ old('footer_gradient', setting('footer_gradient', 'linear-gradient(135deg, #ff4400 0%, #6d4c41 100%)')) }}"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label>رنگ متن فوتر</label>
                    <div class="input-group">
                        <input type="color" name="footer_text_color" 
                               value="{{ old('footer_text_color', setting('footer_text_color', '#000000')) }}" 
                               class="color-input">
                        <input type="text" value="{{ old('footer_text_color', setting('footer_text_color', '#000000')) }}" 
                               class="form-control color-text" readonly>
                    </div>
                </div>
            </div>
        </div>

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

<style>
/* استایل‌ها همان کد قبلی شما هستند */
.settings-container { max-width: 900px; margin:0 auto; padding:20px; direction:rtl; }
.settings-header { text-align:center; margin-bottom:30px; padding:20px; background:linear-gradient(135deg,#f8f9fa,#e9ecef); border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,0.05);}
.settings-header h2{font-size:28px; font-weight:700; color:#333; margin-bottom:8px;}
.settings-header p{color:#666; font-size:16px;}
.settings-card{background:white; border-radius:12px; box-shadow:0 4px 15px rgba(0,0,0,0.08); margin-bottom:25px; overflow:hidden; transition:transform 0.3s ease, box-shadow 0.3s ease;}
.settings-card:hover{transform:translateY(-3px); box-shadow:0 8px 25px rgba(0,0,0,0.12);}
.card-header{display:flex; align-items:center; padding:18px 20px; background:linear-gradient(135deg,#6c757d,#495057); color:white;}
.header-icon{font-size:24px; margin-left:15px;}
.card-header h3{font-size:18px; font-weight:600; margin:0;}
.card-body{padding:20px;}
.form-group{margin-bottom:20px;}
.form-group label{display:block; margin-bottom:8px; font-weight:500; color:#444; font-size:14px;}
.input-group{display:flex; align-items:center; border:1px solid #ddd; border-radius:8px; overflow:hidden; transition:border-color 0.3s ease;}
.input-group:focus-within{border-color:#8d6e63; box-shadow:0 0 0 3px rgba(141,110,99,0.2);}
.form-control{flex:1; border:none; padding:12px 15px; font-size:14px; background:transparent; outline:none;}
.color-input{width:50px; height:50px; border:none; cursor:pointer; background:transparent;}
.color-text{width:100px; text-align:center; font-family:monospace; font-size:13px;}
.color-preview{width:50px; height:50px; border-left:1px solid #eee;}
.form-actions{display:flex; justify-content:center; gap:15px; margin-top:30px;}
.btn{display:flex; align-items:center; justify-content:center; padding:12px 25px; border:none; border-radius:8px; font-size:16px; font-weight:500; cursor:pointer; transition:all 0.3s ease; min-width:160px;}
.btn-icon{margin-left:8px; font-size:18px;}
.btn-primary{background:linear-gradient(135deg,#8d6e63,#a1887f); color:white; box-shadow:0 4px 10px rgba(141,110,99,0.3);}
.btn-primary:hover{transform:translateY(-2px); box-shadow:0 6px 15px rgba(141,110,99,0.4);}
.btn-secondary{background:#f8f9fa; color:#495057; border:1px solid #dee2e6;}
.btn-secondary:hover{background:#e9ecef; transform:translateY(-2px);}
@media (max-width:768px){.settings-container{padding:15px;}.settings-header h2{font-size:24px;}.card-header{padding:15px;}.card-body{padding:15px;}.form-actions{flex-direction:column; align-items:center;}.btn{width:100%; max-width:300px;}}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // همگام‌سازی رنگ‌ها و نمایش آنها
    const colorInputs = document.querySelectorAll('.color-input');
    
    colorInputs.forEach(input => {
        input.addEventListener('input', function() {
            const textInput = this.nextElementSibling;
            textInput.value = this.value;
        });
    });
    
    // پیش‌نمایش گرادینت‌ها
    const gradientInputs = document.querySelectorAll('input[type="text"]');
    
    gradientInputs.forEach(input => {
        if (input.name.includes('gradient')) {
            input.addEventListener('input', function() {
                const preview = this.nextElementSibling;
                if (preview && preview.classList.contains('color-preview')) {
                    preview.style.background = this.value;
                }
            });
        }
    });
});
</script>
@endsection
