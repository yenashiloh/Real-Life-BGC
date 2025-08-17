  <!-- Step 1 -->
  <style>
    ul.checklist {
        list-style-type: none;
        padding-left: 0;
    }

    ul.checklist li::before {
        font-family: "Font Awesome 5 Free";
        content: "\28\f00c\29";
        font-weight: 900;
        margin-right: 8px;
        font-size: 16px;
    }

    ul.checklist li::before {
        color: green;
    }

    ul.checklist li {
        position: relative;
    }
   @media (max-width: 768px) {
    input[type="checkbox"] {
      width: 45px !important; 
      height: 30px !important;
    }
  }

  @media (max-width: 480px) {
    input[type="checkbox"] {
      width: 45px !important; 
      height: 30px !important;
    }
  }
  
  @media (max-width: 360px) {
    input[type="checkbox"] {
      width: 35px !important; 
      height: 20px !important;
    }
  }
  
  @media (max-width: 320px) {
    input[type="checkbox"] {
      width: 30px !important; 
      height: 15px !important;
    }
  }
</style>
<section id="progress-form__panel-1" role="tabpanel" aria-labelledby="progress-form__tab-1" tabindex="0">
    <div class="mt-3 sm:mt-0 form__field">
        <p style="font-weight: bold;">To be eligible to receive the Real LIFE scholarship, applicants must:</p>
        <ul class="checklist">
            <li>Be a Filipino citizen</li>
            <li>GWA of at least 88% for the past three (3) School Years (2021-22, 2022-23, 2023-24)</li>
            <li>Maximum combined monthly household net income of P20,000</li>
        </ul>
        <p style="font-weight: bold;">Academic level</p>
        <ul class="checklist">
            <li>For High School: any year level</li>
            <li>For College: incoming 1st & 2nd year only</li>
            <li>Enrolled or will enroll in a state university or public school recognized by DepEd or CHED</li>
            <li>Not married, no children, and not older than 25 years old upon admission to the scholarship</li>
        </ul>
        <p style="font-weight: bold;">REQUIREMENTS UPON APPLICATION:</p>
        <ul class="checklist">
            <li>Prepare scanned copies or high-resolution photos of these documents. You will be asked to upload these
                on or before January 17, 2025. Only one (1) file will be accepted for each document type (e.g. copies
                of TOR and grades should be in one document only). Additional documents might be asked as we progress
                with the screening of your application.</li>
        </ul>
        <p style="font-weight: bold;">OFFICIAL COPY OF GRADES</p>
        <ul class="checklist">
            <li>Official copy of grades or transcript of school records covering at least three academic years (SY
                2021-22, 2022-23, and 2023-24 only)</li>
        </ul>
        <p style="font-weight: bold;">PROJECTED TUITION FEES</p>
        <ul class="checklist">
            <li>Copy of DepEd voucher for SHS</li>
            <li>Projected Tuition Fees for College students</li>
        </ul>
        <p>
            <span style="font-weight: bold;">PROOF OF FINANCIAL STATUS</span><br>
            Submit any of the following:
        </p>
        <ul class="checklist">
            <li>Income Tax Return (ITR)</li>
            <li>Payslip for the past 3 months of household members who contribute to the settlement of household
                expenses</li>
            <li>DSWD's Case Study Report</li>
            <li>Certificate of Non-Filing of Income Tax Return (if other options are not available)</li>
        </ul>
        <p>The following documents will also be required as you progress in the application process:</p>
        <ul class="checklist">
            <li>Course Prospectus & Grading System (for College)</li>
            <li>2 Reference Forms</li>
            <li>Copy of Birth Certificate</li>
            <li>2x2 ID photo (soft copy)</li>
            <li>E-Signature (soft copy)</li>
        </ul>
    </div>


    <div class="mt-4 form__field">
        <fieldset style="border: none; padding: 0;">
            <label class="form__choice-wrapper" style="display: flex; align-items: center;">
                <input id="consent" type="checkbox" name="agree">
                <span>
                  I have read and agree to the
                  <a href="{{ route('data-privacy') }}" target="_blank" style="text-decoration: underline;">
                      <strong>Data Privacy Policy</strong>
                  </a>
              </span>
              

            </label>
        </fieldset>
    </div>

    <div class="d-flex align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
        <button type="button" data-action="next">Next</button>
    </div>
</section>
<!-- / End Step 1 -->
