<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CafeCategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeHeaderController;
use App\Http\Controllers\CafeItemController;
use App\Http\Controllers\ContactSectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingController;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\RoundBlockSizeMode;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// Route اصلی سایت
// ---------------- Public Route ----------------
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware(['guest'])
    ->name('login');


// ---------------- Protected Routes ----------------
Route::middleware(['auth'])->group(function () {

    // مدیریت Header کافه
    Route::prefix('admin')->group(function () {
        Route::get('/cafe-header/edit', [CafeHeaderController::class, 'edit'])
            ->name('cafe-header.edit');
        Route::put('/cafe-header/update', [CafeHeaderController::class, 'update'])
            ->name('cafe-header.update');
        Route::post('/cafe-header/store', [CafeHeaderController::class, 'store'])
            ->name('cafe-header.store');
        Route::delete('/cafe-header/delete', [CafeHeaderController::class, 'destroy'])
            ->name('cafe-header.destroy');
    });

    // نمایش هدر (محافظت‌شده)
    Route::get('/header', [CafeHeaderController::class, 'show']);

    // مدیریت دسته‌ها و آیتم‌های کافه
    Route::prefix('admin/cafe')->group(function () {
        Route::get('/categories', [CafeCategoryController::class, 'index'])
            ->name('cafe.categories');
        Route::post('/categories', [CafeCategoryController::class, 'store']);
        Route::get('/items', [CafeItemController::class, 'index'])
            ->name('cafe.items');
        Route::post('/items', [CafeItemController::class, 'store']);
    });

    // سایر Route های admin
    Route::prefix('admin')->name('admin.')->group(function () {

        // Dashboard با QR Code
        Route::get('/', function () {
            $url = url('/');

            $builder = new Builder(
                writer: new SvgWriter(),
                writerOptions: [],
                validateResult: false,
                data: $url,
                encoding: new Encoding('UTF-8'),
                errorCorrectionLevel: ErrorCorrectionLevel::High,
                size: 300,
                margin: 2,
                roundBlockSizeMode: RoundBlockSizeMode::Margin,
            );

            $result = $builder->build();
            $svg = $result->getString();

            return view('admin.dashboard', ['qr' => $svg]);
        })->name('dashboard');

        Route::get('/cafe-header', [CafeHeaderController::class, 'edit'])
            ->name('cafe-header.edit');
        Route::put('/cafe-header', [CafeHeaderController::class, 'update']);

        Route::get('/categories', [CafeCategoryController::class, 'index'])
            ->name('cafe.categories.index');
        Route::post('/categories', [CafeCategoryController::class, 'store']);

        Route::get('/items', [CafeItemController::class, 'index'])
            ->name('cafe.items.index');
        Route::post('/items', [CafeItemController::class, 'store']);
    });

    // بخش تماس با ما
    Route::get('/admin/contact', [ContactSectionController::class, 'edit'])
        ->name('admin.contact.edit');
    Route::put('/admin/contact', [ContactSectionController::class, 'update'])
        ->name('contact.update');

    // تنظیمات
    Route::get('/admin/settings', [SettingController::class, 'index']);
    Route::post('/admin/settings', [SettingController::class, 'update']);
    // لیست مشتری‌ها
Route::get('/customers', [CustomerController::class, 'index'])->name('admin.customers.index');

// فرم ایجاد مشتری
Route::get('/customers/create', [CustomerController::class, 'create'])->name('admin.customers.create');

// ذخیره مشتری جدید
Route::post('/customers', [CustomerController::class, 'store'])->name('admin.customers.store');

// نمایش جزئیات یک مشتری (اختیاری)
// Route::get('/customers/{customer}', [CustomerController::class, 'show'])->name('admin.customers.show');

// فرم ویرایش مشتری
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('admin.customers.edit');

// ذخیره تغییرات مشتری
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('admin.customers.update');

// حذف مشتری
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('admin.customers.destroy');

Route::get('/customers/sms', [CustomerController::class, 'smsForm'])
    ->name('admin.customers.smsForm');

// پردازش و ارسال پیامک
Route::post('/customers/sms/send', [CustomerController::class, 'sendSms'])
    ->name('admin.customers.sendSms');

  
 
});
Route::get('/dynamic-style.css', function () {
    return response()->view('dynamic-style')
        ->header('Content-Type', 'text/css');
});

