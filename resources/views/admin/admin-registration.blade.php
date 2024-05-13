
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
          <h3 class="page-title">Create Account</h3>
        </div>
    
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                @if ($errors->any())
        <div class="alert alert-danger" style="margin: 0 auto;  margin-bottom: 10px; width: 500px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Multi Columns Form -->
        <form action="{{ route('admin.register.submit') }}" method="POST" class="row g-3 needs-validation" novalidate>
          @csrf
         
          <div class="col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" id="yourName" required>
            <div class="invalid-feedback">Please, enter your first name</div>
          </div>
          <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastName" required>
            <div class="invalid-feedback">Please, enter your last name</div>
          </div>
          <div class="col-md-6">
            <label for="yourEmail" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="yourEmail" required>
            <div class="invalid-feedback">Please, enter a valid Email adddress</div>
          </div>
          <div class="col-md-6">
            <label for="contact_no" class="form-label">Contact Number</label>
            <input type="text" name="contact_no" class="form-control" id="contact_no" required>
            <div class="invalid-feedback">Please enter your contact number</div>
          </div>
          <div class="col-md-6">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <div class="invalid-feedback">Please, enter your password</div>
          </div>
          <div class="col-md-6">
            <label for="yourConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="confirm_password" required>
            <div class="invalid-feedback">Please, confirm your password</div>
          </div>
          <div class="text-center mt-4">
            <button class="btn custom-btn" style="width: 200px;" type="submit">Create Account</button>
        </div>        
        </form><!-- End Multi Columns Form -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
        
    <!-- container-scroller -->
    <!-- plugins:js -->
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
    
    <!-- endinject -->
  </body>
</html>
