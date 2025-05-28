<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\OrderHistory;
use App\Livewire\ProductsList;
use App\Livewire\Sales;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Livewire\UsersLivewire;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/sales', Sales::class)->name('sales');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', UsersLivewire::class)->name('users');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/orders-history', OrderHistory::class)->name('orders-history');
});

Route::get('/products', ProductsList::class)->name('products');

require __DIR__ . '/auth.php';
