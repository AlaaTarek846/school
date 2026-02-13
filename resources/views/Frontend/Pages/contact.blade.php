@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Contact Us'),
        'page' =>  __('Contact')
    ])
    <!-- rts contact info -->
    <section class="rts-contact-info rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="rts-section rt-center mb--40">
                    <h2 class="rts__section--title text-capitalize">{{ __('General Contact Information') }}</h2>
                </div>
            </div>
            <div class="contact-information">
                <div class="row justify-content-md-start  justify-content-sm-center g-5">
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="single-contact">
                            <div class="single-contact__single">
                                <div class="icon">
                                    <i class="fa-thin fa-map-location-dot"></i>
                                </div>
                                <p class="--p-m">
                                    {!! $shareSetting->address ?? '' !!}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="single-contact">
                            <div class="single-contact__single">
                                <div class="icon">
                                    <i class="fa-thin fa-phone"></i>
                                </div>
                                <div class="method">
                                    @if($shareSetting->mobile)
                                        <a href="tel:{{ $shareSetting->mobile }}" class="phone">{{ $shareSetting->mobile }}</a>
                                    @endif
                                    @if($shareSetting->email)
                                        <a href="mailto:{{ $shareSetting->email }}" class="phone">{{ $shareSetting->email }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-10">
                        <div class="single-contact">
                            <div class="single-contact__single">
                                <div class="icon">
                                    <i class="fa-thin fa-clock"></i>
                                </div>
                                <p class="--p-l rt-regular">
                                    {{ __('Mon-Fri') }}: 9 AM – 6 PM <br>
                                    {{ __('Saturday') }}: 9 AM – 4 PM
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- rts contact info end -->


    <!-- contact form section -->
    <div class="rts-campus-contact pb--120">
        <div class="container">
            <div class="row">
                <div class="rts-seciton rt-center mb--40">
                    <h2 class="rts__section--title text-capitalize">{{ __('Send Us a Message') }}</h2>
                </div>
            </div>
            <div class="contact-form-area">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <form id="contact-form" action="{{ route('contact-message.store') }}" method="POST" class="contact-form">
                            @csrf
                            <div class="row g-5">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="{{ __('Your Name') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="{{ __('Email Address') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="{{ __('Phone Number') }}" required>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" placeholder="{{ __('Message') }}" required></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button type="submit" class="rts-btn btn-primary">{{ __('Send Message') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if($shareSetting->map)
            <div class="contact-map mt--60">
                {!! $shareSetting->map !!}
            </div>
            @endif
        </div>
    </div>
    <!-- contact form section end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#contact-form').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');
            let data = form.serialize();
            let submitBtn = form.find('button[type="submit"]');

            submitBtn.prop('disabled', true).text('...');

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '{{ __("Your message has been sent successfully!") }}',
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
                    submitBtn.prop('disabled', false).text('{{ __("Send Message") }}');
                }
            });
        });
    });
</script>
@endpush
