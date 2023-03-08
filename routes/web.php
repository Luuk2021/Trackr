<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Package\ShowPackages;
use App\Http\Livewire\Package\CreatePackage;
use App\Http\Livewire\User\ShowUsers;
use App\Http\Livewire\User\CreateUser;
use App\Http\Livewire\User\EditUser;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('superadmin')->group(function () {
    Route::get('/user', ShowUsers::class)->name('user');
    Route::get('/user/add', CreateUser::class);
    Route::get('/user/edit/{user}', EditUser::class);
});

Route::middleware('admin')->group(function () {
    Route::get('/package/add', CreatePackage::class);
});

Route::middleware('packeroradmin')->group(function () {
    Route::get('/package', ShowPackages::class)->name('package');
});

require __DIR__ . '/auth.php';
