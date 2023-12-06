<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\ApplicantsPersonalInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement; 

class ApplicantController extends Controller
{
    public function index()
    {
        $title = 'Real LIFE Foundation - Home';
        return view('index')->with('title', $title);
    }

    public function announcement() {
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
            $applicant->personalInformation()->create([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'contact' => $request->contact,
                'birthday' => $request->birthdate,
                'house_number' => $request->houseNumber,
                'street' => $request->street,
                'barangay' => $request->barangay,
                'municipality' => $request->municipality
            ]);

            $incomingGrade = $request->incomingGrade;
            $academicInfoData = [
                'current_course_program' => $request->currentCourse,
                'current_school' => $request->currentSchool
            ];

            // Check the value of incomingGrade and create the corresponding record
            if (in_array($incomingGrade, ['GradeSeven', 'GradeEight', 'GradeNine', 'GradeTen', 'GradeEleven', 'GradeTwelve'])) {
                $academicInfoData['incoming_grade'] = $incomingGrade;
                $applicant->academicInformation()->create($academicInfoData);
            } elseif (in_array($incomingGrade, ['FirstYear', 'SecondYear', 'ThirdYear', 'FourthYear'])) {
                $academicInfoData['incoming_year'] = $incomingGrade;
                $applicant->academicInformationCollege()->create($academicInfoData);
            }

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
