
<div class="main-header">
    <div class="main-header-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="white">
            <a href="{{ route('user.applicant_dashboard') }}" class="logo">
                <img src="../admin-assets/img/RLlogo.png" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>

    <!-- Navbar Header -->

    <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
        <div class="container-fluid">
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                <li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <i class="fa fa-search"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-search animated fadeIn">
                        <form class="navbar-left navbar-form nav-search">
                            <div class="input-group">
                                <input type="text" placeholder="Search ..." class="form-control" />
                            </div>
                        </form>
                    </ul>
                </li>
{{-- 
                @if (isset($applicantNotifications) && count($applicantNotifications) > 0)
                    <li class="nav-item topbar-icon dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                            <span class="notification">{{ count($applicantNotifications) }}</span>
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">
                                    You have {{ count($applicantNotifications) }} new
                                    notification{{ count($applicantNotifications) != 1 ? 's' : '' }}
                                </div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        @foreach ($applicantNotifications as $notification)
                                            <a href="#"
                                                onclick="redirectToApplicantDashboard('{{ $notification->id }}')">
                                                <div class="notif-icon notif-success">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div class="notif-content">
                                                    <span class="block"><strong>{{ $notification->admin_name }}</strong> {{ $notification->message }}</span>
                                                    <span class="time">
                                                        @if ($notification->created_at->gt(now()->subDay()))
                                                            {{ $notification->created_at->diffForHumans() }}
                                                        @else
                                                            {{ $notification->created_at->format('F d, Y \a\t g:iA') }}
                                                        @endif
                                                    </span>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item topbar-icon dropdown hidden-caret">
                        <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell"></i>
                        </a>
                        <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                            <li>
                                <div class="dropdown-title">Notifications</div>
                            </li>
                            <li>
                                <div class="notif-scroll scrollbar-outer">
                                    <div class="notif-center">
                                        <div class="no-notifications">You have no notifications.</div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif --}}
                <li class="nav-item topbar-user dropdown hidden-caret">
                    <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                        aria-expanded="false">
                        <div class="avatar-sm">
                            <i class="fas fa-user-circle avatar-img rounded-circle" style="font-size: 35px;"></i>
                        </div>
                        <span class="profile-username">
                            <span class="op-7">Hi,</span>
                            <span class="fw-bold">{{ $personalInfo->first_name ?? '' }}</span>
                        </span>
                    </a>
                    <ul class="dropdown-menu dropdown-user animated fadeIn">
                        <div class="dropdown-user-scroll scrollbar-outer">
                            <li>
                                <div class="user-box">
                                    <div class="avatar-sm">
                                        <i class="fas fa-user-circle avatar-img rounded-circle"
                                            style="font-size: 45px;"></i>
                                    </div>
                                    <div class="u-text p-3">
                                        <h4>{{ $personalInfo->first_name ?? '' }} {{ $personalInfo->last_name ?? '' }}
                                        </h4>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dropdown-divider"></div>
                                {{-- <a class="dropdown-item" href="{{ route('user.profile') }}">My Profile</a> --}}
                                <a class="dropdown-item" href="{{ route('user.change_password') }}">Settings</a>
                                <a class="dropdown-item" onclick="confirmLogout(); return false; "
                                    href="">Logout</a>
                            </li>
                        </div>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
    <!-- End Navbar -->
