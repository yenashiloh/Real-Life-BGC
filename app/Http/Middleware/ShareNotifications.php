<?php

// File: app/Http/Middleware/ShareNotifications.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\NotificationApplicant;

class ShareNotifications
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $applicantId = Auth::id();

            $notifications = NotificationApplicant::where('applicant_id', $applicantId)
                ->orderBy('created_at', 'desc')
                ->get(['id', 'applicant_id', 'admin_name', 'message', 'status', 'created_at', 'updated_at']);

            View::share('notifications', $notifications);
        }

        return $next($request);
    }
}

