<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\ApplicationSettingsController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\ForgotPasswordController;

// ANNOUNCEMENT
Route::get('/announcement', [ApplicantController::class, 'announcement'])->name('announcement')->middleware('PreventBackHistory');

//CONTACT
Route::get('/contact', [ApplicantController::class, 'contact'])->name('contact')->middleware('PreventBackHistory');

//FAQ
Route::get('/faq', [ApplicantController::class, 'faq'])->name('faq')->middleware('PreventBackHistory');

Route::get('/data-privacy', [ApplicantController::class, 'dataPrivacy'])->name('data-privacy')->middleware('PreventBackHistory');

Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotPasswordPage'])->name('user.forgot-password.forgot-password')->middleware('PreventBackHistory');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('send-reset-link');
Route::get('reset-password/{token}/{email}', [ForgotPasswordController::class, 'showResetForm'])
     ->name('password.reset');

Route::post('reset-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.update');



Route::middleware(['guest', 'PreventBackHistory'])->group(function () {
    Route::get('/', [ApplicantController::class, 'index'])->name('home');
  
    //APPLICANT LOGIN 
    Route::get('/login', [ApplicantController::class, 'login'])->name('login');
    Route::post('/login', [ApplicantController::class, 'loginPost'])->name('login.post');

    Route::get('/register', [ApplicantController::class, 'register'])->name('register');
    Route::post('/register', [ApplicantController::class, 'registerPost'])->name('register.post');

    //APPLICANT APPLICATION FORM
    Route::get('/registration', [ApplicantController::class, 'registration'])->name('registration');
    Route::post('/registration', [ApplicantController::class, 'screeningPost'])->name('screening.post');

    //EMAIL VERIFICATION 
    Route::get('/verify-email/{token}', [VerificationController::class, 'verify'])->name('verify');
  
    //EMAIL 
    Route::get('/email', [EmailController::class, 'create']);
    Route::post('/email', [EmailController::class, 'sendEmail'])->name('send.email');

    Route::get('/verify-email/{token}', [VerificationController::class, 'verify'])->name('verify');
    Route::get('/verification', [ApplicantController::class, 'showVerification'])->name('verification');
    Route::get('/verification_success', [VerificationController::class, 'showVerificationSucess'])->name('verification_sucess');

    Route::get('/resend-verification', [VerificationController::class, 'resendVerificationEmail'])->name('resend.verification');
    Route::get('/verification-again', [VerificationController::class, 'verificationAgain'])->name('user.verification-again');
});


//Applicant
Route::middleware(['auth', 'PreventBackHistory'])->group(function () {

    //PERSONAL DETAILS
    Route::get('/personal-details', [ApplicantController::class, 'personalDetails'])->name('user.profile');
    Route::post('/logout', [ApplicantController::class, 'logout'])->name('logout');

    Route::post('/update-personal-details', [ApplicantController::class, 'updatePersonalDetails'])->name('update_personal_details');

    Route::post('/user/change-password', [ApplicantController::class, 'changePassword'])->name('change.password');
    Route::get('/applicant_dashboard', [ApplicantController::class, 'applicantDashboard'])->name('user.applicant_dashboard');
    Route::get('/change_password', [ApplicantController::class, 'viewChangePassword'])->name('user.change_password');
    Route::post('/add-requirements', [ApplicantController::class, 'store']);

    Route::post('/change-applicant-status/{applicant_id}', [ApplicantController::class, 'changeStatus'])->name('change.applicant.status');
    Route::get('/getUnreadNotificationsCount', [ApplicantController::class, 'getUnreadNotificationsCount']);

    Route::post('/applicant_dashboard', [ApplicantController::class, 'uploadRequirements'])->name('applicant_dashboard.requirements');

    //NOTIFICATION
    Route::get('/notifications.show', [ApplicantController::class, 'showApplicantNotifications'])->name('notifications.show');
    Route::get('/applicant-fetch-notification-count', [ApplicantController::class, 'fetchNotificationCount'])->name('applicant-fetch-notification-count');
    Route::post('/applicant-mark-notifications-as-read', [ApplicantController::class, 'markNotificationsAsRead'])->name('applicant-mark-notifications-as-read');

    Route::post('/documents/{id}', [ApplicantController::class, 'update'])->name('update_document');
    Route::get('/documents/{id}', [ApplicantController::class, 'showEdit'])->name('show_document');

    Route::get('/upload/documents', [DocumentsController::class, 'showUploadDocuments'])->name('user.documents.upload-documents');
    Route::post('/apply-again', [ApplicantController::class, 'applyAgain'])->name('apply.again');

});


//Admin
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
    // Route::delete('/delete-announcement/{id}', [AdminController::class, 'deleteAnnouncement'])->name('delete.announcement');
    Route::delete('/admin/announcement/delete/{id}', [AdminController::class, 'deleteAnnouncement'])->name('delete.announcement');

    Route::match(['post', 'put'], '/announcement/update-announcement/{id}', [AdminController::class, 'updateAnnouncement'])->name('admin.update-announcement');
    Route::get('/announcement/{id}', [AdminController::class, 'showEditAnnouncement'])->name('admin.announcement.edit-announcement');

    Route::get('/announcement/publish/{id}', [AdminController::class, 'publishAnnouncement'])->name('admin.announcement.publish');
    Route::get('/announcement/unpublish/{id}', [AdminController::class, 'unpublishAnnouncement'])->name('admin.announcement.unpublish');
    
    //TOTAL FOR DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'new_dashboard'])->name('admin.dashboard-new');
    Route::get('/dashboard', [AdminController::class, 'totalApplicants'])->name('dashboard');
    Route::get('/getApplicantsByGradeYear', [AdminController::class, 'getApplicantsByGradeYear'])->name('getApplicantsByGradeYear');
    Route::get('/admin/get-dashboard-data', [AdminController::class, 'getDashboardData'])->name('admin.get-dashboard-data');

    //DATA APPLICANTS 
    Route::get('/applicants/new_applicants', [AdminController::class, 'showNewApplicants'])->name('admin.applicants.new_applicants');
    Route::get('/applicants-data', [AdminController::class, 'getApplicantsData'])->name('applicants.data');

    //DECLINED APPLICANTS
    Route::get('/applicants/declined_applicants', [AdminController::class, 'showDeclinedApplicants'])->name('admin.applicants.declined_applicants');
    Route::get('/applicants-declined', [AdminController::class, 'getDeclinedData'])->name('declined.data');

    //UPDATE STATUS
    Route::post('/applicants/new-applicants/update-status', [AdminController::class, 'updateStatus'])->name('update.status');

    //APPROVED DECLINED APPLICANTS
    Route::get('/applicants/approved_applicants', [AdminController::class, 'showApprovedApplicants'])->name('admin.applicants.approved_applicants');
    Route::get('/applicants-approved', [AdminController::class, 'getApprovedData'])->name('approved.data');

    //VIEW DATA OF APPLICANTS
    Route::group(['prefix' => '/applicants'], function() {
        Route::get('/view/{id}', [AdminController::class, 'viewApplicant'])->name('admin.view_applicant');
        Route::post('/{id}/notify', [EmailController::class, 'notifyApplicant'])->name('notify.applicant');
        Route::get('/{id}/approved-documents', [AdminController::class, 'getApprovedDocuments'])->name('applicants.approved_documents');
    });

    //FILE UPDATE STATUS
    Route::post('/applicants/{requirement_id}', [AdminController::class, 'fileStatus'])->name('requirements.file-status');

    //LOGOUT
    Route::get('/admin/admin-logout', [AdminController::class, 'logout'])->name('admin.admin-logout');
    Route::get('/export-declined-applicants', 'AdminController@exportDeclinedApplicants')->name('export.declined.applicants');
    
    //NOTIFICATION
    Route::get('/fetch-notification-count', [AdminController::class, 'fetchNotificationCount'])->name('fetch-notification-count');
    Route::post('/mark-notifications-as-read', [AdminController::class, 'markNotificationsAsRead'])->name('mark-notifications-as-read');

    //EXPORT EXCEL
    Route::get('/export', [AdminController::class, 'exportData'])->name('export.applicants');
    Route::get('/export.approved.applicants', [AdminController::class, 'exportApproved'])->name('export.approved.applicants');
    Route::get('/export.declined.applicants', [AdminController::class, 'exportDeclined'])->name('export.declined.applicants');

    //EMAIL CONTENT
    Route::get('/email/email', [EmailController::class, 'emailShow'])->name('admin.email.email');
    Route::prefix('/email')->name('admin.email.')->group(function () {
        Route::post('/save-under-review-content', [EmailController::class, 'saveUnderReviewContent'])->name('save-under-review-content');
        Route::post('/save-shortlisted-content', [EmailController::class, 'saveShortlistedContent'])->name('save-shortlisted-content');
        Route::post('/save-interview-content', [EmailController::class, 'saveInterviewContent'])->name('save-interview-content');
        Route::post('/save-house-visitation-content', [EmailController::class, 'saveHouseVisitationContent'])->name('save-house-visitation-content');
        Route::post('/save-decline-content', [EmailController::class, 'saveDeclineContent'])->name('save-decline-content');
        Route::post('/save-approved-content', [EmailController::class, 'saveApprovedContent'])->name('save-approved-content');

    });

    //REPORT SUMMARY - DASHBOARD
    Route::get('/get-data-for-year', [AdminController::class, 'getDataForYear'])->name('get-data-for-year');
    Route::get('/get-graph-data-for-year', [AdminController::class, 'getGraphDataForYear'])->name('get-graph-data-for-year');

    //UPLOADED FILES
    Route::get('/uploaded-files', [AdminController::class, 'showUploadedFiles'])->name('admin.uploaded-files');

    Route::get('/get-data-for-applicant-year', [AdminController::class, 'getDataForApplicantYear'])->name('get-data-for-applicant-year');

    Route::get('/application-settings', [ApplicationSettingsController::class, 'showApplicationSettings'])->name('admin.application-settings');

    // Route::put('/application_settings/{id}', [ApplicationSettingsController::class, 'update'])->name('application_settings.update');
    Route::post('/application-settings/save', [ApplicationSettingsController::class, 'save'])->name('application.settings.save');
    Route::get('/fetch-notification-count', [ApplicationSettingsController::class, 'fetch'])->name('application-settings.save');

     //COUNT CURRENT NUMBER OF APPLICANTS
    //  Route::get('/applicants/count', [ApplicationSettingsController::class, 'getApplicantsCount'])->name('/applicants/count');


    //SELECT YEAR
    // Route::get('/get-declined-applicants-by-year', [AdminController::class, 'getDeclinedApplicantsByYear'])->name('ajax.get_declined_applicants');
    Route::get('/get-approved-applicants-by-date-range', [AdminController::class, 'getApprovedApplicantsByDateRange']);
    Route::get('/get-declined-applicants-by-year', [AdminController::class, 'getDeclinedApplicantsByDateRange']);


   
});

