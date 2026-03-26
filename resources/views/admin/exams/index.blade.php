@extends('layout.admin.master')

@section('title', 'إدارة الامتحانات')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'إدارة الامتحانات'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <exams />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
