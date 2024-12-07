  <!-- Step 2 -->
  <section id="progress-form__panel-3" role="tabpanel" aria-labelledby="progress-form__tab-3"
  tabindex="0" hidden>
  <div class="sm:d-grid sm:grid-col-2 sm:mt-3">

      <div class="form__field">
          <label for="email">
              Email
              <span data-required="true" aria-hidden="true"></span>
          </label>
          <input value="" id="email" type="email" name="email" autocomplete="email"
              required>
      </div>

      <div class="form__field">
          <label for="password">
              Password <span data-required="true" aria-hidden="true"></span>
          </label>
          <div class="input-group">
              <input value="" id="passwordField" type="password" name="password"
                  autocomplete="password" required>
              <span class="input-group-text">
                  <i class="fas fa-eye" id="togglePassword" style="cursor: pointer;"></i>
              </span>
          </div>
      </div>

      <div class="mt-3 form__field">
          <label for="confirm_password">
              Confirm Password <span data-required="true" aria-hidden="true"></span>
          </label>
          <div class="input-group">
              <input value="" id="confirmPasswordField" type="password"
                  name="confirm_password" autocomplete="contact" required>
              <span class="input-group-text">
                  <i class="fas fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
              </span>
          </div>
          <span id="passwordMatchError" class="error"></span>
      </div>
  </div>

  <div
      class="d-flex flex-column-reverse sm:flex-row align-items-center justify-center sm:justify-end mt-4 sm:mt-5">
      <button type="button" class="mt-1 sm:mt-0 button--simple" data-action="prev">
          Previous
      </button>
      <button type="button"  id="nextButton" data-action="next">
          Next
      </button>
  </div>
</section>
<!-- / End Step 2 -->
