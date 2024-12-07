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
                                            <button type="submit" class="btn btn-success mt-3">Save
                                                Settings</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin-partials.footer')
    <script src="../admin-assets/js/create-account.js"></script>
    <script src="../../../admin-assets/js/application-settings.js"></script>
