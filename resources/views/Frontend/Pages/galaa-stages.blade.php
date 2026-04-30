@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Galaa Education Stages'),
        'page' => __('Stages')
    ])

    <!-- Galaa Stages Content -->
    <section class="rts-stages-area rts-section-padding">
        <div class="container">
            <div class="row justify-content-center mb--60">
                <div class="col-lg-8 text-center">
                    <div class="section-title-wrapper">
                        <h2 class="rts-section-title">{{ __('Excellence in Every Stage') }}</h2>
                        <p class="description">{{ __('Discover our comprehensive educational journey from Kindergarten to Secondary level, designed to nurture talent and inspire future leaders.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-5 justify-content-center">
                @php
                    $icons = [
                        'Kindergarten' => 'fa-baby-carriage',
                        'Primary' => 'fa-book-open-reader',
                        'Preparatory' => 'fa-microscope',
                        'Secondary' => 'fa-user-graduate',
                        'KG' => 'fa-baby-carriage',
                        'حضاني' => 'fa-baby-carriage',
                        'ابتدائي' => 'fa-book-open-reader',
                        'اعدادي' => 'fa-microscope',
                        'ثانوي' => 'fa-user-graduate',
                    ];
                    $colors = ['#2b3a8e', '#e83e8c', '#28a745', '#ffc107'];
                @endphp

                @foreach($stages as $index => $stage)
                <div class="col-lg-3 col-md-6">
                    <div class="stage-card" style="--card-color: {{ $colors[$index % 4] }}">
                        <div class="stage-icon">
                            @php
                                $stageName = $stage->title_en;
                                $icon = 'fa-school'; // Default
                                foreach($icons as $key => $val) {
                                    if(stripos($stageName, $key) !== false || stripos($stage->title_ar, $key) !== false) {
                                        $icon = $val;
                                        break;
                                    }
                                }
                            @endphp
                            <i class="fa-light {{ $icon }}"></i>
                        </div>
                        <div class="stage-content">
                            <h4 class="title">{{ app()->getLocale() == 'ar' ? $stage->title_ar : $stage->title_en }}</h4>
                            <div class="stage-footer">
{{--                                <span class="explore-btn">{{ __('Explore More') }} <i class="fa-regular fa-arrow-right"></i></span>--}}
                            </div>
                        </div>
                        <div class="card-bg-shape"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .stage-card {
            background: #fff;
            padding: 40px 30px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #eee;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            cursor: pointer;
        }

        .stage-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            border-color: var(--card-color);
        }

        .stage-icon {
            width: 80px;
            height: 80px;
            background: #f8f9fa;
            color: var(--card-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin: 0 auto 25px;
            transition: all 0.4s ease;
            position: relative;
            z-index: 2;
        }

        .stage-card:hover .stage-icon {
            background: var(--card-color);
            color: #fff;
        }

        .stage-content {
            position: relative;
            z-index: 2;
        }

        .stage-card .title {
            font-size: 24px;
            margin-bottom: 15px;
            color: #1c1c1c;
            font-weight: 700;
        }

        .stage-footer .explore-btn {
            font-size: 14px;
            font-weight: 600;
            color: var(--card-color);
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .card-bg-shape {
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--card-color);
            opacity: 0.03;
            border-radius: 50%;
            transition: all 0.4s ease;
        }

        .stage-card:hover .card-bg-shape {
            opacity: 0.1;
            transform: scale(1.5);
        }

        [lang="ar"] .stage-card {
            text-align: center;
        }

        [lang="ar"] .stage-footer .explore-btn i {
            transform: rotate(180deg);
        }
    </style>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
