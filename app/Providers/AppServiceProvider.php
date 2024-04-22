<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use App\Models\NotificationApplicant;
use Illuminate\Support\ServiceProvider;

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
     * Bootstrap any application services.
     */
    public function boot()
    {

        $notifications = NotificationApplicant::orderBy('created_at', 'desc')
        ->get(['id', 'applicant_id', 'admin_name', 'message', 'status', 'created_at', 'updated_at']);

        View::share('notifications', $notifications);
    }
}
