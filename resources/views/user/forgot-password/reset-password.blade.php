<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="../../assets/img/RLlogo1.png" rel="icon">
    <title>Reset Password</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets-login/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets-login/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets-login/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets-login/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets-login/css/style.css">
    <!-- End layout styles -->
    <style>

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left p-5 pt-3 pb-3">

                            <div class="brand-logo d-flex justify-content-center align-items-center "
                                style="height: 100px; margin: 0 auto;">
                                <img src="../../admin-assets/img/RLlogo.png" alt="Brand Logo" class="img-fluid"
                                    style="max-height: 100%; max-width: 100%;">
                            </div>
                            <div class="d-flex flex-column justify-content-center align-items-center">
                                <h4 class="font-weight-bold mb-4" style="font-family: 'Poppins', sans-serif; font-weight:bold;">
                                    Change Password
                                </h4>
                                <p>Input your new password and confirm it to update your password</p>
                            </div>
                            <form method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <label for="email" class="mt-3">Email Address</label>
                                    <input type="email" name="email" class="form-control form-control-lg readonly-input" value="{{ $email }}" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="mt-3">New Password</label>
                                    <input type="password"  id="password" name="password" class="form-control form-control-lg"
                                        required>
                                        <small id="passwordError" class="text-danger mt-2"></small>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="mt-3">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control form-control-lg" required>
                                        <small id="confirmPasswordError" class="text-danger mt-2"></small>
                                </div>
                                <div class="form-group text-center mt-4">
                                    <input type="submit" value="Submit" class="btn btn-primary btn-lg" id="submitButton">
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
    <script src="../../assets-login/js/reset-password.js"></script>
    <script src="../../assets-login/js/todolist.js"></script>
    <script src="../../assets-login/js/jquery.cookie.js"></script>
    <script src="assets/js/login.js"></script>
    <!-- endinject -->
</body>

</html>
