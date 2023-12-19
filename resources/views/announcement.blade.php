@include('partials.header')

<!-- ======= FAQ Section ======= -->

<section id="contact" class="contact">
    <div class="container">
        <div class="section-title">
            <h2>ANNOUNCEMENT</h2>
        </div>
        <div class="container">
            @if($announcement->isEmpty())
                <p style="text-align: center; font-size: 25px; font-weight: normal;">No Announcement</p>
            @else
                @foreach($announcement as $announce)
                    <div class="card shadow-sm mt-4" style="margin-left: 90px; margin-right: 90px;">
                        <div class="card-body">
                            <div style="font-size: 20px; font-weight: bold;">{{ $announce->title }}</div>
                            <p>POSTED BY Real Life BGC || {{ \Carbon\Carbon::parse($announce->created_at)->isoFormat('MMMM D, YYYY, h:mm A') }} ({{ \Carbon\Carbon::parse($announce->created_at)->diffForHumans() }})</p>
                            {!! nl2br($announce->caption) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer" >
    <div class="footer-top" style="margin-top: 0; background-color: rgb(230, 230, 230);">
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




@include('partials.footer')