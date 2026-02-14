@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => __('School expenses'),
        'page' => __('Expenses')
    ])

    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="admission-content-top">

                        <div class="application-deadline">
                            <h3 class="rts-section-title">{{ $fee ? (app()->getLocale() == 'ar' ? $fee->title_ar : $fee->title_en) : (app()->getLocale() == 'ar' ? 'المصروفات الدراسية' : 'Tuition Fees') }}</h3>
                            <div class="application-deadline__content">
                                <div class="application-deadline__content--table">
                                    <table class="table">
                                        <thead class="table-theme">
                                        <tr>
                                            <td>{{ app()->getLocale() == 'ar' ? 'المرحلة الدراسية' : 'Education Stage' }}</td>
                                            <td>{{ app()->getLocale() == 'ar' ? 'إجمالي المصروفات' : 'Total Fees' }}</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($fee && $fee->details)
                                            @foreach($fee->details as $detail)
                                                <tr>
                                                    <td>{{ app()->getLocale() == 'ar' ? $detail->educationStage->title_ar : $detail->educationStage->title_en }}</td>
                                                    <td>{{ number_format($detail->price, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="2" class="text-center">{{ app()->getLocale() == 'ar' ? 'لا يوجد بيانات' : 'No data available' }}</td>
                                            </tr>
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="payment-schedule mt--60 text-center" style="background: #f8f9fa; padding: 30px; border-radius: 10px; border: 1px dashed #2b3a8e;">
                            <h4 style="color: #2b3a8e; margin-bottom: 20px;">* {{ app()->getLocale() == 'ar' ? 'مواعيد دفع الرسوم الدراسية' : 'Tuition Fees Payment Schedule' }} :</h4>
                            <p style="font-size: 1.2rem; font-weight: 500;">
                                {{ app()->getLocale() == 'ar' ? 'القسط الأول: 1 يوليو حتى نهاية سبتمبر.' : 'First Installment: July 1st until the end of September.' }}
                            </p>
                            <p style="font-size: 1.2rem; font-weight: 500;">
                                {{ app()->getLocale() == 'ar' ? 'القسط الثاني: 1 ديسمبر حتى نهاية يناير.' : 'Second Installment: December 1st until the end of January.' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- admission page content end -->
    @include($footer . 'footer__default', ['class' => 'v__1'])
@endsection
