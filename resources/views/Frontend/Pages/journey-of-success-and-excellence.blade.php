@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Journey title'),
        'page' => __('Journey title')
    ])

    <!-- Journey of Success Content -->
    <section class="rts-journey-success rts-section-padding">
        <div class="container">
            <!-- Recitation & Innovation Section -->
            <div class="row mb--80">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center mb--60">
                        <h2 class="rts-section-title">{{ __('Recitation & Innovation') }}</h2>
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5">
                        @for($i = 1; $i <= 3; $i++)
                        <div class="col-lg-4 col-md-6">
                            <div class="achievement-card">
                                <div class="card-icon">
                                    <i class="fa-light {{ $i == 3 ? 'fa-lightbulb-on' : 'fa-microphone-stand' }}"></i>
                                </div>
                                <div class="card-content">
                                    <p>{{ __('Achievement ' . $i) }}</p>
                                </div>
                                <div class="achievement-badge">
                                    <i class="fa-solid fa-trophy"></i>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Sports Excellence Section -->
            <div class="row mb--80">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center mb--60">
                        <h2 class="rts-section-title">{{ __('Sports Excellence') }}</h2>
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5">
                        @for($i = 4; $i <= 7; $i++)
                        <div class="col-lg-3 col-md-6">
                            <div class="achievement-card sports">
                                <div class="card-icon">
                                    <i class="fa-light {{ $i == 4 ? 'fa-table-tennis-paddle-ball' : ($i == 6 ? 'fa-basketball' : 'fa-person-swimming') }}"></i>
                                </div>
                                <div class="card-content">
                                    <p>{{ __('Achievement ' . $i) }}</p>
                                </div>
                                <div class="achievement-badge-medal">
                                    <i class="fa-solid fa-medal"></i>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- School Pride Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center mb--60">
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5 justify-content-center">
                        <div class="col-lg-6">
                            <div class="pride-card large">
                                <div class="card-visual">
                                    <img src="{{ asset('assets/images/about/history.jpeg') }}" alt="sports display" class="img-fluid rounded-4">
                                    <div class="visual-overlay">
                                        <i class="fa-solid fa-crown"></i>
                                        <span>{{ __('1st Place') }}</span>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <h4>{{ __('Sports Display 2022') }}</h4>
                                    <p>{{ __('School Award 1') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="pride-card large highlight">
                                <div class="card-text h-100 d-flex flex-column justify-content-center">
                                    <div class="icon-circle mb-4">
                                        <i class="fa-light fa-users-medical"></i>
                                    </div>
                                    <h4>{{ __('Community & Activities') }}</h4>
                                    <p>{{ __('School Award 2') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
