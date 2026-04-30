@extends('layout.admin.master')

@section('title', 'الإنجازات')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'الإنجازات'])
            <!-- Page Header Close -->

            <div class="app">
                <achievements />
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
