{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Applicants</title>
    @include('admin-partials.admin-header')

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<style>

</style>

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
            <div class="page-header">
                <h3 class="page-title">All Applicants </h3>
                <div class="d-flex justify-content-end position-relative">
                    <button class="btn btn-export btn-sm" type="button" onclick="toggleDropdown()">
                        <i class="bi bi-download"></i> Export
                    </button>
                    <div id="dropdownMenu" class="dropdown-content">
                        <a class="dropdown-item dropdown-blue"
                            href="{{ route('export.applicants', ['format' => 'csv']) }}">
                            <i class="icon-export far fa-file"></i> CSV
                        </a>
                        <a class="dropdown-item dropdown-blue"
                            href="{{ route('export.applicants', ['format' => 'excel']) }}">
                            <i class="icon-export far fa-file-excel"></i> Excel
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">

                    <div class="card">
                        <div class="card-body">
                            <div class="loading"></div>
                            <!-- Table with stripped rows -->
                            <div class="table-responsive">
                                <table class="table table-striped datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Date Applied</th>
                                            <th scope="col">Full Name</th>
                                            <th scope="col">Incoming Year Level</th>
                                            <th scope="col">School</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="applicant-table">
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($applicantsData as $applicant)
                                            <tr>
                                                <th scope="row">{{ $count }}</th>
                                                <td>{{ date('F d, Y', strtotime($applicant->created_at)) }}</td>
                                                <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                                <td>{{ $applicant->incoming_grade_year }}</td>
                                                <td>{{ $applicant->current_school }}</td>
                                                <td>
                                                    <span id="status-{{ $applicant->applicant_id }}"
                                                        class="badge
                                                            @if ($applicant->status === 'Sent') badge-primary
                                                            @elseif($applicant->status === 'Under Review') badge-secondary
                                                            @elseif($applicant->status === 'Shortlisted') badge-warning
                                                            @elseif($applicant->status === 'For Interview') badge-dark
                                                            @elseif($applicant->status === 'For House Visitation') badge-success @endif
                                                            p-2"
                                                        style="font-weight: normal; font-weight:bold;">
                                                        {{ $applicant->status }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center ">
                                                        <div class="dropdown">
                                                            <button class="btn btn-status p-2" type="button"
                                                                id="dropdownMenuButton{{ $applicant->applicant_id }}"
                                                                data-bs-toggle="dropdown" aria-expanded="false"
                                                                style="width: 40px; border: none;">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-bottom"
                                                                aria-labelledby="dropdownMenuButton"
                                                                style="width: auto;">
                                                                @if ($applicant->status === 'Sent')
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Under Review"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}">
                                                                            Under Review
                                                                        </a>
                                                                    </li>
                                                                @elseif($applicant->status === 'Under Review')
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Shortlisted"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa fa-check"
                                                                                aria-hidden="true"></i>
                                                                            Approve for Shortlisted
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Declined"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa-solid fa-x"
                                                                                aria-hidden="true"></i>
                                                                            Decline
                                                                        </a>
                                                                    </li>
                                                                @elseif($applicant->status === 'Shortlisted')
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="For Interview"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa fa-check"
                                                                                aria-hidden="true"></i>
                                                                            Approve for Interview
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Declined"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa-solid fa-x"
                                                                                aria-hidden="true"></i>
                                                                            Decline
                                                                        </a>
                                                                    </li>
                                                                @elseif($applicant->status === 'For Interview')
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#"
                                                                            data-action="For House Visitation"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa fa-check"
                                                                                aria-hidden="true"></i>
                                                                            Approve for House Visitation
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Declined"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa-solid fa-x"
                                                                                aria-hidden="true"></i>
                                                                            Decline
                                                                        </a>
                                                                    </li>
                                                                @elseif($applicant->status === 'For House Visitation')
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Approved"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa fa-check"
                                                                                aria-hidden="true"></i>
                                                                            Approve Scholarship
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="dropdown-item dropdown-blue"
                                                                            href="#" data-action="Declined"
                                                                            data-applicant-id="{{ $applicant->applicant_id }}"
                                                                            data-route="{{ route('update.status') }}"><i
                                                                                class="fa-solid fa-x"
                                                                                aria-hidden="true"></i>
                                                                            Decline
                                                                        </a>
                                                                    </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                        <div class="view-button ml-2" style="width: 40px;">
                                                            <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}"
                                                                class="btn btn-view p-2">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </div>
                                                    </div>

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

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <script src="../assets-new-admin/js/off-canvas.js"></script>
        <script src="../assets-new-admin/js/misc.js"></script>
        <script src="../assets-new-admin/js/loading.js"></script>
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- endinject -->
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>All Applicants</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')

</head>
<style>
    .dropdown-item.disabled {
        opacity: 0.5;
        pointer-events: none;
    }
</style>

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
                    <h3 class="fw-bold mb-3">Applicants</h3>
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
                            <a href="#">All Applicants</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="connectivity-message-container"></div>
                        <div id="error-message-container"></div>
                        <div id="success-message-container"></div>
                        <div class="card">
                            {{-- <div class="card-header">
                                <h4 class="card-title">New Applicants</h4>
                            </div> --}}

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="basic-datatables" class="display table table-striped table-hover">
                                        <div class="loading"></div>
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Date Applied</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Incoming Year Level</th>
                                                <th scope="col">School</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody id="applicant-table">
                                            @php
                                                $count = 1;
                                            @endphp
                                            @foreach ($applicantsData as $applicant)
                                                <tr>
                                                    <th scope="row">{{ $count }}</th>
                                                    <td>{{ date('F d, Y', strtotime($applicant->created_at)) }}</td>
                                                    <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                                    <td>{{ $applicant->incoming_grade_year }}</td>
                                                    <td>{{ $applicant->current_school }}</td>
                                                    <td>
                                                        <span id="status-{{ $applicant->applicant_id }}"
                                                            class="badge
                                                            @if ($applicant->status === 'Sent') badge-primary
                                                            @elseif($applicant->status === 'Under Review') badge-secondary
                                                            @elseif($applicant->status === 'Shortlisted') badge-warning
                                                            @elseif($applicant->status === 'For Interview') badge-primary
                                                            @elseif($applicant->status === 'For House Visitation') badge-success @endif
                                                            "
                                                            style="font-weight: normal; ">
                                                            {{ $applicant->status }}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center ">
                                                            <div class="dropdown">
                                                                <button class="btn btn-status p-2" type="button"
                                                                    id="dropdownMenuButton{{ $applicant->applicant_id }}"
                                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                                    style="width: 40px; border: none;"
                                                                    data-bs-placement="top" title="Change Status">
                                                                    <i class="fas fa-edit"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-bottom"
                                                                    aria-labelledby="dropdownMenuButton"
                                                                    style="width: auto;">
                                                                    @if ($applicant->status === 'Sent')
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#"
                                                                                data-action="Under Review"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}">
                                                                                Under Review
                                                                            </a>
                                                                        </li>
                                                                    @elseif($applicant->status === 'Under Review')
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Shortlisted"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                                Approve for Shortlisted
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Declined"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fas fa-times"
                                                                                    aria-hidden="true"></i>
                                                                                Decline
                                                                            </a>
                                                                        </li>
                                                                    @elseif($applicant->status === 'Shortlisted')
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#"
                                                                                data-action="For Interview"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                                Approve for Interview
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Declined"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fas fa-times"
                                                                                    aria-hidden="true"></i>
                                                                                Decline
                                                                            </a>
                                                                        </li>
                                                                    @elseif($applicant->status === 'For Interview')
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#"
                                                                                data-action="For House Visitation"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                                Approve for House Visitation
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Declined"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fas fa-times"
                                                                                    aria-hidden="true"></i>
                                                                                Decline
                                                                            </a>
                                                                        </li>
                                                                    @elseif($applicant->status === 'For House Visitation')
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Approved"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fa fa-check"
                                                                                    aria-hidden="true"></i>
                                                                                Approve Scholarship
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a class="dropdown-item dropdown-blue"
                                                                                href="#" data-action="Declined"
                                                                                data-applicant-id="{{ $applicant->applicant_id }}"
                                                                                data-route="{{ route('update.status') }}"><i
                                                                                    class="fas fa-times"
                                                                                    aria-hidden="true"></i>
                                                                                Decline
                                                                            </a>
                                                                        </li>
                                                                    @endif
                                                                </ul>
                                                            </div>
                                                            <div class="view-button ml-2" >
                                                                <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}"
                                                                    class="btn btn-view p-2" data-bs-toggle="tooltip"
                                                                    data-bs-placement="top" title="View">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                            </div>
                                                        </div>
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

            @include('admin-partials.footer')
            <script src="../../../admin-assets/js/applicant-status.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                const routes = {
                    updateStatus: "{{ route('update.status') }}"
                };
            </script>
