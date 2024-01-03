<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EmailController;


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
Route::get('/announcement', [ApplicantController::class, 'announcement'])->name('announcement');
Route::get('/contact', [ApplicantController::class, 'contact'])->name('contact');
Route::get('/faq', [ApplicantController::class, 'faq'])->name('faq');

Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('/', [ApplicantController::class, 'index']);
  
    Route::get('/login', [ApplicantController::class, 'login'])->name('login');
    Route::post('/login', [ApplicantController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [ApplicantController::class, 'register'])->name('register');
    Route::post('/register', [ApplicantController::class, 'registerPost'])->name('register.post');

    Route::get('/email', [EmailController::class, 'create']);
    Route::post('/email', [EmailController::class, 'sendEmail'])->name('send.email');

    
});
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {
    Route::get('/home', [ApplicantController::class, 'userHome'])->name('user.home');
    Route::get('/personal-details', [ApplicantController::class, 'personalDetails'])->name('user.profile');
    Route::post('/logout', [ApplicantController::class, 'logout']);

    Route::post('/update-personal-details', [ApplicantController::class, 'updatePersonalDetails'])
    ->name('update_personal_details');

    Route::post('/user/change-password', [ApplicantController::class, 'changePassword'])->name('change.password');
    Route::get('/applicant_dashboard', [ApplicantController::class, 'applicantDashboard'])->name('user.applicant_dashboard');
    Route::get('/change_password', [ApplicantController::class, 'viewChangePassword'])->name('user.change_password');
    Route::get('/requirements', [ApplicantController::class, 'showRequirements'])->name('user.applicant_dashboard');


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

    //ANNOUNCEMENT
    Route::get('/announcement/admin-announcement', [AdminController::class, 'showAnnouncement'])->name('admin.announcement.admin-announcement');
    Route::get('/announcement/add-announcement', [AdminController::class, 'addAnnouncement'])->name('admin.announcement.add-announcement');
    Route::post('/announcement/add-announcement', [AdminController::class, 'saveAnnouncement'])->name('admin.save-announcement');
    Route::delete('/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement'])->name('delete.announcement');
    Route::match(['post', 'put'], '/announcement/update-announcement/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.update-announcement');
    Route::get('/announcement/{id}', [AdminController::class, 'showEditAnnouncement'])->name('admin.announcement.edit-announcement');

    //TOTAL FOR DASHBOARD
    // Route::get('/dashboard', [AdminController::class, 'totalDeclined'])->name('total_declined');
    Route::get('/dashboard', [AdminController::class, 'totalApplicants'])->name('dashboard');
    Route::get('/getApplicantsByGradeYear', [AdminController::class, 'getApplicantsByGradeYear'])->name('getApplicantsByGradeYear');

    //DATA APPLICANTS 
    Route::get('/applicants/new_applicants', [AdminController::class, 'showNewApplicants'])->name('admin.applicants.new_applicants');
    Route::get('/applicants-data', [AdminController::class, 'getApplicantsData'])->name('applicants.data');

    //DECLINED APPLICANTS
    Route::get('/applicants/declined_applicants', [AdminController::class, 'showDeclinedApplicants'])->name('admin.applicants.declined_applicants');
    Route::get('/applicants-declined', [AdminController::class, 'getDeclinedData'])->name('declined.data');
    
    Route::post('/applicants/new-pplicants/update-status', [AdminController::class, 'updateStatus'])->name('update.status');

    //APPROVED DECLINED APPLICANTS
    Route::get('/applicants/approved_applicants', [AdminController::class, 'showApprovedApplicants'])->name('admin.applicants.approved_applicants');
    Route::get('/applicants-approved', [AdminController::class, 'getApprovedData'])->name('approved.data');

    //VIEW DATA OF APPLICANTS
    Route::get('/applicants/{id}', [AdminController::class, 'viewApplicant'])->name('admin.view_applicant');

    //FILE UPDATE STATUS
    Route::post('/applicants/update-status', [AdminController::class, 'fileStatus'])->name('admin.update-status');

    //LOGOUT
    Route::get('/admin/admin-logout', [AdminController::class, 'logout'])->name('admin.admin-logout');
    Route::get('/export-declined-applicants', 'AdminController@exportDeclinedApplicants')->name('export.declined.applicants');

    // Route::post('/applicants/new-applicants/update-status', [AdminController::class, 'updateStatus'])->name('update.status');

});
