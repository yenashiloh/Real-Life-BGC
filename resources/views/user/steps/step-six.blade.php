 <!-- Step 5 -->
 <section id="progress-form__panel-6" role="tabpanel" aria-labelledby="progress-form__tab-6"
 tabindex="0" hidden>
 <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
     <div class="form__field ">
         <label for="householdMembers">
             Total Number of Household Members
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="householdMembers" type="number" name="householdMembers"
             autocomplete="householdMembers" required>
     </div>

     <div class="form__field" id="payslipField">
         <label for="payslip">
             Payslip/ Social Case Study Report/ ITR
             <span data-required="true" aria-hidden="true"></span>
             <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF
                 only</span>
         </label>
         <input value="" id="payslip" type="file" name="payslip"
             autocomplete="payslip" required style="padding" accept=".pdf">
     </div>

     <div class="mt-3 form__field">
         <label for="fatherOccupation">
             Father's Occupation
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="fatherOccupation" type="text" name="fatherOccupation"
             autocomplete="fatherOccupation" required>
     </div>

     <div class="mt-3 form__field">
         <label for="fatherIncome">
             Monthly Net Income (take home pay)
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="fatherIncome" type="number" name="fatherIncome"
             autocomplete="fatherIncome" required>
     </div>

     <div class="mt-3 form__field">
         <label for="motherOccupation">
             Mother's Occupation
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="motherOccupation" type="text" name="motherOccupation"
             autocomplete="motherOccupation" required>
     </div>

     <div class="mt-3 form__field">
         <label for="incomeMother">
             Monthly Net Income (take home pay)
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="incomeMother" type="number" name="incomeMother"
             autocomplete="incomeMother" required>
     </div>

     <div class="mt-3 form__field">
         <label for="supportReceived">
             Total Support Received
             <span data-required="true" aria-hidden="true"></span>
         </label>
         <input value="" id="supportReceived" type="text" name="supportReceived"
             autocomplete="supportReceived" required readonly>
     </div>
 </div>

 <div
     class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
     <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
         Previous
     </button>
     <button type="submit" id="submitButton" data-kt-stepper-action="submit">
         Submit
     </button>
 </div>
</section>