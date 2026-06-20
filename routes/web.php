<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\ContactSectionController;
use App\Http\Controllers\CafeHeaderController;
use App\Http\Controllers\CafeCategoryController;
use App\Http\Controllers\CafeItemController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Auth\PhoneAuthController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\Writer\SvgWriter;
use Endroid\QrCode\RoundBlockSizeMode;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/payment/verify', [PaymentController::class, 'verify'])
    ->name('payment.verify');


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dynamic-style.css', function () {
    return response()
        ->view('dynamic-style')
        ->header('Content-Type', 'text/css');
});

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::get('/login/phone', [PhoneAuthController::class, 'showPhoneForm'])
        ->name('phone.form');

    Route::post('/login/phone', [PhoneAuthController::class, 'sendOtp'])
        ->name('phone.send');

    Route::get('/login/otp', [PhoneAuthController::class, 'showOtpForm'])
        ->name('otp.form');

    Route::post('/login/otp', [PhoneAuthController::class, 'verifyOtp'])
        ->name('otp.verify');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth')
    ->group(function () {

    Route::get('/', function () {

        $builder = new Builder(
            writer: new SvgWriter(),
            writerOptions: [],
            validateResult: false,
            data: url('/'),
            encoding: new Encoding('UTF-8'),
            errorCorrectionLevel: ErrorCorrectionLevel::High,
            size: 300,
            margin: 2,
            roundBlockSizeMode: RoundBlockSizeMode::Margin,
        );

        return view('admin.dashboard', [
            'qr' => $builder->build()->getString()
        ]);
    })->name('dashboard');

    // Cafe Header
    Route::get('/cafe-header/edit', [CafeHeaderController::class, 'edit'])->name('cafe-header.edit');
    Route::put('/cafe-header/update', [CafeHeaderController::class, 'update'])->name('cafe-header.update');
    Route::post('/cafe-header/store', [CafeHeaderController::class, 'store'])->name('cafe-header.store');
    Route::delete('/cafe-header/delete', [CafeHeaderController::class, 'destroy'])->name('cafe-header.destroy');

    // Categories
    Route::get('/categories', [CafeCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CafeCategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CafeCategoryController::class, 'destroy'])->name('categories.destroy');

    // Items
    Route::get('/items', [CafeItemController::class, 'index'])->name('items.index');
    Route::post('/items', [CafeItemController::class, 'store'])->name('items.store');
    Route::get('/items/{id}/edit', [CafeItemController::class, 'edit'])->name('items.edit');
    Route::put('/items/{id}', [CafeItemController::class, 'update'])->name('items.update');
    Route::delete('/items/{id}', [CafeItemController::class, 'destroy'])->name('items.destroy');

    // Contact
    Route::get('/contact', [ContactSectionController::class, 'edit'])->name('contact.edit');
    Route::put('/contact', [ContactSectionController::class, 'update'])->name('contact.update');

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Customers
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Orders
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}/print', [AdminOrderController::class, 'print'])->name('orders.print');
    Route::get('/orders/poll', [AdminOrderController::class, 'poll'])->name('orders.poll');
    Route::patch('/orders/{order}/status', [AdminOrderController::class, 'updateStatus'])->name('orders.updateStatus');

    // SMS
    Route::get('/customers/sms', [CustomerController::class, 'smsForm'])->name('customers.smsForm');
    Route::post('/customers/sms/send', [CustomerController::class, 'sendSms'])->name('customers.sendSms');

    // Menu settings
    Route::get('/menu-settings', [\App\Http\Controllers\Admin\MenuSettingController::class, 'index'])
        ->name('menu-settings.index');

    Route::post('/menu-settings', [\App\Http\Controllers\Admin\MenuSettingController::class, 'update'])
        ->name('menu-settings.update');
});

/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware('customer.auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');

    Route::post('/order', [OrderController::class, 'store'])->name('order.submit');

    Route::get('/customer/addresses', [AddressController::class, 'index'])->name('address.index');
    Route::post('/customer/addresses', [AddressController::class, 'store'])->name('address.store');

    Route::get('/payment/{order}', [PaymentController::class, 'pay'])->name('payment.pay');
});



  