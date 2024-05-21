{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>{{ $title }}</title>
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
    <link rel="stylesheet" href="assets/vendor/aos/aos.css">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="  https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/faq.css" rel="stylesheet">
     <link href="assets/css/applicant_dashboard.css" rel="stylesheet">
    <style type="text/scss">
    
    </style>
</head> --}}

{{-- <body>
    @php
    if (auth()->check()) {
        $personalInfo = auth()->user()->personalInformation()->first();
    }
@endphp
    <!-- ======= Header ======= -->
    <header id="header" class=" shadow-sm d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <a href="/" class="logo me-auto"><img src="assets/img/RLlogo.png" alt=""
                    class="img-fluid"></a>

                    @if(auth()->check())
                    <!-- Navigation for logged-in users -->
                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a class="nav-link scrollto{{ request()->is('/') ? ' active' : '' }}" href="/">Home</a></li>
                            <li><a class="nav-link scrollto{{ request()->is('announcement') ? ' active' : '' }}" href="/announcement">Announcement</a></li>
                            <li><a class="nav-link scrollto{{ request()->is('contact') ? ' active' : '' }}" href="/contact">Contact Us</a></li>
                            <li><a class="nav-link scrollto{{ request()->is('faq') ? ' active' : '' }}" href="/faq">FAQ</a></li>
                            <!-- Add other logged-in user links here -->
                        </ul>
                        <i class="bi bi-list mobile-nav-toggle"></i>
                        
                    </nav><!-- .navbar -->

                    <div class="header-nav d-flex align-items-center">
                        <a class="nav-link nav-icon notification-icon" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-bell bell-icon"></i>
                            <span class="badge bg-danger badge-number count" id="notificationCount" style="display: none;"></span>
                        </a>
                    
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications" aria-labelledby="messageDropdown">
                            <li class="dropdown-header" style="font-weight: medium; color:#151515; font-weight: 500; font-size: 17px;">
                                Notifications
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <div class="notifications-container">
                                @if(isset($applicantNotifications) && count($applicantNotifications) > 0)
                                    @foreach ($applicantNotifications as $notification)
                                        <a href="/applicant_dashboard" class="dropdown-item preview-item notification" data-notification-id="{{ $notification->id }}">
                                            <li class="notification-item">
                                                <i></i>
                                                <div>
                                                    <h4 style="margin: 0%">{{ $notification->admin_name }}</h4>
                                                    <p>{{ $notification->message }}</p>
                                                    <p>
                                                        @if($notification->created_at->gt(now()->subDay()))
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        @else
                                                            <em>{{ $notification->created_at->format('F d, Y \a\t g:iA') }}</em>
                                                        @endif
                                                    </p>
                                                </div>
                                            </li>
                                        </a>
                                    @endforeach
                                @else
                                    <li class="notification-item">
                                        <div>
                                            <p style="text-align: center;">No notifications</p>
                                        </div>
                                    </li>
                                @endif
                    </ul><!-- End Notification Dropdown Items -->

                    </li><!-- End Notification Nav -->

                    <div class="nav-item dropdown pe-3 ">
                        <a class="nav-link nav-icon nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            <i class="bi bi-person"></i>
                            <span
                                class="d-none d-md-block dropdown-toggle ps-2 nav-link scrollto" style="font-family: 'Poppins', san-serif; font-size:16px; font-weight: medium;">{{ explode(' ', $personalInfo->first_name)[0] }}</span>
                        </a><!-- End Profile Image Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6 class="font-weight: bold; font-size: 5px;">{{ $personalInfo->first_name ?? '' }}
                                    {{ $personalInfo->last_name ?? '' }}</h6>
                                <span></span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/applicant_dashboard">
                                    <i class="bi bi-speedometer"></i>
                                    <span style="color: #444444;  font-size: 14px;">Dashboard</span>
                                </a>
                            </li>
                            <hr class="dropdown-divider">
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/personal-details">
                                    <i class="bi bi-person"></i>
                                    <span  style="color: #444444; font-size: 14px;">Personal Details</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="/change_password">
                                    <i class="bi bi-gear"></i>
                                    <span  style="color: #444444; font-size: 14px;">Change Password</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button class="dropdown-item d-flex align-items-center">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span  style="color: #444444;  font-size: 14px;" >Log out</span>
                                    </button>
                                </form>
                            </li>
                            <hr class="dropdown-divider">
                @else
                    <!-- Navigation for non-logged-in users -->
                    <nav id="navbar" class="navbar">
                        <ul>
                            <li><a class="nav-link scrollto" href="/">Home</a></li>
                            <li><a class="nav-link scrollto" href="/announcement">Announcement</a></li>
                            <li><a class="nav-link scrollto" href="/contact">Contact Us</a></li>
                            <li><a class="nav-link scrollto" href="/faq">FAQ</a></li>
                            <li><a class="nav-link scrollto" href="/login">Login</a></li>
                            <li><a class="getstarted scrollto" href="/register">Apply Now</a></li>
                        </ul>
                        <i class="bi bi-list mobile-nav-toggle"></i>
                    </nav><!-- .navbar -->
                @endif
                
            </ul><!-- End Profile Dropdown Items -->
        </div><!-- End Profile Nav -->
    </div><!-- End header-nav -->
</div><!-- End container -->
</header><!-- End Header -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="assets/js/applicant_notification.js"></script> --}}

{{-- <script>
       $(document).ready(function () {
        // Get the current URL path
        var currentPath = window.location.pathname;

        // Add the "active" class to the corresponding link
        $('.nav-link').each(function () {
            var linkPath = $(this).attr('href');
            if (currentPath === linkPath) {
                $(this).addClass('active');
            }
        });
    });
   
   
function fetchNotificationCount() {
    $.ajax({
        url: '/applicant-fetch-notification-count', // Endpoint to fetch notification count
        type: 'GET',
        success: function(response) {
            var count = response.count;
            // Update notification count
            if (count === 0) {
                // If count is zero, remove the badge
                $('#notificationCount').removeClass('badge bg-danger badge-number').text('');
            } else {
                // If count is greater than zero, update the badge with the count
                $('#notificationCount').addClass('badge bg-danger badge-number').text(count);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching notification count:', error);
        }
    });
}

// Fetch notification count initially when the page loads
fetchNotificationCount();

// Fetch notification count every 10 seconds (adjust interval as needed)
setInterval(fetchNotificationCount, 10000); // 10 seconds interval

// Handle click event on notification dropdown to reset count
$('#messageDropdown').on('click', function() {
    // Send request to server to mark notifications as read
    $.ajax({
        url: '/applicant-mark-notifications-as-read', // Endpoint to mark notifications as read
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token
        },
        success: function(response) {
            // Update notification count to zero on the client side
            $('#notificationCount').removeClass('badge bg-danger badge-number').text('');
        },
        error: function(xhr, status, error) {
            console.error('Error marking notifications as read:', error);
        }
    });
});
</script> --}}
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
<style>
   .link-style {
      
        cursor: pointer; /* Show pointer cursor on hover */
    }

    .link-style:hover {
        color: rgb(0, 0, 0); /* Text color on hover */
        background-color: rgb(248, 246, 250); /* Background color on hover */
    }
    .no-notifications {
    text-align: center;
    padding: 10px;
    color: #555;
    font-size: 14px;
}


</style>

<body style="background-color: #fafafa;">
    @php
    if (auth()->check()) {
        $personalInfo = auth()->user()->personalInformation()->first();
    }
@endphp
    <!-- Offcanvas Menu Section Begin -->
<div class="offcanvas-menu-overlay"></div>
<div class="canvas-open">
    <!-- Container for notification bell -->
    @if(auth()->check())
    <div class="icon-container">
        <i class="fa-regular fa-bell"></i> <!-- Notification bell icon -->
    </div>
    @endif

    <!-- Container for user icon -->
    @if(auth()->check())
    <div class="icon-container">
        <i class="fa-regular fa-user"></i> <!-- User icon -->
    </div>
    @endif
    
    <!-- Menu icon -->
    <div class="icon-container">
        <i class="icon_menu"></i> <!-- Menu icon -->
    </div>
</div>

<div class="offcanvas-menu-wrapper">
    <div class="canvas-close">
        <i class="icon_close"></i>
    </div>
    <div class="search-icon search-switch">
        <img id="logo" src="assets-applicant/img/RLlogo.png" alt="" style="width: 125px;">
    </div>
    <div class="header-configure-area">
        <br>
        @unless(auth()->check())
        <a href="/register" class="bk-btn">Apply Now</a>
        @endunless
    </div>
    <nav class="mainmenu mobile-menu">
        <ul>
            <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
            <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a href="/announcement">Announcement</a></li>
            <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact Us</a></li>
            <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a></li>
            @unless(auth()->check())
            <li><a href="/login" class="bk-btn">Login</a></li>
            @endunless
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
                        <li><i class="fa fa-phone"></i>(632) 8817-1212</li>
                        <li><i class="fa fa-envelope"></i>fortbonifacio@reallife.ph</li>
                    </ul>
                </div>
                <div class="col-lg-6">
                    <div class="tn-right">
                        <div class="top-social">
                            <a href="https://www.facebook.com/reallifeph"><i class="fa fa-facebook"></i></a>
                            <a href="https://www.instagram.com/reallifeph/"><i class="fa fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCCH8ji_JYH28LxSghsfPeig/videos"><i class="fa fa-youtube-play"></i></a>
                        </div>
                        @unless(auth()->check())
                        <a href="/register" class="bk-btn">Apply Now</a>
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
                        <a href="./index.html">
                            <img id="logo" src="assets-applicant/img/RLlogo.png" alt="" style="width: 125px;">
                        </a>
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="nav-menu">
                        <nav class="mainmenu">
                            <ul>
                                @unless(auth()->check())
                                    <li class="{{ Request::is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                                
                                    <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a href="/announcement">Announcement</a></li>
                                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact Us</a></li>
                                    <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a></li>
                                    <li><a href="/login" class="bk-btn">Login</a></li>
                                @else
                                    <li class="{{ Request::is('home') ? 'active' : '' }}"><a href="/home">Home</a></li>
                                    <li class="{{ Request::is('announcement') ? 'active' : '' }}"><a href="/announcement">Announcement</a></li>
                                    <li class="{{ Request::is('contact') ? 'active' : '' }}"><a href="/contact">Contact Us</a></li>
                                    <li class="{{ Request::is('faq') ? 'active' : '' }}"><a href="/faq">FAQ</a></li>
                
                                    @if(isset($applicantNotifications) && count($applicantNotifications) > 0)
                                        <li class="notification-badge">
                                            <a class="nav-link nav-icon notification-icon" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                                <i class="fas fa-bell">
                                                    <span class="badge badge-pill badge-danger" id="notificationCount" style="display: none;">{{ count($applicantNotifications) }}</span>
                                                </i>
                                            </a>
                                            <ul class="dropdown-menu notification-dropdown-menu" id="notificationDropdown">
                                                <li>
                                                    <div class="notification-label">Notifications</div>
                                                    <div class="notification-separator"></div>
                                                </li>
                                                @foreach ($applicantNotifications as $notification)
                                                    <li>
                                                        <div class="notification-item" onclick="redirectToApplicantDashboard('{{ $notification->id }}')">
                                                            <div class="notification-info">
                                                                <span class="notification-title">{{ $notification->admin_name }}</span>
                                                                <span class="notification-description">{{ $notification->message }}</span>
                                                                <span class="notification-time">
                                                                    @if($notification->created_at->gt(now()->subDay()))
                                                                        {{ $notification->created_at->diffForHumans() }}
                                                                    @else
                                                                        <em>{{ $notification->created_at->format('F d, Y \a\t g:iA') }}</em>
                                                                    @endif
                                                                </span>
                                                            </div>
                                                           
                                                        </div>
                                                        <hr style="width: 300px;"> 
                                                    </li>
                                                  
                                                @endforeach
                                            </ul>
                                        </li>
                                    @else
                                    <li class="notification-badge">
                                        <a class="nav-link nav-icon notification-icon" id="messageDropdown" href="#" data-bs-toggle="dropdown">
                                            <i class="fas fa-bell"></i>
                                        </a>
                                        <ul class="dropdown-menu notification-dropdown-menu" id="notificationDropdown">
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
                                    <a href="#" id="user-dropdown-toggle">
                                        @auth
                                        <i class="fas fa-user"></i>
                                        @if(isset($personalInfo) && $personalInfo->first_name && $personalInfo->last_name)
                                        {{ $personalInfo->first_name }}
                                   
                                        @endauth
                                        <i class="fas fa-caret-down"></i>
                                    </a>
                                    <!-- User Dropdown Menu (Hidden by Default) -->
                                    
                                    <ul class="user-dropdown-menu" id="user-dropdown-menu">
                                        <li>
                                            <div class="notification-label">{{ $personalInfo->first_name ?? '' }}
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
                                                <button type="submit" class="dropdown-item">Profile Details</button>
                                            </form>
                                        </li>
                                        <hr style="padding: 0%; margin:0%;">
                                        <li>
                                            <form action="/change_password" method="GET">
                                                <button type="submit" class="dropdown-item">Change Password</button>
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

        
    <!-- Header End -->

        
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="assets/js/applicant_notification.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="assets-applicant/jquery-3.3.1.min.js"></script>

<script>
    $(document).ready(function(){
        // Activate the carousel with a specified interval (e.g., 5 seconds)
        $('.carousel').carousel({
            interval: 3000 // Adjust this value (in milliseconds) to control the sliding interval
        });
    });

    $(document).ready(function() {
    // Toggle dropdown on click
    $('#messageDropdown').click(function(e) {
        e.preventDefault();
        var dropdownMenu = $('#notificationDropdown');
        // Calculate the left position relative to the parent element
        var leftPosition = -dropdownMenu.outerWidth() + $(this).outerWidth();
        dropdownMenu.css({ 'left': leftPosition });
        dropdownMenu.toggle();

        // Close other dropdowns
        $('.dropdown-menu').not(dropdownMenu).hide();
    });

    // Hide dropdown when clicking outside of it
    $(document).click(function(e) {
        if (!$(e.target).closest('#messageDropdown').length && !$(e.target).closest('#notificationDropdown').length) {
            $('#notificationDropdown').hide();
        }
    });

    // Prevent closing the dropdown when clicking inside it
    $('#notificationDropdown').click(function(e) {
        e.stopPropagation();
    });
});


$(document).ready(function() {
    // Hide the user dropdown menu initially
    $('#user-dropdown-menu').hide();

    // Toggle user dropdown menu when clicking on user profile link
    $('#user-dropdown-toggle').click(function(e) {
        e.preventDefault();
        // Toggle visibility of the user dropdown menu
        $('#user-dropdown-menu').toggle();
    });

    // Close dropdown when clicking outside of the user dropdown area
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.user-profile').length) {
            // If the click is not within the user-profile area, hide the dropdown
            $('#user-dropdown-menu').hide();
        }
    });

    // Prevent hiding dropdown when clicking inside the dropdown menu
    $('#user-dropdown-menu').on('click', function(e) {
        e.stopPropagation(); // Prevent the click event from propagating to document
    });

    // Close dropdown when specific dropdown items are clicked
    $('#user-dropdown-menu').on('click', 'a', function() {
        $('#user-dropdown-menu').hide(); // Hide the dropdown menu
    });
});
/***************************************************/
function redirectToApplicantDashboard(notificationId) {
        // Assuming your applicant dashboard link is "/applicant_dashboard"
        window.location.href = "/applicant_dashboard"; // Modify this if your link is different
        // You can also append any query parameters or additional information if needed
        // For example: window.location.href = "/applicant_dashboard?id=" + notificationId;
    }

</script>