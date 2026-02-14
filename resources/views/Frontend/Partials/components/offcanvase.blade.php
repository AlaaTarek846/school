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

                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Homepages') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('index') }}">{{ __('Home Style One') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-two') }}">{{ __('Home Style Two') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-three') }}">{{ __('Home Style Three') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-four') }}">{{ __('Home Style Four') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-five') }}">{{ __('Home Style Five') }}</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Pages') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('about') }}">{{ __('About Us') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('athletics') }}">{{ __('Athletics') }}</a></li>
                        <li class="has-dropdown third-lvl">
                            <a href="javascript:void(0);">{{ __('Faculty') }}</a>
                            <ul class="submenu third-lvl base">
                                <li><a class="mobile-menu-link" href="{{ route('faculty-sub') }}">{{ __('Faculty') }}</a></li>
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub-details') }}">{{ __('Faculty Details') }}</a></li>
                                <li><a class="mobile-menu-link" href="{{ route('faculty') }}">{{ __('Faculty') }}</a></li>
                                <li><a class="mobile-menu-link" href="{{ route('faculty-details') }}">{{ __('Faculty Staff details') }}</a></li>
                            </ul>
                        </li>
                        <li><a class="mobile-menu-link" href="{{ route('research') }}">{{ __('Research') }}</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Academics') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('academic') }}">{{ __('Academic') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('admission') }}">{{ __('Admission') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('academic-area') }}">{{ __('Academic Area') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('campus-life') }}">{{ __('Campus Life') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('scholarship') }}">{{ __('Scholarship') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('tution-fee') }}">{{ __('Tution Fee') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('alumni') }}">{{ __('Alumni') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('program-single') }}">{{ __('Program Single') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('department-details') }}">{{ __('Department Details') }}</a></li>
                    </ul>
                </li>

                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Events') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('event') }}">{{ __('Event') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('event-details') }}">{{ __('Event Details') }}</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">{{ __('Blog') }}</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-grid') }}">{{ __('Blog Grid') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-list') }}">{{ __('Blog List') }}</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-details') }}">{{ __('Blog Details') }}</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="main">{{ __('Contact Us') }}</a>
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
