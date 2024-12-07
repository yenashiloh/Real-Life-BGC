<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Notifications\CustomResetPasswordNotification;

class ForgotPasswordController extends Controller
{
    public function forgotPasswordPage()
    {
        return view('user.forgot-password.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:applicants,email',
        ]);
    
        $user = Applicant::where('email', $request->email)->first();

        $token = Password::broker('applicants')->createToken($user);

        $user->notify(new CustomResetPasswordNotification($token, $request->email));
    
        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
            'token' => 'required',
        ]);
    
        $status = Password::broker('applicants')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($applicant) use ($request) {
                $applicant->password = bcrypt($request->password);
                $applicant->save();
            }
        );
    
        if ($status == Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Your password has been reset!');
        }
    
        return back()->withErrors(['email' => 'There was an issue resetting your password.']);
    }

    public function showResetForm(Request $request, $token, $email)
    {
        return view('user.forgot-password.reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }
}
