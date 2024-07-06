<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>All Applicants</title>
    @include('admin-partials.admin-header')
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <style>
         select#year_filter {
        width: 100%; 
    }

    select#year_filter option:hover {
        background-color: blue; 
        color: white; 
    }
    td{
        text-transform: capitalize;
    }
    </style>
 
  </head>
  <body>
    @include('admin-partials.admin-sidebar', ['notifications' => app()->make(\App\Http\Controllers\Admin\AdminController::class)->showNotifications()])
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
                    <div class="btn-group">
                      <button type="button" class="btn custom-btn dropdown-toggle btn-hover-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Export Record
                      </button>
                      <div class="dropdown-menu">
                          <a class="dropdown-item dropdown-blue" href="{{ route('export.applicants', ['format' => 'csv']) }}">CSV</a>
                          <a class="dropdown-item dropdown-blue dropdown-blue" href="{{ route('export.applicants', ['format' => 'excel']) }}">Excel</a>
                      </div>
                  </div>
            
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
                        <tbody id="applicant-table">
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
                                    @if($applicant->status === 'Sent') badge-primary
                                    @elseif($applicant->status === 'Under Review') badge-secondary
                                    @elseif($applicant->status === 'Shortlisted') badge-warning
                                    @elseif($applicant->status === 'For Interview') badge-dark
                                    @elseif($applicant->status === 'For House Visitation') badge-success
                                    @endif
                                    p-2" style="font-weight: normal;">
                                    {{ $applicant->status }}
                                </span>
                                </td>
                                <td>
                               <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle btn-fw p-2" type="button" id="dropdownMenuButton{{ $applicant->applicant_id }}" data-bs-toggle="dropdown" aria-expanded="false" >
                                      Action
                                  </button>
                                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $applicant->applicant_id }}" >
                                      @if($applicant->status === 'Sent')
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Under Review" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Under Review
                                              </a>
                                          </li>
                                          {{-- <li> 
                                             <a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                                  Decline
                                              </a> 
                                         </li> --}}
                                        @elseif($applicant->status === 'Under Review')
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Shortlisted" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                 Approve for Shortlisted
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Decline 
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'Shortlisted')
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="For Interview" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Approve for Interview
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Decline
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'For Interview')
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="For House Visitation" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                 Approve for House Visitation
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Decline
                                              </a>
                                          </li>
                                        @elseif($applicant->status === 'For House Visitation')
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Approved" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                  Approve Scholarship
                                              </a>
                                          </li>
                                          <li>
                                              <a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}" >
                                                Decline
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> --}}
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
                    var action = $(this).data('action');

                    if (action) {
            e.preventDefault();

            var applicantFullName = $(this).closest('tr').find('td:eq(2)').text();

            // Function to capitalize each word
            function capitalizeFullName(name) {
                return name.replace(/\b\w/g, function (char) {
                    return char.toUpperCase();
                });
            }

                // Capitalize the applicant's full name
                var capitalizedFullName = capitalizeFullName(applicantFullName);

                Swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to change ' + capitalizedFullName + '\'s status to "' + action + '" ?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var applicant_id = $(this).data('applicant-id');
                        var updateRoute = $(this).data('route');

                        if (!applicant_id || !updateRoute || !action) {
                            console.log('Invalid data');
                            return;
                        }
                        $('.loader').show();

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
                                        '<strong>' + applicantFullName + ' is now '  + newStatus + '</strong>' +
                                        '</div>';

                                    $('.datatable').before(alertHTML);
                                    $('#status-' + applicantId).text(newStatus);
                                    badgeElement.text(newStatus);

                                    badgeElement.removeClass('badge-primary badge-secondary badge-warning badge-dark badge-success');

                                    switch (newStatus) {
                                        case 'Sent':
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
                                            case 'Sent':
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Under Review" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Under Review</a></li>' +
                                                    '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                                                $('#status-' + applicantId).addClass('badge status-new-applicant');
                                                break;
                                            case 'Under Review':
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Shortlisted" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for Shortlisted</a></li>' +
                                                    '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                                                $('#status-' + applicantId).addClass('badge status-under-review');
                                                break;
                                            case 'Shortlisted':
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="For Interview" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for Interview</a></li>' +
                                                '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                                                $('#status-' + applicantId).addClass('badge status-shortlisted');
                                                break;
                                            case 'For Interview':
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="For House Visitation" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve for House Visitation</a></li>' +
                                                '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                                                $('#status-' + applicantId).addClass('badge status-interview');
                                                break;
                                            case 'For House Visitation':
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Approved" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Approve Scholarship</a></li>' +
                                                '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Declined" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Decline</a></li>';
                                                $('#status-' + applicantId).addClass('badge status-housevisit');
                                                break;
                                            default:
                                                dropdownContent = '<li><a class="dropdown-item dropdown-blue" href="#" data-action="Default Action" data-applicant-id="' + applicantId + '" data-route="{{ route('update.status') }}">Default Action</a></li>';
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
                    }
                });
            }
        });

        const datatables = select('.datatable', true);
        datatables.forEach(datatable => {
            new simpleDatatables.DataTable(datatable);
        });
    });

//   $(document).ready(function() {
//     var table = $('.datatable').DataTable();
    
//     // Retrieve and apply last selected year from localStorage
//     var lastSelectedYear = localStorage.getItem('selectedYear');
//     if (lastSelectedYear) {
//         $('#year_filter').val(lastSelectedYear);
//         applyYearFilter(lastSelectedYear);
//     }
    
//     // Handle year filter change
//     $('#year_filter').change(function() {
//         var selectedYear = $(this).val();
//         console.log('Selected Year:', selectedYear);

//         // Store the selected year in localStorage
//         localStorage.setItem('selectedYear', selectedYear);

//         // Apply year filter to DataTable
//         applyYearFilter(selectedYear);
//     });

//     function applyYearFilter(selectedYear) {
//         // Clear previous search and apply new search
//         table.search('').draw();

//         if (selectedYear) {
//             // Apply custom search function to filter by selected year
//             $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
//                 var rowYear = new Date(data[1]).getFullYear(); // Assuming column 1 is the 'Date Applied' column
//                 return rowYear == selectedYear;
//             });

//             // Redraw the table with the custom filter
//             table.draw();

//             // Remove the custom search function after filtering
//             $.fn.dataTable.ext.search.pop();
//         }

//         // Reset table to page 1
//         table.page('first').draw('page');
//     }
// });
</script>

