<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.admin-login'); 
    }

    public function loginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('index')
                ->with('success', 'Login successful!'); 
        } 
        return redirect()->back()->withInput()
            ->withErrors(['error' => 'Invalid credentials'])
            ->with('danger', 'Invalid credentials. Please try again.'); 
    }

    public function showRegistrationForm()
    {
        return view('admin.admin-registration');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.register')
                ->withErrors($validator)
                ->withInput();
        }

        // Create admin account
        $admin = Admin::create([
            'first_name' => $request->input('firstname'),
            'last_name' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);


        return redirect()->route('admin.register')->with('success', 'Registration successful!'); 
    }

}

