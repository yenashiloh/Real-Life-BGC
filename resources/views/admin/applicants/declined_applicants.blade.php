{{-- <meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ $title }}</title>
@include('admin-partials.header')

<style>
  .loader {
       border: 4px solid rgba(0, 0, 0, 0.1);
       border-top: 4px solid #3498db;
       border-radius: 50%;
       width: 40px;
       height: 40px;
       animation: spin 1s linear infinite;
       position: absolute;
       left: 50%;
       transform: translate(-50%, -50%);
       z-index: 9999;
       display: none;
     }
     @keyframes spin {
       0% { transform: rotate(0deg); }
       100% { transform: rotate(360deg); }
     }
 
 </style>
<aside id="sidebar" class="sidebar">

  <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
      <a class="nav-link collapsed" href="/dashboard" id="dashboard-link">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" id="applicants-link">
        <i class="bi bi-menu-button-wide" ></i><span>Applicants</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav">
        <li>
          <a href="{{ route('admin.applicants.new_applicants') }}" >
            <i class="bi bi-circle"></i><span>All Applicants </span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.applicants.approved_applicants') }}">
            <i class="bi bi-circle"></i><span>Approved Applicants</span>
          </a>
        </li>
        <li>
          <a href="{{ route('admin.applicants.declined_applicants') }}"  class="active">
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
          
              <div class="loader"></div>
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Date Applied</th>
                    <th scope="col">Full Name</th>
                    <th scope="col" >Incoming Grade/Year Level</th>
                    <th scope="col" >School</th>
                    <th scope="col">Status</th>
              
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
                        <span id="status-{{ $applicant->applicant_id }}" class="badge status-declined" style="font-weight: normal;">
                            {{ $applicant->status }}
                          </span>
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


 --}}
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
                <a href="" class="btn btn-success btn-fw" style="font-size: 12px; margin-bottom: 10px;">
                  <i class="icon-cloud-download" style="margin-right:5px;"></i>Export Excel
                </a>
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
                        <td>{{ date('F d, Y', strtotime($applicant->created_at)) }}</td>
                        <td>{{ $applicant->first_name }} {{ $applicant->last_name }}</td>
                        <td>{{ $applicant->incoming_grade_year }}</td>
                        <td>{{ $applicant->current_school }}</td>
                        <td>
                          <span id="status-{{ $applicant->applicant_id }}" class="badge badge-danger">
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
 