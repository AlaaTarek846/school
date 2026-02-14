
@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')

    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Kobry El Galaa School'),
        'page' => __('Login Page')
    ])
    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row justify-content-center sticky-coloum-wrap g-5 mt--45">
                <div class="col-lg-8">
                    <div class="rts-ap-section">
                        <h3 class="rts-section-title mb--30">{{ __('Login Account') }}</h3>
                        <div class="rts-application-form">
                            <form action="#">
                                <div class="single-form-part">
                                    <h5 class="form-title">{{ __('Account') }}</h5>
                                    <div class="single-input">
                                        <div class="single-input-item">
                                            <label for="fname">{{ __('Username') }}</label>
                                            <input type="text" id="fname" placeholder="{{ __('Username') }}">
                                        </div>
                                        <div class="single-input-item">
                                            <label for="lname">{{ __('Password') }}</label>
                                            <input type="text" id="lname" placeholder="{{ __('Password') }}">
                                        </div>
                                    </div>

                                </div>
                                <div class="single-form-part">
                                    <div class="d-flex align-items-center single-checkbox mt--20">
                                        <input type="checkbox" id="exampleCheck1">
                                        <label for="exampleCheck1">{{ __('Keep me logged in') }}</label>
                                    </div>
                                </div>
                                <button type="submit" class="rts-theme-btn primary with-arrow">{{ __('Login') }}<span><i class="fa-thin fa-arrow-right"></i></span></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- admission page content end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
