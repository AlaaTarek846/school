@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Faculty Areas',
        'page' => 'Faculty'
    ])
    <!-- faculty directory -->
    <section class="rts-faculty rts-section-padding">
        <div class="container">
            <div class="row g-5">
                @foreach($files as $file)
                    <!-- single item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 text-center">
                        <div class="single-cat-item">
                            @if($file->image)
                                <div class="cat-thumb">
                                    <img src="{{asset($file->image)}}" alt="file-thumbnail">
                                </div>
                            @endif
                            <div class="cat-meta">
                                <div class="cat-title">
                                    <h5 class="title">{{ app()->getLocale() == 'ar' ? $file->title_ar : $file->title_en }}</h5>
                                </div>
                                <div class="cat-link">
                                    <a href="{{ asset($file->pdf) }}" download class="rts-theme-btn primary-2 py-2 px-4 mt-3" style="width: 100%;">
                                        {{ app()->getLocale() == 'ar' ? 'تحميل' : 'Download' }} PDF
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($files->count() > 12)
                <div class="rts-load-more-btn rt-center mt--60">
                    <a href="{{ route('faculty-details') }}" class="rts-theme-btn primary lh-100">Load More</a>
                </div>
            @endif
        </div>
    </section>
    <!-- faculty directory end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
