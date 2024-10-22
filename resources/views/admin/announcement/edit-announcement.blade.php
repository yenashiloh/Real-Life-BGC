{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Edit Announcement</title>

    @include('admin-partials.admin-header')
</head>

<body>
    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>
    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Edit Announcement</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../announcement/admin-announcement">Announcement</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Announcement</li>
                    </ol>
                </nav>
            </div>

            <form method="POST" action="{{ route('admin.update-announcement', ['id' => $announcement->id]) }}">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @if (session('success'))
                                    <div class="alert alert-success mt-3" role="alert" style="text-align: center">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        @foreach ($errors->all() as $error)
                                            {{ $error }}
                                        @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <h4>Title</h4>
                                    <input type="text" class="form-control" id="announcement_title"
                                        name="announcement_title" value="{{ $announcement->title }}">
                                </div>
                                <br>
                                <h4>Content</h4>
                                <textarea class="tinymce-editor" name="announcement_caption">{{ $announcement->caption }}</textarea>
                                <div class="text-center mt-3">
                                    <button class="btn custom-btn" style="width: 200px;" type="submit">Save
                                        Changes</button>
                                </div>
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
                <script src="../assets-admin/js/main.js"></script> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Edit Announcement</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        .form-control,
        #editor {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        #editor {
            height: 200px;
        }

        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
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
                    <h3 class="fw-bold mb-3">Add Announcement</h3>
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
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.announcement.add-announcement') }}">Edit Announcement</a>
                        </li>
                    </ul>
                </div>
                <form id="announcementForm" method="POST"
                    action="{{ route('admin.update-announcement', ['id' => $announcement->id]) }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    @if (session('success'))
                                        <div class="alert alert-success mt-3" role="alert" style="text-align: center">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if ($errors->any())
                                        <div class="alert alert-danger mt-3">
                                            @foreach ($errors->all() as $error)
                                                <div>{{ $error }}</div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="form-group">
                                        <label for="announcement_title">Title</label>
                                        <input type="text" class="form-control" id="announcement_title"
                                            name="announcement_title" value="{{ $announcement->title }}">
                                        <div id="titleError" class="error-message"></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="editor">Content</label>
                                        <div id="editor">{{ strip_tags($announcement->caption) }}</div>
                                        <div id="contentError" class="error-message"></div>
                                    </div>

                                    <input type="hidden" name="announcement_caption" id="announcement_caption">

                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="submit" class="btn btn-success">Save
                                                    Announcement</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        @include('admin-partials.footer')
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <!-- Include the image resize module -->
        <script src="https://unpkg.com/quill-image-resize-module@3.0.0/image-resize.min.js"></script>
        <script>
            Quill.register('modules/imageResize', ImageResize.default);

            var quill = new Quill('#editor', {
                theme: 'snow',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline'],
                        ['image', 'code-block'],
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'script': 'sub'
                        }, {
                            'script': 'super'
                        }],
                        [{
                            'header': [1, 2, 3, 4, 5, 6, false]
                        }],
                    ],
                    imageResize: {
                        displaySize: true
                    }
                }
            });

            document.getElementById('announcementForm').onsubmit = function(e) {
                e.preventDefault();
                var title = document.getElementById('announcement_title').value;
                var content = quill.root.innerHTML;
                var isValid = true;

                // Validate title
                if (title.trim() === '') {
                    document.getElementById('titleError').textContent = 'Title is required';
                    isValid = false;
                } else {
                    document.getElementById('titleError').textContent = '';
                }

                // Validate content
                if (quill.getText().trim() === '') {
                    document.getElementById('contentError').textContent = 'Content is required';
                    isValid = false;
                } else {
                    document.getElementById('contentError').textContent = '';
                }

                if (isValid) {
                    document.getElementById('announcement_caption').value = content;
                    this.submit();
                }
            };
        </script>
