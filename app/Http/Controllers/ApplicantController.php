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
        return view('user.home');
    }

    public function personalDetails()
    {
        return view('user.personal_details');
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
            'email' => 'required|email|unique:users',
            'password' => 'required',
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

            $academicInfoData = [
                'applicant_id' => $applicant->applicant_id,
                'incoming_grade_year' => $request->incomingGrade,
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
                'grade_12_sem1_gwa' => $request->grade12FirstSemGWA,
                'grade_12_sem2_gwa' => $request->grade12SecondSemGWA,
                '1st_year_sem1_gwa' => $request->firstYearFirstSemGWA,
                '1st_year_sem2_gwa' => $request->firstYearSecondSemGWA,
                '2nd_year_sem1_gwa' => $request->secondYearFirstSemGWA,
                '2nd_year_sem2_gwa' => $request->secondYearSecondSemGWA
            ];
            ApplicantsAcademicInformationGrade::create($academicInfoGradesData);

            // $incomingGrade = $request->incomingGrade;
            // $academicInfoData = [
            //     'applicant_id' => $applicant->id,
            //     'current_course_program' => $request->currentProgram,
            //     'current_school' => $request->currentSchool
            // ];

            // Check the value of incomingGrade and create the corresponding record
            // if (in_array($incomingGrade, ['GradeSeven', 'GradeEight', 'GradeNine', 'GradeTen', 'GradeEleven', 'GradeTwelve'])) {
            //     $academicInfoData['incoming_grade'] = $incomingGrade;
            //     $applicant->academicInformation()->create($academicInfoData);
            // } elseif (in_array($incomingGrade, ['FirstYear', 'SecondYear', 'ThirdYear', 'FourthYear'])) {
            //     $academicInfoData['incoming_year'] = $incomingGrade;
            //     $applicant->academicInformationGrade()->create($academicInfoData);
            // }

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

   
    
}
