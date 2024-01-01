@include('partials.header')
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap");


#timeline {
  --color: rgba(30, 30, 30);
  --bgColor: rgba(245, 245, 245);
  min-height: 100vh;
  display: grid;
  align-content: center;
  gap: 2rem;
  padding: 2rem;
  font-family: "Poppins", sans-serif;
  color: var(--color);

} 



h1 {
  text-align: center;
}

.timeline_ul {
  --col-gap: 2rem;
  --row-gap: 2rem;
  --line-w: 0.25rem;
  display: grid;
  grid-template-columns: var(--line-w) 1fr;
  grid-auto-columns: max-content;
  column-gap: var(--col-gap);
  list-style: none;
  width: min(60rem, 90%);
  margin-inline: auto;
}

/* line */
.timeline_ul::before {
  content: "";
  grid-column: 1;
  grid-row: 1 / span 20;
  background: rgb(225, 225, 225);
  border-radius: calc(var(--line-w) / 2);
}

/* columns*/

/* row gaps */
.timeline_ul li:not(:last-child) {
  margin-bottom: var(--row-gap);
}

/* card */
.timeline_ul li {
  grid-column: 2;
  --inlineP: 1.5rem;
  margin-inline: var(--inlineP);
  grid-row: span 2;
  display: grid;
  grid-template-rows: min-content min-content min-content;
}

/* date */
.timeline_ul li .date {
  --dateH: 3rem;
  height: var(--dateH);
  margin-inline: calc(var(--inlineP) * -1);

  text-align: center;
  background-color: var(--accent-color);

  color: white;
  font-size: 1.25rem;
  font-weight: 700;

  display: grid;
  place-content: center;
  position: relative;

  border-radius: calc(var(--dateH) / 2) 0 0 calc(var(--dateH) / 2);
}

/* date flap */
.timeline_ul li .date::before {
  content: "";
  width: var(--inlineP);
  aspect-ratio: 1;
  background: var(--accent-color);
  background-image: linear-gradient(rgba(0, 0, 0, 0.2) 100%, transparent);
  position: absolute;
  top: 100%;

  clip-path: polygon(0 0, 100% 0, 0 100%);
  right: 0;
}

/* circle */
.timeline_ul li .date::after {
  content: "";
  position: absolute;
  width: 2rem;
  aspect-ratio: 1;
  background: var(--bgColor);
  border: 0.3rem solid var(--accent-color);
  border-radius: 50%;
  top: 50%;

  transform: translate(50%, -50%);
  right: calc(100% + var(--col-gap) + var(--line-w) / 2);
}

/* title descr */
.timeline_ul li .title,
.timeline_ul li .descr {
  background: var(--bgColor);
  position: relative;
  padding-inline: 1.5rem;
}
.timeline_ul li .title {
  overflow: hidden;
  padding-block-start: 1.5rem;
  padding-block-end: 1rem;
  font-weight: 500;
}
.timeline_ul li .descr {
  padding-block-end: 1.5rem;
 font-size: 15px; 
}

/* shadows */
.timeline_ul li .title::before,
.timeline_ul li .descr::before {
  content: "";
  position: absolute;
  width: 90%;
  height: 0.5rem;
  background: rgba(0, 0, 0, 0.5);
  left: 50%;
  border-radius: 50%;
  filter: blur(4px);
  transform: translate(-50%, 50%);
}
.timeline_ul li .title::before {
  bottom: calc(100% + 0.125rem);
}

.timeline_ul li .descr::before {
  z-index: -1;
  bottom: 0.25rem;
}

@media (min-width: 40rem) {
  .timeline_ul {
    grid-template-columns: 1fr var(--line-w) 1fr;
  }
  .timeline_ul::before {
    grid-column: 2;
  }
  .timeline_ul li:nth-child(odd) {
    grid-column: 1;
  }
  .timeline_ul li:nth-child(even) {
    grid-column: 3;
  }

  /* start second card */
  .timeline_ul li:nth-child(2) {
    grid-row: 2/4;
  }

  .timeline_ul li:nth-child(odd) .date::before {
    clip-path: polygon(0 0, 100% 0, 100% 100%);
    left: 0;
  }

  .timeline_ul li:nth-child(odd) .date::after {
    transform: translate(-50%, -50%);
    left: calc(100% + var(--col-gap) + var(--line-w) / 2);
  }
  .timeline_ul li:nth-child(odd) .date {
    border-radius: 0 calc(var(--dateH) / 2) calc(var(--dateH) / 2) 0;
  }
}

.credits {
  margin-top: 1rem;
  text-align: right;
}
.credits a {
  color: var(--color);
}

</style>

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
                <p style="font-size: 21px; color: #454545;">Real LIFE Foundation is a Philippine nongovernmental
                    organization that exists to honor God by serving and empowering the underprivileged youth of the
                    Philippines through educational assistance, character formation, and leadership development.</p>
            </div>
            <br><br>
            <div class="section-title" id="educational_assistance" >
                <h3 style="color:#71BF44">What we do</h3>
                <img src="assets/img/cup.png" alt="" style="max-width: 40%; height: auto; " class="image_about">
                <div class="section-title">
                    <h2>educational assistance</h2>
                    <p style="font-size: 19px; display: inline-block; vertical-align: middle; color: #454545;"
                        class="text-start">
                        We believe that education is the most effective way to empower individuals to lift
                        themselves out of poverty. The financial aid we give to our scholars serves this purpose. On
                        top of covering their tuition and miscellaneous fees, we also provide for the following:
                    </p>
                    <ul style="font-size: 19px; display: inline-block; vertical-align: middle; margin-top: 10px; "
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
                                style="font-size: 19px;">
                                <strong>LIFE Groups -</strong>
                                All Real LIFE scholars are plugged into LIFE Groups where they learn about
                                leadership, integrity, faith, and excellence. This is also where they can share
                                their personal concerns and receive much-needed guidance and encouragement from
                                their coaches.
                            </ul>
                        </div>
                        <div class="row">
                            <div class=" scholar-image col-lg-6 order-1 order-lg-2 mt-4 ">
                                <img src="assets/img/scholar-updates.jpeg" class="img-fluid mb-4  " alt="">
                            </div>
                            <ul class="col-lg-6 pt-lg-0 order-2 order-lg-1 content text-start scholar custom-margin-top-1"
                                style="font-size: 19px;  ">
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
                                <ul style="font-size: 19px; display: inline-block; vertical-align: middle; margin-top: 10px; "
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
                    <section id="timeline" class="timeline-section  team">    

                        <h2>SCHOLARSHIP APPLICATION FLOW</h2>
                        <ul class="timeline_ul">
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">01</div>
                                <div class="title"></div>
                                <div class="descr">Scholarship applications submitted through the form will be reviewed by February 2024.</div>
                            </li>
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">02</div>
                                <div class="title"></div>
                                <div class="descr">The team from the Real LIFE local center where you are filing your application will reach out to you sometime between February and March 2024 to inform you if your application will proceed to the next screening stage.</div>
                            </li>
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">03</div>
                                <div class="title"></div>
                                <div class="descr">If found qualified, you will be invited for a panel interview by March or April 2024. You may be asked to bring in additional documents to complete your application.</div>
                            </li>
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">04</div>
                                <div class="title"></div>
                                <div class="descr">Applicants who pass the panel interview will be visited in their homes by March or April 2024.</div>
                            </li>
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">05</div>
                                <div class="title"></div>
                                <div class="descr">Recommended applications will be forwarded to the Real LIFE National Office for final review and approval by May 2024.</div>
                            </li>
                            <li class="timeline_li" style="--accent-color:#0A6E57;">
                                <div class="date">06</div>
                                <div class="title"></div>
                                <div class="descr">Results of the scholarship applications will be released by the National Office by June-July 2024.</div>
                            </li>                                
                        </ul>
                        {{-- <br><br><br>
                        <div class="section-title">
                            <p style="font-size: 19px; color: #454545;  font-style: italic;">Real LIFE is a member of the Zero Extreme Poverty PH 2030 movement.  
                                We are deliberate in contributing to the following Sustainable Development Goals:</p>
                                <img src="assets/img/pov_1.jpg" alt="" style="height: 200px;"> --}}
                    </section><!-- End Team Section -->
                    </section>
                    </div>
                </div>
            </div>
        </section><!-- End About Us Section -->
    </main><!-- End #main -->

<!-- ======= Footer ======= -->
<img src="assets/img/RL_Banner.png" alt="" style="width:100%; display: block; margin:0%">
<footer id="footer" class="footer" >
    <div class="footer-top" style="margin-top: 0; background-color: rgb(234, 234, 234);">
        <div class="container " >
            <div class="row gy-4" >
                <div class="col-lg-4 col-md-4 col-12 footer-links mb-4 ml-md-12">
                    <h4>About</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right" style="color:#0A6E57;"></i> <a href="#mission_statement">Mission</a></li>
                        <li><i class="bi bi-chevron-right"  style="color:#0A6E57;"></i> <a href="#educational_assistance">Educational
                                Assistance</a></li>
                        <li><i class="bi bi-chevron-right"  style="color:#0A6E57;"></i> <a href="#character_formation">Character
                                Formation</a></li>
                        <li><i class="bi bi-chevron-right"  style="color:#0A6E57;"></i> <a href="#leadership_development">Leadership
                                Development</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12 footer-links mb-4">
                    <h4>Resources</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right" style="color:#0A6E57;"></i> <a href="#">FAQ</a></li>
                        <li><i class="bi bi-chevron-right" style="color:#0A6E57;"></i> <a href="#">Announcement</a></li>
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
            &copy; Copyright <strong>Real LIFE Foundation</strong>. All Rights Reserved
        </div>
    </div>
</footer>
<!-- End Footer -->




<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@include('partials.footer')
