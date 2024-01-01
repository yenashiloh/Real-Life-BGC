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
            <div class="col-xl-12">
                <div class="card ">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit" style="font-size: 19px; cursor: auto;">
                                    Profile Details</button>
                            </li>                 
                        </ul>
                        <div class="tab-content pt-1">
                            @include('user.profile_edit')
                        </div>
                     </div><!-- End Bordered Tabs -->
                 </div>
             </div>
        </div>
    </section>
</main><!-- End #main -->
@include('partials.user-footer')

</body>

</html>
