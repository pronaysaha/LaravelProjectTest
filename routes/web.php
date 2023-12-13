<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/create', [DashboardController::class, 'create'])->name('dashboard.create');
    Route::post('/dashboard/store', [DashboardController::class, 'store'])->name('dashboard.store');
    Route::get('/dashboard/edit/{post}', [DashboardController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{post}', [DashboardController::class, 'update'])->name('dashboard.update');
    Route::delete('/dashboard/destroy/{post}', [DashboardController::class, 'destroy'])->name('dashboard.destroy');
})->middleware(['auth', 'verified','datefilter'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/home', [HomeController::class, 'index'])->name('home');

require __DIR__.'/auth.php';
