
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <meta name="csrf-token" content="{{ csrf_token() }}">
     <title>Declined Applicants</title>
     @include('admin-partials.admin-header')
     <style>
      .table-responsive td {
      max-width: 250px; 
      white-space: normal;
    }
    .loader {
    border: 4px solid rgba(0, 0, 0, 0.1);
    border-left-color:#71BF44; /* Change color as needed */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  /* Loader animation */
  @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
  }

    </style>
   </head>
   <body>
    @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
     <!-- partial -->
     <div class="main-panel">
       <div class="content-wrapper">
         <div class="page-header">
           <h3 class="page-title">Declined Applicants</h3>
         </div>
         <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                      <div class="btn-group">
                        <button type="button" class="btn custom-btn dropdown-toggle btn-hover-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Year
                        </button>
                        <div class="dropdown-menu" aria-labelledby="yearDropdownButton">
                            @foreach($years as $year)
                                <a class="dropdown-item dropdown-blue" href="#" onclick="getDataForYear('{{ $year }}')">{{ $year }}</a>
                            @endforeach
                        </div>
                    </div>
                    <div class="loader" style="display: none;"></div>
                  <div class="table-responsive">
                    <table class="table table-striped datatable" style="display: none;">
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
                          <td>{{ date('F d, Y', strtotime($applicant->created_at)) }}</td>
                          <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                          <td>{{ $applicant->incoming_grade_year }}</td>
                          <td>{{ $applicant->current_school }}</td>
                          <td>
                            <span id="status-{{ $applicant->applicant_id }}" class="badge badge-danger p-2" style="font-weight: normal;">
                                {{ $applicant->status }}
                              </span>
                          </td>
                          <td>
                            <div class="view-button">
                              <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}" class="btn btn-dark p-2 btn-fw mt-1"> View</a>
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
 // Function to show loader and hide table
function showLoader() {
    $('.loader').show();
    $('.datatable').hide();
}

// Function to hide loader and show table
function hideLoader() {
    $('.loader').hide();
    $('.datatable').show();
}

// Function to get data for a specific year
function getDataForYear(year) {
    // Show loader and hide table
    showLoader();

    // Make an AJAX request to fetch data for the selected year
    $.ajax({
        url: "{{ route('ajax.get_declined_applicants') }}",
        type: "GET",
        data: { year: year },
        success: function(response) {
            // Hide loader and show table
            hideLoader();

            // Update table content with the received data
            var tableBody = $('.datatable tbody');
            tableBody.empty(); // Clear existing table rows

            if (response.error) {
                console.error(response.error);
                return;
            }

            $.each(response.applicantsData, function(index, applicant) {
                // Convert created_at to a Date object
                var createdAtDate = new Date(applicant.created_at);

                // Format the date as "Month Day, Year"
                var formattedDate = createdAtDate.toLocaleDateString('en-US', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });

                var row = '<tr>' +
                    '<th scope="row">' + (index + 1) + '</th>' +
                    '<td>' + formattedDate + '</td>' +
                    '<td>' + applicant.first_name + ' ' + applicant.last_name + '</td>' +
                    '<td>' + applicant.incoming_grade_year + '</td>' +
                    '<td>' + applicant.current_school + '</td>' +
                    '<td>' +
                    '<span class="badge badge-danger p-2" style="font-weight: normal;">' +
                    'Declined' +
                    '</span>' +
                    '</td>' +
                    '<td>' +
                    '<div class="view-button">' +
                    '<a href="/applicants/' + applicant.applicant_id + '" class="btn btn-dark p-2 btn-fw mt-1">View</a>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';

                tableBody.append(row);
            });

        },
        error: function(xhr, status, error) {
            console.error(error);
            // Hide loader in case of error and show table
            hideLoader();
        }
    });
}

// Function to initialize selected year from sessionStorage
$(document).ready(function() {
    var selectedYear = sessionStorage.getItem('selectedYear');
    if (selectedYear) {
        // Trigger getDataForYear with the selected year
        getDataForYear(selectedYear);
    }
});

</script>
 