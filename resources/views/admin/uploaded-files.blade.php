<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Announcement</title>

    @include('admin-partials.admin-header')
    <style>
        .table-responsive td {
            max-width: 750px;
            white-space: normal;
            margin-bottom: 10px;
            padding-bottom: 10px;
        }

        .dropdown-item:hover {
            background-color: #007bff;
            color: #fff;
        }

        .text-gray {
            color: gray;
            font-size: 14px;

        }

        .published-unpublished {
            color: gray;
            font-size: 14px;
        }
    </style>
</head>

<body>
    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Uploaded Files</h3>
            </div>
            <div class="row">

                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle btn-hover-primary"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Export Record
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item "
                                        href="{{ route('export.applicants', ['format' => 'csv']) }}">CSV</a>
                                    <a class="dropdown-item "
                                        href="{{ route('export.applicants', ['format' => 'excel']) }}">Excel</a>
                                </div>
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

                    <!-- Template Main JS File -->
                    <script src="../assets-admin/js/main.js"></script>
</body>

</html>
