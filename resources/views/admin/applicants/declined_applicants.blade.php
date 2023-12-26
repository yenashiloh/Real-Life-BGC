<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
@include('admin-partials.header')
@include('admin-partials.sidebar')
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Declined Applicants</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Applicants</li>
          <li class="breadcrumb-item active">Declined Applicants</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Declined Applicants</h5>
              <button type="button" id="exportExcelBtn" class="btn btn-secondary" style="font-size: 12px; width: 120px; margin-bottom: 10px;">Export as Excel</button>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Full Name</th>
                    <th scope="col" >Incoming Grade/Year Level</th>
                    <th scope="col" >School</th>
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
                      <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                      <td>{{ $applicant->incoming_grade_year }}</td>
                      <td>{{ $applicant->current_school }}</td>
                      <td>
                        <span id="status-{{ $applicant->applicant_id }}" class="badge status-declined" style="font-weight: normal;">
                            {{ $applicant->status }}
                          </span>
                      </td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton{{ $applicant->applicant_id }}" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px; height: 33px;">
                              Action
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $applicant->applicant_id }}">
                              <li>
                                <a class="dropdown-item" href="#" data-action="Under Review" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                  Under Review
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-action="Shortlisted" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                  Shortlisted
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-action="For Interview" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                  For Interview
                                </a>
                              </li>
                              <li>
                                <a class="dropdown-item" href="#" data-action="For House Visitation" data-applicant-id="{{ $applicant->applicant_id }}" data-route="{{ route('update.status') }}">
                                  For House Visitation
                                </a>
                              </li>
                            </ul>
                            <div class="view-button">
                              <button class="btn btn-secondary" style="font-size: 13px; margin-top: 5px; width: 77px; height: 31px;">View</button>
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
    </section>

  </main><!-- End #main -->
      
  @include('admin-partials.footer')

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


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
            var applicantFullName = $('#status-' + applicantId).closest('tr').find('td:eq(1)').text();

            var alertHTML = '<div class="alert alert-success" role="alert" style="text-align:center;">' +
              '<strong>' + applicantFullName + ' is change the status to ' + newStatus + '</strong>' +
              '</div>';
            $('.datatable').before(alertHTML);
            $('#status-' + applicantId).text(newStatus);

            if (newStatus !== 'Declined') {
              $('tbody tr').each(function() {
                var statusText = $(this).find('td:eq(4)').text().trim(); 
                if (statusText !== 'Declined') {
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





