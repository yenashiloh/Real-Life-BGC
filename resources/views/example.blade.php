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
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">

    <!-- Google Font -->
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

    <!-- Offcanvas Menu Section Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="canvas-open">
        @if (auth()->check())
            <div class="icon-container" id="notification-bell">
                <i class="fa-solid fa-bell"></i>
                @if (isset($applicantNotifications) && count($applicantNotifications) > 0)
                    <span class="notification-count">{{ count($applicantNotifications) }}</span>
                @endif
            </div>
            <div class="notification-dropdown-mobile">
                <ul class="notification-list-mobile">
                    @foreach ($applicantNotifications as $notification)
                        <li class="notification-item-container-mobile">
                            <div class="notification-item-mobile" id="notification-link"
                                onclick="redirectToApplicantDashboard('{{ $notification->id }}')">
                                <div class="notification-info-mobile">
                                    <span class="notification-title-mobile">{{ $notification->admin_name }}</span>
                                    <span class="notification-description-mobile">{{ $notification->message }}</span>
                                    <span class="notification-time-mobile">
                                        @if ($notification->created_at->gt(now()->subDay()))
                                            {{ $notification->created_at->diffForHumans() }}
                                        @else
                                            <em>{{ $notification->created_at->format('F d, Y \a\t g:iA') }}</em>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

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
            @unless (auth()->check())
                <a href="/registration" class="bk-btn">Apply Now</a>
            @endunless
        </div>
        <nav class="mainmenu mobile-menu">
            <ul>
                <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a href="/announcement">Announcement</a>
                </li>
                <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact Us</a></li>
                <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a></li>
                @unless (auth()->check())
                    <li><a href="/login" class="bk-btn">Login</a></li>
                @endunless

                <li> <i class="fas fa-user"></i>
                    @if (isset($personalInfo) && $personalInfo->first_name && $personalInfo->last_name)
                        {{ explode(' ', $personalInfo->first_name)[0] }} {{ $personalInfo->last_name }}
                        <ul class="dropdown">

                            <li><a href="{{ route('user.applicant_dashboard') }}">Dashboard</a></li>
                            <li><a href="/personal-details">Profile Details</a></li>
                            <li><a href="/change_password">Change Password</a></li>
                            <li>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    @endif
                </li>

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
                                        @unless (auth()->check())
                                            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a>
                                            </li>

                                            <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a
                                                    href="/announcement">Announcement</a></li>
                                            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                                    href="/contact">Contact Us</a></li>
                                            <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a>
                                            </li>
                                            <li><a href="/login" class="bk-btn">Login</a></li>
                                        @else
                                            <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="/home">Home</a>
                                            </li>
                                            <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a
                                                    href="/announcement">Announcement</a></li>
                                            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a
                                                    href="/contact">Contact Us</a></li>
                                            <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a>
                                            </li>

                                            @if (isset($applicantNotifications) && count($applicantNotifications) > 0)
                                                <li class="notification-badge">
                                                    <a class="nav-link nav-icon notification-icon" id="messageDropdown"
                                                        href="#" data-bs-toggle="dropdown">
                                                        <i class="fas fa-bell">
                                                            <span class="badge badge-pill badge-danger" id="notificationCount"
                                                                style="display: none;">{{ count($applicantNotifications) }}</span>
                                                        </i>
                                                    </a>
                                                    <ul class="dropdown-menu notification-dropdown-menu"
                                                        id="notificationDropdown">
                                                        <li>
                                                            <div class="notification-label">Notifications</div>
                                                            <div class="notification-separator"></div>
                                                        </li>
                                                        @foreach ($applicantNotifications as $notification)
                                                            <li class="notification-item-container">
                                                                <div class="notification-item "
                                                                    onclick="redirectToApplicantDashboard('{{ $notification->id }}')">
                                                                    <div class="notification-info">
                                                                        <span
                                                                            class="notification-title">{{ $notification->admin_name }}</span>
                                                                        <span
                                                                            class="notification-description">{{ $notification->message }}</span>
                                                                        <span class="notification-time">
                                                                            @if ($notification->created_at->gt(now()->subDay()))
                                                                                {{ $notification->created_at->diffForHumans() }}
                                                                            @else
                                                                                <em>{{ $notification->created_at->format('F d, Y \a\t g:iA') }}</em>
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                {{-- <hr style="width: 300px;"> --}}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li class="notification-badge">
                                                    <a class="nav-link nav-icon notification-icon" id="messageDropdown"
                                                        href="#" data-bs-toggle="dropdown">
                                                        <i class="fas fa-bell"></i>
                                                    </a>
                                                    <ul class="dropdown-menu notification-dropdown-menu"
                                                        id="notificationDropdown">
                                                        <li>
                                                            <div class="notification-label">Notifications</div>
                                                            <div class="notification-separator"></div>
                                                            <div class="no-notifications">You have no notifications.</div>
                                                        </li>
                                                    </ul>
                                                </li>
                                            @endif
                                            @endif

                                            <li class="user-profile">
                                                <a href="#" id="user-dropdown-toggle"
                                                    style="text-transform: capitalize;">
                                                    @auth
                                                        <i class="fas fa-user"></i>
                                                        @if (isset($personalInfo) && $personalInfo->first_name && $personalInfo->last_name)
                                                            {{ explode(' ', $personalInfo->first_name)[0] }}

                                                        @endauth
                                                        <i class="fas fa-caret-down"></i>
                                                </a>
                                                <!-- User Dropdown Menu -->
                                                <ul class="user-dropdown-menu" id="user-dropdown-menu">
                                                    <li>
                                                        <div class="notification-label" style="text-transform: capitalize;">
                                                            {{ $personalInfo->first_name ?? '' }}
                                                            {{ $personalInfo->last_name ?? '' }}</div>
                                                    </li>
                                                    <hr style="padding: 0%; margin:0%;">
                                                    <li>
                                                        <form action="/applicant_dashboard" method="GET">
                                                            <button type="submit" class="dropdown-item">Dashboard</button>
                                                        </form>
                                                    </li>
                                                    <hr style="padding: 0%; margin:0%;">
                                                    <li>
                                                        <form action="/personal-details" method="GET">
                                                            <button type="submit" class="dropdown-item">Profile
                                                                Details</button>
                                                        </form>
                                                    </li>
                                                    <hr style="padding: 0%; margin:0%;">
                                                    <li>
                                                        <form action="/change_password" method="GET">
                                                            <button type="submit" class="dropdown-item">Change
                                                                Password</button>
                                                        </form>
                                                    </li>
                                                    <hr style="padding: 0%; margin:0%;">
                                                    <li>
                                                        <form action="/logout" method="POST">
                                                            @csrf
                                                            <button type="submit" class="dropdown-item">Log out</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                                @endif
                                            </li>
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

            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="assets/js/applicant_notification.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
            <script src="assets-applicant/jquery-3.3.1.min.js"></script>
            <script src="assets/js/header.js"></script>
