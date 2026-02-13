@extends('layout.admin.master')

@section('title', 'مراحل التعليم')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'مراحل التعليم'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <education-stages />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
