@extends('layout.admin.master')

@section('title', 'نقل الطلاب')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">
            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'نقل الطلاب'])
            <!-- Page Header Close -->

            <div class="app">
                <student-transfer-page></student-transfer-page>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
