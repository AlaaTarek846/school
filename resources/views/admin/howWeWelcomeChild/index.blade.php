@extends('layout.admin.master')

@section('title', 'كيف يستقبل الطفل')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'كيف يستقبل الطفل'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <how-we-welcome-child />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
