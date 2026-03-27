@extends('layout.admin.master')

@section('title', 'إجابات الطلاب')

@section('content')
    <div class="main-content app-content">
        <div class="container-fluid">

            <!-- Page Header -->
            @include('layout.admin.partials.breadcrumb',['page' => 'إجابات الطلاب'])
            <!-- Page Header Close -->

            <div class="app">
                <exam-answers-index></exam-answers-index>
            </div>

        </div>
    </div>

@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
