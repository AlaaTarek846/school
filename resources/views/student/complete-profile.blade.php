@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')

    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' =>  __('translation.Profile Setup'),
        'page' => __('translation.Profile Setup')
    ])

    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="rts-ap-section bg-white p-5 rounded-4 shadow-sm border">
                        <div class="text-center mb-5">
                            <h3 class="rts-section-title mb-2">{{ __('translation.Complete Your Profile') }}</h3>
                            <p class="text-muted">{{ __('translation.Please complete your profile to access the dashboard') }}</p>
                        </div>

                        @if($errors->any())
                            <div class="alert alert-danger border-0 rounded-3 mb-4">
                                <ul class="mb-0 list-unstyled">
                                    @foreach($errors->all() as $error)
                                        <li><i class="fas fa-exclamation-circle me-2"></i>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="rts-application-form">
                            <form action="{{ route('student.complete_profile.post') }}" method="POST">
                                @csrf
                                
                                <div class="row g-4">
                                    <h5 class="form-title mb-0 border-bottom pb-2 mt-4 text-primary">{{ __('translation.Account Info') }}</h5>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="username" class="form-label fw-bold">{{ __('Username') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="username" name="username" class="form-control py-3 rounded-3" placeholder="{{ __('Username') }}" required value="{{ old('username', $student->username) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                                            <input type="email" id="email" name="email" class="form-control py-3 rounded-3" placeholder="{{ __('Email') }}" value="{{ old('email', $student->email) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="password" class="form-label fw-bold">{{ __('New Password') }} <span class="text-danger">*</span></label>
                                            <input type="password" id="password" name="password" class="form-control py-3 rounded-3" placeholder="{{ __('New Password') }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="password_confirmation" class="form-label fw-bold">{{ __('translation.Confirmation Password') }} <span class="text-danger">*</span></label>
                                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control py-3 rounded-3" placeholder="{{ __('translation.Confirmation Password') }}" required>
                                        </div>
                                    </div>

                                    <h5 class="form-title mb-0 border-bottom pb-2 mt-5 text-primary">{{ __('translation.Contact Info') }}</h5>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="phone_1" class="form-label fw-bold">{{ __('translation.Phone 1') }} <span class="text-danger">*</span></label>
                                            <input type="text" id="phone_1" name="phone_1" class="form-control py-3 rounded-3" placeholder="{{ __('translation.Phone 1') }}" required value="{{ old('phone_1', $student->phone_1) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="phone_2" class="form-label fw-bold">{{ __('translation.Phone 2') }}</label>
                                            <input type="text" id="phone_2" name="phone_2" class="form-control py-3 rounded-3" placeholder="{{ __('translation.Phone 2') }}" value="{{ old('phone_2', $student->phone_2) }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="governorate" class="form-label fw-bold">{{ __('translation.Governorate') }}</label>
                                            <input type="text" id="governorate" name="governorate" class="form-control py-3 rounded-3" placeholder="{{ __('translation.Governorate') }}" value="{{ old('governorate', $student->governorate) }}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="single-input-item">
                                            <label for="city" class="form-label fw-bold">{{ __('translation.City') }}</label>
                                            <input type="text" id="city" name="city" class="form-control py-3 rounded-3" placeholder="{{ __('translation.City') }}" value="{{ old('city', $student->city) }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 pt-3">
                                    <button type="submit" class="rts-theme-btn primary with-arrow w-100 py-3 rounded-3 justify-content-center">
                                        {{ __('translation.Save and Continue') }}
                                        <span class="ms-2">
                                            @if(app()->getLocale() == 'ar')
                                                <i class="fa-thin fa-arrow-left"></i>
                                            @else
                                                <i class="fa-thin fa-arrow-right"></i>
                                            @endif
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
