
@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')

    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Apply to school'),
        'page' => __('Apply Admission')
    ])
    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">

            <div class="row justify-content-center sticky-coloum-wrap g-5 mt--45">
                <div class="col-lg-8">
                    <div class="rts-ap-section">
                        <h3 class="rts-section-title mb--30">{{ __('Application Details') }}</h3>
                        <div class="rts-application-form">
                            <form id="career-form" action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="single-form-part">
                                    <h5 class="form-title">{{ __('Personal Information') }}</h5>
                                    <div class="single-input">
                                        <div class="single-input-item">
                                            <label for="fname">{{ __('First Name') }}</label>
                                            <input type="text" name="name" id="fname" placeholder="{{ __('First name') }}" required>
                                        </div>
                                        <div class="single-input-item">
                                            <label for="email2">{{ __('Enter your mail') }}</label>
                                            <input type="email" name="email" id="email2" placeholder="{{ __('Enter your mail') }}" required>
                                        </div>
                                    </div>
                                    <div class="single-input">
                                        <div class="single-input-item">
                                            <label for="dob">{{ __('Date of Birth') }}</label>
                                            <input type="date" name="dob" id="dob" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="single-input-item">
                                            <label for="phone">{{ __('Enter Phone Number') }}</label>
                                            <input type="tel" name="phone" id="phone" placeholder="{{ __('Enter Phone Number') }}" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="single-form-part">

                                    <div class="single-input-item">
                                        <label for="sub">{{ __('Application Submission:') }}</label>
                                        <input type="file" name="cv" id="sub" accept=".pdf,.doc,.docx" required>
                                    </div>

                                    <div class="d-flex align-items-center single-checkbox mt--20">
                                        <input type="checkbox" id="exampleCheck1" required>
                                        <label for="exampleCheck1">{{ __('By submitting this form, you agree to the Unipix University Privacy Notice') }}</label>
                                    </div>
                                </div>
                                <button type="submit" class="rts-theme-btn primary with-arrow">
                                    {{ __('Submit Application') }}
                                    <span>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#career-form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let formData = new FormData(this);
            let submitBtn = form.find('button[type="submit"]');

            submitBtn.prop('disabled', true).html('{{ __("Processing...") }}');

            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __("Success") }}',
                        text: response.message,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    form[0].reset();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMsg = '';
                    if (errors) {
                        errorMsg = errors.join('<br>');
                    } else {
                        errorMsg = '{{ __("Something went wrong!") }}';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: '{{ __("Error") }}',
                        html: errorMsg
                    });
                },
                complete: function() {
                    submitBtn.prop('disabled', false).html('{{ __("Submit Application") }} <span><i class="fa-thin fa-arrow-right"></i></span>');
                }
            });
        });
    });
</script>
@endpush
