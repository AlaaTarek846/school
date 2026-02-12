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
            <div class="row justify-content-md-center">
                <div class="col-lg-12 col-md-11 d-flex flex-wrap gap-5 justify-content-between align-items-start mb--60 border-bottom pb-5">
                    <div class="rts-section">
                        <h3 class="rts-section-title">Faculty & Staff Directory</h3>
                    </div>
                    <div class="search-filter">
                        <form action="#" class="cat-search-form">
                            <input type="text" placeholder="What interests you?" name="s" id="cat">
                            <button type="submit" class="cat-search"><i class="fa-light fa-magnifying-glass"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row g-5">
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/01.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Arts</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/02.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Science</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/03.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Law</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/03.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Social
                                    Sciences</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/04.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Business Studies</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/05.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Engineering &
                                    Technology</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/06.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Fine Art</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/07.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Biological Sciences</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/08.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Medicine</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/09.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">M.A. in Education</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/10.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Faculty of Earth and Environmental Sciences</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/11.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Education, MA</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/12.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Nursing, DNP</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/13.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">M.A. in Counseling</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/14.jpg')}}" alt="course-thumbnail">
                            <a href="{{ route('faculty-sub-details') }}" class="cat-link-btn">Online Education</a>
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">M.S. in Nursing</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- single item -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="single-cat-item">
                        <div class="cat-thumb">
                            <img src="{{asset('assets/images/course/15.jpg')}}" alt="course-thumbnail">
                        </div>
                        <div class="cat-meta">
                            <div class="cat-title">
                                <a href="{{ route('faculty-sub-details') }}">Master of Public Health</a>
                            </div>
                            <div class="cat-link">
                                <a href="{{ route('faculty-sub-details') }}" class="cat-link-arrow"><i class="fa-sharp fa-regular fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="rts-load-more-btn rt-center mt--60">
                <a href="{{ route('faculty-details') }}" class="rts-theme-btn primary lh-100">Load More</a>
            </div>
        </div>
    </section>
    <!-- faculty directory end -->
     
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection