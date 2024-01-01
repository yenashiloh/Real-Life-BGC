@php
    $personalInfo = auth()
        ->user()
        ->personalInformation()
        ->first();
@endphp
<!-- ======= Header ======= -->
<header id="header" class="shadow-sm d-flex align-items-center">
    <div class="container d-flex align-items-center">
        <a href="/" class="logo me-auto"><img src="assets/img/RLlogo.png" alt="" class="img-fluid"></a>
        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto" href="/">Home</a></li>
                <li><a class="nav-link scrollto" href="/announcement">Announcement</a></li>
                <li><a class="nav-link scrollto" href="#contact_us.html">Contact Us</a></li>
                <li><a class="nav-link scrollto" href="#FAQ.html">FAQ</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <div class="header-nav d-flex align-items-center">
            <a class="nav-link nav-icon notification-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell bell-icon"></i>
                <span class="badge bg-primary badge-number">4</span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications ">
                <li class="dropdown-header">
                    You have 4 new notifications
                    <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class=""></i>
                    <div>
                        <h4>Shey pempo</h4>
                        <p>You are now for house visitation</p>
                        <p>30 minutes ago</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class=""></i>
                    <div>
                        <h4>Shey Pempo</h4>
                        <p>You are now for interview</p>
                        <p>December 9, 2023</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                <li class="notification-item">
                    <i class=""></i>
                    <div>
                        <h4>Shey Pampo</h4>
                        <p>You are now is under review</p>
                        <p>November 23, 2023</p>
                    </div>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="#">Show all notifications</a>
                </li>

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
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/personal-details">
                            <i class="bi bi-person"></i>
                            <span>Personal Details</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    {{-- <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                            <i class="bi bi-journal-text"></i>
                            <span>Requirements</span>
                        </a>
                    </li> --}}
                    {{-- <li>
                        <hr class="dropdown-divider">
                    </li> --}}

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/change_password">
                            <i class="bi bi-gear"></i>
                            <span>Change Password</span>
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
                                <span>Log out</span>
                            </button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </div><!-- End Profile Nav -->
        </div><!-- End header-nav -->
    </div><!-- End container -->
</header><!-- End Header -->
