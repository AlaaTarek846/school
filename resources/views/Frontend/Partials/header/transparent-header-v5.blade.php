<!-- header area start -->
<header class="header v__5 {{$class ?? ''}} header__sticky">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="header__wrapper">
                    <div class="header__logo">
                        <a href="{{ route('index') }}" class="header__logo--link">
                            <img src="{{asset('assets/images/logo/logo-color.png')}}" alt="unipix">
                        </a>
                    </div>
                    <div class="header__menu">
                        @include($elements . 'nav__two')
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
                                <img src="{{asset('assets/images/icon/menu__bar-2.svg')}}" alt="bar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->