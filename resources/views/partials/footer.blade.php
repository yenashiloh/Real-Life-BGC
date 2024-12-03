
<footer id="footer" class="footer footer-section footer-mobile">
    <div class="footer-top" style="margin-top: 0; background-color: #71BF44;">
        <div class="container ">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-4 col-12 footer-links mb-4 ml-md-12">
                    <h4 class="footer-title" style="color: white; font-size: 18px; ">About</h4>
                    <ul>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/#mission_statement">Mission</a></li>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/#educational_assistance">Educational
                                Assistance</a></li>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/#character_formation">Character
                                Formation</a></li>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/#leadership_development">Leadership
                                Development</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12 footer-links mb-4">
                    <h4 class="footer-title" style="color: white; font-size: 18px;">Resources</h4>
                    <ul>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/faq">FAQ</a></li>
                        <li><i class="fa fa-chevron-right thin-chevron" class="f-para footer-text"
                                style="color:#ffffff;"></i> <a href="/announcement">Announcement</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4 col-12 footer-contact mb-4">
                    <h4 class="footer-title" style="color: white; font-size: 18px;">Contact Us</h4>
                    <p style=" color: rgb(243, 243, 243);    font-size: 17px;">
                        32nd Street corner
                        <br>
                        Bonifacio Global City, <br>
                        1634 Philippines<br><br>
                        <strong>Email:</strong>bgc@reallife.ph<br>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="copyright" style="color: #313131;">
            &copy; Copyright <strong>Real LIFE Foundation</strong>. All Rights Reserved
        </div>
    </div>
</footer>

<script src="assets-applicant/js/jquery-3.3.1.min.js"></script>
<script src="assets-applicant/js/bootstrap.min.js"></script>
<script src="assets-applicant/js/jquery.magnific-popup.min.js"></script>
<script src="assets-applicant/js/jquery.nice-select.min.js"></script>
<script src="assets-applicant/js/jquery-ui.min.js"></script>
<script src="assets-applicant/js/jquery.slicknav.js"></script>
<script src="assets-applicant/js/owl.carousel.min.js"></script>
<script src="assets-applicant/js/main.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const loadingSpinner = document.getElementById('loading-spinner');
        const logo = document.getElementById('loading-logo');
    
        function showContent() {
            setTimeout(() => {
                loadingSpinner.style.opacity = '0';
                setTimeout(() => {
                    loadingSpinner.style.display = 'none';
                }, 300);
            }, 1000);
        }
    
        loadingSpinner.style.opacity = '1';
        loadingSpinner.style.display = 'flex';
        logo.style.opacity = '1';
    
        showContent();
    });
    </script>