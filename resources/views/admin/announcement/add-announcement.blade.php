
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Announcement</title>
  
    @include('admin-partials.admin-header')
    <style>
      .table-responsive td {
        max-width: 750px; 
        white-space: normal;
        margin-bottom: 10px; /* Adjust the value based on the amount of space you want */
        padding-bottom: 10px;
    }
 
    </style>  
  </head>
  <body>
    @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">Create Announcement</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="../announcement/admin-announcement">Announcement</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Create Announcement</li>
                </ol>
              </nav>
          </div>

        <form method="POST" action="{{ route('admin.save-announcement') }}" id="announcementForm">
        @csrf
        <div class="row">
          <div class="col-lg-12">
            <div class="card">
              <div class="card-body">
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
                  <div class="form-group">
                    <h6>Title</h6>
                    <input type="text" class="form-control" id="announcement_title" name="announcement_title">
                  </div>
                  <br>
                  <h6>Content</h6>
                  <textarea class="tinymce-editor" name="announcement_caption">
                </textarea>
                <div class="text-center mt-3">
                  <button class="btn btn-fw custom-btn" type="submit">Add Announcement</button>
                </div>
              </div>
            </div>

          </div>
        </div>

         <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
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
</body>
</html>
