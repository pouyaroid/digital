@extends('admin.layouts.app')

@section('content')

{{-- ==================================================================
     آیکن‌ها از کتابخانه Font Awesome 6 استفاده می‌شوند.
     اگر این کتابخانه از قبل در admin.layouts.app لود شده است،
     این تگ <link> را حذف کنید.
     ================================================================== --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

<style>
    /* ---------------- پنل انتخاب آیکن ---------------- */
    .icon-picker {
        display: none;
        position: absolute;
        width: 340px;
        max-width: calc(100vw - 2rem);
        background: rgba(17, 24, 39, .97);
        border: 1px solid rgba(255, 255, 255, .12);
        border-radius: 14px;
        padding: 12px;
        box-shadow: 0 12px 40px rgba(0, 0, 0, .45);
        z-index: 9999;
    }

    .icon-picker__search {
        width: 100%;
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        color: #e2e8f0;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 13px;
        outline: none;
        transition: border-color .15s ease;
    }

    .icon-picker__search::placeholder { color: #64748b; }
    .icon-picker__search:focus { border-color: #3b82f6; }

    .icon-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-top: 10px;
    }

    .icon-tabs button {
        background: rgba(255, 255, 255, .06);
        border: 1px solid rgba(255, 255, 255, .12);
        color: #cbd5e1;
        border-radius: 999px;
        padding: 4px 12px;
        font-size: 12px;
        cursor: pointer;
        transition: all .15s ease;
    }

    .icon-tabs button:hover { background: rgba(255, 255, 255, .14); }

    .icon-tabs button.active {
        background: #3b82f6;
        border-color: #3b82f6;
        color: #fff;
    }

    .icon-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 6px;
        max-height: 230px;
        overflow-y: auto;
        margin-top: 10px;
        padding-left: 4px;
    }

    .icon-grid::-webkit-scrollbar { width: 6px; }
    .icon-grid::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, .15);
        border-radius: 3px;
    }

    /* هر آیکن رنگ خودش را از متغیر --c (تعریف‌شده به‌صورت inline) می‌گیرد */
    .icon-item {
        --c: #3b82f6;
        aspect-ratio: 1 / 1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: var(--c);
        background: transparent;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 10px;
        cursor: pointer;
        transition: all .15s ease;
    }

    /* حالت هاور با رنگ خود آیکن (fallback برای مرورگرهای قدیمی) */
    .icon-item:hover {
        background: rgba(59, 130, 246, .22);
        border-color: #3b82f6;
        transform: translateY(-1px);
    }

    @supports (background: color-mix(in srgb, red 10%, transparent)) {
        .icon-item:hover {
            background: color-mix(in srgb, var(--c) 22%, transparent);
            border-color: var(--c);
        }
        .icon-item.selected {
            background: color-mix(in srgb, var(--c) 30%, transparent);
            border-color: var(--c);
        }
    }

    .icon-item.selected {
        background: rgba(59, 130, 246, .35);
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px color-mix(in srgb, var(--c) 35%, transparent);
    }

    .icon-empty {
        display: none;
        text-align: center;
        color: #94a3b8;
        font-size: 13px;
        padding: 18px 0 8px;
    }

    /* پیش‌نمایش آیکن داخل اینپوت */
    #iconField { cursor: pointer; }

    #iconPreview {
        position: absolute;
        top: 50%;
        left: 14px;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 18px;
    }
</style>

<h3 class="mb-4 text-center">مدیریت دسته‌بندی‌ها</h3>

@if(session('success'))
    <div class="alert alert-success glass-card p-2">{{ session('success') }}</div>
@endif

{{-- ==================================================================
     آرایه آیکن‌های قابل انتخاب (کتابخانه Font Awesome 6 - رایگان)
     ساختار هر آیکن:
        کلید آرایه = کلاس آیکن (همان مقداری که در دیتابیس ذخیره می‌شود)
        label      = برچسب فارسی برای جستجو و tooltip
        color      = رنگ اختصاصی آیکن (فقط برای نمایش، در دیتابیس ذخیره نمی‌شود)
     برای افزودن آیکن جدید فقط یک خط به آرایه اضافه کنید.
     لیست کامل آیکن‌های رایگان: fontawesome.com/icons?s=solid&o=r
     ================================================================== --}}
@php
    $iconGroups = [
        'food' => [
            'fa-solid fa-utensils'        => ['label' => 'رستوران، قاشق و چنگال، غذا', 'color' => '#f59e0b'],
            'fa-solid fa-burger'          => ['label' => 'برگر، همبرگر، فست فود',     'color' => '#fb923c'],
            'fa-solid fa-pizza-slice'     => ['label' => 'پیتزا',                     'color' => '#ef4444'],
            'fa-solid fa-hotdog'          => ['label' => 'هات داگ، سوسیس',            'color' => '#f97316'],
            'fa-solid fa-drumstick-bite'  => ['label' => 'مرغ، سوخاری، کباب',         'color' => '#d97706'],
            'fa-solid fa-bacon'           => ['label' => 'بیکن، گوشت',                'color' => '#fb7185'],
            'fa-solid fa-bowl-food'       => ['label' => 'غذای ایرانی، سوپ، آبگوشت',  'color' => '#ea580c'],
            'fa-solid fa-bowl-rice'       => ['label' => 'برنج، چلو، پلو',            'color' => '#fbbf24'],
            'fa-solid fa-plate-wheat'     => ['label' => 'سفره، ظرف غذا',             'color' => '#ca8a04'],
            'fa-solid fa-bread-slice'     => ['label' => 'نان، ساندویچ',              'color' => '#eab308'],
            'fa-solid fa-egg'             => ['label' => 'تخم مرغ، املت، صبحانه',     'color' => '#fde047'],
            'fa-solid fa-cheese'          => ['label' => 'پنیر، پیتزا',               'color' => '#facc15'],
            'fa-solid fa-fish'            => ['label' => 'ماهی',                      'color' => '#38bdf8'],
            'fa-solid fa-shrimp'          => ['label' => 'میگو، غذای دریایی',         'color' => '#fda4af'],
            'fa-solid fa-fish-fins'       => ['label' => 'غذای دریایی، ماهی',         'color' => '#22d3ee'],
            'fa-solid fa-pepper-hot'      => ['label' => 'فلفل، تند، ادویه',          'color' => '#dc2626'],
            'fa-solid fa-stroopwafel'     => ['label' => 'ویفر، شیرینی خشک',          'color' => '#b45309'],
            'fa-solid fa-mortar-pestle'   => ['label' => 'آشپزی، سس، ادویه',          'color' => '#92400e'],
            'fa-solid fa-bell-concierge'  => ['label' => 'سرویس، گارسون، رستوران',    'color' => '#fcd34d'],
        ],
        'fruit' => [
            'fa-solid fa-apple-whole'     => ['label' => 'سیب، میوه',                 'color' => '#f43f5e'],
            'fa-solid fa-lemon'           => ['label' => 'لیمو، ترشیجات، مرکبات',     'color' => '#facc15'],
            'fa-solid fa-carrot'          => ['label' => 'هویج، سبزیجات',             'color' => '#f97316'],
            'fa-solid fa-leaf'            => ['label' => 'سالاد، سبزیجات',            'color' => '#4ade80'],
            'fa-solid fa-seedling'        => ['label' => 'گیاهی، وگانی',              'color' => '#34d399'],
            'fa-solid fa-wheat-awn'       => ['label' => 'گندم، آرد، نان',            'color' => '#ca8a04'],
        ],
        'dessert' => [
            'fa-solid fa-ice-cream'       => ['label' => 'بستنی',                     'color' => '#f9a8d4'],
            'fa-solid fa-cake'            => ['label' => 'کیک',                       'color' => '#f472b6'],
            'fa-solid fa-cake-candles'    => ['label' => 'کیک تولد، جشن',             'color' => '#ec4899'],
            'fa-solid fa-cookie'          => ['label' => 'کوکی',                      'color' => '#d99a5b'],
            'fa-solid fa-cookie-bite'     => ['label' => 'شیرینی، کوکی',              'color' => '#c47d3b'],
            'fa-solid fa-candy-cane'      => ['label' => 'آب نبات، شیرینی',           'color' => '#e11d48'],
            'fa-solid fa-jar'             => ['label' => 'مربا، شیشه',                'color' => '#fb923c'],
        ],
        'drink' => [
            'fa-solid fa-mug-hot'              => ['label' => 'قهوه، نوشیدنی گرم',    'color' => '#a16207'],
            'fa-solid fa-mug-saucer'           => ['label' => 'چای، فنجان',           'color' => '#65a30d'],
            'fa-solid fa-glass-water'          => ['label' => 'آب، لیوان',            'color' => '#60a5fa'],
            'fa-solid fa-bottle-water'         => ['label' => 'آب معدنی، بطری',       'color' => '#06b6d4'],
            'fa-solid fa-wine-glass'           => ['label' => 'شراب، جام',            'color' => '#be123c'],
            'fa-solid fa-wine-bottle'          => ['label' => 'بطری شراب',            'color' => '#9f1239'],
            'fa-solid fa-martini-glass-citrus' => ['label' => 'کوکتیل، موهیتو',       'color' => '#84cc16'],
            'fa-solid fa-martini-glass-empty'  => ['label' => 'کوکتیل',               'color' => '#2dd4bf'],
            'fa-solid fa-champagne-glasses'    => ['label' => 'شامپاین، جشن',         'color' => '#eab308'],
            'fa-solid fa-whiskey-glass'        => ['label' => 'ویسکی',                'color' => '#b45309'],
            'fa-solid fa-beer-mug-empty'       => ['label' => 'آبجو، بیر',            'color' => '#f59e0b'],
        ],
        'general' => [
            'fa-solid fa-store'           => ['label' => 'فروشگاه، مغازه',            'color' => '#6366f1'],
            'fa-solid fa-basket-shopping' => ['label' => 'سبد خرید',                  'color' => '#fb923c'],
            'fa-solid fa-star'            => ['label' => 'ویژه، محبوب، ستاره',        'color' => '#facc15'],
            'fa-solid fa-fire'            => ['label' => 'داغ، پیشنهاد ویژه',         'color' => '#f97316'],
            'fa-solid fa-heart'           => ['label' => 'محبوب، علاقه مندی',         'color' => '#ef4444'],
            'fa-solid fa-gift'            => ['label' => 'هدیه، پک ویژه',             'color' => '#ec4899'],
        ],
    ];

    $iconGroupTitles = [
        'food'    => 'غذا',
        'fruit'   => 'میوه و سبزیجات',
        'dessert' => 'دسر و شیرینی',
        'drink'   => 'نوشیدنی',
        'general' => 'عمومی',
    ];

    /* جدول جستجو: کلاس آیکن → رنگ (برای رنگی نمایش دادن آیکن در جدول دسته‌ها) */
    $iconColors = [];
    foreach ($iconGroups as $groupIcons) {
        foreach ($groupIcons as $class => $info) {
            $iconColors[$class] = $info['color'];
        }
    }
@endphp

{{-- ============================ فرم افزودن دسته ============================ --}}
<form method="POST" class="glass-card p-4 mb-4">
    @csrf
    <div class="row g-3">
        <div class="col-md-4">
            <label class="form-label">نام دسته‌بندی</label>
            <input type="text" name="name" class="form-control glass-input">
        </div>

        <div class="col-md-4">
            <label class="form-label">آیکن (Font Awesome)</label>
            <div id="iconField" class="position-relative" title="برای انتخاب آیکن کلیک کنید">
                <input type="text"
                       id="iconInput"
                       name="icon"
                       class="form-control glass-input"
                       value="fa-solid fa-utensils"
                       readonly
                       style="padding-left:44px;">
                <i id="iconPreview"
                   class="fa-solid fa-utensils"
                   style="color: {{ $iconColors['fa-solid fa-utensils'] }};"></i>
            </div>
            <div class="form-text mt-1">برای انتخاب آیکن، روی کادر بالا کلیک کنید</div>
        </div>

        <div class="col-md-4">
            <label class="form-label">ترتیب نمایش</label>
            <input type="number" name="order" class="form-control glass-input">
        </div>
    </div>

    <button class="btn btn-primary mt-3">افزودن دسته</button>
</form>

{{-- ============================ پنل انتخاب آیکن ============================ --}}
<div id="iconPicker" class="icon-picker">
    <input type="text" id="iconSearch" class="icon-picker__search" placeholder="جستجوی آیکن... (مثلا: پیتزا، قهوه، برگر)">

    <div class="icon-tabs">
        <button type="button" class="active" data-group="all">همه</button>
        @foreach($iconGroupTitles as $key => $title)
            <button type="button" data-group="{{ $key }}">{{ $title }}</button>
        @endforeach
    </div>

    <div id="iconGrid" class="icon-grid">
        @foreach($iconGroups as $key => $icons)
            @foreach($icons as $class => $info)
                <button type="button"
                        class="icon-item"
                        data-group="{{ $key }}"
                        data-icon="{{ $class }}"
                        data-label="{{ $info['label'] }}"
                        data-color="{{ $info['color'] }}"
                        title="{{ $info['label'] }}"
                        style="--c: {{ $info['color'] }};">
                    <i class="{{ $class }}"></i>
                </button>
            @endforeach
        @endforeach
    </div>

    <div id="iconEmpty" class="icon-empty">آیکنی با این عبارت پیدا نشد</div>
</div>

{{-- ============================ جدول دسته‌ها ============================ --}}
<div class="glass-card p-4">
    <table class="table table-bordered table-striped text-white mb-0">
        <thead>
            <tr>
                <th class="text-center" width="80">آیکن</th>
                <th>نام</th>
                <th>ترتیب</th>
                <th width="120">عملیات</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $cat)
                @php
                    // اگر مقدار قدیمی (ایموجی) در دیتابیس باشد، مثل قبل نمایش داده می‌شود
                    $isFaIcon = \Illuminate\Support\Str::startsWith($cat->icon ?? '', 'fa-');
                    // رنگ آیکن از آرایه بالا؛ اگر پیدا نشد رنگ سفید
                    $iconColor = $iconColors[$cat->icon] ?? '#f8fafc';
                @endphp
                <tr>
                    <td class="text-center" style="font-size:22px; vertical-align:middle;">
                        @if($isFaIcon)
                            <i class="{{ $cat->icon }}" style="color: {{ $iconColor }};"></i>
                        @else
                            {{ $cat->icon }}
                        @endif
                    </td>
                    <td>{{ $cat->name }}</td>
                    <td>{{ $cat->order }}</td>
                    <td>
                        {{-- حذف --}}
                        <form action="{{ route('admin.categories.destroy', $cat->id) }}"
                              method="POST"
                              onsubmit="return confirm('آیا مطمئن هستید که می‌خواهید حذف کنید؟')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">حذف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    const iconPicker  = document.getElementById('iconPicker');
    const iconField   = document.getElementById('iconField');
    const iconInput   = document.getElementById('iconInput');
    const iconPreview = document.getElementById('iconPreview');
    const iconSearch  = document.getElementById('iconSearch');
    const iconGrid    = document.getElementById('iconGrid');
    const iconEmpty   = document.getElementById('iconEmpty');

    let activeGroup = 'all';

    /* نرمال‌سازی متن جستجو (تبدیل ی/ك عربی و نیم‌فاصله) */
    const normalize = str => str.toString().trim().toLowerCase()
        .replace(/ي/g, 'ی')
        .replace(/ك/g, 'ک')
        .replace(/\u200c/g, ' ');

    /* فیلتر بر اساس تب فعال + عبارت جستجو */
    function applyFilter() {
        const query = normalize(iconSearch.value).replace(/ /g, '-');
        let visible = 0;

        iconGrid.querySelectorAll('.icon-item').forEach(btn => {
            const label   = normalize(btn.dataset.label);
            const name    = normalize(btn.dataset.icon).replace(/ /g, '-');
            const inGroup = activeGroup === 'all' || btn.dataset.group === activeGroup;
            const matched = !query || label.includes(query) || name.includes(query);
            const show    = inGroup && matched;

            btn.style.display = show ? '' : 'none';
            if (show) visible++;
        });

        iconEmpty.style.display = visible ? 'none' : 'block';
    }

    /* مشخص کردن آیکن انتخاب‌شده فعلی در گرید */
    function markSelected() {
        iconGrid.querySelectorAll('.icon-item').forEach(btn =>
            btn.classList.toggle('selected', btn.dataset.icon === iconInput.value)
        );
    }

    function openPicker() {
        const rect = iconField.getBoundingClientRect();
        iconPicker.style.top  = (rect.bottom + window.scrollY + 6) + 'px';
        iconPicker.style.left = (rect.left + window.scrollX) + 'px';
        iconPicker.style.display = 'block';

        // ریست جستجو و تب‌ها
        iconSearch.value = '';
        activeGroup = 'all';
        document.querySelectorAll('.icon-tabs button').forEach((tab, i) =>
            tab.classList.toggle('active', i === 0)
        );

        applyFilter();
        markSelected();
        setTimeout(() => iconSearch.focus(), 60);
    }

    function closePicker() {
        iconPicker.style.display = 'none';
    }

    /* باز و بسته شدن پنل با کلیک روی فیلد آیکن */
    iconField.addEventListener('click', () => {
        if (iconPicker.style.display === 'block') {
            closePicker();
        } else {
            openPicker();
        }
    });

    /* جستجوی زنده */
    iconSearch.addEventListener('input', applyFilter);

    /* تب‌های دسته‌بندی */
    document.querySelectorAll('.icon-tabs button').forEach(tab => {
        tab.addEventListener('click', () => {
            document.querySelector('.icon-tabs button.active').classList.remove('active');
            tab.classList.add('active');
            activeGroup = tab.dataset.group;
            applyFilter();
        });
    });

    /* انتخاب آیکن + اعمال رنگ آن روی پیش‌نمایش داخل اینپوت */
    iconGrid.addEventListener('click', e => {
        const btn = e.target.closest('.icon-item');
        if (!btn) return;

        iconInput.value       = btn.dataset.icon;
        iconPreview.className = btn.dataset.icon;
        iconPreview.style.color = btn.dataset.color;
        markSelected();
        closePicker();
    });

    /* بستن پنل با کلیک بیرون از آن یا کلید Esc */
    document.addEventListener('click', e => {
        if (iconPicker.style.display !== 'block') return;
        if (!iconPicker.contains(e.target) && !iconField.contains(e.target)) {
            closePicker();
        }
    });

    document.addEventListener('keydown', e => {
        if (e.key === 'Escape') closePicker();
    });
</script>
@endsection