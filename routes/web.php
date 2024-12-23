<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Redirect to home
Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::resource('home', HomeController::class)->name('index', 'home');

// Authentication routes
Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

// Static pages routes
Route::get('/about-us', function() {
    return view('about-us');
})->name('about-us');

Route::get('/contact-us', function() {
    return view('contact-us');
})->name('contact-us');

Route::post('/contact-us', [UlasanController::class, 'store'])->name('ulasan.store');

Route::get('/service', function() {
    return view('service');
})->name('service');

// Menu routes
Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

// Grouping routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [OrderController::class, 'dashboard'])->name('customer.dashboard');

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('customer.profile');
        Route::get('/edit-profile-saya', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::delete('/delete-account', [UserController::class, 'deleteAccount'])->name('delete_account');

    Route::get('riwayat-pesanan', [OrderController::class, 'orderHistory'])->name('customer.order-history');

    Route::prefix('cart')->group(function () {
        Route::get('/', [KeranjangController::class, 'index'])->name('customer.keranjang');
        Route::post('/', [KeranjangController::class, 'store'])->name('keranjang.store');
        Route::delete('/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');
        Route::get('/item-count', [OrderController::class, 'getCartItemCount'])->name('cart.item.count');
    });

    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/pesanan-detail/{keranjang}',[OrderController::class, 'showOrderDetail'])->name('order.detail');

    Route::resource('order-now', OrderController::class)->name('index', 'order-now');
    Route::post('/order/process', [OrderController::class, 'processOrder'])->name('order.process');
    Route::get('/pesanan-detail', [OrderController::class, 'showOrderDetail'])->name('order.detail');

    Route::get('/pesanan/{id}/detail-pembayaran', [OrderController::class, 'payOrder'])->name('pesanan.payOrder');
    Route::post('/pesanan/{id}/upload-payment-proof', [OrderController::class, 'uploadPaymentProof'])->name('pesanan.upload-payment-proof');

    Route::prefix('notifications')->group(function () {
    Route::get('/', [NotificationController::class, 'index'])->name('notifications.index');
    Route::delete('/delete-all', [NotificationController::class, 'destroyAll'])->name('notifications.destroyAll');
    });
});

require __DIR__.'/auth.php';

// Admin routes
Route::get('admin/dashboard-admin', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard-admin', function () {
        return view('admin.dashboard-admin');
    })->name('admin.dashboard-admin');

    Route::resource('admin.setting', AdminController::class)->name('show', 'admin.setting');

    Route::prefix('admin')->group(function () {
        Route::get('/data-pesanan', [OrderController::class, 'dataPesanan'])->name('admin.data-pesanan');
        Route::resource('/pesanan', OrderController::class);

        Route::get('/data-penjualan', [OrderController::class, 'penjualan'])->name('admin.data-penjualan');
        Route::get('/pesanan/{pesanan}/edit', [OrderController::class, 'edit'])->name('pesanan.edit');
        Route::put('/pesanan/{pesanan}', [OrderController::class, 'update'])->name('pesanan.update');
        Route::delete('/pesanan/{id}', [OrderController::class, 'destroy'])->name('pesanan.destroy');

        Route::resource('/data-menu', MenuController::class)->name('index', 'admin.data-menu');
        Route::resource('/create-menu', MenuController::class)->name('create', 'admin.create-menu');
        Route::post('/create-menu', [MenuController::class, 'store'])->name('admin.store-menu');
        Route::get('/data-menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
        Route::put('/data-menu/{id}', [MenuController::class, 'update'])->name('menu.update');
        Route::delete('/data-menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

        Route::resource('/dashboard-admin', DashboardAdminController::class)->name('index', 'admin.dashboard-admin');
        Route::resource('/data-ulasan', UlasanController::class)->name('index', 'admin.data-ulasan');
        Route::delete('/data-ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

        Route::resource('/data-pelanggan', UserController::class)->name('index', 'admin.data-pelanggan');
        Route::get('/data-pelanggan/{id}/edit', [UserController::class, 'edit'])->name('admin.edit-pelanggan');
        Route::put('/data-pelanggan/{id}', [UserController::class, 'update'])->name('admin.update-pelanggan');
        Route::delete('/data-pelanggan/{id}', [UserController::class, 'destroy'])->name('admin.data-pelanggan.destroy');

        Route::resource('/setting-admin', AdminController::class);
    });
});
