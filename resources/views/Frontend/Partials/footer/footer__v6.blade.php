
<!-- footer twitter slider  -->
<div class="x__slider">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-xxl-9 col-xl-7 d-flex align-items-center">
                <div class="x__slider__active overflow-hidden">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="x__slider__item">
                                <img src="{{asset('assets/images/twitt.png')}}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="x__slider__navigation">
                    <div class="rts__slider--arrow">
                        <div class="rts__prev slider__btn"><i class="fa-light fa-arrow-left"></i></div>
                        <div class="rts__next slider__btn"><i class="fa-light fa-arrow-right"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-5 col-xxl-3">
                <div class="subscription__form">
                    <h5 class="subscription__form--title">{{ __('Subscribe to newsletter') }}</h5>
                    
                    <form action="#">
                        <input type="email" placeholder="{{ __('Enter your email address') }}" required>
                        <button type="submit" class="cta__button">{{ __('Subscribe') }} <span><i class="fa-regular fa-arrow-right"></i></span></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer -->
<footer class="footer {{ $class ?? '' }}">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <div class="footer__widget--logo">
                        <a href="index"><img src="{{asset('assets/images/logo/logo__white.svg')}}" alt="logo"></a>
                    </div>
                    <p class="footer__widget--description">
                        {{ __('We are committed to providing a nurturing and innovative educational environment that empowers our students to achieve their full potential.') }}
                    </p>
                    <div class="footer__widget--social">
                        <ul class="social">
                            <li class="social__link"><a href="{{ $shareSetting->facebook ?? '#' }}"><i class="fa-brands fa-facebook"></i></a></li>
                            <li class="social__link"><a href="{{ $shareSetting->instagram ?? '#' }}"><i class="fa-brands fa-instagram"></i></a></li>
                            <li class="social__link"><a href="{{ $shareSetting->linkedin ?? '#' }}"><i class="fa-brands fa-linkedin"></i></a></li>
                            <li class="social__link"><a href="{{ $shareSetting->twitter ?? '#' }}"><i class="fa-brands fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('About Us') }}</h6>
                    <div class="footer__widget--menu">
                        <ul>
                            <li><a href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                            <li><a href="{{ route('principal-message') }}">{{ __("Principal's Message") }}</a></li>
                            <li><a href="{{ route('school-discipline-policy') }}">{{ __('School Discipline Policy') }}</a></li>
                            <li><a href="{{ route('parents-meeting') }}">{{ __("KG Parents' Meeting") }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('About School') }}</h6>
                    <div class="footer__widget--menu">
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
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('Quick Button') }}</h6>
                    <div class="footer__widget--button">
                        <a href="{{ route('admission-sc') }}" class="cta__button active">{{ __('Applying') }}</a>
                        <a href="{{ route('scholarship') }}" class="cta__button">{{ __('scholarship') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

<!-- footer copyright -->
<div class="copyright sc">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="copyright__wrapper">
                    <p>{{ __('Copyright') }} &copy; {{ date('Y') }} {{ __('All Rights Reserved by') }} <a href="#">{{ __('Unipix') }}</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer copyright end -->

  