<!-- Testimonial Start -->
<div class="rts-testimonial {{ $class ?? '' }}">
    <div class="container">
        <!-- testimonial content -->
        <div class="row">
            <div class="col-12">
                <div class="rts-testimonial-box">
                    <div class="testimonial-item rt-flex">
                        <div class="testimonial-item-image">
                            <img src="{{asset('assets/images/testimonial/testimonial-big.jpg')}}" alt="testimonial thumbnail">
                        </div>
                            <div class="testimonial-item-content w-570 rt-relative">
                                    <div class="swiper swiper-data"
                                    data-swiper='{
                                        "slidesPerView":1,
                                        "loop": true,
                                        "navigation":{
                                            "nextEl":".rt-next",
                                            "prevEl":".rt-prev"
                                        },
                                        "autoplay":{
                                            "delay":"3000"
                                        }
                                }'>
                                <div class="swiper-wrapper">
                                    @foreach($testimonials as $testimonial)
                                    <!-- single testimonial -->
                                    <div class="swiper-slide">
                                        <div class="single-testimonial">
                                            <p class="testimonial-text">
                                                {!! app()->getLocale() == 'ar' ? $testimonial->description_ar : $testimonial->description_en !!}
                                            </p>
                                            <div class="rt-testimonial-author mt--50">
                                                <div class="rt-author-meta rt-flex rt-gap-20">
                                                    <div class="rt-author-img">
                                                        @if($testimonial->media->first())
                                                            <img src="{{asset($testimonial->media->first()->url)}}" alt="author">
                                                        @else
                                                            <img src="{{asset('assets/images/testimonial/author-1.png')}}" alt="author">
                                                        @endif
                                                    </div>
                                                    <div class="rt-author-info">
                                                        <h5 class="mb-1">{{ app()->getLocale() == 'ar' ? $testimonial->name_ar : $testimonial->name_en }}</h5>
                                                        <p>{{ app()->getLocale() == 'ar' ? $testimonial->job_ar : $testimonial->job_en }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- rts arrow -->
                            <div class="rts-slider-arrow testimonial-arrow">
                                <div class="rt-slider-btn rt-next">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="fa-solid fa-chevron-right"></i>
                                    @else
                                        <i class="fa-solid fa-chevron-left"></i>
                                    @endif
                                </div>
                                <div class="rt-slider-btn rt-prev">
                                    @if(app()->getLocale() == 'ar')
                                        <i class="fa-solid fa-chevron-left"></i>
                                    @else
                                        <i class="fa-solid fa-chevron-right"></i>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Testimonial end -->
