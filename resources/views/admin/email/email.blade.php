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
          <h3 class="page-title">Email Content  </h3>
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
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#under-review">Under Review</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#shortlisted">Shortlisted</button>
                  </li>
  
                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#interview">Interview</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#house-visitation">House Visitation</button>
                  </li>

                  <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#decline">Decline</button>
                  </li>
  
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active under-review" id="under-review">
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
                      <form method="POST" action="{{ route('admin.save-under-review-content') }}" id="emailContentForm">
                        @csrf
                        <div class="form-group">
                            <br>
                            <h6 class="pt-2">Email Content for Under Review</h6>
                            <textarea class="tinymce-editor" name="under_review">{{ $under_review_data }}</textarea>

                            <div class="text-center mt-3">
                                <button id="submitButton" class="btn btn-primary btn-fw" type="submit">Submit</button>
                            </div>
                    </div>
                  </div>
                </form>

                <div class="tab-pane fade shortlisted pt-3" id="shortlisted">
                    <div class="form-group">
                        <h6 class="pt-2">Email Content for Shortlisted</h6>
                            <textarea class="tinymce-editor" name="announcement_caption"></textarea>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-fw" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
  
    
                <div class="tab-pane fade pt-3" id="interview">
                    <div class="form-group">
                        <h6 class="pt-2">Email Content for Interview</h6>
                            <textarea class="tinymce-editor" name="announcement_caption"></textarea>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-fw" type="submit">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade pt-3" id="house-visitation">
                    <div class="form-group">
                        <h6 class="pt-2">Email Content for House Visitation</h6>
                            <textarea class="tinymce-editor" name="announcement_caption"></textarea>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-fw" type="submit">Submit</button>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade pt-3" id="decline">
                    <div class="form-group">
                        <h6 class="pt-2">Email Content for Decline</h6>
                            <textarea class="tinymce-editor" name="announcement_caption"></textarea>
                        <div class="text-center mt-3">
                            <button class="btn btn-primary btn-fw" type="submit">Submit</button>
                        </div>
                    </div>
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

<script>

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

//*********************************************************//
document.addEventListener('DOMContentLoaded', function () {
    // Check if there's content in local storage
    var underReviewContent = localStorage.getItem('under_review_content');
    var submitButton = document.getElementById('submitButton');
    var textarea = document.querySelector('.tinymce-editor');

    if (underReviewContent) {
        // Content exists, change button text to 'Save Changes'
        submitButton.innerText = 'Save Changes';
        // Fill the textarea with existing content
        textarea.value = underReviewContent;
    }

    // Submit button click event
    document.getElementById('emailContentForm').addEventListener('submit', function (event) {
        var underReviewContent = textarea.value;
        if (underReviewContent) {
            // Content exists, change button text to 'Save Changes'
            submitButton.innerText = 'Save Changes';
            // Store content in local storage
            localStorage.setItem('under_review_content', underReviewContent);
        }
    });
});

</script>
  
</body>

</html>