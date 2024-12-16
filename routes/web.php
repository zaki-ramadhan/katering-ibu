<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect('/home');  // Redirect ke /home
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

// Order routes
Route::resource('order-now', OrderController::class)->name('index', 'order-now');



// Grouping routes for authenticated users
Route::middleware('auth')->group(function () {
    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard');
    })->name('customer.dashboard');
    
    Route::get('/profile', [ProfileController::class, 'index'])->name('customer.profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::delete('/delete-account', [UserController::class, 'deleteAccount'])->name('delete_account');

    Route::get('/order-history', function () {
        return view('customer.order-history');
    })->name('customer.order-history');
    
    Route::get('customer/keranjang', [KeranjangController::class, 'index'])->name('customer.keranjang');
    Route::post('customer/keranjang', [KeranjangController::class, 'store'])->name('keranjang.store');
    Route::delete('customer/keranjang/{id}', [KeranjangController::class, 'destroy'])->name('keranjang.destroy');

    Route::get('/customer/pesanan-detail', [OrderController::class, 'showOrderDetail'])->name('order.detail');
    Route::post('/customer/order-process', [OrderController::class, 'processOrder'])->name('order.process');
});

require __DIR__.'/auth.php';

// Admin routes (tidak ada yang dihapus atau diacak, hanya dirapihkan)
Route::get('admin/dashboard-admin', [HomeController::class, 'index'])->middleware(['auth', 'admin']);

Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard-admin', function () {
        return view('admin.dashboard-admin'); // Buat file `resources/views/admin/dashboard.blade.php`
    })->name('admin.dashboard-admin');
    Route::resource('admin.setting', AdminController::class)->name('show', 'admin.setting');
});


Route::get('/admin/data-penjualan', function () {
    return view('admin.data-penjualan');
})->name('admin.data-penjualan');

Route::get('/admin/data-pesanan', function () {
    return view('admin.data-pesanan');
})->name('admin.data-pesanan');

Route::resource('admin/data-menu', MenuController::class)->name('index', 'admin.data-menu');
Route::resource('admin/create-menu', MenuController::class)->name('create', 'admin.create-menu');

// Buat menu baru
Route::post('admin/create-menu', [MenuController::class, 'store'])->name('admin.store-menu');

// Edit menu
Route::get('/admin/data-menu/{id}/edit', [MenuController::class, 'edit'])->name('menu.edit');
Route::put('/admin/data-menu/{id}', [MenuController::class, 'update'])->name('menu.update');

// Hapus menu
Route::delete('/admin/data-menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

Route::resource('admin/dashboard-admin', DashboardAdminController::class)->name('index', 'admin.dashboard-admin');
Route::resource('admin/data-ulasan', UlasanController::class)->name('index', 'admin.data-ulasan');

// Hapus ulasan
Route::delete('/admin/data-ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');

// Data pelanggan
Route::resource('/admin/data-pelanggan', UserController::class)->name('index', 'admin.data-pelanggan');
Route::get('/admin/data-pelanggan/{id}/edit', [UserController::class, 'edit'])->name('admin.edit-pelanggan');
Route::put('/admin/data-pelanggan/{id}', [UserController::class, 'update'])->name('admin.update-pelanggan');
Route::delete('/admin/data-pelanggan/{id}', [UserController::class, 'destroy'])->name('admin.data-pelanggan.destroy');

Route::resource('admin/setting-admin', AdminController::class);

// Route::delete('/user/delete', [UserController::class, 'deleteAccount'])->name('user.deleteAccount');
