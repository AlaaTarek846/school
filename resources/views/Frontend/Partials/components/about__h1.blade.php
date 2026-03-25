<!-- About -->
<section class="about rts__padding--120-100 v__1">
    <div class="container">
        <div class="row justify-content-md-center align-items-center">
            <div class="col-lg-6 col-md-10">
                <div class="about__images">
                    <div class="about__images--wrapper">
                        <div class="about__images--wrapper--left">
                            <img src="{{asset('assets/images/about/about__h1.png')}}" alt="">
                        </div>
                        <div class="about__images--wrapper--center">
                            <div class="rts__circle v__1">
                                <svg class="spinner" viewBox="0 0 100 100">
                                    <defs>
                                        <path id="circle-2" d="M50,50 m-37,0a37,37 0 1,1 74,0a37,37 0 1,1 -74,0"></path>
                                    </defs>
                                    <text>
                                        <textPath xlink:href="#circle-2">Kobery Al-Galaa School * Estd. 1988 * Explore Future *</textPath>
                                    </text>
                                </svg>
                                <div class="rts__circle--icon">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="fa-light fa-arrow-left"></i>
                                    @else
                                        <i class="fa-light fa-arrow-right"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="about__images--wrapper--right">
                            <img src="{{asset('assets/images/about/about__h2.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-10">
                <div class="about__content">
                    <h2 class="rts__title">{{ app()->getLocale() == 'ar' ? $one_about->title_ar : $one_about->title_en }}</h2>
                    <p class="rts__description">{!! app()->getLocale() == 'ar' ? $one_about->description_ar : $one_about->description_en !!}</p>
                    <div class="stroke__text v__1">{{ __('EST. 1971') }}</div>
                    <a href="{{ route('about') }}" class="rts-nbg-btn btn-arrow">{{ __('Read More') }} <span>
                            @if(app()->getLocale() == 'ar')
                                <i class="fa-regular fa-arrow-left"></i>
                            @else
                                <i class="fa-regular fa-arrow-right"></i>
                            @endif
                        </span></a>
                </div>
            </div>
        </div>
    </div>
    <!-- funfact -->
    <div class="container rts__pt100">
        <div class="row justify-content-center">
            <div class="col-lg-12 rts-funfact v__1">
                <div class="rts-funfact-wrapper">
                    @if($one_about->details)
                        @foreach($one_about->details as $detail)
                        <div class="single-cta-item">
                            <h2 class="single-cta-item__title">{{ $detail->count }}</h2>
                            <p>{{ app()->getLocale() == 'ar' ? $detail->title_ar : $detail->title_en }}</p>
                        </div>
                        @endforeach
                    @else
                        <!-- Fallback if no details -->
                        <div class="single-cta-item">
                            <h2 class="single-cta-item__title">1000+</h2>
                            <p>{{ __('Students') }}</p>
                        </div>
                         <div class="single-cta-item">
                            <h2 class="single-cta-item__title">50+</h2>
                            <p>{{ __('Teachers') }}</p>
                        </div>
                         <div class="single-cta-item">
                            <h2 class="single-cta-item__title">50+</h2>
                            <p>{{ __('Years of Excellence') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End -->
