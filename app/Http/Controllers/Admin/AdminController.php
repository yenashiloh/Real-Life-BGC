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
use App\Models\ApplicantsFamilyInformation;
use App\Models\Member;
use App\Models\Notification;
use App\Models\NotificationApplicant;
use App\Models\Requirement;
use App\Exports\ApplicantsExport;
use App\Exports\ApprovedExport;
use App\Exports\DeclinedExport;
use Maatwebsite\Excel\Facades\Excel;


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
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            $admin = Admin::create([
                'first_name' => $request->input('firstname'),
                'last_name' => $request->input('lastname'),
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'contact_number' => $request->input('contact_no'),
            ]);
    
            return response()->json([
                'success' => true,
                'message' => 'Account Created Successfully!'
            ]);
        } catch (\Exception $e) {
            \Log::error('Admin registration error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while creating the account.'
            ], 500);
        }
    }

    
    
    public function showUploadedFiles()
    {
        $title = 'Create Account';
        return view('admin.uploaded-files', ['title' => $title]);
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
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcement.admin-announcement', compact('title', 'announcements'));
    }
    
    //add announcement
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

        return redirect()->route('admin.announcement.admin-announcement', ['id' => $id])->with('success', 'Announcement Updated Successfully!');
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
        return redirect()->route('admin.announcement.admin-announcement');
    }

    //delete announcement
    public function deleteAnnouncement($id)
    {
        $announcement = Announcement::find($id);
    
        if (!$announcement) {
            return response()->json(['success' => false, 'message' => 'Announcement not found.']);
        }
    
        if ($announcement->delete()) {
            return response()->json(['success' => true, 'message' => 'Announcement deleted successfully.']);
        } else {
            return response()->json(['success' => false, 'message' => 'Failed to delete the announcement.']);
        }
    }

    public function totalApplicants()
    {
        $totalApplicants = Applicant::count();
        $totalShortlisted = Applicant::where('status', 'Shortlisted')->count();
        $totalForInterview = Applicant::where('status', 'For Interview')->count();
        $totalHouseVisitation = Applicant::where('status', 'For House Visitation')->count();
        $totalDeclined = Applicant::where('status', 'Declined')->count();
        $totalApproved = Applicant::where('status', 'Approved')->count();
        $title = 'Dashboard'; 
        $validStatuses = ['Sent', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation'];
    
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
    
        $years = $this->getDistinctYears();

        return view('admin.dashboard', compact('totalApplicants', 'totalShortlisted', 'totalForInterview', 'totalHouseVisitation','totalDeclined', 'totalApproved', 'title', 'applicantsData', 'years'));
    }
 
    public function getDistinctYears()
    {
        $years = Applicant::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return $years;
    }

    public function getDashboardData(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
    
        // Fetch data based on the date range
        $totalApplicants = Applicant::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalShortlisted = Applicant::where('status', 'Shortlisted')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $totalForInterview = Applicant::where('status', 'For Interview')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $totalHouseVisitation = Applicant::where('status', 'For House Visitation')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $totalDeclined = Applicant::where('status', 'Declined')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        $totalApproved = Applicant::where('status', 'Approved')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
    
        // Fetch bar chart data for applicants by grade/year level
        $barChartData = $this->getApplicantsByGradeYear($startDate, $endDate);
    
        return response()->json([
            'totalApplicants' => $totalApplicants,
            'totalShortlisted' => $totalShortlisted,
            'totalForInterview' => $totalForInterview,
            'totalHouseVisitation' => $totalHouseVisitation,
            'totalDeclined' => $totalDeclined,
            'totalApproved' => $totalApproved,
            'barChartData' => $barChartData,
        ]);
    }
    
    

    //bar chart - incoming grade/yr level
    private function getApplicantsByGradeYear($startDate, $endDate)
    {
        $gradeCounts = ApplicantsAcademicInformation::select('incoming_grade_year', DB::raw('count(*) as count'))
            ->join('applicants', 'applicants_academic_information.applicant_id', '=', 'applicants.applicant_id')
            ->whereBetween('applicants.created_at', [$startDate, $endDate])
            ->groupBy('incoming_grade_year')
            ->orderBy('incoming_grade_year')
            ->get();
    
        return [
            'labels' => $gradeCounts->pluck('incoming_grade_year')->toArray(),
            'counts' => $gradeCounts->pluck('count')->toArray(),
        ];
    }

    //applicants data 
    public function showNewApplicants()
    {
        $title = 'All Applicants';
    
        $availableYears = Applicant::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');
    
        $applicantsData = $this->getApplicantsData();
    
        return view('admin.applicants.new_applicants', compact('title', 'applicantsData', 'availableYears'));
    }
    
    public function getApplicantsData($selectedYear = null)
    {
        $validStatuses = ['Sent', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation'];
    
        $query = ApplicantsPersonalInformation::select(
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
        ->whereIn('applicants.status', $validStatuses);

        if ($selectedYear) {
            $query->whereYear('applicants.created_at', '=', $selectedYear);
        }
    
        $applicantsData = $query->get();
    
        return $applicantsData;
    }
    
    public function getApplicants(Request $request)
    {
        // Get selected year from request
        $selectedYear = $request->input('year_filter');

        // Fetch applicants data based on the selected year
        $applicantsData = $this->getApplicantsData($selectedYear);

        // Get distinct years of application from the fetched data
        $availableYears = Applicants::selectRaw('YEAR(created_at) as year')
                                    ->distinct()
                                    ->orderByDesc('year')
                                    ->pluck('year');

        return view('admin.applicants.new_applicants', [
            'applicantsData' => $applicantsData,
            'availableYears' => $availableYears,
        ]);
    }

    public function updateStatus(Request $request)
    {
        try {
            $applicant = Applicant::where('applicant_id', $request->applicant_id)->first();

            if (!$applicant) {
                return response()->json(['error' => 'Applicant not found'], 404);
            }

            $status = $request->status;
            $validStatuses = ['Sent', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation', 'Approved', 'Declined'];

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

    //Declined Applicants
    public function showDeclinedApplicants()
    {
        $title = 'Declined Applicants';
        $applicantsData = $this->getDeclinedData();
        $validStatuses = ['Declined'];
        $selectedYear = now()->year; 
        $years = Applicant::selectRaw('YEAR(created_at) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');
    
        // Fetch applicant data for the selected year
        $applicantsPersonalInformation = ApplicantsPersonalInformation::select(
                'applicants_personal_information.*', 
                'applicants_academic_information.*', 
                'applicants.*' 
            )
            ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->whereIn('applicants.status', $validStatuses)
            ->whereYear('applicants.created_at', $selectedYear)
            ->get();
    
        return view('admin.applicants.declined_applicants', compact('title', 'applicantsData', 'years', 'applicantsPersonalInformation'));
    }
    
    public function getDeclinedApplicantsByYear(Request $request)
    {
        $selectedYear = $request->input('year');
    
        if (!is_numeric($selectedYear)) {
            return response()->json(['error' => 'Invalid year']);
        }
    
        // Fetch declined applicants for the selected year
        $applicantsData = ApplicantsPersonalInformation::select(
                'applicants_personal_information.*',
                'applicants_academic_information.*',
                'applicants.*'
            )
            ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->whereYear('applicants.created_at', $selectedYear)
            ->where('applicants.status', 'Declined')
            ->get();
    
        return response()->json(['applicantsData' => $applicantsData]);
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
        $applicantsData = $this->getDeclinedData(); 
        $validStatuses = ['Approved'];
        $selectedYear = now()->year;
        $years = Applicant::selectRaw('YEAR(created_at) as year')
                            ->distinct()
                            ->orderBy('year', 'desc')
                            ->pluck('year');
    
        $applicantsPersonalInformation = ApplicantsPersonalInformation::select(
                'applicants_personal_information.*', 
                'applicants_academic_information.*', 
                'applicants.*' 
            )
            ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->whereIn('applicants.status', $validStatuses)
            ->whereYear('applicants.created_at', $selectedYear)
            ->get();

        $applicantsData = $this->getApprovedData(); 
        return view('admin.applicants.approved_applicants', compact('title', 'applicantsData', 'years', 'applicantsPersonalInformation'));
    }


    //approved - filter year using date range
    public function getApprovedApplicantsByDateRange(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $query = ApplicantsPersonalInformation::select(
                'applicants_personal_information.*',
                'applicants_academic_information.*',
                'applicants.*'
            )
            ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->where('applicants.status', 'Approved');

        if ($startDate && $endDate) {
            $query->whereBetween('applicants.created_at', [
                Carbon::createFromFormat('F d, Y', $startDate)->startOfDay(),
                Carbon::createFromFormat('F d, Y', $endDate)->endOfDay()
            ]);
        }

        $applicantsData = $query->get();

        return response()->json(['applicantsData' => $applicantsData]);
    }

    public function getDeclinedApplicantsByDateRange(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $query = ApplicantsPersonalInformation::select(
                'applicants_personal_information.*',
                'applicants_academic_information.*',
                'applicants.*'
            )
            ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->where('applicants.status', 'Declined');

        if ($startDate && $endDate) {
            $query->whereBetween('applicants.created_at', [
                Carbon::createFromFormat('F d, Y', $startDate)->startOfDay(),
                Carbon::createFromFormat('F d, Y', $endDate)->endOfDay()
            ]);
        }

        $applicantsData = $query->get();

        return response()->json(['applicantsData' => $applicantsData]);
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
        logger()->info("Received applicant_id: " . $id); 

        $applicant = ApplicantsPersonalInformation::with([
            'academicInformation',
            'choices',
            'grades'
        ])->where('applicant_id', $id)->first();

        if (!$applicant) {
            return redirect()->back()->with('error', 'Applicant not found.');
        }

        $applicantData = DB::table('applicants')
            ->where('applicant_id', $id)
            ->select('email', 'status')
            ->first();

        $email = $applicantData ? $applicantData->email : null;
        $status = $applicantData ? $applicantData->status : null;

        $members = ApplicantsFamilyInformation::where('applicant_id', $id)->get();
        $reportcardData = Requirement::where('applicant_id', $id)->get();

        $documentTypes = [
            "Signed Application Form",
            "Birth Certificate",
            "Character Evaluation Forms",
            "Proof of Financial Status",
            "Payslip / Social Case Study Report / ITR",
            "Two References Form",
            "Home Visitation Form",
            "Report Card / Grades",
            "Prospectus",
            "Official Grading System",
            "Tuition Projection",
            "Admission Slip"
        ];

        $gradeFields = [
            'grade_11_sem1_gwa' => 'Grade 11 First Sem GWA',
            'grade_11_sem2_gwa' => 'Grade 11 Second Sem GWA',
            'grade_12_sem1_gwa' => 'Grade 12 First Sem GWA',
            'grade_12_sem2_gwa' => 'Grade 12 Second Sem GWA',
            '1st_year_sem1_gwa' => 'First Year First Sem GWA',
            '1st_year_sem2_gwa' => 'First Year Second Sem GWA',
            '2nd_year_sem1_gwa' => 'Second Year First Sem GWA',
            '2nd_year_sem2_gwa' => 'Second Year Second Sem GWA',
        ];

        return view('admin.applicants.view_applicant', compact(
            'title', 'applicant', 'email', 'status', 'members', 'reportcardData', 'documentTypes', 'id', 'gradeFields' ));
    }

    // Checked document type
    public function getApprovedDocuments($id)
    {
        try {
            $approvedDocuments = Requirement::where('applicant_id', $id)
                ->where('status', 'Approved')
                ->pluck('document_type') 
                ->toArray();

            return response()->json($approvedDocuments);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch approved documents'], 500);
        }
    }

    //status for uploaded documents and applicant notifications
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
            if ($status == 'Declined') {
                $requirement->declined_reason = $request->decline_reason; 
            }
            $requirement->save();

            $applicant_id = $requirement->applicant_id;

            if (!$applicant_id) {
                return response()->json(['error' => 'Applicant ID not found for the requirement'], 400);
            }

            $document_type = $requirement->document_type;
            $message = "$status your $document_type";

            $notification = NotificationApplicant::create([
                'applicant_id' => $applicant_id,
                'admin_name' => 'Real LIFE BGC', 
                'message' => $message,
                'status' => 'unread', 
            ]);
            
            return response()->json(['status' => $requirement->status]);
        } catch (\Exception $e) {
            \Log::error('Error updating status: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to update status'], 500);
        }
    }

    //show notification
    public function showNotifications()
    {
        $notifications = Notification::orderBy('created_at', 'desc')
            ->get(['id', 'applicant_id', 'applicant_name', 'message', 'status', 'created_at', 'updated_at']);
    
        return $notifications;
    }
    
    // fetch notification
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

    public function markNotificationsAsRead()
    {
        try {
            Notification::where('status', 'unread')->update(['status' => 'read']);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            \Log::error('Error marking notifications as read: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to mark notifications as read'], 500);
        }
    }

    //export all applicants
    public function exportData(Request $request)
    {
        $format = $request->get('format', 'excel');
        $export = new ApplicantsExport();
    
        if ($format === 'csv') {
            $fileName = 'applicants.csv';
            return Excel::download($export, $fileName, \Maatwebsite\Excel\Excel::CSV);
        } elseif ($format === 'excel') {
            $fileName = 'applicants.xlsx';
            return Excel::download($export, $fileName);
        } else {
            return redirect()->back()->with('error', 'Invalid export format specified.');
        }
    }

    //export status declined
    public function exportDeclined(Request $request)
    {
        $format = $request->get('format', 'excel');
        $export = new DeclinedExport();
    
        if ($format === 'csv') {
            $fileName = 'applicants.csv';
            return Excel::download($export, $fileName, \Maatwebsite\Excel\Excel::CSV);
        } elseif ($format === 'excel') {
            $fileName = 'applicants.xlsx';
            return Excel::download($export, $fileName);
        } else {
            return redirect()->back()->with('error', 'Invalid export format specified.');
        }
    }

    //export status approved
     public function exportApproved(Request $request)
     {
         $format = $request->get('format', 'excel');
         $export = new ApprovedExport();
     
         if ($format === 'csv') {
             $fileName = 'applicants.csv';
             return Excel::download($export, $fileName, \Maatwebsite\Excel\Excel::CSV);
         } elseif ($format === 'excel') {
             $fileName = 'applicants.xlsx';
             return Excel::download($export, $fileName);
         } else {
             return redirect()->back()->with('error', 'Invalid export format specified.');
         }
     }

    public function getDataForYear(Request $request)
    {
        $selectedYear = $request->input('year');
        $validStatuses = ['Sent', 'Under Review', 'Shortlisted', 'For Interview', 'For House Visitation', 'Declined', 'Approved'];
        
        $totalApplicants = ApplicantsPersonalInformation::selectRaw('COUNT(*) as total')
            ->join('applicants_academic_information', 'applicants_personal_information.applicant_id', '=', 'applicants_academic_information.applicant_id')
            ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
            ->whereIn('applicants.status', $validStatuses)
            ->whereYear('applicants.created_at', $selectedYear)
            ->count();
        
        $totalShortlisted = Applicant::whereIn('status', ['Shortlisted'])
            ->whereYear('created_at', $selectedYear)
            ->count();
    
        $totalForInterview = Applicant::whereIn('status', ['For Interview'])
            ->whereYear('created_at', $selectedYear)
            ->count();
    
        $totalHouseVisitation = Applicant::whereIn('status', ['For House Visitation', ])
            ->whereYear('created_at', $selectedYear)
            ->count();
    
        $totalDeclined = Applicant::where('status', 'Declined')
            ->whereYear('created_at', $selectedYear)
            ->count();
    
        $totalApproved = Applicant::where('status', 'Approved')
            ->whereYear('created_at', $selectedYear)
            ->count();
    
        return response()->json([
            'totalApplicants' => $totalApplicants,
            'totalShortlisted' => $totalShortlisted,
            'totalForInterview' => $totalForInterview,
            'totalHouseVisitation' => $totalHouseVisitation,
            'totalDeclined' => $totalDeclined,
            'totalApproved' => $totalApproved,
        ]);
    }

    public function getGraphDataForYear(Request $request)
    {
        $selectedYear = $request->input('year');
            
        $graphData = ApplicantsAcademicInformation::selectRaw('incoming_grade_year as label, count(*) as count')
            ->join('applicants_personal_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
            ->join('applicants', 'applicants_personal_information.applicant_id', '=', 'applicants.applicant_id')
            ->whereYear('applicants.created_at', $selectedYear)
            ->groupBy('incoming_grade_year')
            ->get();
    
            $labels = $graphData->pluck('label');
            $counts = $graphData->pluck('count');
    
        return response()->json([
            'labels' => $labels,
            'counts' => $counts,
        ]);
    }

//     public function getDataForApplicantYear(Request $request)
// {
//     $selectedYear = $request->input('year');
//     $validStatuses = ['Declined', 'Approved'];

//     // Fetch distinct years from the created_at column of applicants table
//     $years = Applicant::selectRaw('YEAR(created_at) as year')
//                         ->distinct()
//                         ->orderBy('year', 'desc')
//                         ->pluck('year');

//     // Fetch applicant data for the selected year
//     $applicantsData = ApplicantsPersonalInformation::select(
//             'applicants_personal_information.*', // Select all columns from applicants_personal_information
//             'applicants_academic_information.*', // Select all columns from applicants_academic_information
//             'applicants.*' // Select all columns from applicants
//         )
//         ->join('applicants', 'applicants.applicant_id', '=', 'applicants_personal_information.applicant_id')
//         ->join('applicants_academic_information', 'applicants_academic_information.applicant_id', '=', 'applicants_personal_information.applicant_id')
//         ->whereIn('applicants.status', $validStatuses)
//         ->whereYear('applicants.created_at', $selectedYear)
//         ->get();

//     // Pass data to the view and return it
//     return view('admin.applicants.declined_applicants', [
//         'years' => $years,
//         'applicantsData' => $applicantsData,
//     ]);
// }
    
    // Controller method to publish announcement
    public function publishAnnouncement($id)
        {
            $announcement = Announcement::findOrFail($id);
            $announcement->published = true;
            $announcement->save();
        
            return redirect()->back()->with('success', 'Announcement published successfully!');
        }
        
        public function unpublishAnnouncement($id)
        {
            $announcement = Announcement::findOrFail($id);
            $announcement->published = false;
            $announcement->save();
        
        return redirect()->back()->with('success', 'Announcement unpublished successfully!');
    }
      
}    



    

