<!DOCTYPE html>
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
    .capitalize{
      text-transform: capitalize;
    }
    .col-lg-9{
       text-transform: capitalize;
    }
    input[type="checkbox"] {
    pointer-events: none;
  }
    </style>
  </head>
  <body>
    @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper"> 
            <div class="page-header">
              <h3 class="page-title">View Applicant</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../applicants/new_applicants">All Applicants</a></li>
                  <li class="breadcrumb-item active" aria-current="page">View Applicant</li>
                </ol>
              </nav>
            </div>

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
        
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal-info">Personal Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#academic-info">Academic Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#household">Family Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#files">Documents</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#checklist">Monitoring Checklist</button>
                  </li>
        
                </ul>
                <div class="tab-content pt-2">
        
                  <div class="tab-pane fade show active profile-overview" id="personal-info" style="margin-top: 20px;">
        
                    <div class="row mb-2">
                      <div class="col-lg-3 col-md-4 label ">Status</div>
                      <div class="col-lg-2 col-md-8 badge p-2" style="
                        @if ($status === 'Sent')
                          margin-top: 2px;
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
                          color: #ffffff;
                        @endif
                      ">{{ $status }}</div>
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
                        <div class="col-lg-9 col-md-8" style="text-transform:lowercase;">{{ $email }}</div>
                      </div>
        
                    <div class="row mb-2">
                      <div class="col-lg-3 col-md-4 label">Contact Number</div>
                      <div class="col-lg-9 col-md-8">{{ $applicant->contact}}</div>
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
                      <div class="col-lg-9 col-md-8">{{ $applicant->barangay}}</div>
                    </div>
        
                    <div class="row mb-2">
                      <div class="col-lg-3 col-md-4 label">Municipality</div>
                      <div class="col-lg-9 col-md-8">{{ $applicant->municipality }}</div>
                    </div>
        
                  </div>
        
                  <div class="tab-pane fade profile-edit pt-3" id="academic-info">
        
                    <form>
                      <div class="row mb-2">
                        <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">ACADEMIC INFORMATION</div>
                    </div>
                      <div class="row mb-2"> 
                        <div class="col-lg-4 col-md-4 label">Incoming Grade</div>
                        <div class="capitalize col-lg-7 col-md-8">{{ $applicant->academicInformation->incoming_grade_year }}</div>
                      </div>
                      @if(!empty($applicant->academicInformation->current_course_program_grade))
                      <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label">Current Course or Program</div>
                          <div class="capitalize col-lg-7 col-md-8">{{ $applicant->academicInformation->current_course_program_grade }}</div>
                      </div>
                  @endif
        
                  <div class="row mb-2">
                    <div class="col-lg-4 col-md-4 label">Current School</div>
                    <div class="capitalize col-lg-7 col-md-8">{{ $applicant->academicInformation->current_school }}</div>
                  </div>

                  @if($applicant->grades->isNotEmpty())
                  @foreach($applicant->grades as $grade)
                      <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">GRADES</div>
                      </div>
                      @if(!empty($grade->latestAverage))
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Latest Average</div>
                              <div class="capitalize col-lg-7 col-md-8">{{ $grade->latestAverage }}</div>
                          </div>
                      @endif
                      @if(!empty($grade->latestGWA))
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Latest General Average</div>
                              <div class="capitalize col-lg-7 col-md-8">{{ $grade->latestGWA }}</div>
                          </div>
                      @endif
                      @if(!empty($grade->scopeGWA))
                      <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label">Scope General Average/GWA</div>
                          <div class="capitalize col-lg-7 col-md-8">{{ $grade->scopeGWA }}</div>
                      </div>
                      @endif
                      @if(!empty($grade->equivalentGrade))
                      <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label">Equivalent Grade</div>
                          <div class="capitalize col-lg-7 col-md-8">{{ $grade->equivalentGrade }}</div>
                      </div>
                      @endif
                  @endforeach
              @endif

                  @if($applicant->choices->isNotEmpty())
                    @foreach($applicant->choices as $choice)
                        @if($choice->first_choice_school)
                            <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">SCHOOL APPLICATIONS</div>
                            </div>
        
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">First School Choice</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->first_choice_school }}</div>
                            </div>
                        @endif
                    
                        @if($choice->second_choice_school)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Second School Choice</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->second_choice_school }}</div>
                            </div>
                        @endif
                        
                        @if($choice->third_choice_school)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Third School Choice</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->third_choice_school }}</div>
                            </div>
                        @endif
                        
                        @if($choice->first_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label" style="margin-top: 20px;  color: #0A6E57; font-weight: bold; ">COURSE CHOICES</div>
                            </div>
                        
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">First Choice Course</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->first_choice_course }}</div>
                            </div>
                        @endif
                        
                        @if($choice->second_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Second Choice Course</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->second_choice_course }}</div>
                            </div>
                        @endif
                        
                        @if($choice->third_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Third Choice Course</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $choice->third_choice_course }}</div>
                            </div>
                        @endif
                    @endforeach
                 @endif
        
             
                 {{-- @php $gradesExist = false; @endphp
        
                @foreach($applicant->grades as $grade)
                    @for($i = 3; $i <= 10; $i++)
                        @php
                            $gradeField = "grade_" . $i . "_gwa";
                        @endphp
        
                        @if($grade->$gradeField && !$gradesExist)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">GRADES</div>
                            </div>
                            @php $gradesExist = true; @endphp
                        @endif
        
                        @if($grade->$gradeField)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Grade {{ $i }} GWA</div>
                                <div class="capitalize col-lg-7 col-md-8">{{ $grade->$gradeField }}</div>
                            </div>
                        @endif
                    @endfor
                @endforeach
        
                  @foreach($applicant->grades as $grade)
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
        
                      @foreach($gradeFields as $field => $label)
                          @if($grade->$field)
                              @if(!$gradesExist)
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
               </form><!-- End Profile Edit Form -->
            </div>

                  <div class="tab-pane fade " id="household">
                    <form>
                      @foreach ($members as $member)
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">FAMILY INFORMATION</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Total Household Members</div>
                              <div class="col-lg-8 col-md-8 capitalize">{{ $member->total_household_members ?? '' }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Father's Occupation</div>
                              <div class="col-lg-8 col-md-8 capitalize">{{ $member->father_occupation ?? '' }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Father's Income</div>
                              <div class="col-lg-8 col-md-8 capitalize">{{ number_format($member->father_income?? 0, 2) }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Mother's Occupation</div>
                              <div class="col-lg-8 col-md-8 capitalize">{{ $member->mother_occupation ?? '' }}</div>
                          </div>
                        <div class="row mb-2">
                            <div class="col-lg-4 col-md-4 label">Mother's Income</div>
                            <div class="col-lg-8 col-md-8 capitalize">{{ number_format($member->mother_income?? 0, 2) }}</div>
                        </div>
                        <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label">Total Support Received</div>
                          <div class="col-lg-8 col-md-8 capitalize">{{ number_format($member->total_support_received?? 0, 2) }}</div>
                      </div>
                      @endforeach
                  </form>
                  </div>
        
                    <div class="tab-pane fade" id="files">
                      <form>
                          <table class="table datatable table-responsive">
                            <div class="alert alert-success" role="alert" style="text-align:center; display: none;" id="successMessage"></div>
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
                                @foreach($reportcardData as $index => $requirement)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $requirement->document_type }}</td>
                                    <td>{{ $requirement->notes }}</td>
                                    <td>
                                        <a href="{{ Storage::url($requirement->uploaded_document) }}" download="{{ basename($requirement->uploaded_document) }}" style="text-decoration: underline;">
                                            {{ basename($requirement->uploaded_document) }}
                                        </a>
                                    </td>
                                    <td id="status-{{ $requirement->id }}" class="badge p-2 status-{{ $requirement->id }}" >
                                        @if($requirement->status == 'Approved')
                                            <span class="badge badge-success">{{ $requirement->status }}</span>
                                        @elseif($requirement->status == 'Declined')
                                            <span class="badge badge-danger">{{ $requirement->status }}</span>
                                            <br>
                                            <span>Reason: {{ $requirement->declined_reason}}</span>
                                        @elseif($requirement->status == 'For Review')
                                            <span class="badge badge-warning">{{ $requirement->status }}</span>
                                        @else
                                            {{ $requirement->status }}
                                        @endif
                                    </td>                           
                                    <td class="d-flex justify-content-center">
                                        {{-- Conditionally render buttons based on requirement status --}}
                                        @if($requirement->status != 'Approved' && $requirement->status != 'Declined')
                                            <button type="button" class="btn btn-primary p-2 btn-fw change-status" data-requirement-id="{{ $requirement->id }}" data-action="Approved" data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Approve</button>
                                            <button type="button" class="btn btn-danger p-2 mt-1 btn-fw  open-decline-modal" data-requirement-id="{{ $requirement->id }}" data-action="Declined" data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Decline</button>
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
                    <div class="modal fade" id="declineReasonModal" tabindex="-1" aria-labelledby="declineReasonModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title" id="declineReasonModalLabel">Decline Reason</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body" style="background-color: white;">
                                  <form id="declineReasonForm">
                                      <div class="mb-3">
                                          <label for="declineReason" class="form-label">Reason</label>
                                          <textarea class="form-control" id="declineReason" rows="6" required style="margin-bottom: 10px; border: 1px solid black;"></textarea>
                                      </div>
                                      <input type="hidden" id="requirementId" name="requirement_id">
                                  </form>
                              </div>
                              <div class="modal-footer">
                                  <button type="button" class="btn btn-dark m-2" data-bs-dismiss="modal">Close</button>
                                  <button type="button" class="btn btn-danger" id="submitDeclineReason" data-route="{{ route('requirements.file-status', ['requirement_id' => ':requirementId']) }}" >Decline</button>
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
                                @foreach($documentTypes as $index => $docType)
                                <div class="form-check form-check-inline custom-checkbox ms-2">
                                    <input class="form-check-input" type="checkbox" name="document_types[]" value="{{ $docType }}" id="flexCheckDefault{{ $index + 1 }}">
                                    <label class="form-check-label" for="flexCheckDefault{{ $index + 1 }}">
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
          

    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>

    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
      <!-- Vendor JS Files -->
    <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="../assets-admin/vendor/php-email-form/validate.js"></script>
    <script src="../assets-admin/tinymce/tinymce.min.js"></script>
  
    <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
    <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
    <script src="../assets-admin/vendor/quill/quill.min.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets-admin/js/main.js"></script>
    <script src="../assets-admin/js/checklist.js"></script>
    <script src="../assets-admin/js/view_applicant.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    

</body>
</html>
