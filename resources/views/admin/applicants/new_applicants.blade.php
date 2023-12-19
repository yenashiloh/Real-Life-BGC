
<title>{{ $title }}</title>
@include('admin-partials.header')
@include('admin-partials.sidebar')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>New Applicants</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Applicants</li>
          <li class="breadcrumb-item active">Applicants</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">New Applicants</h5>
              <button type="button" class="btn btn-secondary" style="font-size: 12px; width: 120px; margin-bottom: 10px;">Export as Excel</button>
              
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
                  @foreach($applicantsData as $applicant)
                  <tr>
                      <th scope="row">{{ $loop->index + 1 }}</th>
                      <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                      <td>{{ $applicant->incoming_grade_year }}</td>
                      <td>{{ $applicant->current_school }}</td>
                      <td>
                        <span id="status-{{ $applicant->id }}" class="badge" style="background-color: #CFE2FF; color: #0B2C5F; font-weight: normal;">
                          {{ $applicant->status }}
                        </span>
                      </td>
                      <td>
                          <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px; height: 33px;">
                                  Action
                              </button>
                              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">  
                                <li>
                                  <a class="dropdown-item under-review" href="#"
                                  data-applicant-id="{{ $applicant->id }}"
                                  data-route="{{ route('update.status') }}"
                                  style="color: #67A3F0; text-align:center;">Under Review
                                </a>
                                </li>
                                  <div class="dropdown-divider"></div>
                                  <li><a class="dropdown-item" href="#" style="color: red;  text-align:center;">Declined</a></li>
                              </ul>
                              <div class="view-button">
                                  <button class="btn btn-secondary" style="font-size: 13px; margin-top: 5px; width: 77px; height: 31px;">View</button>
                              </div>
                          </div>
                      </td>
                  </tr>
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
 <script>
  $(document).ready(function() {
    $('.under-review').on('click', function(e) {
        e.preventDefault();
        var applicant_id = $(this).data('applicant-id'); 
        console.log('Button clicked');
        console.log('Applicant ID:', applicant_id);

        if (!applicant_id) {
            console.log('Applicant ID is empty or undefined');
            return;
        }
        var updateRoute = $(this).data('route');
        console.log('Update Route:', updateRoute);

        $.ajax({
            type: 'POST',
            url: updateRoute,
            data: {
                _token: '{{ csrf_token() }}',
                applicant_id: applicant_id,
                status: 'Under Review'
            },
            success: function(response) {
                console.log('Success:', response);
                if (response.success) {
                    console.log('Status updated successfully');
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

</body>
</html>

