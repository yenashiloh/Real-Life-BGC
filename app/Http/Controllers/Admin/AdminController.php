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
use Illuminate\Support\Facades\Mail;
use App\Notifications\StatusUpdateNotification; 
use App\Models\ApplicantsAcademicInformationChoice;
use App\Models\ApplicantsAcademicInformationGrade;
use App\Models\Member;
use App\Models\Notification;
use App\Models\Requirement;


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

    public function new_dashboard()
    {
        $title = 'Dashboard';
        return view('admin.dashboard-new', ['title' => $title]);
        
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

    //edit announcement page
    public function showEditAnnouncement($id)
    {
        $title = 'Edit Announcement';
        $announcement = Announcement::find($id);
        
        if (!$announcement) {
            return redirect()->back()->with('error', 'Announcement not found.');
        }
        
        return view('admin.announcement.edit-announcement', compact('title', 'announcement'));
    }

    //update announcement
    public function updateAnnouncement(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'announcement_title' => 'required',
            'announcement_caption' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $announcement = Announcement::find($id);

        if (!$announcement) {
            return redirect()->back()->with('error', 'Announcement not found.');
        }

        $announcement->title = $request->input('announcement_title');
        $announcement->caption = $request->input('announcement_caption');
        $announcement->save();

        return redirect()->route('admin.announcement.edit-announcement', ['id' => $id])->with('success', 'Announcement Updated Successfully!');
    }

    //add announcement
    public function saveAnnouncement(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'announcement_caption' => 'required',
            'announcement_title' => 'required', 
        ]);    
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $announcement = new Announcement();
        $announcement->title = $request->input('announcement_title', 'Default Title'); 
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
 
 //dashboard total
public function totalApplicants()
{
    $totalApplicants = Applicant::count();
    $totalShortlisted = Applicant::where('status', 'Shortlisted')->count();
    $totalForInterview = Applicant::where('status', 'For Interview')->count();
    $totalHouseVisitation = Applicant::where('status', 'For House Visitation')->count();
    $totalDeclined = Applicant::where('status', 'Declined')->count();
    $totalApproved = Applicant::where('status', 'Approved')->count();
    $title = 'Dashboard'; 
    $validStatuses = ['New Applicant', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation'];

    $applicantsData = ApplicantsPersonalInformation::select(
        'applicants_personal_information.first_name',
        'applicants_personal_information.last_name',
        'applicants_academic_information.incoming_grade_year',
        'applicants_academic_information.current_school',
        'applicants.status',
        'applicants.created_at',
        'applicants.applicant_id'
    )
    ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
    ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
    ->whereIn('applicants.status', $validStatuses)
    ->get();

    // Pass the data to the view
    return view('admin.dashboard-new', compact('totalApplicants', 'totalShortlisted', 'totalForInterview', 'totalHouseVisitation','totalDeclined', 'totalApproved', 'title', 'applicantsData'));
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
        $validStatuses = ['New Applicant', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation'];
    
        $applicantsData = ApplicantsPersonalInformation::select(
            'applicants_personal_information.first_name',
            'applicants_personal_information.last_name',
            'applicants_academic_information.incoming_grade_year',
            'applicants_academic_information.current_school',
            'applicants.status',
            'applicants.created_at',
            'applicants.applicant_id'
        )
        ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
        ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
        ->whereIn('applicants.status', $validStatuses)
        ->get();
        
    
        return $applicantsData;
    }
    
    public function updateStatus(Request $request)
    {
        try {
            $applicant = Applicant::where('applicant_id', $request->applicant_id)->first();

            if (!$applicant) {
                return response()->json(['error' => 'Applicant not found'], 404);
            }

            $status = $request->status;
            $validStatuses = ['New Applicant', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation', 'Approved', 'Declined'];

            if (!in_array($status, $validStatuses)) {
                return response()->json(['error' => 'Invalid status'], 400);
            }

            $applicantEmail = $applicant->email;
            $applicant->status = $status;
            $applicant->save();

            dispatch(function () use ($applicantEmail, $applicant) {
                try {
                    $notification = new StatusUpdateNotification($applicant);
                    Mail::to($applicantEmail)->send($notification);
                } catch (\Exception $emailException) {
                    \Log::error('Email sending failed: ' . $emailException->getMessage());
                }
            })->afterResponse();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error updating status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }

    
    public function showDeclinedApplicants()
    {
        $title = 'Declined Applicants';
        $applicantsData = $this->getDeclinedData();
        return view('admin.applicants.declined_applicants', compact('title', 'applicantsData'));
    }

    public function getDeclinedData()
    {
        $validStatuses = ['Declined'];
    
        $applicantsData = ApplicantsPersonalInformation::select(
            'applicants_personal_information.first_name',
            'applicants_personal_information.last_name',
            'applicants_academic_information.incoming_grade_year',
            'applicants_academic_information.current_school',
            'applicants.status',
            'applicants.created_at',
            'applicants.applicant_id'
        )
        ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
        ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
        ->whereIn('applicants.status', $validStatuses)
        ->get();
    
        return $applicantsData;
    }

    //approved table page 
    public function showApprovedApplicants()
    {
        $title = 'Approved Applicants';
        $applicantsData = $this->getApprovedData(); 
        return view('admin.applicants.approved_applicants', compact('title', 'applicantsData'));
    }

    //approved table page 
    public function getApprovedData()
    {
        $validStatuses = ['Approved'];
    
        $applicantsData = ApplicantsPersonalInformation::select(
            'applicants_personal_information.first_name',
            'applicants_personal_information.last_name',
            'applicants_academic_information.incoming_grade_year',
            'applicants_academic_information.current_school',
            'applicants.status',
            'applicants.created_at',
            'applicants.applicant_id'
        )
        ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
        ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
        ->whereIn('applicants.status', $validStatuses)
        ->get();
    
        return $applicantsData;
    }

    public function viewApplicant($id)
    {
        $title = 'Applicant Details';

        $applicant = ApplicantsPersonalInformation::with([
            'academicInformation',
            'choices',
            'grades'
        ])->find($id);

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        $applicantData = DB::table('applicants')
            ->where('applicant_id', $id) 
            ->select('email', 'status') 
            ->first();

        $email = $applicantData ? $applicantData->email : null;
        $status = $applicantData ? $applicantData->status : null;

        $members = Member::where('applicant_id', $id)->get();
        $reportcardData = Requirement::where('applicant_id', $id)->get();

        return view('admin.applicants.view_applicant', compact('title', 'applicant', 'email', 'status', 'members', 'reportcardData'));
    }

    //status for uploaded documents
    public function fileStatus(Request $request, $requirement_id)
    {
        try {
            $status = $request->status;
            $validStatuses = ['For Review', 'Approved', 'Declined'];
    
            if (!in_array($status, $validStatuses)) {
                return response()->json(['error' => 'Invalid status'], 400);
            }
    
            $requirement = Requirement::findOrFail($requirement_id);
            $requirement->status = $status;
            $requirement->save();
    
            return response()->json(['status' => $requirement->status]);
        } catch (\Exception $e) {
            \Log::error('Error updating status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }

    public function showNotifications()
    {
        // Fetch unread notifications
        $notifications = Notification::where('status', 'unread')
            ->orderBy('created_at', 'desc')
            ->get(['id', 'applicant_id', 'applicant_name', 'message', 'status', 'created_at', 'updated_at']);

        // Return the unread notifications
        return $notifications;
    }
    public function fetchNotificationCount()
    {
        try {
            $count = Notification::where('status', 'unread')->count();
            return response()->json(['count' => $count]);
        } catch (\Exception $e) {
            \Log::error('Error fetching notification count: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred while fetching notification count.'], 500);
        }
    }
    
    
}    

    

