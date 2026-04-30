@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Journey of Success and Excellence'),
        'page' => __('Journey of Success and Excellence')
    ])

    <!-- Journey of Success Content -->
    <section class="rts-journey-success rts-section-padding">
        <div class="container">
            <!-- Achievement Sections -->
            @foreach($achievementSections as $section)
            <div class="row mb--80">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center mb--60">
                        <h2 class="rts-section-title">{{ $section->title }}</h2>
                        <div class="title-line" style="background-color: {{ $section->border_color }}"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5">
                        @foreach($section->achievements as $achievement)
                        <div class="col-lg-3 col-md-6">
                            <div class="achievement-card" style="border-color: {{ $section->border_color }};">
                                <div class="card-icon">
                                    <i class="fa-light {{ $achievement->icon }}"></i>
                                </div>
                                <div class="card-content">
                                    <p>{{ $achievement->text }}</p>
                                </div>
                                <div class="achievement-badge">
                                    <i class="fa-solid {{ $achievement->badge_icon }}"></i>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach

            <!-- School Pride Section -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-wrapper text-center mb--60">
                        <div class="title-line"></div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row g-5 justify-content-center">
                        @if($leftPride)
                        <div class="col-lg-6">
                            <div class="pride-card large">
                                <div class="card-visual">
                                    <img src="{{ asset($leftPride->image) }}" alt="sports display" class="img-fluid rounded-4">
                                    <div class="visual-overlay">
                                        <i class="{{ $leftPride->overlay_icon }}"></i>
                                        <span>{{ $leftPride->overlay_text }}</span>
                                    </div>
                                </div>
                                <div class="card-text">
                                    <h4>{{ $leftPride->title }}</h4>
                                    <p>{{ $leftPride->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($rightPride)
                        <div class="col-lg-6">
                            <div class="pride-card large highlight">
                                <div class="card-text h-100 d-flex flex-column justify-content-center">
                                    <div class="icon-circle mb-4">
                                        <i class="{{ $rightPride->icon }}"></i>
                                    </div>
                                    <h4>{{ $rightPride->title }}</h4>
                                    <p>{{ $rightPride->description }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
