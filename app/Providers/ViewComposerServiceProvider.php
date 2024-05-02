<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\NotificationApplicant;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check() && Auth::user() instanceof \App\Models\Applicant) {
                $applicantId = Auth::id();
                
                $notifications = NotificationApplicant::where('applicant_id', $applicantId)
                    ->orderBy('created_at', 'desc')
                    ->get(['id', 'applicant_id', 'admin_name', 'message', 'status', 'created_at', 'updated_at']);
                
                $view->with('applicantNotifications', $notifications);
            }
        });
    }
}
