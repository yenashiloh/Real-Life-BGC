{{-- @include('partials.header')


<body>
    @php
        $personalInfo = auth()
            ->user()
            ->personalInformation()
            ->first();
    @endphp
    <main id="main" class="main">
        <section class="section profile">
            <div class="col-xl-10 mx-auto">
                    <div class="tab-content pt-1">
                          <!-- Profile Edit Form -->
                          <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <form method="POST" action="{{ route('update_personal_details') }}" id="profile-form">
                                @csrf
                                @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show d-flex justify-content-center" role="alert" style="width: 30%; margin: 0 auto;">
                                    <span class="text-center" style="width: 100%; color: #155724; " >{{ session('success') }}</span>
                                </div>
                                
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error" >
                                        <span class="text-center" style="width: 100%; color: #ad0b0b; " >{{ session('error') }}
                                    </div>
                                @endif

                                <br><br><br>
                                <div class="row mb-3">
                                   
                                    <h5 class="card-title" style="font-weight: bold;  color: #212529;">Personal
                                        Information</h5>
                                    <div class="col-md-6 form__field">
                                        <label for="first_name" class="col-form-label" style="font-weight: normal;">First Name</label>
                                        <input name="first_name" type="text" class="form-control" id="first_name"
                                            value="{{ $personalInfo->first_name ?? '' }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="last_name" class="col-form-label" style="font-weight: normal;">Last Name</label>
                                        <input name="last_name" type="text" class="form-control" id="last_name"
                                            value="{{ $personalInfo->last_name ?? '' }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="contact_no" class="col-form-label" style="font-weight: normal;">Contact Number</label>
                                        <input name="contact_no" type="number" class="form-control" id="contact_no"
                                            value="{{ $personalInfo->contact ?? '' }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="birthdate" class="col-form-label" style="font-weight: normal;">Birthdate</label>
                                        <input name="birthdate" type="date" class="form-control" id="birthdate"
                                            value="{{ $personalInfo->birthday ?? '' }}" max="{{ date('Y-m-d') }}e">
                                    </div>

                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="house_no" class="col-form-label" style="font-weight: normal;">House Number</label>
                                        <input name="house_no" type="text" class="form-control" id="house_no"
                                            value="{{ $personalInfo->house_number ?? '' }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="street" class="col-form-label" style="font-weight: normal;">Street</label>
                                        <input name="street" type="text" class="form-control" id="street"
                                            value="{{ $personalInfo->street ?? '' }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="barangay" class="col-form-label" style="font-weight: normal;">Barangay</label>
                                        <input name="barangay" type="text" class="form-control" id="barangay"
                                            value="{{ $personalInfo->barangay ?? '' }}">
                                    </div>

                                    <div class="col-md-6">
                                        <label for="municipality" class="col-form-label" style="font-weight: normal;">Municipality</label>
                                        <input name="municipality" type="text" class="form-control" id="municipality"
                                            value="{{ $personalInfo->municipality ?? '' }}">
                                    </div>
                                </div>
                                <br>

                                <div class="row mb-3">
                                    <h5 class="card-title" style="font-weight: bold; color:#212529;">Academic Information</h5>

                                    <div class="col-md-6">
                                        <label for="incoming_grade" class="col-form-label" style="font-weight: normal;">Incoming
                                            Grade</label>
                                        <select name="incoming_grade" class="form-select" id="incoming_grade" disabled>
                                            <option value="" style="color#212529;">Select incoming grade</option>
                                            @foreach (['Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12', 'First Year College', 'Second Year College', 'Third Year College', 'Fourth Year College'] as $grade)
                                                <option value="{{ $grade }}"
                                                    {{ isset($academicInfoData) && $academicInfoData->incoming_grade_year === $grade ? 'selected' : '' }}>
                                                    {{ $grade }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="current_school" class="col-form-label" style="font-weight: normal;">Current
                                            School</label>
                                        <input name="current_school" type="text" class="form-control" id="current_school"
                                            value="{{ $academicInfoData->current_school }}">
                                    </div>

                                    @if (!empty($academicInfoData->current_course_program_grade))
                                        <div class="col-md-6" style="margin-top: 10px;">
                                            <label for="current_course" class="col-form-label" style="font-weight: normal;">Current Course
                                                or Program</label>
                                            <input name="current_course_program_grade" type="text" class="form-control"
                                                id="current_course" value="{{ $academicInfoData->current_course_program_grade }}">
                                        </div>
                                    @endif

                                </div>

                                @if (!empty($academicInfoChoiceData->first_choice_school) || !empty($academicInfoChoiceData->second_choice_school) || !empty($academicInfoChoiceData->third_choice_school))
                                    <br>
                                    <div class="row mb-3">
                                        <h5 class="card-title" style="font-weight: bold; color:#212529;">School Application</h5>
                                        @if (!empty($academicInfoChoiceData->first_choice_school))
                                            <div class="col-md-4">
                                                <label for="first_choice_school" class="col-form-label" style="font-weight: normal;">First
                                                    Choice School</label>
                                                <input name="first_choice_school" type="text" class="form-control"
                                                    id="first_choice_school" value="{{ $academicInfoChoiceData->first_choice_school }}">
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->second_choice_school))
                                            <div class="col-md-4">
                                                <label for="second_choice_school" class="col-form-label" style="font-weight: normal;">Second
                                                    Choice School</label>
                                                <input name="second_choice_school" type="text" class="form-control"
                                                    id="second_choice_school" value="{{ $academicInfoChoiceData->second_choice_school }}">
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->third_choice_school))
                                            <div class="col-md-4">
                                                <label for="third_choice_school" class="col-form-label" style="font-weight: normal;">Third
                                                    Choice School</label>
                                                <input name="third_choice_school" type="text" class="form-control"
                                                    id="third_choice_school" value="{{ $academicInfoChoiceData->third_choice_school }}">
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if (!empty($academicInfoChoiceData->first_choice_course) || !empty($academicInfoChoiceData->second_choice_course) || !empty($academicInfoChoiceData->third_choice_course))
                                    <br>
                                    <div class="row mb-3">
                                        <h5 class="card-title" style="font-weight: bold; color:#212529;">Choice Courses</h5>
                                        @if (!empty($academicInfoChoiceData->first_choice_course))
                                            <div class="col-md-4">
                                                <label for="first_choice_course" class="col-form-label" style="font-weight: normal;">First
                                                    Choice Course</label>
                                                <input name="first_choice_course" type="text" class="form-control"
                                                    id="first_choice_course" value="{{ $academicInfoChoiceData->first_choice_course }}">
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->second_choice_course))
                                            <div class="col-md-4">
                                                <label for="second_choice_course" class="col-form-label" style="font-weight: normal;">Second
                                                    Choice Course</label>
                                                <input name="second_choice_course" type="text" class="form-control"
                                                    id="second_choice_course" value="{{ $academicInfoChoiceData->second_choice_course }}">
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->third_choice_course))
                                            <div class="col-md-4">
                                                <label for="third_choice_course" class="col-form-label" style="font-weight: normal;">Third
                                                    Choice Course</label>
                                                <input name="third_choice_course" type="text" class="form-control"
                                                    id="third_choice_course" value="{{ $academicInfoChoiceData->third_choice_course }}">
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                <br> --}}

{{-- <div class="row mb-3">
                                    <h5 class="card-title" style="font-weight: bold; color:#212529;">Grades</h5>

                                    @php
                                        $gwaFields = [
                                            'grade_3_gwa' => 'Grade 3 GWA',
                                            'grade_4_gwa' => 'Grade 4 GWA',
                                            'grade_5_gwa' => 'Grade 5 GWA',
                                            'grade_6_gwa' => 'Grade 6 GWA',
                                            'grade_7_gwa' => 'Grade 7 GWA',
                                            'grade_8_gwa' => 'Grade 8 GWA',
                                            'grade_9_gwa' => 'Grade 9 GWA',
                                            'grade_10_gwa' => 'Grade 10 GWA',
                                            'grade_11_sem1_gwa' => 'Grade 11 First Sem GWA',
                                            'grade_11_sem2_gwa' => 'Grade 11 Second Sem GWA',
                                            'grade_11_sem3_gwa' => 'Grade 11 Third Sem GWA',
                                            'grade_12_sem1_gwa' => 'Grade 12 First Sem GWA',
                                            'grade_12_sem2_gwa' => 'Grade 12 Second Sem GWA',
                                            'grade_12_sem3_gwa' => 'Grade 12 Third Sem GWA',
                                            '1st_year_sem1_gwa' => '1st Year First Sem GWA',
                                            '1st_year_sem2_gwa' => '1st Year Second Sem GWA',
                                            '1st_year_sem3_gwa' => '1st Year Third Sem GWA',
                                            '1st_year_sem4_gwa' => '1st Year Fourth Sem GWA',
                                            '2nd_year_sem1_gwa' => '2nd Year First Sem GWA',
                                            '2nd_year_sem2_gwa' => '2nd Year Second Sem GWA',
                                            '2nd_year_sem3_gwa' => '2nd Year Third Sem GWA',
                                            '2nd_year_sem4_gwa' => '2nd Year Fourth Sem GWA',
                                        ];
                                    @endphp

                                    @foreach ($gwaFields as $fieldName => $label)
                                        @if (!empty($academicInfoGradesData->$fieldName))
                                            <div class="col-md-4 mb-3">
                                                <label for="{{ $fieldName }}" class="col-form-label"
                                                    style="font-weight: normal;">{{ $label }}</label>
                                                <input name="{{ $fieldName }}" type="number" class="form-control gwa-input"
                                                    id="{{ $fieldName }}" value="{{ $academicInfoGradesData->$fieldName }}"
                                                    style="margin-bottom: 10px;">
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <br> --}}

{{-- @foreach ($members as $key => $member)
                                <div class="row mb-3">
                                
                                    <h5 class="card-title" style="font-weight: bold; color: #212529;">Family Information</h5>
                                    <h6 class="card-title" style="font-weight: medium; color: #212529; margin-top:20px;">Family Member Employed {{ $key + 1 }}</h6>
                                    <div class="col-md-6">
                                        <label for="name{{ $key + 1 }}" class="col-form-label" style="font-weight: normal;">Name</label>
                                        <input name="name[]" type="text" class="form-control" id="name{{ $key + 1 }}" value="{{ $member['name'] ?? '' }}" >
                                    </div>
                            
                                    <div class="col-md-6">
                                        <label for="occupation{{ $key + 1 }}" class="col-form-label" style="font-weight: normal;">Occupation</label>
                                        <input name="occupation[]" type="text" class="form-control" id="occupation{{ $key + 1 }}" value="{{ $member['occupation'] ?? '' }}" >
                                    </div>
                                </div>
                            
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="relationship{{ $key + 1 }}" class="col-form-label" style="font-weight: normal;">Relationship</label>
                                        <input name="relationship[]" type="text" class="form-control" id="relationship{{ $key + 1 }}" value="{{ $member['relationship'] ?? '' }}" >
                                    </div>
                            
                                    <div class="col-md-6">
                                        <label for="monthly_income{{ $key + 1 }}" class="col-form-label" style="font-weight: normal;">Monthly Income</label>
                                        <input name="monthly_income[]" type="number" class="form-control" id="monthly_income{{ $key + 1 }}" value="{{ $member['monthly_income'] ?? '' }}" >
                                    </div>
                                </div>
                                <br>
                            @endforeach
                            </div> --}}
{{-- <div class="text-center">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 13px;" id="save-changes-btn"
                                        {{ auth()->user()->status !== 'Sent' || in_array(auth()->user()->status, ['Under Review', 'Shortlisted', 'For Interview', 'For House Visitation', 'Declined']) ? 'disabled' : '' }}>Save
                                        Changes</button>
                                </div>
                            </form><!-- End Profile Edit Form -->
                        </div>
                        </div>
                     </div><!-- End Bordered Tabs -->
                 </div>
             </div>
        </div>
    </section>
</main><!-- End #main --> --}}
{{-- @include('partials.header')
<style>
    .card-title {
        font-size: 20px;
    }
</style>

<body>
    @php
        $personalInfo = auth()->user()->personalInformation()->first();
    @endphp
    <main id="main" class="main">
        <section class="section profile">
            <div class="col-xl-10 mx-auto">
                <div class="tab-content pt-1">
                    <!-- Profile Edit Form -->
                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <form method="POST" action="{{ route('update_personal_details') }}" id="profile-form">
                            @csrf
                            <br>
                            <!-- Personal Information Card -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold; color: #212529;">Personal
                                        Information</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6 form__field">
                                            <label for="first_name" class="col-form-label"
                                                style="font-weight: bold;">First Name</label>
                                            <div class="value">{{ $personalInfo->first_name ?? '' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name" class="col-form-label"
                                                style="font-weight: bold;">Last Name</label>
                                            <div class="value">{{ $personalInfo->last_name ?? '' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="contact_no" class="col-form-label"
                                                style="font-weight: bold;">Contact Number</label>
                                            <div class="value">{{ $personalInfo->contact ?? '' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="birthdate" class="col-form-label"
                                                style="font-weight: bold;">Birthdate</label>
                                            <div class="value">
                                                {{ !empty($personalInfo->birthday) ? date('F d, Y', strtotime($personalInfo->birthday)) : '' }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="house_no" class="col-form-label"
                                                style="font-weight: bold;">House Number</label>
                                            <div class="value">{{ $personalInfo->house_number ?? '' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="street" class="col-form-label"
                                                style="font-weight: bold;">Street</label>
                                            <div class="value">{{ $personalInfo->street ?? '' }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="barangay" class="col-form-label"
                                                style="font-weight: bold;">Barangay</label>
                                            <div class="value">{{ $personalInfo->barangay ?? '' }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="municipality" class="col-form-label"
                                                style="font-weight: bold;">Municipality</label>
                                            <div class="value">{{ $personalInfo->municipality ?? '' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Academic Information Card -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold; color:#212529;">Academic
                                        Information</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="current_school" class="col-form-label"
                                                style="font-weight: bold;">Current School</label>
                                            <div class="value">{{ $academicInfoData['current_school'] }}</div>
                                        </div>
                                        @if (!empty($academicInfoData['current_course_program_grade']))
                                            <div class="col-md-6">
                                                <label for="current_course" class="col-form-label"
                                                    style="font-weight: bold;">Current Course or Program</label>
                                                <div class="value">
                                                    {{ $academicInfoData['current_course_program_grade'] }}</div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoGradesData['latestAverage']))
                                            <div class="col-md-6">
                                                <label for="current_course" class="col-form-label"
                                                    style="font-weight: bold;">Latest Average</label>
                                                <div class="value">{{ $academicInfoGradesData['latestAverage'] }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoGradesData['latestGWA']))
                                            <div class="col-md-6">
                                                <label for="current_course" class="col-form-label"
                                                    style="font-weight: bold;">Latest General Weighted Average</label>
                                                <div class="value">{{ $academicInfoGradesData['latestGWA'] }}</div>
                                            </div>
                                        @endif
                                        <div class="col-md-6">
                                            <label for="current_school" class="col-form-label"
                                                style="font-weight: bold;">Scope General Average/GWA</label>
                                            <div class="value">{{ $academicInfoGradesData['scopeGWA'] }}</div>
                                        </div>
                                        @if (!empty($academicInfoGradesData['equivalentGrade']))
                                            <div class="col-md-6">
                                                <label for="current_course" class="col-form-label"
                                                    style="font-weight: bold;">Latest General Weighted Average</label>
                                                <div class="value">
                                                    {{ number_format($academicInfoGradesData['equivalentGrade'], 0) }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <!-- School Application and Choice Courses Card -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold; color:#212529;">School Application
                                        and Choice Courses</h5>
                                    <div class="row mb-3">
                                        @if (!empty($academicInfoChoiceData->first_choice_school))
                                            <div class="col-md-6 mb-3">
                                                <label for="first_choice_school" class="col-form-label"
                                                    style="font-weight: bold;">First Choice School</label>
                                                <div class="value">{{ $academicInfoChoiceData->first_choice_school }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->first_choice_course))
                                            <div class="col-md-6 mb-3">
                                                <label for="first_choice_course" class="col-form-label"
                                                    style="font-weight: bold;">First Choice Course</label>
                                                <div class="value">{{ $academicInfoChoiceData->first_choice_course }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->second_choice_school))
                                            <div class="col-md-6 mb-3">
                                                <label for="second_choice_school" class="col-form-label"
                                                    style="font-weight: bold;">Second Choice School</label>
                                                <div class="value">
                                                    {{ $academicInfoChoiceData->second_choice_school }}</div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->second_choice_course))
                                            <div class="col-md-6 mb-3">
                                                <label for="second_choice_course" class="col-form-label"
                                                    style="font-weight: bold;">Second Choice Course</label>
                                                <div class="value">
                                                    {{ $academicInfoChoiceData->second_choice_course }}</div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->third_choice_school))
                                            <div class="col-md-6 mb-3">
                                                <label for="third_choice_school" class="col-form-label"
                                                    style="font-weight: bold;">Third Choice School</label>
                                                <div class="value">{{ $academicInfoChoiceData->third_choice_school }}
                                                </div>
                                            </div>
                                        @endif
                                        @if (!empty($academicInfoChoiceData->third_choice_course))
                                            <div class="col-md-6 mb-3">
                                                <label for="third_choice_course" class="col-form-label"
                                                    style="font-weight: bold;">Third Choice Course</label>
                                                <div class="value">{{ $academicInfoChoiceData->third_choice_course }}
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Family Information -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-weight: bold; color: #212529;">Family
                                        Information</h5>
                                    <div class="row mb-3">
                                        <div class="col-md-6 form__field">
                                            <label for="total_household_members" class="col-form-label"
                                                style="font-weight: bold;">Total Household Members</label>
                                            <div class="value">{{ $familyInfoData['total_household_members'] }}</div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="father_occupation" class="col-form-label"
                                                style="font-weight: bold;">Father's Occupation</label>
                                            <div class="value">{{ $familyInfoData['father_occupation'] }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="father_income" class="col-form-label"
                                                style="font-weight: bold;">Father's Income</label>
                                            <div class="value">{{ number_format($familyInfoData['father_income']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="mother_occupation" class="col-form-label"
                                                style="font-weight: bold;">Mother's occupation</label>
                                            <div class="value">{{ $familyInfoData['mother_occupation'] }}</div>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="mother_income" class="col-form-label"
                                                style="font-weight: bold;">Mother's Income</label>
                                            <div class="value">{{ number_format($familyInfoData['mother_income']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="total_support_received" class="col-form-label"
                                                style="font-weight: bold;">Total Support Received</label>
                                            <div class="value">
                                                {{ number_format($familyInfoData['total_support_received']) }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </section>
    </main>
    <br><br>
    @include('partials.user-footer')

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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

    document.querySelectorAll('.alert .btn-close').forEach(function(closeBtn) {
        closeBtn.addEventListener('click', function() {
            this.parentNode.style.display = 'none';
        });
    });

    $(document).ready(function() {
        var initialData = $('#profile-form').serialize();

        function checkFormChanges() {
            var currentData = $('#profile-form').serialize();
            $('#save-changes-btn').prop('disabled', currentData === initialData);
        }

        if ("{{ auth()->user()->status }}" === "Sent") {
            $('#profile-form :input').on('input', function() {
                checkFormChanges();
            });
        } else {
            $('#save-changes-btn').prop('disabled', true);
        }

        if ("{{ auth()->user()->status }}" === "Sent") {
            checkFormChanges();
        }

        var successAlert = $('.alert-success');
        if (successAlert.length) {
            setTimeout(function() {
                successAlert.alert('close');
            }, 8000);
        }

    });
    $(document).ready(function() {
        $('#profile-form').submit(function(event) {
            var emptyFields = [];
            $('input[type="text"], input[type="number"]').each(function() {
                if ($(this).val() === '') {
                    emptyFields.push($(this).attr('name'));
                }
            });

            if ($('#birthdate').val() === '') {
                emptyFields.push('birthdate');
            }

            if (emptyFields.length > 0) {
                event.preventDefault();

                $('.alert').remove();

                var errorMessage = (emptyFields.length === 1 && emptyFields.includes('birthdate')) ?
                    'Birthdate should not be empty.' : 'The field(s) should not be empty.';
                var alertElement = $(
                    '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert" style="width: 30%; margin: 0 auto;"></div>'
                );
                alertElement.html(errorMessage);
                $('#profile-edit').prepend(alertElement);

                setTimeout(function() {
                    alertElement.alert('close');
                }, 10000);
            } else {
                var birthdate = new Date($('#birthdate').val());
                var today = new Date();
                var age = today.getFullYear() - birthdate.getFullYear();
                var birthMonth = birthdate.getMonth();
                var currentMonth = today.getMonth();

                if (currentMonth < birthMonth || (currentMonth === birthMonth && today.getDate() <
                        birthdate.getDate())) {
                    age--;
                }

                if (age < 12 || age > 25) {
                    event.preventDefault();

                    $('.alert').remove();

                    var ageAlert = $(
                        '<div class="alert alert-danger alert-dismissible fade show d-flex align-items-center justify-content-center" role="alert" style="width: 50%; margin: 0 auto;"></div>'
                    );
                    ageAlert.html('The age requirement should be 25 years old or below.');
                    $('#profile-edit').prepend(ageAlert);

                    setTimeout(function() {
                        ageAlert.alert('close');
                    }, 10000);
                }
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const form = document.getElementById("profile-form");
        form.addEventListener("submit", function(event) {
            const inputs = document.querySelectorAll(".gwa-input");
            let error = false;

            inputs.forEach(function(input) {
                const gwa = parseFloat(input.value);

                if (gwa < 87 || gwa > 100 || isNaN(gwa)) {
                    error = true;
                }
            });

            if (error) {
                event.preventDefault();
                const errorMessage =
                    "The Grade Weighted Average (GWA) should fall within the range of 88 to 100. ";
                const errorAlert = document.querySelector(".alert.alert-danger");

                if (errorAlert) {
                    errorAlert.innerHTML = errorMessage;
                } else {
                    const errorDiv = document.createElement("div");
                    errorDiv.classList.add("alert", "alert-danger", "alert-dismissible", "fade",
                        "show");
                    errorDiv.setAttribute("role", "alert");
                    errorDiv.innerHTML = `${errorMessage}`;
                    form.insertBefore(errorDiv, form.firstChild);
                }
            }
        });
    });
</script> --}}


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
                                <form method="POST" action="{{ route('apply.again') }}" id="profile-form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="tab-content mt-2 mb-3" id="pills-tabContent">
                                        <!-- Personal Information Tab -->
                                        <div class="tab-pane fade show active" id="personal-info-tab" role="tabpanel" aria-labelledby="personal-info">
                                            <h6 class="mt-4 mb-3 text-success mt-2"  style="color: #0A6E57; font-weight: bold;">PERSONAL INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="first_name" class="form-label fw-bold">First Name</label>
                                                    <input type="text" name="first_name" id="first_name" class="form-control" value="{{ $personalInfo->first_name ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="last_name" class="form-label fw-bold">Last Name</label>
                                                    <input type="text" name="last_name" id="last_name" class="form-control" value="{{ $personalInfo->last_name ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="contact_no" class="form-label fw-bold">Contact Number</label>
                                                    <input type="number" name="contact" id="contact" class="form-control" value="{{ $personalInfo->contact ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="birthdate" class="form-label fw-bold">Birthday</label>
                                                    <input type="date" name="birthday" id="birthday" class="form-control" value="{{ $personalInfo->birthday ?? '' }}" max="{{ date('Y-m-d') }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="house_no" class="form-label fw-bold">House Number</label>
                                                    <input type="text" name="house_number" id="house_number" class="form-control" value="{{ $personalInfo->house_number ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="street" class="form-label fw-bold">Street</label>
                                                    <input type="text" name="street" id="street" class="form-control" value="{{ $personalInfo->street ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="barangay" class="form-label fw-bold">Barangay</label>
                                                    <input type="text" name="barangay" id="barangay" class="form-control" value="{{ $personalInfo->barangay ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="municipality" class="form-label fw-bold">Municipality</label>
                                                    <input type="text" name="municipality" id="municipality" class="form-control" value="{{ $personalInfo->municipality ?? '' }}">
                                                </div>
                                                <div class="col-12">
                                                    <label for="mapAddress" class="form-label fw-bold">Google Map Address</label>
                                                    <input type="file" class="form-control" id="mapAddress" name="mapAddress">
                                                </div>
                                                <div class="col-12">
                                                    @php
                                                        $filename = basename($personalInfo->mapAddress);
                                                        $imagePath = public_path('storage/map-addresses/' . $filename);
                                                        $imageUrl = asset('storage/map-addresses/' . $filename);
                                                    @endphp
                                                    <a href="{{ $imageUrl }}" target="_blank">
                                                        <img src="{{ $imageUrl }}" alt="Map Address" class="img-fluid rounded" style="max-width: 40%; height: auto;">
                                                    </a>
                                                    @if (!file_exists($imagePath))
                                                        <p class="text-danger mt-2">Map Address image file not found</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                
                                        <!-- Academic Information Tab -->
                                        <div class="tab-pane fade" id="academic-info-tab" role="tabpanel" aria-labelledby="academic-info">
                                            <h6 class="mt-4 mb-3 text-success mt-2"  style="color: #0A6E57; font-weight: bold;">ACADEMIC INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="incomingGrade" class="form-label fw-bold">Incoming Grade Year</label>
                                                    <select id="incoming_grade_year" name="incoming_grade_year" class="form-select" required>
                                                        <option value="">Select grade or year level</option>
                                                        @php
                                                            $gradeOptions = [
                                                                'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12',
                                                                'First Year College', 'Second Year College', 'Third Year College',
                                                            ];
                                                        @endphp
                                                        @foreach ($gradeOptions as $grade)
                                                            <option value="{{ $grade }}" {{ isset($academicInfoData->incoming_grade_year) && $academicInfoData->incoming_grade_year == $grade ? 'selected' : '' }}>
                                                                {{ $grade }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="current_school" class="form-label fw-bold">Current School</label>
                                                    <input type="text" name="current_school" id="current_school" class="form-control" value="{{ $academicInfoData->current_school }}">
                                                </div>
                                                @if (!empty($academicInfoData->current_course_program_grade))
                                                    <div class="col-12">
                                                        <label for="current_course_program_grade" class="form-label fw-bold">Current Course Program Grade</label>
                                                        <input type="text" name="current_course_program_grade" id="current_course_program_grade" class="form-control" value="{{ $academicInfoData->current_course_program_grade }}">
                                                    </div>
                                                @endif
                                            </div>
                                
                                            <h6 class="mt-4 mb-3 text-success mt-5"  style="color: #0A6E57; font-weight: bold;">GRADES</h6>
                                            <div class="row g-3">
                                                @if (!empty($academicInfoGradesData->latestAverage))
                                                    <div class="col-12 col-md-6">
                                                        <label for="latestAverage" class="form-label fw-bold">Latest Average</label>
                                                        <input type="text" name="latestAverage" id="latestAverage" class="form-control" value="{{ $academicInfoGradesData->latestAverage }}">
                                                    </div>
                                                @endif
                                        
                                                @if (!empty($academicInfoGradesData->latestGWA))
                                                    <div class="col-12 col-md-6">
                                                        <label for="latestGWA" class="form-label fw-bold">Latest GWA</label>
                                                        <input type="text" name="latestGWA" id="latestGWA" class="form-control" value="{{ $academicInfoGradesData->latestGWA }}">
                                                    </div>
                                                @endif
                                        
                                                @if (!empty($academicInfoGradesData->scopeGWA))
                                                    <div class="col-12 col-md-6">
                                                        <label for="scopeGWA" class="form-label fw-bold">Scope GWA</label>
                                                        <input type="text" name="scopeGWA" id="scopeGWA" class="form-control" value="{{ $academicInfoGradesData->scopeGWA }}">
                                                    </div>
                                                @endif
                                        
                                                @if (!empty($academicInfoGradesData->equivalentGrade))
                                                    <div class="col-12 col-md-6">
                                                        <label for="equivalentGrade" class="form-label fw-bold">Equivalent Grade</label>
                                                        <input type="text" name="equivalentGrade" id="equivalentGrade" class="form-control" value="{{ $academicInfoGradesData->equivalentGrade }}">
                                                    </div>
                                                @endif
                                            </div>

                                            @if (!empty($academicInfoGradesData->first_choice_school) || !empty($academicInfoChoiceData->second_choice_school) || !empty($academicInfoChoiceData->third_choice_school) || !empty($academicInfoChoiceData->first_choice_course) || !empty($academicInfoChoiceData->second_choice_course) || !empty($academicInfoChoiceData->third_choice_course))
                                                <h6 class="mt-4 mb-3 text-success mt-5"  style="color: #0A6E57; font-weight: bold;">SCHOOL APPLICATIONS</h6>
                                                <div class="row g-3">
                                                    @if (!empty($academicInfoChoiceData->first_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="first_choice_school" class="form-label fw-bold">First Choice School</label>
                                                            <input type="text" name="first_choice_school" id="first_choice_school" class="form-control" value="{{ $academicInfoChoiceData->first_choice_school }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->second_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="second_choice_school" class="form-label fw-bold">Second Choice School</label>
                                                            <input type="text" name="second_choice_school" id="second_choice_school" class="form-control" value="{{ $academicInfoChoiceData->second_choice_school }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->third_choice_school))
                                                        <div class="col-12 col-md-6">
                                                            <label for="third_choice_school" class="form-label fw-bold">Third Choice School</label>
                                                            <input type="text" name="third_choice_school" id="third_choice_school" class="form-control" value="{{ $academicInfoChoiceData->third_choice_school }}">
                                                        </div>
                                                    @endif
                                                </div>
                                
                                                <h6 class="mt-4 mb-3 text-success mt-5"  style="color: #0A6E57; font-weight: bold;">CHOICE COURSES</h6>
                                                <div class="row g-3">
                                                    @if (!empty($academicInfoChoiceData->first_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="first_choice_course" class="form-label fw-bold">First Choice Course</label>
                                                            <input type="text" name="first_choice_course" id="first_choice_course" class="form-control" value="{{ $academicInfoChoiceData->first_choice_course }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->second_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="second_choice_course" class="form-label fw-bold">Second Choice Course</label>
                                                            <input type="text" name="second_choice_course" id="second_choice_course" class="form-control" value="{{ $academicInfoChoiceData->second_choice_course }}">
                                                        </div>
                                                    @endif
                                                    @if (!empty($academicInfoChoiceData->third_choice_course))
                                                        <div class="col-12 col-md-6">
                                                            <label for="third_choice_course" class="form-label fw-bold">Third Choice Course</label>
                                                            <input type="text" name="third_choice_course" id="third_choice_course" class="form-control" value="{{ $academicInfoChoiceData->third_choice_course }}">
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                
                                        <!-- Family Information Tab -->
                                        <div class="tab-pane fade" id="family-info-tab" role="tabpanel" aria-labelledby="family-info">
                                            <h6 class="mt-4 mb-3 text-success mt-2"  style="color: #0A6E57; font-weight: bold;">FAMILY INFORMATION</h6>
                                            <div class="row g-3">
                                                <div class="col-12 col-md-6">
                                                    <label for="total_household_members" class="form-label fw-bold">Total Household Members</label>
                                                    <input type="number" name="total_household_members" id="total_household_members" class="form-control" value="{{ $familyInfoData->total_household_members ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="payslip" class="form-label fw-bold">Payslip</label>
                                                    <div class="input-group mb-3">
                                                        <input type="file" name="payslip" id="payslip" class="form-control" accept=".pdf">
                                                        @if (!empty($familyInfoData->payslip))
                                                            <div class="input-group-append">
                                                                <span class="input-group-text">
                                                                    <a href="{{ asset('storage/Payslips/' . $familyInfoData->payslip) }}" target="_blank">View Current Payslip</a>
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    
                              
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="father_occupation" class="form-label fw-bold">Father's Occupation</label>
                                                    <input type="text" name="father_occupation" id="father_occupation" class="form-control" value="{{ $familyInfoData->father_occupation ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="father_income" class="form-label fw-bold">Father's Income</label>
                                                    <input type="number" step="0.01" name="father_income" id="father_income" class="form-control" value="{{ $familyInfoData->father_income ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="mother_occupation" class="form-label fw-bold">Mother's Occupation</label>
                                                    <input type="text" name="mother_occupation" id="mother_occupation" class="form-control" value="{{ $familyInfoData->mother_occupation ?? '' }}">
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <label for="mother_income" class="form-label fw-bold">Mother's Income</label>
                                                    <input type="number" step="0.01" name="mother_income" id="mother_income" class="form-control" value="{{ $familyInfoData->mother_income ?? '' }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-success">Apply Again</button>
                                            </div>
                                        </div>
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
