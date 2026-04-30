@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('What Parents Say'),
        'page' => __('Reviews')
    ])

    <!-- Reviews Content -->
    <section class="rts-testimonials-area rts-section-padding">
        <div class="container">
            <div class="row justify-content-center mb--60">
                <div class="col-lg-8 text-center">
                    <div class="section-title-wrapper">
                        <h2 class="rts-section-title">{{ __('Voices of Our Community') }}</h2>
                        <p class="description">{{ __('We take pride in the success and satisfaction of our students and their families. Read what they have to say about their experience with us.') }}</p>
                    </div>
                </div>
            </div>

            <div class="row g-5">
                @foreach($testimonials as $testimonial)
                <div class="col-lg-4 col-md-6">
                    <div class="review-card">
                        <div class="review-header">
                            <div class="user-info">
                                <div class="user-img">
                                    @if($testimonial->media)
                                        <img src="{{ asset($testimonial->media->url) }}" alt="{{ $testimonial->name }}">
                                    @else
                                        <div class="placeholder-img">{{ substr($testimonial->name, 0, 1) }}</div>
                                    @endif
                                </div>
                                <div class="user-details">
                                    <h5 class="name">{{ $testimonial->name }}</h5>
                                    <span class="job">{{ $testimonial->job }}</span>
                                </div>
                            </div>
                            <div class="quote-icon">
                                <i class="fa-solid fa-quote-right"></i>
                            </div>
                        </div>
                        <div class="review-body">
                            <div class="rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $testimonial->rating ? 'fa-solid' : 'fa-regular' }} fa-star"></i>
                                @endfor
                            </div>
                            <p class="text">{{ $testimonial->description }}</p>
                        </div>
                        <div class="card-footer-shape"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .review-card {
            background: #fff;
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid #f0f0f0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .review-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.1);
            border-color: #2b3a8e;
        }

        .review-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-img {
            width: 65px;
            height: 65px;
            flex-shrink: 0;
        }

        .user-img img {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #f8f9fa;
        }

        .placeholder-img {
            width: 100%;
            height: 100%;
            background: #2b3a8e;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
        }

        .user-details .name {
            font-size: 18px;
            margin-bottom: 4px;
            font-weight: 700;
            color: #1c1c1c;
        }

        .user-details .job {
            font-size: 13px;
            color: #666;
            display: block;
        }

        .quote-icon {
            font-size: 24px;
            color: #2b3a8e;
            opacity: 0.15;
        }

        .rating {
            margin-bottom: 15px;
            color: #ffc107;
            font-size: 14px;
        }

        .review-body .text {
            font-size: 16px;
            line-height: 1.7;
            color: #444;
            font-style: italic;
        }

        .card-footer-shape {
            position: absolute;
            bottom: -20px;
            right: -20px;
            width: 80px;
            height: 80px;
            background: #2b3a8e;
            opacity: 0.03;
            border-radius: 50%;
            transition: all 0.4s ease;
        }

        .review-card:hover .card-footer-shape {
            transform: scale(2);
            opacity: 0.05;
        }

        [lang="ar"] .quote-icon {
            transform: rotateY(180deg);
        }
    </style>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
