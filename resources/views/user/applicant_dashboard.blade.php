    @include('partials.header')

    <body>
        @php
            $personalInfo = auth()->user()->personalInformation()->first();
        @endphp
        <main id="main" class="main">
            <section class="section profile">
                <div class="col-xl-11 mx-auto">
                    <div class="tab-content pt-1">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <br><br><br>
                            <h5 style="font-weight: bold; font-size: 25px;">Dashboard</h5>
                            <br>
                            <div class="row mb-1">
                                <div class="col-lg-3 col-md-4 label" style="color:#151515;">Status</div>
                                <div class="col-lg-9 col-md-8">
                                    @php
                                        $status = auth()->user()->status;
                                        $badgeStyle = '';

                                        switch ($status) {
                                            case 'Sent':
                                                $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  ';
                                                break;
                                            case 'Under Review':
                                                $badgeStyle = 'background-color: #CFE2FF; color: #052C92;   ';
                                                break;
                                            case 'Declined':
                                                $badgeStyle = 'background-color: #F8D7DA; color: #58151C;';
                                                break;
                                            case 'Shortlisted':
                                                $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  ';
                                                break;
                                            case 'For Interview':
                                                $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  ';
                                                break;
                                            case 'For House Visitation':
                                                $badgeStyle = 'background-color: #CFE2FF; color: #052C92;  ';
                                                break;
                                            default:
                                                $badgeStyle = 'background-color: gray; color: black;';
                                        }
                                    @endphp
                                    <span class="badge" style="{{ $badgeStyle }}">{{ auth()->user()->status }}</span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-lg-3 col-md-4 label" style="color:#151515;">Full Name</div>
                                <div class="col-lg-9 col-md-8">
                                    {{ $personalInfo->first_name ?? '' }} {{ $personalInfo->last_name ?? '' }}
                                </div>
                            </div>

                            <div class="row mb-1 mb-1">
                                <div class="col-lg-3 col-md-4 label" style="color:#151515;">Email Address</div>
                                <div class="col-lg-9 col-md-8" style="text-transform: lowercase;">
                                    {{ auth()->user()->email }}</div>
                            </div>

                            <div class="row mb-1 mb-1">
                                <div class="col-lg-3 col-md-4 label" style="color:#151515;">Incoming Grade</div>
                                <div class="col-lg-9 col-md-8">{{ $academicInfoData->incoming_grade_year ?? '' }}
                                </div>
                            </div>

                            <div class="row mb-1 mb-1">
                                <div class="col-lg-3 col-md-4 label" style="color:#151515;">Current School</div>
                                <div class="col-lg-9 col-md-8">{{ $academicInfoData->current_school ?? '' }}</div>
                            </div>
                            <form>
                                <br>
                                <br>

                                @if (session('status'))
                                    <div class="alert alert-success">{{ session('status') }}</div>
                                @endif

                                <h5 style="font-weight: bold; font-size: 22px;">Add Document <i
                                        class="fa fa-plus-circle clickable-icon" aria-hidden="true"
                                        data-bs-toggle="modal" data-bs-target="#basicModal"></i></h5>
                                <br>

                                <!-- ADD DOCUMENTS -->
                                <div class="alert alert-success" id="successMessage"
                                    style="display: none; text-align: center;">
                                    Upload Successfully!
                                </div>
                                <div id="successEditMessage" class="alert alert-success"
                                    style="display: none; text-align: center;">Update Successfully!</div>

                                <div class="modal fade" id="addModal" tabindex="-1">
                                    <form id="uploadForm" action="{{ route('applicant_dashboard.requirements') }}"
                                        method="POST">
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Add Document</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Document Type -->
                                                    <div class="form-group">
                                                        <label for="documentType">Document Type <span
                                                                style="color: red;">*</span></label>
                                                        <select class="form-select form-select-solid form-control"
                                                            id="documentType" name="documentType">
                                                            <option value=""
                                                                style="color: #d60606; font-style: italic;">Select
                                                                document type</option>
                                                            @foreach ($documentTypes as $documentType)
                                                                @if (!in_array($documentType, $approvedDocumentTypes))
                                                                    <option value="{{ $documentType }}">
                                                                        {{ $documentType }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="notes">Notes <span
                                                                style="  font-style: italic; color:#151515;">(Optional)</span></label>
                                                        <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="fileUpload">Document Proof <span
                                                                style="color: red;">*</span></label>
                                                        <div class="drag-area">
                                                            <label for="fileUpload" class="icon"><i
                                                                    class="fas fa-cloud-upload-alt"
                                                                    style="cursor: pointer;"></i></label>
                                                            <input type="file" class="form-control" id="fileUpload"
                                                                name="fileUpload" style="display: none;" accept=".pdf">
                                                            <header class="file-drop" style="font-size:13px;"
                                                                id="fileUploadLabel">Drag and drop files here or click
                                                                to upload attachment</header>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" id="closeAddModal" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="submitForm" class="btn"
                                                        disabled>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <!----DISPLAY TABLE-->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered">
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
                                                    @foreach ($reportcardData as $index => $requirement)
                                                        <tr class="data">
                                                            <td>{{ $index + 1 }}</td>
                                                            <td>{{ $requirement->document_type }}</td>
                                                            <td class="notes-column">{{ $requirement->notes }}</td>
                                                            <td>
                                                                @if (Storage::exists($requirement->uploaded_document))
                                                                    @php
                                                                        $originalFilename = basename(
                                                                            $requirement->uploaded_document,
                                                                        );
                                                                        $filename = preg_replace(
                                                                            '/_\d+/',
                                                                            '',
                                                                            $originalFilename,
                                                                        );
                                                                    @endphp
                                                                    <a href="{{ Storage::url($requirement->uploaded_document) }}"
                                                                        download="{{ $originalFilename }}"
                                                                        style="text-decoration: underline; color: #1e2482;">
                                                                        {{ $filename }}
                                                                    </a>
                                                                @else
                                                                    File not found
                                                                @endif

                                                            </td>
                                                            <td>
                                                                @php
                                                                    $status = $requirement->status;
                                                                    $badgeStyle = '';
                                                                    $badgeText = $status;

                                                                    switch ($status) {
                                                                        case 'Approved':
                                                                            $badgeStyle =
                                                                                'background-color: #71BF44; color: #fff;';
                                                                            break;
                                                                        case 'Declined':
                                                                            $badgeStyle =
                                                                                'background-color:  rgb(250, 0, 0); color: #fff;';
                                                                            $badgeText = $status;
                                                                            break;
                                                                        default:
                                                                            $badgeStyle =
                                                                                'background-color:  rgb(41, 17, 254); color: #fff;';
                                                                    }
                                                                @endphp

                                                                <span class="badge" style="{{ $badgeStyle }}">
                                                                    {{ $badgeText }}</span>

                                                                @if ($status === 'Declined')
                                                                    <br>
                                                                    <span class="declined-reason">Reason:
                                                                        {{ $requirement->declined_reason }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if ($requirement->status !== 'Approved' && $requirement->status !== 'Declined')
                                                                    <button type="button"
                                                                        class="btn btn-dark edit-button"
                                                                        data-requirement-id="{{ $requirement->id }}">
                                                                        Edit
                                                                    </button>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <h5 style="font-weight: bold; font-size: 22px; margin-top: 80px;">Monitoring Checklist
                                </h5>
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="container">
                                            <div class="row">
                                                @php
                                                    $halfway = ceil(count($documentTypes) / 2);
                                                @endphp
                                                @foreach ($documentTypes as $index => $docType)
                                                    <div class="col-12 col-md-6">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                name="document_types[]" value="{{ $docType }}"
                                                                id="flexCheckDefault{{ $index + 1 }}">
                                                            <label class="form-check-label"
                                                                for="flexCheckDefault{{ $index + 1 }}"
                                                                style="font-size: 17px;">
                                                                {{ $docType }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br><br>

                    <!-- Edit Document Modal -->
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel"
                        aria-hidden="true" data-bs-target="#basicEditModal">
                        <form id="editForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title f-para" id="editModalLabel">Edit Document
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Document Type -->
                                        <div class="form-group">
                                            <label for="editDocumentType">Document Type <span
                                                    style="color: red;">*</span></label>
                                            <select class="form-select form-select-solid form-control"
                                                id="editDocumentType" name="documentType">
                                                @foreach ($documentTypes as $documentType)
                                                    @if (!in_array($documentType, $approvedDocumentTypes))
                                                        <option value="{{ $documentType }}">
                                                            {{ $documentType }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="editNotes">Notes <span
                                                    style="font-style: italic; color:#151515;">(Optional)</span></label>
                                            <textarea class="form-control" id="editNotes" name="notes" rows="3"></textarea>
                                        </div>
                                        <input type="hidden" id="editRequirementId" name="requirementId">
                                        <div class="form-group">
                                            <label for="editFiles">Document Proof <span
                                                    style="color: red;">*</span></label>
                                            <div class="drag-area">
                                                <label for="editFiles" class="icon"><i
                                                        class="fas fa-cloud-upload-alt"
                                                        style="cursor: pointer;"></i></label>
                                                <input type="file" class="form-control" id="editFiles"
                                                    name="uploaded_document" accept=".pdf">
                                                <header style="font-size:13px;" id="fileEditLabel">Drag
                                                    and drop files here or click to upload attachment
                                                </header>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="closeEditModal"
                                            data-bs-dismiss="modal">Close</button>

                                        <button type="submit" class="btn btn-primary" id="submitEditForm">Save
                                            Changes</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                </div><!-- End Bordered Tabs -->
                </div>
            </section>
        </main><!-- End #main -->
        @include('partials.user-footer')
        <script src="assets/js/applicant_dashboard.js"></script>
        <script src="assets/js/edit_documents.js"></script>
        <script src="assets/js/applicant_checklist.js"></script>
        <script>
            const reportcardData = @json($reportcardData);
        </script>
    </body>

    </html>
