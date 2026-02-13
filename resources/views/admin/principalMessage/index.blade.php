@extends('layout.admin.master')

@section('title', 'كلمة المدير')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'كلمة المدير'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <principal-message />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
