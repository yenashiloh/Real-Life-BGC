<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;    
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\Applicant;
use App\Models\ApplicantsAcademicInformation;
use App\Models\ApplicantsPersonalInformation;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Mail;
use App\Notifications\StatusUpdateNotification; 
use App\Models\ApplicantsAcademicInformationChoice;
use App\Models\ApplicantsAcademicInformationGrade;
use App\Models\Member;
use App\Models\Notification;
use App\Models\NotificationApplicant;
use App\Models\Requirement;
use App\Models\ApplicationSettings;
use Carbon\Carbon;



class ApplicationSettingsController extends Controller
{

    public function showApplicationSettings()
    {
        $settings = ApplicationSettings::first();

        return view('admin.application-settings', compact('settings'));
    }


    public function save(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'start_date' => 'required|date',
            'start_time' => 'required',
            'max_number' => 'required|numeric',
            'stop_date' => 'required|date',
            'stop_time' => 'required',
        ]);
    
        // Convert start and stop times to Philippine time zone
        $timezone = 'Asia/Manila';
        $startDate = \Carbon\Carbon::parse($validatedData['start_date'] . ' ' . $validatedData['start_time'], $timezone);
        $stopDate = \Carbon\Carbon::parse($validatedData['stop_date'] . ' ' . $validatedData['stop_time'], $timezone);
        
        // Ensure the parsed start and stop times have the correct date
        $startDate->setDate(now()->year, now()->month, now()->day);
        $stopDate->setDate(now()->year, now()->month, now()->day);
        
        // Determine the current status based on the current time, start time, and stop time
        $now = now()->setTimezone($timezone);
        $currentStatus = $this->getCurrentStatus($now, $startDate, $stopDate);
    
        // Update or create ApplicationSettings
        $settings = ApplicationSettings::first();
        $settings->fill($validatedData);
        $settings->current_status = $currentStatus;
        $settings->save();
    
        return redirect()->route('admin.application-settings')->with('success', 'Application settings saved successfully.');
    }
    
    private function getCurrentStatus($currentTime, $startTime, $stopTime)
    {
        // Check if current time is within the range of start and stop times
        if ($currentTime->between($startTime, $stopTime)) {
            return 'Opened';
        } else {
            return 'Closed';
        }
    }
    
    
    public function fetch()
    {
        $settings = ApplicationSettings::first();
        return response()->json(['current_status' => $settings->current_status]);
    }   

    
}
