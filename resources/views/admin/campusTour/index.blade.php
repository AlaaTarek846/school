@extends('layout.admin.master')

@section('title', 'جولة في حرم المدرسة')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'جولة في حرم المدرسة'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <campus-tour />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
