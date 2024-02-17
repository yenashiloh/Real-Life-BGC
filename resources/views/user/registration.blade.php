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
        Personal Information
      </button>
      <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 3 <span class="sm:d-none">of 5</span></span>
        Academic Information
      </button>
      <button id="progress-form__tab-4" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 4 <span class="sm:d-none">of 5</span></span>
        Household Information
      </button>
      <button id="progress-form__tab-5" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button" role="tab" aria-controls="progress-form__panel-5" aria-selected="false" tabindex="-1" aria-disabled="true">
        <span class="d-block step" aria-hidden="true">Step 5 <span class="sm:d-none">of 5</span></span>
        Create Account
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
            <input id="checkbox" type="checkbox" name="checkbox" value="Yes" required>
            <span>I certify that, <strong>ALL</strong> answers provided will be <strong>TRUE</strong> and <strong>CORRECT</strong>. Furthermore, I acknowledge that <strong>ANY ACT OF 
              DISHONESTY OF FALSIFICATION MAY BE A GROUNDS FOR MY DISQUALIFICATION</strong> from this scholarship program. I also understand that the submission of this application does 
              <strong>NOT AUTOMATICALLY QUALIFY</strong> me for the scholarship grant and that I will abide by the decision of the Real Life BGC Admins.</span>
          </label>
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
          <input id="birthdate" type="date" name="birthdate" autocomplete="birthdate" required>
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
    <!-- / End Step 2 -->

 <!-- Step 3 -->
 
    <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3" tabindex="0" hidden>
      <p style="font-weight: bold;">REMINDER: </p>
      <p>Grade Weighted Average (GWA) of at least 88% or its equivalent in the previous academic year for high school students or the previous semester for college students.</p>
      <p>Upload the Report of Card for three indicated Grade/Year Levels.</p>
      <br>
      <h2 class="mt-3" style="font-weight: bold;">Educational Background </h2>
      <div class="sm:d-grid sm:grid-col-3">
        <div class="form__field">
          <label for="incoming-grade">
            Incoming Grade or Year Level
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <select id="incomingGrade" name="incomingGrade" autocomplete="incoming grade" required>
            <option value="" disabled selected>Select grade or year level</option>
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
            Current School
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="currentSchool" type="text" name="currentSchool" autocomplete="current school" required>
        </div>

        <div class="form__field">
          <label for="currentProgram">
            Current Program
            <span data-required="true" aria-hidden="true"></span>
          </label>
          <input id="currentProgram" type="text" name="currentProgram" autocomplete="current program" required>
        </div>
      </div>

      <h1 style="font-weight: bold;">Grades <span class="form__field"style="color: red; font-size: 10px; font-weight: normal;">GWA (General Weighted
          Average):
          If grades are 5 point scale, write the equivalent. </span>
      </h1>
      <div class="sm:d-grid sm:grid-col-3 ">
        @for ($grade = 3; $grade <= 10; $grade++)
            @php
                $displayStyle = ($grade <= 6) ? '' : 'mb-3';
                $label = "Grade $grade GWA";
                $name = "grade{$grade}GWA";
                $gradeType = ($grade <= 5) ? 'GradeSeven' : 'GradeEight';
            @endphp
    
            <div class="mb-3 form__field" data-grade="{{ $gradeType }}">
                <label for="gwa">{{ $label }} 
                    <span data-required="true" aria-hidden="true"></span>
                </label>
                <input id="currentSchool" type="number" name="{{ $name }}" autocomplete="gwa" required>
            </div>
        @endfor

          <div class="mb-3 form__field">
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
  <!-- / End Step 3 -->

    <!-- Step 4 -->
    <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-4" tabindex="0" hidden>
      <div class="mt-3 form__field">
        <label for="product-satisfaction">
          How would you rate your level of satisfaction with the service you received?
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <select id="product-satisfaction" name="product-satisfaction" required>
          <option value="" disabled selected>Please select</option>
          <option value="Highly satisfied">Highly satisfied</option>
          <option value="Very satisfied">Very satisfied</option>
          <option value="Satisfied">Satisfied</option>
          <option value="Very dissatisfied">Very dissatisfied</option>
          <option value="Highly dissatisfied">Highly dissatisfied</option>
        </select>
      </div>
      <div class="mt-3 form__field">
        <label for="product-recommendation">
          How likely are you to recommend our products to friends or family?
          <span data-required="true" aria-hidden="true"></span>
        </label>
        <select id="product-recommendation" name="product-recommendation" required>
          <option value="" disabled selected>Please select</option>
          <option value="Highly likely">Highly likely</option>
          <option value="Very likely">Very likely</option>
          <option value="Likely">Satisfied</option>
          <option value="Very unlikely">Very unlikely</option>
          <option value="Highly unlikely">Highly unlikely</option>
        </select>
      </div>

      <fieldset id="product-purchase" class="mt-3 form__field">
        <legend>
          Which of the following products have you purchased in the past 6 months? Please check all that apply.
        </legend>
        <label class="form__choice-wrapper">
          <input type="checkbox" name="product-purchase" value="A">
          <span>Product A</span>
        </label>
        <label class="form__choice-wrapper">
          <input type="checkbox" name="product-purchase" value="B">
          <span>Product B</span>
        </label>
        <label class="form__choice-wrapper">
          <input type="checkbox" name="product-purchase" value="C">
          <span>Product C</span>
        </label>
      </fieldset>

      <div class="mt-3 form__field">
        <label for="product-feedback">
          Do you have any additional feedback or comments about our products?
        </label>
        <textarea id="product-feedback" name="product-feedback" rows="5"></textarea>
      </div>

      <div class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
        </button>
        {{-- <button type="submit">
          Submit
        </button> --}}
        <button type="button" data-action="next">
            Next
          </button>
      </div>
    </section>
    {{-- <!-- / End Step 3 --> --}}
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
  
      <!-- Template Main JS File -->
      <script src="assets/js/registration.js"></script>
      {{-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}
  
</body>
</html>


<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Check if there's any saved form data in local storage
      const formData = JSON.parse(localStorage.getItem('formData')) || {};

      // Populate form fields with saved data
      Object.keys(formData).forEach(key => {
          const element = document.getElementById(key);
          if (element) {
              element.value = formData[key];
          }
      });

      // Save form data to local storage on input change
      document.getElementById('progress-form').addEventListener('input', function (event) {
          const { id, value } = event.target;
          formData[id] = value;
          localStorage.setItem('formData', JSON.stringify(formData));
      });

      // Clear local storage on form submission
      document.getElementById('progress-form').addEventListener('submit', function () {
              localStorage.removeItem('formData');
          });
      });
      
      document.addEventListener('DOMContentLoaded', function () {
    const incomingGradeSelect = document.getElementById('incomingGrade');
    const gwaFields = document.querySelectorAll('.form__field[data-grade]');

    incomingGradeSelect.addEventListener('change', function () {
        const selectedGrade = incomingGradeSelect.value;
        gwaFields.forEach(field => {
            const fieldGrade = field.getAttribute('data-grade');
            field.style.display = fieldGrade === selectedGrade ? 'grid' : 'none';
        });
    });
});

</script>