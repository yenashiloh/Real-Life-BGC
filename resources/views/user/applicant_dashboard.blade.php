    @include('partials.header')


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
        <main id="main" class="main">
            <section class="section profile">
                <div class="col-xl-11 mx-auto">
                    {{-- <div class="card ">
                        <div class="card-body pt-3">
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview"
                                        style="font-size: 19px; cursor: auto;">Dashboard</button>
                                </li>

                            </ul> --}}
                            <div class="tab-content pt-1">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <br>
                                    {{-- <h5 style="font-weight: bold;"> Welcome, {{ $personalInfo->first_name ?? '' }}! </h5> --}}
                                    <h5 style="font-weight: bold; font-size: 25px;">Dashboard</h5>
                                    <br>
                                    <div class="row mb-1">
                                        <div class="col-lg-3 col-md-4 label ">Status</div>
                                        <div class="col-lg-9 col-md-8">
                                            @php
                                                $status = auth()->user()->status;
                                                $badgeStyle = '';

                                                switch ($status) {
                                                    case 'New Applicant':
                                                        $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  font-family: "Poppins", sans-serif;';
                                                        break;
                                                    case 'Under Review':
                                                        $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  font-family: "Poppins", sans-serif; ';
                                                        break;
                                                    case 'Declined':
                                                        $badgeStyle = 'background-color: #F8D7DA; color: #58151C;';
                                                        break;
                                                    case 'Shortlisted':
                                                        $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  font-family: "Poppins", sans-serif;';
                                                        break;
                                                    case 'For Interview':
                                                        $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  font-family: "Poppins", sans-serif;';
                                                        break;
                                                    case 'For House Visitation':
                                                        $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  font-family: "Poppins", sans-serif;';
                                                        break;
                                                    default:
                                                        $badgeStyle = 'background-color: gray; color: black;';
                                                }
                                            @endphp
                                            <span class="badge"
                                                style="{{ $badgeStyle }}">{{ auth()->user()->status }}</span>
                                        </div>
                                    </div>

                                    <div class="row mb-1">
                                        <div class="col-lg-3 col-md-4 label">Full Name</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ $personalInfo->first_name ?? '' }} {{ $personalInfo->last_name ?? '' }}
                                        </div>
                                    </div>

                                    <div class="row mb-1 mb-1">
                                        <div class="col-lg-3 col-md-4 label">Email Address</div>
                                        <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                                    </div>

                                    <div class="row mb-1 mb-1">
                                        <div class="col-lg-3 col-md-4 label">Incoming Grade</div>
                                        <div class="col-lg-9 col-md-8">{{ $academicInfoData->incoming_grade_year ?? '' }}
                                        </div>
                                    </div>

                                    <div class="row mb-1 mb-1">
                                        <div class="col-lg-3 col-md-4 label">Current School</div>
                                        <div class="col-lg-9 col-md-8">{{ $academicInfoData->current_school ?? '' }}</div>
                                    </div>
                                    <form>
                                        <br>
                                        <br>
                                        
                                        @if (session('status'))
                                        <div class="alert alert-success">{{ session('status') }}</div>
                                    @endif
                                
                                    <h5 style="font-weight: bold;">Requirements <i class="fa fa-plus-circle clickable-icon" aria-hidden="true" data-bs-toggle="modal" data-bs-target="#basicModal"></i></h5>
                                    <br>
                                
                                    <!-- ADD DOCUMENTS -->
                                    <div class="modal fade" id="basicModal" tabindex="-1">
                                        <form action="{{ url('add-requirements') }}" method="POST">
                                            @csrf
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Add Document</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                        <div class="modal-body">
                                                            <!-- Document Type -->
                                                            <div class="form-group">
                                                                <label for="documentType">Document Type</label>
                                                                <select class="form-select form-select-solid form-control" id="documentType" name="documentType">
                                                                    <option value="" style="color: #444444;">Select document type</option>
                                                                        <option value="Signed Application Form">Signed Application Form</option>
                                                                        <option value="Birth Certificate">Birth Certificate</option>
                                                                        <option value="Character Evaluation Forms">Character Evaluation Forms</option>
                                                                        <option value="Proof of Financial Status">Proof of Financial Status</option>
                                                                        <option value="Payslip / DSWD Report / ITR">Payslip / DSWD Report / ITR</option>
                                                                        <option value="Two Reference Forms">Two Reference Forms</option>
                                                                        <option value="Home Visitation Form">Home Visitation Form</option>
                                                                        <option value="Report Card / Grades">Report Card / Grades</option>
                                                                        <option value="Prospectus">Prospectus</option>
                                                                        <option value="Official Grading System">Official Grading System</option>
                                                                        <option value="Tuition Projection">Tuition Projection</option>
                                                                        <option value="Admission Slip">Admission Slip</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="notes">Notes</label>
                                                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                                                </div>
                                                            </div>
{{-- 
                                                                <div>
                                                                <input type="file" id="fileUpload" name="fileUpload">
                                                            </div> --}}
                                              
                                                                {{-- <div class="form-group">
                                                                    <label for="fileUpload">Upload Requirements</label>
                                                                    <div class="drag-area">
                                                                        <label for="fileUpload" class="icon"><i class="fas fa-cloud-upload-alt" style="cursor: pointer;"></i></label>
                                                                        <input type="file" class="form-control" id="fileUpload" name="fileUpload" style="display: none;">
                                                                        <header>Drag and drop files here or click to upload attachment</header>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        <!----DISPLAY TABLE-->
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                                <thead>
                                                    <tr class="data-tables">
                                                        <th>#</th>
                                                        <th style="font-size: 15px;">Document Type</th>
                                                        <th>Notes</th>
                                                        <th>Uploaded Document</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($reportcardData as $index => $requirement)
                                                    <tr class="data">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $requirement->document_type }}</td>
                                                        <td>{{ $requirement->notes }}</td>
                                                        <td> <a href="{{ Storage::url($requirement->uploaded_document) }}" download="{{ $requirement->uploaded_document }}" style="text-decoration: underline; color: #1e2482;">
                                                            {{ $requirement->uploaded_document }}
                                                        </a></td>
                                                        <td><span class="badge badge-primary" style="font-size: 11px; background-color: #CFE2FF; color: #052C92;  font-family: Poppins; font-weight: normal;">{{ $requirement->status }}</span></td>
                                                        <td>
                                                            <button type="button" class="btn" style="width: 85px; background-color: #2EB85C; color: white; font-size: 12px; height:30px;" data-bs-toggle="modal" data-bs-target="#editModal">Edit</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
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
                                    </form><!-- End settings Form -->
                                </div>
                            </div>
                        </div><!-- End Bordered Tabs -->
                    </div>
                                {{-- </div>
                                </div> --}}
            </section>
        </main><!-- End #main -->


        @include('partials.user-footer')

        
    </body>

    </html>
