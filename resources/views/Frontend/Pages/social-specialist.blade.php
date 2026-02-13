@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Fall 2023 Chamber Music Showcase 2',
        'page' => 'Event Details'
    ])

    <section class="rts-about-university rts-section-padding">
        <div class="container">
            <div class="row  g-5 justify-content-md-center justify-content-start align-items-center">

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
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-image">
                        <img src="assets/images/about/history.jpg" alt="history">
                    </div>
                </div>
            </div>
            <div class="border-top my-60"></div>

            <div class="row  g-5 justify-content-md-center justify-content-start align-items-center">
                <div class="col-lg-6 col-md-11">
                    <div class="rts-history-image">
                        <img src="assets/images/about/history.jpg" alt="history">
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
            <!-- event details -->
            <div class="rts-event-details pt--120">
                <div class="container">
                    <div class="row justify-content-md-center justify-content-start">
                        <div class="col-lg-12 col-md-12">
                            <div class="event-details">
                                <div class="event-details__content">

                                    <div class="event-details__content--text">
                                        <div class="rts-section">
                                            <h4 class="rts-section-title">About The Event</h4>
                                        </div>
                                    </div>
                                    <div class="event-details__content--feature">
                                        <!-- single feature -->
                                        <div class="single-feature">
                                            <p class="feature-heading">Interactive Workshops:</p>
                                            <p class="feature-description">Connect with like-minded individuals, professionals, and mentors. Build a network that will support your personal and professional growth, fostering collaboration and idea exchange.</p>
                                        </div>
                                        <!-- single feature -->
                                        <div class="single-feature">
                                            <p class="feature-heading">INetworking Opportunities:</p>
                                            <p class="feature-description">Hear from renowned thought leaders who will delve into topics such as artificial intelligence, sustainability, and the future of work. Gain valuable perspectives to help you thrive.</p>
                                        </div>
                                        <!-- single feature -->
                                        <div class="single-feature">
                                            <p class="feature-heading">Networking Opportunities:</p>
                                            <p class="feature-description">Hear from renowned thought leaders who will delve into topics such as artificial intelligence, sustainability, and the future of work. Gain valuable perspectives.</p>
                                        </div>
                                        <!-- single feature -->
                                        <div class="single-feature">
                                            <p class="feature-heading">Registration:</p>
                                            <p class="feature-description">Secure your spot today and be part of the Future Minds Symposium. Early bird registration is now open at www.Unipix Don't miss this opportunity to gain valuable insights.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- event details end -->
        </div>
    </section>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
