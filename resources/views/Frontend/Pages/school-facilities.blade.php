@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.webp',
        'title' => __('School Facilities'),
        'page' => __('School Facilities')
    ])

    <div class="fac">

        <!-- ======================= Intro ======================= -->
        <section class="fac-intro">
            <div class="container">
                <div class="fac-head text-center">
                    <span class="fac-eyebrow">
                        <i class="fa-light fa-school"></i>
                        {{ __('fac_intro_eyebrow') }}
                    </span>
                    <h2 class="fac-title">{{ __('fac_intro_title') }}</h2>
                    <span class="fac-title-line"></span>
                    <p class="fac-lead">{{ __('fac_intro_sub') }}</p>
                </div>
            </div>
        </section>

        <!-- ======================= Showcase ======================= -->
        <section class="fac-showcase">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 col-md-10 mx-auto mx-lg-0">
                        <div class="fac-media">
                            <img class="fac-media-main" src="{{ asset('assets/images/تجربه ٢٢.png') }}" alt="Galaa school facilities">
                            <span class="fac-badge-floating">
                                <i class="fa-solid fa-building-columns"></i>
                                <b>{{ __('fac_badge_overlay') }}</b>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="fac-media-content ps-lg-4">
                            <span class="fac-eyebrow fac-eyebrow--dark mb-3">
                                <i class="fa-light fa-sparkles"></i>
                                {{ __('fac_featured_eyebrow') }}
                            </span>
                            <h3 class="fac-media-title">{{ __('fac_featured_title') }}</h3>
                            <p class="fac-media-text">{{ __('fac_featured_text') }}</p>
                            <ul class="fac-feature-list">
                                <li><i class="fa-solid fa-circle-check"></i><span>{{ __('fac_highlight_1') }}</span></li>
                                <li><i class="fa-solid fa-circle-check"></i><span>{{ __('fac_highlight_2') }}</span></li>
                                <li><i class="fa-solid fa-circle-check"></i><span>{{ __('fac_highlight_3') }}</span></li>
                                <li><i class="fa-solid fa-circle-check"></i><span>{{ __('fac_highlight_4') }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======================= Facilities grid ======================= -->
        <section class="fac-cards">
            <div class="container">
                <div class="row g-4">
                    @php
                        $facilities = [
                            1 => ['icon' => 'fa-futbol'],
                            2 => ['icon' => 'fa-computer'],
                            3 => ['icon' => 'fa-music'],
                            4 => ['icon' => 'fa-book-open'],
                            5 => ['icon' => 'fa-flask'],
                            6 => ['icon' => 'fa-dumbbell'],
                            7 => ['icon' => 'fa-chalkboard'],
                        ];
                    @endphp

                    @foreach($facilities as $i => $f)
                        @if($i === 1)
                            <!-- Featured card -->
                            <div class="col-lg-6">
                                <div class="fac-card fac-card--featured">
                                    <span class="fac-card-num">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span>
                                    <img src="{{ asset('assets/images/home.png') }}" alt="{{ __('facility_1_title') }}">
                                    <div class="fac-card-body">
                                        <div class="fac-card-icon"><i class="fa-light {{ $f['icon'] }}"></i></div>
                                        <h4 class="fac-card-title">{{ __('facility_1_title') }}</h4>
                                        <p class="fac-card-text">{{ __('facility_1_desc') }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="col-lg-4 col-md-6">
                                <div class="fac-card">
                                    <span class="fac-card-num">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</span>
                                    <div class="fac-card-icon"><i class="fa-light {{ $f['icon'] }}"></i></div>
                                    <h4 class="fac-card-title">{{ __('facility_' . $i . '_title') }}</h4>
                                    <p class="fac-card-text">{{ __('facility_' . $i . '_desc') }}</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        <!-- ======================= Gallery strip ======================= -->
        <section class="fac-gallery">
            <div class="container">
                <div class="fac-head text-center mb-5">
                    <span class="fac-eyebrow">
                        <i class="fa-light fa-camera-viewfinder"></i>
                        {{ __('fac_gallery_eyebrow') }}
                    </span>
                    <h2 class="fac-title">{{ __('fac_gallery_title') }}</h2>
                    <p class="fac-lead fac-lead--sm">{{ __('fac_gallery_sub') }}</p>
                </div>
                <div class="row g-4">
                    <div class="col-md-7">
                        <div class="fac-tile">
                            <img src="{{ asset('assets/images/تجربه المدرسه.png') }}" alt="Galaa school experience">
                            <span class="fac-tile-caption"><i class="fa-light fa-children"></i> {{ __('School Facilities') }}</span>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="fac-tile fac-tile--small">
                            <img src="{{ asset('assets/images/تجربه ٢٢.png') }}" alt="Galaa campus">
                            <span class="fac-tile-caption"><i class="fa-light fa-school"></i> {{ __('fac_badge_overlay') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======================= CTA ======================= -->
        <section class="fac-cta-wrap">
            <div class="container">
                <div class="fac-cta">
                    <span class="fac-cta-dots"></span>
                    <span class="fac-cta-circle"></span>
                    <div class="fac-cta-icon"><i class="fa-light fa-map-location-dot"></i></div>
                    <h3 class="fac-cta-title">{{ __('fac_cta_title') }}</h3>
                    <p class="fac-cta-text">{{ __('fac_cta_sub') }}</p>
                    <div class="fac-cta-actions">
                        <a href="{{ route('contact') }}" class="fac-btn fac-btn--light">{{ __('fac_cta_btn') }} <i class="fa-solid fa-arrow-up-right-from-square"></i></a>
                        <a href="{{ route('contact') }}" class="fac-btn fac-btn--ghost">{{ __('fac_cta_secondary') }}</a>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <style>
        .fac {
            --fac-pink: var(--rt-primary, #c71d63);
            --fac-navy: #110c2d;
            --fac-ink: #262626;
            --fac-muted: #6e6e73;
            --fac-soft: #faf6f9;
        }

        /* ---------- Intro ---------- */
        .fac-intro {
            background: #fff;
            padding: 100px 0 30px;
        }
        .fac-head .fac-eyebrow { margin-bottom: 20px; }
        .fac-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            background: rgba(199, 29, 99, 0.07);
            color: var(--fac-pink);
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            padding: 10px 22px;
            border-radius: 40px;
            border: 1px solid rgba(199, 29, 99, 0.18);
        }
        [dir="rtl"] .fac-eyebrow { letter-spacing: 0; text-transform: none; }
        .fac-eyebrow i { font-size: 16px; }
        .fac-eyebrow--dark {
            background: rgba(255,255,255,0.7);
            color: var(--fac-navy);
            border-color: rgba(17, 12, 45, 0.15);
            margin-bottom: 20px;
        }
        .fac-title {
            color: var(--fac-navy);
            font-size: clamp(28px, 4vw, 46px);
            font-weight: 800;
            line-height: 1.25;
            margin: 0 0 14px;
        }
        .fac-title-line {
            display: block;
            width: 70px;
            height: 5px;
            margin: 0 auto 22px;
            border-radius: 5px;
            background: linear-gradient(90deg, var(--fac-pink), #e78ab2);
        }
        .fac-lead {
            color: var(--fac-muted);
            font-size: 17px;
            line-height: 1.9;
            max-width: 720px;
            margin: 0 auto;
        }
        .fac-lead--sm { max-width: 640px; }

        /* ---------- Showcase ---------- */
        .fac-showcase {
            padding: 70px 0 90px;
            background: linear-gradient(180deg, #ffffff 0%, var(--fac-soft) 100%);
            position: relative;
        }
        .fac-media {
            position: relative;
            padding-bottom: 40px;
            max-width: 520px;
        }
        .fac-media-main {
            width: 100%;
            max-height: 460px;
            object-fit: cover;
            border-radius: 26px;
            box-shadow: 0 30px 60px -18px rgba(17, 12, 45, 0.28);
            border: 8px solid #fff;
        }
        .fac-media::after {
            content: "";
            position: absolute;
            inset-inline-end: -20px;
            inset-block-start: -20px;
            width: 150px;
            height: 150px;
            z-index: -1;
            border-radius: 50%;
            background: radial-gradient(closest-side, rgba(199, 29, 99, 0.18), transparent);
        }
        .fac-badge-floating {
            position: absolute;
            inset-block-end: 0;
            inset-inline-start: 0;
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: var(--fac-navy);
            color: #fff;
            padding: 16px 24px;
            border-radius: 16px;
            box-shadow: 0 18px 40px -12px rgba(17, 12, 45, 0.55);
            font-size: 15px;
        }
        .fac-badge-floating i {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--fac-pink), #e0427f);
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 19px;
        }
        .fac-badge-floating b { font-weight: 700; white-space: nowrap; }

        .fac-media-content {
            max-width: 540px;
        }
        .fac-media-title {
            color: var(--fac-navy);
            font-size: clamp(24px, 3vw, 34px);
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 18px;
        }
        .fac-media-text {
            color: var(--fac-muted);
            font-size: 16px;
            line-height: 1.9;
            margin-bottom: 28px;
        }
        .fac-feature-list {
            list-style: none;
            margin: 0;
            padding: 0;
            display: grid;
            gap: 15px;
        }
        .fac-feature-list li {
            display: flex;
            align-items: flex-start;
            gap: 13px;
            font-size: 16px;
            font-weight: 500;
            color: var(--fac-ink);
        }
        .fac-feature-list i {
            color: var(--fac-pink);
            font-size: 20px;
            margin-top: 2px;
        }
        .fac-feature-list i::before { font-weight: 900; }

        /* ---------- Cards ---------- */
        .fac-cards {
            padding: 70px 0 90px;
            background: #fff;
        }
        .fac-card {
            position: relative;
            overflow: hidden;
            background: #fff;
            border: 1px solid #f1e8ee;
            border-radius: 22px;
            padding: 34px 30px 38px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(17, 12, 45, 0.04);
            transition: all 0.35s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .fac-card::before {
            content: "";
            position: absolute;
            top: 0;
            inset-inline-start: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--fac-pink), #e78ab2);
            transform: scaleX(0);
            transform-origin: center;
            transition: transform 0.35s ease;
        }
        .fac-card:hover {
            transform: translateY(-9px);
            box-shadow: 0 24px 50px -12px rgba(199, 29, 99, 0.18);
            border-color: rgba(199, 29, 99, 0.25);
        }
        .fac-card:hover::before { transform: scaleX(1); }
        .fac-card-num {
            position: absolute;
            top: 16px;
            inset-inline-end: 22px;
            font-size: 52px;
            font-weight: 900;
            line-height: 1;
            color: rgba(199, 29, 99, 0.08);
            transition: all 0.3s ease;
        }
        .fac-card:hover .fac-card-num { color: rgba(199, 29, 99, 0.16); transform: scale(1.08); }
        .fac-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--fac-pink), #e0427f);
            color: #fff;
            font-size: 26px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 22px;
            box-shadow: 0 12px 26px -8px rgba(199, 29, 99, 0.5);
            transition: all 0.35s ease;
        }
        .fac-card:hover .fac-card-icon { transform: scale(1.1) rotate(-6deg); }
        .fac-card-title {
            color: var(--fac-navy);
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .fac-card-text {
            color: var(--fac-muted);
            font-size: 15px;
            line-height: 1.85;
            margin: 0;
        }

        /* featured card */
        .fac-card--featured {
            background: linear-gradient(135deg, var(--fac-navy) 0%, #2c2160 60%, #3d2a74 100%);
            border: none;
            display: flex;
            align-items: center;
            gap: 26px;
            color: #fff;
        }
        .fac-card--featured::before { background: linear-gradient(90deg, var(--fac-pink), #ff9ec4); }
        .fac-card--featured .fac-card-num { color: rgba(255,255,255,0.1); }
        .fac-card--featured:hover .fac-card-num { color: rgba(255,255,255,0.2); }
        .fac-card--featured img {
            width: 180px;
            height: 200px;
            flex-shrink: 0;
            object-fit: cover;
            border-radius: 16px;
            border: 5px solid rgba(255,255,255,0.15);
            box-shadow: 0 16px 34px -10px rgba(0,0,0,0.5);
        }
        .fac-card--featured .fac-card-icon {
            background: rgba(255,255,255,0.12);
            box-shadow: none;
            color: #fff;
            border: 1px solid rgba(255,255,255,0.2);
        }
        .fac-card--featured .fac-card-title { color: #fff; }
        .fac-card--featured .fac-card-text { color: rgba(255,255,255,0.78); }

        /* ---------- Gallery ---------- */
        .fac-gallery {
            padding: 90px 0;
            background: var(--fac-soft);
        }
        .fac-tile {
            position: relative;
            border-radius: 22px;
            overflow: hidden;
            height: 330px;
            box-shadow: 0 18px 40px -16px rgba(17, 12, 45, 0.25);
        }
        .fac-tile--small { height: 330px; }
        .fac-tile img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .fac-tile:hover img { transform: scale(1.06); }
        .fac-tile::after {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(17,12,45,0.55), transparent 60%);
        }
        .fac-tile-caption {
            position: absolute;
            inset-inline-start: 18px;
            inset-block-end: 18px;
            z-index: 2;
            background: #fff;
            color: var(--fac-navy);
            font-weight: 700;
            font-size: 14px;
            padding: 10px 18px;
            border-radius: 40px;
            box-shadow: 0 10px 24px -8px rgba(17, 12, 45, 0.4);
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .fac-tile-caption i { color: var(--fac-pink); }

        /* ---------- CTA ---------- */
        .fac-cta-wrap {
            padding: 40px 0 110px;
            background: var(--fac-soft);
        }
        .fac-cta {
            position: relative;
            overflow: hidden;
            text-align: center;
            background: linear-gradient(120deg, var(--fac-navy) 0%, #2c2160 55%, #6d1b48 100%);
            color: #fff;
            border-radius: 30px;
            padding: 70px 30px;
            box-shadow: 0 30px 70px -20px rgba(17, 12, 45, 0.55);
        }
        .fac-cta-circle {
            position: absolute;
            inset-block-start: -90px;
            inset-inline-end: -60px;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: radial-gradient(closest-side, rgba(255,255,255,0.12), transparent);
        }
        .fac-cta-dots {
            position: absolute;
            inset-inline-start: 40px;
            inset-block-end: 30px;
            width: 110px;
            height: 70px;
            background-image: radial-gradient(rgba(255,255,255,0.35) 2px, transparent 2.6px);
            background-size: 20px 20px;
        }
        .fac-cta-icon {
            width: 74px;
            height: 74px;
            margin: 0 auto 22px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--fac-pink), #e0427f);
            color: #fff;
            font-size: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 34px -10px rgba(0,0,0,0.45);
            position: relative;
            z-index: 1;
        }
        .fac-cta-title {
            font-size: clamp(24px, 3vw, 36px);
            font-weight: 800;
             color: #fff;
            margin-bottom: 14px;
            position: relative;
            z-index: 1;
        }
        .fac-cta-text {
            color: rgba(255,255,255,0.82);
            font-size: 16px;
            line-height: 1.8;
            max-width: 540px;
            margin: 0 auto 32px;
            position: relative;
            z-index: 1;
        }
        .fac-cta-actions {
            display: flex;
            justify-content: center;
            gap: 16px;
            flex-wrap: wrap;
            position: relative;
            z-index: 1;
        }
        .fac-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 30px;
            border-radius: 40px;
            font-weight: 700;
            font-size: 15px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .fac-btn--light {
            background: #fff;
            color: var(--fac-navy);
            box-shadow: 0 14px 30px -10px rgba(0,0,0,0.4);
        }
        .fac-btn--light i { color: var(--fac-pink); }
        .fac-btn--light:hover {
            background: var(--fac-pink);
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 18px 36px -12px rgba(199, 29, 99, 0.6);
        }
        .fac-btn--light:hover i { color: #fff; }
        .fac-btn--ghost {
            background: transparent;
            color: #fff;
            border: 1.5px solid rgba(255,255,255,0.35);
        }
        .fac-btn--ghost:hover {
            background: rgba(255,255,255,0.12);
            border-color: #fff;
            transform: translateY(-3px);
        }

        /* ---------- RTL friendly tweaks ---------- */
        [dir="rtl"] .fac-feature-list li { text-align: right; }
        [dir="rtl"] .fac-card-num {
            right: auto;
            left: 22px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 991px) {
            .fac-intro { padding: 70px 0 20px; }
            .fac-showcase { padding: 50px 0 60px; }
            .fac-cards { padding: 60px 0 70px; }
            .fac-media-content { max-width: 100%; }
            .fac-card--featured { flex-direction: column; text-align: center; }
            .fac-card--featured img { width: 100%; height: 240px; }
            .fac-card--featured .fac-card-icon { margin-inline: auto; }
            .fac-gallery, .fac-cta-wrap { padding: 60px 0; }
        }
        @media (max-width: 576px) {
            .fac-tile, .fac-tile--small { height: 260px; }
            .fac-cta { padding: 50px 22px; }
            .fac-media-main { border-width: 5px; }
            .fac-badge-floating { padding: 12px 18px; font-size: 13px; }
        }
    </style>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
