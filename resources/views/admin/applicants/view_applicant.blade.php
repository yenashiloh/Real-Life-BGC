{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>View</title>
    @include('admin-partials.admin-header')
    <style>
        .table-responsive td {
            max-width: 500px;
            white-space: normal;
        }

        .custom-btn {
            background-color: #71BF44;
            border-color: #71BF44;
            color: white;
        }

        .custom-btn:hover {
            background-color: #518630;
            border-color: #518630;
            color: white;
        }

        .custom-checkbox .form-check-input {
            border-color: black;
        }

        .capitalize {
            text-transform: capitalize;
        }

        .col-lg-9 {
            text-transform: capitalize;
        }

        input[type="checkbox"] {
            pointer-events: none;
        }
    </style>
</head>

<body>
    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])
    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">View Applicant</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../../applicants/new_applicants">All Applicants</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View Applicant</li>
                    </ol>
                </nav>
            </div>

            <div class="card">
                <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">

                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab"
                                data-bs-target="#personal-info">Personal Information</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#academic-info">Academic
                                Information</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#household">Family
                                Information</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#files">Documents</button>
                        </li>

                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#checklist">Monitoring
                                Checklist</button>
                        </li>

                    </ul>
                    <div class="tab-content pt-2">

                        <div class="tab-pane fade show active profile-overview" id="personal-info"
                            style="margin-top: 20px;">

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label ">Status</div>
                                <div class="col-lg-2 col-md-8 badge p-2"
                                    style="
                        @if ($status === 'Sent') margin-top: 2px;
                          background-color: #CFE2FF;
                          color: #052C92;
                        @elseif ($status === 'Under Review')
                          margin-top: 2px;
                          background-color: #FFF3CD;
                          color: #7A4D03;
                        @elseif ($status === 'Shortlisted')
                          width: 10%;
                          margin-top: 3px;
                          background-color: #FFDE73;
                          color: #212529;
                        @elseif ($status === 'For Interview')
                          margin-top: 2px;
                          background-color: #CFF4FC;
                          color: #055160;
                        @elseif ($status === 'For House Visitation')
                          margin-top: 2px;
                          background-color: #38CE3C;
                          color: #ffffff;
                          @elseif ($status === 'Approved')
                          margin-top: 2px;
                          background-color: #38CE3C;
                          color: #ffffff;
                        @elseif ($status === 'Declined')
                          margin-top: 2px;
                          background-color: #FF4D6B;
                          color: #ffffff; @endif
                      ">
                                    {{ $status }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label ">First Name</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->first_name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Last Name</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->last_name }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Email</div>
                                <div class="col-lg-9 col-md-8" style="text-transform:lowercase;">{{ $email }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->contact }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Birthday</div>
                                <div class="col-lg-9 col-md-8">
                                    {{ date('F j, Y', strtotime($applicant->birthday)) }}
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">House Number</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->house_number }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Street</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->street }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Barangay</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->barangay }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-3 col-md-4 label">Municipality</div>
                                <div class="col-lg-9 col-md-8">{{ $applicant->municipality }}</div>
                            </div>

                        </div>

                        <div class="tab-pane fade profile-edit pt-3" id="academic-info">

                            <form>
                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-4 label"
                                        style="margin-top: 20px; color: #0A6E57; font-weight: bold;">ACADEMIC
                                        INFORMATION</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-4 label">Incoming Grade</div>
                                    <div class="capitalize col-lg-7 col-md-8">
                                        {{ $applicant->academicInformation->incoming_grade_year }}</div>
                                </div>
                                @if (!empty($applicant->academicInformation->current_course_program_grade))
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Current Course or Program</div>
                                        <div class="capitalize col-lg-7 col-md-8">
                                            {{ $applicant->academicInformation->current_course_program_grade }}</div>
                                    </div>
                                @endif

                                <div class="row mb-2">
                                    <div class="col-lg-4 col-md-4 label">Current School</div>
                                    <div class="capitalize col-lg-7 col-md-8">
                                        {{ $applicant->academicInformation->current_school }}</div>
                                </div>

                                @if ($applicant->grades->isNotEmpty())
                                    @foreach ($applicant->grades as $grade)
                                        <div class="row mb-2">
                                            <div class="col-lg-4 col-md-4 label"
                                                style="margin-top: 20px; color: #0A6E57; font-weight: bold;">GRADES
                                            </div>
                                        </div>
                                        @if (!empty($grade->latestAverage))
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Latest Average</div>
                                                <div class="capitalize col-lg-7 col-md-8">{{ $grade->latestAverage }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($grade->latestGWA))
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Latest General Average</div>
                                                <div class="capitalize col-lg-7 col-md-8">{{ $grade->latestGWA }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($grade->scopeGWA))
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Scope General Average/GWA</div>
                                                <div class="capitalize col-lg-7 col-md-8">{{ $grade->scopeGWA }}</div>
                                            </div>
                                        @endif
                                        @if (!empty($grade->equivalentGrade))
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Equivalent Grade</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $grade->equivalentGrade }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                                @if ($applicant->choices->isNotEmpty())
                                    @foreach ($applicant->choices as $choice)
                                        @if ($choice->first_choice_school)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label"
                                                    style="margin-top: 20px; color: #0A6E57; font-weight: bold;">SCHOOL
                                                    APPLICATIONS</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">First School Choice</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->first_choice_school }}</div>
                                            </div>
                                        @endif

                                        @if ($choice->second_choice_school)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Second School Choice</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->second_choice_school }}</div>
                                            </div>
                                        @endif

                                        @if ($choice->third_choice_school)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Third School Choice</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->third_choice_school }}</div>
                                            </div>
                                        @endif

                                        @if ($choice->first_choice_course)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label"
                                                    style="margin-top: 20px;  color: #0A6E57; font-weight: bold; ">
                                                    COURSE CHOICES</div>
                                            </div>

                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">First Choice Course</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->first_choice_course }}</div>
                                            </div>
                                        @endif

                                        @if ($choice->second_choice_course)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Second Choice Course</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->second_choice_course }}</div>
                                            </div>
                                        @endif

                                        @if ($choice->third_choice_course)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label">Third Choice Course</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $choice->third_choice_course }}</div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
 --}}

{{-- @php $gradesExist = false; @endphp
        
                @foreach ($applicant->grades as $grade)
                    @for ($i = 3; $i <= 10; $i++)
                        @php
                            $gradeField = "grade_" . $i . "_gwa";
                        @endphp
        
                        @if ($grade->$gradeField && !$gradesExist)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">GRADES</div>
                            </div>
                            @php $gradesExist = true; @endphp
                        @endif
        
                        @if ($grade->$gradeField)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Grade {{ $i }} GWA</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $grade->$gradeField }}</div>
                            </div>
                        @endif
                    @endfor
                @endforeach
        
                  @foreach ($applicant->grades as $grade)
                      @php $gradeFields = [
                          'grade_11_sem1_gwa' => 'Grade 11 First Sem GWA',
                          'grade_11_sem2_gwa' => 'Grade 11 Second Sem GWA',
                          'grade_12_sem1_gwa' => 'Grade 12 First Sem GWA',
                          'grade_12_sem2_gwa' => 'Grade 12 Second Sem GWA',
                          '1st_year_sem1_gwa' => 'First Year First Sem GWA',
                          '1st_year_sem2_gwa' => 'First Year Second Sem GWA',
                          '2nd_year_sem1_gwa' => 'Second Year First Sem GWA',
                          '2nd_year_sem2_gwa' => 'Second Year Second Sem GWA',
                      ]; @endphp
        
                      @foreach ($gradeFields as $field => $label)
                          @if ($grade->$field)
                              @if (!$gradesExist)
                                  <div class="row mb-2">
                                      <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57;">GRADES</div>
                                  </div>
                                  @php $gradesExist = true; @endphp
                              @endif
                              <div class="row mb-2">
                                  <div class="col-lg-4 col-md-4 label">{{ $label }}</div>
                                  <div class="capitalize col-lg-7 col-md-8">{{ $grade->$field }}</div>
                              </div>
                          @endif
                      @endforeach
                  @endforeach --}}
{{-- </form>
                        </div>

                        <div class="tab-pane fade " id="household">
                            <form>
                                @foreach ($members as $member)
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label"
                                            style="margin-top: 20px; color: #0A6E57; font-weight: bold;">FAMILY
                                            INFORMATION</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Total Household Members</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ $member->total_household_members ?? '' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Father's Occupation</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ $member->father_occupation ?? '' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Father's Income</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ number_format($member->father_income ?? 0, 2) }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Mother's Occupation</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ $member->mother_occupation ?? '' }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Mother's Income</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ number_format($member->mother_income ?? 0, 2) }}</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-lg-4 col-md-4 label">Total Support Received</div>
                                        <div class="col-lg-8 col-md-8 capitalize">
                                            {{ number_format($member->total_support_received ?? 0, 2) }}</div>
                                    </div>
                                @endforeach
                            </form>
                        </div>

                        <div class="tab-pane fade" id="files">
                            <form>
                                <table class="table datatable table-responsive">
                                    <div class="alert alert-success" role="alert"
                                        style="text-align:center; display: none;" id="successMessage"></div>
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Document Type</th>
                                            <th scope="col">Notes</th>
                                            <th scope="col">Uploaded Document</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($reportcardData as $index => $requirement)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $requirement->document_type }}</td>
                                                <td>{{ $requirement->notes }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($requirement->uploaded_document) }}"
                                                        download="{{ basename($requirement->uploaded_document) }}"
                                                        style="text-decoration: underline;">
                                                        {{ basename($requirement->uploaded_document) }}
                                                    </a>
                                                </td>
                                                <td id="status-{{ $requirement->id }}"
                                                    class="badge p-2 status-{{ $requirement->id }}">
                                                    @if ($requirement->status == 'Approved')
                                                        <span
                                                            class="badge badge-success">{{ $requirement->status }}</span>
                                                    @elseif($requirement->status == 'Declined')
                                                        <span
                                                            class="badge badge-danger">{{ $requirement->status }}</span>
                                                        <br>
                                                        <span>Reason: {{ $requirement->declined_reason }}</span>
                                                    @elseif($requirement->status == 'For Review')
                                                        <span
                                                            class="badge badge-warning">{{ $requirement->status }}</span>
                                                    @else
                                                        {{ $requirement->status }}
                                                    @endif
                                                </td>
                                                <td class="d-flex justify-content-center">
                                            
                                                    @if ($requirement->status != 'Approved' && $requirement->status != 'Declined')
                                                        <button type="button"
                                                            class="btn btn-primary p-2 btn-fw change-status"
                                                            data-requirement-id="{{ $requirement->id }}"
                                                            data-action="Approved"
                                                            data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Approve</button>
                                                        <button type="button"
                                                            class="btn btn-danger p-2 mt-1 btn-fw  open-decline-modal"
                                                            data-requirement-id="{{ $requirement->id }}"
                                                            data-action="Declined"
                                                            data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Decline</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </form>
                        </div>

                        <!------------------------DECLINED MODAL----------------------------------------------->
                        <!-- Modal -->
                        <div class="modal fade" id="declineReasonModal" tabindex="-1"
                            aria-labelledby="declineReasonModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="declineReasonModalLabel">Decline Reason</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="background-color: white;">
                                        <form id="declineReasonForm">
                                            <div class="mb-3">
                                                <label for="declineReason" class="form-label">Reason</label>
                                                <textarea class="form-control" id="declineReason" rows="6" required
                                                    style="margin-bottom: 10px; border: 1px solid black;"></textarea>
                                            </div>
                                            <input type="hidden" id="requirementId" name="requirement_id">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-dark m-2"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-danger" id="submitDeclineReason"
                                            data-route="{{ route('requirements.file-status', ['requirement_id' => ':requirementId']) }}">Decline</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="checklist">
                            <div class="mt-4" id="alertContainer">
                                <div id="successAlert" class="alert alert-success d-none" role="alert">
                                    Notification sent successfully!
                                </div>
                                <div id="errorAlert" class="alert alert-danger d-none" role="alert">
                                    Failed to send notification. Please try again.
                                </div>
                            </div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-6">
                                        @foreach ($documentTypes as $index => $docType)
                                            <div class="form-check form-check-inline custom-checkbox ms-2">
                                                <input class="form-check-input" type="checkbox"
                                                    name="document_types[]" value="{{ $docType }}"
                                                    id="flexCheckDefault{{ $index + 1 }}">
                                                <label class="form-check-label"
                                                    for="flexCheckDefault{{ $index + 1 }}">
                                                    {{ $docType }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mt-4 text-center mt-3">
                                    <button type="button" id="notifyBtn" class="btn custom-btn">Notify</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <script src="../../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>

            <script src="../../assets-new-admin/js/off-canvas.js"></script>
            <script src="../../assets-new-admin/js/misc.js"></script>
            <!-- Vendor JS Files -->
            <script src="../../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
            <script src="../../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <script src="../../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
            <script src="../../assets-admin/vendor/tinymce/tinymce.min.js"></script>
            <script src="../../assets-admin/vendor/php-email-form/validate.js"></script>
            <script src="../../assets-admin/tinymce/tinymce.min.js"></script>

            <script src="../../assets-admin/vendor/chart.js/chart.umd.js"></script>
            <script src="../../assets-admin/vendor/echarts/echarts.min.js"></script>
            <script src="../../assets-admin/vendor/quill/quill.min.js"></script>

            <!-- Template Main JS File -->
            <script src="../../assets-admin/js/main.js"></script>
            <script src="../../assets-admin/js/checklist.js"></script>
            <script src="../../assets-admin/js/view_applicant.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="../../assets-new-admin/js/loader.js"></script>



</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>View Details</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <style>
        .custom-checkbox .form-check-input {
            border-color: black;
        }

        input[type="checkbox"] {
            pointer-events: none;
        }
    </style>
</head>

<body>
    <div id="loading-spinner" class="loading-spinner">
        <div class="loading-content">
            <img src="../../admin-assets/img/RLlogo.png" alt="Logo" class="loading-logo" id="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('admin-partials.sidebar')
        <div class="main-panel">
            @include('admin-partials.header')
        </div>
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">View Applicant Details</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="../../applicants/new_applicants">All Applicants</a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="#">View Applicant Details</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="personal-info" data-bs-toggle="pill"
                                            href="#personal-info-tab" role="tab" aria-controls="personal-info-tab"
                                            aria-selected="true">Personal Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="academic-info" data-bs-toggle="pill"
                                            href="#academic-info-tab" role="tab" aria-controls="academic-info-tab"
                                            aria-selected="false">Academic Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="family-info" data-bs-toggle="pill"
                                            href="#family-info-tab" role="tab" aria-controls="family-info-tab"
                                            aria-selected="false">Family Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="documents" data-bs-toggle="pill" href="#documents-tab"
                                            role="tab" aria-controls="documents-tab"
                                            aria-selected="false">Documents</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="monitoring-checklist" data-bs-toggle="pill"
                                            href="#monitoring-checklist-tab" role="tab"
                                            aria-controls="monitoring-checklist-tab" aria-selected="false">Monitoring
                                            Checklist</a>
                                    </li>
                                </ul>

                              <!-----------------------SUCCESS MESSAGE----------------------------------->
                                <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                    <div id="successToast" class="toast align-items-center text-bg-success border-0"
                                        role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="d-flex">
                                            <div class="toast-body">
                                                Status Change Successfully!
                                            </div>
                                            <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="personal-info-tab" role="tabpanel"
                                        aria-labelledby="personal-info">
                                        <div class="row mb-2">
                                            <div class="col-lg-4 col-md-4 label"
                                                style="margin-top: 20px; color: #0A6E57; font-weight: bold;">
                                                PERSONAL INFORMATION</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label mt-2 bold-label">Status: </div>
                                            <div class="col-lg-9 col-md-8 mt-2">
                                                {{ $status }}
                                            </div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">First Name:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->first_name }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Last Name:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->last_name }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Email:</div>
                                            <div class="col-lg-9 col-md-8" style="text-transform:lowercase;">
                                                {{ $email }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Contact Number:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->contact }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Birthday:</div>
                                            <div class="col-lg-9 col-md-8">
                                                {{ date('F j, Y', strtotime($applicant->birthday)) }}
                                            </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">House Number:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->house_number }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Street:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->street }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Barangay:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->barangay }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label bold-label">Municipality:</div>
                                            <div class="col-lg-9 col-md-8">{{ $applicant->municipality }}</div>
                                        </div>
                                        <br>
                                        <div class="mb-4">
                                            <div class="label bold-label mb-2">Note Address:</div>
                                            <div>{!! nl2br(e($applicant->noteAddress)) !!}</div>
                                        </div> 
                                        <div class="mb-4">
                                            <div class="label bold-label mb-2">Map Address:</div>
                                            <div>
                                                @php
                                                    $filename = basename($applicant->mapAddress);
                                                    $imagePath = public_path('storage/map-addresses/' . $filename);
                                                    $imageUrl = asset('storage/map-addresses/' . $filename);
                                                @endphp
                                                <a href="{{ $imageUrl }}" target="_blank">
                                                    <img src="{{ $imageUrl }}" alt="Map Address" class="img-fluid rounded" style="max-width: 50%; height: auto;">
                                                </a>
                                                @if (!file_exists($imagePath))
                                                    <p class="text-danger mt-2">Map Address image file not found</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="academic-info-tab" role="tabpanel"
                                        aria-labelledby="academic-info">
                                        <div class="row mb-2">
                                            <div class="col-lg-4 col-md-4 label"
                                                style="margin-top: 20px; color: #0A6E57; font-weight: bold;">ACADEMIC
                                                INFORMATION</div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-lg-4 col-md-4 label bold-label">Incoming Grade:</div>
                                            <div class="capitalize col-lg-7 col-md-8">
                                                {{ $applicant->academicInformation->incoming_grade_year }}</div>
                                        </div>
                                        @if (!empty($applicant->academicInformation->current_course_program_grade))
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Current Course or
                                                    Program</div>
                                                <div class="capitalize col-lg-7 col-md-8">
                                                    {{ $applicant->academicInformation->current_course_program_grade }}
                                                </div>
                                            </div>
                                        @endif

                                        <div class="row mb-2">
                                            <div class="col-lg-4 col-md-4 label bold-label">Current School:</div>
                                            <div class="capitalize col-lg-7 col-md-8">
                                                {{ $applicant->academicInformation->current_school }}</div>
                                        </div>

                                        @if ($applicant->grades->isNotEmpty())
                                            @foreach ($applicant->grades as $grade)
                                                <div class="row mb-2">
                                                    <div class="col-lg-4 col-md-4 label bold-label"
                                                        style="margin-top: 20px; color: #0A6E57; font-weight: bold;">
                                                        GRADES
                                                    </div>
                                                </div>
                                                @if (!empty($grade->latestAverage))
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label bold-label">Latest Average:
                                                        </div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $grade->latestAverage }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (!empty($grade->latestGWA))
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label bold-label">Latest General
                                                            Average:</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $grade->latestGWA }}
                                                        </div>
                                                    </div>
                                                @endif
                                                @if (!empty($grade->scopeGWA))
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label bold-label">Scope General
                                                            Average/GWA:</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $grade->scopeGWA }}</div>
                                                    </div>
                                                @endif
                                                @if (!empty($grade->equivalentGrade))
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label bold-label">Equivalent
                                                            Grade:</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $grade->equivalentGrade }}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif

                                        @if ($applicant->choices->isNotEmpty())
                                            @foreach ($applicant->choices as $choice)
                                                @if ($choice->first_choice_school)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label"
                                                            style="margin-top: 20px; color: #0A6E57; font-weight: bold;">
                                                            SCHOOL
                                                            APPLICATIONS</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">First School Choice</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->first_choice_school }}</div>
                                                    </div>
                                                @endif

                                                @if ($choice->second_choice_school)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">Second School Choice</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->second_choice_school }}</div>
                                                    </div>
                                                @endif

                                                @if ($choice->third_choice_school)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">Third School Choice</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->third_choice_school }}</div>
                                                    </div>
                                                @endif

                                                @if ($choice->first_choice_course)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label"
                                                            style="margin-top: 20px;  color: #0A6E57; font-weight: bold; ">
                                                            COURSE CHOICES</div>
                                                    </div>

                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">First Choice Course</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->first_choice_course }}</div>
                                                    </div>
                                                @endif

                                                @if ($choice->second_choice_course)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">Second Choice Course</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->second_choice_course }}</div>
                                                    </div>
                                                @endif

                                                @if ($choice->third_choice_course)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">Third Choice Course</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $choice->third_choice_course }}</div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endif
                                        @foreach ($applicant->grades as $grade)
                                            @for ($i = 3; $i <= 10; $i++)
                                                @php
                                                    $gradeField = 'grade_' . $i . '_gwa';
                                                @endphp

                                                @if ($grade->$gradeField && !$gradesExist)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label"
                                                            style="margin-top: 20px; color: #0A6E57; font-weight: bold;">
                                                            GRADES</div>
                                                    </div>
                                                    @php $gradesExist = true; @endphp
                                                @endif

                                                @if ($grade->$gradeField)
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">Grade {{ $i }}
                                                            GWA</div>
                                                        <div class="capitalize col-lg-7 col-md-8">
                                                            {{ $grade->$gradeField }}</div>
                                                    </div>
                                                @endif
                                            @endfor
                                        @endforeach
                                        @php
                                            $gradesExist = false;
                                        @endphp

                                        @foreach ($applicant->grades as $grade)
                                            @foreach ($gradeFields as $field => $label)
                                                @if ($grade->$field)
                                                    @if (!$gradesExist)
                                                        <div class="row mb-2">
                                                            <div class="col-lg-4 col-md-4 label"
                                                                style="margin-top: 20px; color: #0A6E57;">GRADES</div>
                                                        </div>
                                                        @php $gradesExist = true; @endphp
                                                    @endif
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-md-4 label">{{ $label }}</div>
                                                        <div class="capitalize col-lg-7 col-md-8">{{ $grade->$field }}
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        @endforeach

                                    </div>

                                    <div class="tab-pane fade" id="family-info-tab" role="tabpanel"
                                        aria-labelledby="family-info">
                                        @foreach ($members as $member)
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label"
                                                    style="margin-top: 20px; color: #0A6E57; font-weight: bold;">FAMILY
                                                    INFORMATION</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Total Household
                                                    Members:</div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ $member->total_household_members ?? '' }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Father's Occupation:
                                                </div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ $member->father_occupation ?? '' }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Father's Income:</div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ number_format($member->father_income ?? 0, 2) }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Mother's Occupation:
                                                </div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ $member->mother_occupation ?? '' }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Mother's Income:</div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ number_format($member->mother_income ?? 0, 2) }}</div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-lg-4 col-md-4 label bold-label">Total Support Received:
                                                </div>
                                                <div class="col-lg-8 col-md-8 capitalize">
                                                    {{ number_format($member->total_support_received ?? 0, 2) }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="tab-pane fade" id="documents-tab" role="tabpanel"
                                        aria-labelledby="documents">
                                        <form>
                                            <div class="table-responsive">
                                                <table id="basic-datatables"
                                                    class="display table table-striped table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Document Type</th>
                                                            <th>Notes</th>
                                                            <th>Uploaded Document</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="applicant-table">
                                                        @foreach ($reportcardData as $index => $requirement)
                                                            <tr>
                                                                <td>{{ $index + 1 }}</td>
                                                                <td>{{ $requirement->document_type }}</td>
                                                                <td
                                                                    style="max-width: 150px; word-wrap: break-word; overflow-wrap: break-word;">
                                                                    {{ $requirement->notes }}</td>
                                                                <td
                                                                    style="max-width: 110px; word-wrap: break-word; overflow-wrap: break-word;">
                                                                    <a href="{{ Storage::url($requirement->uploaded_document) }}"
                                                                        download="{{ basename($requirement->uploaded_document) }}"
                                                                        class="text-primary">
                                                                        {{ basename($requirement->uploaded_document) }}
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    @if ($requirement->status == 'Approved')
                                                                        <span
                                                                            class="badge bg-success text-white">{{ $requirement->status }}</span>
                                                                    @elseif($requirement->status == 'Declined')
                                                                        <span
                                                                            class="badge bg-danger text-white">{{ $requirement->status }}</span>
                                                                        <br>
                                                                        <small>Reason:
                                                                            {{ $requirement->declined_reason }}</small>
                                                                    @elseif($requirement->status == 'For Review')
                                                                        <span
                                                                            class="badge bg-warning text-dark">{{ $requirement->status }}</span>
                                                                    @else
                                                                        {{ $requirement->status }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if ($requirement->status != 'Approved' && $requirement->status != 'Declined')
                                                                        <div class="d-flex flex-column">
                                                                            @if ($requirement->status != 'Approved' && $requirement->status != 'Declined')
                                                                                <button type="button"
                                                                                    class="btn btn-primary p-2 btn-fw change-status"
                                                                                    data-requirement-id="{{ $requirement->id }}"
                                                                                    data-action="Approved"
                                                                                    data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Approve</button>
                                                                                <button type="button"
                                                                                    class="btn btn-danger p-2 mt-1 btn-fw  open-decline-modal"
                                                                                    data-requirement-id="{{ $requirement->id }}"
                                                                                    data-action="Declined"
                                                                                    data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Decline</button>
                                                                            @endif
                                                                        </div>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                        </form>
                                    </div>
                                    <!------------------------DECLINED MODAL----------------------------------------------->
                                    <!-- Modal -->
                                    <div class="modal fade" id="declineReasonModal" tabindex="-1"
                                        aria-labelledby="declineReasonModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="declineReasonModalLabel">Decline
                                                        Reason</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body" style="background-color: white;">
                                                    <form id="declineReasonForm">
                                                        <div class="col-sm-12 pe-0">
                                                            <div class="form-group">
                                                                <label for="notes">Input the reason</label>
                                                                <textarea class="form-control" id="declineReason" rows="6"></textarea>
                                                            </div>
                                                        </div>

                                                        <input type="hidden" id="requirementId"
                                                            name="requirement_id">
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary m-2"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-danger"
                                                        id="submitDeclineReason"
                                                        data-route="{{ route('requirements.file-status', ['requirement_id' => ':requirementId']) }}">Decline</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="monitoring-checklist-tab" role="tabpanel"
                                    aria-labelledby="monitoring-checklist">
                                    <div id="checklist">
                                        <div class="mt-4" id="alertContainer">
                                            <div id="successAlert" class="alert alert-success d-none" role="alert">
                                                Notification sent successfully!
                                            </div>
                                            <div id="errorAlert" class="alert alert-danger d-none" role="alert">
                                                Failed to send notification. Please try again.
                                            </div>
                                        </div>
                                        <p class="mt-3 p-2">
                                            <strong>Reminder: </strong>This checklist allows viewing approved documents
                                            and identifying incomplete requirements. Incomplete requirements will be
                                            listed, and if the "Notify" button is clicked, applicants will be reminded
                                            to submit the missing documents.
                                        </p>
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @foreach ($documentTypes as $index => $docType)
                                                        @if ($index < 6)
                                                            <div class="form-check custom-checkbox mb-1">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="document_types[]"
                                                                    value="{{ $docType }}"
                                                                    id="flexCheckDefault{{ $index + 1 }}">
                                                                <label class="form-check-label"
                                                                    for="flexCheckDefault{{ $index + 1 }}">
                                                                    {{ $docType }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="col-md-6">
                                                    @foreach ($documentTypes as $index => $docType)
                                                        @if ($index >= 6)
                                                            <div class="form-check custom-checkbox mb-1">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="document_types[]"
                                                                    value="{{ $docType }}"
                                                                    id="flexCheckDefault{{ $index + 1 }}">
                                                                <label class="form-check-label"
                                                                    for="flexCheckDefault{{ $index + 1 }}">
                                                                    {{ $docType }}
                                                                </label>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                        id="notifyBtn">Notify </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin-partials.footer')
    <script>
        $(document).ready(function() {
            $("#basic-datatables").DataTable({});
        });
    </script>
    <script src="../../../admin-assets/js/view-applicant.js"></script>
    <script src="../../../admin-assets/js/checklist.js"></script>
