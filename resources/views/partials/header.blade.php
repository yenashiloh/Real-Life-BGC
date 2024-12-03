<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="assets/img/RLlogo1.png" rel="icon">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

    <!-- Css Styles -->
    <link rel="stylesheet" href="assets-applicant/css/bootstrap.min.css" type="text/css">
    {{-- <link rel="stylesheet" href="../../../admin-assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../../../admin-assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../../../admin-assets/css/kaiadmin.min.css" /> --}}
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

    <!-- Bootstrap JS (including jQuery and Popper.js) -->
    <link href="assets/css/applicant_dashboard.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fafafa;">

    @php
        if (auth()->check()) {
            $personalInfo = auth()->user()->personalInformation()->first();
        }
    @endphp
    <div id="loading-spinner" class="loading-spinner">
        <div class="loading-content">
            <img src="../admin-assets/img/RLlogo.png" alt="Logo" class="loading-logo" id="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">

        <div class="icon-container" id="menu-icon">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>

    <div class="offcanvas-menu-wrapper">
        <div class="canvas-close">
            <i class="icon_close"></i>
        </div>
        <div class="search-icon search-switch">
            <a href="./home">
                <img id="logo" src="assets-applicant/img/RLlogo.png" alt="" style="width: 125px;">
            </a>

        </div>
        <div class="header-configure-area">
            <br>
            <a href="/registration" class="bk-btn">Apply Now</a>
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a href="/announcement">Announcement</a>
                </li>
                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact Us</a></li>
                <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a></li>

                <li><a href="/login" class="bk-btn">Login</a></li>

                </a>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
    </div>
    <!-- Offcanvas Menu Section End -->

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="top-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <ul class="tn-left">
                            <li><i class="fa fa-envelope"></i>bgc@reallife.ph</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <div class="tn-right">
                            <div class="top-social">
                                <a href="https://www.facebook.com/reallifeph"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.instagram.com/reallifeph/"><i class="fa fa-instagram"></i></a>
                                <a href="https://www.youtube.com/channel/UCCH8ji_JYH28LxSghsfPeig/videos"><i
                                        class="fa fa-youtube-play"></i></a>
                            </div>
                            @unless (auth()->check())
                                <a href="/registration" class="bk-btn">Apply Now</a>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="menu-item">
            <div class="container">
                <div class="row">
                    <div class="col-lg-2">
                        <div class="logo">
                            @unless (auth()->check())
                                <a href="/">
                                    <img id="logo" src="assets-applicant/img/RLlogo.png" alt=""
                                        style="width: 125px;">
                                </a>
                            @else
                                <a href="/home">
                                    <img id="logo" src="assets-applicant/img/RLlogo.png" alt=""
                                        style="width: 125px;">
                                </a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="nav-menu">
                                <nav class="mainmenu">
                                    <ul>
                                        <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a>
                                        </li>
                                        <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a
                                                href="/announcement">Announcement</a></li>
                                        <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                                href="/contact">Contact Us</a></li>
                                        <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a>
                                        </li>
                                        <li><a href="/login" class="bk-btn">Login</a></li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </header>
        <!-- Header Section End -->
{{-- 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="assets-applicant/jquery-3.3.1.min.js"></script> --}}
   
            
