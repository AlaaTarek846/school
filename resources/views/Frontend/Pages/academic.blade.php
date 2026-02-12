@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Academics',
        'page' => 'academic'    
    ])

    <!-- about university -->
    <section class="rts-about-university pt--100 pb--80">
        <div class="container">
            <div class="row">
                <div class="rts-section">
                    <div class="col-lg-4 col-md-3 col-sm-12">
                        <h3 class="rts-section-title">Academics</h3>
                    </div>
                    <div class="col-lg-8 col-md-9 col-sm-12">
                        <p class="rts-section-description">
                            This distinguished university of arts, sciences and professional studies is noted for exceptional program offerings and an interdisciplinary approach to learning, while also providing students with a diverse, high-quality student, faculty and staff population.
                        </p>
                    </div>
                </div>
            </div>
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

    <div class="rts-funfact ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 ">
                    <div class="rts-funfact-wrapper">
                        <div class="single-cta-item">
                            <h2 class="single-cta-item__title">90%</h2>
                            <p>post-graduation success rate</p>
                        </div>
                        <div class="single-cta-item">
                            <h2 class="single-cta-item__title">Top 10</h2>
                            <p>Colleges that Create Futures</p>
                        </div>
                        <div class="single-cta-item">
                            <h2 class="single-cta-item__title">No. 1</h2>
                            <p>in the nation for materials R&amp;D</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- multi row item -->
    <div class="rts-multi-row-section pt--100">
        <div class="container">
            <!-- first -->
            <div class="row g-5 justify-content-center justify-content-start align-items-center">
                <div class="col-lg-7 col-md-11">
                    <div class="rts-multi-row-image">
                        <img src="{{asset('assets/images/feature/multi-1.jpg')}}" alt="undergraduate education">
                    </div>
                </div>
                <div class="col-lg-5 col-md-11">
                    <div class="rts-multi-row-content">
                        <h4 class="row-title">Undergraduate Education</h4>
                        <p>Unipix Undergrad is your guide to undergraduate academics and opportunities run by the Vice Provost for Undergraduate Education.</p>
                         <div class="program-list">
                            <a href="{{ route('program-single') }}" class="program-item"><span>Africana Studies <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="program-item"><span>Accounting, BS <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="program-item"><span>Applied Mathematics <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="program-item"><span>Anthropology <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="mt--15 about-btn rts-nbg-btn btn-arrow">View All Program <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></a>
                         </div>
                    </div>
                </div>
            </div>
            <!-- second -->
            <div class="row g-5 justify-content-center justify-content-start align-items-center">
                <div class="col-lg-5 col-md-11">
                    <div class="rts-multi-row-content left-side">
                        <h3 class="row-title">Graduate Education</h3>
                        <p>The VPGE office works collaboratively across the University to ensure that every graduate student has the best possible education.</p>
                         <div class="program-list">
                            <a href="{{ route('program-single') }}" class="program-item"><span>M.A. in American Studies <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="program-item"><span>Biomedical Engineering <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="program-item"><span>Master of Public Health <i class="fa-regular fa-chevron-right"></i></span> <span>A.B</span></a>
                            <a href="{{ route('program-single') }}" class="mt--15 about-btn rts-nbg-btn btn-arrow">View All Program <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></a>
                         </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-11">
                    <div class="rts-multi-row-image">
                        <img src="{{asset('assets/images/feature/multi-2.jpg')}}" alt="undergraduate education">
                    </div>
                </div>
            </div>
            <!-- third -->
            <div class="row g-5 justify-content-center justify-content-start align-items-center">
                <div class="col-lg-7 col-md-11">
                    <div class="rts-multi-row-image">
                        <img src="{{asset('assets/images/feature/multi-3.jpg')}}" alt="undergraduate education">
                    </div>
                </div>
                <div class="col-lg-5 col-md-11">
                    <div class="rts-multi-row-content">
                         <div class="program-list">
                            <div class="single-list">
                                <h4 class="row-title">Lifelong Learning</h4>
                                <p>Unipix offers a wide range of programs, classes, internships, and an entire online high school.</p>
                                <a href="#" class="about-btn rts-nbg-btn btn-arrow">Unipix  Undergraduate <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></a>
                            </div>
                            <div class="single-list">
                                <h4 class="row-title">Professional Development</h4>
                                <p>Explore the 67 major fields of undergraduate study at Stanford.</p>
                                <a href="#" class="about-btn rts-nbg-btn btn-arrow">Professional Development <span><i class="fa-sharp fa-regular fa-arrow-right"></i></span></a>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- multi row item end -->
    @include($components . 'campus-tour', ['class' => 'rts-section-padding'])
    @include($components . 'testimonial-v3', ['class' => 'pb--120'])
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection