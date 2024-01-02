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

 
@include('admin-partials.sidebar')
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
      <form method="POST" action="{{ route('admin.update-announcement', ['id' => $announcement->id]) }}">
        @csrf
        @method('PUT') 
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <section class="section">
                @if(session('success'))
                <div class="alert alert-success mt-3" role="alert" style="text-align: center" >
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
                <label for="fileUpload" style="font-weight: bold; margin-top: 20px; margin-bottom: 15px; margin-left: 5px;">Post an Announcement</label> 
                <div class="form-group">
                  <label for="announcement_title">Title</label>
                  <input type="text" class="form-control" id="announcement_title" name="announcement_title" value="{{ $announcement->title }}">
                </div>
                <br>
                <h6>Content</h6>
                  <textarea class="tinymce-editor" name="announcement_caption">{{ $announcement->caption }}</textarea>
                <div class="text-center mt-3">
                  <button class="btn btn-primary" style="width: 200px;" type="submit">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main><!-- End #main -->

  @include('admin-partials.footer')



</body>

</html>