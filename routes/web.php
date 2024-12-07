<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UlasanController;

Route::get('/', function () {
    return redirect('/home');  // Redirect ke /home
});

// Route::get('/home', action: function(){
//     return view('home');
// })->name('home');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('/about-us', function() {
//     return view('about-us');
// });

// about-us page
Route::get('/login', function() {
    return view('auth.login');
})->name('login');

// Jika menggunakan Laravel default atau middleware auth
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');


Route::get('/register', function() {
    return view('auth.register');
})->name('register');

// about-us page
Route::get('/about-us', function() {
    return view('about-us');
})->name('about-us');


// home page
// Route::get('/home', function() {
//     return view('home');
// })->name('home');

Route::resource('home', HomeController::class)->name('index', 'home');

// menu page
Route::get('/menu', function() {
    return view('menu');
})->name('menu');

Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu');
// Route::get('/footer', [MenuController::class, 'showMenuFooter'])->name('footer');
Route::get('/menu/search', [MenuController::class, 'search'])->name('menu.search');

// order now page
// Route::get('/order-now', function() {
//     return view('order-now');
// })->name('order-now');

Route::resource('order-now', OrderController::class)->name('index', 'order-now');


// ulasan
// Route::resource('ulasan', UlasanController::class);
Route::post('/contact-us', [UlasanController::class, 'store'])->name('ulasan.store');

// contact us page
Route::get('/contact-us', function() {
    return view('contact-us');
})->name('contact-us');

// service page
Route::get('/service', function() {
    return view('service');
})->name('service');


require __DIR__.'/auth.php';

// !
route::get('admin/dashboard-admin', [HomeController::class, 'index'])->middleware(['auth', 'admin']);


// logika akan terpental setelah login ke halaman mana
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard-admin', function () {
        return view('admin.dashboard-admin'); // Buat file `resources/views/admin/dashboard.blade.php`
    })->name('admin.dashboard-admin');

    Route::get('/customer/dashboard', function () {
        return view('customer.dashboard'); // Buat file `resources/views/customer/dashboard.blade.php`
    })->name('customer.dashboard');
});

// customer
Route::get('/dashboard', function () {
    return view('customer.dashboard');
})->name('customer.dashboard');

Route::get('/profile', action: function () {
    return view('customer.profile');
})->name('customer.profile');

Route::get('/profile-edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile-update', [ProfileController::class, 'update'])->name('profile.update');




Route::get('/order-history', action: function () {
    return view('customer.order-history');
})->name('customer.order-history');


// admin
Route::get('/admin/dashboard-admin', function () {
    return view('admin.dashboard-admin');
})->name('admin.dashboard-admin');

Route::get('/admin/data-penjualan', function () {
    return view('admin.data-penjualan');
})->name('admin.data-penjualan');

Route::get('/admin/data-pelanggan', function () {
    return view('admin.data-pelanggan');
})->name('admin.data-pelanggan');

Route::get('/admin/data-pesanan', function () {
    return view('admin.data-pesanan');
})->name('admin.data-pesanan');

// Route::get('/admin/data-menu', action: function () {
//     return view('admin.data-menu');
// })->name('admin.data-menu');

// Route::get('admin.data-menu', [MenuController::class, 'index'])->name('menu.index');


Route::get('/admin/data-ulasan', action: function () {
    return view('admin.data-ulasan');
})->name('admin.data-ulasan');



// crud menu
// Route::get('/menu/create', function () {
//     return view('admin.create-menu');
// })->name('admin.create-menu');

// Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');

Route::resource('admin/data-menu', MenuController::class)->name('index', 'admin.data-menu');
Route::resource('admin/create-menu', MenuController::class)->name('create', 'admin.create-menu');
Route::post('admin/create-menu', [MenuController::class, 'store'])->name('admin.store-menu');

// Route::get('/menu', [MenuController::class, 'showMenu'])->name('menu');
Route::resource('admin/dashboard-admin', DashboardAdminController::class)->name('index', "admin.dashboard-admin");
Route::resource('admin/data-ulasan', UlasanController::class)->name('index', "admin.data-ulasan");
Route::delete('/admin/data-ulasan/{id}', [UlasanController::class, 'destroy'])->name('ulasan.destroy');
