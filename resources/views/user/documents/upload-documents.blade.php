<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Upload Documents</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('applicant-partials.link')
    <link href="../../assets/css/applicant_dashboard.css" rel="stylesheet">
</head>

<body>
    <div id="loading-spinner" class="loading-spinner">
        <div class="loading-content">
            <img src="../admin-assets/img/RLlogo.png" alt="Logo" class="loading-logo" id="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('applicant-partials.sidebar')

        <div class="main-panel">
            @include('applicant-partials.header')
        </div>
        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Documents</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('user.applicant_dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('user.documents.upload-documents') }}">Documents</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Upload Documents</h4>
                                        <button class="btn btn-success btn-round ms-auto" data-bs-toggle="modal"
                                            data-bs-target="#addDocumentModal">
                                            <i class="fa fa-plus"></i>
                                            Add
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <!-- Toast for success message -->
                                    <div class="toast-container position-fixed bottom-0 end-0 p-3">
                                        <div id="successToast" class="toast align-items-center text-bg-success border-0"
                                            role="alert" aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Submitted Successfully!
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>

                                        <div id="editSuccessToast"
                                            class="toast align-items-center text-bg-success border-0" role="alert"
                                            aria-live="assertive" aria-atomic="true">
                                            <div class="d-flex">
                                                <div class="toast-body">
                                                    Document Updated Successfully!
                                                </div>
                                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                                    data-bs-dismiss="toast" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Add document Modal -->
                                    <div class="modal fade" id="addDocumentModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Add Document</span>
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="ps-2">
                                                        Fields marked with (<span style="color: red;">*</span>) are
                                                        required.
                                                    </p>
                                                    <form id="uploadForm"
                                                        action="{{ route('applicant_dashboard.requirements') }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="documentType">Document Type <span
                                                                            style="color: red;">*</span></label>
                                                                    <select
                                                                        class="form-select form-select-solid form-control"
                                                                        id="documentType" name="documentType">
                                                                        <option value=""
                                                                            style="color: #d60606; font-style: italic;">
                                                                            Select
                                                                            document type</option>
                                                                        @foreach ($documentTypes as $documentType)
                                                                            @if (!in_array($documentType, $approvedDocumentTypes))
                                                                                <option value="{{ $documentType }}">
                                                                                    {{ $documentType }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 pe-0">
                                                                <div class="form-group">
                                                                    <label for="notes">Notes</label>
                                                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="fileUpload">Document Proof (PDF
                                                                        only) <span
                                                                            style="color: red;">*</span></label>
                                                                    <div class="drag-area">
                                                                        <label for="fileUpload" class="icon"><i
                                                                                class="fas fa-cloud-upload-alt"
                                                                                style="cursor: pointer; font-size: 30px;"></i></label>
                                                                        <input type="file" class="form-control"
                                                                            id="fileUpload" name="fileUpload"
                                                                            style="display: none;" accept=".pdf">
                                                                        <header class="file-drop"
                                                                            style="font-size:13px;"
                                                                            id="fileUploadLabel">Drag and drop
                                                                            files
                                                                            here or click
                                                                            to upload attachment</header>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer border-0">

                                                    <button type="button" id="closeAddModal"
                                                        class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="button" id="submitForm" class="btn btn-success"
                                                        disabled>Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover">
                                            <div class="loading"></div>
                                            <thead>
                                                <tr>
                                                <tr class="data-tables">
                                                    <th>#</th>
                                                    <th>Date and Time</th>
                                                    <th style="font-size: 15px;">Document Type</th>
                                                    <th>Notes</th>
                                                    <th>Uploaded Document</th>
                                                    <th>Status</th>
                                                    <th>Edit Action</th>
                                                </tr>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($reportcardData as $index => $requirement)
                                                    <tr class="data">
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>
                                                            @if ($requirement->uploaded_at)
                                                                {{ $requirement->uploaded_at->format('F j, Y, g:i A') }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                        <td>{{ $requirement->document_type }}</td>
                                                        <td class="notes-column"
                                                            style="max-width: 150px; word-wrap: break-word; overflow-wrap: break-word;">
                                                            {{ $requirement->notes }}
                                                        </td>
                                                        <td
                                                            style="max-width: 110px; word-wrap: break-word; overflow-wrap: break-word;">
                                                            @php
                                                                \Log::info(
                                                                    'Full Uploaded Document Path: ' .
                                                                        $requirement->uploaded_document,
                                                                );

                                                                $fileExists = file_exists(
                                                                    storage_path(
                                                                        'app/public/' . $requirement->uploaded_document,
                                                                    ),
                                                                );
                                                            @endphp

                                                            @if ($fileExists)
                                                                @php
                                                                    $originalFilename = basename(
                                                                        $requirement->uploaded_document,
                                                                    );
                                                                    $filename = preg_replace(
                                                                        '/_\d+/',
                                                                        '',
                                                                        $originalFilename,
                                                                    );

                                                                    $fileUrl = asset(
                                                                        'storage/' . $requirement->uploaded_document,
                                                                    );
                                                                @endphp
                                                                <a href="{{ $fileUrl }}" target="_blank"
                                                                    rel="noopener noreferrer" class="underline-link">
                                                                    {{ $filename }}
                                                                </a>
                                                            @else
                                                                <span class="text-danger">File not found:
                                                                    {{ $requirement->uploaded_document }}</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @php
                                                                $status = $requirement->status;
                                                                $badgeClass = 'badge';

                                                                switch ($status) {
                                                                    case 'Approved':
                                                                        $badgeClass .= ' bg-success';
                                                                        break;
                                                                    case 'Declined':
                                                                        $badgeClass .= ' bg-danger';
                                                                        break;
                                                                    default:
                                                                        $badgeClass .= ' bg-primary';
                                                                }
                                                            @endphp

                                                            <span class="{{ $badgeClass }}">
                                                                {{ $status }}
                                                            </span>

                                                            @if ($status === 'Declined')
                                                                <br>
                                                                <span class="declined-reason">Reason:
                                                                    {{ $requirement->declined_reason }}</span>
                                                            @endif
                                                        </td>

                                                        <td class="text-center">
                                                            @if ($requirement->status !== 'Approved' && $requirement->status !== 'Declined')
                                                                <a href="#" class="btn btn-view edit-button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#editDocumentModal"
                                                                    data-requirement-id="{{ $requirement->id }}"
                                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                                    title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </a>
                                                            @endif
                                                        </td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>


                                    <!-- Edit document Modal -->
                                    <div class="modal fade" id="editDocumentModal" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">
                                                        <span class="fw-mediumbold">Edit Document</span>
                                                    </h5>
                                                    <button type="button" class="close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="ps-2">
                                                        Fields marked with (<span style="color: red;">*</span>) are
                                                        required.
                                                    </p>
                                                    <form id="editForm" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label for="editDocumentType">Document Type
                                                                        <span style="color: red;">*</span></label>
                                                                    <select
                                                                        class="form-select form-select-solid form-control"
                                                                        id="editDocumentType" name="documentType">
                                                                        <option value=""
                                                                            style="color: #d60606; font-style: italic;">
                                                                            Select document type</option>
                                                                        @foreach ($documentTypes as $documentType)
                                                                            @if (!in_array($documentType, $approvedDocumentTypes))
                                                                                <option value="{{ $documentType }}">
                                                                                    {{ $documentType }}</option>
                                                                            @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12 pe-0">
                                                                <div class="form-group">
                                                                    <label for="editNotes">Notes</label>
                                                                    <textarea class="form-control" id="editNotes" name="notes" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <input type="hidden" id="editRequirementId"
                                                                    name="requirementId">
                                                                <div class="form-group">
                                                                    <label for="editFiles">Document Proof <span
                                                                            style="color: red;">*</span></label>
                                                                    <div class="drag-area">
                                                                        <label for="editFiles" class="icon"><i
                                                                                class="fas fa-cloud-upload-alt"
                                                                                style="cursor: pointer; font-size: 30px;"></i></label>
                                                                        <input type="file" class="form-control"
                                                                            id="editFiles" name="uploaded_document"
                                                                            accept=".pdf">
                                                                        <header class="file-drop"
                                                                            style="font-size:13px;"
                                                                            id="fileEditLabel">Drag
                                                                            and drop files here or click to upload
                                                                            attachment
                                                                        </header>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" id="editRequirementId"
                                                                name="requirementId">
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" id="closeEditModal"
                                                                class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" id="submitEditForm"
                                                                class="btn btn-success" disabled>Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('applicant-partials.footer')
        <script src="../../../admin-assets/js/upload-documents.js"></script>
        <script src="../../../admin-assets/js/edit_documents.js"></script>
        <script>
            $(document).ready(function() {
                $("#basic-datatables").DataTable({});
            });
        </script>
