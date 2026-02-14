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
                                {{ __('We are committed to providing a nurturing and innovative educational environment that empowers our students to achieve their full potential.') }}
                            </p>
                            <div class="rts-contact-link">
                                <a href="#"><i class="fa-sharp fa-light fa-location-dot"></i> {!! $shareSetting->address ?? '' !!} </a>
                                <a href="callto:{{ $shareSetting->mobile ?? '' }}"><i class="fa-thin fa-phone"></i> {{ $shareSetting->mobile ?? '' }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-2">
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
                    <div class="col-md-6 col-sm-4 col-lg-3">
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
                    <div class="col-md-6 col-sm-8 col-lg-2">
                        <div class="rts-footer-widget ml--30">
                            <h6 class="rt-semi">{{ __('Quick Button') }}</h6>
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
                <p class="--p-xs">{{ __('Copyright') }} &copy; {{date ('Y')}} {{ __('All Rights Reserved by') }} <a href="#">{{ __('Unipix') }}</a></p>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->