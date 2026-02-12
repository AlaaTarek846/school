
<!-- footer -->
<footer class="footer {{ $class ?? ''}}">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <div class="footer__widget--logo">
                        <a href="index"><img src="{{asset('assets/images/logo/logo__white.svg')}}" alt="logo"></a>
                    </div>
                    <p class="footer__widget--description">
                        {{ __('We are passionate education dedicated to providing high-quality resources learners all backgrounds.') }}
                    </p>
                    <div class="footer__widget--social">
                        <ul class="social">
                            <li class="social__link"><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                            <li class="social__link"><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                            <li class="social__link"><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                            <li class="social__link"><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('Our Campus') }}</h6>
                    <div class="footer__widget--menu">
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
            <div class="col-lg-2 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('Our Campus') }}</h6>
                    <div class="footer__widget--menu">
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
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6 class="footer__widget--title">{{ __('Quick Button') }}</h6>
                    <div class="footer__widget--button">
                        <a href="{{ route('admission') }}" class="cta__button active">{{ __('Applying') }}</a>
                        <a href="{{ route('scholarship') }}" class="cta__button">{{ __('scholarship') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->

<!-- footer copyright -->
<div class="copyright">
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
