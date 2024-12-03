 <!-- Step 7 -->
 <section id="progress-form__panel-7" role="tabpanel" aria-labelledby="progress-form__tab-7" tabindex="0" hidden>
     <div class="sm:d-grid sm:grid-col-2 sm:mt-3">
         <div class="form__field" id="applicationFormField">
             <label for="applicationForm">
                 Upload Application Form
                 <span data-required="true" aria-hidden="true"></span>
                 <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF
                     only</span>
             </label>
             <input value="" id="applicationForm" type="file" name="applicationForm"
                 autocomplete="applicationForm" required style="padding" accept=".pdf">
         </div>

         <div class="form__field" id="characterReferencessField">
             <label for="characterReferences">
                 Upload 2 Character References
                 <span data-required="true" aria-hidden="true"></span>
                 <span style="margin-left: 15px; color: red; font-size: 10px; font-weight: normal;">PDF
                     only</span>
             </label>
             <input value="" id="characterReferences" type="file" name="characterReferences"
                 autocomplete="characterReferences" required style="padding" accept=".pdf">
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
