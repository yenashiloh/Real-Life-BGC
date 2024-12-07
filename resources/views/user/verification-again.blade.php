<!DOCTYPE html>
<html lang="en">
<title>Real LIFE BGC</title>
<meta charset="utf-8">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta content="" name="description">
<meta content="" name="keywords">
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="shortcut icon" href="../../../admin-assets/img/RLlogo1.png" />

<!-- Fonts and icons -->
<script src="../../../admin-assets/js/plugin/webfont/webfont.min.js"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["../../../admin-assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>

<!-- CSS Files -->
<link rel="stylesheet" href="../../../admin-assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="../../../admin-assets/css/plugins.min.css" />
<link rel="stylesheet" href="../../../admin-assets/css/kaiadmin.min.css" />
<link rel="stylesheet" href="../../../admin-assets/css/style.css" />
<style>
    .fade {
    transition: opacity 0.5s ease;
}

</style>
<style>
    .card {
        width: 100%;
        max-width: 600px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 15px;
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
</style>

<head>

<body class="d-flex align-items-center justify-content-center"
    style="min-height: 100vh; padding-left: 15px; padding-right: 15px;">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100vh; padding: 20px;">
        <div class="card text-center" style="padding: 20px;">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
                {{ session('success') }}
            </div>
            @endif
    
           
            <div class="card-body">
                <h1 class="fw-bold">Verify your Email Address</h1>
                <img src="assets-applicant/img/verification_sent.png" class="img-fluid" alt="Successfully Sent Image"
                    style="max-width: 30%; height: auto;">
                <h5 style="padding: 10px;">Your email is not verified. A new verification email has been sent to your email address.</h5>
                <p style="padding: 10px;">Did not receive the email? <a href="{{ route('resend.verification') }}"
                        style="text-decoration: underline !important; color: #71BF44;">
                        Click here to resend
                    </a></p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../../admin-assets/js/core/jquery-3.7.1.min.js"></script>
<script src="../../../admin-assets/js/core/popper.min.js"></script>
<script src="../../../admin-assets/js/core/bootstrap.min.js"></script>

<!-- jQuery Scrollbar -->
<script src="../../../admin-assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

<!-- Chart JS -->
<script src="../../../admin-assets/js/plugin/chart.js/chart.min.js"></script>

<!-- jQuery Sparkline -->
<script src="../../../admin-assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

<!-- Chart Circle -->
<script src="../../../admin-assets/js/plugin/chart-circle/circles.min.js"></script>

<!-- Datatables -->
<script src="../../../admin-assets/js/plugin/datatables/datatables.min.js"></script>

<!-- Bootstrap Notify -->
<script src="../../../admin-assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- jQuery Vector Maps -->
<script src="../../../admin-assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
<script src="../../../admin-assets/js/plugin/jsvectormap/world.js"></script>

<!-- Sweet Alert -->
<script src="../../../admin-assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Kaiadmin JS -->
<script src="../../../admin-assets/js/kaiadmin.min.js"></script>

<script>
    setTimeout(() => {
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        // Function to smoothly fade and remove the alert
        const fadeOutAlert = (alertElement) => {
            if (alertElement) {
                alertElement.classList.remove('show');
                alertElement.classList.add('fade');

                // Wait for the fade-out transition to finish before removing the alert from the DOM
                setTimeout(() => {
                    alertElement.remove(); // Remove from DOM after the fade transition
                }, 500); // Match the duration of the fade transition
            }
        };

        fadeOutAlert(successAlert);
        fadeOutAlert(errorAlert);
    }, 3000); // Trigger the fade-out after 3 seconds
</script>