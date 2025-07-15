<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubCateoryController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::post('/packages/order', [ProfileController::class, 'processOrder'])->name('packages.order');
    Route::get('/dashboard',[ProfileController::class,'dashboard'])->name('dashboard');
    Route::get('/orders',[ProfileController::class,'orders'])->name('orders');
    Route::get('/packages',[ProfileController::class,'packages'])->name('packages');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/wallet/deposit', [ProfileController::class, 'showdeposit'])->name('wallet.deposit');
    Route::post('/wallet/deposit', [ProfileController::class, 'postdeposit'])->name('wallet.deposit');
    Route::get('/wallet/withdraw', [ProfileController::class, 'withdraw'])->name('wallet.withdraw');
    Route::post('/wallet/withdraw', [ProfileController::class, 'withdrawpost'])->name('wallet.withdraw');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/packages/{name}', [ProfileController::class, 'showpackage'])->name('packages.show');
    // Route::post('/packages/order', [ProfileController::class, 'postpackage'])->name('packages.order');

    Route::middleware(['role:admin'])->group(function(){
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::get('/orders', [ProfileController::class, 'allorders'])->name('orders');
        Route::get('/deposits', [ProfileController::class, 'alldeposits'])->name('deposits');
        Route::patch('/deposits/{id}/approve', [ProfileController::class, 'approve'])->name('deposit.approve');
        Route::patch('/deposits/{id}/reject', [ProfileController::class, 'reject'])->name('deposit.reject');
        Route::resource('permission',PermissionController::class);
        Route::resource('category',CategoryController::class);
        Route::resource('subcategory',SubCateoryController::class);
        Route::resource('collection',CollectionController::class);
        Route::resource('product',ProductController::class);
        Route::get('/get/subcategory',[ProductController::class,'getsubcategory'])->name('getsubcategory');
        Route::get('/remove-external-img/{id}',[ProductController::class,'removeImage'])->name('remove.image');
    });
});
