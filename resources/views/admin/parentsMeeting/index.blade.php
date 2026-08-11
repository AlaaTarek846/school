@extends('layout.admin.master')

@section('title', 'اجتماعات أولياء الأمور')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'اجتماعات أولياء الأمور'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <parents-meetings />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
