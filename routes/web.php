<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Dashboard;
use App\Livewire\ProductsList;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\UserController;
use App\Livewire\UsersLivewire;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', Dashboard::class)->middleware('auth')->name('dashboard');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', UsersLivewire::class)->name('users');
});

Route::get('/products-list', ProductsList::class)->name('products-list');

Route::get('/test', function () {
    return view('test');
});

require __DIR__ . '/auth.php';
