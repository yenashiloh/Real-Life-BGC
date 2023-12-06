<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('admin-partials.header')
  @include('admin-partials.sidebar')


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Create Account</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Create Account</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
      <div class="card-body mt-4">
        {{-- <h5 class="card-title">Multi Columns Form</h5> --}}

        @if ($errors->any())
        <div class="alert alert-danger" style="margin: 0 auto;  margin-bottom: 10px; width: 500px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <!-- Multi Columns Form -->
        <form action="{{ route('admin.register.submit') }}" method="POST" class="row g-3 needs-validation" novalidate>
          @csrf
         
          <div class="col-md-6">
            <label for="firstName" class="form-label">First Name</label>
            <input type="text" name="firstname" class="form-control" id="yourName" required>
            <div class="invalid-feedback">Please, enter your first name</div>
          </div>
          <div class="col-md-6">
            <label for="lastName" class="form-label">Last Name</label>
            <input type="text" name="lastname" class="form-control" id="lastName" required>
            <div class="invalid-feedback">Please, enter your last name</div>
          </div>
          <div class="col-md-6">
            <label for="yourEmail" class="form-label">Email Address</label>
            <input type="email" name="email" class="form-control" id="yourEmail" required>
            <div class="invalid-feedback">Please, enter a valid Email adddress</div>
          </div>
          <div class="col-md-6">
            <label for="contact_no" class="form-label">Contact Number</label>
            <input type="text" name="contact_no" class="form-control" id="contact_no" required>
            <div class="invalid-feedback">Please enter your contact number</div>
          </div>
          <div class="col-md-6">
            <label for="yourPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" required>
            <div class="invalid-feedback">Please, enter your password</div>
          </div>
          <div class="col-md-6">
            <label for="yourConfirmPassword" class="form-label">Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" id="confirm_password" required>
            <div class="invalid-feedback">Please, confirm your password</div>
          </div>
      
          
          <div class="text-center mt-4">
            <button class="btn btn-primary" style="width: 200px;" type="submit">Create Account</button>
        </div>        
        </form><!-- End Multi Columns Form -->

      </div>
    </div>

  </div>


    {{-- <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                    <p class="text-center small">Enter your personal details to create account</p>
                  </div>

                   @if ($errors->any())
                      <div class="alert alert-danger">
                          <ul>
                              @foreach ($errors->all() as $error)
                                  <li>{{ $error }}</li>
                              @endforeach
                          </ul>
                      </div>
                  @endif

                  @if(session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  <form action="{{ route('admin.register.submit') }}" method="POST" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" name="firstname" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Please, enter your first name!</div>
                    </div>
                    <div class="col-12">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" name="lastname" class="form-control" id="lastName" required>
                      <div class="invalid-feedback">Please, enter your last name!</div>
                    </div>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Your Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                    </div>
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                  </div>
                  <div class="col-12">
                      <label for="yourConfirmPassword" class="form-label">Confirm Password</label>
                      <input type="password" name="password_confirmation" class="form-control" id="confirm_password" required>
                      <div class="invalid-feedback">Please confirm your password!</div>
                  </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Create Account</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div> --}}
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets-admin/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets-admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets-admin/vendor/chart.js/chart.umd.js"></script>
  <script src="assets-admin/vendor/echarts/echarts.min.js"></script>
  <script src="assets-admin/vendor/quill/quill.min.js"></script>
  <script src="assets-admin/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets-admin/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets-admin/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets-admin/js/main.js"></script>

</body>

</html>
