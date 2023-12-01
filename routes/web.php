<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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

Route::get('/home', function () {
    return view('admin.admin-registration');
})->name('home');

//applicant
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/announcement', [UserController::class, 'announcement'])->name('announcement');
    Route::get('/contact', [UserController::class, 'contact'])->name('contact');
    Route::get('/faq', [UserController::class, 'faq'])->name('faq');

    Route::get('/login', [UserController::class, 'login'])->name('login');
    Route::post('/login', [UserController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [UserController::class, 'register'])->name('register');
    Route::post('/register', [UserController::class, 'registerPost'])->name('register.post');
});
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::get('/home', function () {
        return view('user.home');
    })->name('applicant-home');
    
    Route::post('/logout', [UserController::class, 'logout']);
});


//admin
Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin-login', [AdminController::class, 'loginPost'])->name('admin.login.post');
Route::get('/admin-registration', [AdminController::class, 'showRegistrationForm'])->name('admin.registration');
Route::post('/admin-registration', [AdminController::class, 'register'])->name('admin.register.submit');
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
Route::get('/admin/admin-logout', [AdminController::class, 'logout'])->name('admin.admin-logout');





