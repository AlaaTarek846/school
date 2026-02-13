@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Department of English',
        'page' => 'Department Details'
    ])
    <!-- program content -->
    <div class="rts-program rts-section-padding">
        <div class="container">
            <div class="rts-program-description">
                <div class="row sticky-coloum-wrap">
                    <div class="col-lg-12">
                        <div class="program-description-area" id="curriculum">
                            <div class="program-big-thumb">
                                <img src="{{asset('assets/images/faculty/10.jpg')}}" alt="program">
                            </div>
                            <div class="program-about">
                                <h4 class="title">About The Program</h4>
                                <p>The Department of English, under the Faculty of Arts & Social Sciences (FA), started its journey with two predominant visions: first, to enhance and nourish students’ mental, ethical, and creative facets of their personality; secondly, to prepare themselves for efficient professional and technical employment in future. There can be no denying that ethics, values, morality and creativity are the essential ingredients of nation-building.</p>
                                <p>As a pioneering private university of this country, Unipix has always been committed to imparting these ingredients among its students as the larger concerns of society. The Department of English firmly believes that value-education can bring excellence in leadership, and consequently excellence in nation-building.</p>
                            </div>
                            <div class="row g-5 faculty-sub-details mt--40">
                                <div class="rts-section mb-4 text-start">
                                    <h3 class="rts-section-title">List of Departments</h3>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/images/course/09.jpg')}}" alt="course-thumbnail">
                                        </div>
                                        <div class="cat-meta">
                                            <div class="cat-title">
                                                <a href="{{ route('program-single') }}">Bachelor of arts in English</a>
                                            </div>
                                            <div class="cat-link">
                                                <a href="{{ route('program-single') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/images/course/10.jpg')}}" alt="course-thumbnail">
                                        </div>
                                        <div class="cat-meta">
                                            <div class="cat-title">
                                                <a href="{{ route('program-single') }}">M.A. English</a>
                                            </div>
                                            <div class="cat-link">
                                                <a href="{{ route('program-single') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/images/course/11.jpg')}}" alt="course-thumbnail">
                                        </div>
                                        <div class="cat-meta">
                                            <div class="cat-title">
                                                <a href="{{ route('program-single') }}">M.S. in Nursing</a>
                                            </div>
                                            <div class="cat-link">
                                                <a href="{{ route('program-single') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="single-cat-item">
                                        <div class="cat-thumb">
                                            <img src="{{asset('assets/images/course/12.jpg')}}" alt="course-thumbnail">
                                        </div>
                                        <div class="cat-meta">
                                            <div class="cat-title">
                                                <a href="{{ route('program-single') }}">Master of Public Health</a>
                                            </div>
                                            <div class="cat-link">
                                                <a href="{{ route('program-single') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
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
    </div>
    <!-- program content end -->


    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
