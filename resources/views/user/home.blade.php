<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Real LIFE Foundation - Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

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
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    <!-- ======= Header ======= -->
    <header id="header" class="shadow-sm d-flex align-items-center">
        <div class="container d-flex align-items-center">
            <a href="index.html" class="logo me-auto"><img src="assets/img/RLlogo.png" alt=""
                    class="img-fluid"></a>
            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="index.html">Home</a></li>
                    <li><a class="nav-link scrollto" href="announcement.html">Announcement</a></li>
                    <li><a class="nav-link scrollto" href="contact_us.html">Contact Us</a></li>
                    <li><a class="nav-link scrollto" href="FAQ.html">FAQ</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-nav d-flex align-items-center">
                <a class="nav-link nav-icon notification-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell bell-icon"></i>
                    <span class="badge bg-primary badge-number">4</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class=""></i>
                        <div>
                            <h4>Shey pempo</h4>
                            <p>You are now for house visitation</p>
                            <p>30 minutes ago</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class=""></i>
                        <div>
                            <h4>Shey Pempo</h4>
                            <p>You are now for interview</p>
                            <p>December 9, 2023</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li class="notification-item">
                        <i class=""></i>
                        <div>
                            <h4>Shey Pampo</h4>
                            <p>You are now is under review</p>
                            <p>November 23, 2023</p>
                        </div>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>

                </ul><!-- End Notification Dropdown Items -->

                </li><!-- End Notification Nav -->

                <div class="nav-item dropdown pe-3 ">
                    <a class="nav-link nav-icon nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <i class="bi bi-person"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2">Paul</span>
                    </a><!-- End Profile Image Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6 class="font-weight: bold; font-size: 5px;">Paul Angelo Derige</h6>
                            <span></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="personal_details.html">
                                <i class="bi bi-person"></i>
                                <span>Personal Details</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                <i class="bi bi-journal-text"></i>
                                <span>Requirements</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                                <i class="bi bi-gear"></i>
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <form action="/logout" method="POST">
                                @csrf
                                <button class="dropdown-item d-flex align-items-center">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Log out</span>
                                </button>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </div><!-- End Profile Nav -->
            </div><!-- End header-nav -->
        </div><!-- End container -->
    </header><!-- End Header -->


    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">

                <!-- Banner -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="assets/img/slide/banner.jpg" alt="Los Angeles" style="width:100%; display: block;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <main id="main">
        <!-- ======= MISSION AND WHO ARE WE ======= -->
        <section class="about" id="mission_statement">
            <div class="container">
                <div class="section-title">
                    <h2>Mission Statement</h2>
                    <p style="font-size: 19px; color: #454545;">Real LIFE Foundation is a Philippine nongovernmental
                        organization that exists to honor God by serving and empowering the underprivileged youth of the
                        Philippines through educational assistance, character formation, and leadership development.</p>
                </div>
                <br><br>
                <div class="section-title" id="educational_assistance">
                    <h3 style="color:#71BF44">What we do</h3>
                    <img src="assets/img/cup.png" alt="" style="max-width: 40%; height: auto; "
                        class="image_about">
                    <div class="section-title">
                        <h2>educational assistance</h2>
                        <p style="font-size: 19px; display: inline-block; vertical-align: middle; color: #454545;"
                            class="text-start">
                            We believe that education is the most effective way to empower individuals to lift
                            themselves out of poverty. The financial aid we give to our scholars serves this purpose. On
                            top of covering their tuition and miscellaneous fees, we also provide for the following:
                        </p>
                        <ul style="font-size: 18px; display: inline-block; vertical-align: middle; margin-top: 10px; "
                            class="text-start">
                            <li> <strong>School-related expenses - </strong>
                                With their school supplies, uniforms, and other school-related expenses provided for,
                                our scholars are able to comply with school requirements and excellently accomplish
                                their projects.
                            </li>
                            <li> <strong>Weekly allowances - </strong>
                                Our scholars no longer need to worry about where to get funds for transportation and
                                meals.
                            </li>
                            <li><strong>Freedom to choose their course strand or program - </strong>
                                Giving our senior high school and college scholars this choice helps them grow in their
                                strengths.
                            </li>
                        </ul>
                        <section id="character_formation">
                            <img src="assets/img/character.png" alt="" style="max-width: 45%; height: auto; "
                                class="image_about">

                            <div class="section-title">
                                <h2>character formation</h2>
                                <p style="font-size: 19px; display: inline-block; vertical-align: middle; color: #454545;"
                                    class="text-start">
                                    We believe that good character is equally important as education in preparing
                                    students for life.
                                </p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 order-lg-1">
                                    <img src="assets/img/life-groups.jpg" class="img-fluid mb-4  " alt="">
                                </div>
                                <ul class="col-lg-6 pt-lg-0 order-2 order-lg-1 content text-start custom-margin-top"
                                    style="font-size: 18px;">
                                    <strong>LIFE Groups -</strong>
                                    All Real LIFE scholars are plugged into LIFE Groups where they learn about
                                    leadership, integrity, faith, and excellence. This is also where they can share
                                    their personal concerns and receive much-needed guidance and encouragement from
                                    their coaches.
                                </ul>
                            </div>
                            <div class="row">
                                <div class=" scholar-image col-lg-6 order-1 order-lg-2 mt-4 ">
                                    <img src="assets/img/scholar-updates.jpeg" class="img-fluid mb-4  "
                                        alt="">
                                </div>
                                <ul class="col-lg-6 pt-lg-0 order-2 order-lg-1 content text-start scholar custom-margin-top-1"
                                    style="font-size: 18px;  ">
                                    <strong>Scholar Updates -</strong>
                                    During these monthly updates, the scholars are able to share their struggles and
                                    wins with one another, building a community they know they can turn to for support.
                                </ul>
                            </div>

                            <section id="leadership_development">
                                <div class="section-title">
                                    <img src="assets/img/leadership.png" alt=""
                                        style="max-width: 40%; height: auto;" class="image_about">
                                    <h2>Leadership development</h2>
                                    <p style="font-size: 19px; display: inline-block; vertical-align: middle; color: #454545;"
                                        class="text-start">
                                        We believe in investing in students because they are the future leaders of the
                                        nation. Our goal is not only to produce graduates but also to contribute to
                                        empowering a generation of future leaders who will make an impact in the
                                        different sectors of society.
                                    </p>
                                    <ul style="font-size: 18px; display: inline-block; vertical-align: middle; margin-top: 10px; "
                                        class="text-start">
                                        <li> <strong>Special workshops -</strong>
                                            Both the Real LIFE national office and local centers regularly hold
                                            workshops for practical life skills and well-being. These arm the scholars
                                            with competence and knowledge to get ahead in life.
                                        </li>
                                        <li> <strong>National Scholars’ Conference -</strong>
                                            The National Scholars’ Conference is an annual event held specifically for
                                            graduating college scholars to prepare them for the working world.
                                        </li>
                                        <li> <strong>Freedom to choose their course strand or program - </strong>
                                            Giving our senior high school and college scholars this choice helps them
                                            grow in their strengths.
                                        </li>
                                    </ul>
                                </div>
                            </section>
                        </section>
                    </div>
                </div>
            </div>
        </section><!-- End About Us Section -->
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer mt-4 mb-4">

        <div class="footer-top">
            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-4 col-md-4 col-12 footer-links mb-4 ml-md-12">
                        <h4>About</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#mission_statement">Mission</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#educational_assistance">Educational
                                    Assistance</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#character_formation">Character
                                    Formation</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#leadership_development">Leadership
                                    Development</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 footer-links mb-4">
                        <h4>Resources</h4>
                        <ul>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">FAQ</a></li>
                            <li><i class="bi bi-chevron-right"></i> <a href="#">Announcement</a></li>

                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-4 col-12 footer-contact mb-4">
                        <h4>Contact Us</h4>
                        <p>
                            32nd Street corner
                            <br>
                            Bonifacio Global City, <br>
                            1634 Philippines<br><br>
                            <strong>Phone:</strong>(632) 8817-1212<br>
                            <strong>Email:</strong>reallifebgc@gmail.com<br>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="copyright ">
                &copy; Copyright <strong><span>Real LIFE Foundation</span></strong>. All Rights Reserved
            </div>
        </div>
    </footer>
    <!-- End Footer -->




    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>

</html>
