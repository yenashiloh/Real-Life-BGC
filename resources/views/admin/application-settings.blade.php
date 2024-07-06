<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Application Settings</title>
  
    @include('admin-partials.admin-header')
  </head>
  <body>
    @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="page-header">
                <h3 class="page-title">Application Settings</h3>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('application.settings.save') }}">
                            @csrf
                            <div class="form-group">
                              <label for="current_applicants">Current Number of Applicants:</label>
                              <input type="number" class="form-control" id="current_applicants" name="current_applicants" value="{{ $applicantsCount }}"  disabled>
                          </div>
                        <div class="form-group">
                            <label for="max_number">Maximum Number to Accept:</label>
                            <input type="number" class="form-control" id="max_number" name="max_number" value="{{ optional($settings)->max_number }}">
                        </div>
                        <div class="form-group">
                          <label for="start_date">Start Date:</label>
                          <input type="date" class="form-control" id="start_date" name="start_date" value="{{ optional($settings)->start_date }}">
                        </div>
                        <div class="form-group">
                          <label for="start_time">Start Time:</label>
                          <input type="time" class="form-control" id="start_time" name="start_time" value="{{ optional($settings)->start_time }}">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <div class="form-group">
                          <label for="current_status">Current Status:</label>
                          <input type="text" class="form-control" id="current_status_display" name="current_status"  disabled>
                        </div>
                        <div class="form-group">
                          <label for="stop_date">End Date:</label>
                          <input type="date" class="form-control" id="stop_date" name="stop_date" value="{{ optional($settings)->stop_date }}">
                        </div>
                        <div class="form-group">
                          <label for="stop_time">End Time:</label>
                          <input type="time" class="form-control" id="stop_time" name="stop_time" value="{{ optional($settings)->stop_time }}">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- End of Row -->
          
                <!-- Save Settings Button -->
                <div class="row justify-content-center mt-5">
                  <div class="col-md-4">
                    <button type="submit" class="btn custom-btn btn-block">Save Settings</button>
                  </div>
                </div>
              </form>
            </div>
          </div>     

         <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
      <!-- Vendor JS Files -->
  <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets-admin/vendor/php-email-form/validate.js"></script>
  <script src="../assets-admin/tinymce/tinymce.min.js"></script>
 
  <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
  <script src="../assets-admin/vendor/quill/quill.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Template Main JS File -->
  <script src="../assets-admin/js/main.js"></script>
  
    
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
    var startDateInput = document.getElementById('start_date');
    var stopDateInput = document.getElementById('stop_date');
    var startTimeInput = document.getElementById('start_time');
    var stopTimeInput = document.getElementById('stop_time');

    // Set the minimum value for the start date to today's date
    var now = new Date().toLocaleString("en-US", { timeZone: "Asia/Manila" });
    now = new Date(now);
    var today = now.toISOString().split('T')[0];
    startDateInput.setAttribute('min', today);

    // Set the minimum value for the stop date based on the selected start date
    startDateInput.addEventListener('change', function() {
        stopDateInput.setAttribute('min', startDateInput.value);
    });

    // Set the minimum value for the stop time based on the selected start time
    startTimeInput.addEventListener('change', function() {
        stopTimeInput.setAttribute('min', startTimeInput.value);
    });

    // Initialize the stop date min value if start date is already set
    if (startDateInput.value) {
        stopDateInput.setAttribute('min', startDateInput.value);
    }

    // Initialize the stop time min value if start time is already set
    if (startTimeInput.value) {
        stopTimeInput.setAttribute('min', startTimeInput.value);
    }
});

function updateCurrentStatus() {
    // Get the current time in Asia/Manila timezone
    var now = new Date().toLocaleString("en-US", { timeZone: "Asia/Manila" });
    now = new Date(now);

    // Check if settings and applicants count are available
    var settings = {
        start_date: '{{ $settings->start_date ?? '' }}',
        start_time: '{{ $settings->start_time ?? '' }}',
        stop_date: '{{ $settings->stop_date ?? '' }}',
        stop_time: '{{ $settings->stop_time ?? '' }}',
        max_number: {{ $settings->max_number ?? 0 }}, 
    };
    var currentApplicants = {{ $applicantsCount ?? 0 }}; 

    if (settings.start_date && settings.start_time && settings.stop_date && settings.stop_time && currentApplicants !== null && settings.max_number !== null) {
        // Combine the start and stop dates with daily times
        var startDateTime = parseDateTime(settings.start_date, settings.start_time);
        var stopDateTime = parseDateTime(settings.stop_date, settings.stop_time);

        // Check if current date is within the start and stop dates
        var withinDateRange = now >= startDateTime.dateOnly && now <= stopDateTime.dateOnly;

        // If within the date range, check the time range for today
        var applicationOpen = withinDateRange && isWithinDailyTimeRange(now, settings.start_time, settings.stop_time);

        // Check if current number of applicants equals the maximum number
        var maximumReached = currentApplicants >= settings.max_number;

        // Set the value of the input field based on the current status
        document.getElementById('current_status_display').value = (applicationOpen && !maximumReached) ? 'Opened' : 'Closed';
    } else {
        // Default status when settings or applicants count are not fully available
        document.getElementById('current_status_display').value = 'Closed';
    }
}


// Function to parse date and time strings and return a Date object in Asia/Manila timezone
function parseDateTime(dateString, timeString) {
    var dateTimeString = dateString + 'T' + timeString + 'Z';
    var date = new Date(dateTimeString);
    var dateOnly = new Date(date.toLocaleString("en-US", { timeZone: "Asia/Manila" }));
    return { dateTime: date, dateOnly: new Date(dateOnly.getFullYear(), dateOnly.getMonth(), dateOnly.getDate()) };
}

// Function to check if the current time is within the daily time range
function isWithinDailyTimeRange(now, startTime, stopTime) {
    var nowTimeString = now.toTimeString().split(' ')[0];
    return nowTimeString >= startTime && nowTimeString <= stopTime;
}

// Update the current status initially when the page loads
updateCurrentStatus();

// Update the current status every second to reflect real-time changes
setInterval(updateCurrentStatus, 1000);

</script>

</body>
</html>
