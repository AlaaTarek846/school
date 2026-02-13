<ul class="main-menu">

    <!-- Start::slide -->
    <li class="slide">
        <a href="{{ route('admin.dashboard') }}"
            class="side-menu__item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bx bx-home side-menu__icon"></i>
            <span class="side-menu__label">{{ __('translation.main') }}</span>
        </a>
    </li>

    <!-- Start::home -->
        <li
            class="slide has-sub {{ request()->routeIs('admin.page.home-sliders')   || request()->routeIs('admin.page.partners')   ? 'active open' : '' }}">
            <a href="javascript:void(0);"
                class="side-menu__item {{ request()->routeIs('admin.page.home-sliders') ||  request()->routeIs('admin.page.partners')  || request()->routeIs('admin.page.team') ? 'active' : '' }}">
                <i class="bi bi-map side-menu__icon"></i>
                <span class="side-menu__label">الصفحة الرئيسية</span>
                <i class="fe fe-chevron-right side-menu__angle"></i>
            </a>
            <ul class="slide-menu child1">
                <li class="slide side-menu__label1">
                    <a href="javascript:void(0)">الصفحة الرئيسية</a>
                </li>
                <li class="slide">
                    <a href="{{ route('admin.page.home-sliders') }}"
                        class="side-menu__item {{ request()->routeIs('admin.page.home-sliders') ? 'active' : '' }}">
                        السكشن المتحرك
                    </a>
                </li>

                <li class="slide">
                    <a href="{{ route('admin.page.partners') }}"
                        class="side-menu__item {{ request()->routeIs('admin.page.partners') ? 'active' : '' }}">
                        فيديو تعرفي
                    </a>
                </li>
{{--                <li class="slide">--}}
{{--                    <a href="{{ route('admin.page.team') }}"--}}
{{--                        class="side-menu__item {{ request()->routeIs('admin.page.team') ? 'active' : '' }}">--}}
{{--                        اعضاء الشركة--}}
{{--                    </a>--}}
{{--                </li>--}}
                <li class="slide">
                    <a href="{{ route('admin.page.testimonial') }}"
                        class="side-menu__item {{ request()->routeIs('admin.page.testimonial') ? 'active' : '' }}">
                        اراء العملاء
                    </a>
                </li>

            </ul>
        </li>
    <!-- End::home -->

    <!-- Start::home -->
    <li
        class="slide has-sub {{ request()->routeIs('admin.page.one-about')   || request()->routeIs('admin.page.why-choose-us') || request()->routeIs('admin.page.how-we-welcome-child') || request()->routeIs('admin.page.campus-tour')   ? 'active open' : '' }}">
        <a href="javascript:void(0);"
           class="side-menu__item {{ request()->routeIs('admin.page.one-about') ||  request()->routeIs('admin.page.why-choose-us')  || request()->routeIs('admin.page.how-we-welcome-child') || request()->routeIs('admin.page.campus-tour') ? 'active' : '' }}">
            <i class="bi bi-map side-menu__icon"></i>
            <span class="side-menu__label">الصفحة من نحن</span>
            <i class="fe fe-chevron-right side-menu__angle"></i>
        </a>
        <ul class="slide-menu child1">
            <li class="slide side-menu__label1">
                <a href="javascript:void(0)">الصفحة من نحن</a>
            </li>
            <li class="slide">
                <a href="{{ route('admin.page.one-about') }}"
                   class="side-menu__item {{ request()->routeIs('admin.page.one-about') ? 'active' : '' }}">
                    السكشن من نحن
                </a>
            </li>
            <li class="slide">
                <a href="{{ route('admin.page.why-choose-us') }}"
                   class="side-menu__item {{ request()->routeIs('admin.page.why-choose-us') ? 'active' : '' }}">
                    لماذا تختارنا
                </a>
            </li>
            <li class="slide">
                <a href="{{ route('admin.page.how-we-welcome-child') }}"
                   class="side-menu__item {{ request()->routeIs('admin.page.how-we-welcome-child') ? 'active' : '' }}">
                    كيف يستقبل الطفل
                </a>
            </li>
            <li class="slide">
                <a href="{{ route('admin.page.campus-tour') }}"
                   class="side-menu__item {{ request()->routeIs('admin.page.campus-tour') ? 'active' : '' }}">
                    جولة في حرم المدرسة
                </a>
            </li>



        </ul>
    </li>





    <!-- Start::service -->
        <li class="slide">
            <a href="{{ route('admin.page.services') }}"
               class="side-menu__item {{ request()->routeIs('admin.page.services') ? 'active' : '' }}">
                <i class="bi bi-map side-menu__icon"></i>
                <span class="side-menu__label">صفحة الخدمات</span>
            </a>
        </li>
    <!-- End::service -->

    <!-- Start::projects -->
        <li class="slide">
            <a href="{{ route('admin.page.projects') }}"
               class="side-menu__item {{ request()->routeIs('admin.page.projects') ? 'active' : '' }}">
                <i class="bi bi-map side-menu__icon"></i>
                <span class="side-menu__label">صفحة المنتجات</span>
            </a>
        </li>
    <!-- End::projects -->

    <!-- Start::contact-messages -->
        <li class="slide">
            <a href="{{ route('admin.page.contact-messages') }}"
               class="side-menu__item {{ request()->routeIs('admin.page.contact-messages') ? 'active' : '' }}">
                <i class="bi bi-map side-menu__icon"></i>
                <span class="side-menu__label">رسائل التواصل</span>
            </a>
        </li>
    <!-- End::contact-messages -->

    <!-- Start::career-applications -->
    <li class="slide">
        <a href="{{ route('admin.page.career-applications') }}"
           class="side-menu__item {{ request()->routeIs('admin.page.career-applications') ? 'active' : '' }}">
            <i class="bi bi-map side-menu__icon"></i>
            <span class="side-menu__label">طلبات التوظيف</span>
        </a>
    </li>
    <!-- End::career-applications -->

    <!-- Start::student-registrations -->
    <li class="slide">
        <a href="{{ route('admin.page.student-registrations') }}"
           class="side-menu__item {{ request()->routeIs('admin.page.student-registrations') ? 'active' : '' }}">
            <i class="bi bi-map side-menu__icon"></i>
            <span class="side-menu__label">طلبات تسجيل الطلاب</span>
        </a>
    </li>
    <!-- End::student-registrations -->

    <!-- Start::subscribes -->
    <li class="slide">
        <a href="{{ route('admin.page.subscribes') }}"
           class="side-menu__item {{ request()->routeIs('admin.page.subscribes') ? 'active' : '' }}">
            <i class="bi bi-map side-menu__icon"></i>
            <span class="side-menu__label">المشتركين</span>
        </a>
    </li>
    <!-- End::subscribes -->

    <!-- Start::faq -->
{{--        <li class="slide">--}}
{{--            <a href="{{ route('admin.page.faq') }}"--}}
{{--               class="side-menu__item {{ request()->routeIs('admin.page.faq') ? 'active' : '' }}">--}}
{{--                <i class="bi bi-map side-menu__icon"></i>--}}
{{--                <span class="side-menu__label">الأسئلة الشائعة</span>--}}
{{--            </a>--}}
{{--        </li>--}}
    <!-- End::faq -->

    <!-- Start::gallery -->
    <li class="slide">
        <a href="{{ route('admin.page.galleries') }}"
           class="side-menu__item {{ request()->routeIs('admin.page.galleries') ? 'active' : '' }}">
            <i class="bi bi-images side-menu__icon"></i>
            <span class="side-menu__label">{{ __('global.gallery') }}</span>
        </a>
    </li>
    <!-- End::gallery -->

    <!-- Start::video -->
    <li class="slide">
        <a href="{{ route('admin.page.videos') }}"
           class="side-menu__item {{ request()->routeIs('admin.page.videos') ? 'active' : '' }}">
            <i class="bi bi-camera-video side-menu__icon"></i>
            <span class="side-menu__label">{{ __('global.video') }}</span>
        </a>
    </li>
    <!-- End::video -->



    <!-- Start::setting -->
        <li class="slide">
            <a href="{{ route('admin.page.setting') }}"
               class="side-menu__item {{ request()->routeIs('admin.page.setting') ? 'active' : '' }}">
                <i class="bi bi-map side-menu__icon"></i>
                <span class="side-menu__label">الاعدادات</span>
            </a>
        </li>
    <!-- End::setting -->

</ul>
