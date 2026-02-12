<div class="header rts__header v__6 {{$class ?? '' }}">
     <div class="container">
          <div class="row">
               <div class="col-lg-12">
                    <div class="rts__header__wrapper">
                         <div class="rts__logo">
                              <a href="{{ route('index-sc') }}" class="rts__logo--link">
                                   <img src="{{asset('assets/images/logo/logo-sc.svg')}}" alt="Unipix School">
                              </a>
                         </div>
                         <div class="header__content">
                              <div class="header__content__top">
                                   <div class="header__content__top__left">
                                        <a href="#"><i class="fa-classic fa-light fa-location-dot"></i> 2702 Memory Lane, Chicago, IL 60605</a>
                                   </div>
                                   <div class="header__content__top__right">
                                        <div class="follow_us">
                                             <span>{{ __('Follow Us-') }}</span>
                                             <div>
                                                  <a href="#"><i class="fa-brands fa-facebook"></i></a>
                                                  <a href="#"><i class="fa-brands fa-twitter"></i></a>
                                                  <a href="#"><i class="fa-brands fa-linkedin"></i></a>
                                                  <a href="#"><i class="fa-brands fa-youtube"></i></a>
                                             </div>
                                        </div>
                                        <div class="header__right--item">
                                             <div id="search-btn" class="search__trigger">
                                                  <i class="fa-sharp fa-light fa-magnifying-glass"></i>
                                              </div>
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
                                              
                                        </div>
                                   </div>
                              </div>
                              <div class="header__content__bottom">
                                   <div class="menu ">
                                        @include($elements . 'nav__sc')
                                   </div>
                                   <div class="humberger">
                                        <div id="menu-btn" class="menu__trigger">
                                             <img src="{{asset('assets/images/icon/bar__line__black.svg')}}" alt="bar">
                                         </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>