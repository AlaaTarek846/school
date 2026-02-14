<!-- header style two -->
<div id="side-bar" class="side-bar">
    <button class="close-icon-menu"><i class="far fa-times"></i></button>
    <!-- inner menu area desktop start -->
    <div class="inner-main-wrapper-desk">
        <div class="thumbnail">
            <img src="{{asset('assets/images/logo/logo__five.svg')}}" alt="Unipix-university">
        </div>
        <div class="inner-content">
            <p class="disc">
                A modern HTML template for education, offering intuitive design & essential features for seamless learning experiences.
            </p>
            <!-- offcanvase banner -->
            <div class="offcanvase__banner mt--50">
                <div class="offcanvase__banner--content">
                    <img src="{{asset('assets/images/offcanvase.jpg')}}" alt="offcanvase">
                    <a href="{{ route('admission') }}" class="rts-theme-btn">Apply Now</a>
                </div>
            </div>
            <div class="offcanvase__info">
                <div class="offcanvase__info--content">
                    <a href="callto:+61485826710"><span><i class="fa-sharp fa-light fa-phone"></i></span>+(61) 485-826-710</a>
                    <a href="#"><span><i class="fa-sharp fa-light fa-location-dot"></i></span>Yarra Park, Melbourne, Australia</a>
                    <div class="offcanvase__info--content--social">
                        <p class="title">Follow Us:</p>
                        <div class="social__links">
                            <a href="#"><i class="fa-brands fa-facebook"></i></a>
                            <a href="#"><i class="fa-brands fa-instagram"></i></a>
                            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="#"><i class="fa-brands fa-youtube"></i></a>
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
            <a href="callto:+61485826710"><span><i class="fa-sharp fa-light fa-phone"></i></span>+(61) 485-826-710</a>
            <a href="#"><span><i class="fa-sharp fa-light fa-location-dot"></i></span>Yarra Park, Melbourne, Australia</a>
            <div class="offcanvase__info--content--social">
                <p class="title">Follow Us:</p>
                <div class="social__links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- mobile menu area end -->
</div>
<!-- header style two End -->
