@extends('layout.admin.master')

@section('title', 'أقسام الإنجازات')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'أقسام الإنجازات'])
            <!-- Page Header Close -->

            <div class="app">
                <achievement-section-page />
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
