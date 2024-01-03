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
use App\Models\Requirement;
use Illuminate\Support\Facades\Validator;


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
        $title = 'Real LIFE Foundation - Home';
        return view('user.home', compact('title'));
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
        return view('user.applicant_dashboard', compact('title', 'academicInfoData', 'academicInfoGradesData', 'academicInfoChoiceData', 'personalInfo' , 'reportcardData'));
    }


    public function personalDetails()
    {
        $applicantId = auth()->id();
        $academicInfoData = ApplicantsAcademicInformation::where('applicant_id', $applicantId)->first();
        $academicInfoGradesData =  ApplicantsAcademicInformationGrade::where('applicant_id', $applicantId)->first();
        $academicInfoChoiceData =  ApplicantsAcademicInformationChoice::where('applicant_id', $applicantId)->first();
        $members = Member::where('applicant_id', $applicantId)->get();


        return view('user.personal_details', compact('academicInfoData', 'academicInfoGradesData', 'academicInfoChoiceData', 'members'));
    }

    public function viewChangePassword()
    {
        $title = 'Change Password';
        return view('user.change_password')->with('title', $title);
    }


    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // if(auth()->attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect(route('user.home'));
        // }

        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('user.home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    public function register()
    {
        $title = 'Register';
        return view('user.register')->with('title', $title);
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
        $data['status'] = 'New Applicant';
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
                'grade_12_sem1_gwa' => $request->grade12FirstSemGWA,
                'grade_12_sem2_gwa' => $request->grade12SecondSemGWA,
                'grade_12_sem3_gwa' => $request->grade12ThirdSemGWA,
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
                // 'payslip_path' => $request->file('payslip')->store('payslips', 'public'),
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
                'document_type' => 'Report of Grades',
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
            'grade_11_sem1_gwa', 'grade_11_sem2_gwa', 'grade_11_sem3_gwa', 'grade_12_sem1_gwa', 'grade_12_sem2_gwa', 'grade_12_sem3_gwa',
            '1st_year_sem1_gwa', '1st_year_sem2_gwa', '1st_year_sem3_gwa', '1st_year_sem4_gwa', '2nd_year_sem1_gwa', '2nd_year_sem2_gwa',
            '2nd_year_sem3_gwa', '2nd_year_sem4_gwa'
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
                // Adjust the 'Member' model and table name according to your application
                Member::updateOrCreate(
                    ['members_id' => auth()->id(), 'members_id' => $key + 1], // Assuming the household member ID starts from 1
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
   

}
