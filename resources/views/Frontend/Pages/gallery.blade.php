@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Gallery'),
        'page' => __('Gallery')
    ])
    <!-- gallery directory -->
    <section class="rts-faculty rts-section-padding">
        <div class="container">
            <div class="row g-5" id="gallery-container">
                <!-- items will be loaded here -->
            </div>
            <div class="rts-load-more-btn rt-center mt--60" id="load-more-container" style="display: none;">
                <button id="load-more-btn" class="rts-theme-btn primary lh-100">{{ __('Load More') }}</button>
            </div>
            <div id="no-more-msg" class="rt-center mt--60" style="display: none;">
                <p>{{ __('No more images to load') }}</p>
            </div>
        </div>
    </section>
    <!-- gallery directory end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let nextPageUrl = '{{ route("api.galleries") }}';

    function loadGalleries(url) {
        if (!url) return;

        $.ajax({
            url: url,
            type: 'GET',
            beforeSend: function() {
                $('#load-more-btn').prop('disabled', true).text('{{ __("Loading...") }}');
            },
            success: function(response) {
                let html = '';
                response.data.forEach(function(item) {
                    html += `
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="single-cat-item">
                                <div class="cat-thumb">
                                    <img src="${item.image}" alt="gallery-thumbnail">
                                </div>
                            </div>
                        </div>
                    `;
                });

                $('#gallery-container').append(html);
                nextPageUrl = response.next_page_url;

                if (nextPageUrl) {
                    $('#load-more-container').show();
                    $('#load-more-btn').prop('disabled', false).text('{{ __("Load More") }}');
                } else {
                    $('#load-more-container').hide();
                    if ($('#gallery-container').children().length > 0) {
                        $('#no-more-msg').show();
                    }
                }
            },
            error: function() {
                alert('{{ __("Something went wrong!") }}');
            }
        });
    }

    // Initial load
    loadGalleries(nextPageUrl);

    // Load more click
    $('#load-more-btn').on('click', function() {
        loadGalleries(nextPageUrl);
    });
});
</script>
@endpush
