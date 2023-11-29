<?php

use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('user.login');
// });

Route::get('/', [UserController::class, 'index']);
Route::get('/announcement', [UserController::class, 'announcement'])->name('announcement');
Route::get('/contact', [UserController::class, 'contact'])->name('contact');
Route::get('/faq', [UserController::class, 'faq'])->name('faq');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/register', [UserController::class, 'register'])->name('register');