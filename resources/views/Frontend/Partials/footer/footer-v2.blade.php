<!-- footer start -->
<footer class="rts-footer {{ $class ?? '' }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="rts-footer-newsletter">
                <div class="col-lg-10">
                    <div class="rts-newsletter-box-content">
                        <h4 class="newsletter-title">Subscribe To Newsletter
                        </h4>
                        <div class="newsletter-form w-530">
                            <form action="#">
                                <input type="email" name="subscription" id="subscription" placeholder="Enter Your mail" required="">
                                <button type="submit" class="rts-nbg-btn btn-arrow">Subscribe <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-5 gy-lg-0">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="rts-footer-widget w-320">
                    <a href="{{ route('index') }}" class="d-block rts-footer-logo mb--40">
                        <img src="{{asset('assets/images/logo/logo__white.svg')}}" alt="Unipix">
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
            <div class="col-lg-2 col-md-6 col-sm-6">
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
            <div class="col-lg-2 col-md-6 col-sm-4">
                <div class="rts-footer-widget ml--30">
                    <h6 class="rt-semi">Our Campus</h6>
                        <div class="rts-footer-menu">
                            <ul>
                                <li><a href="{{ route('about') }}">About </a></li>
                                <li><a href="{{ route('tution-fee') }}">Tution Fee</a></li>
                                <li><a href="{{ route('alumni') }}">Alumni</a></li>
                                <li><a href="{{ route('faculty') }}">Faculty Staff</a></li>
                                <li><a href="{{ route('event') }}">Event</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-8">
                <div class="rts-footer-widget ml--30">
                    <h6 class="rt-semi">Recent Post</h6>
                    <div class="rts-post-widget">
                        <ul class="list-unstyled">
                            <li class="single-post">
                                <a href="{{ route('blog-details') }}" class="blog-thumb">
                                    <img src="{{asset('assets/images/blog/w-1.jpg')}}" alt="latest post">
                                </a>
                                <div class="post-content">
                                    <span class="rt-date">October 29, 2023</span>
                                    <a href="{{ route('blog-details') }}">
                                        Avoid These 4 Common When Managing Remote Teams
                                    </a>
                                </div>
                            </li>
                            <li class="single-post">
                                <a href="{{ route('blog-details') }}" class="blog-thumb">
                                    <img src="{{asset('assets/images/blog/small-thumb-1.jpg')}}" alt="latest post">
                                </a>
                                <div class="post-content">
                                    <span class="rt-date">October 29, 2023</span>
                                    <a href="{{ route('blog-details') }}">
                                        Avoid These 4 Common When Managing Remote Teams
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<div class="rts-footer-copy-right {{$cclass ?? ''}}">
    <div class="container">
        <div class="row">
            <div class="rt-center">
                <p class="--p-xs">Copyright &copy; {{date ('Y')}} All Rights Reserved by <a href="#">Unipix</a></p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->