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
                    <a href="{{ route('index-sc') }}" class="main">Homepages</a>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Program</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('primary-school') }}">Primary School</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('middle-school') }}">Secondary School</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('six-form') }}">Sixth Form</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('senior-school') }}">Senior School</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('campuslife-sc') }}" class="main">School Life</a>
                </li>
               
                <li class="has-droupdown">
                    <a href="#" class="main">Academics</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('tutionfee-sc') }}">Tution Fee</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('admission-sc') }}">Apply Admission</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('single-resource') }}" class="main">Resource</a>
                </li>
                <li>
                    <a href="{{ route('about-sc') }}" class="main">About</a>
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
