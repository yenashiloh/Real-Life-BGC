{{-- <!DOCTYPE html>
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
    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])
    <!-- partial -->

    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Application Settings</h3>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('application.settings.save') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6"> --}}
{{-- <div class="form-group">
                                            <label for="current_applicants">Current Number of Applicants:</label>
                                            <input type="number" class="form-control" id="current_applicants"
                                                name="current_applicants" value="{{ $applicantsCount }}" disabled>
                                        </div> --}}
{{-- <div class="form-group">
                                            <label for="current_status">Current Status:</label>
                                            <input type="text" class="form-control" id="current_status_display"
                                                name="current_status" disabled>
                                        </div>

                                        <div class="form-group">
                                            <label for="start_date">Start Date:</label>
                                            <input type="date" class="form-control" id="start_date" name="start_date"
                                                value="{{ optional($settings)->start_date }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="stop_date">End Date:</label>
                                            <input type="date" class="form-control" id="stop_date" name="stop_date"
                                                value="{{ optional($settings)->stop_date }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="max_number">Maximum Number to Accept:</label>
                                            <input type="number" class="form-control" id="max_number" name="max_number"
                                                value="{{ optional($settings)->max_number }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="start_time">Start Time (Daily):</label>
                                            <input type="time" class="form-control" id="start_time" name="start_time"
                                                value="{{ optional($settings)->start_time }}">
                                        </div>

                                        <div class="form-group">
                                            <label for="stop_time">End Time (Daily):</label>
                                            <input type="time" class="form-control" id="stop_time" name="stop_time"
                                                value="{{ optional($settings)->stop_time }}">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3  custom-btn">Save Settings</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Row -->

                <div id="application-settings" data-start-date="{{ optional($settings)->start_date }}"
                    data-start-time="{{ optional($settings)->start_time }}"
                    data-stop-date="{{ optional($settings)->stop_date }}"
                    data-stop-time="{{ optional($settings)->stop_time }}"
                    data-max-number="{{ optional($settings)->max_number }}"
                    data-current-applicants="{{ $applicantsCount }}">
                </div>
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
        <script src="../assets-new-admin/js/loader.js"></script>
        <script src="../assets-new-admin/js/application-settings.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Application Settings</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div id="loading-spinner" class="loading-spinner">
        <div class="loading-content">
            <img src="../admin-assets/img/RLlogo.png" alt="Logo" class="loading-logo" id="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('admin-partials.sidebar')

        <div class="main-panel">
            @include('admin-partials.header')
        </div>

        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Application Settings</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>

                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.application-settings') }}">Application Settings</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form method="POST" action="{{ route('application.settings.save') }}">
                                    @csrf
                                    <p class="fw-bold">
                                        These settings control when the application process opens and the number of
                                        applicants that can be accepted.
                                    </p>

                                    <!-- Start of form inputs -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="current_applicants">Current Number of Applicants:</label>
                                                <input type="number" class="form-control" id="current_applicants"
                                                    name="current_applicants" value="{{ $applicantsCount }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="max_number">Maximum Number to Accept:</label>
                                                <input type="number" class="form-control" id="max_number"
                                                    name="max_number" value="{{ optional($settings)->max_number }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row for Start Date and End Date -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_date">Start Date:</label>
                                                <input type="date" class="form-control" id="start_date"
                                                    name="start_date" value="{{ optional($settings)->start_date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stop_date">End Date:</label>
                                                <input type="date" class="form-control" id="stop_date"
                                                    name="stop_date" value="{{ optional($settings)->stop_date }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row for Start Time and End Time -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="start_time">Start Time (Daily):</label>
                                                <input type="time" class="form-control" id="start_time"
                                                    name="start_time" value="{{ optional($settings)->start_time }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="stop_time">End Time (Daily):</label>
                                                <input type="time" class="form-control" id="stop_time"
                                                    name="stop_time" value="{{ optional($settings)->stop_time }}">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Submit button aligned with the form -->
                                    <div class="row">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-success w-100 mt-3">Save
                                                Settings</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin-partials.footer')
                <script src="../admin-assets/js/create-account.js"></script>
                <script src="../../../admin-assets/js/application-settings.js"></script>
