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

                <li class="has-droupdown">
                    <a href="#" class="main">Homepages</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('index') }}">Home Style One</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-two') }}">Home Style Two</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-three') }}">Home Style Three</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-four') }}">Home Style Four</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('index-five') }}">Home Style Five</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Pages</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('about') }}">About Us</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('athletics') }}">Athletics</a></li>
                        <li class="has-dropdown third-lvl">
                            <a href="javascript:void(0);">Faculty</a>
                            <ul class="submenu third-lvl base">
                                <li><a class="mobile-menu-link" href="{{ route('faculty-sub') }}">Faculty</a></li>
                            <li><a class="mobile-menu-link" href="{{ route('faculty-sub-details') }}">Faculty Details</a></li>
                                <li><a class="mobile-menu-link" href="{{ route('faculty') }}">Faculty</a></li>
                                <li><a class="mobile-menu-link" href="{{ route('faculty-details') }}">Faculty Staff details</a></li>
                            </ul>
                        </li>
                        <li><a class="mobile-menu-link" href="{{ route('research') }}">Research</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Academics</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('academic') }}">Academic</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('admission') }}">Admission</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('academic-area') }}">Academic Area</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('campus-life') }}">Campus Life</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('scholarship') }}">Scholarship</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('tution-fee') }}">Tution Fee</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('alumni') }}">Alumni</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('program-single') }}">Program Single</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('department-details') }}">Department Details</a></li>
                    </ul>
                </li>
               
                <li class="has-droupdown">
                    <a href="#" class="main">Events</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('event') }}">Event</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('event-details') }}">Event Details</a></li>
                    </ul>
                </li>
                <li class="has-droupdown">
                    <a href="#" class="main">Blog</a>
                    <ul class="submenu mm-collapse">
                        <li><a class="mobile-menu-link" href="{{ route('blog') }}">Blog</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-grid') }}">Blog Grid</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-list') }}">Blog List</a></li>
                        <li><a class="mobile-menu-link" href="{{ route('blog-details') }}">Blog Details</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('contact') }}" class="main">Contact Us</a>
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
