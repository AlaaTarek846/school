@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.webp',
        'title' => __('Mission and Vision'),
        'page' => __('Mission and Vision')
    ])

    <!-- الرؤية -->
    <section class="rts-school-vision rts-section-padding">
        <div class="container">
            <div class="school-vision-block">
                <div class="vision-icon">
                    <i class="fa-light fa-binoculars"></i>
                </div>
                <h2 class="vision-title">{{ __('Vision') }}</h2>
                <div class="vision-divider"></div>
                <p class="vision-text">{{ __('School Vision Text') }}</p>
            </div>
        </div>
    </section>

    <!-- الرسالة -->
    <section class="rts-school-message rts-section-padding">
        <div class="container">
            <div class="row justify-content-center text-center mb--50">
                <div class="col-lg-8">
                    <h2 class="rts-section-title message-main-title">{{ __('Message') }}</h2>
                    <p class="message-subtitle">{{ __('La Rose De Lisieux School Message') }}</p>
                    <div class="message-divider"></div>
                </div>
            </div>

            <div class="row g-4">
                @php
                    $messageItems = [
                        ['icon' => 'fa-bullseye-arrow', 'text' => 'Message Point 1'],
                        ['icon' => 'fa-book-open-reader', 'text' => 'Message Point 2'],
                        ['icon' => 'fa-handshake', 'text' => 'Message Point 3'],
                        ['icon' => 'fa-gears', 'text' => 'Message Point 4'],
                        ['icon' => 'fa-lightbulb-on', 'text' => 'Message Point 5'],
                    ];
                @endphp

                @foreach($messageItems as $item)
                    <div class="col-lg-6">
                        <div class="message-point-item">
                            <div class="message-point-icon">
                                <i class="fa-light {{ $item['icon'] }}"></i>
                            </div>
                            <p class="message-point-text">{{ __($item['text']) }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Educational Stages Missions -->
    @php
        $stageMissions = [
            ['key' => 'KG', 'count' => 4],
            ['key' => 'Primary', 'count' => 6],
            ['key' => 'Preparatory', 'count' => 5],
            ['key' => 'Secondary', 'count' => 5],
        ];
    @endphp

    <section class="rts-educational-stages rts-section-padding">
        <div class="container">
            <div class="row g-4">
                @foreach($stageMissions as $stage)
                    <div class="col-lg-6">
                        <div class="stage-content-card">
                            <div class="stage-title-wrap">
                                <h2 class="stage-title">
                                    <i class="fa-light fa-award me-3 text-primary"></i>
                                    {{ __($stage['key'] . ' Stage Mission Title') }}
                                </h2>
                            </div>
                            <div class="stage-mission-list">
                                @for($i = 1; $i <= $stage['count']; $i++)
                                    <div class="stage-mission-item">
                                        <i class="fa-solid fa-check"></i>
                                        <span>{{ __($stage['key'] . ' Stage Mission ' . $i) }}</span>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .rts-school-vision.rts-section-padding,
        .rts-school-message.rts-section-padding,
        .rts-educational-stages.rts-section-padding {
            padding: 60px 0;
        }

        .rts-school-vision {
            background: #fff;
            padding-bottom: 40px;
        }
        .rts-school-vision .school-vision-block {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
            font-family: var(--font-primary);
            padding-bottom: 40px;
            border-bottom: 1px solid #e5e5e5;
        }
        .rts-school-vision .vision-icon {
            color: #890c25;
            font-size: 42px;
            margin-bottom: 14px;
            line-height: 1;
        }
        .rts-school-vision .vision-title {
            margin: 0 0 14px;
            color: #2b3a8e;
            font-family: var(--font-primary);
            font-size: var(--h5);
            font-weight: var(--f-semi-bold);
            line-height: 1.3;
        }
        .rts-school-vision .vision-divider {
            width: 70px;
            height: 3px;
            background: #890c25;
            margin: 0 auto 22px;
            border-radius: 3px;
        }
        .rts-school-vision .vision-text {
            margin: 0;
            color: #555;
            font-family: var(--font-primary);
            font-size: var(--p-s);
            font-weight: var(--f-regular);
            line-height: var(--line-height-b3);
        }

        .rts-school-message {
            background: #f8f9fa;
            font-family: var(--font-primary);
            padding-top: 50px;
        }
        .rts-school-message .message-main-title {
            color: #2b3a8e;
            font-family: var(--font-primary);
            font-weight: var(--f-regular);
            margin-bottom: 12px;
            line-height: 1.2;
        }
        .rts-school-message .message-subtitle {
            color: #2b3a8e;
            font-family: var(--font-primary);
            font-size: var(--p-m);
            font-weight: var(--f-regular);
            margin-bottom: 24px;
            line-height: var(--line-height-b3);
        }
        .rts-school-message .message-divider {
            width: 80px;
            height: 3px;
            background: #890c25;
            margin: 0 auto;
            border-radius: 4px;
        }
        .rts-school-message .message-point-item {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 22px 24px;
            background: #fff;
            border-radius: 14px;
            height: 100%;
            box-shadow: 0 6px 18px rgba(43, 58, 142, 0.05);
            border: 1px solid rgba(43, 58, 142, 0.06);
            transition: var(--transition);
            font-family: var(--font-primary);
        }
        .rts-school-message .message-point-item:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(43, 58, 142, 0.09);
        }
        .rts-school-message .message-point-icon {
            min-width: 56px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #890c25;
            font-size: 28px;
            line-height: 1;
            background: rgba(137, 12, 37, 0.08);
            border-radius: 14px;
            flex-shrink: 0;
        }
        .rts-school-message .message-point-text {
            color: #890c25;
            font-family: var(--font-primary);
            font-size: var(--p-s);
            line-height: var(--line-height-b3);
            margin: 0;
            font-weight: var(--f-regular);
        }
        [dir="rtl"] .rts-school-message .message-point-item {
            text-align: right;
        }

        .rts-educational-stages .stage-content-card {
            background: #f8f9fa;
            border-radius: 16px;
            padding: 28px 26px 30px;
            height: 100%;
            border: 1px solid rgba(43, 58, 142, 0.06);
        }
        .rts-educational-stages .stage-title-wrap {
            margin-bottom: 22px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(43, 58, 142, 0.12);
            position: relative;
        }
        .rts-educational-stages .stage-title-wrap::after {
            content: "";
            position: absolute;
            bottom: -1px;
            inset-inline-start: 0;
            width: 70px;
            height: 3px;
            background: #890c25;
            border-radius: 3px;
        }
        .rts-educational-stages .stage-title {
            margin: 0;
            color: #2b3a8e;
            font-family: var(--font-primary);
            font-size: var(--h6);
            font-weight: var(--f-semi-bold);
            line-height: 1.45;
            text-align: start;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .rts-educational-stages .stage-title i {
            flex-shrink: 0;
            margin: 0 !important;
        }
        .rts-educational-stages .stage-mission-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }
        .rts-educational-stages .stage-mission-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            font-family: var(--font-primary);
            font-size: var(--p-s);
            font-weight: var(--f-regular);
            line-height: var(--line-height-b3);
            color: var(--rt-body);
            text-align: start;
        }
        .rts-educational-stages .stage-mission-item i {
            color: #890c25;
            margin-top: 4px;
            flex-shrink: 0;
        }
    </style>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
