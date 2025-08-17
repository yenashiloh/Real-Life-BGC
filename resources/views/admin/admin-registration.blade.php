<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Create Account</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('admin-partials.link')
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <div id="loading-spinner" class="loading-spinner">
        <div class="loading-content">
            <img src="../admin-assets/img/RLlogo.png" alt="Logo" class="loading-logo" id="loading-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <div class="wrapper">
        @include('admin-partials.sidebar')

        <div class="main-panel">
            @include('admin-partials.header')
        </div>

        <div class="container">
            <div class="page-inner">
                <div class="page-header">
                    <h3 class="fw-bold mb-3">Create Account</h3>
                    <ul class="breadcrumbs mb-3">
                        <li class="nav-home">
                            <a href="{{ route('dashboard') }}">
                                <i class="icon-home"></i>
                            </a>
                        </li>
                        <li class="separator">
                            <i class="icon-arrow-right"></i>
                        </li>
                        <li class="nav-item">
                            <a href="{{route ('admin.registration')}}">Create Account</a>
                        </li>
                    </ul>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert"
                        style="margin: 0 auto; margin-bottom: 10px;">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                
                                <!-- Multi Columns Form -->
                                <form id="registerForm" class="row g-3 needs-validation" novalidate
                                    data-csrf="{{ csrf_token() }}"
                                    data-submit-url="{{ route('admin.register.submit') }}">
                                    @csrf

                                    <div class="col-md-6">
                                        <label for="firstName" class="form-label">First Name</label>
                                        <input type="text" id="errorInput" name="firstname" class="form-control"
                                            required>
                                        <div class="invalid-feedback">Enter your first name</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="lastName" class="form-label">Last Name</label>
                                        <input type="text" name="lastname" class="form-control" id="lastName"
                                            required>
                                        <div class="invalid-feedback">Enter your last name</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="yourEmail" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="yourEmail"
                                            required>
                                        <div class="invalid-feedback">Enter a valid email address</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="contact_no" class="form-label">Contact Number</label>
                                        <input type="text" name="contact_no" class="form-control" id="contact_no"
                                            required>
                                        <div class="invalid-feedback">Enter your contact number</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="yourPassword" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password"
                                            required>
                                        <div class="invalid-feedback">Enter your password</div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="yourConfirmPassword" class="form-label">Confirm Password</label>
                                        <input type="password" name="password_confirmation" class="form-control"
                                            id="confirm_password" required>
                                        <div class="invalid-feedback">Confirm your password</div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success custom-btn" type="submit"
                                            id="submitBtn">Create Account</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin-partials.footer')
        <script src="../admin-assets/js/create-account.js"></script>
