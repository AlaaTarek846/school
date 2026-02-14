@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'About Unipix University',
        'page' => 'about'
    ])

    <!-- about university -->
    <section class="rts-about-university rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts-section">
                    <div class="col-lg-4 col-md-5">
                        <h3 class="rts-section-title">{{ app()->getLocale() == 'ar' ? $one_about->title_ar : $one_about->title_en }}</h3>
                    </div>
                    <div class="col-lg-8 col-md-7" style="word-wrap: break-word;">
                        <p class="rts-section-description">
                            {!! app()->getLocale() == 'ar' ? $one_about->description_ar : $one_about->description_en !!}
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-5 justify-content-md-center justify-content-start">
                <div class="col-lg-7 col-xl-8 col-md-11">
                    <div class="rts-about-section">
                        @if($one_about->firstPhoto)
                            <img src="{{ asset($one_about->firstPhoto->url) }}" alt="about">
                        @else
                            <img src="{{asset('assets/images/about/about-01.jpg')}}" alt="">
                        @endif
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 col-md-11">
                    <div class="rts-about-details">
                        @foreach($one_about->details as $index => $detail)
                        <div class="single-about-info">
                            <div class="content">
                                <h3 class="title">{{ $detail->count }}</h3>
                                <img src="{{asset('assets/images/icon/'.(11+$index).'.svg')}}" alt="">
                            </div>
                            <div class="desc">
                                <p>{{ app()->getLocale() == 'ar' ? $detail->title_ar : $detail->title_en }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about university end -->

    <!-- history -->
    <div class="rts-history">
        <div class="container">
            <div class="row g-5 justify-content-md-center justify-content-start align-items-center">
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-image">
                        <img src="{{asset('assets/images/about/history.jpg')}}" alt="history">
                    </div>
                </div>
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-section" style="word-wrap: break-word;">
                        <h4 class="rts-section-title mb--40">{{ app()->getLocale() == 'ar' ? $why_choose_us->title_ar : $why_choose_us->title_en }}</h4>
                        <p>
                            {!! app()->getLocale() == 'ar' ? $why_choose_us->description_ar : $why_choose_us->description_en !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- history end-->

    <!-- funfact -->
   <div class="rts-funfact rts-section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 ">
                    <div class="rts-funfact-wrapper">
                        @foreach($why_choose_us->details as $detail)
                        <div class="single-cta-item" style="word-wrap: break-word;">
                            <h2 class="single-cta-item__title">{{ $detail->count }}%</h2>
                            <p>{!! app()->getLocale() == 'ar' ? $detail->title : $detail->title !!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- funfact end -->


    <!-- mission -->
    <section class="rts-mission">
        <div class="container">
            <div class="row justify-content-center rt-center">
                <div class="rts-section mb--50">
                    <h2 class="rts-section-title">Mission and Values</h2>
                </div>
            </div>
            <!-- mission -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="rts-timeline-section">
                        <div class="rts-timeline-content">
                            @php
                                $left_side = $welcome_child->filter(fn($item, $key) => $key % 2 == 0);
                                $right_side = $welcome_child->filter(fn($item, $key) => $key % 2 != 0);
                            @endphp
                                <div class="left-side">
                                    @foreach($left_side as $item)
                                    <div class="single-timeline-item" style="word-wrap: break-word;">
                                        <h5 class="timeline-title">{{ app()->getLocale() == 'ar' ? $item->title_ar : $item->title_en }}</h5>
                                        <p>{!! app()->getLocale() == 'ar' ? $item->description_ar : $item->description_en !!}</p>
                                        @if($item->image)
                                            <img src="{{asset($item->image)}}" alt="mission">
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                                <div class="separator">
                                </div>
                                <div class="right-side">
                                    @foreach($right_side as $item)
                                    <div class="single-timeline-item" style="word-wrap: break-word;">
                                        <h5 class="timeline-title">{{ app()->getLocale() == 'ar' ? $item->title_ar : $item->title_en }}</h5>
                                        <p>{!! app()->getLocale() == 'ar' ? $item->description_ar : $item->description_en !!}</p>
                                        @if($item->image)
                                            <img src="{{asset($item->image)}}" alt="mission">
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- mission end-->

    @include($components . 'campus-tour', ['class' => 'rts-section-padding', 'campus_tour' => $campus_tour])
    @include($components . 'testimonial-v3', ['class' => 'rts-section-padding', 'testimonials' => $testimonials])
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
