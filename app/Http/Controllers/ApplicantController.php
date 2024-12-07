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
use App\Models\ApplicantAttendance;
use App\Traits\GoogleDriveStorageTrait;

class ApplicantController extends Controller
{
    use GoogleDriveStorageTrait;

    //show index page
    public function index()
    {
        $title = 'Real LIFE Foundation - Home';
        return view('index')->with('title', $title);
    }

    //show announcement page
    public function announcement()
    {
        $title = 'Announcement';
        $announcements = Announcement::where('published', true)
            ->orderByDesc('created_at')
            ->get();

        return view('announcement', [
            'title' => $title,
            'announcement' => $announcements
        ]);
    }

    //show contact page
    public function contact()
    {
        $title = 'Contact Us';
        return view('contact')->with('title', $title);
    }

    //show faq page
    public function faq()
    {
        $title = 'FAQ';
        return view('faq')->with('title', $title);
    }

    //show login page
    public function login()
    {
        $title = 'Login';
        return view('user.login')->with('title', $title);
    }

    //show dataprivacy page
    public function dataPrivacy()
    {
        $title = 'Data Privacy';
        return view('data-privacy')->with('title', $title);
    }

    //show home page 
    public function userHome()
    {
        $title = 'Home';
        $applicantId = auth()->id();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        return view('user.home', compact('title', 'personalInfo'));
    }

    //verification
    public function showVerification()
    {
        $title = 'Verification';
        $email = session('registered_email');
        return view('user.verification', compact('title', 'email'));
    }

    //show applicant dashboard page
    public function applicantDashboard()
    {
        $applicantId = auth()->id();

        $totalDocuments = Requirement::where('applicant_id', $applicantId)->count();

        $totalApprovedDocuments = Requirement::where('applicant_id', $applicantId)
            ->where('status', 'approved')
            ->count();

        $totalDeclinedDocuments = Requirement::where('applicant_id', $applicantId)
            ->where('status', 'declined')
            ->count();

        $approvedDocumentTypes = Requirement::where('applicant_id', $applicantId)
            ->where('status', 'approved')
            ->pluck('document_type')
            ->toArray();

        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData = ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
        $academicInfoChoiceData = ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $title = 'Dashboard';
        $reportcardData = Requirement::where('applicant_id', $applicantId)->get();

        $incomingGradeYear = $academicInfoData->incoming_grade_year ?? null;

        $documentTypes = [
            "Signed Application Form",
            "Birth Certificate",
            "Character Evaluation Forms",
            "Proof of Financial Status",
            "Application Form",
            "Character References",
            "Two References Form",
            "Home Visitation Form",
            "Report Card / Grades",
            "Prospectus",
            "Official Grading System",
            "Tuition Projection",
            "Admission Slip",
        ];

        if (
            $incomingGradeYear === 'First Year College' ||
            $incomingGradeYear === 'Second Year College' ||
            $incomingGradeYear === 'Third Year College' ||
            $incomingGradeYear === 'Fourth Year College'
        ) {
        } else {
            $documentTypes = array_diff($documentTypes, ["Official Grading System"]);
        }

        if (
            $incomingGradeYear === 'Second Year College' ||
            $incomingGradeYear === 'Third Year College' ||
            $incomingGradeYear === 'Fourth Year College'
        ) {
        } else {
            $documentTypes = array_diff($documentTypes, ["Prospectus"]);
        }

        $reportcardData = $reportcardData->map(function ($item) {
            if ($item->uploaded_at && is_string($item->uploaded_at)) {
                $item->uploaded_at = \Carbon\Carbon::parse($item->uploaded_at);
            }
            return $item;
        });

        return view('user.applicant_dashboard', compact(
            'title',
            'academicInfoData',
            'academicInfoGradesData',
            'academicInfoChoiceData',
            'personalInfo',
            'reportcardData',
            'documentTypes',
            'approvedDocumentTypes',
            'totalDocuments',
            'totalApprovedDocuments',
            'totalDeclinedDocuments'
        ));
    }

    //show personal details page
    public function personalDetails(Request $request)
    {
        $applicantId = auth()->id();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData = ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->get();
        $academicInfoChoiceData = ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $familyInfoData = ApplicantsFamilyInformation::where('applicant_id', $applicantId)->first();
        $members = Member::where('applicant_id', $applicantId)->get();

        if ($request->hasFile('payslip')) {
            $file = $request->file('payslip');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/Payslips', $filename);
            if (!$familyInfoData) {
                $familyInfoData = new ApplicantsFamilyInformation();
                $familyInfoData->applicant_id = $applicantId;
            }
            $familyInfoData->payslip = $filename;
            $familyInfoData->save();
        }

        $title = 'Personal Details';
        return view('user.personal_details', compact('title', 'academicInfoData', 'academicInfoGradesData', 'academicInfoChoiceData', 'members', 'familyInfoData', 'personalInfo'));
    }

    //get incoming grade 
    public function getIncomingGradeYearAttribute($value)
    {
        $mapping = [
            'GradeSeven' => 'Grade 7',
            'GradeEight' => 'Grade 8',
            'GradeNine' => 'Grade 9',
            'GradeTen' => 'Grade 10',
            'GradeEleven' => 'Grade 11',
            'GradeTwelve' => 'Grade 12',
            'FirstYear' => 'First Year College',
            'SecondYear' => 'Second Year College',
            'ThirdYear' => 'Third Year College',
        ];

        return $mapping[$value] ?? $value;
    }

    //apply again
    public function applyAgain(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'contact' => 'required',
            'birthday' => 'required',
            'house_number' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'municipality' => 'required',
            'mapAddress' => 'file|mimes:jpeg,jpg,png,pdf|max:2048',
            'incoming_grade_year' => 'required',
            'current_course_program_grade' => 'required',
            'current_school' => 'required',
            'first_choice_school' => 'required',
            'first_choice_course' => 'required',
            'latestAverage' => 'required',
            'total_household_members' => 'required',
            'father_occupation' => 'required',
            'father_income' => 'required',
            'mother_occupation' => 'required',
            'mother_income' => 'required',
            'payslip' => 'file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        $user = auth()->user();
        $applicant = $user->applicant;

        if (!$applicant) {
            return redirect()->back()->withErrors(['msg' => 'No applicant record found for the authenticated user.']);
        }

        $personalInfoData = [
            'applicant_id' => $applicant->applicant_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact' => $request->contact,
            'birthday' => $request->birthday,
            'house_number' => $request->house_number,
            'street' => $request->street,
            'barangay' => $request->barangay,
            'municipality' => $request->municipality,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if ($request->hasFile('mapAddress')) {
            $mapAddressFile = $request->file('mapAddress');
            $originalFilename = pathinfo($mapAddressFile->getClientOriginalName(), PATHINFO_FILENAME);
            $mapAddressFilename = $originalFilename . '.' . $mapAddressFile->getClientOriginalExtension();
            $mapAddressFilePath = $mapAddressFile->storeAs('public/map-addresses', $mapAddressFilename);
            $personalInfoData['mapAddress'] = $mapAddressFilePath;
        }

        ApplicantsPersonalInformation::create($personalInfoData);

        $academicInfoData = [
            'applicant_id' => $applicant->applicant_id,
            'incoming_grade_year' => $request->incoming_grade_year,
            'current_course_program_grade' => $request->current_course_program_grade,
            'current_school' => $request->current_school,
            'created_at' => now(),
            'updated_at' => now(),
        ];

        ApplicantsAcademicInformation::create($academicInfoData);

        $academicInfoChoiceData = [
            'applicant_id' => $applicant->applicant_id,
            'first_choice_school' => $request->first_choice_school,
            'second_choice_school' => $request->second_choice_school,
            'third_choice_school' => $request->third_choice_school,
            'first_choice_course' => $request->first_choice_course,
            'second_choice_course' => $request->second_choice_course,
            'third_choice_course' => $request->third_choice_course,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        ApplicantsAcademicInformationChoice::create($academicInfoChoiceData);

        $academicInfoGradesData = [
            'applicant_id' => $applicant->applicant_id,
            'latestAverage' => $request->latestAverage,
            'latestGWA' => $request->latestGWA,
            'scopeGWA' => $request->scopeGWA,
            'equivalentGrade' => $request->equivalentGrade,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        ApplicantsAcademicInformationGrade::create($academicInfoGradesData);

        $familyInformationData = [
            'applicant_id' => $applicant->applicant_id,
            'total_household_members' => $request->total_household_members,
            'father_occupation' => $request->father_occupation,
            'father_income' => $request->father_income,
            'mother_occupation' => $request->mother_occupation,
            'mother_income' => $request->mother_income,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        ApplicantsFamilyInformation::create($familyInformationData);

        if ($request->hasFile('payslip')) {
            $payslipFile = $request->file('payslip');
            $originalFilename = pathinfo($payslipFile->getClientOriginalName(), PATHINFO_FILENAME);
            $payslipfilename = $originalFilename . '.' . $payslipFile->getClientOriginalExtension();
            $payslipFilePath = $payslipFile->storeAs('public/Payslips', $payslipfilename);

            $payslipData = [
                'applicant_id' => $applicant->applicant_id,
                'document_type' => 'Proof of Financial Status',
                'uploaded_document' => $payslipFilePath,
                'status' => 'For Review',
                'created_at' => now(),
                'updated_at' => now(),
            ];
            Requirement::create($payslipData);
        }

        $applicant->status = 'Sent';
        $applicant->save();

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }


    //show change password page
    public function viewChangePassword()
    {
        $applicantId = auth()->id();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $title = 'Change Password';

        return view('user.change_password', compact('title', 'personalInfo'));
    }

    //upload requirements and notifications 
    public function uploadRequirements(Request $request)
    {
        $request->validate([
            'documentType' => 'required',
            'notes' => 'nullable',
            'fileUpload' => 'required|file|mimes:pdf,doc,docx|max:102400',
        ]);

        try {
            $file = $request->file('fileUpload');
            $originalFilename = $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $originalFilename, 'public');

            // Retrieve applicant personal information
            $applicantInfo = ApplicantsPersonalInformation::where('applicant_id', auth()->id())->first();
            $firstName = $applicantInfo->first_name;
            $lastName = $applicantInfo->last_name;

            // Prepare Google Drive upload information
            $driveUploadInfo = [
                'last_name' => $lastName,
                'first_name' => $firstName
            ];

            // Upload to Google Drive
            $fullLocalPath = storage_path('app/public/' . $filePath);
            $gdriveFileId = $this->uploadToGoogleDrive(
                $fullLocalPath,
                $originalFilename,
                $driveUploadInfo
            );

            // Create requirement record
            $requirement = new Requirement();
            $requirement->applicant_id = auth()->id();
            $requirement->document_type = $request->documentType;
            $requirement->notes = $request->notes;
            $requirement->uploaded_document = $filePath;
            $requirement->gdrive_file_id = $gdriveFileId; // Store Google Drive file ID
            $requirement->status = 'For Review';
            $requirement->uploaded_at = now();
            $requirement->save();

            // Create notification
            $notification = new Notification();
            $notification->applicant_id = auth()->id();
            $notification->applicant_name = "$firstName $lastName";
            $notification->message = "Submitted {$request->documentType}";
            $notification->save();

            return response()->json(['success' => 'Document uploaded successfully']);
        } catch (\Exception $e) {
            // If Google Drive upload fails, delete the local file
            if (isset($filePath)) {
                Storage::disk('public')->delete($filePath);
            }

            \Log::error('Error uploading requirement: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
                'applicant_id' => auth()->id(),
                'document_type' => $request->documentType
            ]);

            return response()->json([
                'error' => 'An error occurred while saving the document. Please try again later.'
            ], 500);
        }
    }

    //login post
    public function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user instanceof Applicant) {
                if (!$user->verify_status || !$user->email_verified_at) {
                    Auth::logout();

                    session(['unverified_email' => $user->email]);

                    if (!$user->api_token) {
                        $user->api_token = Str::random(60);
                        $user->save();
                    }

                    try {
                        Mail::to($user->email)->send(new VerificationMail($user));
                    } catch (\Exception $e) {
                        Log::error('Failed to send verification email on login: ' . $e->getMessage());
                    }

                    return redirect(route('verification-again'))
                        ->with("error", "Your email is not verified. A new verification email has been sent to your email address.");
                }
            }

            return redirect()->intended(route('user.applicant_dashboard'));
        }

        return redirect(route('login'))
            ->with("error", "Incorrect email address or password. Please try again.");
    }

    //register 
    public function register()
    {
        $title = 'Register';
        return view('user.register')->with('title', $title);
    }

    //show application form page
    public function registration()
    {
        $title = 'Registration';

        $settings = ApplicationSettings::first();

        $now = Carbon::now('Asia/Manila');

        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');

        if ($settings) {
            $startDate = $settings->start_date;
            $startTime = $settings->start_time;
            $stopDate = $settings->stop_date;
            $stopTime = $settings->stop_time;
            $applicationOpen = $this->isApplicationOpen($currentDate, $currentTime, $startDate, $startTime, $stopDate, $stopTime);
        } else {
            $applicationOpen = false;
        }

        return view('user.registration', compact('title', 'applicationOpen'));
    }

    //open and close Application
    private function isApplicationOpen($currentDate, $currentTime, $startDate, $startTime, $stopDate, $stopTime)
    {
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $stopDate = Carbon::createFromFormat('Y-m-d', $stopDate);
        $currentDate = Carbon::createFromFormat('Y-m-d', $currentDate);

        if ($currentDate->lt($startDate) || $currentDate->gt($stopDate)) {
            return false;
        }

        $currentTime = Carbon::createFromFormat('H:i:s', $currentTime);
        $startTime = Carbon::createFromFormat('H:i:s', $startTime);
        $stopTime = Carbon::createFromFormat('H:i:s', $stopTime);

        if (!$currentTime->between($startTime, $stopTime)) {
            return false;
        }

        $applicantCount = DB::table('applicants')->count();

        $maxNumber = DB::table('application_settings')->value('max_number');

        if ($applicantCount >= $maxNumber) {
            return false;
        }

        return true;
    }

    //registration post
    function registerPost(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:applicants',
            'password' => 'required|min:8',
            'firstname' => 'required',
            'lastname' => 'required',
            'contact' => 'required',
            'birthdate' => 'required',
            'houseNumber' => 'required',
            'street' => 'required',
            'barangay' => 'required',
            'municipality' => 'required',
        ]);

        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $data['status'] = 'Sent';
        $applicant = Applicant::create($data);

        if ($applicant) {
            $personalInfoData = [
                'applicant_id' => $applicant->applicant_id,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'contact' => $request->contact,
                'birthday' => $request->birthdate,
                'house_number' => $request->houseNumber,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality
            ];
            ApplicantsPersonalInformation::create($personalInfoData);

            $gradeMapping = [
                'GradeSeven' => 'Grade 7',
                'GradeEight' => 'Grade 8',
                'GradeNine' => 'Grade 9',
                'GradeTen' => 'Grade 10',
                'GradeEleven' => 'Grade 11',
                'GradeTwelve' => 'Grade 12',
                'FirstYear' => 'First Year College',
                'SecondYear' => 'Second Year College',
                'ThirdYear' => 'Third Year College',
                'FourthYear' => 'Fourth Year College',
            ];

            $incomingGrade = $request->incomingGrade;
            $convertedGrade = isset($gradeMapping[$incomingGrade]) ? $gradeMapping[$incomingGrade] : $incomingGrade;

            $academicInfoData = [
                'applicant_id' => $applicant->applicant_id,
                'incoming_grade_year' => $convertedGrade,
                'current_course_program_grade' => $request->currentProgram,
                'current_school' => $request->currentSchool
            ];

            ApplicantsAcademicInformation::create($academicInfoData);


            $academicInfoChoiceData = [
                'applicant_id' => $applicant->applicant_id,
                'first_choice_school' => $request->schoolChoice1,
                'second_choice_school' => $request->schoolChoice2,
                'third_choice_school' => $request->schoolChoice3,
                'first_choice_course' => $request->courseChoice1,
                'second_choice_course' => $request->courseChoice2,
                'third_choice_course' => $request->courseChoice3,
            ];
            ApplicantsAcademicInformationChoice::create($academicInfoChoiceData);

            $academicInfoGradesData = [
                'applicant_id' => $applicant->applicant_id,
                'grade_3_gwa' => $request->grade3GWA,
                'grade_4_gwa' => $request->grade4GWA,
                'grade_5_gwa' => $request->grade5GWA,
                'grade_6_gwa' => $request->grade6GWA,
                'grade_7_gwa' => $request->grade7GWA,
                'grade_8_gwa' => $request->grade8GWA,
                'grade_9_gwa' => $request->grade9GWA,
                'grade_10_gwa' => $request->grade10GWA,
                'grade_11_sem1_gwa' => $request->grade11FirstSemGWA,
                'grade_11_sem2_gwa' => $request->grade11SecondSemGWA,
                'grade_11_sem3_gwa' => $request->grade11ThirdSemGWA,
                'grade_11_sem4_gwa' => $request->grade11FourthSemGWA,
                'grade_12_sem1_gwa' => $request->grade12FirstSemGWA,
                'grade_12_sem2_gwa' => $request->grade12SecondSemGWA,
                'grade_12_sem3_gwa' => $request->grade12ThirdSemGWA,
                'grade_12_sem4_gwa' => $request->grade12FourthSemGWA,
                '1st_year_sem1_gwa' => $request->firstYearFirstSemGWA,
                '1st_year_sem2_gwa' => $request->firstYearSecondSemGWA,
                '1st_year_sem3_gwa' => $request->firstYearThirdSemGWA,
                '1st_year_sem4_gwa' => $request->firstYearFourthSemGWA,
                '2nd_year_sem1_gwa' => $request->secondYearFirstSemGWA,
                '2nd_year_sem2_gwa' => $request->secondYearSecondSemGWA,
                '2nd_year_sem3_gwa' => $request->secondYearThirdSemGWA,
                '2nd_year_sem4_gwa' => $request->secondYearFourthSemGWA
            ];
            ApplicantsAcademicInformationGrade::create($academicInfoGradesData);

            Household::create([
                'applicant_id' => $applicant->applicant_id,
                'total_members' => $request->input('householdMembers'),
                'payslip_path' => $request->file('payslip')->store('payslips', 'public'),
            ]);

            for ($i = 1; $i <= $request->input('householdMembers'); $i++) {
                Member::create([
                    'applicant_id' => $applicant->applicant_id,
                    'name' => $request->input("name$i"),
                    'relationship' => $request->input("relationship$i"),
                    'occupation' => $request->input("occupation$i"),
                    'monthly_income' => $request->input("monthlyIncome$i")
                ]);
            }

            $reportcardFile = $request->file('ReportCard');
            $reportcardfilename = $reportcardFile->getClientOriginalName();
            $fileName = pathinfo($reportcardfilename, PATHINFO_FILENAME);
            $extension = $reportcardFile->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $reportcardData = [
                'applicant_id' => $applicant->applicant_id,
                'document_type' => 'Report Card / Grades',
                'uploaded_document' => $reportcardFile->storeAs('ReportCards', $fileName, 'public'),
                'status' => 'For Review',
            ];

            Requirement::create($reportcardData);

            $payslipFile = $request->file('payslip');
            $payslipfilename = $payslipFile->getClientOriginalName();
            $fileName = pathinfo($payslipfilename, PATHINFO_FILENAME);
            $extension = $payslipFile->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $payslipData = [
                'applicant_id' => $applicant->applicant_id,
                'document_type' => 'Proof of Financial Status',
                'uploaded_document' => $payslipFile->storeAs('Payslips', $fileName, 'public'),
                'status' => 'For Review',
            ];
            Requirement::create($payslipData);

            return redirect(route('login'))->with("success", "Registration success, Login to access the app");
        } else {
            return redirect(route('register'))->with("error", "No internet, please try again.");
        }
    }

    //logout post
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('home'))
            ->withHeaders([
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0',
            ]);
    }

    //edit details
    public function updatePersonalDetails(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $contactNo = $request->input('contact_no');
        $birthdate = $request->input('birthdate');
        $houseNo = $request->input('house_number');
        $street = $request->input('street');
        $barangay = $request->input('barangay');
        $municipality = $request->input('municipality');

        $personalInfo = ApplicantsPersonalInformation::updateOrCreate(
            ['applicant_id' => auth()->id()],
            [
                'first_name' => $firstName,
                'last_name' => $lastName,
                'contact' => $contactNo,
                'birthday' => $birthdate,
                'house_number' => $houseNo,
                'street' => $street,
                'barangay' => $barangay,
                'municipality' => $municipality,
            ]
        );

        $familyInfoData = $request->only([
            'total_household_members',
            'father_occupation',
            'father_incom',
            'mother_occupation',
            'mother_income'
        ]);

        $familyInfo = ApplicantsFamilyInformation::updateOrCreate(
            ['applicant_id' => auth()->id()],
            $familyInfoData
        );

        $academicInfoGradesData = $request->only([
            'latestAverage',
            'latestGWA',
            'scopeGWA',
            'equivalentGrade',
            'grade_3_gwa',
            'grade_4_gwa',
            'grade_5_gwa',
            'grade_6_gwa',
            'grade_7_gwa',
            'grade_8_gwa',
            'grade_9_gwa',
            'grade_10_gwa',
            'grade_11_sem1_gwa',
            'grade_11_sem2_gwa',
            'grade_11_sem3_gwa',
            'grade_11_sem4_gwa',
            'grade_12_sem1_gwa',
            'grade_12_sem2_gwa',
            'grade_12_sem3_gwa',
            'grade_12_sem4_gwa',
            '1st_year_sem1_gwa',
            '1st_year_sem2_gwa',
            '1st_year_sem3_gwa',
            '1st_year_sem4_gwa',
            '2nd_year_sem1_gwa',
            '2nd_year_sem2_gwa',
            '2nd_year_sem3_gwa',
            '2nd_year_sem4_gwa'
        ]);

        $academicInfoGradesData['applicant_id'] = auth()->id();

        $academicInfo = ApplicantsAcademicInformationGrade::updateOrCreate(
            ['applicant_id' => auth()->id()],
            $academicInfoGradesData
        );

        $academicInfoData = $request->only([
            'current_course_program_grade',
            'current_school'
        ]);
        $academicInfoData['applicant_id'] = auth()->id();

        $academicInfoIncoming = ApplicantsAcademicInformation::updateOrCreate(
            ['applicant_id' => auth()->id()],
            [
                'current_course_program_grade' => $academicInfoData['current_course_program_grade'] ?? null,
                'current_school' => $academicInfoData['current_school'] ?? null
            ]
        );

        $academicInfoChoiceData = $request->only([
            'first_choice_school',
            'second_choice_school',
            'third_choice_school',
            'first_choice_course',
            'second_choice_course',
            'third_choice_course'
        ]);
        $academicInfoChoiceData['applicant_id'] = auth()->id();

        $academicChoices = ApplicantsAcademicInformationChoice::updateOrCreate(
            ['applicant_id' => auth()->id()],
            $academicInfoChoiceData
        );

        if ($personalInfo && $academicInfo && $academicInfoIncoming && $academicChoices && $familyInfo) {
            return redirect()->back()->with('success', 'Updated Successfully!')->with(compact('familyInfoData'));
        } else {
            return redirect()->back()->with('error', 'Failed to Update');
        }
    }

    //change password
    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'min:8',
                    'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/',
                    'different:current_password'
                ],
                'renew_password' => 'required|same:new_password',
            ], [
                'renew_password.same' => 'The re-enter new password field must match new password.',
                'new_password.regex' => 'The new password must contain at least one lowercase letter, one uppercase letter, and one number.',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $applicantId = auth()->id();
            $user = Auth::user();

            if ($user->applicant_id !== $applicantId) {
                return response()->json(['errors' => ['auth' => ['Unauthorized access.']]]);
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['errors' => ['current_password' => ['The current password is incorrect.']]]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            \Log::info('Password changed successfully for user: ' . $user->email);

            return response()->json(['success' => 'Password changed successfully!']);
        } catch (\Exception $e) {
            \Log::error('Error changing password: ' . $e->getMessage());
            return response()->json(['errors' => ['general' => ['Password change failed. Please try again later.']]]);
        }
    }


    //notification fetch
    public function fetchNotificationCount()
    {
        try {
            $applicantId = Auth::id();
            $count = NotificationApplicant::where('applicant_id', $applicantId)
                ->where('status', 'unread')
                ->count();

            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            \Log::error('Error fetching notification count: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching notification count.'], 500);
        }
    }

    //notification mark
    public function markNotificationsAsRead()
    {
        try {
            $applicantId = Auth::id();

            NotificationApplicant::where('applicant_id', $applicantId)
                ->where('status', 'unread')
                ->update(['status' => 'read']);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error marking notifications as read: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to mark notifications as read'], 500);
        }
    }

    //update documents uploaded
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'documentType' => 'required|string',
                'notes' => 'nullable|string',
                'uploaded_document' => 'file|mimes:pdf|max:102400',
            ]);

            $document = Requirement::findOrFail($id);
            $document->document_type = $request->input('documentType');
            $document->notes = $request->input('notes');

            // If a new file is uploaded
            if ($request->hasFile('uploaded_document')) {
                $uploadedFile = $request->file('uploaded_document');
                $originalFileName = $uploadedFile->getClientOriginalName();
                $uploadedFilePath = $uploadedFile->storeAs('uploads', $originalFileName, 'public');

                // Delete old local file
                if ($document->uploaded_document) {
                    $oldFilePath = str_replace('public/', '', $document->uploaded_document);
                    Storage::disk('public')->delete($oldFilePath);
                }

                // Delete old Google Drive file if it exists
                if ($document->gdrive_file_id) {
                    try {
                        $this->deleteFromGoogleDrive($document->gdrive_file_id);
                    } catch (\Exception $e) {
                        Log::error('Failed to delete old Google Drive file', [
                            'file_id' => $document->gdrive_file_id,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                // Upload new file to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $uploadedFilePath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $originalFileName,
                        // Attempt to get applicant information if possible
                        // You might need to adjust this based on how you retrieve applicant info
                        [
                            'last_name' => optional($document->applicant)->last_name ?? '',
                            'first_name' => optional($document->applicant)->first_name ?? ''
                        ]
                    );

                    // Update document with new file path and Google Drive file ID
                    $document->uploaded_document = $uploadedFilePath;
                    $document->gdrive_file_id = $gdriveFileId;
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed during document update', [
                        'document_id' => $document->id,
                        'error' => $e->getMessage()
                    ]);

                    // Rollback local file upload if Google Drive upload fails
                    Storage::disk('public')->delete($uploadedFilePath);

                    throw $e;
                }
            }

            $document->save();

            return response()->json(['message' => 'Document updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update document',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    //show edit documents
    public function showEdit($id)
    {
        $document = Requirement::findOrFail($id);
        return response()->json([
            'id' => $document->id,
            'document_type' => $document->document_type,
            'notes' => $document->notes,
            'uploaded_document' => $document->uploaded_document,
        ]);
    }

    //application form post
    public function screeningPost(Request $request)
    {
        try {
            \Log::info('Screening Post Request Started');
            \Log::info('Request Data:', $request->all());

            $request->validate([
                'email' => 'required|email|unique:applicants',
                'password' => 'required|min:8',
                'firstname' => 'required',
                'lastname' => 'required',
                'contact' => 'required',
                'birthdate' => 'required',
                'houseNumber' => 'required',
                'street' => 'required',
                'barangay' => 'required',
                'municipality' => 'required',
                'mapAddress' => 'file|mimes:jpeg,jpg,png,pdf',
                'attend_orientation' => 'required|in:yes,no',
                'orientation_date' => 'required_if:attend_orientation,yes',
                'orientation_proof' => 'nullable|file|mimes:jpeg,jpg,png,pdf',
                'schoolGrade.*' => 'required|string',
                'yearLevel.*' => 'required|string',
                'generalAverage.*' => 'required|numeric|between:0,100',
                'reasonGrades' => 'required|string',
                'current_course_program_grade' => 'nullable|string',
            ]);

            \Log::info('Validation Passed');

            DB::beginTransaction();

            //main applicant record
            $data = [
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'status' => 'Sent'
            ];
            $applicant = Applicant::create($data);

            if (!$applicant) {
                throw new \Exception('Failed to create applicant record');
            }

            $personalInfoData = [
                'applicant_id' => $applicant->applicant_id,
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'contact' => $request->contact,
                'birthday' => $request->birthdate,
                'house_number' => $request->houseNumber,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality,
            ];

            // Map Address file
            if ($request->hasFile('mapAddress')) {
                $mapAddressFile = $request->file('mapAddress');
                $originalFilename = pathinfo($mapAddressFile->getClientOriginalName(), PATHINFO_FILENAME);
                $mapAddressFilename = uniqid() . '_' . $originalFilename . '.' . $mapAddressFile->getClientOriginalExtension();

                $mapAddressFilePath = $mapAddressFile->storeAs('map-addresses', $mapAddressFilename, 'public');

                // Update personal info with local file path
                $personalInfoData['mapAddress'] = $mapAddressFilePath;

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $mapAddressFilePath);
                    $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $mapAddressFilename,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Map Address', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            ApplicantsPersonalInformation::create($personalInfoData);

            $gradeMapping = [
                'GradeSeven' => 'Grade 7',
                'GradeEight' => 'Grade 8',
                'GradeNine' => 'Grade 9',
                'GradeTen' => 'Grade 10',
                'GradeEleven' => 'Grade 11',
                'GradeTwelve' => 'Grade 12',
                'FirstYear' => 'First Year College',
                'SecondYear' => 'Second Year College',
                'ThirdYear' => 'Third Year College',
            ];

            $incomingGrade = $request->incomingGrade;
            $convertedGrade = isset($gradeMapping[$incomingGrade]) ? $gradeMapping[$incomingGrade] : $incomingGrade;

            //academic information
            $academicInfoData = [
                'applicant_id' => $applicant->applicant_id,
                'incoming_grade_year' => $convertedGrade,
                'current_course_program_grade' => $request->current_course_program_grade,
                'current_school' => $request->currentSchool,
                'reasonGrades' => $request->reasonGrades
            ];
            ApplicantsAcademicInformation::create($academicInfoData);

            $academicInfoChoiceData = [
                'applicant_id' => $applicant->applicant_id,
                'first_choice_school' => $request->schoolChoice1,
                'second_choice_school' => $request->schoolChoice2,
                'third_choice_school' => $request->schoolChoice3,
                'first_choice_course' => $request->courseChoice1,
                'second_choice_course' => $request->courseChoice2,
                'third_choice_course' => $request->courseChoice3,
            ];
            ApplicantsAcademicInformationChoice::create($academicInfoChoiceData);

            //academic choices
            $schoolGrades = $request->schoolGrade;
            $yearLevels = $request->yearLevel;
            $generalAverages = $request->generalAverage;

            //grades
            $schoolGrades = is_array($schoolGrades) ? $schoolGrades : [$schoolGrades];
            $yearLevels = is_array($yearLevels) ? $yearLevels : [$yearLevels];
            $generalAverages = is_array($generalAverages) ? $generalAverages : [$generalAverages];

            foreach ($schoolGrades as $index => $schoolGrade) {
                ApplicantsAcademicInformationGrade::create([
                    'applicant_id' => $applicant->applicant_id,
                    'schoolGrade' => $schoolGrade,
                    'yearLevel' => $yearLevels[$index] ?? null,
                    'generalAverage' => $generalAverages[$index] ?? null,
                ]);
            }

            //family information
            $familyInformationData = [
                'applicant_id' => $applicant->applicant_id,
                'total_household_members' => $request->householdMembers,
                'father_occupation' => $request->fatherOccupation,
                'father_income' => $request->fatherIncome,
                'mother_occupation' => $request->motherOccupation,
                'mother_income' => $request->incomeMother,
                'othersOccupation' => $request->othersOccupation,
                'othersRelationship' => $request->othersRelationship,
                'othersIncome' => $request->othersIncome,
                'additionalInfo' => $request->additionalInfo
            ];
            ApplicantsFamilyInformation::create($familyInformationData);

            // Report Card file
            if ($request->hasFile('ReportCard')) {
                $reportcardFile = $request->file('ReportCard');
                $reportcardfilename = $reportcardFile->getClientOriginalName();

                $reportcardFilePath = $reportcardFile->storeAs('report-cards', $reportcardfilename, 'public');

                $requirement = Requirement::create([
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Report Card / Grades',
                    'uploaded_document' => $reportcardFilePath,
                    'status' => 'For Review',
                    'uploaded_at' => now()
                ]);

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $reportcardFilePath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $reportcardfilename,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );

                    // Update requirement with Google Drive file ID
                    $requirement->update(['gdrive_file_id' => $gdriveFileId]);
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Report Card', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Payslip file
            if ($request->hasFile('payslip')) {
                $payslipFile = $request->file('payslip');
                $payslipfilename = $payslipFile->getClientOriginalName();

                $payslipFilePath = $payslipFile->storeAs('payslips', $payslipfilename, 'public');

                $requirement = Requirement::create([
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Proof of Financial Status',
                    'uploaded_document' => $payslipFilePath,
                    'status' => 'For Review',
                    'uploaded_at' => now()
                ]);

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $payslipFilePath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $payslipfilename,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );

                    // Update requirement with Google Drive file ID
                    $requirement->update(['gdrive_file_id' => $gdriveFileId]);
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Payslip', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Application Form file
            if ($request->hasFile('applicationForm')) {
                $applicationFormFile = $request->file('applicationForm');
                $applicationFormname = $applicationFormFile->getClientOriginalName();

                $applicationFormPath = $applicationFormFile->storeAs('application-forms', $applicationFormname, 'public');

                $requirement = Requirement::create([
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Application Form',
                    'uploaded_document' => $applicationFormPath,
                    'status' => 'For Review',
                    'uploaded_at' => now()
                ]);

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $applicationFormPath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $applicationFormname,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );

                    // Update requirement with Google Drive file ID
                    $requirement->update(['gdrive_file_id' => $gdriveFileId]);
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Application Form', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Character References file
            if ($request->hasFile('characterReferences')) {
                $characterReferencesFile = $request->file('characterReferences');
                $characterReferencesname = $characterReferencesFile->getClientOriginalName();

                $characterReferencesPath = $characterReferencesFile->storeAs('character-references', $characterReferencesname, 'public');

                $requirement = Requirement::create([
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Character References',
                    'uploaded_document' => $characterReferencesPath,
                    'status' => 'For Review',
                    'uploaded_at' => now()
                ]);

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $characterReferencesPath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $characterReferencesname,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );

                    // Update requirement with Google Drive file ID
                    $requirement->update(['gdrive_file_id' => $gdriveFileId]);
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Character References', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            // Grading System file
            if ($request->hasFile('GradingSystem')) {
                $gradingSystemFile = $request->file('GradingSystem');
                $gradingSystemname = $gradingSystemFile->getClientOriginalName();

                $gradingSystemPath = $gradingSystemFile->storeAs('grading-system', $gradingSystemname, 'public');

                $requirement = Requirement::create([
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Grading System',
                    'uploaded_document' => $gradingSystemPath,
                    'status' => 'For Review',
                    'uploaded_at' => now()
                ]);

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $gradingSystemPath);
                    $gdriveFileId = $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $gradingSystemname,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ]
                    );

                    // Update requirement with Google Drive file ID
                    $requirement->update(['gdrive_file_id' => $gdriveFileId]);
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Grading System', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            //attendance record
            $attendanceData = [
                'applicant_id' => $applicant->applicant_id,
                'attend_orientation' => $request->attend_orientation,
                'orientation_date' => $request->attend_orientation == 'yes' ? $request->orientation_date : null
            ];

            // Orientation Proof file
            if ($request->hasFile('orientation_proof')) {
                $orientationProofFile = $request->file('orientation_proof');
                $orientationProofFilename = $orientationProofFile->getClientOriginalName();

                $orientationProofPath = $orientationProofFile->storeAs('orientation-proofs', $orientationProofFilename, 'public');
                $attendanceData['orientation_proof'] = $orientationProofPath;

                // Upload to Google Drive
                try {
                    $fullLocalPath = storage_path('app/public/' . $orientationProofPath);
                    $this->uploadToGoogleDrive(
                        $fullLocalPath,
                        $orientationProofFilename,
                        [
                            'last_name' => $request->lastname,
                            'first_name' => $request->firstname
                        ],
                        'orientation-proof'
                    );
                } catch (\Exception $e) {
                    Log::error('Google Drive upload failed for Orientation Proof', [
                        'applicant_id' => $applicant->applicant_id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            ApplicantAttendance::create($attendanceData);

            $verificationToken = Str::random(60);
            $applicant->api_token = $verificationToken;
            $applicant->save();

            \Mail::to($applicant->email)->send(new \App\Mail\VerificationMail($applicant));

            DB::commit();

            session(['registered_email' => $applicant->email]);

            return response()->json([
                'message' => 'Registration successful, please check your email for verification.',
                'redirect' => route('verification')
            ], 201);
        } catch (\Exception $e) {
            DB::rollback();
            \Log::error('Registration Failed: ' . $e->getMessage());
            \Log::error('Error Trace: ' . $e->getTraceAsString());
            return response()->json([
                'message' => 'Registration failed: ' . $e->getMessage(),
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
