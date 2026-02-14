@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('School discipline regulations'),
        'page' => __('About')
    ])

    <!-- about university -->
    <section class="rts-about-university pt--100 pb--80">
        <div class="container">
            @foreach($policies as $policy)
                <div class="row">
                    <div class="col-12">
                        <div class="academic-picture text-center">
                            @php
                                $image = app()->getLocale() == 'ar' ? ($policy->image ?? $policy->image_en) : ($policy->image_en ?? $policy->image);
                            @endphp
                            <img src="{{asset($image)}}" alt="policy" style="max-width: 100%;">
                        </div>
                    </div>
                </div>
                @if(!$loop->last)
                    <div class="border-top my-60"></div>
                @endif
            @endforeach
        </div>
    </section>
    <!-- about university end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
