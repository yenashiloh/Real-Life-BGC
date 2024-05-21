{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Change Password</title>
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

</head> --}}


<style>
    /* .vertical-center {
        min-height: 100%;
        min-height: 100vh;
        display: flex;
        align-items: center;
    } */

    /* .clickable-icon {
        cursor: pointer;
        font-size: 24px;
        color: #71BF44;
    }

    .clickable-icon:hover {
        color: #518630;
    } */

    /* .form-select {
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
    } */
</style>    


    @php
        $personalInfo = auth()
            ->user()
            ->personalInformation()
            ->first();
    @endphp
    @include('partials.header')
    <main id="main" class="main">
        
        <section class="section profile">
            <div class="col-xl-11 mx-auto">
            <br><br>
                <div class="card ">
                    <div class="card-body">
                        <div class="tab-content pt-1">
                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <br>
                                {{-- <h5 style="font-weight: bold;"> Welcome, {{ $personalInfo->first_name ?? '' }}! </h5> --}}
                                <h5 style="font-weight: bold; font-size: 25px;">Change Password</h5>
                                <br>

                                <form action="{{ route('change.password') }}" method="POST">
                                    @csrf
                                    @if (session('success'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('success') }}
                                        </div>
                                    @endif

                                    @if (session('error'))
                                        <div class="alert alert-danger" role="alert">
                                            {{ session('error') }}
                                        </div>
                                    @endif

                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                            Password</label>
                                        <div class="col-md-8 col-lg-6">
                                            <input name="current_password" type="password" class="form-control"
                                                id="currentPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                            Password</label>
                                        <div class="col-md-8 col-lg-6">
                                            <input name="new_password" type="password" class="form-control"
                                                id="newPassword" required>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                            Password</label>
                                        <div class="col-md-8 col-lg-6">
                                            <input name="renew_password" type="password" class="form-control"
                                                id="renewPassword" required>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary" style="margin-top: 20px;">Change Password</button>
                                    </div>
                                </form><!-- End settings Form -->
                            </div>
                        </div>
                    </div>
                </div><!-- End Bordered Tabs -->
            </div>
        </section>
    </main><!-- End #main -->

    @include('partials.user-footer')
</body>

</html>
