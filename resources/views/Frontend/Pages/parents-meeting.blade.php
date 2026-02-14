@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
         'title' => __('Parents Meeting'),
        'page' => __('Parents Meeting'),

    ])

    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="admission-content-top">

                        <div class="application-deadline">
                            <h3 class="rts-section-title">{{ __('Parents Meeting') }}</h3>
                            <div class="application-deadline__content">
                                <div class="application-deadline__content--table">
                                    <table class="table">
                                        <thead class="table-theme">
                                        <tr>
                                            <td>{{ __('Day') }}</td>
                                            <td>{{ __('Class') }}</td>
                                            <td>{{ __('Time') }}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>{{ __('Sunday') }}
                                            </td>
                                            <td>
                                                K.GI B
                                            </br>
                                                K.GII B
                                            </td>

                                            <td >{{ __('am') }} :10:5  9:45</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Monday') }}</td>
                                            <td>
                                                K.GI A
                                                </br>
                                                K.GII D
                                            </td>
                                            <td >{{ __('am') }} :10:5  9:45</td>

                                        </tr>
                                        <tr>
                                            <td>{{ __('Tuesday') }}</td>
                                            <td>
                                                K.GI / D
                                                </br>
                                                K.GII / C
                                            </td>
                                            <td >{{ __('am') }} :10:5  9:45</td>

                                        </tr>
                                        <tr>
                                            <td>{{ __('Wednesday') }}</td>
                                            <td>
                                                K.GI / C
                                                </br>
                                                K.GII /A
                                            </td>
                                            <td >{{ __('am') }} :10:5  9:45</td>

                                        </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- admission page content end -->
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
