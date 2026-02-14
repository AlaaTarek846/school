@extends($layout)
@section('page_title', 'Lms and University Laravel 12 Template')
@php $body_class = 'page'; @endphp
@section('content')

    @include($header . 'transparent-header')
    <!-- header banner -->
    <div class="banner v__1">
        <div class="container">
            <div class="col-sm-12">
                <div class="banner__wrapper">
                    <div class="banner__wrapper--left">
                        <img src="{{asset('assets/images/banner/image__1.jpg')}}" alt="">
                    </div>
                    <div class="banner__wrapper--middle">
                        <div class="banner__content">
                            <h6 class="banner__content--sub">
                               <img src="{{asset('assets/images/icon/e-cap.svg')}}" alt="cap"> {{ __('Welcome to') }}
                            </h6>
                            <h1 class="banner__content--title">
                                {{ __('Kobery Al-Galaa') }}
                                <span> {{ __('School') }}</span>
                            </h1>
                            <div class="banner__content--circle rts__circle v__2">
                                <svg class="spinner" viewBox="0 0 100 100">
             <defs>
                                        <path id="circle" d="M50,50 m-37,0a37,37 0 1,1 74,0a37,37 0 1,1 -74,0"></path>
                                    </defs>
                                    <text>
                                        <textPath xlink:href="#circle">Kobery Al-Galaa School * Estd. 1988 * Explore Future *</textPath>
                                    </text>
                                </svg>
                                <div class="rts__circle--icon save-from-hidden">
                                    <a href="https://www.youtube.com/watch?v=7ahgosTZJHg" class="video-play  rts-video-btn popup-video">
                                        <i class="fa-sharp fa-solid fa-play"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="banner__content--description">
                                <p>{{ __('Empowering students for a bright future through excellence in education and character building.') }}
                                </p>
                                <a href="{{ route('contact') }}" class="rts-theme-btn btn-arrow">{{ __('Contact Us') }}
                                    <span>
                                        @if(app()->getLocale() == 'ar')
                                            <i class="fa-regular fa-arrow-left"></i>
                                        @else
                                            <i class="fa-regular fa-arrow-right"></i>
                                        @endif
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="banner__wrapper--right">
                        <img src="{{asset('assets/images/banner/image__2.jpg')}}" alt="banner right">
                    </div>
                </div>
                <!-- banner animated shape -->
                <div class="banner__wrapper--shape">
                    <img src="{{asset('assets/images/banner/banner-svg.svg')}}" style="transform: {{ app()->getLocale() == 'ar'? 'rotate3d(-1, 72, 0, 169deg);':'unset' }};" alt="banner">
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
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__1.jpg')}});">
                        <h5 class="rts__program--item--title">{{ __('Kindergarten') }}</h5>


                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__2.jpg')}});">

                        <h5 class="rts__program--item--title">{{ __('Primary Stage') }}</h5>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__3.jpg')}});">

                        <h5 class="rts__program--item--title"> {{ __('Preparatory Stage') }}</h5>

                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 ">
                    <div class="rts__program--item" style="background-image: url({{asset('assets/images/program/program__4.jpg')}});">

                        <h5 class="rts__program--item--title">{{ __('Secondary Stage') }}  </h5>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- program end -->
    <!-- campus life -->
    <section class="rts__section rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="rts__section--wrapper v__2">
                        <h2 class="rts__section--title"><a href="#">{{ __('Campus Life') }}</a></h2>
                        <p class="rts__section--description">{{ __('Embark on a journey of knowledge and growth at Kobery Al-Galaa School. We nurture bright minds to contribute to our dynamic community.') }}</p>
                        <div class="campus__vector">
                            <img src="{{asset('assets/images/campus/campus__vector.svg')}}" style="transform: {{ app()->getLocale() == 'ar'? 'rotate3d(-1, 72, 0, 169deg);':'unset' }};" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6">
                    <div class="campus__life">
                        <!-- single campus -->
                        <div class="campus__life--single">
                            <div class="campus__life--single--bg">
                                <img src="{{asset('assets/images/campus/campus__life__bg__1.jpg')}}" alt="">
                            </div>
                            <div class="campus__life--single--flex">
                                <div class="campus__life--single--content">
                                    <h4 class="campus__life--single--title"><a href="#">{{ __('Student Activities') }}</a></h4>
                                    <p class="campus__life--single--description">{{ __('Engaging clubs and events to foster creativity and teamwork.') }}</p>
                                </div>
                                <div class="campus__life--single--button">
{{--                                    <a href="{{ route('campus-life') }}">--}}
{{--                                        @if(app()->getLocale() == 'ar')--}}
{{--                                            <i class="fa-sharp fa-regular fa-arrow-left"></i>--}}
{{--                                        @else--}}
{{--                                            <i class="fa-sharp fa-regular fa-arrow-right"></i>--}}
{{--                                        @endif--}}
{{--                                    </a>--}}
                                </div>
                            </div>
                        </div>
                        <!-- single campus end -->
                        <!-- single campus -->
                        <div class="campus__life--single">
                            <div class="campus__life--single--bg">
                                <img src="{{asset('assets/images/campus/campus__life__bg__2.jpg')}}" alt="">
                            </div>
                            <div class="campus__life--single--flex">
                                <div class="campus__life--single--content">
                                    <h4 class="campus__life--single--title"><a href="#">{{ __('Prestigious Institution') }}</a></h4>
                                    <p class="campus__life--single--description">{{ __('The school is considered one of the greatest and most prestigious educational institutions in Giza Governorate') }}</p>
                                </div>
                                <div class="campus__life--single--button">
                                </div>
                            </div>
                        </div>
                        <!-- single campus end -->
                        <!-- single campus -->
                        <div class="campus__life--single">
                            <div class="campus__life--single--bg">
                                <img src="{{asset('assets/images/campus/campus__life__bg__3.jpg')}}" alt="">
                            </div>
                            <div class="campus__life--single--flex">
                                <div class="campus__life--single--content">
                                    <h4 class="campus__life--single--title"><a href="#">{{ __('Activities & Community Service') }}</a></h4>
                                    <p class="campus__life--single--description">{{ __('The school excels in participating in all local activities and competitions, achieving advanced positions in all activities, community engagement, and environmental service') }}</p>
                                </div>
                                <div class="campus__life--single--button">
                                </div>
                            </div>
                        </div>
                        <!-- single campus end -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- campus life end -->
    <!-- team -->
    <section class="rts__section rts__light rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts__section--wrapper">
                    <h2 class="rts__section--title">{{ __('Our Teachers') }}</h2>
                    <div class="rts__section--link">
{{--                        <a href="{{ route('faculty') }}" class="rts-nbg-btn btn-arrow">{{ __('View All Teachers') }}<span>--}}
{{--                                @if(app()->getLocale() == 'ar')--}}
{{--                                    <i class="fa-sharp fa-regular fa-arrow-left"></i>--}}
{{--                                @else--}}
{{--                                    <i class="fa-sharp fa-regular fa-arrow-right"></i>--}}
{{--                                @endif--}}
{{--                        </span>--}}
{{--                        </a>--}}
                    </div>
                </div>
            </div>
            <!-- team member area -->
            <div class="row g-5">
                @foreach($teams as $team)
                <!-- single team -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="rts__single--member">
                        <div class="rts__single--member--thumb">
                                <img src="{{ $team->media ? asset($team->media->url) : asset('assets/images/speaker/teacher__1.jpg') }}" onerror="{{asset('assets/images/research/03.jpg')}}" alt="">
                        </div>
                        <div class="rts__single--member--meta">
                            <h5 class="rts__single--member--meta--title">
                                {{ $team->name }}
                            </h5>
                            <span class="rts__single--member--meta--designation">
                                {{ __($team->job) }}
                            </span>
                        </div>
                    </div>
                </div>
                <!-- single team end -->
                @endforeach
            </div>
            <!-- team member area end -->
        </div>
    </section>
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
