@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.webp',
         'title' => __('Parents Meeting'),
        'page' => __('Parents Meeting'),

    ])

    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="admission-content-top">

                        @php
                            $dayLabels = [
                                'saturday' => 'Saturday',
                                'sunday' => 'Sunday',
                                'monday' => 'Monday',
                                'tuesday' => 'Tuesday',
                                'wednesday' => 'Wednesday',
                                'thursday' => 'Thursday',
                            ];
                        @endphp

                        @forelse($meetingsData as $data)
                            @php
                                $meeting = $data['meeting'];
                                $schedule = $data['schedule'];
                            @endphp

                            <div class="application-deadline {{ !$loop->first ? 'mt--60' : '' }}">
                                <h3 class="rts-section-title">
                                    {{ app()->getLocale() == 'ar' ? $meeting->title_ar : $meeting->title_en }}
                                </h3>
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
                                            @forelse($schedule as $day => $items)
                                                <tr>
                                                    <td>{{ __($dayLabels[$day] ?? ucfirst($day)) }}</td>
                                                    <td>
                                                        @foreach($items as $item)
                                                            {{ $item['stage'] }}@if(!$loop->last)<br>@endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if($meeting->is_general_time)
                                                            {{ \Illuminate\Support\Str::substr($meeting->time_from, 0, 5) }}
                                                            -
                                                            {{ \Illuminate\Support\Str::substr($meeting->time_to, 0, 5) }}
                                                        @else
                                                            @foreach($items as $item)
                                                                {{ \Illuminate\Support\Str::substr($item['time_from'], 0, 5) }}
                                                                -
                                                                {{ \Illuminate\Support\Str::substr($item['time_to'], 0, 5) }}@if(!$loop->last)<br>@endif
                                                            @endforeach
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="3" class="text-center">
                                                        {{ app()->getLocale() == 'ar' ? 'لا يوجد بيانات' : 'No data available' }}
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            @if((app()->getLocale() == 'ar' && $meeting->note_ar) || (app()->getLocale() == 'en' && $meeting->note_en))
                                <div class="payment-schedule mt--40 text-center" style="background: #f8f9fa; padding: 30px; border-radius: 10px; border: 1px dashed #2b3a8e;">
                                    <div style="font-size: 1.2rem; font-weight: 500; white-space: pre-line; color: #2b3a8e;">
                                        {{ app()->getLocale() == 'ar' ? $meeting->note_ar : $meeting->note_en }}
                                    </div>
                                </div>
                            @endif
                        @empty
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
                                                <td colspan="3" class="text-center">
                                                    {{ app()->getLocale() == 'ar' ? 'لا يوجد بيانات' : 'No data available' }}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- admission page content end -->
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
