<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RfqController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'permission:dashboard.view'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');

    Route::resource('products', ProductController::class)->middleware('permission:products.view|products.create|products.update|products.delete');
    Route::resource('categories', CategoryController::class)->middleware('permission:categories.manage');
    Route::resource('brands', BrandController::class)->middleware('permission:brands.manage');

    Route::get('media', [MediaController::class, 'index'])->middleware('permission:media.view')->name('media.index');
    Route::post('media', [MediaController::class, 'store'])->middleware('permission:media.upload')->name('media.store');

    Route::get('settings', [SettingController::class, 'edit'])->middleware('permission:settings.manage')->name('settings.edit');
    Route::put('settings', [SettingController::class, 'update'])->middleware('permission:settings.manage')->name('settings.update');

    Route::get('rfqs', [RfqController::class, 'index'])->middleware('permission:rfqs.view')->name('rfqs.index');
    Route::get('rfqs/{rfq}', [RfqController::class, 'show'])->middleware('permission:rfqs.view')->name('rfqs.show');
    Route::put('rfqs/{rfq}', [RfqController::class, 'update'])->middleware('permission:rfqs.update')->name('rfqs.update');

    Route::get('enquiries', [EnquiryController::class, 'index'])->middleware('permission:enquiries.view')->name('enquiries.index');
    Route::put('enquiries/{enquiry}', [EnquiryController::class, 'update'])->middleware('permission:enquiries.update')->name('enquiries.update');
});
