<div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="navbar-brand-wrapper d-flex align-items-center">
        <a class="navbar-brand brand-logo" href="index.html">
          <h4 style="color: white;">Real LIFE Foundation</h4>
        </a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo" /></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
        <h5 class="mb-0 font-weight-medium d-none d-lg-flex">Welcome, {{ Session::get('adminFirstName') }}!</h5>
        <ul class="navbar-nav navbar-nav-right ml-auto">
          <form class="search-form d-none d-md-block" action="#" id="applicants-search-form">
            <i class="icon-magnifier"></i>
            <input type="search" class="form-control" id="searchInput" placeholder="Search Here" title="Search here">
          </form>
          {{-- <li class="nav-item"><a href="#" class="nav-link"><i class="icon-basket-loaded"></i></a></li> --}}
          {{-- <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li> --}}
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator message-dropdown" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="icon-bell"></i>
              <span class="count">7</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list pb-0" aria-labelledby="messageDropdown">
              <a class="dropdown-item py-3">
                <p class="mb-0 font-weight-medium float-left">You have 7 notificatons </p>
                {{-- <span class="badge badge-pill badge-primary float-right">View all</span> --}}
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  {{-- <img src="images/faces/face10.jpg" alt="image" class="img-sm profile-pic"> --}}
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Marian Garner </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  {{-- <img src="images/faces/face12.jpg" alt="image" class="img-sm profile-pic"> --}}
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">David Grey </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  {{-- <img src="images/faces/face1.jpg" alt="image" class="img-sm profile-pic"> --}}
                </div>
                <div class="preview-item-content flex-grow py-2">
                  <p class="preview-subject ellipsis font-weight-medium text-dark">Travis Jenkins </p>
                  <p class="font-weight-light small-text"> The meeting is cancelled </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
            <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle ml-2" src="../assets-new-admin/images/faces/face22.png" alt="Profile image"> <span class="font-weight-normal">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</span></a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                {{-- <img class="img-md rounded-circle" src="../assets-new-admin/images/faces/face22.pg" alt="Profile image"> --}}
                <p class="mb-1 mt-3" style="font-weight: bold; color: black;">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</p>
                <p class="font-weight-light text-muted mb-0">{{ Session::get('adminEmail') }} </p>
              </div>
              <a href="/admin-profile" class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> My Profile</a>
              {{-- <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
              <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activity</a>
              <a class="dropdown-item"><i class="dropdown-item-icon icon-question text-primary"></i> FAQ</a> --}}
              <a class="dropdown-item" href="{{ route('admin.admin-logout') }}"><i class="dropdown-item-icon icon-power text-primary"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile">
            <a href="#" class="nav-link">
              <div class="profile-image">
                <img class="img-xs rounded-circle" src="../assets-new-admin/images/faces/face22.png" alt="profile image">
                <div class="dot-indicator bg-success"></div>
              </div>
              <div class="text-wrapper">
                <p class="profile-name">{{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</p>
                <p class="designation">Administrator</p>
              </div>
              {{-- <div class="icon-container">
                <i class="icon-bubbles"></i>
                <div class="dot-indicator bg-danger"></div>
              </div> --}}
            </a>
          </li>
          <li class="nav-item nav-category">
            <span class="nav-link">Dashboard</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/dashboard-new">
              <span class="menu-title">Dashboard</span>
              <i class="icon-screen-desktop menu-icon"></i>
            </a>
          </li>
          <li class="nav-item nav-category"><span class="nav-link">Applicants</span></li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.new_applicants') }}">
              <span class="menu-title">All Applicants</span>
              <i class="icon-people menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.approved_applicants') }}">
              <span class="menu-title">Approved Applicants</span>
              <i class="icon-user-following menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.applicants.declined_applicants') }}">
              <span class="menu-title">Declined Applicants</span>
              <i class="icon-user-unfollow menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartist.html">
              <span class="menu-title">Scheduling</span>
              <i class="icon-calendar menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartist.html">
              <span class="menu-title">Checklist</span>
              <i class="icon-check menu-icon"></i>
            </a>
          </li>
          <li class="nav-item nav-category"><span class="nav-link">Content Management</span></li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('admin.announcement.admin-announcement') }}">
              <span class="menu-title">Announcement</span>
              <i class="icon-screen-tablet menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link"  href="{{ route('admin.registration') }}">
              <span class="menu-title">Create Account</span>
              <i class="icon-user-follow menu-icon"></i>
            </a>
          </li>
        </ul>
      </nav>