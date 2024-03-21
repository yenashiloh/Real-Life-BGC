<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Approved Applicants</title>
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
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="page-header">
          <h3 class="page-title">Approved Applicants</h3>
        </div>
    
        <div class="row">
          <div class="col-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <button type="button" class="btn btn-success btn-fw" style="font-size: 12px; margin-bottom: 10px;">
                  Export as Excel
                </button>
                <div class="loader"></div>
                <!-- Table with stripped rows -->
                <div class="table-responsive">
                  <table class="table table-striped datatable">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date Applied</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Incoming Grade/Year Level</th>
                        <th scope="col">School</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $count = 1;
                      @endphp
                      @foreach($applicantsData as $applicant)
                      <tr>
                        <th scope="row">{{ $count }}</th>
                        <td>{{ \Carbon\Carbon::parse($applicant->created_at)->format('F d, Y') }}</td>
                        <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                        <td>{{ $applicant->incoming_grade_year }}</td>
                        <td>{{ $applicant->current_school }}</td>
                        <td>
                          <span id="status-{{ $applicant->applicant_id }}" class="badge badge-success" >
                            {{ $applicant->status }}
                          </span>
                        </td>
                        <td>
                          <div class="view-button">
                            <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}"
                              class="btn btn-dark btn-fw p-2" >
                              View
                            </a>
                          </div>
                        </td>
                      </tr>
                      @php
                      $count++;
                      @endphp
                      @endforeach
                    </tbody>
                  </table>
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

<script>
  $(document).ready(function() {
    function updateApplicantsCount() {
      var count = $('tbody tr').length;
      $('#applicantsCount').text(count);
    }
    updateApplicantsCount();
    function updateCountOnStatusChange() {
      updateApplicantsCount();
    }

    $(document).on('click', '.dropdown-item', function(e) {
      e.preventDefault();
      var applicant_id = $(this).data('applicant-id');
      var updateRoute = $(this).data('route');
      var action = $(this).data('action');

      if (!applicant_id || !updateRoute || !action) {
        console.log('Invalid data');
        return;
      }

      $('.alert').remove();

      $.ajax({
        type: 'POST',
        url: updateRoute,
        data: {
          _token: '{{ csrf_token() }}',
          applicant_id: applicant_id,
          status: action
        },
        success: function(response) {
          console.log('Success:', response);
          if (response.success) {
            console.log('Status updated successfully');
            var applicantId = applicant_id;
            var newStatus = action;
            var applicantFullName = $('#status-' + applicantId).closest('tr').find('td:eq(2)').text();

            var alertHTML = '<div class="alert alert-success" role="alert" style="text-align:center;">' +
              '<strong>' + applicantFullName + ' is change the status to ' + newStatus + '</strong>' +
              '</div>';
            $('.datatable').before(alertHTML);
            $('#status-' + applicantId).text(newStatus);

            if (newStatus !== 'Approved') {
              $('tbody tr').each(function() {
                var statusText = $(this).find('td:eq(4)').text().trim(); 
                if (statusText !== 'Approved') {
                  $(this).remove(); 
                }
              });
            }

            updateCountOnStatusChange();

            setTimeout(function() {
              $('.alert').remove();
            }, 8000); 
          } else {
            console.log('Failed to update status:', response.error);
          }
        },
        error: function(xhr, status, error) {
          console.log('Error:', error);
        }
      });
    });
  });
</script>





