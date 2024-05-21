<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicant;
use App\Models\ApplicantsPersonalInformation;
use Auth;

class AndroidController extends Controller
{
    public function index(Request $request)
    {
        // Load all relationships defined in the Applicant model
        $user = $request->user()->load([
            'personalInformation',
            'academicInformation',
            'academicInformationGrade',
            'academicInformationChoice',
            'applicants_personal_information',
            'household',
            'member',
            'requirements'
        ]);

        return $user;
    }

    public function register(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:applicants',
            'password' => 'required|confirmed',
        ]);

        $result = Applicant::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => 'Sent',
        ]);

        $result->personalInformation()->create([
            'applicant_id' => $result->applicant_id,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'birthday' => $request->birthday,
        ]);

        return $result;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = md5(time()) . '.' . md5($request->email);
            $user->forceFill([
                'api_token' => $token,
            ])->save();
            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'The provided credentials do not match our records.'
        ], 401);
    }

    public function logout(Request $request)
    {
        $request->user()->forceFill([
            'api_token' => null,
        ])->save();

        return response()->json(['message' => 'success']);
    }

    public function update(Request $request)
    {
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');

        $personalInfo = ApplicantsPersonalInformation::updateOrCreate(
            ['applicant_id' => auth()->id()],
            [
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]
        );

        if ($personalInfo) {
            return response()->json(['message' => 'success']);
        } else {
            return response()->json(['message' => 'failed to update']);
        }
    }
}
