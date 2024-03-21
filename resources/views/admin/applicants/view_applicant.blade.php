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
      max-width: 300px; 
      white-space: normal;
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
            </div>

            <div class="card">
              <div class="card-body pt-3">
                <!-- Bordered Tabs -->
                <ul class="nav nav-tabs nav-tabs-bordered">
        
                  <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Personal Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Academic Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Household Information</button>
                  </li>
        
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#files">Files</button>
                  </li>
        
                </ul>
                <div class="tab-content pt-2">
        
                  <div class="tab-pane fade show active profile-overview" id="profile-overview" style="margin-top: 20px;">
        
                    <div class="row mb-2">
                      <div class="col-lg-3 col-md-4 label ">Status</div>
                      <div class="col-lg-2 col-md-8 badge p-2" style="
                        @if ($status === 'New Applicant')
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
                        <div class="col-lg-9 col-md-8">{{ $email }}</div>
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
        
                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
        
                    <form>
                      <div class="row mb-2">
                        <div class="col-lg-4 col-md-4 label">Incoming Grade</div>
                        <div class="col-lg-7 col-md-8">{{ $applicant->academicInformation->incoming_grade_year }}</div>
                      </div>
                      @if(!empty($applicant->academicInformation->current_course_program_grade))
                      <div class="row mb-2">
                          <div class="col-lg-4 col-md-4 label">Current Course or Program</div>
                          <div class="col-lg-7 col-md-8">{{ $applicant->academicInformation->current_course_program_grade }}</div>
                      </div>
                  @endif
        
                  <div class="row mb-2">
                    <div class="col-lg-4 col-md-4 label">Current School</div>
                    <div class="col-lg-7 col-md-8">{{ $applicant->academicInformation->current_school }}</div>
                  </div>
                
                  @if($applicant->choices->isNotEmpty())
                    @foreach($applicant->choices as $choice)
                        @if($choice->first_choice_school)
                            <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">SCHOOL APPLICATIONS</div>
                            </div>
        
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">First School Choice</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->first_choice_school }}</div>
                            </div>
                        @endif
                    
                        @if($choice->second_choice_school)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Second School Choice</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->second_choice_school }}</div>
                            </div>
                        @endif
                        
                        @if($choice->third_choice_school)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Third School Choice</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->third_choice_school }}</div>
                            </div>
                        @endif
                        
                        @if($choice->first_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label" style="margin-top: 20px;  color: #0A6E57; font-weight: bold; ">COURSE CHOICES</div>
                            </div>
                        
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">First Choice Course</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->first_choice_course }}</div>
                            </div>
                        @endif
                        
                        @if($choice->second_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Second Choice Course</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->second_choice_course }}</div>
                            </div>
                        @endif
                        
                        @if($choice->third_choice_course)
                            <div class="row mb-2">
                                <div class="col-lg-4 col-md-4 label">Third Choice Course</div>
                                <div class="col-lg-7 col-md-8">{{ $choice->third_choice_course }}</div>
                            </div>
                        @endif
                    @endforeach
                 @endif
        
                 @php $gradesExist = false; @endphp
        
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
                                <div class="col-lg-7 col-md-8">{{ $grade->$gradeField }}</div>
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
                                  <div class="col-lg-7 col-md-8">{{ $grade->$field }}</div>
                              </div>
                          @endif
                      @endforeach
                  @endforeach
        
        
                    </form><!-- End Profile Edit Form -->
        
                  </div>

                  <div class="tab-pane fade " id="profile-settings">
                    <form>
                      @foreach ($members as $member)
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label" style="margin-top: 20px; color: #0A6E57; font-weight: bold;">Household Employed {{ $loop->iteration }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Name</div>
                              <div class="col-lg-8 col-md-8">{{ $member->name ?? '' }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Relationship</div>
                              <div class="col-lg-8 col-md-8">{{ $member->relationship ?? '' }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Occupation</div>
                              <div class="col-lg-8 col-md-8">{{ $member->occupation ?? '' }}</div>
                          </div>
                          <div class="row mb-2">
                              <div class="col-lg-4 col-md-4 label">Monthly Income</div>
                              <div class="col-lg-8 col-md-8">{{ number_format($member->monthly_income ?? 0, 2) }}</div>
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
                                      <a href="{{ Storage::url($requirement->uploaded_document) }}" download="{{ $requirement->uploaded_document }}" style="text-decoration: underline;">
                                        {{ basename($requirement->uploaded_document) }}
                                    </a>
                                    
                                    </td>
                                    <td id="status-{{ $requirement->id }}" class="status-{{ $requirement->id }}">
                                      @if($requirement->status == 'Approved')
                                          <span class="badge badge-success">{{ $requirement->status }}</span>
                                      @elseif($requirement->status == 'Declined')
                                          <span class="badge badge-danger">{{ $requirement->status }}</span>
                                       @elseif($requirement->status == 'For Review')
                                          <span class="badge badge-warning">{{ $requirement->status }}</span>
                                      @else
                                          {{ $requirement->status }}
                                      @endif
                                  </td>                           
                                  <td class="d-flex justify-content-center">
                                      <button type="button" class="btn btn-primary p-2 btn-fw change-status" data-requirement-id="{{ $requirement->id }}" data-action="Approved" data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Approve</button>
                                      <button type="button" class="btn btn-danger p-2 mt-1 btn-fw change-status" data-requirement-id="{{ $requirement->id }}" data-action="Declined" data-route="{{ route('requirements.file-status', ['requirement_id' => $requirement->id]) }}">Decline</button>                                      
                                  </td>
                              </tr>
                              @endforeach
                          </tbody>
                        </table>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
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
    
    
    <script>
        $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      document.addEventListener('DOMContentLoaded', function () {
          let lastTab = sessionStorage.getItem('lastTab');
          if (lastTab) {
              let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
              if (tabLink) {
                  let tab = new bootstrap.Tab(tabLink);
                  tab.show();
              }
          }
  

      let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
      tabLinks.forEach(function (tabLink) {
          tabLink.addEventListener('shown.bs.tab', function (event) {
              let activeTab = event.target.getAttribute('data-bs-target');
              sessionStorage.setItem('lastTab', activeTab);
              });
          });
  
      });

      $('.change-status').on('click', function() {
    var requirementId = $(this).data('requirement-id');
    var action = $(this).data('action');
    var updateRoute = $(this).data('route');
    var newStatus = action;
    
    $.ajax({
        type: 'POST',
        url: updateRoute,
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            requirement_id: requirementId,
            status: action
        },
        success: function(response) {
            console.log('Status updated successfully:', response);
            localStorage.setItem('successMessage', 'Status Change Successfully!');

            window.location.reload();
        },
        error: function(xhr, status, error) {
            console.error('Error updating status:', error);
        }
    });
});

$(document).ready(function() {
    var successMessage = localStorage.getItem('successMessage');
    if (successMessage) {
        $('#successMessage').text(successMessage).fadeIn().delay(4000).fadeOut();
        localStorage.removeItem('successMessage'); 
    }
});

 </script>
  
</body>
</html>
