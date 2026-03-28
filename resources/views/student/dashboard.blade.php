@extends('layout.student.master')

@section('title', __('translation.student_dashboard'))

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h2 class="fw-bold mb-1">{{ __('translation.welcome_student') }} {{ $student->name }}</h2>
            <p class="text-muted">{{ __('translation.student_dashboard') }} - {{ __('translation.Academic Year') }}: {{ $enrollment->academicYear->name ?? 'N/A' }}</p>
        </div>
        <div class="col-md-4 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
            <span class="badge bg-primary px-3 py-2 rounded-pill">
                {{ $enrollment->schoolClass->name ?? __('No Class') }}
            </span>
        </div>
    </div>

    <div class="app">
        <student-dashboard 
            :academic-years="{{ $academicYears->toJson() }}" 
            :semesters="{{ $semesters->toJson() }}" 
            :subjects="{{ $subjects->toJson() }}"
        ></student-dashboard>
    </div>
</div>
@endsection

@push('scripts')
    @vite(['resources/js/app.js'])
@endpush
