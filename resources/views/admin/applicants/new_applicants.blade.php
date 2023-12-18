
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
                  <tr> 
                    @foreach($applicantsData as $applicant)
                    <th scope="row">{{ $loop->index + 1 }}</th>
                      <td> {{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                      {{-- <td>{{ $applicant->last_name }}</td> --}}
                      <td>{{ $applicant->incoming_grade_year }}</td>
                      <td>{{ $applicant->current_school }}</td> 
                    <td> <span class="badge" style="background-color: #CFE2FF; color: #0B2C5F; font-weight: medium; font-size: 13px; font-weight: normal; ">For Review</span></td>
                    <td>
                      <div class="dropdown">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 13px; height: 33px;" >
                          Action
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                          <li><a class="dropdown-item" href="#" style="color: #67A3F0; text-align:center;">Under Review</a></li>
                          <div class="dropdown-divider"></div>
                          <li><a class="dropdown-item" href="#" style="color: red;  text-align:center;">Declined</a></li>
                        </ul>
                        <div class="view-button"><button class="btn btn-secondary" style="font-size: 13px; margin-top: 5px; width: 77px; height: 31px;">View</button></div>
                      </div>
                      </td>        
                  </tr>
                    @endforeach
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
      
  @include('admin-partials.footer')

</body>

</html>