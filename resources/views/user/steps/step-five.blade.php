  <!-- Step 4 -->
  <section id="progress-form__panel-5" role="tabpanel" aria-labelledby="progress-form__tab-5"
  tabindex="0" hidden>
  <p style="font-weight: bold;">REMINDER: </p>
  <p>Grade Weighted Average (GWA) of at least 88% or its equivalent in the previous academic year for
      high school students or the previous semester for college students.</p>
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
              <span
                  style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Please
                  do not abbreviate</span>
          </label>
          <input value="" id="currentSchool" type="text" name="currentSchool"
              autocomplete="current school" required>
      </div>

      <div class="form__field mt-3" id="currentProgramField" style="display: none;">
          <label for="currentProgram">
              Current Program/Course
              <span data-required="true" aria-hidden="true"></span>
              <span
                  style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Please
                  do not abbreviate</span>
          </label>
          <input value="" id="currentProgram" type="text" name="currentProgram"
              autocomplete="current program">
      </div>
  </div>

  <h1 style="font-weight: bold;">Grades</h1>
  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="firstGeneralAverageField" style="display: none;">
          <label for="firstGeneralAverage" id="firstGeneralAverage-label">
              Grade General Average
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="number" id="firstGeneralAverage" name="firstGeneralAverage"
              autocomplete="firstGeneralAverage">
      </div>

      <div class="form__field" id="secondGeneralAverageField" style="display: none;">
          <label for="secondGeneralAverage" id="secondGeneralAverage-label">
              Grade General Average
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="number" id="secondGeneralAverage"
              name="secondGeneralAverage" autocomplete="secondGeneralAverage">
      </div>

      <div class="form__field" id="latestAverageField" style="display: none;">
          <label for="latestAverage" id="latestAverage-label">
              Latest General Average
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="number" id="latestAverage" name="latestAverage"
              autocomplete="latestAverage">
      </div>

      <div class="form__field" id="latestGWAField" style="display: none;">
          <label for="latestGWA" id="latestGWA-label">
              Latest Grade Weighted Average
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="latestGWA" type="number" name="latestGWA"
              autocomplete="latestGWA">
      </div>

      <div class="form__field">
          <label for="scopeGWA" id="scopeGWA-label">
              Scope of Latest GWA
              <span data-required="true" aria-hidden="true"></span>
              <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">Ex.
                  1st Semester/ 2nd Grading</span>
          </label>
          <input value="" id="scopeGWA" type="text" name="scopeGWA"
              autocomplete="current school" required>
      </div>
  </div>

  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="equivalentGradeField" style="display: none;">
          <label for="equivalentGrade">
              Grade Weighted Average Percentage Equivalent
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="equivalentGrade" type="number" name="equivalentGrade"
              autocomplete="equivalent grade">
      </div>

      <div class="mb-3 form__field" id="ReportCardField">
          <label for="ReportCard">
              Report Card
              <span data-required="true" aria-hidden="true"></span>
              <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF
                  only</span>
          </label>
          <input value="" id="ReportCard" type="file" name="ReportCard"
              autocomplete="report card" required style="padding" accept=".pdf">
      </div>
  </div>

  <h1 style="font-weight: bold;" id="schoolApplicationHeader" style="display: none;">School
      Application</h1>
  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="schoolChoice1Field" style="display: none;">
          <label for="schoolChoice1" id="schoolChoice1-label">
              First Choice School
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="schoolChoice1" name="schoolChoice1"
              autocomplete="schoolChoice1">
      </div>

      <div class="form__field" id="schoolChoice2Field" style="display: none;">
          <label for="schoolChoice2" id="schoolChoice2-label">
              Second Choice School
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="schoolChoice2" name="schoolChoice2"
              autocomplete="schoolChoice2">
      </div>
  </div>

  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="schoolChoice3Field" style="display: none;">
          <label for="schoolChoice3" id="schoolChoice3-label">
              Third Choice School
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="schoolChoice3" name="schoolChoice3"
              autocomplete="schoolChoice3">
      </div>
  </div>

  <h1 id="preferredProgramHeader" style="font-weight: bold;" style="display: none;">Preferred
      Program</h1>

  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="courseChoice1Field" style="display: none;">
          <label for="courseChoice1" id="courseChoice1-label">
              First Choice Degree Program
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="courseChoice1" name="courseChoice1"
              autocomplete="courseChoice1">
      </div>

      <div class="form__field" id="courseChoice2Field" style="display: none;">
          <label for="courseChoice2" id="courseChoice2-label">
              Second Choice Degree Program
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="courseChoice2" name="courseChoice2"
              autocomplete="courseChoice2">
      </div>
  </div>

  <div class="sm:d-grid sm:grid-col-2">
      <div class="form__field" id="courseChoice3Field" style="display: none;">
          <label for="courseChoice3" id="courseChoice3-label">
              Third Choice Degree Program
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" type="text" id="courseChoice3" name="courseChoice3"
              autocomplete="courseChoice3">
      </div>
  </div>

  <div
      class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
      <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
      </button>
      <button type="button" data-action="next">
          Next
      </button>
  </div>
</section>
<!-- / End Step 4 -->
