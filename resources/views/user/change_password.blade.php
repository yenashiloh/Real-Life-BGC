

@include('partials.header')
    <style>
         .btn {
            margin-top: 20px;
            background-color: #71BF44;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #5cb874;
            color: white;
        }
    </style>
<body>
    @php
        $personalInfo = auth()
            ->user()
            ->personalInformation()
            ->first();
    @endphp
    <main id="main" class="main">
        <section class="section profile">
            <div class="col-xl-11 mx-auto">
                <br><br>
                    <div class="card ">
                        <div class="card-body">
                            <div class="tab-content pt-1">
                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    <br>
                                    {{-- <h5 style="font-weight: bold;"> Welcome, {{ $personalInfo->first_name ?? '' }}! </h5> --}}
                                    <h5 style="font-weight: bold; font-size: 25px;">Change Password</h5>
                                    <br>
    
                                    <form action="{{ route('change.password') }}" method="POST">
                                        @csrf
                                        @if (session('success'))
                                            <div class="alert alert-success" role="alert">
                                                {{ session('success') }}
                                            </div>
                                        @endif
    
                                        @if (session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('error') }}
                                            </div>
                                        @endif
    
                                        @if ($errors->any())
                                            <div class="alert alert-danger" role="alert">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="row mb-3">
                                            <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current
                                                Password</label>
                                            <div class="col-md-8 col-lg-6">
                                                <input name="current_password" type="password" class="form-control"
                                                    id="currentPassword" required>
                                            </div>
                                        </div>
    
                                        <div class="row mb-3">
                                            <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New
                                                Password</label>
                                            <div class="col-md-8 col-lg-6">
                                                <input name="new_password" type="password" class="form-control"
                                                    id="newPassword" required>
                                            </div>
                                        </div>
    
                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                                                Password</label>
                                            <div class="col-md-8 col-lg-6">
                                                <input name="renew_password" type="password" class="form-control"
                                                    id="renewPassword" required>
                                            </div>
                                        </div>
    
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-password" >Change Password</button>
                                        </div>
                                    </form><!-- End settings Form -->
                                </div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
                </section>
            </main><!-- End #main -->
            @include('partials.user-footer')

</body>
</html>


