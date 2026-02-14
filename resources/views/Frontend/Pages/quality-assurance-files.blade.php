@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Quality Assurance Files'),
        'page' => __('Quality Assurance Files')
    ])
    <!-- faculty directory -->
    <section class="rts-faculty rts-section-padding">
        <div class="container">
            <div class="row g-5">
                @foreach($files as $file)
                    <!-- single item -->
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="file-card text-center">
                            <div class="icon-box">
                                <i class="fa-light fa-file-pdf"></i>
                            </div>
                            <div class="file-title">
                                {{ app()->getLocale() == 'ar' ? $file->title_ar : $file->title_en }}
                            </div>
                            <div class="cat-link">
                                <a href="{{ asset($file->pdf) }}" download class="download-btn">
                                    <i class="fa-light fa-download"></i>
                                    {{ app()->getLocale() == 'ar' ? 'تحميل' : 'Download' }}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @if($files->count() > 12)
                <div class="rts-load-more-btn rt-center mt--60">
                    <a href="#" class="rts-theme-btn primary lh-100">Load More</a>
                </div>
            @endif
        </div>
    </section>
    <!-- faculty directory end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
