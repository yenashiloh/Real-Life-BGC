<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Verification</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets-applicant/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/style.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/header.css" type="text/css">
    <link rel="stylesheet" href="assets-applicant/css/footer.css" type="text/css">

    <!-- Favicons -->
    <link href="assets/img/RLlogo1.png" rel="icon">
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">
</head>

<body style="background-color: #fafafa;">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; padding: 20px;">
        <div class="card text-center" style="padding: 20px;">
            <div class="card-body">
                <img src="../assets-applicant/img/successfully_sent.png" class="img-fluid" alt="Successfully Sent Image"
                    style="max-width: 30%; height: auto;">
                <h1>Email Verification Success</h1>
                <p style="padding: 10px; font-size: 20px;" class="education-assistance f-para">{{ $message }}</p>
                <a href="{{ route('login') }}" class="btn"
                    style="background-color: #71BF44; color:white; display: inline-block; padding: 8px 16px; text-decoration: none; text-align: center;">Go
                    to Login</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets-applicant/js/jquery-3.3.1.min.js"></script>
    <script src="assets-applicant/js/bootstrap.min.js"></script>
    <script src="assets-applicant/js/jquery.magnific-popup.min.js"></script>
    <script src="assets-applicant/js/jquery.nice-select.min.js"></script>
    <script src="assets-applicant/js/jquery-ui.min.js"></script>
    <script src="assets-applicant/js/jquery.slicknav.js"></script>
    <script src="assets-applicant/js/owl.carousel.min.js"></script>
    <script src="assets-applicant/js/main.js"></script>
</body>

</html>
