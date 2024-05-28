<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="assets/img/RLlogo1.png" rel="icon">
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    {{-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">
    
</head>
<body>
   <div class="mx-auto container">

  <!-- Progress Form -->

    <form class="p-4 progress-form" action="{{ route('screening.post') }}" method="POST" id="progress-form"  lang="en" novalidate enctype="multipart/form-data">
      @csrf
      @if ($applicationOpen)
    <!-- Step Navigation -->
    <div class="d-flex align-items-start mb-3 sm:mb-5 progress-form__tabs" role="tablist">
      <button id="progress-form__tab-1" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-1" aria-selected="true">
        <span class="d-block step" aria-hidden="true">Step 1 <span class="sm:d-none">of 5</span></span>
        Eligibility, Qualifications & Requirements
      </button>
      <button id="progress-form__tab-2" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 2<span class="sm:d-none">of 5</span></span>
        Create Account
      </button>
      <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 3 <span class="sm:d-none">of 5</span></span>
        Personal Information
      </button>
      <button id="progress-form__tab-4" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 4 <span class="sm:d-none">of 5</span></span>
          Academic Information 
      </button>
      <button id="progress-form__tab-5" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-5" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 5 <span class="sm:d-none">of 5</span></span>
        Family Information
      </button>
    </div>
    <!-- / End Step Navigation -->

    <!-- Step 1 -->
    <section id="progress-form__panel-1" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
      
        <div class="mt-3 sm:mt-0 form__field">
            <p style="font-weight: bold; text-transform: uppercase;">To be eligible to receive the Real LIFE scholarship, applicants must:</p>
            <ul>
                <li>
                    Be a Filipino citizen
                </li>
                <li>
                    Have a grade weighted average (GWA) of at least 88% or its equivalent in the previous academic year for high school students or the previous semester for college students
                </li>
                <li>
                    Have a combined monthly household income of no more than 20,000 PHP
                </li>
                <li>
                    Not be married, have children, or be older than 25 years of age
                </li>
                <li>
                    Be enrolled at a school recognized by the Department of Education (DepEd) or Commission on Higher Education (CHED)
                </li>
                <li>
                    For high school applicants, be currently studying or willing to transfer to a public school
                </li>
                <li>
                    For college applicants, have tuition fees of not more than 15,000 PHP per semester
                </li>
                <li>
                    Be willing to undergo our character formation and leadership development programs
                </li>
            </ul>

            <p style="font-weight: bold;">REQUIREMENTS UPON APPLICATION :</p>
              <ul>
                <li>
                  Official Copy of Grades for three (3) School Years
                </li>
                <p><b>Proof of Financial Status</b> (submit <u><b>ANY</b></u> of the following)</p>
                <li>
                  2022 Income Tax Return (ITR)
                </li>               
                <li>
                  Payslip for the past 3 months of household members who contribute financialliy
                </li>
                <li>
                  Filled out Proof of Employment form (for those without payslip)
                </li>
                <li>
                  DSWD Case Report
                </li>
                <li>
                  Certificate of Non-Filling of Tax Return (if DSWD Case Report is not available)
                </li>
              </ul>
         </div>
        <div class="mt-3 form__field">
          <label for="email-address">
        </div>
        {{-- <span id="error-message" style="color: red; font-size: 10px;">Please agree before proceeding.</span> --}}
        <div class="mt-1 form__field">
          <label class="form__choice-wrapper">
            <input value="" id="email-newsletter" type="checkbox" name="agree">
        <span>
            I understand that the information I will provide will be used by Real LIFE Foundation to screen and process my application for SY 2023-2024. I give my consent to Real LIFE to use the data I will provide and the file attachments for the said application.
        </span>
    </label>
            <!-- Add an element to display the error message -->
        </div>
        <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
          <button type="button" data-action="next">Next</button>
        </div>
    </section>
    <!-- / End Step 1 -->
    <!-- Step 2 -->
    <section id="progress-form__panel-2" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
      <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
        <div class="form__field">
          <label for="email">
            Email
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="email" type="email" name="email" autocomplete="email" required>
        </div>
    
        <div class="form__field">
          <label for="password">
            Password
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="passwordField" type="password" name="password" autocomplete="password" required>
        </div>
        
        <div class="mt-3 form__field">
          <label for="confirm_password">
            Confirm Password
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value=""  id="confirmPasswordField" type="password" name="confirm_password" autocomplete="contact" required>
          <span id="passwordMatchError" class="error"></span>
        </div>
    
      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        <button type="button" data-action="next">
          Next
        </button>
      </div>
    </section>
    <!-- / End Step 2 -->

    <!-- Personal information-->
    <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
      <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
        <div class="form__field">
          <label for="address">
            First Name
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="firstname" type="text" name="firstname" autocomplete="firstname" required>
        </div>
    
        <div class="form__field">
          <label for="lastname">
            Last Name
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="lastname" type="text" name="lastname" autocomplete="lastname" required>
        </div>
    
        <div class="mt-3 form__field">
          <label for="phone-number">
            Contact number 
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="contact" type="tel" name="contact" autocomplete="contact" required>
        </div>
    
        <div class="mt-3 form__field">
          <label for="birthdate">
            Birthdate
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="birthdate" type="date" name="birthdate" autocomplete="birthdate" required max="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>
        

      <div class="mt-3 form__field">
        <label for="house-number">
          House Number
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input value="" id="houseNumber" type="text" name="houseNumber" autocomplete="houseNumber" required>
      </div>

      <div class="mt-3 form__field">
        <label for="street">
          Street
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input value="" id="street" type="text" name="street" autocomplete="street" required>
      </div>

      <div class="mt-3 form__field">
        <label for="barangay">
          Barangay
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input value="" id="barangay" type="text" name="barangay" autocomplete="barangay" required>
      </div>

      <div class="mt-3 form__field">
        <label for="municipality">
          Municipality
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input value="" id="municipality" type="text" name="municipality" autocomplete="municipality" required>
      </div>
    </div>
    
      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        <button type="button" data-action="next">
          Next
        </button>
      </div>
    </section>
 <!-- Step 3 -->

 <!-- Step 4 -->
    <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
      <p style="font-weight: bold;">REMINDER: </p>
      <p>Grade Weighted Average (GWA) of at least 88% or its equivalent in the previous academic year for high school students or the previous semester for college students.</p>
      <p>Upload the Report of Card for three indicated Grade/Year Levels.</p>
      <br>
      <h2 class="mt-3" style="font-weight: bold;">Educational Background </h2>
      <div class="sm:d-grid sm:grid-col-2">
        <div class="form__field">
            <label for="incoming-grade">
                Incoming Grade or Year Level
                <span data-required="true" aria-hidden="true"></span>
            </label>
            <select id="incomingGrade" name="incomingGrade" autocomplete="incoming grade" required>
              <option value="">Select grade or year level</option>
              <option value="GradeSeven">Grade 7</option>
              <option value="GradeEight">Grade 8</option>
              <option value="GradeNine">Grade 9</option>
              <option value="GradeTen">Grade 10</option>
              <option value="GradeEleven">Grade 11</option>
              <option value="GradeTwelve">Grade 12</option>
              <option value="FirstYear">First Year College</option>
              <option value="SecondYear">Second Year College</option>
              <option value="ThirdYear">Third Year College</option>
            </select>
        </div>

        <div class="form__field">
          <label for="currentSchool">
            Current School/University
            <span data-required="true" aria-hidden="true"></span>
            <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Please do not abbreviate</span>
          </label>
          <input value="" id="currentSchool" type="text" name="currentSchool" autocomplete="current school" required>
        </div>

        <div class="form__field mt-3" id="currentProgramField" style="display: none;">
          <label for="currentProgram">
              Current Program/Course
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="currentProgram" type="text" name="currentProgram" autocomplete="current program">
      </div>
      </div>

      <h1 style="font-weight: bold;">Grades</h1>
        <div class="sm:d-grid sm:grid-col-2">
          <div class="form__field" id="latestAverageField" style="display: none;">
            <label for="latestAverage" id="latestAverage-label">
              Latest General Average
              <span data-required="true" aria-hidden="true"></span>
            </label>
            <input value="" type="number" id="latestAverage" name="latestAverage" autocomplete="latestAverage">
          </div>
      
        <div class="form__field" id="latestGWAField" style="display: none;">
          <label for="latestGWA" id="latestGWA-label">
            Latest Grade Weighted Average
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value=""  id="latestGWA" type="number" name="latestGWA" autocomplete="latestGWA">
        </div>
      
        <div class="form__field">
          <label for="scopeGWA" id="scopeGWA-label">
            Scope of Latest GWA
            <span data-required="true" aria-hidden="true"></span>
            <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Ex. 1st Semester/ 2nd Grading</span>
          </label>
          <input value="" id="scopeGWA" type="text" name="scopeGWA" autocomplete="current school" required>
        </div>
      </div>

      <div class="sm:d-grid sm:grid-col-2">
        <div class="form__field" id="equivalentGradeField" style="display: none;">
          <label for="equivalentGrade">
            Grade Weighted Average Percentage Equivalent
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="equivalentGrade" type="number" name="equivalentGrade" autocomplete="equivalent grade">
      </div>

          <div class="mb-3 form__field"  id="ReportCardField">
            <label for="ReportCard">
                Report Card
                <span data-required="true" aria-hidden="true"></span>
                <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF only</span>
            </label>
            <input value="" id="ReportCard" type="file" name="ReportCard" autocomplete="report card" required style="padding" accept=".pdf">
        </div>
      </div>

        <h1 style="font-weight: bold;" id="schoolApplicationHeader" style="display: none;">School Application</h1>

        <div class="sm:d-grid sm:grid-col-2">
          <div class="form__field" id="schoolChoice1Field" style="display: none;">
            <label for="schoolChoice1" id="schoolChoice1-label">
            First Choice School
              <span data-required="true" aria-hidden="true"></span>
            </label>
            <input value="" type="text" id="schoolChoice1" name="schoolChoice1" autocomplete="schoolChoice1">
          </div>

          <div class="form__field" id="schoolChoice2Field" style="display: none;">
            <label for="schoolChoice2" id="schoolChoice2-label">
            Second Choice School
              <span data-required="true" aria-hidden="true"></span>
            </label>
            <input value="" type="text" id="schoolChoice2" name="schoolChoice2" autocomplete="schoolChoice2">
          </div>
        </div>

        <div class="sm:d-grid sm:grid-col-2">
        <div class="form__field" id="schoolChoice3Field">
          <label for="schoolChoice3" id="schoolChoice3-label">
          Third Choice School
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="schoolChoice3" name="schoolChoice3" autocomplete="schoolChoice3">
        </div>
      </div>

      <h1 id="preferredProgramHeader" style="font-weight: bold;">Preferred Program</h1>

      <div class="sm:d-grid sm:grid-col-2">
        <div class="form__field" id="courseChoice1Field">
          <label for="courseChoice1" id="courseChoice1-label">
            First Choice Program
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="courseChoice1" name="courseChoice1" autocomplete="courseChoice1">
        </div>

        <div class="form__field" id="courseChoice2Field">
          <label for="courseChoice2" id="courseChoice2-label">
            Second Choice Program
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="courseChoice2" name="courseChoice2" autocomplete="courseChoice2">
        </div>
      </div>

      <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="courseChoice3Field">
        <label for="courseChoice3" id="courseChoice3-label">
          Third Choice Program
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input value="" type="text" id="courseChoice3" name="courseChoice3" autocomplete="courseChoice3">
      </div>
    </div>

      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        <button type="button" data-action="next">
          Next
        </button>
      </div>
    </section>
  <!-- / End Step 4 -->

    <!-- Step 5 -->
    <section id="progress-form__panel-5" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
      <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
        <div class="form__field ">
          <label for="householdMembers">
           Total Number of Household Members 
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="householdMembers" type="number" name="householdMembers" autocomplete="householdMembers" required>
        </div>
    
        <div class="form__field" id="payslipField">
          <label for="payslip">
            Payslip/ Social Case Study Report/ ITR 
            <span data-required="true" aria-hidden="true"></span>
            <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF only</span>
          </label>
          <input value="" id="payslip" type="file" name="payslip" autocomplete="payslip" required style="padding" accept=".pdf">
        </div>
  
        <div class="mt-3 form__field">
          <label for="fatherOccupation">
            Father's Occupation
             <span data-required="true" aria-hidden="true"></span>
           </label>
           <input value="" id="fatherOccupation" type="text" name="fatherOccupation" autocomplete="fatherOccupation" required>
         </div>

         <div class="mt-3 form__field">
          <label for="fatherIncome">
            Monthly Net Income (take home pay)
             <span data-required="true" aria-hidden="true"></span>
           </label>
           <input value="" id="fatherIncome" type="number" name="fatherIncome" autocomplete="fatherIncome" required>
         </div>

         <div class="mt-3 form__field">
          <label for="motherOccupation">
            Mother's Occupation
             <span data-required="true" aria-hidden="true"></span>
           </label>
           <input value="" id="motherOccupation" type="text" name="motherOccupation" autocomplete="motherOccupation" required>
         </div>

         <div class="mt-3 form__field">
          <label for="incomeMother">
            Monthly Net Income (take home pay)
             <span data-required="true" aria-hidden="true"></span>
           </label>
           <input value="" id="incomeMother" type="number" name="incomeMother" autocomplete="incomeMother" required>
         </div>

         <div class="mt-3 form__field">
          <label for="supportReceived">
            Total Support Received
             <span data-required="true" aria-hidden="true"></span>
           </label>
           <input value="" id="supportReceived" type="text" name="supportReceived" autocomplete="supportReceived" required readonly>
         </div>
      </div>
    
      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        <button type="submit" id="submitButton" data-kt-stepper-action="submit">
          Submit
        </button>
      </div>
    </section>
  </form>

  @else
  <p>The screening form is currently closed.</p>
@endif
  
  <!-- / End Progress Form -->

</div>
      <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
      <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
      <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
      <script src="assets/vendor/php-email-form/validate.js"></script>
      <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
      
      <!-- Template Main JS File -->
      <script src="assets/js/registration.js"></script>
      {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  
</body>
</html>

{{-- <script>
document.addEventListener("DOMContentLoaded", function() {
    // Find the form element
    const form = document.getElementById("progress-form");

    // Add event listener for form submission
    form.addEventListener("submit", function(event) {
        // Prevent the default form submission behavior
        event.preventDefault();

        // Gather form data
        const formData = new FormData(form);

        // Convert FormData to JSON object
        const jsonObject = {};
        formData.forEach((value, key) => {
            jsonObject[key] = value;
        });

        // Make an AJAX request to submit the form data to your server
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('screening.post') }}", true);
        xhr.setRequestHeader("Content-Type", "application/json");
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Handle successful response from the server
                    console.log("Form data submitted successfully.");
                    // You can perform additional actions here, such as displaying a success message
                } else {
                    // Handle errors
                    console.error("Error submitting form data:", xhr.statusText);
                    // You can display an error message or handle the error in another way
                }
            }
        };
        xhr.send(JSON.stringify(jsonObject));
    });
});


</script> --}}

<script>
   $(document).ready(function() {
      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': csrfToken
          }
      });

      $('#submitButton').on('click', function(e) {
          e.preventDefault();

          // Change the button text to "Submitting..." and disable it
          $(this).text('Submitting...').prop('disabled', true);

          var formData = new FormData($('#progress-form')[0]);
          formData.append('_token', csrfToken);

          $.ajax({
              type: 'POST',
              url: '{{ route('screening.post') }}',
              data: formData,
              processData: false,
              contentType: false,
              success: function(response) {
                  window.location.href = '{{ route('verification') }}';
              },
              error: function(xhr, status, error) {
                console.log(xhr);  // Debugging line to see the error
                if (xhr.status == 422) {
                    var errors = xhr.responseJSON.errors;
                    var errorMessage = "";
                    $.each(errors, function(key, value) {
                        if (key === 'email' && value[0] === 'The email has already been taken.') {
                            errorMessage = "The email address is already registered. Please use a different email.  ";
                        } else {
                            errorMessage += value[0] + "\n";
                        }
                    });
                    alert(errorMessage);
                } else if (xhr.status == 419) {
                    alert('Session expired. Please refresh the page and try again.');
                } else {
                    alert('Registration failed. Please try again.');
                  }

                  $('#error-messages').html(errorMessage);

                  // Re-enable the button and reset the text
                  $('#submitButton').text('Submit').prop('disabled', false);
              }
          });
      });
  });
</script>