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
    <section class="rts-about-university rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts-section">
                    <div class="col-lg-4 col-md-5">
                        <h3 class="rts-section-title">About University</h3>
                    </div>
                    <div class="col-lg-8 col-md-7">
                        <p class="rts-section-description">
                            Welcome to Unipix University, where knowledge meets inspiration, and every individual's educational journey is valued. Established in 1971 Establishment, our university has been a bastion of learning, innovation, and community for 51 years years.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row g-5 justify-content-md-center justify-content-start">
                <div class="col-lg-7 col-xl-8 col-md-11">
                    <div class="rts-about-section">
                        <img src="{{asset('assets/images/about/about-01.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-xl-4 col-md-11">
                    <div class="rts-about-details">
                        <div class="single-about-info">
                            <div class="content">
                                <h3 class="title">20,000</h3>
                                <img src="{{asset('assets/images/icon/11.svg')}}" alt="">
                            </div>
                            <div class="desc">
                                <p>undergraduate and graduate students</p>
                            </div>
                        </div>
                        <div class="single-about-info">
                            <div class="content">
                                <h3 class="title">16,214</h3>
                                <img src="{{asset('assets/images/icon/12.svg')}}" alt="">
                            </div>
                            <div class="desc">
                                <p>Unipix University Faculty and Staff</p>
                            </div>
                        </div>
                        <div class="single-about-info">
                            <div class="content">
                                <h3 class="title">300k</h3>
                                <img src="{{asset('assets/images/icon/13.svg')}}" alt="">
                            </div>
                            <div class="desc">
                                <p>Unipix Alumni Worldwide</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about university end -->

    <!-- history -->
    <div class="rts-history">
        <div class="container">
            <div class="row g-5 justify-content-md-center justify-content-start align-items-center">
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-image">
                        <img src="{{asset('assets/images/about/history.jpg')}}" alt="history">
                    </div>
                </div>
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-section">
                        <h4 class="rts-section-title mb--40">The history of Unipix</h4>
                        <p>
                            On September 8, 1971, Unipix, the first college in the American colonies, was founded in Cambridge, Massachusetts. Unipix University was officially founded by a vote by the Great and General Court of the Massachusetts Bay Colony.  
                            <span class="d-block mb--30"></span>
                            Unipix endowment started with John Unipix initial donation of 400 books and half his estate, but in 1721, Thomas Hollis began the now standard practice of requiring that a donation be used for a specific purpose when he donated money for “a Divinity Professor, to read lectures in the Halls to the students.”
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- history end-->

    <!-- funfact -->
   <div class="rts-funfact rts-section-padding">
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
    <!-- funfact end -->


    <!-- mission -->
    <section class="rts-mission">
        <div class="container">
            <div class="row justify-content-center rt-center">
                <div class="rts-section mb--50">
                    <h2 class="rts-section-title">Mission and Values</h2>
                </div>
            </div>
            <!-- mission -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="rts-timeline-section">
                        <div class="rts-timeline-content">
                                <div class="left-side">
                                    <div class="single-timeline-item">
                                        <h5 class="timeline-title">Diversity</h5>
                                        <p> Celebrating a rich tapestry of backgrounds,
                                            perspectives, and talents
                                        </p>
                                        <img src="{{asset('assets/images/about/mission-1.jpg')}}" alt="">
                                    </div>
                                    <div class="single-timeline-item">
                                        <h5 class="timeline-title">Innovation</h5>
                                        <p> Encouraging creativity, critical thinking, and a
                                            spirit of innovation.
                                        </p>
                                        <img src="{{asset('assets/images/about/mission-2.jpg')}}" alt="">
                                    </div>
                                </div>
                                <div class="separator">
                                </div>
                                <div class="right-side">
                                    <div class="single-timeline-item">
                                        <h5 class="timeline-title">Excellence</h5>
                                        <p> Striving for academic and research excellence
                                            in all endeavors.
                                        </p>
                                        <img src="{{asset('assets/images/about/mission-3.jpg')}}" alt="">
                                    </div>
                                    <div class="single-timeline-item">
                                        <h5 class="timeline-title">Academic Excellence</h5>
                                        <p> Our commitment to academic excellence is reflected in
                                            the diverse range
                                        </p>
                                        <img src="{{asset('assets/images/about/mission-4.jpg')}}" alt="">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- mission end-->

    @include($components . 'campus-tour', ['class' => 'rts-section-padding'])
    @include($components . 'testimonial-v3', ['class' => 'rts-section-padding'])
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection