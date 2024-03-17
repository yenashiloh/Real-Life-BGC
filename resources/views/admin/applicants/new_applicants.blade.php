<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Applicants</title>
    @include('admin-partials.admin-header')
    <style>
      .table-responsive td {
      max-width: 250px; 
      white-space: normal;
    }
    </style>
  </head>
  <body>
    @include('admin-partials.admin-sidebar')
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">All Applicants </h3>
              
            </div>
        <div class="row">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
              <button type="button" class="btn btn-success btn-fw" style="font-size: 12px; margin-bottom: 10px;">
                <i class="icon-cloud-download" style="margin-right:5px;"></i>Export Excel
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
                                <th scope="col">Incoming Year Level</th>
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
                                    <span id="status-{{ $applicant->applicant_id }}" class="badge
                                        @if($applicant->status === 'New Applicant') badge-primary
                                        @elseif($applicant->status === 'Under Review') badge-secondary
                                        @elseif($applicant->status === 'Shortlisted') badge-warning
                                        @elseif($applicant->status === 'For Interview') badge-dark
                                        @elseif($applicant->status === 'For House Visitation') badge-success
                                        @endif
                                        " >
                                        {{ $applicant->status }}
                                    </span>
                                </td>
                                <td>
                               <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-fw p-2" type="button" id="dropdownMenuButton{{ $applicant->applicant_id }}" data-bs-toggle="dropdown" aria-expanded="false" >
                                      Action
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $applicant->applicant_id }}" >
                                      @if($applicant->status === 'New Applicant')
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Under Review" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: blue;">
                                                  Under Review
                                              </a>
                                          </li>
                                          <li> 
                                             <a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                                  Decline
                                              </a> 
                                         </li>
                                        @elseif($applicant->status === 'Under Review')
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Shortlisted" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: blue;">
                                                  Shortlisted
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: red;">
                                                  Decline Shorlist
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'Shortlisted')
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="For Interview" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: blue;">
                                                  Approve for Interview
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: red;">
                                                  Decline for Interview
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'For Interview')
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="For House Visitation" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: blue;">
                                                 Approve for House Visitation
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: red;">
                                                  Decline for House Visitation
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'For House Visitation')
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Approved" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: blue;">
                                                  Approve Scholarship
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" style="color: red;">
                                                Decline Scholarship
                                              </a>
                                          </li>
                                      @endif
                                  </ul>
                                  <div class="view-button">
                                     <a href="{{ route('admin.view_applicant', ['id' => $applicant->applicant_id]) }}" class="btn btn-dark p-2 btn-fw mt-1">
                                    View
                                </a>
                                  </div>
                                  
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
    
    <!-- endinject -->
  </body>
</html>
<script>
        $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$(document).ready(function() {
  $(document).on('click', '.dropdown-item', function(e) {
    e.preventDefault();
    var applicant_id = $(this).data('applicant-id');
    var updateRoute = $(this).data('route');
    var action = $(this).data('action');
    $('.loader').show();

    console.log('Applicant ID:', applicant_id);
    console.log('Update Route:', updateRoute);
    console.log('Action:', action);

    if (!applicant_id || !updateRoute || !action) {
      console.log('Invalid data');
      return;
    }
    $('.alert').remove();

    $.ajax({
      type: 'POST',
      url: updateRoute,
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        applicant_id: applicant_id,
        status: action
      },
      success: function(response) {
        console.log('Success:', response);
        if (response.success) {
          console.log('Status updated successfully');
          var applicantId = applicant_id;
          var newStatus = action;
          var badgeElement = $('#status-' + applicant_id);
          var applicantFullName = $('#status-' + applicantId).closest('tr').find('td:eq(2)').text(); 
          var alertHTML = '<div class="alert alert-success" role="alert" style="text-align:center;">' +
            '<strong>' + applicantFullName + ' is ' + newStatus + '</strong>' +
            '</div>';

          $('.datatable').before(alertHTML);
          $('#status-' + applicantId).text(newStatus);
          badgeElement.text(newStatus);

          badgeElement.removeClass('badge-primary badge-secondary badge-warning badge-dark badge-success');

          switch (newStatus) {
              case 'New Applicant':
                  badgeElement.addClass('badge-primary');
                  break;
              case 'Under Review':
                  badgeElement.addClass('badge-secondary');
                  break;
              case 'Shortlisted':
                  badgeElement.addClass('badge-warning');
                  break;
              case 'For Interview':
                  badgeElement.addClass('badge-dark');
                  break;
              case 'For House Visitation':
                  badgeElement.addClass('badge-success');
                  break;
              default:
                  badgeElement.addClass('badge-secondary');
                  break;
          }

          if (newStatus === 'Declined' || newStatus === 'Approved') {
            $('#dropdownMenuButton' + applicantId).show();
            $('#dropdownMenuButton' + applicantId).closest('.dropdown').find('.view-button').show();
            $('#status-' + applicantId).closest('tr').remove();
          } else {
            var dropdownContent = '';
            switch (newStatus) {
              case 'New Applicant':
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="Under Review" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Under Review</a></li>' +
                  '<li><a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                  $('#status-' + applicantId).addClass('badge status-new-applicant');
                break;
              case 'Under Review':
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="Shortlisted" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for Shortlisted</a></li>' +
                  '<li><a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline for Shorlisted</a></li>';
                  $('#status-' + applicantId).addClass('badge status-under-review');                
                break;
              case 'Shortlisted':
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="For Interview" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for Interview</a></li>' +
                  '<li><a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                  $('#status-' + applicantId).addClass('badge status-shortlisted');
                break;
              case 'For Interview':
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="For House Visitation" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for House Visitation</a></li>' +
                  '<li><a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                  $('#status-' + applicantId).addClass('badge status-interview');
                break;
              case 'For House Visitation':
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="Approved" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve Scholarship</a></li>' +
                  '<li><a class="dropdown-item" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline Scholarship</a></li>';
                 $('#status-' + applicantId).addClass('badge status-housevisit');
                break;
              default:
                dropdownContent = '<li><a class="dropdown-item" href="#" data-action="Default Action" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Default Action</a></li>';
                break;
            }
             $('#dropdownMenuButton' + applicantId).next('.dropdown-menu').html(dropdownContent);
            }
            setTimeout(function() {
            $('.alert').remove();
          }, 8000);
        } else {
          console.log('Failed to update status:', response.error);
          }
          $('.loader').hide(); 
        },
      error: function(xhr, status, error) {
        console.log('Error:', error);
        $('.loader').hide();
      }
      }); 
    });
  });

  const datatables = select('.datatable', true)
  datatables.forEach(datatable => {
    new simpleDatatables.DataTable(datatable);
  })
</script>

