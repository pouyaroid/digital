<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CafeHeaderController;
use App\Http\Controllers\CafeCategoryController;
use App\Http\Controllers\CafeItemController;
use App\Http\Controllers\ContactSectionController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingController;
use App\Models\Address;

use App\Models\Customer;

// Fortify
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;

// QR Code
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\RoundBlockSizeMode;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\AdminController;
use Symfony\Component\HttpFoundation\Request;

// ---------------- Public Routes (No middleware) ----------------

// صفحه اصلی سایت
Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحه ورود
Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->middleware('guest')
    ->name('login');

// فایل CSS داینامیک
Route::get('/dynamic-style.css', function () {
    return response()->view('dynamic-style')
        ->header('Content-Type', 'text/css');
});



// ---------------- Admin Routes (Protected) ----------------
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

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



    // ----------- Cafe Header -----------
    Route::get('/cafe-header/edit', [CafeHeaderController::class, 'edit'])
        ->name('cafe-header.edit');

    Route::put('/cafe-header/update', [CafeHeaderController::class, 'update'])
        ->name('cafe-header.update');

    Route::post('/cafe-header/store', [CafeHeaderController::class, 'store'])
        ->name('cafe-header.store');

    Route::delete('/cafe-header/delete', [CafeHeaderController::class, 'destroy'])
        ->name('cafe-header.destroy');



    // ----------- Categories -----------
    Route::get('/categories', [CafeCategoryController::class, 'index'])
        ->name('cafe.categories.index');

    Route::post('/categories', [CafeCategoryController::class, 'store'])
        ->name('cafe.categories.store');
    Route::delete('categories/delete/{id}',[CafeCategoryController::class,'destroy'])
        ->name('categories.destroy'); 
        
    



    // ----------- Items -----------
    Route::get('/items', [CafeItemController::class, 'index'])
        ->name('cafe.items.index');

    Route::post('/items', [CafeItemController::class, 'store'])
        ->name('cafe.items.store');
    Route::delete('/items/{id}',[CafeItemController::class,'destroy'])
        ->name('cafe.items.destroy');
    Route::put('/items/{id}',[CafeItemController::class,'update'])
        ->name('cafe.items.update');
        
    Route::get('/items/edit/{id}',[CafeItemController::class,'edit'])
        ->name('cafe.items.edit');



    // ----------- Contact Section -----------
    Route::get('/contact', [ContactSectionController::class, 'edit'])
        ->name('contact.edit');

    Route::put('/contact', [ContactSectionController::class, 'update'])
        ->name('contact.update');



    // ----------- Settings -----------
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index');

    Route::post('/settings', [SettingController::class, 'update'])
        ->name('settings.update');



    // ----------- Customers -----------
    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers.index');

    Route::get('/customers/create', [CustomerController::class, 'create'])
        ->name('customers.create');

    Route::post('/customers', [CustomerController::class, 'store'])
        ->name('customers.store');

    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::put('/customers/{customer}', [CustomerController::class, 'update'])
        ->name('customers.update');

    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');



    // ----------- SMS System -----------
    Route::get('/customers/sms', [CustomerController::class, 'smsForm'])
        ->name('customers.smsForm');

    Route::post('/customers/sms/send', [CustomerController::class, 'sendSms'])
        ->name('customers.sendSms');
       
     
});
// صفحه checkout
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

// ذخیره سفارش
Route::post('/order', [OrderController::class, 'store'])->name('order.submit');

// ذخیره آدرس جدید
Route::post('/address/store', [AddressController::class, 'store'])->name('address.store');

// گرفتن آدرس‌ها بر اساس شماره موبایل

Route::get('/addresses/by-phone', [AddressController::class, 'byPhone']);
// صفحه checkout
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

// ثبت سفارش نهایی
Route::post('/order/submit', [OrderController::class, 'store'])->name('order.submit');

// گرفتن آدرس‌ها بر اساس شماره موبایل (AJAX)
Route::get('/addresses/by-phone', [AddressController::class, 'byPhone'])->name('address.byPhone');

// ثبت آدرس جدید (AJAX)
Route::post('/addresses/store', [AddressController::class, 'store'])->name('address.store');
Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');
// در فایل routes/web.php


Route::patch('/admin/orders/{order}/status', [Order::class, 'updateStatus'])->name('admin.orders.updateStatus');
