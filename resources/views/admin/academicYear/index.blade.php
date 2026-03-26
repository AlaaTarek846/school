@extends('layout.admin.master')

@section('title', 'السنوات الدراسية')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'السنوات الدراسية'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <academic-years />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
