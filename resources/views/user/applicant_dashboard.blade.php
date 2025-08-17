<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    @include('applicant-partials.link')
</head>
<style>
    input[type="checkbox"].non-clickable-checkbox:not(:checked) {
        border-color: #505050;
    }

    input[type="checkbox"].non-clickable-checkbox:not(:checked):hover {
        border-color: #505050;
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
        @include('applicant-partials.sidebar')

        <div class="main-panel">
            @include('applicant-partials.header')
        </div>

        <div class="container">
            <div class="page-inner">
                @php
                    $status = auth()->user()->status;
                    $badgeStyle = '';

                    switch ($status) {
                        case 'Sent':
                        case 'Under Review':
                        case 'Shortlisted':
                        case 'For Interview':
                        case 'For House Visitation':
                            $badgeStyle = 'background-color: #CFE2FF; color: #052C92;';
                            break;
                        case 'Declined':
                            $badgeStyle = 'background-color: #F8D7DA; color: #58151C;';
                            break;
                        default:
                            $badgeStyle = 'background-color: gray; color: black;';
                    }
                @endphp

                <div class="container-fluid">
                    <div class="row flex-column flex-md-row align-items-start align-items-md-center pt-2 pb-4">
                        <div class="col-12 col-md-8 mb-3 mb-md-0">
                            <h3 class="fw-bold mb-3">Dashboard</h3>
                            <h6 class="op-7 mb-2">All reports are displayed in this dashboard</h6>
                        </div>
                        <div
                            class="col-12 col-md-4 d-flex justify-content-start justify-content-md-end align-items-center pt-3 pt-md-0">
                            <span class="fw-bold">Application Status:</span>
                            <span class="badge ms-2" style="{{ $badgeStyle }}; font-size: 1.0rem;">
                                {{ auth()->user()->status }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-primary bubble-shadow-small">
                                            <i class="fas fa-file-upload"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Documents Submitted</p>
                                            <h4 class="card-title">{{ $totalDocuments }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-success bubble-shadow-small">
                                            <i class="fas fa-check-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Approved Documents</p>
                                            <h4 class="card-title">{{ $totalApprovedDocuments }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-danger bubble-shadow-small">
                                            <i class="fas fa-times-circle"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ms-3 ms-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Declined Documents</p>
                                            <h4 class="card-title">{{ $totalDeclinedDocuments }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card ">
                    <div class="card-body">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title fw-bold">Monitoring Checklist</h4>
                            </div>
                        </div>
                        <div class="container-fluid px-0">
                            <div class="row">
                                <div class="d-flex align-items-center">
                                    <p class="text-muted mt-2">
                                        The checklist below shows the required documents to be submitted. Checked
                                        boxes
                                        indicate the documents that have been approved by the admin, while
                                        unchecked boxes highlight incomplete requirements.
                                    </p>
                                </div>
                                @php
                                    $halfway = ceil(count($documentTypes) / 2);
                                @endphp
                                @foreach ($documentTypes as $index => $docType)
                                    <div class="col-12 col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input non-clickable-checkbox" type="checkbox"
                                                name="document_types[]" value="{{ $docType }}"
                                                id="flexCheckDefault{{ $index + 1 }}"
                                                @if (in_array($docType, $approvedDocumentTypes)) checked @endif>
                                            <label class="form-check-label" for="flexCheckDefault{{ $index + 1 }}"
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

        @include('applicant-partials.footer')
        <script src="../admin-assets/js/applicant_checklist.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script>
            const reportcardData = @json($reportcardData);
        </script>

        
</body>

</html>
