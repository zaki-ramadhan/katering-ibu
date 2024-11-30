<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect('/home');  // Redirect ke /home
});

// Tambahkan route untuk /home
Route::get('/home', function () {
    return view('home');  // Ganti 'home' dengan view yang sesuai
});



// Route::get('/', function () {
//     return view(view: 'home');
// });

// Route::get('\home', action: function(){
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
Route::get('/home', function() {
    return view('home');
})->name('home');

// menu page
Route::get('/menu', function() {
    return view('menu');
})->name('menu');

// order now page
Route::get('/order-now', function() {
    return view('order-now');
})->name('order-now');

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


// ! ini cuman iseng nampilin data ga make db, hapus aja kalo ga kepake, dr gpt
Route::get('/menu', function () {
    return view('menu');
})->name('menu');


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

Route::get('/admin/data-menu', action: function () {
    return view('admin.data-menu');
})->name('admin.data-menu');

Route::get('/admin/data-ulasan', action: function () {
    return view('admin.data-ulasan');
})->name('admin.data-ulasan');



