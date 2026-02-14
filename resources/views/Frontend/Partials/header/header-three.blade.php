<!-- header area start -->
<header class="header header__sticky v__3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="header__wrapper">
                    <div class="header__social__link">
                        <a href="{{ $shareSetting->facebook ?? '#' }}"><i class="fa-brands fa-facebook"></i></a>
                        <a href="{{ $shareSetting->instagram ?? '#' }}"><i class="fa-brands fa-instagram"></i></a>
                        <a href="{{ $shareSetting->linkedin ?? '#' }}"><i class="fa-brands fa-linkedin"></i></a>
                        <a href="{{ $shareSetting->twitter ?? '#' }}"><i class="fa-brands fa-twitter"></i></a>
                    </div>
                    <div class="header__center__content">
                        <!-- menu left side -->
                        <div class="header__menu">
                            <div class="navigation">
                                <nav class="navigation__menu">
                                    <ul>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('Home') }}</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('index') }}">{{ __('Home Style One') }}</a></li>
                                                <li><a href="{{ route('index-two') }}">{{ __('Home Style Two') }}</a></li>
                                                <li><a href="{{ route('index-three') }}">{{ __('Home Style three') }}</a></li>
                                                <li><a href="{{ route('index-four') }}">{{ __('Home Style four') }}</a></li>
                                                <li><a href="{{ route('index-five') }}">{{ __('Home Style five') }}</a></li>
                                            </ul>
                                        </li>

                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="javascript:void(0);" class="navigation__menu--item__link">{{ __('Pages') }}</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('about') }}">{{ __('About') }}</a></li>
                                                <li><a href="{{ route('athletics') }}">{{ __('Athletics') }}</a></li>
                                                <li class="has-child has-arrow">
                                                    <a href="{{ route('index') }}">{{ __('Faculty') }}</a>
                                                    <ul class="sub__style">
                                                        <li><a class="mobile-menu-link"
                                                                href="{{ route('faculty-sub') }}">{{ __('Faculty') }}</a></li>
                                                        <li><a class="mobile-menu-link"
                                                                href="{{ route('faculty-sub-details') }}">{{ __('Faculty Details') }}</a></li>
                                                        <li><a href="{{ route('faculty') }}">{{ __('Faculty Staff') }}</a></li>
                                                        <li class="has-child"><a href="{{ route('faculty-details') }}">{{ __('Faculty Staff details') }}</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="{{ route('index-three') }}">{{ __('Research') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">{{ __('Academics') }}</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('academic') }}">{{ __('Academic') }}</a></li>
                                                <li><a href="{{ route('admission') }}">{{ __('Admission') }}</a></li>
                                                <li><a href="{{ route('academic-area') }}">{{ __('Academic Area') }}</a></li>
                                                <li><a href="{{ route('campus-life') }}">{{ __('Campus Life') }}</a></li>
                                                <li><a href="{{ route('scholarship') }}">{{ __('Scholarship') }}</a></li>
                                                <li><a href="{{ route('tution-fee') }}">{{ __('Tution Fee') }}</a></li>
                                                <li><a href="{{ route('alumni') }}">{{ __('alumni') }}</a></li>
                                                <li><a href="{{ route('program-single') }}">{{ __('Program Single') }}</a></li>
                                                <li><a href="{{ route('department-details') }}">{{ __('Department Details') }}</a></li>
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
                                            <a href="#" class="navigation__menu--item__link">{{ __('Event') }}</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('event') }}">{{ __('Event') }}</a></li>
                                                <li><a href="{{ route('event-details') }}">{{ __('Event Details') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item has-child has-arrow">
                                            <a href="#" class="navigation__menu--item__link">{{ __('Blog') }}</a>
                                            <ul class="submenu sub__style">
                                                <li><a href="{{ route('blog') }}">{{ __('Blog') }}</a></li>
                                                <li><a href="{{ route('blog-grid') }}">{{ __('Blog Grid') }}</a></li>
                                                <li><a href="{{ route('blog-list') }}">{{ __('Blog List') }}</a></li>
                                                <li><a href="{{ route('blog-details') }}">{{ __('Blog Details') }}</a></li>
                                            </ul>
                                        </li>
                                        <li class="navigation__menu--item">
                                            <a href="{{ route('contact') }}" class="navigation__menu--item__link">{{ __('Contact') }}</a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="header__right">
                        <div class="header__right--item">
                            <div class="lang-switch-container">
                                <a href="{{ route('lang.switch', app()->getLocale() == 'en' ? 'ar' : 'en') }}" class="lang-switch-btn">
                                    <i class="fa-light fa-globe"></i>
                                    <span>{{ app()->getLocale() == 'en' ? 'AR' : 'EN' }}</span>
                                </a>
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
