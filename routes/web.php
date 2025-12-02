<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CafeCategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CafeHeaderController;
use App\Http\Controllers\CafeItemController;
use App\Http\Controllers\ContactSectionController;
use App\Http\Controllers\SettingController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/',[HomeController::class,'index']);


Route::get('/header', [CafeHeaderController::class, 'show']);

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

Route::prefix('admin/cafe')->group(function () {

    Route::get('/categories', [CafeCategoryController::class, 'index'])->name('cafe.categories');
    Route::post('/categories', [CafeCategoryController::class, 'store']);

    Route::get('/items', [CafeItemController::class, 'index'])->name('cafe.items');
    Route::post('/items', [CafeItemController::class, 'store']);
});
// Route::get('/admin',[AdminController::class,'index']);
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');

    Route::get('/cafe-header', [CafeHeaderController::class, 'edit'])->name('cafe-header.edit');
    Route::put('/cafe-header', [CafeHeaderController::class, 'update']);

    Route::get('/categories', [CafeCategoryController::class, 'index'])->name('cafe.categories.index');
    Route::post('/categories', [CafeCategoryController::class, 'store']);

    Route::get('/items', [CafeItemController::class, 'index'])->name('cafe.items.index');
    Route::post('/items', [CafeItemController::class, 'store']);


});
Route::get('/admin/contact', [ContactSectionController::class, 'edit'])->name('admin.contact.edit');
Route::put('/admin/contact', [ContactSectionController::class, 'update'])->name('contact.update');
Route::get('/admin', function () {
    $url = url('/');

    // تولید QR SVG
    $qr = QrCode::format('svg')
        ->size(300)
        ->margin(2)
        ->generate($url);

    return view('admin.dashboard', compact('qr'));
})->name('admin.dashboard');

Route::get('/admin/settings', [SettingController::class, 'index']);
Route::post('/admin/settings', [SettingController::class, 'update']);
Route::get('/dynamic-style.css', function () {
    return response()->view('dynamic-style')->header('Content-Type', 'text/css');
});
