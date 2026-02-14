@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Kobry El Galaa School'),
        'page' => __('School Facilities')
    ])
    <!-- program content -->
    <div class="rts-program rts-section-padding">
        <div class="container">
            <div class="rts-program-description">
                <div class="row sticky-coloum-wrap">
                    <div class="col-lg-12">
                        <div class="program-description-area" id="curriculum">
                            <div class="program-big-thumb text-lg-center" >
                                <img src="{{asset('assets/school_facilities/fa.png')}}" alt="program">
                            </div>
                            <div class="program-about">
                                <h4 class="title">{{ __('School Facilities') }} :</h4>
                                <p>
                                    {{ __('facility_1') }}
                                    <br>
                                    {{ __('facility_2') }}
                                    <br>
                                    {{ __('facility_3') }}
                                    <br>
                                    {{ __('facility_4') }}
                                    <br>
                                    {{ __('facility_5') }}
                                    <br>
                                    {{ __('facility_6') }}
                                    <br>
                                    {{ __('facility_7') }}
                                </p>

                            </div>
                            <div class="row g-5 faculty-sub-details mt--40">
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/school_facilities/fa-1.jpg')}}" alt="course-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/school_facilities/fa-2.jpg')}}" alt="course-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/school_facilities/fa-3.jpg')}}" alt="course-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/school_facilities/fa-4.jpg')}}" alt="course-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/school_facilities/fa-5.jpg')}}" alt="course-thumbnail">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- program content end -->


    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
