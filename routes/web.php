<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FoodMenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('food-menu', FoodMenuController::class)
        ->only(['index', 'create', 'store', 'edit', 'update', 'destroy'])
        ->middleware(['auth', 'verified']);
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('orders', OrderController::class)
->only(['index', 'create', 'store', 'show'])
->middleware(['auth', 'verified']);

Route::get('orders/create', [OrderController::class, 'create'])->name('orders.create');

Route::post('orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');

Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

Route::patch('/orders/{order}', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

require __DIR__.'/auth.php';
