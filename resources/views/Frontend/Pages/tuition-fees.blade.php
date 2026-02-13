@extends($layout)
@section('content')
    @include($header . 'transparent-header-v5')
    @include($elements . 'breadcrumb', [
        'class' => 'breadcrumb-height breadcumb-bg',
        'image' => 'breadcrumb.jpg',
        'title' => 'About Unipix University',
        'page' => 'about'
    ])

    <!-- admission page content -->
    <div class="rts-page-content rts-section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="admission-content-top">

                        <div class="application-deadline">
                            <h3 class="rts-section-title">Application Deadlines</h3>
                            <div class="application-deadline__content">
                                <div class="application-deadline__content--table">
                                    <table class="table">
                                        <thead class="table-theme">
                                        <tr>
                                            <td>Event</td>
                                            <td>Restrictive Early Action</td>
                                            <td>Regular Decision</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Standard Application Deadline</td>
                                            <td>November 1</td>
                                            <td>January 10</td>
                                        </tr>
                                        <tr>
                                            <td>Notification of Missing Documents</td>
                                            <td>Mid-November</td>
                                            <td>Mid-February</td>
                                        </tr>
                                        <tr>
                                            <td>Decision Released By</td>
                                            <td>Mid-December</td>
                                            <td>Early April</td>
                                        </tr>
                                        <tr>
                                            <td>Student Reply Date</td>
                                            <td>May 1</td>
                                            <td>May 1</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="application-deadline">
                            <h3 class="rts-section-title">Application Deadlines</h3>
                            <div class="application-deadline__content">
                                <div class="application-deadline__content--table">
                                    <table class="table">
                                        <thead class="table-theme">
                                        <tr>
                                            <td>Event</td>
                                            <td>Restrictive Early Action</td>
                                            <td>Regular Decision</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Standard Application Deadline</td>
                                            <td>November 1</td>
                                            <td>January 10</td>
                                        </tr>
                                        <tr>
                                            <td>Notification of Missing Documents</td>
                                            <td>Mid-November</td>
                                            <td>Mid-February</td>
                                        </tr>
                                        <tr>
                                            <td>Decision Released By</td>
                                            <td>Mid-December</td>
                                            <td>Early April</td>
                                        </tr>
                                        <tr>
                                            <td>Student Reply Date</td>
                                            <td>May 1</td>
                                            <td>May 1</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p> Unipix reserves the right to evaluate an application and render a final decision even if all pieces of the application have not been received.</p>
                                <p class="w-95 mx-0">Applicants are limited to a total of three applications for undergraduate admission, whether for first-year admission, transfer admission or a <br>combination of both. If you have submitted fewer than three applications to Unipix, you may reapply.
                                </p>
                            </div>
                        </div>
                        <div class="application-deadline">
                            <h3 class="rts-section-title">Application Deadlines</h3>
                            <div class="application-deadline__content">
                                <div class="application-deadline__content--table">
                                    <table class="table">
                                        <thead class="table-theme">
                                        <tr>
                                            <td>Event</td>
                                            <td>Restrictive Early Action</td>
                                            <td>Regular Decision</td>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>Standard Application Deadline</td>
                                            <td>November 1</td>
                                            <td>January 10</td>
                                        </tr>
                                        <tr>
                                            <td>Notification of Missing Documents</td>
                                            <td>Mid-November</td>
                                            <td>Mid-February</td>
                                        </tr>
                                        <tr>
                                            <td>Decision Released By</td>
                                            <td>Mid-December</td>
                                            <td>Early April</td>
                                        </tr>
                                        <tr>
                                            <td>Student Reply Date</td>
                                            <td>May 1</td>
                                            <td>May 1</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p> Unipix reserves the right to evaluate an application and render a final decision even if all pieces of the application have not been received.</p>
                                <p class="w-95 mx-0">Applicants are limited to a total of three applications for undergraduate admission, whether for first-year admission, transfer admission or a <br>combination of both. If you have submitted fewer than three applications to Unipix, you may reapply.
                                </p>
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
