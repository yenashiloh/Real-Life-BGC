{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets-new-admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/css/vendor.bundle.base.css">
    <link href="../assets-admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets-new-admin/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="../assets-new-admin/css/style.css">
    <link rel="shortcut icon" href="../assets-admin/img/RLlogo1.png" />
</head>

<body>

    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])
    
    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <!-- partial -->
    <div class="main-panel">

        <div class="content-wrapper">
            <!-- Quick Action Toolbar Starts-->
            <div class="row quick-action-toolbar">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Quick Actions</h5>
                     
                        </div>
                        <div class="d-md-flex row m-0 quick-action-btns" role="group"
                            aria-label="Quick action buttons">
                            <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                <a href="{{ route('admin.announcement.add-announcement') }}" class="btn px-0"> <i
                                        class="icon-screen-tablet mr-2"></i> Add Announcement</a>
                            </div>
                            <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                <a href="{{ route('admin.registration') }}" class="btn px-0"><i
                                        class="icon-user-follow mr-2"></i>Create Account</a>
                            </div>
                            <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                <button type="button" class="btn px-0"><i
                                        class="icon-envelope-open menu-icon mr-2"></i>Email</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div id="report-container" class="row">
                                <div class="col-md-12">
                                    <div class="d-sm-flex align-items-baseline report-summary-header">
                                        <h5 class="font-weight-semibold">Report Summary</h5>
                                        <div class="dropdown ml-auto mb-2">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false" style="color:rgb(3, 3, 3);">
                                                Filter on Reports
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @foreach ($years as $year)
                                                    <a class="dropdown-item filter-year" href="#"
                                                        data-value="{{ $year }}">{{ $year }}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row report-inner-cards-wrapper">
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF APPLICANTS</span>
                                        <h4 id="totalApplicants">{{ $totalApplicants }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-primary">
                                        <i class="icon-user"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF SHORTLISTED</span>
                                        <h4 id="totalShortlisted">{{ $totalShortlisted }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-warning">
                                        <i class="icon-notebook"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF INTERVIEW</span>
                                        <h4 id="totalForInterview">{{ $totalForInterview }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-dark">
                                        <i class="icon-people"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="row report-inner-cards-wrapper">
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF HOUSE VISITATION</span>
                                        <h4 id="totalHouseVisitation">{{ $totalHouseVisitation }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-info">
                                        <i class="icon-home"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF DECLINED</span>
                                        <h4 id="totalDeclined">{{ $totalDeclined }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-danger">
                                        <i class="icon-user-unfollow"></i>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl report-inner-card">
                                    <div class="inner-card-text">
                                        <span class="report-title">TOTAL OF APPROVED</span>
                                        <h4 id="totalApproved">{{ $totalApproved }}</h4>
                                    </div>
                                    <div class="inner-card-icon bg-success">
                                        <i class="icon-user-following"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <div class="row income-expense-summary-chart-text">
                                <div class="col-xl-5">
                                    <h3>Grade Year Level Summary</h3>
                                </div>
                                <div class="col-md-6 col-xl-4 d-flex align-items-center">
                                  
                                </div>
                            </div>
                            <div class="row income-expense-summary-chart mt-3">
                                <div class="col-md-12">
                                    <canvas id="barChart" style="max-height: 400px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets-new-admin/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets-new-admin/vendors/moment/moment.min.js"></script>
    <script src="../assets-new-admin/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../assets-new-admin/vendors/chartist/chartist.min.js"></script>
    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
    <script src="../assets-new-admin/js/dashboard.js"></script>
    <script src="../assets-new-admin/js/loader.js"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        .daterangepicker td.active, .daterangepicker td.active:hover {
            background-color: #ff6600;
        }
    </style>
    @include('admin-partials.link')
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
                    <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                        <div>
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">All reports are displayed in this dashboard</h6>
                        </div>
                        <div class="ms-md-auto py-2 py-md-0">
                            <div id="reportrange" class="btn btn-light border">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span></span> <i class="fa fa-caret-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total Applicants</p>
                                                <h4 class="card-title">{{ $totalApplicants }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-info bubble-shadow-small">
                                                <i class="fas fa-book"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total Shortlisted</p>
                                                <h4 class="card-title">{{ $totalShortlisted }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-primary bubble-shadow-small">
                                                <i class="fas fa-file-alt"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total for Interview</p>
                                                <h4 class="card-title">{{ $totalForInterview }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Second row (if you need the fourth column below) -->
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-warning bubble-shadow-small">
                                                <i class="fas fa-home"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total for House Visitation</p>
                                                <h4 class="card-title">{{ $totalHouseVisitation }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                                <i class="fas fa-check-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total Approved</p>
                                                <h4 class="card-title">{{ $totalApproved }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div class="card card-stats card-round">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-icon">
                                            <div class="icon-big text-center icon-danger bubble-shadow-small">
                                                <i class="fas fa-times-circle"></i>
                                            </div>
                                        </div>
                                        <div class="col col-stats ms-3 ms-sm-0">
                                            <div class="numbers">
                                                <p class="card-category">Total Declined</p>
                                                <h4 class="card-title">{{ $totalDeclined }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-round">
                                <div class="card-header">
                                    <div class="card-head-row">
                                        <div class="card-title">Grade Year Level Summary</div>
                                   
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container" style="min-height: 375px">
                                        <canvas id="barChart" style="max-height: 400px;"></canvas>
                                    </div>
                                    <div id="myChartLegend"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Custom template -->
    </div>
    <!--   Core JS Files   -->
   @include('admin-partials.footer')
   <script src="../admin-assets/js/dashboard.js"></script>

   <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
   <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
</body>

</html>
