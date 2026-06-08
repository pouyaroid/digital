@extends("admin.layouts.app")

@section('content')
<div class="settings-container">

    <h2>تنظیمات استایل</h2>

    <form method="POST" action="/admin/settings">
        @csrf

        <!-- 🎨 Brand Color -->
        <div class="form-group">
            <label>رنگ برند (Primary)</label>

            <input type="color"
                   name="brand_color"
                   value="{{ old('brand_color', setting('brand_color', '#FF5722')) }}">

            <input type="text"
                   value="{{ old('brand_color', setting('brand_color', '#FF5722')) }}"
                   readonly>
        </div>

        <!-- 🎨 Surface Color -->
        <div class="form-group">
            <label>رنگ سطح (Surface)</label>

            <input type="color"
                   name="surface_color"
                   value="{{ old('surface_color', setting('surface_color', '#FFFFFF')) }}">

            <input type="text"
                   value="{{ old('surface_color', setting('surface_color', '#FFFFFF')) }}"
                   readonly>
        </div>
        <div class="form-group">
            <label>سایه برند (Shadow Brand)</label>
        
            <input type="text"
                   name="shadow_brand"
                   value="{{ old('shadow_brand', setting('shadow_brand', '0 8px 24px rgba(255,87,34,0.35)')) }}"
                   class="form-control">
        
            <small style="color:#666;">
                مثال: 0 8px 24px rgba(255,87,34,0.35)
            </small>
        </div>
        <div class="form-group">
            <label>رنگ عنوان‌ها (Text Heading)</label>
        
            <input type="color"
                   name="text_h"
                   value="{{ old('text_h', setting('text_h', '#1A1208')) }}">
        
            <input type="text"
                   value="{{ old('text_h', setting('text_h', '#1A1208')) }}"
                   readonly>
        </div>
        <div class="form-group">
            <label>رنگ متن معمولی (Text Muted)</label>
        
            <input type="color"
                   name="text_m"
                   value="{{ old('text_m', setting('text_m', '#8C7B6A')) }}">
        
            <input type="text"
                   value="{{ old('text_m', setting('text_m', '#8C7B6A')) }}"
                   readonly>
        </div>
        <div class="form-group">
            <label>رنگ پس‌زمینه سایت (Background)</label>
        
            <input type="color"
                   name="bg"
                   value="{{ old('bg', setting('bg', '#F7F3EE')) }}">
        
            <input type="text"
                   value="{{ old('bg', setting('bg', '#F7F3EE')) }}"
                   readonly>
        </div>
        <div class="form-group">
            <label>رنگ Surface Hover</label>
        
            <input type="text"
                   name="surface_hover"
                   value="{{ old('surface_hover', setting('surface_hover', 'rgba(255,255,255,0.88)')) }}"
                   class="form-control">
        
            <small style="color:#666;">
                مثال: rgba(255,255,255,0.88)
            </small>
        </div>
        <div class="form-group">
            <label>رنگ متن کم‌رنگ (Text Light)</label>
        
            <input type="color"
                   name="text_l"
                   value="{{ old('text_l', setting('text_l', '#B8A898')) }}">
        
            <input type="text"
                   value="{{ old('text_l', setting('text_l', '#B8A898')) }}"
                   readonly>
        </div>
        <div class="form-group">
            <label>Glass Border</label>
        
            <input type="text"
                   name="glass_border"
                   value="{{ old('glass_border', setting('glass_border', 'rgba(255,255,255,0.9)')) }}"
                   class="form-control">
        
            <small style="color:#666;">
                مثال: rgba(255,255,255,0.9)
            </small>
        </div>
        <div class="form-group">
            <label>Glass Border 2</label>
        
            <input type="text"
                   name="glass_border2"
                   value="{{ old('glass_border2', setting('glass_border2', 'rgba(0,0,0,0.06)')) }}"
                   class="form-control">
        
            <small style="color:#666;">
                مثال: rgba(0,0,0,0.06)
            </small>
        </div>
        
        

        <button type="submit">
            ذخیره
        </button>

    </form>

</div>
@endsection


<!-- ================= JS ================= -->
<script>
function updateShadow() {
    let color = document.getElementById('shadowColor').value;
    let opacity = document.getElementById('shadowOpacity').value;
    let blur = document.getElementById('shadowBlur').value;
    let y = document.getElementById('shadowY').value;

    let r = parseInt(color.substr(1,2),16);
    let g = parseInt(color.substr(3,2),16);
    let b = parseInt(color.substr(5,2),16);

    let rgba = `rgba(${r},${g},${b},${opacity})`;

    let shadow = `0 ${y}px ${blur}px ${rgba}`;

   
    document.getElementById('shadowOutput').value = shadow;

    // preview
    document.querySelector('.shadow-preview').style.boxShadow = shadow;
}

// event listeners
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.shadow-builder input').forEach(el => {
        el.addEventListener('input', updateShadow);
    });

    updateShadow();
});
</script>