<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;


use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view(view: 'home');
});

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
route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'admin']);


// ! ini cuman iseng nampilin data ga make db, hapus aja kalo ga kepake, dr gpt
Route::get('/menu', function () {
    return view('menu');
})->name('menu');


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
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');



