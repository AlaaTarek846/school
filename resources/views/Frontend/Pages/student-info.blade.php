
@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')

    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' =>  __('Login Page'),
        'page' => __('Login Page')
    ])
    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="rts-ap-section bg-white p-5 rounded-4 shadow-sm border">
                        <div class="text-center mb-5">
                            <h3 class="rts-section-title mb-2">{{ __('translation.student_portal') }}</h3>
                            <p class="text-muted">{{ __('translation.sign_in') }}</p>
                        </div>

                        @if(session('success'))
                            <div class="alert alert-success border-0 rounded-3 mb-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4">
                                <ul class="mb-0 list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="alert alert-info border-0 rounded-3 mb-4 d-flex align-items-center" style="background-color: #e8f4fd; color: #2b78c5;">
                            <i class="fas fa-info-circle me-3 fs-4"></i>
                            <span class="small">{{ __('translation.student_login_note') }}</span>
                        </div>

                        <div class="rts-application-form">
                            <form action="{{ route('student.login.post') }}" method="POST">
                                @csrf
                                <div class="single-form-part">
                                    <div class="single-input mb-4">
                                        <div class="single-input-item">
                                            <label for="identifier" class="form-label fw-bold">{{ __('translation.username_or_code') }}</label>
                                            <input type="text" id="identifier" name="identifier" class="form-control py-3 rounded-3" placeholder="{{ __('translation.username_or_code') }}" required value="{{ old('identifier') }}">
                                        </div>
                                    </div>
                                    <div class="single-input mb-4">
                                        <div class="single-input-item">
                                            <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                                            <input type="password" id="password" name="password" class="form-control py-3 rounded-3" placeholder="{{ __('Password') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <div class="form-check">
                                        <input class="form-check-input mt-1" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label text-muted" for="remember">
                                            {{ __('Keep me logged in') }}
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="rts-theme-btn primary with-arrow w-100 py-3 rounded-3 justify-content-center">
                                    {{ __('Login') }}
                                    <span class="ms-2">
                                        @if(app()->getLocale() == 'ar')
                                            <i class="fa-thin fa-arrow-left"></i>
                                        @else
                                            <i class="fa-thin fa-arrow-right"></i>
                                        @endif
                                    </span>
                                </button>
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
