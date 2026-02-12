
<!-- BREADCRUMB AREA -->
<section class="rts-breadcrumb {{ $class ?? '' }}" data-background="{{ asset('assets/images/banner/' . ($image ?? '')) }}" style="background-image: url('{{ asset('assets/images/banner/' . ($image ?? '')) }}');">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-content">
                    <h6 class="rts__section--subheading">
                        <img src="{{asset('assets/images/icon/e-cap.svg')}}" alt="">{{ $page ?? '' }}
                    </h6>
                    <h1 class="section-title mb-0">{{ $title ?? '' }}</h1>
                </div>
            </div>
        </div>
    </div>  
</section>
<!-- BREADCRUMB AREA END -->
