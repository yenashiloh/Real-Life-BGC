{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Approved Applicants</title>
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
                <h3 class="page-title">Approved Applicants</h3>
            </div>

            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <div class="btn-group">
                                <button type="button" class="btn custom-btn dropdown-toggle btn-hover-primary"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Select Year
                                </button>
                                <div class="dropdown-menu" aria-labelledby="yearDropdownButton">
                                    @foreach ($years as $year)
                                        <a class="dropdown-item dropdown-blue" href="#"
                                            onclick="getDataForYear('{{ $year }}')">{{ $year }}</a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped datatable" style="display: none;">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date Applied</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Incoming Grade/Year Level</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($applicantsData as $applicant)
                                            <tr>
                                                <th scope="row">{{ $count }}</th>
                                                <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('F d, Y') }}
                                                </td>
                                                <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                                <td>{{ $applicant->incoming_grade_year }}</td>
                                                <td>{{ $applicant->current_school }}</td>
                                                <td>
                                                    <span id="status-{{ $applicant->applicant_id }}"
                                                        class="badge badge-success p-2" style="font-weight: normal;">
                                                        {{ $applicant->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="view-button">
                                                        <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}"
                                                            class="btn btn-dark btn-fw p-2">
                                                            View
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @php
                                                $count++;
                                            @endphp
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>

    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
    <script src="../assets-new-admin/js/loader.js"></script>
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

    <!-- endinject -->
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Approved Applicant</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')

    <link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.5.1/css/dataTables.dateTime.min.css">
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
                    <h3 class="fw-bold mb-3">Approved Applicants</h3>
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
                            <a href="#">Approved Applicants</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <label for="min" class="me-2">Minimum date:</label>
                                    <input type="text" id="min" name="min" class="form-control me-2 w-25">

                                    <label for="max" class="me-2">Maximum date:</label>
                                    <input type="text" id="max" name="max" class="form-control w-25">
                                </div>

                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Date Applied</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Incoming Grade/Year Level</th>
                                                <th scope="col">School</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($applicantsData as $applicant)
                                                <tr>
                                                    <th scope="row">{{ $count }}</th>
                                                    <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('F d, Y') }}
                                                    </td>
                                                    <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                                    <td>{{ $applicant->incoming_grade_year }}</td>
                                                    <td>{{ $applicant->current_school }}</td>
                                                    <td>
                                                        <span id="status-{{ $applicant->applicant_id }}"
                                                            class="badge badge-success"
                                                            style="font-weight: normal;">
                                                            {{ $applicant->status }}
                                                        </span>
                                                    </td>
                                                    <td>

                                                        <div class="view-button">
                                                            <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}"
                                                                class="btn btn-view" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="View">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @php
                                                    $count++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.5.1/js/dataTables.dateTime.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="../../../admin-assets/js/approved-applicant.js"></script>
    @include('admin-partials.footer')
