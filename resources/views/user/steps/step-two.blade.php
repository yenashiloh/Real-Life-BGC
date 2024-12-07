<!-- Step 2 -->
<section id="progress-form__panel-2" role="tabpanel" aria-labelledby="progress-form__tab-2" tabindex="0" hidden>
    <div class="sm:d-grid sm:grid-col-2 sm:mt-3">

        <div class="form__field">
            <label for="attend-orientation">
                Did you attend the orientation?
                <span data-required="true" aria-hidden="true"></span>
            </label>
            <select id="attend-orientation" name="attend_orientation" required>
                <option value="">Select an option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>

        <div class="form__field">
            <label for="orientation-date">
                What was the date of the orientation?
                <span data-required="true" aria-hidden="true"></span>
            </label>
            <input value="" id="orientation-date" type="date" name="orientation_date"
                autocomplete="orientation_date" required max="{{ \Carbon\Carbon::now()->toDateString() }}">
        </div>

        <div class="mt-3 form__field">
            <label for="orientation-proof">
                Upload a screenshot in jpg/pdf format as proof of attendance
                <span data-required="true" aria-hidden="true"></span>
            </label>
            <input id="orientation-proof" type="file" name="orientation_proof" accept="image/*, application/pdf"
                required>
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
