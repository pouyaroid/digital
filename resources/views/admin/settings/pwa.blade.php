@extends("admin.layouts.app")

@section('content')

<div class="theme-builder">

    <div class="theme-header">
        <h2>📱 تنظیمات PWA</h2>
        <p>تنظیمات نصب برنامه روی موبایل و دسکتاپ</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-3">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/settings') }}">
        @csrf

        <div class="builder-grid">

            <div class="settings-panel">

                <div class="settings-group">
                    <h3>⚙️ تنظیمات عمومی</h3>

                    <div class="field">
                        <label>فعال بودن PWA</label>
                        <select name="pwa_enabled" class="form-control" style="direction: rtl; text-align: right;">
                            <option value="1" {{ setting('pwa_enabled',1)==1?'selected':'' }}>فعال</option>
                            <option value="0" {{ setting('pwa_enabled',1)==0?'selected':'' }}>غیرفعال</option>
                        </select>
                    </div>

                    <div class="field">
                        <label>نام برنامه</label>
                        <input class="form-control" type="text" value="{{ optional(\App\Models\CafeHeader::first())->cafe_name }}" readonly style="direction: rtl; text-align: right;">
                        <small>نام برنامه از اطلاعات کافه خوانده می‌شود.</small>
                    </div>

                    <div class="field">
                        <label>نام Pwa</label>
                        <input class="form-control" type="text" maxlength="12" name="pwa_short_name" value="{{ setting('pwa_short_name','Cafe') }}" style="direction: rtl; text-align: right;">
                    </div>

                    <div class="field">
                        <label>توضیحات</label>
                        <textarea class="form-control" rows="3" name="pwa_description" style="direction: rtl; text-align: right;">{{ setting('pwa_description','') }}</textarea>
                    </div>

                    <div class="field">
                        <label>Start URL</label>
                        <input class="form-control" type="text" name="pwa_start_url" value="{{ setting('pwa_start_url','/') }}" style="direction: ltr; text-align: left;">
                    </div>
                </div>

              
                <div class="settings-group">
                    <h3>📲 نمایش برنامه</h3>

                    <div class="field">
                        <label>Display</label>
                        <select class="form-control" name="pwa_display" style="direction: rtl; text-align: right;">
                            @foreach(['fullscreen', 'standalone', 'minimal-ui', 'browser'] as $display)
                                <option value="{{ $display }}" {{ setting('pwa_display','standalone')==$display?'selected':'' }}>
                                    {{ ucfirst($display) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button class="save-btn">
                    ذخیره تنظیمات
                </button>

            </div>

            <div class="preview-panel">
                <div class="preview-label">اطلاعات برنامه</div>
                <div class="preview-card">
                    <div class="preview-body">
                        <img width="100" src="{{ asset('storage/'.optional(\App\Models\CafeHeader::first())->logo) }}">
                        <h3>{{ optional(\App\Models\CafeHeader::first())->cafe_name }}</h3>
                        <p>{{ setting('pwa_description') }}</p>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>

@endsection