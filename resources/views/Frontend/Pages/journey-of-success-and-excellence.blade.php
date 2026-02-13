@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'Tution Fees',
        'page' => 'Tuition and Fees'
    ])

    <!-- tution fee -->
    <div class="page-content-top pt--120 pt__md--80">
        <div class="container">
            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-6 col-md-11">
                    <div class="faculty-content-text me-5">
                        <h4 class="font-32 mb-4">Mission</h4>
                        <p>Create innovative knowledge through intellectual practice, critical engagement, and creative endeavor. It is dedicated to providing students with enriched curriculum that fosters deeper understanding and appreciation of societies, cultures, languages, literatures, and artistic trends to address the contemporary global and local challenges.</p>
                        <h4 class="font-32 mb-4 mt-5">Vision</h4>
                        <p>Create innovative knowledge through intellectual practice, critical engagement, and creative endeavor. It is dedicated to providing students with enriched curriculum that fosters deeper understanding and appreciation of societies, cultures, languages, literatures, and artistic trends to address the contemporary global and local challenges.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-11">
                    <figure class="mt-5 mt-lg-0">
                        <img class="mw-100" src="{{asset('assets/images/faculty/09.jpg')}}" alt="">
                    </figure>
                </div>
            </div>
            <div class="border-top my-60"></div>

            <div class="row">
                <h3 class="rts-section-title">About Tuition & Fees</h3>
                <p class="desc">Tuition rates for the Fall and Spring semesters are approved at the Board of Trustees meeting in July prior to the beginning of the academic year. Summer tuition rates are approved at the Board of Trustees meeting in February before the term begins. Course registration dates can be found on the . See Important Dates for payment due dates and other deadlines.
                </p>
                <h5>Undergraduate Students</h5>
                <p class="desc">Part-time undergraduate students (registered for less than 12 credits) or undergraduate students registered for credits over 20 in the Fall or Spring semester are charged the per credit rate based on residency. Undergraduate students taking between 12 and 20 credits in the Fall or Spring term are charged a flat rate tuition. Flat rate tuition is not available in the Summer. Undergraduate students registering for courses in the Summer term are charged a discounted per credit rate based on residency.</p>
            </div>

            <div class="border-top my-60"></div>

            <div class="row align-items-center justify-content-md-center">
                <div class="col-lg-6 col-md-11">
                    <figure class="mt-5 mt-lg-0">
                        <img class="mw-100" src="{{asset('assets/images/faculty/09.jpg')}}" alt="">
                    </figure>
                </div>
                <div class="col-lg-6 col-md-11">
                    <div class="faculty-content-text me-5">
                        <h4 class="font-32 mb-4">Mission</h4>
                        <p>Create innovative knowledge through intellectual practice, critical engagement, and creative endeavor. It is dedicated to providing students with enriched curriculum that fosters deeper understanding and appreciation of societies, cultures, languages, literatures, and artistic trends to address the contemporary global and local challenges.</p>
                        <h4 class="font-32 mb-4 mt-5">Vision</h4>
                        <p>Create innovative knowledge through intellectual practice, critical engagement, and creative endeavor. It is dedicated to providing students with enriched curriculum that fosters deeper understanding and appreciation of societies, cultures, languages, literatures, and artistic trends to address the contemporary global and local challenges.</p>
                    </div>
                </div>

            </div>
            <div class="border-top my-60"></div>

            <div class="row">
                <h3 class="rts-section-title">About Tuition & Fees</h3>
                <p class="desc">Tuition rates for the Fall and Spring semesters are approved at the Board of Trustees meeting in July prior to the beginning of the academic year. Summer tuition rates are approved at the Board of Trustees meeting in February before the term begins. Course registration dates can be found on the . See Important Dates for payment due dates and other deadlines.
                </p>
                <h5>Undergraduate Students</h5>
                <p class="desc">Part-time undergraduate students (registered for less than 12 credits) or undergraduate students registered for credits over 20 in the Fall or Spring semester are charged the per credit rate based on residency. Undergraduate students taking between 12 and 20 credits in the Fall or Spring term are charged a flat rate tuition. Flat rate tuition is not available in the Summer. Undergraduate students registering for courses in the Summer term are charged a discounted per credit rate based on residency.</p>
            </div>
        </div>
    </div>


    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
