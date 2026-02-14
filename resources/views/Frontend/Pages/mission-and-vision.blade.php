@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Mission and Vision'),
        'page' => __('Mission and Vision')
    ])

    <!-- Vision & Mission Section -->
    <section class="rts-vision-mission rts-section-padding">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <div class="vision-mission-card vision">
                        <div class="card-icon">
                            <i class="fa-light fa-eye"></i>
                        </div>
                        <h3 class="title">{{ __('School Vision Title') }}</h3>
                        <p>{{ __('School Vision Desc') }}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="vision-mission-card mission">
                        <div class="card-icon">
                            <i class="fa-light fa-bullseye-arrow"></i>
                        </div>
                        <h3 class="title">{{ __('School Mission Title') }}</h3>
                        <div class="mission-list">
                            @for($i = 1; $i <= 6; $i++)
                                <div class="mission-item">
                                    <i class="fa-solid fa-check"></i>
                                    <span>{{ __('Mission ' . $i) }}</span>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- School Goals Section -->
    <section class="rts-school-goals rts-section-padding bg-light">
        <div class="container">
            <div class="section-title-wrapper text-center mb--60">
                <h2 class="rts-section-title">{{ __('School Goals Title') }}</h2>
                <div class="title-line"></div>
            </div>
            <div class="row g-4">
                @for($i = 1; $i <= 9; $i++)
                <div class="col-lg-4 col-md-6">
                    <div class="goal-item-card">
                        <div class="goal-number">{{ sprintf('%02d', $i) }}</div>
                        <p>{{ __('Goal ' . $i) }}</p>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <!-- Educational Stages -->
    <section class="rts-educational-stages rts-section-padding">
        <div class="container">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <div class="stage-image">
                        <img src="{{ asset('assets/images/about/about-01.jpg') }}" alt="Educational Stages" class="rounded-4 shadow">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="stage-content">
                        <h2 class="rts-section-title mb--30">{{ __('Educational Stages Title') }}</h2>
                        <p class="mb--40">{{ __('Educational Stages Desc') }}</p>
                        <div class="highlight-box">
                            <i class="fa-light fa-graduation-cap"></i>
                            <span>{{ __('Covering all stages from Kindergarten to High School') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Activities & Quality -->
    <section class="rts-quality-activities rts-section-padding bg-dark text-white">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 border-end-custom">
                    <div class="quality-content">
                        <h3 class="text-white mb--30"><i class="fa-light fa-award me-3 text-primary"></i>{{ __('Quality Title') }}</h3>
                        <p class="text-gray">{{ __('Quality Desc') }}</p>
                        <div class="accreditation-timeline mt--40">
                            <div class="acc-item">
                                <span class="year">2012</span>
                                <p>{{ __('Accreditation 1') }}</p>
                            </div>
                            <div class="acc-item">
                                <span class="year">2018</span>
                                <p>{{ __('Accreditation 2') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ps-lg-5">
                    <div class="activities-content">
                        <h3 class="text-white mb--30"><i class="fa-light fa-volleyball me-3 text-primary"></i>{{ __('Activities and Talent Care') }}</h3>
                        <p class="text-gray">{{ __('Activities Desc') }}</p>
                        <div class="alumni-highlight mt--40">
                            <h4 class="text-white mb--20">{{ __('Alumni Title') }}</h4>
                            <p class="text-gray italic">{{ __('Alumni Desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
