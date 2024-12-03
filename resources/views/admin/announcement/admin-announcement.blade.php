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
                            onclick="location.href='{{ route('admin.announcement.add-announcement') }}'"><i
                                class="fas fa-plus"></i> Add
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
                                            <hr>
                                            <p class="card-text announcement-caption mt-2">{!! $announcement->caption !!}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
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
