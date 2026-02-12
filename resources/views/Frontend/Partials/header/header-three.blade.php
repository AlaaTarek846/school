<!-- header area start -->
<header class="header header__sticky v__3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="header__wrapper">
                    <div class="header__social__link">
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                    <div class="header__center__content">
                        <!-- menu left side -->
                        <div class="header__menu">
                            <div class="navigation">
                                <nav class="navigation__menu">
                                    <ul>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="javascript:void(0);" class="navigation__menu--item__link">Home</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('index') }}">Home Style One</a></li>
                                                <li><a href="{{ route('index-two') }}">Home Style Two</a></li>
                                                <li><a href="{{ route('index-three') }}">Home Style three</a></li>
                                                <li><a href="{{ route('index-four') }}">Home Style four</a></li>
                                                <li><a href="{{ route('index-five') }}">Home Style five</a></li>
                                            </ul>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="javascript:void(0);" class="navigation__menu--item__link">Pages</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('about') }}">About</a></li>
                                                <li><a href="{{ route('athletics') }}">Athletics</a></li>
                                                <li class="has-child has-arrow">
                                                    <a href="{{ route('index') }}">Faculty</a>
                                                    <ul class="sub__style">
                                                        <li><a class="mobile-menu-link"
                                                                href="{{ route('faculty-sub') }}">Faculty</a></li>
                                                        <li><a class="mobile-menu-link"
                                                                href="{{ route('faculty-sub-details') }}">Faculty Details</a></li>
                                                        <li><a href="{{ route('faculty') }}">Faculty Staff</a></li>
                                                        <li class="has-child"><a href="{{ route('faculty-details') }}">Faculty Staff
                                                                details</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ route('index-three') }}">Research</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Academics</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('academic') }}">Academic</a></li>
                                                <li><a href="{{ route('admission') }}">Admission</a></li>
                                                <li><a href="{{ route('academic-area') }}">Academic Area</a></li>
                                                <li><a href="{{ route('campus-life') }}">Campus Life</a></li>
                                                <li><a href="{{ route('scholarship') }}">Scholarship</a></li>
                                                <li><a href="{{ route('tution-fee') }}">Tution Fee</a></li>
                                                <li><a href="{{ route('alumni') }}">alumni</a></li>
                                                <li><a href="{{ route('program-single') }}">Program Single</a></li>
                                                <li><a href="{{ route('department-details') }}">Department Details</a></li>
                                            </ul>
                                        </li>

                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <!-- menu left side end -->
                        <div class="header__logo">
                            <a href="{{ route('index') }}" class="header__logo--link">
                                <img src="{{asset('assets/images/logo/logo__five.svg')}}" alt="unipix">
                            </a>
                        </div>

                        <!-- menu right side -->
                        <div class="header__menu">
                            <div class="navigation">
                                <nav class="navigation__menu">
                                    <ul>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Event</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('event') }}">Event</a></li>
                                                <li><a href="{{ route('event-details') }}">Event Details</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">Blog</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('blog') }}">Blog</a></li>
                                                <li><a href="{{ route('blog-grid') }}">Blog Grid</a></li>
                                                <li><a href="{{ route('blog-list') }}">Blog List</a></li>
                                                <li><a href="{{ route('blog-details') }}">Blog Detaila</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item">
                                            <a href="{{ route('contact') }}" class="navigation__menu--item__link">Contact</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header__right">
                        <div class="header__right--item">
                            <div id="langSwitcher" class="lang__trigger">
                                <span class="selected__lang">{{ strtoupper(app()->getLocale()) }}</span>
                                <i class="fa-light fa-globe"></i>
                                <div class="translate__lang">
                                    <ul>
                                        <li><a href="{{ route('lang.switch', 'en') }}" class="{{ app()->getLocale() == 'en' ? 'active' : '' }}">En</a></li>
                                        <li><a href="{{ route('lang.switch', 'ar') }}" class="{{ app()->getLocale() == 'ar' ? 'active' : '' }}">Ar</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="search-btn" class="search__trigger">
                                <i class="fa-sharp fa-light fa-magnifying-glass"></i>
                            </div>
                            <div id="menu-btn" class="menu__trigger">
                                <img src="{{asset('assets/images/icon/menu__bar-3.svg')}}" alt="bar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->