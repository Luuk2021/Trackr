<?php

use App\Http\Controllers\LangController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TraceController;
use App\Http\Livewire\Package\ShowPackages;
use App\Http\Livewire\Package\ShowPackagesRecipient;
use App\Http\Livewire\Package\CreatePackage;
use App\Http\Livewire\Shop\ShowShops;
use App\Http\Livewire\Shop\CreateShop;
use App\Http\Livewire\Shop\EditShop;
use App\Http\Livewire\User\ShowUsers;
use App\Http\Livewire\User\CreateUser;
use App\Http\Livewire\User\EditUser;
use App\Http\Livewire\User\ShowUsersAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

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
    Route::get('/shop', ShowShops::class)->name('shop');
    Route::get('/shop/add', CreateShop::class);
    Route::get('/shop/edit/{shop}', EditShop::class);
});

Route::middleware('admin')->group(function () {
    Route::get('/package/add', CreatePackage::class);
    Route::get('/userAdmin', ShowUsersAdmin::class)->name('userAdmin');
});

Route::middleware('packeroradmin')->group(function () {
    Route::get('/package', ShowPackages::class)->name('package');
});

Route::middleware('recipient')->group(function () {
    Route::get('/packageRecipient', ShowPackagesRecipient::class)->name('packageRecipient');
});

Route::get('lang/change', [LangController::class, 'change'])->name('changeLang');

Route::get('/trace', function () {
    $status = null;
    return view('trace', compact('status'));
})->name('trace');

Route::get('/search', [TraceController::class, 'search'])->name("search");

Route::get('generate-pdf', [PDFController::class, 'generatePDF']);

require __DIR__ . '/auth.php';
