@extends('layout.admin.auth-master')

@section('title', __('translation.sign_in'))

@section('content')
<div class="container">
    <div class="app">
        <login />
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
