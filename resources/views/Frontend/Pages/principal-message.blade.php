@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'About Unipix University',
        'page' => 'about'
    ])

    <!-- content -->
    <div class="rts-faculty-details rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts-section mb--60">
                    <h3 class="rts-section-title">{{ app()->getLocale() == 'ar' ? 'رسالة من العميد' : 'Message from Dean' }}</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="faculty-image text-center">
                        @if($principal_message && $principal_message->image)
                            <img class="img-fluid mw-100 " src="{{asset($principal_message->image)}}" alt="faculty image">
                        @else
                            <img class="img-fluid mw-100 " src="{{asset('assets/images/faculty/02.jpg')}}" alt="faculty image">
                        @endif
                        <div class="h5 mb-2 mt-5">{{ app()->getLocale() == 'ar' ? $principal_message->title_ar : $principal_message->title_en }}</div>
                        <span>{{ app()->getLocale() == 'ar' ? 'رسالة المدير' : 'Principal Message' }}</span>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="faculty-content-text ms-lg-5 mt-5 mt-lg-0" style="word-wrap: break-word;">
                       {!! app()->getLocale() == 'ar' ? $principal_message->description_ar : $principal_message->description_en !!}
                    </div>
                </div>
                <div class="border-top my-60"></div>
            </div>

        </div>
    </div>
    <!-- content end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
