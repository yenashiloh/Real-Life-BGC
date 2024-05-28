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

class ApplicantController extends Controller
{
    public function index()
    {
        $title = 'Real LIFE Foundation - Home';
        return view('index')->with('title', $title);
    }

    public function announcement()
    {
        $title = 'Announcement';
        $announcements = Announcement::all();

        return view('announcement', [
            'title' => $title,
            'announcement' => $announcements
        ]);
    }

    public function contact()
    {
        $title = 'Contact Us';
        return view('contact')->with('title', $title);
    }

    public function faq()
    {
        $title = 'FAQ';
        return view('faq')->with('title', $title);
    }

    public function login()
    {
        $title = 'Login';
        return view('user.login')->with('title', $title);
    }

    public function userHome()
    {
        $title = 'Home';
        $applicantId = auth()->id();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        return view('user.home', compact('title', 'personalInfo' ));
    }

    public function showVerification()
    {
        $title = 'Verification';
        return view('user.verification')->with('title', $title);
    }

    public function applicantDashboard()
    {
        $applicantId = auth()->id();
        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData =  ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
        $academicInfoChoiceData =  ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $personalInfo = ApplicantsPersonalInformation::where('applicant_id', $applicantId)->first();
        $title = 'Dashboard';
        $reportcardData = Requirement::where('applicant_id', $applicantId)->get();
        $documentTypes = [
            "Signed Application Form",
            "Birth Certificate",
            "Character Evaluation Forms",
            "Proof of Financial Status",
            "Payslip / DSWD Report / ITR",
            "Two References Form",
            "Home Visitation Form",
            "Report Card / Grades",
            "Prospectus",
            "Official Grading System",
            "Tuition Projection",
            "Admission Slip"
        ];

        return view('user.applicant_dashboard', compact('title', 'academicInfoData', 'academicInfoGradesData', 
        'academicInfoChoiceData', 'personalInfo' , 'reportcardData', 'documentTypes'));
    }


        public function personalDetails()
        {
            $applicantId = auth()->id();
            $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
            $academicInfoGradesData =  ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
            $academicInfoChoiceData =  ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
            $members = Member::where('applicant_id', $applicantId)->get();

            $title = 'Personal Details';
            return view('user.personal_details', compact('title','academicInfoData', 'academicInfoGradesData', 'academicInfoChoiceData', 'members'));
        }

        public function viewChangePassword()
        {
            $title = 'Change Password';
            return view('user.change_password')->with('title', $title);
        }

    // public function androidAnnouncement()
    // {
    //     $title = 'Announcement';
    //     return view('android_app.android_announcement')->with('title', $title);
    // }

    public function androidAnnouncement()
    {
        $title = 'Announcement';
        $announcements = Announcement::all();

        return view('android_app.android_announcement', [
            'title' => $title,
            'announcement' => $announcements
        ]);
    }

    //UPLOAD REQUIREMENTS AND NOTIFICATIONS(ADMIN)
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

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // if(auth()->attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect(route('user.home'));+
        // }

        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('user.home'));
        }
        return redirect(route('login'))->with("error", "Incorrect email address/password. Please try again.");
    }

    public function register()
    {
        $title = 'Register';
        return view('user.register')->with('title', $title);
    }

    public function registration()
    {
        $title = 'Registration';
    
        // Retrieve application settings
        $settings = ApplicationSettings::first();
        
        // Get current time in Asia/Manila timezone
        $now = Carbon::now('Asia/Manila');
        
        // Extract current date and time
        $currentDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');
        
        // Extract start and stop dates and times from settings
        $startDate = $settings->start_date;
        $startTime = $settings->start_time;
        $stopDate = $settings->stop_date;
        $stopTime = $settings->stop_time;
        
        // Check if current time is within the registration period
        $applicationOpen = $this->isApplicationOpen($currentDate, $currentTime, $startDate, $startTime, $stopDate, $stopTime);
        
        return view('user.registration', compact('title', 'applicationOpen'));
    }
    
    private function isApplicationOpen($currentDate, $currentTime, $startDate, $startTime, $stopDate, $stopTime)
    {
        // Convert dates to Carbon objects for comparison
        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $stopDate = Carbon::createFromFormat('Y-m-d', $stopDate);
        $currentDate = Carbon::createFromFormat('Y-m-d', $currentDate);
    
        // Check if current date is within the start and stop dates
        if ($currentDate->lt($startDate) || $currentDate->gt($stopDate)) {
            return false;
        }
        
        // Create Carbon instances for the current time, start time, and stop time
        $currentTime = Carbon::createFromFormat('H:i:s', $currentTime);
        $startTime = Carbon::createFromFormat('H:i:s', $startTime);
        $stopTime = Carbon::createFromFormat('H:i:s', $stopTime);
    
        // Check if current time is within the daily start and stop times
        return $currentTime->between($startTime, $stopTime);
    }
    
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

        // $existingUser = Applicant::where('email', $request->email)->first();

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // Check for existing user with the provided email
        // $existingUser = Applicant::where('email', $request->email)->first();
        // if ($existingUser) {
        //     $errorMessage = "Email already exists.";
        //     return redirect(route('register'))->with("error", $errorMessage)->withInput();
        // }

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
                'document_type' => 'Payslip / DSWD Report / ITR',
                'uploaded_document' => $payslipFile->storeAs('Payslips', $fileName, 'public'),
                'status' => 'For Review',
            ];
            Requirement::create($payslipData);

            return redirect(route('login'))->with("success", "Registration success, Login to access the app");
        } else {
            return redirect(route('register'))->with("error", "Registration failed, try again.");
        }
    }

    function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect(route('login'));
    }

    //edit details
    public function updatePersonalDetails(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $contactNo = $request->input('contact_no');
        $birthdate = $request->input('birthdate');
        $houseNo = $request->input('house_no');
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

        $academicInfoGradesData = $request->only([
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

        $householdMembersData = $request->input('household_members');

        $householdMembersData = $request->input('name');

        if (isset($householdMembersData) && is_array($householdMembersData)) {
            foreach ($householdMembersData as $key => $name) {
                Member::updateOrCreate(
                    ['members_id' => auth()->id(), 'members_id' => $key + 1], 
                    [
                        'name' => $request->input("name.$key") ?? null,
                        'relationship' => $request->input("relationship.$key") ?? null,
                        'occupation' => $request->input("occupation.$key") ?? null,
                        'monthly_income' => $request->input("monthly_income.$key") ?? null,
                    ]
                );
            }
        }
    
        if ($personalInfo && $academicInfo && $academicInfoIncoming && $academicChoices) {
            return redirect()->back()->with('success', 'Updated Successfully!');
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
                'new_password' => 'required|min:8|different:current_password',
                'renew_password' => 'required|same:new_password',
            ], [
                'renew_password.same' => 'The re-enter new password field must match new password.',
            ]);
            
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
            $applicantId = auth()->id(); 

            $user = Auth::user();

            if ($user->applicant_id !== $applicantId) {
                return redirect()->back()->with('error', 'Unauthorized access.');
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->with('error', 'The current password is incorrect.');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            \Log::info('Password changed successfully for user: ' . $user->email);

            return redirect()->back()->with('success', 'Password changed successfully.');
        } catch (\Exception $e) {
            \Log::error('Error changing password: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Password change failed.');
        }
    }
    
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
        $document = Requirement::find($id);

        if (!$document) {
            return response()->json(['error' => 'Document not found'], 404);
        }

        return response()->json($document);
    }

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
                    'document_type' => 'Payslip / DSWD Report / ITR',
                    'uploaded_document' => $payslipFilePath,
                    'status' => 'For Review',
                ];
                Requirement::create($payslipData);
            }

            $verificationToken = Str::random(60);

            $applicant->api_token = $verificationToken;
            $applicant->save();

            \Mail::to($applicant->email)->send(new \App\Mail\VerificationMail($applicant));

            return view('user.verification');
        } else {
            return response()->json(['message' => 'Registration failed, try again.', 'error' => $e->getMessage()], 400);
        }
    }

    // public function showApplicationForm()
    // {
    //     // Retrieve application settings
    //     $settings = ApplicationSettings::first();
    //     $now = Carbon::now();
    //     $startDate = Carbon::parse($settings->start_date . ' ' . $settings->start_time);
    //     $endDate = Carbon::parse($settings->stop_date . ' ' . $settings->stop_time);

    //     // Check if application is open based on current time and status
    //     $applicationOpen = ($now >= $startDate && $now <= $endDate && $settings->status === 'Opened');


    //     // Pass the value of $applicationOpen to the view
    //     return view('user.registration', compact('applicationOpen'));
    // }

    
    
}
