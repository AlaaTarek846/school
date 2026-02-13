@extends('layout.admin.master')

@section('title', __('global.gallery'))

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => __('global.gallery')])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <galleries />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
