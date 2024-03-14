<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets-new-admin/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets-new-admin/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="../assets-new-admin/vendors/chartist/chartist.min.css">
    <!-- End plugin css for this page -->
    <link rel="stylesheet" href="../assets-new-admin/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets-admin/img/RLlogo1.png" />
  </head>
  <body>
     @include('admin-partials.admin-sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <!-- Quick Action Toolbar Starts-->
            <div class="row quick-action-toolbar">
              <div class="col-md-12 grid-margin">
                  <div class="card">
                      <div class="card-header d-block d-md-flex">
                          <h5 class="mb-0">Quick Actions</h5>
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
                         <div class="ct-chart ct-perfect-fourth" id="ct-chart-line"></div>
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

<script>
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


</script>