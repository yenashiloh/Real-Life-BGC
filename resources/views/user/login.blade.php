<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{ $title }}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />

    <!-- Favicons -->
    <link href="assets/img/RLlogo1.png" rel="icon">
    <link href="assets/img/RLlogo1.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/login.css" rel="stylesheet">

    {{-- Popup Message js --}}
    <script src="//unpkg.com/alpinejs" defer></script>
</head>

<body>
  

    <!----------LOGIN----------->
    <main>
        <div class="container login ">
            <div class="forms">
                <div class="form login">
                    
                    <h5 class="card-title text-center  " style="font-weight: bold; font-size: 25px; color:#0A6E57;">Login</h5>
                    <p class="text-center small" style="margin-top: 10px; font-size: 15px;">Enter your email & password to login</p>
                    <form action="{{ route('login.post') }}" method="POST" autocomplete="">
                        @csrf
                        <div class="input-field">
                            <input type="email" placeholder="Enter your email" name="email" required>
                            <i class="uil uil-envelope icon"></i>
                        </div>
                        <div class="input-field">
                            <input type="password" class="password" placeholder="Enter your password" name="password"
                                required>
                            <i class="uil uil-lock icon"></i>
                            <i class="uil uil-eye-slash showHidePw"></i>
                        </div>

                        <div class="checkbox-text">
                            <div class="checkbox-content">
                                <input type="checkbox" id="logCheck">
                                <label for="logCheck" class="text">Remember me</label>
                            </div>

                            <a href="#" class="text">Forgot password?</a>
                        </div>

                        <div class="input-field button">
                            <input type="submit" value="Login">
                        </div>
                    </form>
                    <div class="login-signup">
                        <x-messages />
                        <span class="text">You want to apply?
                            <a href="/register" class="text signup-link">Apply Now</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->
    <script>
        const container = document.querySelector(".container"),
            pwShowHide = document.querySelectorAll(".showHidePw"),
            pwFields = document.querySelectorAll(".password"),
            signUp = document.querySelector(".signup-link"),
            login = document.querySelector(".login-link");

        pwShowHide.forEach(eyeIcon => {
            eyeIcon.addEventListener("click", () => {
                pwFields.forEach(pwField => {
                    if (pwField.type === "password") {
                        pwField.type = "text";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye-slash", "uil-eye");
                        })
                    } else {
                        pwField.type = "password";

                        pwShowHide.forEach(icon => {
                            icon.classList.replace("uil-eye", "uil-eye-slash");
                        })
                    }
                })
            })
        })
        signUp.addEventListener("click", () => {
            container.classList.add("active");
        });
        login.addEventListener("click", () => {
            container.classList.remove("active");
        });
    </script>
</body>

</html>
