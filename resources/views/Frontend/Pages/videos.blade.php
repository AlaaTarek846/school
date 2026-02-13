@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('Videos'),
        'page' => __('Videos')
    ])
    <!-- video directory -->
    <section class="rts-faculty rts-section-padding">
        <div class="container">
            <div class="row g-5" id="video-container">
                <!-- items will be loaded here -->
            </div>
            <div class="rts-load-more-btn rt-center mt--60" id="load-more-container" style="display: none;">
                <button id="load-more-btn" class="rts-theme-btn primary lh-100">{{ __('Load More') }}</button>
            </div>
            <div id="no-more-msg" class="rt-center mt--60" style="display: none;">
                <p>{{ __('No more videos to load') }}</p>
            </div>
        </div>
    </section>
    <!-- video directory end -->

    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let nextPageUrl = '{{ route("api.videos") }}';

            function getYouTubeId(url) {
                const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                const match = url.match(regExp);
                return (match && match[2].length === 11) ? match[2] : null;
            }

            function loadVideos(url) {
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
                            let videoId = getYouTubeId(item.link);
                            let embedUrl = videoId ? `https://www.youtube.com/embed/${videoId}` : item.link;
                            
                            html += `
                                <div class="col-lg-6 col-md-12">
                                    <div class="single-video-item shadow-sm p-3 rounded bg-white">
                                        <div class="video-thumb position-relative" style="padding-bottom: 56.25%; height: 0; overflow: hidden;">
                                            <iframe 
                                                src="${embedUrl}" 
                                                frameborder="0" 
                                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                                allowfullscreen
                                                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 8px;">
                                            </iframe>
                                        </div>
                                    </div>
                                </div>
                            `;
                        });

                        $('#video-container').append(html);
                        nextPageUrl = response.next_page_url;

                        if (nextPageUrl) {
                            $('#load-more-container').show();
                            $('#load-more-btn').prop('disabled', false).text('{{ __("Load More") }}');
                        } else {
                            $('#load-more-container').hide();
                            if ($('#video-container').children().length > 0) {
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
            loadVideos(nextPageUrl);

            // Load more click
            $('#load-more-btn').on('click', function() {
                loadVideos(nextPageUrl);
            });
        });
    </script>
@endpush
