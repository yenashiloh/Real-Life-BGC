<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets-applicant\login-assets\fonts\icomoon\style.css">
    <link rel="stylesheet" href="assets-applicant\login-assets\css\owl.carousel.min.css">
    <link href="assets/img/RLlogo1.png" rel="icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets-applicant\login-assets\css\bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Style -->
    <link rel="stylesheet" href="assets-applicant\login-assets\css\style.css">

    <title>Login</title>
</head>

<body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2"
            style="background-image: url('assets-applicant/login-assets/images/login-image.jpg');"id="loginImage"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <h3 style="text-align: center; font-weight: bold;">Login</h3>
                        <p class="mb-4" style="text-align: center;">Enter your email & password to login</p>
                        <form action="{{ route('login.post') }}" method="POST">
                            @csrf
                            @if (session('error'))
                                <div class="text-center" id="errorMessage" style="color: red; font-size: 12px;">
                                    {{ session('error') }}
                                </div>
                            @endif
                            @if (session('success'))
                                <div class="alert text-center" style="color: green; font-size: 12px;">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="form-group first mt-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" placeholder="Enter your email" name="email"
                                    id="emailInput" required>
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" placeholder="Enter your password"
                                    name="password" id="passwordInput" required>
                            </div>
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                                    <input type="checkbox" checked="checked" id="rememberedEmail">
                                    <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
                            </div>
                            <input type="submit" value="Login" class="btn btn-block ">
                            <div class="container mt-4">
                                <label class="apply_now mt-2 d-flex justify-content-center">
                                    <span class="apply_now">You want to apply? <a href="/registration">Apply
                                            Now</a></span>
                                </label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets-applicant/login-assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets-applicant/login-assets/js/popper.min.js"></script>
    <script src="assets-applicant/login-assets/js/bootstrap.min.js"></script>
    <script src="assets-applicant/login-assets/js/main.js"></script>
    
    <script src="assets/js/login.js"></script>


</body>

</html>
