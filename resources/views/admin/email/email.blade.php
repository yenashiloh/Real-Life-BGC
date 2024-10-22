{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Create Account</title>
    @include('admin-partials.admin-header')
    <style>
        .alert-success {
            transition: opacity 0.5s ease-in-out;
        }

        .alert-danger {
            transition: opacity 0.5s ease-in-out;
        }
    </style>
</head>

<body>
    @include('admin-partials.admin-sidebar', [
        'notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications(),
    ])

    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
    </div>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">Email Content </h3>
            </div>
            @if (session('success'))
                <div id="successMessage" class="alert alert-success mt-3 fade-in-out" role="alert"
                    style="text-align: center">
                    {{ session('success') }}
                </div>
                <script>
                    setTimeout(function() {
                        var successMessage = document.getElementById('successMessage');
                        successMessage.style.opacity = '0';
                        setTimeout(function() {
                            successMessage.style.display = 'none';
                        }, 500);
                    }, 3000);
                </script>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
           
            <div class="row">
                <div class="col-xl-12 ">
                </div>

                <div class="col-xl-12">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#under-review">Under Review</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#shortlisted">Shortlisted</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#interview">Interview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#house-visitation">House Visitation</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#decline">Declined</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#approve">Approved</button>
                                </li>

                            </ul>

                            <!----------------UNDER REVIEW--------------------->
                            <div class="tab-content">
                                <div class="tab-pane fade show active under-review" id="under-review">
                                    <form method="POST" action="{{ route('admin.email.save-under-review-content') }}"
                                        id="emailContentForm">
                                        @csrf
                                        <br>
                                        <h6 class="pt-2">Email Content for Under Review</h6>
                                        <div class="quill-editor-default" id="editor-container" style="height: 300px;">
                                            {!! $under_review_data !!}
                                        </div>
                                        <input type="hidden" name="under_review" id="under_review_input">
                                        <div class="text-center mt-3">
                                            <button id="submitButton" class="btn btn-success btn-fw"
                                                type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                <!----------------SHORTLISTED--------------------->
                                <div class="tab-pane fade shortlisted" id="shortlisted">
                                    <form method="POST" action="{{ route('admin.email.save-shortlisted-content') }}"
                                        id="shortlistedForm">
                                        @csrf
                                        <br>
                                        <h6 class="pt-2">Email Content for Shortlisted</h6>
                                        <div class="quill-editor-default-shortlisted" id="shortlisted-editor-container"
                                            style="height: 300px;">
                                            {!! $shortlisted_data !!}
                                        </div>
                                        <input type="hidden" name="shortlisted" id="shortlisted_input">
                                        <div class="text-center mt-3">
                                            <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                        </div>
                                    </form>
                                </div>

                                <!----------------FOR INTERVIEW--------------------->
                                <div class="tab-pane fade" id="interview">
                                    <form method="POST" action="{{ route('admin.email.save-interview-content') }}"
                                        id="interviewForm">
                                        @csrf
                                        <br>
                                        <div class="form-group">
                                            <h6 class="pt-2">Email Content for Interview</h6>
                                            <div class="quill-editor-default-interview" id="interview-editor-container"
                                                style="height: 300px;">
                                                {!! $interview_data !!}
                                            </div>
                                            <input type="hidden" name="interview" id="interview_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!----------------HOUSE VISITATION-------------------->
                                <div class="tab-pane fade" id="house-visitation">
                                    <form method="POST"
                                        action="{{ route('admin.email.save-house-visitation-content') }}"
                                        id="housevisitationForm">
                                        @csrf
                                        <br>
                                        <div class="form-group">
                                            <h6 class="pt-2">Email Content for House Visitation</h6>
                                            <div class="quill-editor-default-house-visitation"
                                                id="house-visitation-editor-container" style="height: 300px;">
                                                {!! $house_visitation_data !!}
                                            </div>
                                            <input type="hidden" name="house_visitation"
                                                id="house-visitation-input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!----------------DECLINED-------------------->
                                <div class="tab-pane fade" id="decline">
                                    <form method="POST" action="{{ route('admin.email.save-decline-content') }}"
                                        id="declineForm">
                                        @csrf
                                        <br>
                                        <div class="form-group">
                                            <h6 class="pt-2">Email Content for Declined</h6>
                                            <div class="quill-editor-default-decline" id="decline-editor-container"
                                                style="height: 300px;">
                                                {!! $decline_data !!}
                                            </div>
                                            <input type="hidden" name="decline" id="decline-input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!----------------APPROVED-------------------->
                                <div class="tab-pane fade" id="approve">
                                    <form method="POST" action="{{ route('admin.email.save-approved-content') }}"
                                        id="approvedForm">
                                        @csrf
                                        <br>
                                        <div class="form-group">
                                            <h6 class="pt-2">Email Content for Approved</h6>
                                            <div class="quill-editor-default-approved" id="approved-editor-container"
                                                style="height: 300px;">
                                                {!! $approved_data !!}
                                            </div>
                                            <input type="hidden" name="approved" id="approved-input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div><!-- End tab-content -->

                            <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>

                            <script src="../assets-new-admin/js/off-canvas.js"></script>
                            <script src="../assets-new-admin/js/misc.js"></script>
                            <!-- Vendor JS Files -->
                            <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
                            <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                            <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
                            <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
                            <script src="../assets-admin/vendor/php-email-form/validate.js"></script>
                            <script src="../assets-admin/tinymce/tinymce.min.js"></script>
                            <script src="../assets-new-admin/js/loader.js"></script>

                            <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
                            <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
                            <script src="../assets-admin/vendor/quill/quill.min.js"></script>

                            <!-- Template Main JS File -->
                            <script src="../assets-admin/js/main.js"></script>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    let lastTab = sessionStorage.getItem('lastTab');
                                    if (lastTab) {
                                        let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
                                        if (tabLink) {
                                            let tab = new bootstrap.Tab(tabLink);
                                            tab.show();
                                        }
                                    }


                                    let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
                                    tabLinks.forEach(function(tabLink) {
                                        tabLink.addEventListener('shown.bs.tab', function(event) {
                                            let activeTab = event.target.getAttribute('data-bs-target');
                                            sessionStorage.setItem('lastTab', activeTab);
                                        });
                                    });

                                });

                                //*********************************************************//
                                document.addEventListener('DOMContentLoaded', function() {
                                    // Check if there's content in local storage for Under Review tab
                                    // var underReviewContent = localStorage.getItem('under_review_content');
                                    // var submitButton = document.getElementById('submitButton');
                                    // var textarea = document.querySelector('.quill-editor-default');

                                    // if (underReviewContent) {
                                    //     // Content exists, change button text to 'Save Changes'
                                    //     submitButton.innerText = 'Save Changes';
                                    //     // Fill the textarea with existing content
                                    //     textarea.value = underReviewContent;
                                    // }

                                    // // Submit button click event for Under Review tab
                                    // document.getElementById('emailContentForm').addEventListener('submit', function (event) {
                                    //     var underReviewContent = textarea.value;
                                    //     if (underReviewContent) {
                                    //         // Content exists, change button text to 'Save Changes'
                                    //         submitButton.innerText = 'Save Changes';
                                    //         // Store content in local storage
                                    //         localStorage.setItem('under_review_content', underReviewContent);
                                    //     }
                                    // });

                                    // Check if there's content in local storage for Shortlisted tab
                                    var shortlistedContent = localStorage.getItem('shortlisted_content');
                                    var submitButtonShortlisted = document.querySelector('#shortlistedForm button[type="submit"]');
                                    var textareaShortlisted = document.querySelector('.quill-editor-default-shortlisted');

                                    if (shortlistedContent) {
                                        // Content exists, change button text to 'Save Changes'
                                        submitButtonShortlisted.innerText = 'Save Changes';
                                        // Fill the textarea with existing content
                                        textareaShortlisted.value = shortlistedContent;
                                    }

                                    // Submit button click event for Shortlisted tab
                                    document.getElementById('shortlistedForm').addEventListener('submit', function(event) {
                                        var shortlistedContent = textareaShortlisted.value;
                                        if (shortlistedContent) {
                                            // Content exists, change button text to 'Save Changes'
                                            submitButtonShortlisted.innerText = 'Save Changes';
                                            // Store content in local storage
                                            localStorage.setItem('shortlisted_content', shortlistedContent);
                                        }
                                    });
                                });

                                // Initialize Quill editor for the interview tab
                                var interviewEditor = new Quill('#interview-editor-container', {
                                    theme: 'snow' // You can customize the theme if needed
                                });

                                // Listen for changes in the editor content
                                interviewEditor.on('text-change', function(delta, oldDelta, source) {
                                    document.getElementById('interview_input').value = interviewEditor.root.innerHTML;
                                });

                                var housevisitationEditor = new Quill('#house-visitation-editor-container', {
                                    theme: 'snow' // You can customize the theme if needed
                                });

                                housevisitationEditor.on('text-change', function(delta, oldDelta, source) {
                                    // Get the HTML content of the editor
                                    var htmlContent = housevisitationEditor.root.innerHTML;
                                    // Set the value of the hidden input field
                                    document.getElementById('house-visitation-input').value = htmlContent;
                                });

                                var declineEditor = new Quill('#decline-editor-container', {
                                    theme: 'snow' // You can customize the theme if needed
                                });

                                declineEditor.on('text-change', function(delta, oldDelta, source) {
                                    // Get the HTML content of the editor
                                    var htmlContent = declineEditor.root.innerHTML;
                                    // Set the value of the hidden input field
                                    document.getElementById('decline-input').value = htmlContent;
                                });

                                var approvedEditor = new Quill('#approved-editor-container', {
                                    theme: 'snow' // You can customize the theme if needed
                                });

                                approvedEditor.on('text-change', function(delta, oldDelta, source) {
                                    // Get the HTML content of the editor
                                    var htmlContent = approvedEditor.root.innerHTML;
                                    // Set the value of the hidden input field
                                    document.getElementById('approved-input').value = htmlContent;
                                });
                            </script>

</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Email Content</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

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
                    <h3 class="fw-bold mb-3">Email Content</h3>
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
                            <a href="{{ route('admin.email.email') }}">Email Content</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-xl-12"></div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body pt-3">
                                <!-- Bordered Tabs -->
                                @if (session('success'))
                                    <div id="successMessage"
                                        class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                                        style="text-align: center">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <ul class="nav nav-tabs nav-tabs-bordered">
                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#under-review">Under Review</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#shortlisted">Shortlisted</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#interview">Interview</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#house-visitation">House Visitation</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#decline">Declined</button>
                                    </li>
                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#approve">Approved</button>
                                    </li>
                                </ul>

                                <!----------------UNDER REVIEW--------------------->
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="under-review">
                                        <form method="POST"
                                            action="{{ route('admin.email.save-under-review-content') }}"
                                            id="emailContentForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for Under Review</h6>
                                            <div class="quill-editor-default" id="under-review-editor-container"
                                                style="height: 300px;">
                                                {!! $under_review_data !!}
                                            </div>
                                            <input type="hidden" name="under_review" id="under_review_input">
                                            <div class="text-center mt-3">
                                                <button id="submitButton" class="btn btn-success btn-fw"
                                                    type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!----------------SHORTLISTED--------------------->
                                    <div class="tab-pane fade" id="shortlisted">
                                        <form method="POST"
                                            action="{{ route('admin.email.save-shortlisted-content') }}"
                                            id="shortlistedForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for Shortlisted</h6>
                                            <div class="quill-editor-default-shortlisted"
                                                id="shortlisted-editor-container" style="height: 300px;">
                                                {!! $shortlisted_data !!}
                                            </div>
                                            <input type="hidden" name="shortlisted" id="shortlisted_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!----------------FOR INTERVIEW--------------------->
                                    <div class="tab-pane fade" id="interview">
                                        <form method="POST"
                                            action="{{ route('admin.email.save-interview-content') }}"
                                            id="interviewForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for Interview</h6>
                                            <div class="quill-editor-default-interview"
                                                id="interview-editor-container" style="height: 300px;">
                                                {!! $interview_data !!}
                                                <!-- Ensure you have $interview_data variable -->
                                            </div>
                                            <input type="hidden" name="interview" id="interview_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!----------------HOUSE VISITATION--------------------->
                                    <div class="tab-pane fade" id="house-visitation">
                                        <form method="POST"
                                            action="{{ route('admin.email.save-house-visitation-content') }}"
                                            id="housevisitationForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for House Visitation</h6>
                                            <div class="quill-editor-default-house-visitation"
                                                id="house-visitation-editor-container" style="height: 300px;">
                                                {!! $house_visitation_data !!}
                                            </div>
                                            <input type="hidden" name="house_visitation"
                                                id="house_visitation_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!----------------DECLINED--------------------->
                                    <div class="tab-pane fade" id="decline">
                                        <form method="POST" action="{{ route('admin.email.save-decline-content') }}"
                                            id="declineForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for Declined</h6>
                                            <div class="quill-editor-default-decline" id="decline-editor-container"
                                                style="height: 300px;">
                                                {!! $decline_data !!}
                                            </div>
                                            <input type="hidden" name="decline" id="decline_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    <!----------------APPROVED--------------------->
                                    <div class="tab-pane fade" id="approve">
                                        <form method="POST"
                                            action="{{ route('admin.email.save-approved-content') }}"
                                            id="approvedForm">
                                            @csrf
                                            <br>
                                            <h6 class="pt-2">Email Content for Approved</h6>
                                            <div class="quill-editor-default-approved" id="approved-editor-container"
                                                style="height: 300px;">
                                                {!! $approved_data !!}
                                            </div>
                                            <input type="hidden" name="approved" id="approved_input">
                                            <div class="text-center mt-3">
                                                <button class="btn btn-success btn-fw" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @include('admin-partials.footer')
                <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
                <script src="../../../admin-assets/js/email-content.js"></script>
