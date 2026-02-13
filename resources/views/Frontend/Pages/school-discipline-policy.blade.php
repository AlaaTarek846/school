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
    <section class="rts-about-university pt--100 pb--80">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="academic-picture">
                        <img src="{{asset('assets/images/feature/academic-1.jpg')}}" alt="academic">
                    </div>
                </div>
            </div>
            <div class="border-top my-60"></div>
            <div class="row">
                <div class="col-12">
                    <div class="academic-picture">
                        <img src="{{asset('assets/images/feature/academic-1.jpg')}}" alt="academic">
                    </div>
                </div>
            </div>
            <div class="border-top my-60"></div>
            <div class="row">
                <div class="col-12">
                    <div class="academic-picture">
                        <img src="{{asset('assets/images/feature/academic-1.jpg')}}" alt="academic">
                    </div>
                </div>
            </div>
            <div class="border-top my-60"></div>
            <div class="row">
                <div class="col-12">
                    <div class="academic-picture">
                        <img src="{{asset('assets/images/feature/academic-1.jpg')}}" alt="academic">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about university end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
