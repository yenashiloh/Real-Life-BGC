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
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="/dashboard" id="dashboard-link">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" id="applicants-link">
          <i class="bi bi-menu-button-wide" ></i><span>Applicants</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
          <li>
            <a href="{{ route('admin.applicants.new_applicants') }}">
              <i class="bi bi-circle"></i><span>All Applicants</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.applicants.approved_applicants') }}">
              <i class="bi bi-circle"></i><span>Approved Applicants</span>
            </a>
          </li>
          <li>
            <a href="{{ route('admin.applicants.declined_applicants') }}">
              <i class="bi bi-circle"></i><span>Declined Applicants</span>
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
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
      <section class="section dashboard">
        <div class="row">
          <!-- Total of Applicants Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card sales-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total of Applicants</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6>{{ $totalApplicants }}</h6>
                    </div>
                </div>
              </div>
            </div>
          </div><!-- End Total of Applicants Card -->
      
          <!-- Shortlisted Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card revenue-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total of Shortlisted</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-journal-text"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalShortlisted }}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Shortlisted Card -->
      
          <!-- Total for Interview Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card interview">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total for Interview</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalForInterview}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total for Interview Card -->
        </div>

        <div class="row">
          <!-- Total for house visitation Card -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card house-visit-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total for House Visitation</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-house"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalHouseVisitation}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total for house visitation Card -->
      
          <!-- of Declined Applicants -->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card accepted-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total of Approved</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-check"></i>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalApproved}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End of Declined Applicants -->
      
          <!-- Total Accepted Applicants-->
          <div class="col-xxl-4 col-md-4">
            <div class="card info-card declined-card">
              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>
                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>
              <div class="card-body">
                <h5 class="card-title">Total of Declined</h5>
                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-person-x"></i>
                    <h6></h6>
                  </div>
                  <div class="ps-3">
                    <h6>{{ $totalDeclined}}</h6>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- End Total Accepted Applicants-->
        </div>

            <!-- Reports -->
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Grade School / Year Level</h5>
    
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
            </div><!-- End Reports -->
          </div>
        </div><!-- End Left side columns -->
        <!-- Right side columns -->
        <div class="col-lg-4">
          <!-- End activity item-->  
        </div><!-- End Right side columns -->
      </div>
    </section>
  </main><!-- End #main -->
 
  @include('admin-partials.footer')

</body>

</html> --}}
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
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets-new-admin/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="../assets-new-admin/css/style.css">
    <!-- End layout styles -->
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
                              <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                <label class="form-check-label" for="flexSwitchCheckDefault">On/Off the Application</label>
                            </div>
                          </div>
                          <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <a href="{{ route('admin.announcement.add-announcement') }}" class="btn px-0"> <i class="icon-screen-tablet mr-2"></i> Add Announcement</a>
                              </div>
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <a href="{{ route('admin.registration') }}" class="btn px-0"><i class="icon-user-follow mr-2"></i>Create Account</a>
                              </div>
                              <div class="col-sm-6 col-md-4 p-3 text-center btn-wrapper">
                                  <button type="button" class="btn px-0"><i class="icon-layers mr-2"></i>Create Content</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          
      <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-sm-flex align-items-baseline report-summary-header">
                                <h5 class="font-weight-semibold">Report Summary</h5> <span class="ml-auto">Updated Report</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF APPLICANTS</span>
                                <h4>{{ $totalApplicants }}</h4>
                            </div>
                            <div class="inner-card-icon bg-primary">
                                <i class="icon-user"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF SHORTLISTED</span>
                                <h4>{{ $totalShortlisted }}</h4>
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-notebook"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF INTERVIEW</span>
                                <h4>{{ $totalForInterview}}</h4>
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
                                <h4>{{ $totalHouseVisitation}}</h4>
                            </div>
                            <div class="inner-card-icon bg-info">
                                <i class="icon-home"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF DECLINED</span>
                                <h4>{{ $totalDeclined}}</h4>
                            </div>
                            <div class="inner-card-icon bg-danger">
                                <i class="icon-user-unfollow"></i>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">TOTAL OF APPROVED</span>
                                <h4>{{ $totalApproved}}</h4>
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
                        <div class="input-group" id="income-expense-summary-chart-daterange">
                          <div class="inpu-group-prepend input-group-text"><i class="icon-calendar"></i></div>
                          <input type="text" class="form-control">
                          <div class="input-group-prepend input-group-text"><i class="icon-arrow-down"></i></div>
                        </div>
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
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                      <h4 class="card-title mb-sm-0">Applicants</h4>
                      <a href="#" class="text-dark ml-auto mb-3 mb-sm-0"> View all Applicants</a>
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
          </div>
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

{{-- <script>
(function($) {
  'use strict';

  // Function to fetch data from the server
  function fetchData() {
    $.ajax({
      url: '/getApplicantsByGradeYear', // Update the URL based on your server setup
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        updateChart(data);
      },
      error: function(error) {
        console.error('Error fetching data:', error);
      }
    });
  }

  // Function to update the chart with fetched data
  function updateChart(data) {
    if ($('#ct-chart-line').length) {
      // Filter out decimal values
      const wholeNumbers = data.counts.filter(value => Number.isInteger(value));

      new Chartist.Line('#ct-chart-line', {
        labels: data.labels,
        series: [wholeNumbers] // Remove the extra array around wholeNumbers
      }, {
        fill: false,
        tension: 0.1,
        chartPadding: {
          right: 0
        }
      });
    }
  }

  // Fetch data on document ready
  $(document).ready(function() {
    fetchData();
  });

})(jQuery);


</script> --}}