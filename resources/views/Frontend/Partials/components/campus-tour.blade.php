<section class="rts-campus-tour {{ $class ?? '' }}">
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="section-title rt-center mb--50">{{ app()->getLocale() == 'ar' ? ($campus_tour->title_ar ?? 'جولة في الحرم الجامعي') : ($campus_tour->title_en ?? 'Our Campus Tour') }}</h2>
            <div class="col-12">
                <div class="rts-video-section height-500 mb--50">
                    <a href="{{ $campus_tour->link ?? 'https://www.youtube.com/watch?v=Uwq1uiuM_9w' }}" class="rts-video-section-player popup-video video-btn">
                        <i class="fa-sharp fa-solid fa-play"></i>
                    </a>
                    @if(isset($campus_tour->image))
                        <img src="{{asset($campus_tour->image)}}" alt="video-bg">
                    @else
                        <img src="{{asset('assets/images/about/video-thumb.jpg')}}" alt="video-bg">
                    @endif
                </div>
            </div>
            <div class="col-lg-8">
                <div class="rts-video-section-text rt-center mx-3" style="word-wrap: break-word;">
                    <p>{!! app()->getLocale() == 'ar' ? ($campus_tour->description_ar ?? '') : ($campus_tour->description_en ?? '') !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
