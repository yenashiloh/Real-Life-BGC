@include('partials.header')

<section class="contact-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="contact-text">
                    <h2>Contact Info</h2>
                    <p>Simply submit your name, email address, the nature of your inquiry, and any background
                        information below,
                        and a member of our staff will contact you as soon as possible.</p>
                    <table>
                        <tbody>
                            <tr>
                                <td class="c-o">Address:</td>
                                <td>32nd Street corner University Parkway, Bonifacio Global City, 1634 Philippines</td>
                            </tr>
                            <tr>
                                <td class="c-o">Phone:</td>
                                <td>(632) 8817-1212</td>
                            </tr>
                            <tr>
                                <td class="c-o">Email:</td>
                                <td>bgc@reallife.ph</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-7 offset-lg-1">
                <form action="{{ route('send.email') }}" class="contact-form" method="post">
                    @csrf
                    @if (session()->has('message'))
                        <div id="successMessageContainer" class="alert alert-success" style="text-align: center;">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" name="first_name" class="form-control" style="color: #111111;"
                                id="name" required placeholder="First Name">
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="last_name" style="color: #111111;"
                                id="name" required placeholder="Last Name">
                        </div>
                        <div class="col-lg-12">
                            <input type="email" class="form-control" name="email" style="color: #111111;"
                                id="email" required placeholder="Email">
                        </div>
                        <div class="col-lg-12">
                            <input type="text" class="form-control" name="subject" style="color: #111111;"
                                id="subject" required placeholder="Subject">
                        </div>
                        <div class="col-lg-12">
                            <textarea class="form-control" name="content" rows="10" style="color: #111111;" required
                                placeholder="Your Message"></textarea>
                            <button type="submit" class="text-center" id="submitBtn">
                                <span id="submitText" style="color: white; font-size: 15px;">Send</span>
                                <span id="loadingSpinner"
                                    style="display: none; color: white; font-size: 15px;">Submitting...</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="map">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.8208952517602!2d121.05491107493098!3d14.552232578259352!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c88cbbae5159%3A0x74f74b556bf8cc4f!2sEvery%20Nation%20Philippines%20-%20ENPH!5e0!3m2!1sen!2sph!4v1699699119277!5m2!1sen!2sph"
                height="470" style="border:0;" allowfullscreen=""></iframe>
        </div>
    </div>
</section>

@include('partials.footer')
<script src="assets/js/contact.js"></script>
