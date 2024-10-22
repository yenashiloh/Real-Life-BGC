{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
    </style>
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
                <h3 class="page-title">Announcement </h3>
            </div>
            <div class="row">

                <div class="col-lg-12">
                    <button type="button" class="btn custom-btn btn-fw" style="font-size: 12px; margin-bottom: 20px;"
                        onclick="location.href='{{ route('admin.announcement.add-announcement') }}'">Create</button>
                    @foreach ($announcements as $announcement)
                        <div class="col-md-12 mb-4">
                            <div class="card position-relative">
                                <div class="position-absolute top-4 end-0 margin-right-6 btn-group dropleft">
                                    <i class="bi bi-three-dots"
                                        style="cursor: pointer; margin-right: 10px; margin-top: 10px;"
                                        onclick="toggleDropdownMenu('dropdownMenu{{ $announcement->id }}')"></i>
                                    <span style="position: absolute; left: -98px; top: 10px;">
                                        @if ($announcement->published)
                                            <span class="published-unpublished ">Published</span>
                                        @else
                                            <span class="published-unpublished">Unpublished</span>
                                        @endif
                                    </span>
                                    <div id="dropdownMenu{{ $announcement->id }}" class="dropdown-menu drop-left"
                                        style="display: none; border: 1px solid black;">
                                        <a class="dropdown-item"
                                            href="{{ route('admin.announcement.edit-announcement', ['id' => $announcement->id]) }}"><i
                                                class="fas fa-edit"></i> Edit</a>
                                        <form action="{{ route('delete.announcement', ['id' => $announcement->id]) }}"
                                            method="post" id="deleteForm_{{ $announcement->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" onclick="confirmDelete('{{ $announcement->id }}')"
                                                class="dropdown-item">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </button>

                                        </form>
                                        @if ($announcement->published)
                                            <a class="dropdown-item"
                                                href="{{ route('admin.announcement.unpublish', ['id' => $announcement->id]) }}"><i
                                                    class="fa fa-eye-slash" aria-hidden="true"></i> Unpublish</a>
                                        @else
                                            <a class="dropdown-item"
                                                href="{{ route('admin.announcement.publish', ['id' => $announcement->id]) }}"><i
                                                    class="fa fa-eye" aria-hidden="true"></i> Publish</a>
                                        @endif
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title mb-0">{{ $announcement->title }}</h5>
                                    <span class="widget-49-meeting-time text-gray">
                                        {{ \Carbon\Carbon::parse($announcement->created_at)->timezone('Asia/Manila')->isoFormat('MMMM D, YYYY, h:mm A') }}
                                    </span>''
                                    <p class="card-text announcement-caption mt-2">{!! $announcement->caption !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
    <script src="../assets-new-admin/js/loader.js"></script>

    <!-- Template Main JS File -->
    <script src="../assets-admin/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Once deleted, you will not be able to recover.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'The announcement has been deleted.',
                        icon: 'success',
                        showConfirmButton: true
                    }).then(() => {
                        document.getElementById('deleteForm_' + id).submit();
                    });
                }
            });
        }

        /*************************/
        function toggleDropdownMenu(id) {
            var dropdownMenu = document.getElementById(id);
            if (dropdownMenu.style.display === "none") {
                dropdownMenu.style.display = "block";
            } else {
                dropdownMenu.style.display = "none";
            }
        }
        /********************************/
        setTimeout(function() {
            $('#successAlert').alert('close');
        }, 3000);
    </script>
</body>

</html> --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Announcement</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">

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
                    <h3 class="fw-bold mb-3">Announcement</h3>
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
                            <a href="{{ route('admin.announcement.admin-announcement') }}">Announcement</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-success mb-3"
                            onclick="location.href='{{ route('admin.announcement.add-announcement') }}'">Add
                            Announcement</button>
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show mt-3 alert-message"
                                role="alert" style="text-align: center; display: none;">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show mt-3 alert-message"
                                style="display: none;">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if ($announcements->isEmpty())
                            <div class="col-md-12 mb-4">
                                <div class="alert alert-info text-center" role="alert">
                                    No announcements available.
                                </div>
                            </div>
                        @else
                            @foreach ($announcements as $announcement)
                                <div id="announcement-{{ $announcement->id }}" class="col-md-12 mb-4">
                                    <div class="card position-relative">
                                        <div class="position-absolute top-0 end-0 mt-2 me-2 d-flex align-items-center">
                                            <span class="me-2 text-muted" style="font-size: 0.9rem;">
                                                {{ $announcement->published ? 'Published' : 'Unpublished' }}
                                            </span>
                                            <div class="dropdown">
                                                <button class="btn btn-link p-2" type="button"
                                                    id="dropdownMenuButton{{ $announcement->id }}"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi bi-three-dots"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="dropdownMenuButton{{ $announcement->id }}">
                                                    <li><a class="dropdown-item"
                                                            href="{{ route('admin.announcement.edit-announcement', ['id' => $announcement->id]) }}"><i
                                                                class="fas fa-edit"></i> Edit</a></li>
                                                    <li>
                                                        <button type="button"
                                                            onclick="confirmDelete('{{ $announcement->id }}')"
                                                            class="dropdown-item">
                                                            <i class="fas fa-trash-alt"></i> Delete
                                                        </button>
                                                    </li>
                                                    <li>
                                                        @if ($announcement->published)
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.announcement.unpublish', ['id' => $announcement->id]) }}"><i
                                                                    class="fa fa-eye-slash" aria-hidden="true"></i>
                                                                Unpublish</a>
                                                        @else
                                                            <a class="dropdown-item"
                                                                href="{{ route('admin.announcement.publish', ['id' => $announcement->id]) }}"><i
                                                                    class="fa fa-eye" aria-hidden="true"></i>
                                                                Publish</a>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="card-title mb-0">{{ $announcement->title }}</h6>
                                            <span class="widget-49-meeting-time text-gray">
                                                {{ \Carbon\Carbon::parse($announcement->created_at)->timezone('Asia/Manila')->isoFormat('MMMM D, YYYY, h:mm A') }}
                                            </span>
                                            <p class="card-text announcement-caption mt-2">{!! $announcement->caption !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>
                </div>
                @include('admin-partials.footer')
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
                <!-- Bootstrap JS -->
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <script>
                    function confirmDelete(id) {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'Once deleted, you will not be able to recover.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/admin/announcement/delete/' + id,
                                    type: 'DELETE',
                                    data: {
                                        "_token": "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        if (response.success) {
                                            $('#announcement-' + id).remove();

                                            Swal.fire({
                                                title: 'Deleted!',
                                                text: 'The announcement has been deleted.',
                                                icon: 'success',
                                                showConfirmButton: true
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Error!',
                                                text: 'Failed to delete the announcement.',
                                                icon: 'error',
                                                showConfirmButton: true
                                            });
                                        }
                                    },
                                    error: function() {
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'An error occurred while deleting the announcement.',
                                            icon: 'error',
                                            showConfirmButton: true
                                        });
                                    }
                                });
                            }
                        });
                    }

                    function toggleDropdownMenu(id) {
                        var dropdownMenu = document.getElementById(id);
                        if (dropdownMenu.style.display === "none") {
                            dropdownMenu.style.display = "block";
                        } else {
                            dropdownMenu.style.display = "none";
                        }
                    }

                    setTimeout(function() {
                        $('#successAlert').alert('close');
                    }, 3000);
                </script>
