<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Models\Announcement; 
use App\Models\Applicant;
use App\Models\ApplicantsAcademicInformation;
use App\Models\ApplicantsPersonalInformation;
use Illuminate\Support\Facades\DB; 





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

    //announcement
    public function showAnnouncement()
    {
        $title = 'Announcement';
        $announcements = Announcement::select('id', 'title', 'caption')->get();
        return view('admin.announcement.admin-announcement', compact('title', 'announcements'));
    }
    
    public function addAnnouncement()
    {
        $title = 'Add Announcement';
        return view('admin.announcement.add-announcement', ['title' => $title]);
    }

    //add announcement
    public function saveAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'announcement_caption' => 'required',
            'announcement_title' => 'required', // Adding validation for title
        ]);    
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $announcement = new Announcement();
        $announcement->title = $request->input('announcement_title', 'Default Title'); // Adding title field
        $announcement->caption = $request->input('announcement_caption', 'Default Caption');
    
        $announcement->save();
    
        $request->session()->flash('success', 'Announcement Added Successfully!');
        return redirect()->route('admin.announcement.add-announcement');
    }
    //delete announcement
    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::find($id);

        if (!$announcement) {
            return redirect()->back()->with('error', 'Announcement not found.');
        }
    
        if ($announcement->delete()) {
            return redirect()->back()->with('success', 'Announcement Deleted Successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to delete the announcement.');
        }
    }
 
    //dashboard 
    public function totalApplicants()
    {
        $totalApplicants = Applicant::count();
        $title = 'Dashboard'; 
        
        return view('admin.dashboard', compact('totalApplicants', 'title'));
    }

    //bar chart - incoming grade/yr level
    public function getApplicantsByGradeYear()
    {
        $gradeCounts = ApplicantsAcademicInformation::select('incoming_grade_year', DB::raw('count(*) as count'))
            ->groupBy('incoming_grade_year')
            ->orderBy('incoming_grade_year')
            ->get();
    
        $labels = $gradeCounts->pluck('incoming_grade_year')->toArray(); 
        $counts = $gradeCounts->pluck('count')->toArray(); 
    
        return response()->json([
            'labels' => $labels,
            'counts' => $counts,
        ]);
    }

    //applicants data 
    public function showNewApplicants()
    {
        $title = 'New Applicants';
        $applicantsData = $this->getApplicantsData();
        return view('admin.applicants.new_applicants', compact('title', 'applicantsData'));
    }
    
    public function getApplicantsData()
    {
        $applicantsData = ApplicantsPersonalInformation::select(
            'applicants_personal_information.first_name',
            'applicants_personal_information.last_name',
            'applicants_academic_information.incoming_grade_year',
            'applicants_academic_information.current_school',
            'applicants.status'
        )
        ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
        ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
        ->get();
    
        return $applicantsData;
    }
 
    public function updateStatus(Request $request)
{
    $applicantId = $request->input('applicant_id');
    $status = $request->input('status');

    try {
        // Find the applicant by ID and update status
        $applicant = Applicant::find($applicantId);

        if (!$applicant) {
            return response()->json(['success' => false, 'error' => 'Applicant not found for ID: ' . $applicantId]);
        }

        $applicant->status = $status;
        $applicant->save();

        return response()->json(['success' => true]);
    } catch (\Exception $exception) {
        return response()->json(['success' => false, 'error' => $exception->getMessage()]);
    }
}

    



    

    
    
    

   
    
}

