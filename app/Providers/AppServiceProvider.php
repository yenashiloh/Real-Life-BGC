<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\NotificationApplicant;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use App\Models\Requirement;
use App\Models\Applicant;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.a
     */
    public function boot()
    {
        // Log::info('AppServiceProvider boot method called.');

        // if (Auth::check()) {
        //     // Retrieve the authenticated user's ID
        //     $applicantId = Auth::id();
        
        //     // Fetch notifications for the authenticated user
        //     $notifications = NotificationApplicant::where('applicant_id', $applicantId)
        //         ->orderBy('created_at', 'desc')
        //         ->get(['id', 'applicant_id', 'admin_name', 'message', 'status', 'created_at', 'updated_at']);
        
        //     // Share notifications with all views
        //     View::share('notifications', $notifications);
        // } else {
        //     // User is not authenticated
        //     Log::error('User not authenticated in AppServiceProvider boot method.');
        //     // Additional debug info
        //     Log::debug('Session ID: ' . session()->getId());
        //     Log::debug('Auth User: ' . (Auth::user() ? 'Authenticated' : 'Not Authenticated'));
        // }
        
    }
}
