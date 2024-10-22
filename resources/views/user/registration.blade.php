<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicons -->
    <link href="assets/img/RLlogo1.png" rel="icon">
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    {{-- <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/register.css">

</head>

<body>
    <div class="mx-auto container">

        <!-- Progress Form -->
        <form class="p-4 progress-form" action="{{ route('screening.post') }}" method="POST" id="progress-form"
            lang="en" novalidate enctype="multipart/form-data">
            @csrf
            @if ($applicationOpen)
                <!-- Step Navigation -->
                <div class="d-flex align-items-start mb-3 sm:mb-5 progress-form__tabs" role="tablist">
                    <button id="progress-form__tab-1" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-1" aria-selected="true">
                        <span class="d-block step" aria-hidden="true">Step 1 <span class="sm:d-none">of 6</span></span>
                        Eligibility, Qualifications & Requirements
                    </button>
                    <button id="progress-form__tab-2" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-2" aria-selected="false" tabindex="-1"
                        aria-disabled="true">
                        <span class="d-block step" aria-hidden="true">Step 2<span class="sm:d-none">of 6</span></span>
                        Attendance for Orientation
                    </button>
                    <button id="progress-form__tab-3" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-3" aria-selected="false" tabindex="-1"
                        aria-disabled="true">
                        <span class="d-block step" aria-hidden="true">Step 3<span class="sm:d-none">of 6</span></span>
                        Create Account
                    </button>
                    <button id="progress-form__tab-4" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-4" aria-selected="false" tabindex="-1"
                        aria-disabled="true">
                        <span class="d-block step" aria-hidden="true">Step 4 <span class="sm:d-none">of 6</span></span>
                        Personal Information
                    </button>
                    <button id="progress-form__tab-5" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-5" aria-selected="false" tabindex="-1"
                        aria-disabled="true">
                        <span class="d-block step" aria-hidden="true">Step 5 <span class="sm:d-none">of 6</span></span>
                        Academic Information
                    </button>
                    <button id="progress-form__tab-6" class="flex-1 px-0 pt-2 progress-form__tabs-item" type="button"
                        role="tab" aria-controls="progress-form__panel-6" aria-selected="false" tabindex="-1"
                        aria-disabled="true">
                        <span class="d-block step" aria-hidden="true">Step 6 <span class="sm:d-none">of
                                6</span></span>
                        Family Information
                    </button>
                </div>
                <!-- / End Step Navigation -->

                @include('user.steps.step-one')

                @include('user.steps.step-two')

                @include('user.steps.step-three')

                @include('user.steps.step-four')

                @include('user.steps.step-five')

                @include('user.steps.step-six')
        </form>
    @else
        <p>The screening form is currently closed. Please contact the admin if you need further assistance or have any
            inquiries.</p>
        @endif
        <!-- / End Progress Form -->

    </div>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>
    <script src="assets/js/registration.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        const screeningPostRoute = '{{ route('screening.post') }}';
        const verificationRoute = '{{ route('verification') }}';
    </script>
</body>

</html>
