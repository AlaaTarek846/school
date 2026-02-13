@extends('layout.admin.master')

@section('title', 'لماذا تختارنا')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'لماذا تختارنا'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <why-choose-us />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
