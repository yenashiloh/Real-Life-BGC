 <!-- Profile Edit Form -->
 <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
     <form method="POST" action="{{ route('update_personal_details') }}" id="profile-form">
         @csrf
         @if (session('success'))
             <div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert"
                 style="width: 30%; margin: 0 auto;">
                 <span class="text-center" style="width: 100%;">{{ session('success') }}</span>
             </div>
         @endif

         @if (session('error'))
             <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 {{ session('error') }}
                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
             </div>
         @endif

         {{-- PERSONAL INFORMATION --}}
         <div class="row mb-3">
             <h5 class="card-title" style="font-weight: bold;  color: #212529;">Personal
                 Information</h5>
             <div class="col-md-6">
                 <label for="first_name" class="col-form-label" style="font-weight: normal;">First Name</label>
                 <input name="first_name" type="text" class="form-control" id="first_name"
                     value="{{ $personalInfo->first_name ?? '' }}">
             </div>

             <div class="col-md-6">
                 <label for="last_name" class="col-form-label" style="font-weight: normal;">Last Name</label>
                 <input name="last_name" type="text" class="form-control" id="last_name"
                     value="{{ $personalInfo->last_name ?? '' }}">
             </div>
         </div>

         <div class="row mb-3">
             <div class="col-md-6">
                 <label for="contact_no" class="col-form-label" style="font-weight: normal;">Contact Number</label>
                 <input name="contact_no" type="number" class="form-control" id="contact_no"
                     value="{{ $personalInfo->contact ?? '' }}">
             </div>

             <div class="col-md-6">
                 <label for="birthdate" class="col-form-label" style="font-weight: normal;">Birthdate</label>
                 <input name="birthdate" type="date" class="form-control" id="birthdate"
                     value="{{ $personalInfo->birthday ?? '' }}" max="{{ date('Y-m-d') }}e">
             </div>

         </div>

         <div class="row mb-3">
             <div class="col-md-6">
                 <label for="house_no" class="col-form-label" style="font-weight: normal;">House Number</label>
                 <input name="house_no" type="text" class="form-control" id="house_no"
                     value="{{ $personalInfo->house_number ?? '' }}">
             </div>

             <div class="col-md-6">
                 <label for="street" class="col-form-label" style="font-weight: normal;">Street</label>
                 <input name="street" type="text" class="form-control" id="street"
                     value="{{ $personalInfo->street ?? '' }}">
             </div>
         </div>

         <div class="row mb-3">
             <div class="col-md-6">
                 <label for="barangay" class="col-form-label" style="font-weight: normal;">Barangay</label>
                 <input name="barangay" type="text" class="form-control" id="barangay"
                     value="{{ $personalInfo->barangay ?? '' }}">
             </div>

             <div class="col-md-6">
                 <label for="municipality" class="col-form-label" style="font-weight: normal;">Municipality</label>
                 <input name="municipality" type="text" class="form-control" id="municipality"
                     value="{{ $personalInfo->municipality ?? '' }}">
             </div>
         </div>
         <br>

         {{-- ACADEMIC INFORMATION --}}
         <div class="row mb-3">
             <h5 class="card-title" style="font-weight: bold; color:#212529;">Academic Information</h5>

             <div class="col-md-6">
                 <label for="incoming_grade" class="col-form-label" style="font-weight: normal;">Incoming
                     Grade</label>
                 <select name="incoming_grade" class="form-select" id="incoming_grade" disabled>
                     <option value="" style="color#212529;">Select incoming grade</option>
                     @foreach (['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12', 'First Year College', 'Second Year College', 'Third Year College', 'Fourth Year College'] as $grade)
                         <option value="{{ $grade }}"
                             {{ isset($academicInfoData) && $academicInfoData->incoming_grade_year === $grade ? 'selected' : '' }}>
                             {{ $grade }}</option>
                     @endforeach
                 </select>
             </div>

             <div class="col-md-6">
                 <label for="current_school" class="col-form-label" style="font-weight: normal;">Current
                     School</label>
                 <input name="current_school" type="text" class="form-control" id="current_school"
                     value="{{ $academicInfoData->current_school }}">
             </div>

             @if (!empty($academicInfoData->current_course_program_grade))
                 <div class="col-md-6" style="margin-top: 10px;">
                     <label for="current_course" class="col-form-label" style="font-weight: normal;">Current Course
                         or Program</label>
                     <input name="current_course_program_grade" type="text" class="form-control"
                         id="current_course" value="{{ $academicInfoData->current_course_program_grade }}">
                 </div>
             @endif

         </div>

         {{-- SCHOOL APPLICATION AND COURSE CHOICE --}}
         @if (
             !empty($academicInfoChoiceData->first_choice_school) ||
                 !empty($academicInfoChoiceData->second_choice_school) ||
                 !empty($academicInfoChoiceData->third_choice_school))
             <br>
             <div class="row mb-3">
                 <h5 class="card-title" style="font-weight: bold; color:#212529;">School Application</h5>
                 @if (!empty($academicInfoChoiceData->first_choice_school))
                     <div class="col-md-4">
                         <label for="first_choice_school" class="col-form-label" style="font-weight: normal;">First
                             Choice School</label>
                         <input name="first_choice_school" type="text" class="form-control"
                             id="first_choice_school" value="{{ $academicInfoChoiceData->first_choice_school }}">
                     </div>
                 @endif
                 @if (!empty($academicInfoChoiceData->second_choice_school))
                     <div class="col-md-4">
                         <label for="second_choice_school" class="col-form-label" style="font-weight: normal;">Second
                             Choice School</label>
                         <input name="second_choice_school" type="text" class="form-control"
                             id="second_choice_school" value="{{ $academicInfoChoiceData->second_choice_school }}">
                     </div>
                 @endif
                 @if (!empty($academicInfoChoiceData->third_choice_school))
                     <div class="col-md-4">
                         <label for="third_choice_school" class="col-form-label" style="font-weight: normal;">Third
                             Choice School</label>
                         <input name="third_choice_school" type="text" class="form-control"
                             id="third_choice_school" value="{{ $academicInfoChoiceData->third_choice_school }}">
                     </div>
                 @endif
             </div>
         @endif

         @if (
             !empty($academicInfoChoiceData->first_choice_course) ||
                 !empty($academicInfoChoiceData->second_choice_course) ||
                 !empty($academicInfoChoiceData->third_choice_course))
             <br>
             <div class="row mb-3">
                 <h5 class="card-title" style="font-weight: bold; color:#212529;">Choice Courses</h5>
                 @if (!empty($academicInfoChoiceData->first_choice_course))
                     <div class="col-md-4">
                         <label for="first_choice_course" class="col-form-label" style="font-weight: normal;">First
                             Choice Courses</label>
                         <input name="first_choice_course" type="text" class="form-control"
                             id="first_choice_course" value="{{ $academicInfoChoiceData->first_choice_course }}">
                     </div>
                 @endif
                 @if (!empty($academicInfoChoiceData->second_choice_course))
                     <div class="col-md-4">
                         <label for="second_choice_course" class="col-form-label" style="font-weight: normal;">Second
                             Choice Course</label>
                         <input name="second_choice_course" type="text" class="form-control"
                             id="second_choice_course" value="{{ $academicInfoChoiceData->second_choice_course }}">
                     </div>
                 @endif
                 @if (!empty($academicInfoChoiceData->third_choice_course))
                     <div class="col-md-4">
                         <label for="third_choice_course" class="col-form-label" style="font-weight: normal;">Third
                             Choice Course</label>
                         <input name="third_choice_course" type="text" class="form-control"
                             id="third_choice_course" value="{{ $academicInfoChoiceData->third_choice_course }}">
                     </div>
                 @endif
             </div>
         @endif

         <br>


         <div class="row mb-3">
             <h5 class="card-title" style="font-weight: bold; color:#212529;">Grades</h5>

             @php
                 $gwaFields = [
                     'grade_3_gwa' => 'Grade 3 GWA',
                     'grade_4_gwa' => 'Grade 4 GWA',
                     'grade_5_gwa' => 'Grade 5 GWA',
                     'grade_6_gwa' => 'Grade 6 GWA',
                     'grade_7_gwa' => 'Grade 7 GWA',
                     'grade_8_gwa' => 'Grade 8 GWA',
                     'grade_9_gwa' => 'Grade 9 GWA',
                     'grade_10_gwa' => 'Grade 10 GWA',
                     'grade_11_sem1_gwa' => 'Grade 11 First Sem GWA',
                     'grade_11_sem2_gwa' => 'Grade 11 Second Sem GWA',
                     'grade_11_sem3_gwa' => 'Grade 11 Third Sem GWA',
                     'grade_12_sem1_gwa' => 'Grade 12 First Sem GWA',
                     'grade_12_sem2_gwa' => 'Grade 12 Second Sem GWA',
                     'grade_12_sem3_gwa' => 'Grade 12 Third Sem GWA',
                     '1st_year_sem1_gwa' => '1st Year First Sem GWA',
                     '1st_year_sem2_gwa' => '1st Year Second Sem GWA',
                     '1st_year_sem3_gwa' => '1st Year Third Sem GWA',
                     '1st_year_sem4_gwa' => '1st Year Fourth Sem GWA',
                     '2nd_year_sem1_gwa' => '2nd Year First Sem GWA',
                     '2nd_year_sem2_gwa' => '2nd Year Second Sem GWA',
                     '2nd_year_sem3_gwa' => '2nd Year Third Sem GWA',
                     '2nd_year_sem4_gwa' => '2nd Year Fourth Sem GWA',
                 ];
             @endphp

             @foreach ($gwaFields as $fieldName => $label)
                 @if (!empty($academicInfoGradesData->$fieldName))
                     <div class="col-md-4 mb-3">
                         <label for="{{ $fieldName }}" class="col-form-label"
                             style="font-weight: normal;">{{ $label }}</label>
                         <input name="{{ $fieldName }}" type="number" class="form-control gwa-input"
                             id="{{ $fieldName }}" value="{{ $academicInfoGradesData->$fieldName }}"
                             style="margin-bottom: 10px;">
                     </div>
                 @endif
             @endforeach
         </div>

         <div class="text-center">
             <button type="submit" class="btn btn-primary" style="margin-top: 13px;" id="save-changes-btn"
                 {{ auth()->user()->status !== 'New Applicant' || in_array(auth()->user()->status, ['Under Review', 'Shortlisted', 'For Interview', 'For House Visitation', 'Declined']) ? 'disabled' : '' }}>Save
                 Changes</button>
         </div>
     </form><!-- End Profile Edit Form -->
 </div>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script>
     document.addEventListener('DOMContentLoaded', function() {
         let lastTab = sessionStorage.getItem('lastTab');
         if (lastTab) {
             let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
             if (tabLink) {
                 let tab = new bootstrap.Tab(tabLink);
                 tab.show();
             }
         }

         let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
         tabLinks.forEach(function(tabLink) {
             tabLink.addEventListener('shown.bs.tab', function(event) {
                 let activeTab = event.target.getAttribute('data-bs-target');
                 sessionStorage.setItem('lastTab', activeTab);
             });
         });

     });

     document.querySelectorAll('.alert .btn-close').forEach(function(closeBtn) {
         closeBtn.addEventListener('click', function() {
             this.parentNode.style.display = 'none';
         });
     });

     $(document).ready(function() {
         var initialData = $('#profile-form').serialize();

         function checkFormChanges() {
             var currentData = $('#profile-form').serialize();
             $('#save-changes-btn').prop('disabled', currentData === initialData);
         }

         if ("{{ auth()->user()->status }}" === "New Applicant") {
             $('#profile-form :input').on('input', function() {
                 checkFormChanges();
             });
         } else {
             $('#save-changes-btn').prop('disabled', true);
         }

         if ("{{ auth()->user()->status }}" === "New Applicant") {
             checkFormChanges();
         }

         var successAlert = $('.alert-success');
         if (successAlert.length) {
             setTimeout(function() {
                 successAlert.alert('close');
             }, 8000);
         }

     });
     $(document).ready(function() {
         $('#profile-form').submit(function(event) {
             var emptyFields = [];
             $('input[type="text"], input[type="number"]').each(function() {
                 if ($(this).val() === '') {
                     emptyFields.push($(this).attr('name'));
                 }
             });

             if ($('#birthdate').val() === '') {
                 emptyFields.push('birthdate');
             }

             if (emptyFields.length > 0) {
                 event.preventDefault();

                 $('.alert').remove();

                 var errorMessage = (emptyFields.length === 1 && emptyFields.includes('birthdate')) ?
                     'Birthdate should not be empty.' : 'The field(s) should not be empty.';
                 var alertElement = $(
                     '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert" style="width: 30%; margin: 0 auto;"></div>'
                 );
                 alertElement.html(errorMessage);
                 $('#profile-edit').prepend(alertElement);

                 setTimeout(function() {
                     alertElement.alert('close');
                 }, 10000);
             } else {
                 var birthdate = new Date($('#birthdate').val());
                 var today = new Date();
                 var age = today.getFullYear() - birthdate.getFullYear();
                 var birthMonth = birthdate.getMonth();
                 var currentMonth = today.getMonth();

                 if (currentMonth < birthMonth || (currentMonth === birthMonth && today.getDate() <
                         birthdate.getDate())) {
                     age--;
                 }

                 if (age >= 26) {
                     event.preventDefault();

                     $('.alert').remove();

                     var ageAlert = $(
                         '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert" style="width: 50%; margin: 0 auto;"></div>'
                     );
                     ageAlert.html('The age requirement should be 25 years old or below.');
                     $('#profile-edit').prepend(ageAlert);

                     setTimeout(function() {
                         ageAlert.alert('close');
                     }, 10000);
                 }
             }
         });
     });

     document.addEventListener("DOMContentLoaded", function() {
         const form = document.getElementById("profile-form");
         form.addEventListener("submit", function(event) {
             const inputs = document.querySelectorAll(".gwa-input");
             let error = false;

             inputs.forEach(function(input) {
                 const gwa = parseFloat(input.value);

                 if (gwa < 87 || gwa > 100 || isNaN(gwa)) {
                     error = true;
                 }
             });

             if (error) {
                 event.preventDefault();
                 const errorMessage =
                     "Applicants must have a General Weighted Average within the range of 88 to 100.";
                 const errorAlert = document.querySelector(".alert.alert-danger");

                 if (errorAlert) {
                     errorAlert.innerHTML = errorMessage;
                 } else {
                     const errorDiv = document.createElement("div");
                     errorDiv.classList.add("alert", "alert-danger", "alert-dismissible", "fade",
                         "show");
                     errorDiv.setAttribute("role", "alert");
                     errorDiv.innerHTML = `${errorMessage}`;
                     form.insertBefore(errorDiv, form.firstChild);
                 }
             }
         });
     });
 </script>
