<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        $title = 'Real LIFE Foundation - Home';
        return view('index')->with('title', $title);
    }

    public function announcement(){
        $title = 'Announcement';
        return view('announcement')->with('title', $title);
    }

    public function contact(){
        $title = 'Contact Us';
        return view('contact')->with('title', $title);
    }

    public function faq(){
        $title = 'FAQ';
        return view('faq')->with('title', $title);
    }

    public function login(){
        $title = 'Login';
        return view('user.login')->with('title', $title);
    }

    function loginPost(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        // if(auth()->attempt($credentials)){
        //     $request->session()->regenerate();
        //     return redirect(route('home'));
        // }

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Login details are not valid");
    }

    public function register(){
        $title = 'Register';
        return view('user.register')->with('title', $title);
    }

    function registerPost(Request $request){
        $request->validate([
            'name' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $applicant = User::create($data);
        if(!$applicant){
            return redirect(route('register'))->with("error", "Registration failed, try again.");
        }
        return redirect(route('login'))->with("success", "Registration success, Login to access the app");
    }

    function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
}
