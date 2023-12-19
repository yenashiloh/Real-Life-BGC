<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApplicantController;

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

// Route::get('/home', function () {
//     return view('admin.admin-registration');
// })->name('home');

// applicant
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('/', [ApplicantController::class, 'index']);
    Route::get('/announcement', [ApplicantController::class, 'announcement'])->name('announcement');
    Route::get('/contact', [ApplicantController::class, 'contact'])->name('contact');
    Route::get('/faq', [ApplicantController::class, 'faq'])->name('faq');

    Route::get('/login', [ApplicantController::class, 'login'])->name('login');
    Route::post('/login', [ApplicantController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [ApplicantController::class, 'register'])->name('register');
    Route::post('/register', [ApplicantController::class, 'registerPost'])->name('register.post');
});
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::get('/home', [ApplicantController::class, 'userHome'])->name('user.home');
    Route::get('/personal-details', [ApplicantController::class, 'personalDetails'])->name('user.profile');
    Route::post('/logout', [ApplicantController::class, 'logout']);
});


//admin
Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('/admin-login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin-login', [AdminController::class, 'adminloginPost'])->name('admin.login.post');
});

Route::middleware(['auth:admin', 'PreventBackHistory'])->group(function () {
    Route::get('/admin-registration', [AdminController::class, 'showRegistrationForm'])->name('admin.registration');
    Route::post('/admin-registration', [AdminController::class, 'register'])->name('admin.register.submit');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin-profile', [AdminController::class, 'adminProfile'])->name('admin-profile');

    Route::post('/admin-profile', [AdminController::class, 'updateProfile'])->name('admin.profile-update');
    Route::post('/change-password', [AdminController::class, 'changePassword'])->name('admin.password-update');

    Route::get('/announcement/admin-announcement', [AdminController::class, 'showAnnouncement'])->name('admin.announcement.admin-announcement');
    Route::get('/announcement/add-announcement', [AdminController::class, 'addAnnouncement'])->name('admin.announcement.add-announcement');
    Route::post('/announcement/add-announcement', [AdminController::class, 'saveAnnouncement'])->name('admin.save-announcement');
    Route::delete('/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement'])->name('delete.announcement');

    //DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'totalApplicants'])->name('dashboard');
    Route::get('/getApplicantsByGradeYear', [AdminController::class, 'getApplicantsByGradeYear'])->name('getApplicantsByGradeYear');

    // DATA APPLICANTS 
    Route::get('/applicants/new_applicants', [AdminController::class, 'showNewApplicants'])->name('admin.applicants.new_applicants');
    Route::get('/applicants-data', [AdminController::class, 'getApplicantsData'])->name('applicants.data');

    Route::post('/new-applicants/update-status', [AdminController::class, 'updateStatus'])->name('update.status');

    Route::get('/admin/admin-logout', [AdminController::class, 'logout'])->name('admin.admin-logout');
});
