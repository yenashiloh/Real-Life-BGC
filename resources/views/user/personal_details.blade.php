<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Personal Details</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('applicant-partials.link')
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
                    <h3 class="fw-bold mb-3">Personal Details</h3>
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
                            <a href="{{ route('user.change_password') }}">Personal Details</a>
                        </li>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills nav-secondary" id="pills-tab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="personal-info" data-bs-toggle="pill"
                                            href="#personal-info-tab" role="tab" aria-controls="personal-info-tab"
                                            aria-selected="true">Personal Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="academic-info" data-bs-toggle="pill"
                                            href="#academic-info-tab" role="tab" aria-controls="academic-info-tab"
                                            aria-selected="false">Academic Information</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="family-info" data-bs-toggle="pill"
                                            href="#family-info-tab" role="tab" aria-controls="family-info-tab"
                                            aria-selected="false">Family Information</a>
                                    </li>
                                </ul>
                                <form method="POST" action="{{ route('apply.again') }}" id="profile-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                        <!-- Personal Information Tab -->
                                        <div class="tab-pane fade show active" id="personal-info-tab" role="tabpanel"
                                            aria-labelledby="personal-info">
                                            <h6 class="mt-4 mb-3 mt-2"
                                                style="color: #0A6E57; font-weight: bold;">PERSONAL INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="first_name" class="form-label fw-bold">First
                                                        Name</label>
                                                    <input type="text" name="first_name" id="first_name"
                                                        class="form-control"
                                                        value="{{ $personalInfo->first_name ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="last_name" class="form-label fw-bold">Last Name</label>
                                                    <input type="text" name="last_name" id="last_name"
                                                        class="form-control"
                                                        value="{{ $personalInfo->last_name ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="contact_no" class="form-label fw-bold">Contact
                                                        Number</label>
                                                    <input type="number" name="contact" id="contact"
                                                        class="form-control" value="{{ $personalInfo->contact ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="birthdate" class="form-label fw-bold">Birthday</label>
                                                    <input type="date" name="birthday" id="birthday"
                                                        class="form-control"
                                                        value="{{ $personalInfo->birthday ?? '' }}"
                                                        max="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="house_no" class="form-label fw-bold">House
                                                        Number</label>
                                                    <input type="text" name="house_number" id="house_number"
                                                        class="form-control"
                                                        value="{{ $personalInfo->house_number ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="street" class="form-label fw-bold">Street</label>
                                                    <input type="text" name="street" id="street"
                                                        class="form-control"
                                                        value="{{ $personalInfo->street ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="barangay" class="form-label fw-bold">Barangay</label>
                                                    <input type="text" name="barangay" id="barangay"
                                                        class="form-control"
                                                        value="{{ $personalInfo->barangay ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="municipality"
                                                        class="form-label fw-bold">Municipality</label>
                                                    <input type="text" name="municipality" id="municipality"
                                                        class="form-control"
                                                        value="{{ $personalInfo->municipality ?? '' }}">
                                                </div>
                                             
                                                <div class="col-md-8">
                                                    <div class="d-flex flex-column align-items-start">
                                                        <label for="map-address" class="form-label fw-bold mb-2">Map Address: </label>
                                                        @php
                                                            $filename = basename($personalInfo->mapAddress);
                                                            $filePath = public_path('storage/map-addresses/' . $filename);
                                                            $fileUrl = asset('storage/map-addresses/' . $filename);
                                                            $isImage = in_array(strtolower(pathinfo($filename, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif']);
                                                        @endphp
                                                
                                                        @if ($isImage)
                                                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-link p-0">
                                                                <img src="{{ $fileUrl }}" alt="Map Address" class="img-fluid rounded" style="max-width: 40%; height: auto;">
                                                            </a>
                                                        @else
                                                            <a href="{{ $fileUrl }}" target="_blank" class="btn btn-link p-0">
                                                                <i class="fas fa-file-download"></i> {{ $filename }}
                                                            </a>
                                                        @endif
                                                
                                                        @if (!file_exists($filePath))
                                                            <p class="text-danger mt-2">Map Address file not found</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Academic Information Tab -->
                                        <div class="tab-pane fade" id="academic-info-tab" role="tabpanel"
                                            aria-labelledby="academic-info">
                                            <h6 class="mt-4 mb-3 mt-2"
                                                style="color: #0A6E57; font-weight: bold;">ACADEMIC INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="incomingGrade" class="form-label fw-bold">Incoming
                                                        Grade Year</label>
                                                    <select id="incoming_grade_year" name="incoming_grade_year"
                                                        class="form-select" required>
                                                        <option value="">Select grade or year level</option>
                                                        @php
                                                            $gradeOptions = [
                                                                'Grade 7',
                                                                'Grade 8',
                                                                'Grade 9',
                                                                'Grade 10',
                                                                'Grade 11',
                                                                'Grade 12',
                                                                'First Year College',
                                                                'Second Year College',
                                                                'Third Year College',
                                                            ];
                                                        @endphp
                                                        @foreach ($gradeOptions as $grade)
                                                            <option value="{{ $grade }}"
                                                                {{ isset($academicInfoData->incoming_grade_year) && $academicInfoData->incoming_grade_year == $grade ? 'selected' : '' }}>
                                                                {{ $grade }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="current_school" class="form-label fw-bold">Current
                                                        School</label>
                                                    <input type="text" name="current_school" id="current_school"
                                                        class="form-control"
                                                        value="{{ $academicInfoData->current_school }}">
                                                </div>
                                                @if (!empty($academicInfoData->current_course_program_grade))
                                                    <div class="col-12">
                                                        <label for="current_course_program_grade"
                                                            class="form-label fw-bold">Current Course Program
                                                            Grade</label>
                                                        <input type="text" name="current_course_program_grade"
                                                            id="current_course_program_grade" class="form-control"
                                                            value="{{ $academicInfoData->current_course_program_grade }}">
                                                    </div>
                                                @endif
                                            </div>

                                            <h6 class="mt-4 mb-3 mt-5"
                                                style="color: #0A6E57; font-weight: bold;">GRADES</h6>
                                            <div class="row g-3">
                                                @if (!empty($academicInfoGradesData->latestAverage))
                                                    <div class="col-12 col-md-6">
                                                        <label for="latestAverage" class="form-label fw-bold">Latest
                                                            Average</label>
                                                        <input type="text" name="latestAverage" id="latestAverage"
                                                            class="form-control"
                                                            value="{{ $academicInfoGradesData->latestAverage }}">
                                                    </div>
                                                @endif

                                                @if (!empty($academicInfoGradesData->latestGWA))
                                                    <div class="col-12 col-md-6">
                                                        <label for="latestGWA" class="form-label fw-bold">Latest
                                                            GWA</label>
                                                        <input type="text" name="latestGWA" id="latestGWA"
                                                            class="form-control"
                                                            value="{{ $academicInfoGradesData->latestGWA }}">
                                                    </div>
                                                @endif

                                                @if (!empty($academicInfoGradesData->scopeGWA))
                                                    <div class="col-12 col-md-6">
                                                        <label for="scopeGWA" class="form-label fw-bold">Scope
                                                            GWA</label>
                                                        <input type="text" name="scopeGWA" id="scopeGWA"
                                                            class="form-control"
                                                            value="{{ $academicInfoGradesData->scopeGWA }}">
                                                    </div>
                                                @endif

                                                @if (!empty($academicInfoGradesData->equivalentGrade))
                                                    <div class="col-12 col-md-6">
                                                        <label for="equivalentGrade"
                                                            class="form-label fw-bold">Equivalent Grade</label>
                                                        <input type="text" name="equivalentGrade"
                                                            id="equivalentGrade" class="form-control"
                                                            value="{{ $academicInfoGradesData->equivalentGrade }}">
                                                    </div>
                                                @endif
                                            </div>

                                            @if (
                                                !empty($academicInfoGradesData->first_choice_school) ||
                                                    !empty($academicInfoChoiceData->second_choice_school) ||
                                                    !empty($academicInfoChoiceData->third_choice_school) ||
                                                    !empty($academicInfoChoiceData->first_choice_course) ||
                                                    !empty($academicInfoChoiceData->second_choice_course) ||
                                                    !empty($academicInfoChoiceData->third_choice_course))
                                                <h6 class="mt-4 mb-3 mt-5"
                                                    style="color: #0A6E57; font-weight: bold;">SCHOOL APPLICATIONS</h6>
                                                <div class="row g-3">
                                                    @if (!empty($academicInfoChoiceData->first_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="first_choice_school"
                                                                class="form-label fw-bold">First Choice School</label>
                                                            <input type="text" name="first_choice_school"
                                                                id="first_choice_school" class="form-control"
                                                                value="{{ $academicInfoChoiceData->first_choice_school }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->second_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="second_choice_school"
                                                                class="form-label fw-bold">Second Choice School</label>
                                                            <input type="text" name="second_choice_school"
                                                                id="second_choice_school" class="form-control"
                                                                value="{{ $academicInfoChoiceData->second_choice_school }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->third_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="third_choice_school"
                                                                class="form-label fw-bold">Third Choice School</label>
                                                            <input type="text" name="third_choice_school"
                                                                id="third_choice_school" class="form-control"
                                                                value="{{ $academicInfoChoiceData->third_choice_school }}">
                                                        </div>
                                                    @endif
                                                </div>

                                                <h6 class="mt-4 mb-3 mt-5"
                                                    style="color: #0A6E57; font-weight: bold;">CHOICE COURSES</h6>
                                                <div class="row g-3">
                                                    @if (!empty($academicInfoChoiceData->first_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="first_choice_course"
                                                                class="form-label fw-bold">First Choice Course</label>
                                                            <input type="text" name="first_choice_course"
                                                                id="first_choice_course" class="form-control"
                                                                value="{{ $academicInfoChoiceData->first_choice_course }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->second_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="second_choice_course"
                                                                class="form-label fw-bold">Second Choice Course</label>
                                                            <input type="text" name="second_choice_course"
                                                                id="second_choice_course" class="form-control"
                                                                value="{{ $academicInfoChoiceData->second_choice_course }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->third_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="third_choice_course"
                                                                class="form-label fw-bold">Third Choice Course</label>
                                                            <input type="text" name="third_choice_course"
                                                                id="third_choice_course" class="form-control"
                                                                value="{{ $academicInfoChoiceData->third_choice_course }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Family Information Tab -->
                                        <div class="tab-pane fade" id="family-info-tab" role="tabpanel"
                                            aria-labelledby="family-info">
                                            <h6 class="mt-4 mb-3 mt-2"
                                                style="color: #0A6E57; font-weight: bold;">FAMILY INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="total_household_members"
                                                        class="form-label fw-bold">Total Household Members</label>
                                                    <input type="number" name="total_household_members"
                                                        id="total_household_members" class="form-control"
                                                        value="{{ $familyInfoData->total_household_members ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="payslip" class="form-label fw-bold">Payslip</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="payslip" id="payslip"
                                                            class="form-control" accept=".pdf">
                                                        @if (!empty($familyInfoData->payslip))
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <a href="{{ asset('storage/Payslips/' . $familyInfoData->payslip) }}"
                                                                        target="_blank">View Current Payslip</a>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="father_occupation" class="form-label fw-bold">Father's
                                                        Occupation</label>
                                                    <input type="text" name="father_occupation"
                                                        id="father_occupation" class="form-control"
                                                        value="{{ $familyInfoData->father_occupation ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="father_income" class="form-label fw-bold">Father's
                                                        Income</label>
                                                    <input type="number" step="0.01" name="father_income"
                                                        id="father_income" class="form-control"
                                                        value="{{ $familyInfoData->father_income ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="mother_occupation" class="form-label fw-bold">Mother's
                                                        Occupation</label>
                                                    <input type="text" name="mother_occupation"
                                                        id="mother_occupation" class="form-control"
                                                        value="{{ $familyInfoData->mother_occupation ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="mother_income" class="form-label fw-bold">Mother's
                                                        Income</label>
                                                    <input type="number" step="0.01" name="mother_income"
                                                        id="mother_income" class="form-control"
                                                        value="{{ $familyInfoData->mother_income ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="row mt-4">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success">Apply Again</button>
                                            </div>
                                        </div> --}}
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('applicant-partials.footer')

    <script></script>
