<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffsController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/staffs/login', [StaffsController::class, 'showLogin'])->name('staffs.login');
Route::post('/staffs/login', [StaffsController::class, 'login'])->name('staffs.login.submit');
Route::get('/staffs/logout', [StaffsController::class, 'logout'])->name('staffs.logout');

Route::get('/staffs/dashboard', [StaffsController::class, 'dashboard'])->name('staffs.dashboard');

Route::resource('staffs', StaffsController::class);

Route::get('/dashboard', function () {
    return view('dashboard'); // your dashboard blade
})->name('dashboard');


Route::put('/staffs/{id}/status', [StaffsController::class, 'updateStatus'])->name('staffs.updateStatus');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';