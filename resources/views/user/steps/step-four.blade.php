 <!-- step 4Personal information-->
 <section id="progress-form__panel-4" role="tabpanel" aria-labelledby="progress-form__tab-4" tabindex="0" hidden>
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
             <input value="" id="birthdate" type="date" name="birthdate" autocomplete="birthdate" required
                 max="{{ \Carbon\Carbon::now()->toDateString() }}">
         </div>

         <div class="mt-3 form__field">
             <label for="house-number">
                 House Number
                 <span data-required="true" aria-hidden="true"></span>
             </label>
             <input value="" id="houseNumber" type="text" name="houseNumber" autocomplete="houseNumber"
                 required>
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
             <input value="" id="municipality" type="text" name="municipality" autocomplete="municipality"
                 required>
         </div>
     </div>

     <div class="sm:d-grid sm:grid-col-12 sm:mt-3">
         <div class="form__field">
             <label for="mapAddress">
                 Upload a Google Maps screenshot in jpg/pdf format showing the route from Every Nation BGC or Market
                 Market to your location
                 <span data-required="true" aria-hidden="true"></span>
             </label>
             <input value="" id="mapAddress" type="file" name="mapAddress" autocomplete="map address" required
                 style="padding" accept=".jpeg, .jpg, .png, .pdf">
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
 <!-- Step 4-->
