<!-- footer start -->
<footer class="rts-footer v_1 {{ $class ?? ''}}">
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-lg-12 col-md-11">
                <!-- footer widget -->
                <div class="row gy-5 gy-lg-0">
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="rts-footer-widget w-320">
                            <a href="{{ route('index') }}" class="d-block rts-footer-logo mb--40">
                                <img src="{{asset('assets/images/logo/footer-logo.svg')}}" alt="Unipix">
                            </a>
                            <p>
                                We are passionate education dedicated to providing high-quality 
                                resources learners all backgrounds.
                            </p>
                            <div class="rts-contact-link">
                                <a href="mailto:contact@reacthemes.com"><i class="fa-sharp fa-light fa-location-dot"></i> Park, Melbourne, Australia </a>
                                <a href="callto:121"><i class="fa-thin fa-phone"></i> 485-826-710</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-2">
                        <div class="rts-footer-widget ">
                            <h6 class="rt-semi">Our Campus</h6>
                            <div class="rts-footer-menu">
                                <ul>
                                    <li><a href="{{ route('academic') }}">Academic</a></li>
                                    <li><a href="{{ route('athletics') }}">Athletics</a></li>
                                    <li><a href="{{ route('campus-life') }}">Campus life</a></li>
                                    <li><a href="reasearch.php">Research</a></li>
                                    <li><a href="{{ route('academic-area') }}">Academic Area</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 col-lg-2">
                        <div class="rts-footer-widget ml--30">
                            <h6 class="rt-semi">Our Campus</h6>
                                <div class="rts-footer-menu">
                                    <ul>
                                        <li><a href="{{ route('scholarship') }}">Scholarship </a></li>
                                        <li><a href="{{ route('tution-fee') }}">Tution Fee</a></li>
                                        <li><a href="{{ route('alumni') }}">Alumni</a></li>
                                        <li><a href="{{ route('faculty') }}">Faculty Staff</a></li>
                                        <li><a href="{{ route('event') }}">Event</a></li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-8 col-lg-3">
                        <div class="rts-footer-widget ml--30">
                            <h6 class="rt-semi">Quick Button</h6>
                            <div class="rts-footer-quick">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="rts-footer-copy-right {{ $cclass ?? ''}}">
    <div class="container">
        <div class="row">
            <div class="rt-center">
                <p class="--p-xs">Copyright &copy; {{date ('Y')}} All Rights Reserved by <a href="#">Unipix</a></p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->