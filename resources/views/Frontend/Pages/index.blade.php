@extends($layout)
@section('page_title', 'Lms and University Laravel 12 Template')
@php $body_class = 'page'; @endphp
@section('content')

    @include($header . 'transparent-header')
    <!-- header banner -->
    <div class="banner v__1 al-banner">
        <div class="container">
            <div class="row align-items-center gy-4 gy-lg-0 al-banner__row">
                <!-- banner content -->
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div class="al-banner__content">
                        <span class="al-banner__badge">
                            <img src="{{asset('assets/images/icon/e-cap.svg')}}" alt="cap">
                            {{ __('Welcome to') }}
                        </span>
                        <h1 class="al-banner__title">{{ __('al-galaa-schools') }}</h1>
                        <p class="al-banner__desc">{{ __('al-galaa-school-established') }}</p>
                        <div class="al-banner__actions">
                            <a href="{{ route('contact') }}" class="rts-theme-btn btn-arrow">{{ __('Contact Us') }}
                                <span>
                                    @if(app()->getLocale() == 'ar')
                                        <i class="fa-regular fa-arrow-left"></i>
                                    @else
                                        <i class="fa-regular fa-arrow-right"></i>
                                    @endif
                                </span>
                            </a>
{{--                            <a href="https://www.youtube.com/watch?v=7ahgosTZJHg" class="video-play rts-video-btn popup-video al-banner__play" aria-label="Play intro video">--}}
{{--                                <i class="fa-sharp fa-solid fa-play"></i>--}}
{{--                            </a>--}}
                        </div>
                    </div>
                </div>
                <!-- banner media -->
                <div class="col-lg-6 col-md-12 order-1 order-lg-2">
                    <div class="al-banner__media">
                        <figure class="al-banner__media--main">
                            <img src="{{asset('assets/images/banner/image__1.jpg')}}" alt="Al-Galaa Schools">
                        </figure>
                        <figure class="al-banner__media--small">
                            <img src="{{asset('assets/images/banner/image__2.jpg')}}" alt="Al-Galaa Schools students">
                        </figure>
                        <span class="al-banner__dots" aria-hidden="true"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid-line">
            <div class="grid-lines">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
        </div>
    </div>
    <!-- header banner end -->
    @include($components . 'about__h1')
    <!-- program -->
    <section class="rts__section rts__light rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts__section--wrapper">

                    <h2 class="rts__section--title">{{ __('Larose de Lisieux Stages') }}
                    </h2>

                </div>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__1.jpeg')}});">



                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__2.jpeg')}});">


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__3.jpeg')}});">


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__4.jpeg')}});">

                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- program end -->
    <!-- values -->
    <section class="rts__section rts-section-padding al-values">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="al-values__head">
                        <h2 class="rts__section--title">{{ __('Our Values') }}</h2>
                        <p class="al-values__desc">{{ __('At the heart of our school lies a set of core values that guide our work, inspire our students, and shape the character of every generation we teach.') }}</p>
                    </div>
                </div>
            </div>
            <div class="row g-4 mt-2">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="al-value-card">
                        <div class="al-value-card--icon">
                            <i class="fa-solid fa-medal"></i>
                        </div>
                        <h4 class="al-value-card--title">{{ __('Educational Excellence') }}</h4>
                        <p class="al-value-card--text">{{ __('Galaa School strives to achieve the highest standards of quality in education through distinguished educational cadres and a stimulating educational environment that ensures our students academic and skillful excellence.') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="al-value-card">
                        <div class="al-value-card--icon">
                            <i class="fa-solid fa-scale-balanced"></i>
                        </div>
                        <h4 class="al-value-card--title">{{ __('Integrity and Ethics') }}</h4>
                        <p class="al-value-card--text">{{ __('At Galaa School, we believe that education precedes instruction. Therefore, we instill in our students the values of honesty, integrity, and moral responsibility towards themselves and their community.') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="al-value-card">
                        <div class="al-value-card--icon">
                            <i class="fa-solid fa-handshake-simple"></i>
                        </div>
                        <h4 class="al-value-card--title">{{ __('Respect and Cooperation') }}</h4>
                        <p class="al-value-card--text">{{ __('We build a school community based on mutual respect and appreciation of others, while promoting the spirit of teamwork and cooperation among students, teachers, and parents.') }}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="al-value-card">
                        <div class="al-value-card--icon">
                            <i class="fa-solid fa-lightbulb"></i>
                        </div>
                        <h4 class="al-value-card--title">{{ __('Innovation and Development') }}</h4>
                        <p class="al-value-card--text">{{ __('We encourage our students to think creatively and innovate, and we keep pace with the latest technological developments in teaching methods to prepare a generation capable of facing future challenges.') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- values end -->
    <!-- team -->
{{--    <section class="rts__section rts__light rts-section-padding">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="rts__section--wrapper">--}}
{{--                    <h2 class="rts__section--title">{{ __('Our Teachers') }}</h2>--}}
{{--                    <div class="rts__section--link">--}}
{{--                        <a href="{{ route('faculty') }}" class="rts-nbg-btn btn-arrow">{{ __('View All Teachers') }}<span>--}}
{{--                                @if(app()->getLocale() == 'ar')--}}
{{--                                    <i class="fa-sharp fa-regular fa-arrow-left"></i>--}}
{{--                                @else--}}
{{--                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>--}}
{{--                                @endif--}}
{{--                        </span>--}}
{{--                        </a>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- team member area -->--}}
{{--            <div class="row g-5">--}}
{{--                @foreach($teams as $team)--}}
{{--                <!-- single team -->--}}
{{--                <div class="col-lg-3 col-md-6 col-sm-6">--}}
{{--                    <div class="rts__single--member">--}}
{{--                        <div class="rts__single--member--thumb">--}}
{{--                                <img src="{{ $team->media ? asset($team->media->url) : asset('assets/images/speaker/teacher__1.jpg') }}" onerror="{{asset('assets/images/research/03.jpg')}}" alt="">--}}
{{--                        </div>--}}

{{--                        <div class="rts__single--member--meta">--}}
{{--                            <h5 class="rts__single--member--meta--title">--}}
{{--                                {{ $team->name }}--}}
{{--                            </h5>--}}
{{--                            <span class="rts__single--member--meta--designation">--}}
{{--                                {{ __($team->job) }}--}}
{{--                            </span>--}}
{{--                        </div>--}}

{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- single team end -->--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--            <!-- team member area end -->--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- team end -->
    <!-- student feedback -->
    <section class="rts__section rts-section-padding rts__primary__bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="rts__section--wrapper v__4">
                        <h2 class="rts__section--title">{{ __("Parents' opinions") }}</h2>
                        <p class="rts__section--description">{{ __('Your opinion matters, and by providing feedback, you contribute to the continuous enhancement of our academic programs, support services, and campus life') }}</p>
                        <div class="rts__slider--arrow">
                            <div class="rts__prev slider__btn">
                                @if(app()->getLocale() == 'en')
                                    <i class="fa-light fa-arrow-left"></i>
                                @else
                                    <i class="fa-light fa-arrow-right"></i>
                                @endif
                            </div>
                            <div class="rts__next slider__btn">
                                @if(app()->getLocale() == 'en')
                                    <i class="fa-light fa-arrow-right"></i>
                                @else
                                    <i class="fa-light fa-arrow-left"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- student feedback testimonial -->
                <div class="col-lg-7">
                    <div class="rts__testimonial--active swiper swiper-data" data-swiper='{
                        "slidesPerView":2,
                        "loop": true,
                        "speed": 1000,
                        "navigation":{
                            "nextEl":".rts__next",
                            "prevEl":".rts__prev"
                        },
                        "autoplay":{
                            "delay":"7000"
                        },
                        "breakpoints":{
                            "320":{
                                "slidesPerView": 1
                            },
                            "575":{
                                "slidesPerView": 1.5
                            },
                            "768":{
                                "slidesPerView": 2
                            },
                            "991":{
                                "slidesPerView": 2
                            },
                            "1201":{
                                "slidesPerView": 2
                            }
                        }
                    }'>
                        <div class="swiper-wrapper">
                            @foreach($testimonials as $testimonial)
                            <!-- single slide -->
                            <div class="swiper-slide">
                                <div class="rts__single--testimonial">
                                    <div class="rts__rating--star">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= $testimonial->rating)
                                                <i class="fa-sharp fa-solid fa-star"></i>
                                            @else
                                                <i class="fa-sharp fa-light fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                    <p class="rts__single--testimonial--text">
                                        {{ app()->getLocale() == 'ar' ? $testimonial->description_ar : $testimonial->description_en }}
                                    </p>
                                    <div class="rts__single--testimonial--author">
                                        <div class="rts__single--testimonial--author--meta">
                                            <div class="rts__author--img">
                                                <img src="{{ $testimonial->media ? asset($testimonial->media->url) : asset('assets/images/testimonial/author-1.png') }}" alt="author">
                                            </div>
                                            <div class="rts__author--info">
                                                <h5 class="mb-0">{{ app()->getLocale() == 'ar' ? $testimonial->name_ar : $testimonial->name_en }}</h5>
                                                <span class="designation">{{ app()->getLocale() == 'ar' ? $testimonial->job_ar : $testimonial->job_en }}</span>
                                            </div>
                                        </div>
                                        <div class="rts__single--testimonial--quote">
                                            <img src="{{asset('assets/images/testimonial/quote.svg')}}" style="transform: {{ app()->getLocale() == 'ar'? 'rotate(180deg)':'unset' }};" alt="quote">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- single slide end -->
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- student feedback end -->
    <!-- UPCOMING EVENT -->
{{--    <section class="rts__section rts-section-padding">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="rts__section--wrapper">--}}
{{--                    <h2 class="rts__section--title">Upcoming event</h2>--}}
{{--                    <div class="rts__section--link">--}}
{{--                        <a href="{{ route('event') }}" class="rts-nbg-btn btn-arrow">View All<span><i class="fa-sharp fa-regular fa-arrow-right"></i>--}}
{{--                        </span></a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <!-- event content -->--}}
{{--            <div class="row g-5">--}}
{{--                <!-- single event item -->--}}
{{--                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                    <div class="rts__single--event">--}}
{{--                        <div class="rts__single--event--thumb">--}}
{{--                            <a href="{{ route('event-details') }}">--}}
{{--                                <img src="{{asset('assets/images/event/01.jpg')}}" alt="event">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="rts__single--event--meta">--}}
{{--                            <div class="rts__single--event--meta--dl">--}}
{{--                                <span class="date">--}}
{{--                                    <img src="{{asset('assets/images/icon/calendar.svg')}}" alt="">--}}
{{--                                    <span>Nov 11, 2023</span>--}}
{{--                                </span>--}}
{{--                                <span class="location">--}}
{{--                                    <i class="fa-sharp fa-light fa-location-dot"></i>--}}
{{--                                    <span>Yarra Park, UK</span>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <h5 class="rts__single--event--meta--title">--}}
{{--                                <a href="{{ route('event-details') }}">--}}
{{--                                Edu Fest 2023: Igniting Minds Off on--}}
{{--                                Transforming Lives </a>--}}
{{--                            </h5>--}}
{{--                            <a href="{{ route('event-details') }}" class="rts__round--btn">--}}
{{--                                <i class="fa-light fa-arrow-right"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- single event item -->--}}
{{--                <!-- single event item -->--}}
{{--                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                    <div class="rts__single--event">--}}
{{--                        <div class="rts__single--event--thumb">--}}
{{--                            <a href="{{ route('event-details') }}">--}}
{{--                                <img src="{{asset('assets/images/event/02.jpg')}}" alt="event">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="rts__single--event--meta">--}}
{{--                            <div class="rts__single--event--meta--dl">--}}
{{--                                <span class="date">--}}
{{--                                    <img src="{{asset('assets/images/icon/calendar.svg')}}" alt="">--}}
{{--                                    <span>Nov 11, 2023</span>--}}
{{--                                </span>--}}
{{--                                <span class="location">--}}
{{--                                    <i class="fa-sharp fa-light fa-location-dot"></i>--}}
{{--                                    <span>Yarra Park, UK</span>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <h5 class="rts__single--event--meta--title">--}}
{{--                                <a href="{{ route('event-details') }}">--}}
{{--                                    Sustainability & Development Showcase: Green--}}
{{--                                    Living at Unipix </a>--}}
{{--                            </h5>--}}
{{--                            <a href="{{ route('event-details') }}" class="rts__round--btn">--}}
{{--                                <i class="fa-light fa-arrow-right"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- single event item -->--}}
{{--                <!-- single event item -->--}}
{{--                <div class="col-lg-4 col-md-6 col-sm-6">--}}
{{--                    <div class="rts__single--event">--}}
{{--                        <div class="rts__single--event--thumb">--}}
{{--                            <a href="{{ route('event-details') }}">--}}
{{--                                <img src="{{asset('assets/images/event/03.jpg')}}" alt="event">--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                        <div class="rts__single--event--meta">--}}
{{--                            <div class="rts__single--event--meta--dl">--}}
{{--                                <span class="date">--}}
{{--                                    <img src="{{asset('assets/images/icon/calendar.svg')}}" alt="">--}}
{{--                                    <span>Nov 11, 2023</span>--}}
{{--                                </span>--}}
{{--                                <span class="location">--}}
{{--                                    <i class="fa-sharp fa-light fa-location-dot"></i>--}}
{{--                                    <span>Yarra Park, UK</span>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <h5 class="rts__single--event--meta--title">--}}
{{--                                <a href="{{ route('event-details') }}">--}}
{{--                                    Career Carnival: Explore Your--}}
{{--                                    Professional Journey </a>--}}
{{--                            </h5>--}}
{{--                            <a href="{{ route('event-details') }}" class="rts__round--btn">--}}
{{--                                <i class="fa-light fa-arrow-right"></i>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- single event item -->--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <!-- UPCOMING EVENT END -->

{{--    @include($components . 'blog-v1', ['class' => 'v_1 rts__light rts-section-padding'])--}}
    <!-- footer -->
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
