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
use App\Mail\VerificationEmail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationMail;
use App\Models\ApplicationSettings;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    public function showUploadDocuments()
    {
        $applicantId = auth()->id();
        $approvedDocumentTypes = Requirement::where('applicant_id', $applicantId)
            ->where('status', 'approved')
            ->pluck('document_type')
            ->toArray();

        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData =  ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
        $academicInfoChoiceData =  ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $title = 'Dashboard';
        $reportcardData = Requirement::where('applicant_id', $applicantId)->get();
    
        $reportcardData = $reportcardData->map(function ($item) {
            if ($item->uploaded_at && is_string($item->uploaded_at)) {
                $item->uploaded_at = \Carbon\Carbon::parse($item->uploaded_at);
            }
            return $item;
        });
        
        $documentTypes = [
            "Signed Application Form",
            "Birth Certificate",
            "Character Evaluation Forms",
            "Proof of Financial Status",
            "Payslip / Social Case Study Report / ITR",
            "Two References Form",
            "Home Visitation Form",
            "Report Card / Grades",
            "Prospectus",
            "Official Grading System",
            "Tuition Projection",
            "Admission Slip"
        ];
    
        return view('user.documents.upload-documents', compact('title', 'academicInfoData', 'academicInfoGradesData', 
        'academicInfoChoiceData', 'personalInfo' , 'reportcardData', 'documentTypes', 'approvedDocumentTypes'));
    }
}
