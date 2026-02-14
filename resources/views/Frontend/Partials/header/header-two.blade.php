<!-- header area start -->
<header class="header header__sticky v__2">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="header__wrapper">
                    <div class="header__logo">
                        <a href="{{ route('index') }}" class="header__logo--link">
                            <img src="{{asset('assets/images/logo/logo__two.svg')}}" alt="unipix">
                        </a>
                    </div>
                    <div class="header__menu">
                        @include($elements . 'nav__two')
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
                            <div id="menu-btn" class="menu__trigger">
                                <img src="{{asset('assets/images/icon/menu__bar.svg')}}" alt="bar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- header area end -->