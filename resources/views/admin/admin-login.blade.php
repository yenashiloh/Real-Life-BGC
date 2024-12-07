<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets-admin/img/RLlogo1.png" rel="icon">


    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets-admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets-admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets-admin/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets-admin/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets-admin/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets-admin/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets-admin/css/style.css" rel="stylesheet">
    <style>
        .custom-button {
            background-color: #0A6E57;

            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .custom-button:hover {

            background-color: #71BF44;
            color: #fff;
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Admin</h5>
                                        <p class="text-center small">Enter your email & password to login</p>
                                    </div>
                                    @if (session('success'))
                                        <div class="alert" style="text-align: center; color: green;">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    @if (session('danger'))
                                        <div class="alert" style="text-align: center; color: red;">
                                            {{ session('danger') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('admin.login') }}" method="POST"
                                        class="row g-3 needs-validation login" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control" id="yourEmail"
                                                    required>
                                                <div class="invalid-feedback">Please enter your email</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                id="yourPassword" required>
                                            <div class="invalid-feedback">Please enter your password</div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn w-100 custom-button" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets-admin/vendor/chart.js/chart.umd.js"></script>
    <script src="assets-admin/vendor/echarts/echarts.min.js"></script>
    <script src="assets-admin/vendor/quill/quill.min.js"></script>
    <script src="assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets-admin/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets-admin/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets-admin/js/main.js"></script>

    <script>
        const emailInput = document.getElementById('yourEmail');
        const passwordInput = document.getElementById('yourPassword');

        emailInput.addEventListener('input', () => {
            removeMessages();
        });

        passwordInput.addEventListener('input', () => {
            removeMessages();
        });

        function removeMessages() {
            const successMessage = document.querySelector('.alert[style="text-align: center; color: green;"]');
            const errorMessage = document.querySelector('.alert[style="text-align: center; color: red;"]');

            if (successMessage) {
                successMessage.style.display = 'none';
            }

            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }
    </script>
</body>
</html>
