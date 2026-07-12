@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.webp',
        'title' => __('Why Choose Galaa schools'),
        'page' => __('Why Choose Us')
    ])

    <!-- Introduction Section -->
    <section class="rts-why-choose-intro rts-section-padding">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <div class="section-title-wrapper mb--50">
                        <h2 class="rts-section-title">{{ __('Excellence in Education') }}</h2>
                        <p class="description">{{ __('At Galaa Schools, we believe in providing a holistic educational experience that prepares students for the challenges of the future while honoring our rich heritage.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- history (Restored & Enhanced) -->
    <div class="rts-history rts-section-padding bg-light">
        <div class="container">
            <div class="row g-5 justify-content-md-center justify-content-start align-items-center">
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-image premium-border">
                        @if($why_choose_us->image)
                            <img src="{{ $why_choose_us->image }}" alt="history" style="border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                        @else
                        <img src="{{asset('assets/images/about/history.jpg')}}" alt="history" style="border-radius: 20px; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-section" style="word-wrap: break-word;">
                        <h3 class="rts-section-title mb--30" style="color: #2b3a8e;">{{ app()->getLocale() == 'ar' ? $why_choose_us->title_ar : $why_choose_us->title_en }}</h3>
                        <div class="history-content" style="font-size: 18px; line-height: 1.8; color: #444;">
                            {!! app()->getLocale() == 'ar' ? $why_choose_us->description_ar : $why_choose_us->description_en !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- history end-->

    <!-- funfact (Restored & Enhanced) -->
   <div class="rts-funfact rts-section-padding" style="background: linear-gradient(135deg, #2b3a8e 0%, #1a2a6c 100%); color: #fff;">
        <div class="container">
            <div class="row justify-content-center mb--50">
                <div class="col-lg-8 text-center">
                    <h2 class="rts-section-title text-white">{{ __('Our Achievement in Numbers') }}</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="rts-funfact-wrapper" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; text-align: center;">
                        @foreach($why_choose_us->details as $detail)
                        <div class="single-cta-item" style="padding: 30px; background: rgba(255,255,255,0.1); border-radius: 15px; backdrop-filter: blur(10px);">
                            <h2 class="single-cta-item__title text-white" style="font-size: 50px; margin-bottom: 10px;">{{ $detail->count }}%</h2>
                            <p class="text-white" style="font-size: 16px; font-weight: 500;">{!! app()->getLocale() == 'ar' ? $detail->title : $detail->title !!}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- funfact end -->

    <!-- Features Section -->
    <section class="rts-features rts-section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item text-center p-5 shadow-sm rounded-4" style="transition: transform 0.3s;">
                        <div class="icon mb-4" style="font-size: 40px; color: #2b3a8e;"><i class="fa-light fa-award"></i></div>
                        <h4>{{ __('Certified Quality') }}</h4>
                        <p>{{ __('National and international certifications for excellence in education.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item text-center p-5 shadow-sm rounded-4" style="transition: transform 0.3s;">
                        <div class="icon mb-4" style="font-size: 40px; color: #e83e8c;"><i class="fa-light fa-users-gear"></i></div>
                        <h4>{{ __('Expert Faculty') }}</h4>
                        <p>{{ __('A team of highly qualified educators dedicated to student success.') }}</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="feature-item text-center p-5 shadow-sm rounded-4" style="transition: transform 0.3s;">
                        <div class="icon mb-4" style="font-size: 40px; color: #28a745;"><i class="fa-light fa-laptop-code"></i></div>
                        <h4>{{ __('Modern Facilities') }}</h4>
                        <p>{{ __('State-of-the-art labs and technology-integrated classrooms.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .feature-item:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1) !important;
        }
        .rts-history-image img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }
    </style>

    @include($components . 'campus-tour', ['class' => 'rts-section-padding', 'campus_tour' => $campus_tour])
    @include($components . 'testimonial-v3', ['class' => 'rts-section-padding', 'testimonials' => $testimonials])
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
