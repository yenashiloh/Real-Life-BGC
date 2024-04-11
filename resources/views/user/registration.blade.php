<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
  <form id="progress-form" class="p-4 progress-form" action="https://httpbin.org/post" lang="en" novalidate>

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
         Information Academic Information 
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
            <input id="checkboxForm" type="checkbox" name="checkbox" value="Yes" required> 
             {{-- <span data-required="true" aria-hidden="true"> --}}
              <span>
                I understand that the information I will provide will be used by Real LIFE Foundation to screen and process my application for SY 2023-2024. I give my consent to
                Real LIFE to use the data I will
                provide and the file attachments for the said application.
              </span></span>
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
          <input id="email" type="email" name="email" autocomplete="email" required>
        </div>
    
        <div class="form__field">
          <label for="password">
            Password
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="passwordField" type="password" name="password" autocomplete="password" required>
        </div>
        
        <div class="mt-3 form__field">
          <label for="confirm_password">
            Confirm Password
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input  id="confirmPasswordField" type="password" name="confirm_password" autocomplete="contact" required>
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
          <input id="firstname" type="text" name="firstname" autocomplete="firstname" required>
        </div>
    
        <div class="form__field">
          <label for="lastname">
            Last Name
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="lastname" type="text" name="lastname" autocomplete="lastname" required>
        </div>
    
        <div class="mt-3 form__field">
          <label for="phone-number">
            Contact number 
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="contact" type="tel" name="contact" autocomplete="contact" required>
        </div>
    
        <div class="mt-3 form__field">
          <label for="birthdate">
            Birthdate
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="birthdate" type="date" name="birthdate" autocomplete="birthdate" required max="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>
        

      <div class="mt-3 form__field">
        <label for="house-number">
          House Number
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input id="houseNumber" type="text" name="houseNumber" autocomplete="houseNumber" required>
      </div>

      <div class="mt-3 form__field">
        <label for="street">
          Street
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input id="street" type="text" name="street" autocomplete="street" required>
      </div>

      <div class="mt-3 form__field">
        <label for="barangay">
          Barangay
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input id="barangay" type="text" name="barangay" autocomplete="barangay" required>
      </div>

      <div class="mt-3 form__field">
        <label for="municipality">
          Municipality
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <input id="municipality" type="text" name="municipality" autocomplete="municipality" required>
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
                <option value="FourthYear">Fourth Year College</option>
            </select>
        </div>

        <div class="form__field">
          <label for="currentSchool">
            Current School/University
            <span data-required="true" aria-hidden="true"></span>
            <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Please do not abbreviate</span>
          </label>
          <input id="currentSchool" type="text" name="currentSchool" autocomplete="current school" required>
        </div>

        <div class="form__field mt-3 ">
          <label for="currentProgram">
            Current Program/Course
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="currentProgram" type="text" name="currentProgram" autocomplete="current program" required>
        </div>
      </div>

      <h1 style="font-weight: bold;">Grades <span class="form__field"style="color: red; font-size: 10px; font-weight: normal;">GWA (General Weighted
          Average):
          If grades are 5 point scale, write the equivalent. </span>
      </h1>

      <div class="sm:d-grid sm:grid-col-3">
        @for ($i = 3; $i <= 10; $i++)
        <div class="mb-3 form__field grade-input" id="grade{{ $i }}" style="display: none;">
            <label for="gwa">Grade {{ $i }} GWA
                <span data-required="true" aria-hidden="true"></span>
            </label>
            <input type="number" name="grade{{ $i }}GWA" autocomplete="gwa">
        </div>
      @endfor

      <!-------GRADE 11 SEMESTERS------>
        <div class="form__field" style="display: none;">
          <label for="grade11Semesters">
              Grade 11 Semesters Completed
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <select id="grade11SemSelect" name="grade11Semester" autocomplete="grade 11 sem" required>
              <option value="">Select grade or year level</option>
              <option value="TwoSem">Two Semesters</option>
              <option value="ThreeSem">Three Semesters</option>
          </select>
      </div>

      @for ($j = 1; $j <= 3; $j++)
      <div class="form__field" id="grade11{{ $j }}SemGWA" style="display: none;">
          <label for="gwa">Grade 11 {{ $j == 1 ? 'First' : ($j == 2 ? 'Second' : 'Third') }} Sem GWA
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input type="number" name="grade11{{ $j }}SemGWA" autocomplete="gwa">
      </div>
      @endfor

      <!-------GRADE 12 SEMESTERS------>
      <div class="form__field" style="display: none;">
        <label for="grade12Semesters">
            Grade 12 Semesters Completed
            <span data-required="true" aria-hidden="true"></span>
        </label>
        <select id="grade12SemSelect" name="grade12Semester" autocomplete="grade 12 sem" required>
            <option value="">Select grade or year level</option>
            <option value="TwoSem">Two Semesters</option>
            <option value="ThreeSem">Three Semesters</option>
        </select>
    </div>

    @for ($j = 1; $j <= 3; $j++)
    <div class="form__field" id="grade12{{ $j }}SemGWA" style="display: none;">
        <label for="gwa">Grade 12 {{ $j == 1 ? 'First' : ($j == 2 ? 'Second' : 'Third') }} Sem GWA
            <span data-required="true" aria-hidden="true"></span>
        </label>
        <input type="number" name="grade12{{ $j }}SemGWA" autocomplete="gwa">
    </div>
    @endfor

    <!-------FIRST YEAR COLLEGE ------>
    
      <div class="mb-3 form__field"  id="ReportCardField" style="display: none;">
          <label for="ReportCard">
              Report Card
              <span data-required="true" aria-hidden="true"></span>
              <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF only</span>
          </label>
          <input id="ReportCard" type="file" name="ReportCard" autocomplete="report card" required style="padding">
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
          <label for="employed">
            Number of Family Employed
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="employed" type="number" name="employed" autocomplete="employed" required>
        </div>
    
        <div class="form__field" id="ReportCardField">
          <label for="ReportCard">
            Payslip/DSWD Report/ITR 
            <span data-required="true" aria-hidden="true"></span>
            <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF only</span>
          </label>
          <input id="payslip" type="file" name="payslip" autocomplete="payslip" required style="padding">
        </div>
    
        <div class="form__field" id="householdInfoFields"></div>

        <div class="mt-3 form__field" style="display: none;">
          <label for="totalMonthlyIncome">
            Total Monthly Income
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="totalMonthlyIncomeField" type="number" name="totalMonthlyIncome" autocomplete="totalMonthlyIncome" readonly>
        </div>
      </div>
    
      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        <button type="submit">
          Submit
        </button>
      </div>
    </section>
    
    {{-- <!-- / End Step 5 --> --}}
    <!-- Thank You -->
    <section id="progress-form__thank-you" hidden>
      <p>Thank you for your submission!</p>
      <p>We appreciate you contacting us. One of our team members will get back to you very&nbsp;soon.</p>
    </section>
    <!-- / End Thank You -->

  </form>
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
function saveFormData() {
    var inputs = document.querySelectorAll('input:not([type="file"]), select');
    var formData = {};

    inputs.forEach(function (input) {
        if (input.type === "select-one") {
            formData[input.name] = input.selectedIndex;
        } else {
            formData[input.name] = input.value;
        }
    });

    localStorage.setItem('formData', JSON.stringify(formData));
}

function loadFormData() {
    var storedData = localStorage.getItem('formData');

    if (storedData) {
        var formData = JSON.parse(storedData);

        for (var key in formData) {
            if (formData.hasOwnProperty(key)) {
                var inputElement = document.querySelector('[name="' + key + '"]');
                if (inputElement) {
                    if (inputElement.type === "select-one") {
                        inputElement.selectedIndex = formData[key];
                    } else if (inputElement.type !== "file") {
                        inputElement.value = formData[key];
                    }
                }
            }
        }
    }
}

window.addEventListener('load', loadFormData);

document.querySelectorAll('select').forEach(function (select) {
    select.addEventListener('change', saveFormData);
});

document.querySelector('[data-action="next"]').addEventListener('click', saveFormData);

document.addEventListener("DOMContentLoaded", function () {
        const incomingGradeSelect = document.getElementById("incomingGrade");

        const gradeInputs = document.querySelectorAll('.grade-input');

        incomingGradeSelect.addEventListener("change", function () {
            const selectedValue = incomingGradeSelect.value;

            gradeInputs.forEach(input => input.style.display = "none");

            if (selectedValue === "GradeSeven") {
                document.getElementById("grade3").style.display = "block";
                document.getElementById("grade4").style.display = "block";
                document.getElementById("grade5").style.display = "block";
            } else if (selectedValue === "GradeEight") {
                document.getElementById("grade4").style.display = "block";
                document.getElementById("grade5").style.display = "block";
                document.getElementById("grade6").style.display = "block";
            }
            
            
            // Add similar conditions for other grade levels
        });
    });

</script> --}}

