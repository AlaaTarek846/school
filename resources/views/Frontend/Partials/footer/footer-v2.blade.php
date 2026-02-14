<!-- footer start -->
<footer class="rts-footer {{ $class ?? '' }}">
    <div class="container">
        <div class="row justify-content-center">
            <div class="rts-footer-newsletter">
                <div class="col-lg-10">
                    <div class="rts-newsletter-box-content">
                        <h4 class="newsletter-title">{{ __('Subscribe to newsletter') }}
                        </h4>
                        <div class="newsletter-form w-530">
                            <form action="#">
                                <input type="email" name="subscription" id="subscription" placeholder="{{ __('Enter your mail') }}" required="">
                                <button type="submit" class="rts-nbg-btn btn-arrow">{{ __('Subscribe') }} <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></button>
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
                        {{ __('We are committed to providing a nurturing and innovative educational environment that empowers our students to achieve their full potential.') }}
                    </p>
                    <div class="rts-contact-link">
                        <a href="#"><i class="fa-sharp fa-light fa-location-dot"></i> {!! $shareSetting->address ?? '' !!} </a>
                        <a href="callto:{{ $shareSetting->mobile ?? '' }}"><i class="fa-thin fa-phone"></i> {{ $shareSetting->mobile ?? '' }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="rts-footer-widget ">
                    <h6 class="rt-semi">{{ __('About Us') }}</h6>
                    <div class="rts-footer-menu">
                        <ul>
                            <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                            <li><a href="{{ route('principal-message') }}">{{ __("Principal's Message") }}</a></li>
                            <li><a href="{{ route('school-discipline-policy') }}">{{ __('School Discipline Policy') }}</a></li>
                            <li><a href="{{ route('parents-meeting') }}">{{ __("KG Parents' Meeting") }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-4">
                <div class="rts-footer-widget ml--30">
                    <h6 class="rt-semi">{{ __('About School') }}</h6>
                        <div class="rts-footer-menu">
                            <ul>
                                <li><a href="{{ route('quality-assurance-files') }}">{{ __('Quality Assurance Files') }}</a></li>
                                <li><a href="{{ route('social-specialist') }}">{{ __('Social Specialist') }}</a></li>
                                <li><a href="{{ route('mission-and-vision') }}">{{ __('Mission and Vision') }}</a></li>
                                <li><a href="{{ route('journey-of-success-and-excellence') }}">{{ __('Journey of Success and Excellence') }}</a></li>
                                <li><a href="{{ route('careers') }}">{{ __('Careers') }}</a></li>
                                <li><a href="{{ route('student-registration') }}">{{ __('Student Registration') }}</a></li>
                            </ul>
                        </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="rts-footer-widget ml--30">
                    <h6 class="rt-semi">{{ __('Recent Post') }}</h6>
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
                <p class="--p-xs">{{ __('Copyright') }} &copy; {{date ('Y')}} {{ __('All Rights Reserved by') }} <a href="#">{{ __('Unipix') }}</a></p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->