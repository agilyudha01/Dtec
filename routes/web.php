<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->intended('/login');;
});
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']); 

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/home', function () {
    return view('home');
});
Route::get('/home/article', function () {
    return view('article');
});
Route::get('/deteksi', function () {
    return view('deteksi');
});

Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::post('/history', [HistoryController::class, 'store'])->name('save.prediction');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::post('/profile', [ProfileController::class, 'logout'])->name('profile.logout');
