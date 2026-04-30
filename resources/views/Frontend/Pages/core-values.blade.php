@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Core Values'),
        'page' => __('Core Values')
    ])

    <!-- Core Values Section -->
    <section class="rts-core-values rts-section-padding">
        <div class="container">
            <div class="row justify-content-center text-center mb--60">
                <div class="col-lg-8">
                    <div class="section-title-wrapper">
                        <h2 class="rts-section-title mb--20">{{ __('Our Pillars of Excellence') }}</h2>
                        <p class="description">
                            {{ __('At Galaa School, our core values are the foundation of everything we do. They guide our interactions, shape our curriculum, and define our community.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                @foreach($core_values as $index => $value)
                <div class="col-lg-6 col-md-6">
                    <div class="core-value-card p-5 h-100 shadow-sm border-0 rounded-4" style="transition: all 0.3s ease; background: #fff; position: relative; overflow: hidden;">
                        <div class="card-bg-icon" style="position: absolute; right: -20px; bottom: -20px; font-size: 150px; opacity: 0.05; color: #2b3a8e; transform: rotate(-15deg);">
                            <i class="fa-light fa-shield-heart"></i>
                        </div>
                        <div class="d-flex align-items-start gap-4">
                            <div class="icon-wrapper d-flex align-items-center justify-content-center" style="min-width: 70px; height: 70px; background: rgba(43, 58, 142, 0.1); border-radius: 20px; color: #2b3a8e; font-size: 30px;">
                                <i class="fa-light {{ $index == 0 ? 'fa-award' : ($index == 1 ? 'fa-scale-balanced' : ($index == 2 ? 'fa-handshake' : 'fa-lightbulb-on')) }}"></i>
                            </div>
                            <div class="content">
                                <h4 class="mb-3" style="color: #2b3a8e; font-weight: 700;">
                                    {{ app()->getLocale() == 'ar' ? $value->title_ar : $value->title_en }}
                                </h4>
                                <p style="font-size: 17px; line-height: 1.7; color: #555;">
                                    {!! app()->getLocale() == 'ar' ? $value->description_ar : $value->description_en !!}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- School Motto Section -->
    <section class="rts-school-motto bg-light rts-section-padding">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="motto-image rounded-4 overflow-hidden shadow-lg">
                        <img src="{{ asset('assets/images/about/motto.jpg') }}" alt="Galaa School Motto" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="motto-content ps-lg-5">
                        <span class="sub-title mb--15" style="color: #e83e8c; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">{{ __('Our Commitment') }}</span>
                        <h2 class="mb--30" style="color: #1a2a6c;">{{ __('Nurturing Future Leaders with Integrity') }}</h2>
                        <p class="mb--40" style="font-size: 18px; color: #666;">
                            {{ __('We are dedicated to providing a safe, inclusive, and challenging environment where every student can discover their passions and reach their full potential.') }}
                        </p>
                        <div class="motto-features">
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="fa-solid fa-check-circle" style="color: #28a745;"></i>
                                <span style="font-weight: 500;">{{ __('Holistic Development') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <i class="fa-solid fa-check-circle" style="color: #28a745;"></i>
                                <span style="font-weight: 500;">{{ __('Critical Thinking') }}</span>
                            </div>
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-check-circle" style="color: #28a745;"></i>
                                <span style="font-weight: 500;">{{ __('Global Citizenship') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .core-value-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(43, 58, 142, 0.1) !important;
            border-bottom: 4px solid #2b3a8e !important;
        }
        .core-value-card:hover .icon-wrapper {
            background: #2b3a8e !important;
            color: #fff !important;
        }
    </style>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
