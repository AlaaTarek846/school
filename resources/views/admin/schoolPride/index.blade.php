@extends('layout.admin.master')

@section('title', 'فخر المدرسة')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'فخر المدرسة'])
            <!-- Page Header Close -->

            <div class="app">
                <school-prides />
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
