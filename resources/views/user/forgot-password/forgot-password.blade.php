<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="assets/img/RLlogo1.png" rel="icon">
    <title> Login</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets-login/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets-login/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets-login/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets-login/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets-login/css/style.css">
    <!-- End layout styles -->
 
</head>
<style>
    body {
  font-family: 'Poppins', sans-serif;
}
</style>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-5 mx-auto">
                        <div class="auth-form-light text-left p-5 pt-3 pb-3">

                            <div class="brand-logo d-flex justify-content-center align-items-center "
                                style="height: 100px; margin: 0 auto;">
                                <img src="../admin-assets/img/RLlogo.png" alt="Brand Logo" class="img-fluid"
                                    style="max-height: 100%; max-width: 100%;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center">
                                <h4 class="font-weight-bold mb-4 "
                                    style="font-family: 'Poppins', sans-serif; font-weight:bold;">Forgot Password?
                                </h4>
                               
                            </div>
                            <p class="text-center">Enter your email address and we'll send you a link to reset your password.</p>
                            <form action="{{ route('send-reset-link') }}" method="POST">
                                @csrf
                                @if (session('error'))
                                    <div class="alert text-center mb-3" style="color: red; font-size: 13px;">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (session('success'))
                                    <div class="alert text-center mb-3" style="color: green; font-size: 13px;">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="email" class="mt-3 fw-bold">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg"
                                        placeholder="Enter your email address" id="emailInput" required>
                                </div>
                                
                                <!-- Submit Button -->
                                <div class="mt-3 d-grid gap-2">
                                    <input type="submit" value="Request Reset Link"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                </div>
                            
                                <!-- Apply Now Text -->
                                <div class="form-group text-center mt-4">
                                    <span class="apply_now" style="font-size: 14px;">
                                        <a href="/login" style="font-size: 14px;">Back to Login</a>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <script src="../../assets-login/vendors/js/vendor.bundle.base.js"></script>
    <script src="../../assets-login/js/off-canvas.js"></script>
    <script src="../../assets-login/js/misc.js"></script>
    <script src="../../assets-login/js/settings.js"></script>
    <script src="../../assets-login/js/todolist.js"></script>
    <script src="../../assets-login/js/jquery.cookie.js"></script>
    <script src="assets/js/login.js"></script>
    <!-- endinject -->
</body>

</html>
