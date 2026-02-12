<!-- header area start -->
<header class="header v__5 {{$class ?? ''}} header__sticky">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="header__wrapper">
                    <div class="header__logo">
                        <a href="{{ route('index') }}" class="header__logo--link">
                            <img src="{{asset('assets/images/logo/logo__five.svg')}}" alt="unipix">
                        </a>
                    </div>
                    <div class="header__menu">
                        @include($elements . 'nav__two')
                    </div>
                    <div class="header__right">
                        <div class="header__right--item">
                            <div id="langSwitcher" class="lang__trigger">
                                <span class="selected__lang">English</span>
                                <i class="fa-light fa-globe"></i>
                                <div class="translate__lang">
                                    <ul>
                                        <li><a href="#" class="active">English</a></li>
                                        <li><a href="#">French</a></li>
                                        <li><a href="#">Spanish</a></li>
                                        <li><a href="#">Romanian</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="search-btn" class="search__trigger">
                                <i class="fa-sharp fa-light fa-magnifying-glass"></i>
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