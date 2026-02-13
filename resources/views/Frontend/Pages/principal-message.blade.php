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
                <div class="rts-section mb--60">
                    <h3 class="rts-section-title">Message from Dean</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="faculty-image text-center">
                        <img class="img-fluid mw-100 " src="{{asset('assets/images/faculty/02.jpg')}}" alt="faculty image">
                        <div class="h5 mb-2 mt-5">Barry Palatnik, Ed.D</div>
                        <span>Assistant Professor</span>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="faculty-content-text ms-lg-5 mt-5 mt-lg-0">
                        <p class="h6 mb-
                        4">It’s your Time Join to explore</p>
                        <p class="mb-5">The Faculty of Arts Unipix University  warmly welcomes you to a vast, vivid and vigorous academic landscape of relentless pursuits and superb brilliance.</p>
                        <p class="h6 mb-
                        4">Learn to lead</p>
                        <p class="mb-5">In line with the lifelong motto of Unipix ‘where leaders are created’, FA is devoted to produce accomplished, as well as skilled, learners who can meet the professional requirements of today’s local and global job market. Be it an academic seminar or an in-house cricket tournament or a debate festival, students and teachers at FA work hand in hand to make it a success. This is how we make sure that each of our students remains engaged in academic and extracurricular rigors to grow to his or her fullest extent. This is how FA of Unipix creates local leaders for the global demands.</p>
                        <p class="h6 mb-
                        4">Challenge yourself to change the world</p>
                        <p>Education becomes meaningful only when it can change the world when necessary. This is what my colleagues and I are working for every single day of the week at FA. I hope that you will find whatever information you may need here and if not please feel free to let me know. I warmly welcome your comments and suggestions. Thank you very much for your kind visit.</p>
                    </div>
                </div>
                <div class="border-top my-60"></div>
            </div>

        </div>
    </div>
    <!-- content end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
