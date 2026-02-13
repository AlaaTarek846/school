@extends('layout.admin.master')

@section('title', 'لائحة الانضباط المدرسي')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'لائحة الانضباط المدرسي'])
            <!-- Page Header Close -->

            <!-- Start::row-1 -->
            <div class="app">
                <school-discipline-policy />
            </div>
            <!--End::row-1 -->

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
