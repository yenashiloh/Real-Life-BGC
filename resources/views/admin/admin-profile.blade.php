{{-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">


  <title>{{ $title }}</title>
  @include('admin-partials.header')
  @include('admin-partials.sidebar')


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-12 " >
        </div>

        <div class="col-xl-12">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">First Name</div>
                    <div class="col-lg-9 col-md-8">  {{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Last Name</div>
                    <div class="col-lg-9 col-md-8">{{ Session::get('adminLastName') }}</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8">  {{ Session::get('adminEmail') }} </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Contact Number</div>
                    <div class="col-lg-9 col-md-8">{{ Session::get('adminContactNumber') }}</div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="POST" action="{{ route('admin.profile-update') }}">
                    @csrf 
                    <div class="row mb-3" id="profileSuccessAlert">
                      @if(session('profileSuccess'))
                          <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                              {{ session('profileSuccess') }}
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                  </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="firstName" type="text" class="form-control" id="firstName" value="{{ Session::get('adminFirstName') }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="lastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="lastName" type="text" class="form-control" id="lastName" value="{{ Session::get('adminLastName') }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="text" class="form-control" id="email" value="{{ Session::get('adminEmail') }}">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="contactNumber" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="contactNumber" type="text" class="form-control" id="contactNumber" value="{{ Session::get('adminContactNumber') }}">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

  
                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form method="POST" action="{{ route('admin.password-update') }}">
                    @csrf
                    @if ($errors->has('currentPassword') || $errors->has('newPassword') || $errors->has('renewPassword'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 0 auto;  margin-bottom: 10px; width: 500px;">
                        @if ($errors->count() > 1)
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @else
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
          
                <div class="row mb-3" id="passwordSuccessAlert">
                  @if(session('passwordSuccess'))
                      <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                          {{ session('passwordSuccess') }}
                          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>
                  @endif
              </div>

                   <div class="row mb-3" >
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label" style="color: #607E77;">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label" style="color: #607E77;">New Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                    </div>
                </div>
        
                <div class="row mb-3">
                    <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label" style="color: #607E77;">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                        <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                    </div>
                </div>
        
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->


                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>


  </main><!-- End #main --> --}}
{{-- 
    @include('admin-partials.footer') --}}

    <!DOCTYPE html>
    <html lang="en">
      <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Admin Create Account</title>
        @include('admin-partials.admin-header')
        <style>
          .table-responsive td {
          max-width: 250px; 
          white-space: normal;
        }
        </style>
      </head>
      <body>
        @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
    
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">My Profile</h3>
            </div>
            <div class="row">
              <div class="col-xl-12 " >
              </div>
      
              <div class="col-xl-12">
      
                <div class="card">
                  <div class="card-body pt-3">
                    <!-- Bordered Tabs -->
                    <ul class="nav nav-tabs nav-tabs-bordered">
      
                      <li class="nav-item">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                      </li>
      
                      <li class="nav-item">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                      </li>
      
                    </ul>
                    <div class="tab-content pt-2">
      
                      <div class="tab-pane fade show active profile-overview" id="profile-overview">
                        <br>
                        <h5 class="card-title">Profile Details</h5>
      
                        <div class="row mb-2">
                          <div class="col-lg-3 col-md-4 label ">First Name</div>
                          <div class="col-lg-9 col-md-8">  {{ Session::get('adminFirstName') }} {{ Session::get('adminLastName') }}</div>
                        </div>
      
                        <div class="row mb-2">
                          <div class="col-lg-3 col-md-4 label ">Last Name</div>
                          <div class="col-lg-9 col-md-8">{{ Session::get('adminLastName') }}</div>
                        </div>
      
                        <div class="row mb-2">
                          <div class="col-lg-3 col-md-4 label">Email</div>
                          <div class="col-lg-9 col-md-8">  {{ Session::get('adminEmail') }} </div>
                        </div>
      
                        <div class="row mb-2">
                          <div class="col-lg-3 col-md-4 label">Contact Number</div>
                          <div class="col-lg-9 col-md-8">{{ Session::get('adminContactNumber') }}</div>
                        </div>
      
                      </div>
      
                      <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
      
                        <!-- Profile Edit Form -->
                        <form method="POST" action="{{ route('admin.profile-update') }}">
                          @csrf 
                          <div class="row mb-3" id="profileSuccessAlert">
                            @if(session('profileSuccess'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert" style=" text-align: center;">
                                    {{ session('profileSuccess') }}
                                   
                                </div>
                            @endif
                        </div>
      
                          <div class="row mb-3">
                            <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="firstName" type="text" class="form-control" id="firstName" value="{{ Session::get('adminFirstName') }}" required>
                            </div>
                          </div>
      
                          <div class="row mb-3">
                            <label for="lastName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="lastName" type="text" class="form-control" id="lastName" value="{{ Session::get('adminLastName') }}" required>
                            </div>
                          </div>
      
                          <div class="row mb-3">
                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="email" type="text" class="form-control" id="email" value="{{ Session::get('adminEmail') }}" required>
                            </div>
                          </div>
      
                          <div class="row mb-3">
                            <label for="contactNumber" class="col-md-4 col-lg-3 col-form-label">Contact Number</label>
                            <div class="col-md-8 col-lg-9">
                              <input name="contactNumber" type="text" class="form-control" id="contactNumber" value="{{ Session::get('adminContactNumber') }}" required>
                            </div>
                          </div>
      
                          <div class="text-center">
                            <button type="submit" class="btn custom-btn">Save Changes</button>
                          </div>
                        </form><!-- End Profile Edit Form -->
      
                      </div>
      
        
                      <div class="tab-pane fade pt-3" id="profile-change-password">
                        <!-- Change Password Form -->
                        <form method="POST" action="{{ route('admin.password-update') }}">
                          @csrf
                          @if ($errors->has('currentPassword') || $errors->has('newPassword') || $errors->has('renewPassword'))
                          <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 0 auto;  margin-bottom: 10px; width: 500px;">
                              @if ($errors->count() > 1)
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                      @endforeach
                                  </ul>
                              @else
                                  @foreach ($errors->all() as $error)
                                      {{ $error }}
                                  @endforeach
                              @endif
                              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                      @endif
                
                      <div class="row mb-3" id="passwordSuccessAlert">
                        @if(session('passwordSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                                {{ session('passwordSuccess') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    </div>
      
                         <div class="row mb-3" >
                          <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                          </div>
                      </div>
              
                      <div class="row mb-3">
                          <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="newPassword" type="password" class="form-control" id="newPassword" required>
                          </div>
                      </div>
              
                      <div class="row mb-3">
                          <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                          <div class="col-md-8 col-lg-9">
                              <input name="renewPassword" type="password" class="form-control" id="renewPassword" required>
                          </div>
                      </div>
              
                          <div class="text-center">
                            <button type="submit" class="btn custom-btn ">Change Password</button>
                          </div>
                        </form><!-- End Change Password Form -->
                      </div>
                    </div><!-- End Bordered Tabs -->
                  </div>
                </div>
              </div>
            </div>
            <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
  
            <script src="../assets-new-admin/js/off-canvas.js"></script>
            <script src="../assets-new-admin/js/misc.js"></script>
              <!-- Vendor JS Files -->
            <script src="../assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
            <script src="../assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        
            <script src="../assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
            <script src="../assets-admin/vendor/tinymce/tinymce.min.js"></script>
            <script src="../assets-admin/vendor/php-email-form/validate.js"></script>
            <script src="../assets-admin/tinymce/tinymce.min.js"></script>
          
            <script src="../assets-admin/vendor/chart.js/chart.umd.js"></script>
            <script src="../assets-admin/vendor/echarts/echarts.min.js"></script>
            <script src="../assets-admin/vendor/quill/quill.min.js"></script>
            
            <!-- Template Main JS File -->
            <script src="../assets-admin/js/main.js"></script>

    {{-- <script>

    document.addEventListener('DOMContentLoaded', function () {
        let lastTab = sessionStorage.getItem('lastTab');
        if (lastTab) {
            let tabLink = document.querySelector(`[data-bs-target="${lastTab}"]`);
            if (tabLink) {
                let tab = new bootstrap.Tab(tabLink);
                tab.show();
            }
        }

 
    let tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabLinks.forEach(function (tabLink) {
        tabLink.addEventListener('shown.bs.tab', function (event) {
            let activeTab = event.target.getAttribute('data-bs-target');
            sessionStorage.setItem('lastTab', activeTab);
            });
        });

    });

    </script>

    <script>
      document.querySelectorAll('.alert .btn-close').forEach(function(closeBtn) {
          closeBtn.addEventListener('click', function() {
              this.parentNode.style.display = 'none';
          });
      });
    </script> --}}
      
</body>

</html>