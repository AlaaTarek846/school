<!-- header style two -->
<div id="side-bar" class="side-bar">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="inner-main-wrapper-desk">
        <div class="thumbnail">
            <img src="{{asset('assets/images/logo/logo-color.png')}}" alt="Unipix-university">
        </div>
        <div class="inner-content">
            <p class="disc">
                {{ __('We are committed to providing a nurturing and innovative educational environment that empowers our students to achieve their full potential.') }}
            </p>
            <!-- offcanvase banner -->
            <div class="offcanvase__banner mt--50">
                <div class="offcanvase__banner--content">
                    <img src="{{asset('assets/images/offcanvase.jpg')}}" alt="offcanvase">
                </div>
            </div>
            <div class="offcanvase__info">
                <div class="offcanvase__info--content">
                    <a href="callto:{{ $shareSetting->mobile ?? '' }}"><span><i class="fa-sharp fa-light fa-phone"></i></span>{{ $shareSetting->mobile ?? '' }}</a>
                    <a href="#"><span><i class="fa-sharp fa-light fa-location-dot"></i></span>{!! $shareSetting->address ?? '' !!}</a>
                    <div class="offcanvase__info--content--social">
                        <p class="title">{{ __('Follow Us:') }}</p>
                        <div class="social__links">
                            <a href="{{ $shareSetting->facebook ?? '#' }}"><i class="fa-brands fa-facebook"></i></a>
                            <a href="{{ $shareSetting->instagram ?? '#' }}"><i class="fa-brands fa-instagram"></i></a>
                            <a href="{{ $shareSetting->linkedin ?? '#' }}"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="{{ $shareSetting->twitter ?? '#' }}"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area start -->
    <div class="mobile-menu-main">
        <nav class="nav-main mainmenu-nav mt--30">
            <ul class="mainmenu metismenu" id="mobile-menu-active">

                <li>
                    <a href="{{ route('index') }}" class="main">{{ __('Home') }}</a>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('About Us') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('principal-message') }}">{{ __("Principal's Message") }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('school-discipline-policy') }}">{{ __('School Discipline Policy') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('parents-meeting') }}">{{ __("KG Parents' Meeting") }}</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('About School') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('quality-assurance-files') }}">{{ __('Quality Assurance Files') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('social-specialist') }}">{{ __('Social Specialist') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('mission-and-vision') }}">{{ __('Mission and Vision') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('journey-of-success-and-excellence') }}">{{ __('Journey of Success and Excellence') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('careers') }}">{{ __('Careers') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('student-registration') }}">{{ __('Student Registration') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('school-facilities') }}" class="main">{{ __('School Facilities') }}</a>
                </li>
                <li>
                    <a href="{{ route('tuition-fees') }}" class="main">{{ __('Tuition Fees') }}</a>
                </li>

                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Gallery') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('gallery') }}">{{ __('Gallery') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('videos') }}">{{ __('Videos') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="main">{{ __('Contact') }}</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="main">{{ __('Think and Learn') }}</a>
                </li>
            </ul>
        </nav>

        <div class="offcanvase__info--content mt--30">
            <a href="callto:{{ $shareSetting->mobile ?? '' }}"><span><i class="fa-sharp fa-light fa-phone"></i></span>{{ $shareSetting->mobile ?? '' }}</a>
            <a href="#"><span><i class="fa-sharp fa-light fa-location-dot"></i></span>{!! $shareSetting->address ?? '' !!}</a>
            <div class="offcanvase__info--content--social">
                <p class="title">{{ __('Follow Us:') }}</p>
                <div class="social__links">
                    <a href="{{ $shareSetting->facebook ?? '#' }}"><i class="fa-brands fa-facebook"></i></a>
                    <a href="{{ $shareSetting->instagram ?? '#' }}"><i class="fa-brands fa-instagram"></i></a>
                    <a href="{{ $shareSetting->linkedin ?? '#' }}"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="{{ $shareSetting->twitter ?? '#' }}"><i class="fa-brands fa-twitter"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- header style two End -->
