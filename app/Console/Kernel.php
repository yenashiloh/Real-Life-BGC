<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $settings = \App\Models\ApplicationSettings::first();
            $now = \Carbon\Carbon::now('Asia/Manila');
    
            // Parse start and stop times with today's date
            $startTime = \Carbon\Carbon::parse($settings->start_time, 'Asia/Manila')->setDate($now->year, $now->month, $now->day);
            $stopTime = \Carbon\Carbon::parse($settings->stop_time, 'Asia/Manila')->setDate($now->year, $now->month, $now->day);
    
            // Log parsed start and stop times for debugging
            \Illuminate\Support\Facades\Log::info('Parsed start time: ' . $startTime);
            \Illuminate\Support\Facades\Log::info('Parsed stop time: ' . $stopTime);
            \Illuminate\Support\Facades\Log::info('Now: ' . $now);
    
            // Determine current status based on current time compared to start and stop times
            $currentStatus = ($now >= $startTime && $now <= $stopTime) ? 'Opened' : 'Closed';
    
            // Log current status for debugging
            \Illuminate\Support\Facades\Log::info('Current status: ' . $currentStatus);
    
            // Update the current status in the database
            $settings->current_status = $currentStatus;
            $settings->save();
        })->everyMinute();
    }
    
    
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    
}
