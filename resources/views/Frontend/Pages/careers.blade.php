
@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')

    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Apply to Unipix University',
        'page' => 'Apply Admission'
    ])
    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">

            <div class="row justify-content-center sticky-coloum-wrap g-5 mt--45">
                <div class="col-lg-8">
                    <div class="rts-ap-section">
                        <h3 class="rts-section-title mb--30">Application Details</h3>
                        <div class="rts-application-form">
                            <form action="#">
                                <div class="single-form-part">
                                    <h5 class="form-title">Personal Information</h5>
                                    <div class="single-input">
                                        <div class="single-input-item">
                                            <label for="fname">First Name</label>
                                            <input type="text" id="fname" placeholder="First name">
                                        </div>
                                        <div class="single-input-item">
                                            <label for="email2">Enter your mail</label>
                                            <input type="email" id="email2" placeholder="Enter your mail">
                                        </div>
                                    </div>
                                    <div class="single-input">
                                        <div class="single-input-item">
                                            <label for="dob">Date of Birth</label>
                                            <input type="text" id="datepicker" placeholder="dd/mm/yy">
                                        </div>
                                        <div class="single-input-item">
                                            <label for="phone">Enter Phone Number</label>
                                            <input type="tel" id="phone" placeholder="Enter Phone Number">
                                        </div>
                                    </div>

                                </div>

                                <div class="single-form-part">

                                    <div class="single-input-item">
                                        <label for="sub">Application Submission:</label>
                                        <input type="file" id="sub">
                                    </div>

                                    <div class="d-flex align-items-center single-checkbox mt--20">
                                        <input type="checkbox" id="exampleCheck1">
                                        <label for="exampleCheck1">By submitting this form, you agree to the Unipix University Privacy Notice</label>
                                    </div>
                                </div>
                                <button type="submit" class="rts-theme-btn primary with-arrow">Submit Application<span><i class="fa-thin fa-arrow-right"></i></span></button>
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
