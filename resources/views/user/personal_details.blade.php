<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Real LIFE Foundation - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/RLlogo1.png" rel="icon">
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="  https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">


    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>


<style>
    .vertical-center {
        min-height: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }

    .clickable-icon {
        cursor: pointer;
        font-size: 24px;
        color: #71BF44;
    }

    .clickable-icon:hover {
        color: #518630;
    }

    .form-select {
        width: 100%;
        max-width: 100%;
        box-sizing: border-box;
    }

    .drag-area {
        border: 2px dashed #DEE2E6;
        border-radius: 5px;
        padding: 20px;
        text-align: center;
        cursor: pointer;
    }

    .drag-area .icon {
        font-size: 40px;
        color: black;
    }

    .drag-area header {
        font-size: 10px;
        margin: 17x 0;
        color: #444;
    }

    .drag-area span {
        font-size: 14px;
        color: #777;
    }

    .drag-area button {
        padding: 8px 15px;
        margin-top: 15px;
        background-color: #2980b9;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .drag-area input[type="file"] {
        display: none;
    }

    .status-column {
        width: 30px !important;
    }

    .data {
        font-size: 14px;
    }

    .data-tables {
        font-size: 15px;
    }
</style>

<body>
    @php
        $personalInfo = auth()
            ->user()
            ->personalInformation()
            ->first();
    @endphp
    @include('partials.user-header')
    <main id="main" class="main">
        <section class="section profile">
            <div class="col-xl-12 p-4 ">
                <div class="card ">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Overview</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                    Profile</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Requirements</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Change Password</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-1">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <br>
                                <h5 style="font-weight: bold;">Profile Details</h5>
                                <div class="row mb-1">
                                    <div class="col-lg-3 col-md-4 label ">Status</div>
                                    <div class="col-lg-9 col-md-8"> <span class="badge bg-primary">For
                                            Interview</span></div>
                                </div>
                                <div class="row mb-1">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $personalInfo->first_name ?? '' }} {{ $personalInfo->last_name ?? '' }}
                                    </div>
                                </div>

                                <div class="row mb-1 mb-1">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-lg-3 col-md-4 label">Birthdate</div>
                                    <div class="col-lg-9 col-md-8">{{ $personalInfo->birthday ?? '' }}</div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">
                                        {{ $personalInfo->house_number ?? '' }}
                                        {{ $personalInfo->street ?? '' }}
                                        {{ $personalInfo->barangay ?? '' }}
                                        {{ $personalInfo->municipality ?? '' }}
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                    <div class="col-lg-9 col-md-8">{{ $personalInfo->contact ?? '' }}</div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form>
                                    <div class="row mb-3">
                                        <h5 class="card-title" style="font-weight: bold;  color: #444444;">Personal
                                            Information</h5>
                                        <div class="col-md-6">
                                            <label for="first_name" class="col-form-label"
                                                style="font-weight: normal;">First Name</label>
                                            <input name="first_name" type="text" class="form-control"
                                                id="first_name" value="{{ $personalInfo->first_name ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="last_name" class="col-form-label"
                                                style="font-weight: normal;">Last Name</label>
                                            <input name="last_name" type="text" class="form-control"
                                                id="last_name" value="{{ $personalInfo->last_name ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="contact_no" class="col-form-label"
                                                style="font-weight: normal;">Contact Number</label>
                                            <input name="contact_no" type="number" class="form-control"
                                                id="contact_no" value="{{ $personalInfo->contact ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="birthdate" class="col-form-label"
                                                style="font-weight: normal;">Birthdate</label>
                                            <input name="birthdate" type="date" class="form-control"
                                                id="birthdate" value="{{ $personalInfo->birthday ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="house_no" class="col-form-label"
                                                style="font-weight: normal;">House Number</label>
                                            <input name="house_no" type="text" class="form-control"
                                                id="house_no" value="{{ $personalInfo->house_number ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="street" class="col-form-label"
                                                style="font-weight: normal;">Street</label>
                                            <input name="street" type="text" class="form-control" id="street"
                                                value="{{ $personalInfo->street ?? '' }}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="barangay" class="col-form-label"
                                                style="font-weight: normal;">Barangay</label>
                                            <input name="barangay" type="text" class="form-control"
                                                id="barangay" value="{{ $personalInfo->barangay ?? '' }}">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="municipality" class="col-form-label"
                                                style="font-weight: normal;">Municipality</label>
                                            <input name="municipality" type="text" class="form-control"
                                                id="municipality" value="{{ $personalInfo->municipality ?? '' }}">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-3">
                                        <h5 class="card-title" style="font-weight: bold;  color: #444444;">Academic
                                            Information</h5>
                                        <div class="col-md-6">
                                            <label for="incoming_grade" class="col-form-label"
                                                style="font-weight: normal;">Incoming Grade</label>
                                            <input name="incoming_grade" type="text" class="form-control"
                                                id="incoming_grade" value="First Year College">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="current_course" class="col-form-label"
                                                style="font-weight: normal;">Current Course or Program</label>
                                            <input name="current_course" type="text" class="form-control"
                                                id="current_course" value="STEM">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row mb-3">
                                        <h5 class="card-title" style="font-weight: bold;  color: #444444;">Grades</h5>
                                        <div class="col-md-6">
                                            <label for="g9_gwa" class="col-form-label"
                                                style="font-weight: normal;">Grade 9 GWA</label>
                                            <input name="g9_gwa" type="number" class="form-control" id="g9_gwa"
                                                value="90">
                                        </div>

                                        <div class="col-md-6">
                                            <label for="g10_gwa" class="col-form-label"
                                                style="font-weight: normal;">Grade 10 GWA</label>
                                            <input name="g10_gwa" type="number" class="form-control" id="g10_gwa"
                                                value="90">
                                        </div>
                                    </div>


                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>

                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form>
                                    <h5 style=" font-weight: bold;">Requirements <i
                                            class="fa fa-plus-circle clickable-icon" aria-hidden="true"
                                            data-bs-toggle="modal" data-bs-target="#basicModal"></i></h5>
                                    <br>

                                    <!---------ADD DOCUMENTS----------->
                                    <div class="modal fade" id="basicModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Document</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="form-group">
                                                            <label for="documentType">Document Type</label>
                                                            <select class="form-select form-select-solid form-control"
                                                                id="documentType">
                                                                <option value="" style="color:#444444;">Select
                                                                    document type</option>
                                                                <option value="">Signed Application Form</option>
                                                                <option value="2">Birth Certificate</option>
                                                                <option value="3">Character Evaluation Forms
                                                                </option>
                                                                <option value="4">Proof of Financial Status
                                                                </option>
                                                                <option value="5">Payslip / DSWD Report / ITR
                                                                </option>
                                                                <option value="6">Two Reference Forms</option>
                                                                <option value="7">Home Visitation Form</option>
                                                                <option value="8">Report Card / Grades</option>
                                                                <option value="9">Prospectus</option>
                                                                <option value="10">Official Grading System</option>
                                                                <option value="11">Tuition Projection</option>
                                                                <option value="12">Admission Slip</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="notes">Notes</label>
                                                            <textarea class="form-control" id="notes" rows="3"></textarea>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="fileUpload">Upload Requirements</label>
                                                            <div class="drag-area">
                                                                <label for="fileUpload" class="icon"><i
                                                                        class="fas fa-cloud-upload-alt"></i></label>
                                                                <input type="file" class="form-control"
                                                                    id="fileUpload" style="display: none;">
                                                                <header>Drag and drop files here or click to upload
                                                                    attachment</header>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>


                                </form>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>

                    </div><!-- End Basic Modal-->

                    <div class="table-responsive mt-3">
                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr class="data-tables">
                                    <th>#</th>
                                    <th style=" font-size: 15px;">Document Type</th>
                                    <th>Notes</th>
                                    <th>Uploaded Document</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="data">
                                    <td>1</td>
                                    <td>Report of Grades</td>
                                    <td>3 School Year Grades</td>
                                    <td>Grades.pdf</td>
                                    <td><span class="badge badge-primary" style="font-weight: medium;">For
                                            review</span></td>
                                    <td>
                                        <button type="button" class="btn"
                                            style="width: 90px; background-color: #2EB85C; color: white;  font-size: 13px;"
                                            data-bs-toggle="modal" data-bs-target="#editModal"><i
                                                class="fas fa-edit"></i> Edit</button>
                                        <button type="button" class="btn"
                                            style="background-color: #DC3545; color: white;  font-size: 13px; "
                                            data-bs-toggle="modal" data-bs-target="#deleteModal"><i
                                                class="fas fa-trash"></i> Delete</button>
                                    </td>
                                </tr>


                                <!-- Additional table rows here -->
                            </tbody>
                        </table>
                    </div>


                    <!----EDIT MODAL-->
                    <div class="modal fade" id="editModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit Document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group">
                                            <label for="documentType">Document Type</label>
                                            <select class="form-select form-select-solid form-control"
                                                id="documentType">
                                                <option value="" style="color:#444444;">Select document type
                                                </option>
                                                <option value="">Signed Application Form</option>
                                                <option value="2">Birth Certificate</option>
                                                <option value="3">Character Evaluation Forms</option>
                                                <option value="4">Proof of Financial Status</option>
                                                <option value="5">Payslip / DSWD Report / ITR</option>
                                                <option value="6">Two Reference Forms</option>
                                                <option value="7">Home Visitation Form</option>
                                                <option value="8">Report Card / Grades</option>
                                                <option value="9">Prospectus</option>
                                                <option value="10">Official Grading System</option>
                                                <option value="11">Tuition Projection</option>
                                                <option value="12">Admission Slip</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="notes">Notes</label>
                                            <textarea class="form-control" id="notes" rows="3"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="fileUpload">Upload Requirements</label>
                                            <div class="drag-area">
                                                <label for="fileUpload" class="icon"><i
                                                        class="fas fa-cloud-upload-alt"></i></label>
                                                <input type="file" class="form-control" id="fileUpload"
                                                    style="display: none;">
                                                <header>Drag and drop files here or click to upload attachment</header>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Edit Modal-->

                    <!-- Delete Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Delete Document</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Are you sure you want to delete this?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-danger">Yes, Delete</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                    <!-- Change Password Form -->
                    <form>
                        <div class="row mb-3">
                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control" id="currentPassword"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" class="form-control" id="newPassword"
                                    required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                Password</label>
                            <div class="col-md-8 col-lg-9">
                                <input name="renewpassword" type="password" class="form-control" id="renewPassword"
                                    required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Change Password</button>
                        </div>
                    </form><!-- End Change Password Form -->
                </div>
            </div><!-- End Bordered Tabs -->
            </div>
            </div>
            </div>
        </section>
    </main><!-- End #main -->

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
    <script src="script.js"></script>

    <script>
        new DataTable('#example');
    </script>

</body>

</html>
