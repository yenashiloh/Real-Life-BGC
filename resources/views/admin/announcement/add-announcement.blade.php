<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Announcement</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets-admin/img/RLlogo1.png" rel="icon">


  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets-admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets-admin/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets-admin/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets-admin/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets-admin/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets-admin/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../assets-admin/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
          <img src="../assets-admin/img/RLlogo1.png" alt="">
          <span class="d-none d-lg-block" style="font-size: 20px;">Real LIFE Foundation </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
              <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-person-fill rounded-circle" style="font-size: 2rem;"></i>
                  <span class="d-none d-md-block dropdown-toggle ps-2">
                    {{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}
                </span>
              </a><!-- End Profile Image Icon -->

              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                  <li class="dropdown-header">
                      <h6> {{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</h6>
                      <span>Admin</span>
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>

                  <li>
                      <a class="dropdown-item d-flex align-items-center" href="/admin-profile">
                          <i class="bi bi-person"></i>
                          <span>My Profile</span>
                      </a>
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>

                  
                  <li>
                      <hr class="dropdown-divider">
                  </li>
                  <li>
                      <hr class="dropdown-divider">
                  </li>

                  <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.admin-logout') }}">
                          <i class="bi bi-box-arrow-right"></i>
                          <span>Sign Out</span>
                      </a>
                  </li>
              </ul><!-- End Profile Dropdown Items -->
          </li><!-- End Profile Nav -->
      </ul>
  </nav><!-- End Icons Navigation -->
</header><!-- End Header -->

 

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="/dashboard" id="dashboard-link">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-a- End Dashboard Nav -->


      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" id="applicants-link">
          <i class="bi bi-menu-button-wide" ></i><span>Applicants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="new_applicants.html">
              <i class="bi bi-circle"></i><span>New Applicants</span>
            </a>
          </li>
          <li>
            <a href="components-accordion.html">
              <i class="bi bi-circle"></i><span>Shortlisted</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>For Interview</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>For House Visitation</span>
            </a>
          </li>
          <li>
            <a href="components-buttons.html">
              <i class="bi bi-circle"></i><span>Approved</span>
            </a>
          </li>
          <li>
            <a href="components-cards.html">
              <i class="bi bi-circle"></i><span>Declined</span>
            </a>
          </li>
          
        </ul>
      </li><!-- End Components Nav -->

  
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.announcement.admin-announcement') }}" id="announcement-link">
          <i class="bi bi-journal-text"></i><span>Announcement</span></i>
        </a>
      
      </li><!-- End Forms Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.announcement.admin-announcement') }}" id="notify-link">
          <i class="bi bi-envelope-arrow-up"></i><span>Notify</span></i>
        </a>
      
      </li><!-- End Tables Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('admin.registration') }}" id="createaccount-link">
          <i class="bi bi-person-plus"></i><span>Create Account</span></i>
        </a>
        
      </li><!-- End Charts Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed"  href="{{ route('admin.admin-logout') }}" id="signout-link">
          <i class="bi bi-box-arrow-in-right"></i><span>Sign out</span></i>
        </a>
      </li><!-- End Icons Nav -->

  </aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Editors</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Announcement</li>
          <li class="breadcrumb-item active">Add Announcement</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <form method="POST" action="{{ route('admin.save-announcement') }}" id="announcementForm">
        @csrf
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <section class="section">
                @if(session('success'))
                <div class="alert alert-success mt-3" role="alert">
                    {{ session('success') }}
                </div>
                @endif
    
                @if ($errors->any())
                <div class="alert alert-danger mt-3">
                        @foreach ($errors->all() as $error)
                            {{ $error }}
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <label for="fileUpload" style="font-weight: bold; margin-top: 20px; margin-bottom: 10px;">Caption</label>
              <textarea class="tinymce-editor" name="announcement_caption">
              </textarea>
              <div class="text-center mt-3">
                <button class="btn btn-primary" style="width: 200px;" type="submit">Add Announcement</button>
              </div>
            </div>
            
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
  <script src="../assets-admin/vendor/quill/quill.min.js"></script>
  <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets-admin/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets-admin/js/main.js"></script>

</body>

</html>