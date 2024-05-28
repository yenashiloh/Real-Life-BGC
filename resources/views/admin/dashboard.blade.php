<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets-new-admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/css/vendor.bundle.base.css">
    <link href="../assets-admin/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets-admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets-new-admin/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="../assets-new-admin/css/style.css">
    <link rel="shortcut icon" href="../assets-admin/img/RLlogo1.png" />
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
              <!-- Quick Action Toolbar Starts-->
              <div class="row quick-action-toolbar">
                  <div class="col-md-12 grid-margin">
                      <div class="card">
                          <div class="card-header d-flex justify-content-between align-items-center">
                              <h5 class="mb-0">Quick Actions</h5>
                              <!-- Inserted switch to the right -->
                              {{-- <div class="form-check form-switch">
                                Application Settings
                                <i class="bi bi-three-dots"></i>
                            </div> --}}
                          </div>
                          <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <a href="{{ route('admin.announcement.add-announcement') }}" class="btn px-0"> <i class="icon-screen-tablet mr-2"></i> Add Announcement</a>
                              </div>
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <a href="{{ route('admin.registration') }}" class="btn px-0"><i class="icon-user-follow mr-2"></i>Create Account</a>
                              </div>
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <button type="button" class="btn px-0"><i class="icon-envelope-open menu-icon mr-2"></i>Email</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          
        <div class="row">
          <div class="col-md-12 grid-margin">
              <div class="card">
                  <div class="card-body">
                    <div id="report-container" class="row">
                      <div class="col-md-12">
                          <div class="d-sm-flex align-items-baseline report-summary-header">
                              <h5 class="font-weight-semibold">Report Summary</h5>  
                              <div class="dropdown ml-auto mb-2">
                                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:rgb(3, 3, 3);">
                                      Filter on Reports
                                  </button>
                                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach ($years as $year)
                                        <a class="dropdown-item filter-year" href="#" data-value="{{ $year }}">{{ $year }}</a>
                                    @endforeach
                                </div>                  
                              </div>
                          </div>
                      </div>
                  </div>
                  
                    <div class="row report-inner-cards-wrapper">
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF APPLICANTS</span>
                                <h4 id="totalApplicants">{{ $totalApplicants }}</h4>
                            </div>
                            <div class="inner-card-icon bg-primary">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF SHORTLISTED</span>
                                <h4 id="totalShortlisted">{{ $totalShortlisted }}</h4>
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-notebook"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF INTERVIEW</span>
                                <h4 id="totalForInterview">{{ $totalForInterview}}</h4>
                            </div>
                            <div class="inner-card-icon bg-dark">
                                <i class="icon-people"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF HOUSE VISITATION</span>
                                <h4 id="totalHouseVisitation">{{ $totalHouseVisitation}}</h4>
                            </div>
                            <div class="inner-card-icon bg-info">
                                <i class="icon-home"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF DECLINED</span>
                                <h4 id="totalDeclined">{{ $totalDeclined}}</h4>
                            </div>
                            <div class="inner-card-icon bg-danger">
                                <i class="icon-user-unfollow"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF APPROVED</span>
                                <h4 id="totalApproved">{{ $totalApproved}}</h4>
                            </div>
                            <div class="inner-card-icon bg-success">
                                <i class="icon-user-following"></i>
                            </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <div class="row">
              <div class="col-md-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="row income-expense-summary-chart-text">
                      <div class="col-xl-5">
                        <h3>Grade Year Level Summary</h3>
                      </div>
                      <div class="col-md-6 col-xl-4 d-flex align-items-center">
                        {{-- <div class="input-group" id="income-expense-summary-chart-daterange">
                          <div class="inpu-group-prepend input-group-text"><i class="icon-calendar"></i></div>
                          <input type="text" class="form-control">
                          <div class="input-group-prepend input-group-text"><i class="icon-arrow-down"></i></div>
                        </div> --}}
                      </div>
                    </div>
                    <div class="row income-expense-summary-chart mt-3">
                      <div class="col-md-12">
                         {{-- <div class="ct-chart ct-perfect-fourth" id="ct-chart-line"></div> --}}
                           <!-- Bar Chart -->
                  <canvas id="barChart" style="max-height: 400px;"></canvas>
                  <script>
                    document.addEventListener("DOMContentLoaded", () => {
                      fetch('/getApplicantsByGradeYear')
                        .then(response => response.json())
                        .then(data => {
                          const labels = data.labels;
                          const counts = data.counts;

                          const randomColor = () => {
                            const r = Math.floor(Math.random() * 256);
                            const g = Math.floor(Math.random() * 256);
                            const b = Math.floor(Math.random() * 256);
                            return `rgba(${r}, ${g}, ${b}, 0.2)`;
                          };

                          const randomBorderColor = () => {
                            const r = Math.floor(Math.random() * 256);
                            const g = Math.floor(Math.random() * 256);
                            const b = Math.floor(Math.random() * 256);
                            return `rgb(${r}, ${g}, ${b})`;
                          };
                          
                          new Chart(document.querySelector('#barChart'), {
                            type: 'bar',
                            data: {
                              labels: labels,
                              datasets: [{
                                label: 'Grade School / Year Level',
                                data: counts,
                                backgroundColor: Array.from({ length: counts.length }, () => randomColor()),
                                borderColor: Array.from({ length: counts.length }, () => randomBorderColor()),
                                borderWidth: 1
                              }]
                            },
                            options: {
                              scales: {
                                y: {
                                  beginAtZero: true
                                }
                              }
                            }
                          });
                        })
                        .catch(error => {
                          console.error('Error fetching data:', error);
                        });
                    });
                  </script>
                  <!-- End Bar CHart -->
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            {{-- <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">Applicants</h4>
                      <a href="/applicants/new_applicants" class="text-dark ml-auto mb-3 mb-sm-0"> View all Applicants</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                      <table class="table">
                        <thead>
                          <tr>
                            <th class="font-weight-bold">#</th>
                            <th class="font-weight-bold">Date Applied</th>
                            <th class="font-weight-bold">Full Name</th>
                            <th class="font-weight-bold">Incoming Year Level</th>
                            <th class="font-weight-bold">School</th>
                            <th class="font-weight-bold">Status</th>

                          </tr>
                        </thead>
                          <tbody>
                            @php $count = 1; @endphp
                            @foreach($applicantsData->take(10) as $applicant)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ date('F d, Y', strtotime($applicant->created_at)) }}</td>
                                <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                                <td>{{ $applicant->incoming_grade_year }}</td>
                                <td>{{ $applicant->current_school }}</td>
                                <td>
                                    <span id="status-{{ $applicant->applicant_id }}" class="badge
                                        @if($applicant->status === 'New Applicant') badge-primary
                                        @elseif($applicant->status === 'Under Review') badge-secondary
                                        @elseif($applicant->status === 'Shortlisted') badge-warning
                                        @elseif($applicant->status === 'For Interview') badge-dark
                                        @elseif($applicant->status === 'For House Visitation') badge-success
                                        @endif
                                        p-2" style="font-weight: normal;">
                                        {{ $applicant->status }}
                                    </span>
                                </td>
                            </tr>
                            @php $count++; @endphp
                            @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="d-flex mt-4 flex-wrap">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets-new-admin/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets-new-admin/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets-new-admin/vendors/moment/moment.min.js"></script>
    <script src="../assets-new-admin/vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../assets-new-admin/vendors/chartist/chartist.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets-new-admin/js/off-canvas.js"></script>
    <script src="../assets-new-admin/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets-new-admin/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
      var chartInstance; // Variable to store the chart instance

      // Check if there's a selected year in localStorage and update the dropdown if it exists
      var selectedYear = localStorage.getItem('selectedYear');
      if (selectedYear) {
          $('.filter-year').removeClass('active');
          $('.filter-year[data-value="' + selectedYear + '"]').addClass('active');
          fetchDataForYear(selectedYear);
          fetchGraphDataForYear(selectedYear);
      }

      // Event listener for clicking a year
      $('.filter-year').click(function(e) {
          e.preventDefault();
          var selectedYear = $(this).data('value');

          // Save the selected year to localStorage
          localStorage.setItem('selectedYear', selectedYear);

          // Update the active state of the clicked year in the dropdown
          $('.filter-year').removeClass('active');
          $(this).addClass('active');

          // Fetch data for the selected year
          fetchDataForYear(selectedYear);
          fetchGraphDataForYear(selectedYear);
      });

      // Function to fetch data for the selected year
      function fetchDataForYear(year) {
          // Make an AJAX request to fetch data for the selected year
          $.ajax({
              url: '/get-data-for-year',
              type: 'GET',
              data: {year: year},
              success: function(data) {
                  // Update the content of the HTML elements with the received data
                  $('#totalApplicants').text(data.totalApplicants);
                  $('#totalShortlisted').text(data.totalShortlisted);
                  $('#totalForInterview').text(data.totalForInterview);
                  $('#totalHouseVisitation').text(data.totalHouseVisitation);
                  $('#totalDeclined').text(data.totalDeclined);
                  $('#totalApproved').text(data.totalApproved);
              },
              error: function(xhr, status, error) {
                  // Handle errors
                  console.error(xhr.responseText);
              }
          });
      }

      // Function to fetch graph data for the selected year
    // Function to fetch graph data for the selected year
// Function to fetch graph data for the selected year
function fetchGraphDataForYear(year) {
    // Make an AJAX request to fetch graph data for the selected year
    $.ajax({
        url: '/get-graph-data-for-year',
        type: 'GET',
        data: {year: year},
        success: function(data) {
            // Filter out labels with count 0
            var filteredLabels = [];
            var filteredCounts = [];
            for (var i = 0; i < data.labels.length; i++) {
                if (data.counts[i] !== 0) {
                    filteredLabels.push(data.labels[i]);
                    filteredCounts.push(data.counts[i]);
                }
            }

            // Destroy the existing chart instance if it exists
            if (chartInstance) {
                chartInstance.destroy();
            }

            // Create a new chart with the filtered data
            createChart(filteredLabels, filteredCounts);
        },
        error: function(xhr, status, error) {
            // Handle errors
            console.error(xhr.responseText);
        }
    });
}

      // Function to create the chart
      function createChart(labels, counts) {
          const randomColor = () => {
              const r = Math.floor(Math.random() * 256);
              const g = Math.floor(Math.random() * 256);
              const b = Math.floor(Math.random() * 256);
              return `rgba(${r}, ${g}, ${b}, 0.2)`;
          };

          const randomBorderColor = () => {
              const r = Math.floor(Math.random() * 256);
              const g = Math.floor(Math.random() * 256);
              const b = Math.floor(Math.random() * 256);
              return `rgb(${r}, ${g}, ${b})`;
          };
          
          const ctx = document.getElementById('barChart').getContext('2d');
          chartInstance = new Chart(ctx, {
              type: 'bar',
              data: {
                  labels: labels,
                  datasets: [{
                      label: 'Grade School / Year Level',
                      data: counts,
                      backgroundColor: Array.from({ length: counts.length }, () => randomColor()),
                      borderColor: Array.from({ length: counts.length }, () => randomBorderColor()),
                      borderWidth: 1
                  }]
              },
              options: {
                  scales: {
                      y: {
                          beginAtZero: true
                      }
                  }
              }
          });
      }
  });
</script>



  

