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
<head>

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
    
        .container {
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }
    
        .svg-success {
            display: inline-block;
            vertical-align: top;
            height: 80%;
            width: 80%;
            max-width: 130px; 
            max-height: 130px;
            opacity: 1;
            overflow: visible;
        }

        @keyframes success-tick {
            0% {
                stroke-dashoffset: 16px;
                opacity: 1;
            }
    
            100% {
                stroke-dashoffset: 31px;
                opacity: 1;
            }
        }
    
        @keyframes success-circle-outline {
            0% {
                stroke-dashoffset: 72px;
                opacity: 1;
            }
    
            100% {
                stroke-dashoffset: 0px;
                opacity: 1;
            }
        }
    
        @keyframes success-circle-fill {
            0% {
                opacity: 0;
            }
    
            100% {
                opacity: 1;
            }
        }
    
        .success-tick {
            fill: none;
            stroke-width: 1px;
            stroke: #ffffff;
            stroke-dasharray: 15px, 15px;
            stroke-dashoffset: -14px;
            animation: success-tick 450ms ease 1400ms forwards;
            opacity: 0;
        }
    
        .success-circle-outline {
            fill: none;
            stroke-width: 1px;
            stroke: #71BF44;;
            stroke-dasharray: 72px, 72px;
            stroke-dashoffset: 72px;
            animation: success-circle-outline 200ms ease-in-out 800ms forwards;
            opacity: 0;
        }
    
        .success-circle-fill {
            fill: #71BF44;;
            stroke: none;
            opacity: 0;
            animation: success-circle-fill 200ms ease-out 1100ms forwards;
        }

        @media screen and (-ms-high-contrast: active), screen and (-ms-high-contrast: none) {
            .success-tick {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                animation: none;
                opacity: 1;
            }
    
            .success-circle-outline {
                stroke-dasharray: 0;
                stroke-dashoffset: 0;
                animation: none;
                opacity: 1;
            }
    
            .success-circle-fill {
                animation: none;
                opacity: 1;
            }
        }
    </style>
    
    <body class="d-flex align-items-center justify-content-center" style="min-height: 100vh; padding-left: 15px; padding-right: 15px;">
        <div class="card px-3"> 
            <h1 class="mt-4 fw-bold">Email Successfully Verified!</h1>
            <div class="container mt-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="svg-success" viewBox="0 0 24 24">
                    <g stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10">
                        <circle class="success-circle-outline" cx="12" cy="12" r="11.5"/>
                        <circle class="success-circle-fill" cx="12" cy="12" r="11.5"/>
                        <polyline class="success-tick" points="17,8.5 9.5,15.5 7,13"/>
                    </g>
                </svg>
            </div>
            <h5 class="mt-5">{{ $message }}</h5>
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary mt-3 mb-3"
                >Proceed to Login</a>
            </div>
        </div>
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