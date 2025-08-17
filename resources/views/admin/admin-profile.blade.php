<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Profile</title>
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
                    <h3 class="fw-bold mb-3">Profile</h3>
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
                            <a href="{{ route('admin-profile') }}">Profile</a>
                        </li>
                    </ul>
                </div>

                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <ul class="nav nav-tabs nav-tabs-bordered">

                                    <li class="nav-item">
                                        <button class="nav-link active" data-bs-toggle="tab"
                                            data-bs-target="#profile-overview">Overview</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-edit">Edit
                                            Profile</button>
                                    </li>

                                    <li class="nav-item">
                                        <button class="nav-link" data-bs-toggle="tab"
                                            data-bs-target="#profile-change-password">Change Password</button>
                                    </li>

                                </ul>
                                <div class="tab-content pt-2">

                                    <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                        <br>
                                        <h5 class="card-title">Profile Details</h5>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label ">First Name</div>
                                            <div class="col-lg-9 col-md-8"> {{ Session::get('adminFirstName') }}
                                                {{ Session::get('adminLastName') }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label ">Last Name</div>
                                            <div class="col-lg-9 col-md-8">{{ Session::get('adminLastName') }}</div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label">Email</div>
                                            <div class="col-lg-9 col-md-8"> {{ Session::get('adminEmail') }} </div>
                                        </div>

                                        <div class="row mb-2">
                                            <div class="col-lg-3 col-md-4 label">Contact Number</div>
                                            <div class="col-lg-9 col-md-8">{{ Session::get('adminContactNumber') }}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                        <!-- Profile Edit Form -->
                                        <form method="POST" action="{{ route('admin.profile-update') }}">
                                            @csrf
                                            <div class="row mb-3" id="profileSuccessAlert">
                                                @if (session('profileSuccess'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <span>{{ session('profileSuccess') }}</span>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="row mb-3">
                                                <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="firstName" type="text" class="form-control"
                                                        id="firstName" value="{{ Session::get('adminFirstName') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="lastName" class="col-md-4 col-lg-3 col-form-label">Last
                                                    Name</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="lastName" type="text" class="form-control"
                                                        id="lastName" value="{{ Session::get('adminLastName') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email"
                                                    class="col-md-4 col-lg-3 col-form-label">Email</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="email" type="text" class="form-control"
                                                        id="email" value="{{ Session::get('adminEmail') }}"
                                                        required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="contactNumber"
                                                    class="col-md-4 col-lg-3 col-form-label">Contact
                                                    Number</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="contactNumber" type="text" class="form-control"
                                                        id="contactNumber"
                                                        value="{{ Session::get('adminContactNumber') }}" required>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form><!-- End Profile Edit Form -->

                                    </div>


                                    <div class="tab-pane fade pt-3" id="profile-change-password">
                                        <!-- Change Password Form -->
                                        <form method="POST" action="{{ route('admin.password-update') }}">
                                            @csrf
                                            @if ($errors->has('currentPassword') || $errors->has('newPassword') || $errors->has('renewPassword'))
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                    role="alert"
                                                    style="margin: 0 auto;  margin-bottom: 10px; width: 500px;">
                                                    @if ($errors->count() > 1)
                                                        <ul>
                                                            @foreach ($errors->all() as $error)
                                                                <li>{{ $error }}</li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        @foreach ($errors->all() as $error)
                                                            {{ $error }}
                                                        @endforeach
                                                    @endif
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif

                                            <div class="row mb-3" id="passwordSuccessAlert">
                                                @if (session('passwordSuccess'))
                                                    <div class="alert alert-success alert-dismissible fade show"
                                                        role="alert"
                                                        style="margin: 0 auto; text-align: center; margin-bottom: 10px; width: 400px;">
                                                        {{ session('passwordSuccess') }}
                                                        <button type="button" class="btn-close"
                                                            data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row mb-3">
                                                <label for="currentPassword"
                                                    class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="currentPassword" type="password"
                                                        class="form-control" id="currentPassword" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="newPassword" type="password" class="form-control"
                                                        id="newPassword" required>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="renewPassword"
                                                    class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                                    Password</label>
                                                <div class="col-md-8 col-lg-9">
                                                    <input name="renewPassword" type="password" class="form-control"
                                                        id="renewPassword" required>
                                                </div>
                                            </div>

                                            <div class="text-center">
                                                <button type="submit" class="btn btn-success ">Change
                                                    Password</button>
                                            </div>
                                        </form><!-- End Change Password Form -->
                                    </div>
                                </div><!-- End Bordered Tabs -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin-partials.footer')
