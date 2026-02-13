@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'About Unipix University',
        'page' => 'about'
    ])

    <!-- content -->
    <div class="rts-faculty-details rts-section-padding">
        <div class="container">

            <div class="row">
                <div class="row justify-content-md-center g-0">
                    <div class="rts-section mb--60 text-center">
                        <h3 class="rts-section-title">Academics & Program</h3>
                    </div>
                    <div class="col-lg-4 col-md-10">
                        <div class="program__single--item">
                            <div class="program__single--item--bg">
                                <img src="{{asset('assets/images/program/program__bg.jpg')}}" alt="">
                            </div>
                            <h5 class="program__single--item--title">undergraduate</h5>

                            <ul class="program__single--item--list">
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Anthropology
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Applied Mathematics
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Biomedical Engineering
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Astrophysics
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-10">
                        <div class="program__single--item v__2">
                            <div class="program__single--item--bg">
                                <img src="{{asset('assets/images/program/program__bg.jpg')}}" alt="">
                            </div>
                            <h5 class="program__single--item--title">graduate</h5>

                            <ul class="program__single--item--list">
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Applied Computation
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Applied Mathematics
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Applied Computation
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Architecture
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-10">
                        <div class="program__single--item">
                            <div class="program__single--item--bg">
                                <img src="{{asset('assets/images/program/program__bg.jpg')}}" alt="">
                            </div>
                            <h5 class="program__single--item--title">Lifelong Learning</h5>

                            <ul class="program__single--item--list">
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Personal Development
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Arts and Humanities
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Health and Wellness
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                                <li class="program__single--item--list--item">
                                    <a href="{{ route('program-single') }}" class="link__list">Social Sciences
                                        <span><i class="fa-regular fa-arrow-right"></i></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="border-top my-60"></div>
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
            </div>
        </div>
    </div>
    <!-- content end -->


    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
