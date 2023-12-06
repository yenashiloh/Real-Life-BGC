@include('partials.header')
<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">

        <div class="section-title">
            <h2>Contact Us</h2>
            <br>
            <p style="font-size: 18px; color: #444444;">Simply submit your name, email address, the nature of your
                inquiry, and any background information below, and a member of our staff will contact you as soon as
                possible. </p>
        </div>

        <br>

        <div class="row">
            <div class="col-lg-5 d-flex align-items-stretch">
                <div class="info">
                    <div class="address">
                        <i class="bi bi-geo-alt"></i>
                        <h4>Address</h4>
                        <p>32nd Street corner University Parkway, Bonifacio Global City, 1634 Philippines
                        </p>
                    </div>
                    <div class="phone">
                        <i class="bi bi-telephone"></i>
                        <h4>Phone</h4>
                        <p>(632) 8817-1212</p>
                    </div>

                    <div class="email">
                        <i class="bi bi-envelope"></i>
                        <h4>Email</h4>
                        <p>reallifebgc@gmail.com</p>
                    </div>
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.8208952517602!2d121.05491107493098!3d14.552232578259352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c88cbbae5159%3A0x74f74b556bf8cc4f!2sEvery%20Nation%20Philippines%20-%20ENPH!5e0!3m2!1sen!2sph!4v1699699119277!5m2!1sen!2sph"
                        frameborder="0" style="border:0; width: 100%; height: 300px;" allowfullscreen></iframe>
                </div>
            </div>

            <div class="col-lg-7 mt-5 mt-lg-0 d-flex align-items-stretch">
                <form action="" method="post" role="form" class="php-email-form">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="name">First Name</label>
                            <input type="text" name="first_name" class="form-control" id="name" required>
                        </div>
                        <div class="form-group col-md-6 mt-3 mt-md-0">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" id="name" required>
                        </div>
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Subject</label>
                        <input type="text" class="form-control" name="subject" id="subject" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="name">Message</label>
                        <textarea class="form-control" name="message" rows="10" required></textarea>
                    </div>
                    <div class="my-3">
                        <div class="loading">Loading</div>
                        <div class="error-message"></div>
                        <div class="sent-message">Your message has been sent. Thank you!</div>
                    </div>
                    <div class="text-center"><button type="submit">Send Message</button></div>
                </form>
            </div>
        </div>
    </div>
</section><!-- End Contact Section -->

@include('partials.footer')
