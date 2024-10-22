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


class ApplicantController extends Controller
{
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
        return view('user.home', compact('title', 'personalInfo' ));
    }

    //verification
    public function showVerification()
    {
        $title = 'Verification';
        return view('user.verification')->with('title', $title);
    }

    //show applicant dashboard page
    public function applicantDashboard()
    {
        $applicantId = auth()->id();
    
        // count total submitted documents
        $totalDocuments = Requirement::where('applicant_id', $applicantId)->count();
    
        // count total approved documents
        $totalApprovedDocuments = Requirement::where('applicant_id', $applicantId)
            ->where('status', 'approved')
            ->count();
    
        // count total declined documents
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
    
        return view('user.applicant_dashboard', compact('title', 'academicInfoData', 'academicInfoGradesData',
            'academicInfoChoiceData', 'personalInfo', 'reportcardData', 'documentTypes', 'approvedDocumentTypes', 
            'totalDocuments', 'totalApprovedDocuments', 'totalDeclinedDocuments'));
    }

    //show personal details page
    public function personalDetails(Request $request)
    {
        $applicantId = auth()->id();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData = ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
        $academicInfoChoiceData = ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $familyInfoData = ApplicantsFamilyInformation::where('applicant_id', $applicantId)->first();
        $members = Member::where('applicant_id', $applicantId)->get();
    
        // Handle the file upload if a file is present
        if ($request->hasFile('payslip')) {
            $file = $request->file('payslip');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/Payslips', $filename);
            
            // Update the familyInfoData with the new filename
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
            'noteAddress' => 'required',
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
    
        // Get the authenticated user and their associated applicant
        $user = auth()->user();
        $applicant = $user->applicant;
    
        // Check if the applicant exists
        if (!$applicant) {
            return redirect()->back()->withErrors(['msg' => 'No applicant record found for the authenticated user.']);
        }
    
        // Create new Personal Information
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
            'noteAddress' => $request->noteAddress,
            'created_at' => now(),  // Ensure to set timestamps
            'updated_at' => now(),
        ];
    
        // Handle map address file upload
        if ($request->hasFile('mapAddress')) {
            $mapAddressFile = $request->file('mapAddress');
            $originalFilename = pathinfo($mapAddressFile->getClientOriginalName(), PATHINFO_FILENAME);
            $mapAddressFilename = $originalFilename . '.' . $mapAddressFile->getClientOriginalExtension();
            $mapAddressFilePath = $mapAddressFile->storeAs('public/map-addresses', $mapAddressFilename);
            $personalInfoData['mapAddress'] = $mapAddressFilePath;
        }
    
        ApplicantsPersonalInformation::create($personalInfoData);
    
        // Create new Academic Information
        $academicInfoData = [
            'applicant_id' => $applicant->applicant_id,
            'incoming_grade_year' => $request->incoming_grade_year,
            'current_course_program_grade' => $request->current_course_program_grade,
            'current_school' => $request->current_school,
            'created_at' => now(),  // Ensure to set timestamps
            'updated_at' => now(),
        ];
    
        ApplicantsAcademicInformation::create($academicInfoData);
    
        // Create new Academic Information Choices
        $academicInfoChoiceData = [
            'applicant_id' => $applicant->applicant_id,
            'first_choice_school' => $request->first_choice_school,
            'second_choice_school' => $request->second_choice_school,
            'third_choice_school' => $request->third_choice_school,
            'first_choice_course' => $request->first_choice_course,
            'second_choice_course' => $request->second_choice_course,
            'third_choice_course' => $request->third_choice_course,
            'created_at' => now(),  // Ensure to set timestamps
            'updated_at' => now(),
        ];
        ApplicantsAcademicInformationChoice::create($academicInfoChoiceData);
    
        // Create new Academic Information Grades
        $academicInfoGradesData = [
            'applicant_id' => $applicant->applicant_id,
            'latestAverage' => $request->latestAverage,
            'latestGWA' => $request->latestGWA,
            'scopeGWA' => $request->scopeGWA,
            'equivalentGrade' => $request->equivalentGrade,
            'created_at' => now(),  // Ensure to set timestamps
            'updated_at' => now(),
        ];
        ApplicantsAcademicInformationGrade::create($academicInfoGradesData);
    
        // Create new Family Information
        $familyInformationData = [
            'applicant_id' => $applicant->applicant_id,
            'total_household_members' => $request->total_household_members,
            'father_occupation' => $request->father_occupation,
            'father_income' => $request->father_income,
            'mother_occupation' => $request->mother_occupation,
            'mother_income' => $request->mother_income,
            'created_at' => now(),  // Ensure to set timestamps
            'updated_at' => now(),
        ];
        ApplicantsFamilyInformation::create($familyInformationData);
    
        // Handle Payslip upload
        if ($request->hasFile('payslip')) {
            $payslipFile = $request->file('payslip');
            $originalFilename = pathinfo($payslipFile->getClientOriginalName(), PATHINFO_FILENAME);
            $payslipfilename = $originalFilename . '.' . $payslipFile->getClientOriginalExtension();
            $payslipFilePath = $payslipFile->storeAs('public/Payslips', $payslipfilename);            
    
            $payslipData = [
                'applicant_id' => $applicant->applicant_id,
                'document_type' => 'Payslip / Social Case Study Report / ITR',
                'uploaded_document' => $payslipFilePath,
                'status' => 'For Review',
                'created_at' => now(),  // Ensure to set timestamps
                'updated_at' => now(),
            ];
            Requirement::create($payslipData);
        }
    
        // Update applicant status for the new application
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
            $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $filename = $originalFilename . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('public/uploads', $filename);
    
            $requirement = new Requirement();
            $requirement->applicant_id = auth()->id();
            $requirement->document_type = $request->documentType;
            $requirement->notes = $request->notes;
            $requirement->uploaded_document = $filePath;
            $requirement->status = 'For Review';
            $requirement->uploaded_at = now();
    
            $requirement->save();
    
            $applicantInfo = ApplicantsPersonalInformation::where('applicant_id', auth()->id())->first();
            $firstName = $applicantInfo->first_name;
            $lastName = $applicantInfo->last_name;
    
            $notification = new Notification();
            $notification->applicant_id = auth()->id();
            $notification->applicant_name = "$firstName $lastName";
            $notification->message = "Submitted {$request->documentType}";
            $notification->save();
    
            return response()->json(['success' => 'Document uploaded successfully']);
        } catch (\Exception $e) {
            \Log::error('Error saving requirement: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while saving the document. Please try again later.'], 500);
        }
    }
    
    //login post
    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user instanceof Applicant) {
                Log::debug('User is an applicant');

                if (!$user->verify_status) {
                    Auth::logout();
                    return redirect(route('login'))->with("error", "Your email is not verified. Please verify your email before logging in.");
                }

                if ($user->api_token) {
                    Auth::logout();
                    return redirect(route('login'))->with("error", "Your account is not verified. Please verify your email before logging in.");
                }
            }

            Log::debug('Login successful');
            return redirect()->intended(route('user.applicant_dashboard'));
        }

        return redirect(route('login'))->with("error", "Incorrect email address or password. Please try again.");
    }

    
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
                'document_type' => 'Payslip / Social Case Study Report / ITR',
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
        $noteAddress = $request->input('noteAddress');
    
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
                'noteAddress' => $noteAddress,
            ]
        );
    
        $familyInfoData= $request->only([
            'total_household_members','father_occupation','father_incom','mother_occupation',
            'mother_income', 'total_support_received'
        ]);
       
        $familyInfo = ApplicantsFamilyInformation::updateOrCreate(
            ['applicant_id' => auth()->id()],
            $familyInfoData
        );

        $academicInfoGradesData = $request->only([
            'latestAverage','latestGWA','scopeGWA','equivalentGrade',
            'grade_3_gwa', 'grade_4_gwa', 'grade_5_gwa', 'grade_6_gwa', 'grade_7_gwa', 'grade_8_gwa', 'grade_9_gwa', 'grade_10_gwa',
            'grade_11_sem1_gwa', 'grade_11_sem2_gwa', 'grade_11_sem3_gwa', 'grade_11_sem4_gwa', 'grade_12_sem1_gwa', 'grade_12_sem2_gwa',
            'grade_12_sem3_gwa', 'grade_12_sem4_gwa', '1st_year_sem1_gwa', '1st_year_sem2_gwa', '1st_year_sem3_gwa', '1st_year_sem4_gwa', '2nd_year_sem1_gwa',
            '2nd_year_sem2_gwa', '2nd_year_sem3_gwa', '2nd_year_sem4_gwa'
        ]);
    
        $academicInfoGradesData['applicant_id'] = auth()->id();
    
        $academicInfo = ApplicantsAcademicInformationGrade::updateOrCreate(
            ['applicant_id' => auth()->id()],
            $academicInfoGradesData
        );
    
        $academicInfoData = $request->only([
            'current_course_program_grade', 'current_school'
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
            'first_choice_school', 'second_choice_school', 'third_choice_school',
            'first_choice_course', 'second_choice_course', 'third_choice_course'
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
    
                if ($request->hasFile('uploaded_document')) {
                    $uploadedFile = $request->file('uploaded_document');
    
                    $originalFileName = $uploadedFile->getClientOriginalName();
                    $uploadedFilePath = $uploadedFile->storeAs('public/uploads', $originalFileName);
    
                    if ($document->uploaded_document) {
                        Storage::delete($document->uploaded_document);
                    }
    
                    $document->uploaded_document = $uploadedFilePath;
                }
    
                $document->save();
    
                return response()->json(['message' => 'Document updated successfully'], 200);
            } catch (\Exception $e) {
                return response()->json(['message' => 'Failed to update document', 'error' => $e->getMessage()], 500);
            }
        }
        
        
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
    function screeningPost(Request $request)
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
            'mapAddress' => 'file|mimes:jpeg,jpg,png,pdf|max:2048',
            'noteAddress' => 'required',
            'attend_orientation' => 'required|in:yes,no', 
            'orientation_date' => 'required_if:attend_orientation,yes', 
            'orientation_proof' => 'nullable|file|mimes:jpeg,jpg,png,pdf|max:2048' 
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
                'municipality' => $request->municipality,
                'noteAddress' => $request->noteAddress
            ];

            if ($request->hasFile('mapAddress')) {
                $mapAddressFile = $request->file('mapAddress');
                $originalFilename = pathinfo($mapAddressFile->getClientOriginalName(), PATHINFO_FILENAME);
                $mapAddressFilename = $originalFilename . '.' . $mapAddressFile->getClientOriginalExtension();
                $mapAddressFilePath = $mapAddressFile->storeAs('public/map-addresses', $mapAddressFilename);
                $personalInfoData['mapAddress'] = $mapAddressFilePath;
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
                'latestAverage' => $request->latestAverage,
                'latestGWA' => $request->latestGWA,
                'scopeGWA' => $request->scopeGWA,
                'equivalentGrade' => $request->equivalentGrade
            ];
            ApplicantsAcademicInformationGrade::create($academicInfoGradesData);

            $familyInformationData = [
                'applicant_id' => $applicant->applicant_id,
                'total_household_members' => $request->householdMembers,
                'father_occupation' => $request->fatherOccupation,
                'father_income' => $request->fatherIncome,
                'mother_occupation' => $request->motherOccupation,
                'mother_income' => $request->incomeMother,
                'total_support_received' => str_replace(',', '', $request->supportReceived)
            ];
            ApplicantsFamilyInformation::create($familyInformationData);
            
            if ($request->hasFile('ReportCard')) {
                $reportcardFile = $request->file('ReportCard');
                $originalFilename = pathinfo($reportcardFile->getClientOriginalName(), PATHINFO_FILENAME);
                $reportcardfilename = $originalFilename . '.' . $reportcardFile->getClientOriginalExtension();
                $reportcardFilePath = $reportcardFile->storeAs('public/ReportCards', $reportcardfilename);
            
                $reportcardData = [
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Report Card / Grades',
                    'uploaded_document' => $reportcardFilePath,
                    'status' => 'For Review',
                ];
                Requirement::create($reportcardData);
            }
            
            if ($request->hasFile('payslip')) {
                $payslipFile = $request->file('payslip');
                $originalFilename = pathinfo($payslipFile->getClientOriginalName(), PATHINFO_FILENAME);
                $payslipfilename = $originalFilename . '.' . $payslipFile->getClientOriginalExtension();
                $payslipFilePath = $payslipFile->storeAs('public/Payslips', $payslipfilename);            
    
                $payslipData = [
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Payslip / Social Case Study Report / ITR',
                    'uploaded_document' => $payslipFilePath,
                    'status' => 'For Review',
                ];
                Requirement::create($payslipData);
            }

            $attendanceData = [
                'applicant_id' => $applicant->applicant_id,
                'attend_orientation' => $request->attend_orientation,
                'orientation_date' => $request->attend_orientation == 'yes' ? $request->orientation_date : null
            ];
    
            // If orientation proof file is provided
            if ($request->hasFile('orientation_proof')) {
                $orientationProofFile = $request->file('orientation_proof');
                $orientationProofFilename = $orientationProofFile->getClientOriginalName();
                $orientationProofPath = $orientationProofFile->storeAs('public/orientation-proofs', $orientationProofFilename);
                $attendanceData['orientation_proof'] = $orientationProofPath;
            }
    
            ApplicantAttendance::create($attendanceData);
    
            // Save ReportCard and Payslip (existing code)
            if ($request->hasFile('ReportCard')) {
                $reportcardFile = $request->file('ReportCard');
                $reportcardfilename = $reportcardFile->getClientOriginalName();
                $reportcardFilePath = $reportcardFile->storeAs('public/ReportCards', $reportcardfilename);
                
                $reportcardData = [
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Report Card / Grades',
                    'uploaded_document' => $reportcardFilePath,
                    'status' => 'For Review',
                ];
                Requirement::create($reportcardData);
            }
    
            if ($request->hasFile('payslip')) {
                $payslipFile = $request->file('payslip');
                $payslipfilename = $payslipFile->getClientOriginalName();
                $payslipFilePath = $payslipFile->storeAs('public/Payslips', $payslipfilename);            
        
                $payslipData = [
                    'applicant_id' => $applicant->applicant_id,
                    'document_type' => 'Payslip / Social Case Study Report / ITR',
                    'uploaded_document' => $payslipFilePath,
                    'status' => 'For Review',
                ];
                Requirement::create($payslipData);
            }
    

            $verificationToken = Str::random(60);

            $applicant->api_token = $verificationToken;
            $applicant->save();

            \Mail::to($applicant->email)->send(new \App\Mail\VerificationMail($applicant));

            return response()->json(['message' => 'Registration successful, please check your email for verification.', 'redirect' => route('verification')], 201);
        } else {
            return response()->json(['message' => 'Registration failed, try again.'], 400);
        }
    }
}
