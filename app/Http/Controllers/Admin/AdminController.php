<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;




class AdminController extends Controller
{
    
    //login
    public function showLoginForm()
    {
        return view('admin.admin-login'); 
    }

    public function adminloginPost(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            $admin = Auth::guard('admin')->user();
            
            Session::put('adminFirstName', $admin->first_name);
            Session::put('adminLastName', $admin->last_name);
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } 
    
        return redirect()->back()->withInput()
            ->withErrors(['error' => 'Invalid credentials'])
            ->with('danger', 'Invalid credentials. Please try again.');
    }

    //dashboard
    public function dashboard()
    {
        $title = 'Dashboard';
        return view('admin.dashboard', ['title' => $title]);
        return view('admin.dashboard');
    }

    //admin profile
    public function adminProfile()
    {
    if (Auth::guard('admin')->check()) {
        $admin = Auth::guard('admin')->user();
        Session::put('adminEmail', $admin->email);
        Session::put('adminContactNumber', $admin->contact_number);

        $title = 'Profile';
        return view('admin.admin-profile', ['title' => $title]);
    } else {
        return redirect()->route('admin.login');
    }
    }

    //registration
    public function showRegistrationForm()
    {
        $title = 'Create Account';
        return view('admin.admin-registration', ['title' => $title]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:6|confirmed',
            'contact_no' => 'required|string|max:11',
        ]);
    
        if ($validator->fails()) {
            return redirect()->route('admin.registration')
                ->withErrors($validator)
                ->withInput();
        }
    
        $admin = Admin::create([
            'first_name' => $request->input('firstname'),
            'last_name' => $request->input('lastname'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'contact_number' => $request->input('contact_no'),
        ]);
    
        return redirect()->route('admin.registration')->with('success', 'Create Account Successfully!');
    }
    
    //update profile 
    public function updateProfile(Request $request)
    {
    $admin = Auth::guard('admin')->user();

    $validatedData = $request->validate([
        'firstName' => 'required|string|max:255',
        'lastName' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:admins,email,' . $admin->id,
        'contactNumber' => 'required|string|max:20',
    ]);

    $admin->update([
        'first_name' => $validatedData['firstName'],
        'last_name' => $validatedData['lastName'],
        'email' => $validatedData['email'],
        'contact_number' => $validatedData['contactNumber'],
        
    ]);

    Session::put('adminFirstName', $admin->first_name);
    Session::put('adminLastName', $admin->last_name);
    Session::put('adminEmail', $admin->email);
    Session::put('adminContactNumber', $admin->contact_number);

    $request->session()->flash('profileSuccess', 'Profile updated successfully!');
    return redirect()->route('admin-profile'); 
    }

    //change password
    public function changePassword(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        $validator = Validator::make($request->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:6|different:currentPassword',
            'renewPassword' => 'required|same:newPassword',
        ], [
            'renewPassword.same' => 'The re-enter new password field must match new password.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        if (!Hash::check($request->currentPassword, $admin->password)) {
            return redirect()->back()->withErrors(['currentPassword' => 'The current password is incorrect.'])->withInput();
        }
    
        $admin->password = bcrypt($request->newPassword);
        $admin->save();

        $request->session()->flash('passwordSuccess', 'Password changed successfully!');
        return redirect()->route('admin-profile');
    }

    //logout
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}

