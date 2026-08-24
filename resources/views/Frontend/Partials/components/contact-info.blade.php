@php
    $mobile = $shareSetting?->mobile;
    $email = $shareSetting?->email;
    $address = $shareSetting?->address;
    $socialLinks = array_filter([
        'facebook' => $shareSetting?->facebook,
        'instagram' => $shareSetting?->instagram,
        'linkedin' => $shareSetting?->linkedin,
        'twitter' => $shareSetting?->twitter,
    ], fn ($url) => filled($url) && $url !== '#');
@endphp

<div class="offcanvase__info--content {{ $class ?? '' }}">
    @if($mobile)
        <a href="tel:{{ preg_replace('/\s+/', '', $mobile) }}">
            <span><i class="fa-sharp fa-light fa-phone"></i></span>{{ $mobile }}
        </a>
    @endif

    @if($email)
        <a href="mailto:{{ $email }}">
            <span><i class="fa-sharp fa-light fa-envelope"></i></span>{{ $email }}
        </a>
    @endif

    @if($address)
        <a href="{{ route('contact') }}">
            <span><i class="fa-sharp fa-light fa-location-dot"></i></span>{!! $address !!}
        </a>
    @endif

    @if(count($socialLinks))
        <div class="offcanvase__info--content--social">
            <p class="title">{{ __('Follow Us:') }}</p>
            <div class="social__links">
                @if(!empty($socialLinks['facebook']))
                    <a href="{{ $socialLinks['facebook'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-facebook"></i>
                    </a>
                @endif
                @if(!empty($socialLinks['instagram']))
                    <a href="{{ $socialLinks['instagram'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                @endif
                @if(!empty($socialLinks['linkedin']))
                    <a href="{{ $socialLinks['linkedin'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-linkedin"></i>
                    </a>
                @endif
                @if(!empty($socialLinks['twitter']))
                    <a href="{{ $socialLinks['twitter'] }}" target="_blank" rel="noopener noreferrer">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>
