@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Social Specialist'),
        'page' => __('Social Specialist')
    ])

    <!-- Social Specialist Content -->
    <section class="rts-social-specialist rts-section-padding">
        <div class="container">
            <!-- Psychological Preparation Section -->
            <div class="row mb--80">
                <div class="col-lg-12">
                    <div class="section-title-area text-center mb--50">
                        <h2 class="rts-section-title">{{ __('Psychological Preparation') }}</h2>
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="col-lg-4 col-md-6">
                            <div class="prep-card">
                                <div class="card-icon">
                                    <i class="fa-light fa-brain-circuit"></i>
                                </div>
                                <div class="card-content">
                                    <p>{{ __('Psychological Prep Item ' . $i) }}</p>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>

            <div class="separator-custom mb--80"></div>

            <!-- Role Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area text-center mb--50">
                        <h2 class="rts-section-title">{{ __('Role of Social Specialist') }}</h2>
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="role-image-container">
                        <img src="{{ asset('assets/images/about/history.jpeg') }}" alt="social specialist role" class="img-fluid rounded-4 shadow-lg">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="role-points-list">
                        @for($i = 1; $i <= 10; $i++)
                        <div class="role-point-item">
                            <div class="point-number">{{ sprintf('%02d', $i) }}</div>
                            <div class="point-text">
                                <p>{{ __('Role Point ' . $i) }}</p>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
