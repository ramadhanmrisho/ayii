<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');

Route::get('/quote', [QuoteController::class, 'index'])->name('quote.index');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');
Route::post('/quote/add/{product}', [QuoteController::class, 'add'])->name('quote.add');
Route::delete('/quote/remove/{product}', [QuoteController::class, 'remove'])->name('quote.remove');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::view('/about-us', 'about.index')->name('about.index');
Route::view('/solutions', 'solutions.index')->name('solutions.index');
Route::view('/projects', 'projects.index')->name('projects.index');
