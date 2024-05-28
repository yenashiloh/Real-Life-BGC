<?php

namespace App\Http\Controllers;
use App\Models\Applicant;
use App\Models\ApplicantsPersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement;
use App\Models\ApplicantsAcademicInformation;
use App\Models\ApplicantsAcademicInformationChoice;
use App\Models\ApplicantsAcademicInformationGrade;
use App\Models\Household;
use App\Models\Member;
use App\Models\NotificationApplicant;
use App\Models\Requirement;
use App\Models\Notification;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\ApplicantsFamilyInformation;
use App\Mail\VerificationMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;


class VerificationController extends Controller
{
    public function verify($token)
    {
        $applicant = Applicant::where('api_token', $token)->first();
    
        if (!$applicant) {
            return redirect()->route('login')->with('error', 'Invalid verification token.');
        }
    
        $applicant->email_verified_at = now();
        $applicant->verify_status = 'verified'; 
        $applicant->api_token = null; 
        $applicant->save();
    
        return response()->view('user.verification_success', ['message' => 'Your email is now verified and your application has successfully reached the scholarship provider.']);
    }
    

    
    public function sendVerificationEmail($token)
    {
        $applicant = Applicant::where('api_token', $token)->first();

        if (!$applicant) {
            return redirect(route('login'))->with('error', 'Invalid verification token.');
        }

        \Mail::to($applicant->email)->send(new VerificationMail($applicant));

        return redirect()->back()->with('success', 'Verification email sent successfully.');
    }

    public function showVerificationSuccess()
    {
        $title = 'Verification';
        return view('user.verification_success')->with('title', $title);
    }

}