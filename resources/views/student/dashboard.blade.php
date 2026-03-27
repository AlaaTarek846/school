@extends('layout.student.master')

@section('title', __('translation.student_dashboard'))

@section('content')
<div class="container-fluid">
    <div class="row align-items-center mb-5">
        <div class="col-md-8">
            <h2 class="fw-bold mb-1">{{ __('translation.welcome_student') }} {{ $student->name }}</h2>
            <p class="text-muted">{{ __('translation.student_dashboard') }} - {{ __('Academic Year') }}: {{ $student->currentEnrollment->academicYear->name ?? 'N/A' }}</p>
        </div>
        <div class="col-md-4 text-{{ app()->getLocale() == 'ar' ? 'start' : 'end' }}">
            <span class="badge bg-primary px-3 py-2 rounded-pill">
                {{ $student->currentEnrollment->schoolClass->name ?? __('No Class') }}
            </span>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card stat-card border-start border-primary border-5">
                <div class="stat-icon bg-primary text-white">
                    <i class="fas fa-book-reader"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">12</h5>
                    <p class="text-muted mb-0 small">{{ __('Enrolled Courses') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card border-start border-success border-5">
                <div class="stat-icon bg-success text-white">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">85%</h5>
                    <p class="text-muted mb-0 small">{{ __('Attendance') }}</p>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card stat-card border-start border-warning border-5">
                <div class="stat-icon bg-warning text-white">
                    <i class="fas fa-star"></i>
                </div>
                <div>
                    <h5 class="mb-1 fw-bold">3.8</h5>
                    <p class="text-muted mb-0 small">{{ __('GPA / Grade') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">{{ __('Recent Homework') }}</h5>
                    <a href="#" class="text-primary small fw-bold text-decoration-none">{{ __('View All') }}</a>
                </div>
                
                <div class="list-group list-group-flush">
                    <div class="list-group-item px-0 py-3 border-0 border-bottom d-flex align-items-center">
                        <div class="me-3 p-2 bg-light rounded text-primary">
                            <i class="fas fa-flask"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">{{ __('Science Project') }}</h6>
                            <span class="small text-muted">{{ __('Due: Tomorrow') }}</span>
                        </div>
                        <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded small">{{ __('Urgent') }}</span>
                    </div>
                    
                    <div class="list-group-item px-0 py-3 border-0 border-bottom d-flex align-items-center">
                        <div class="me-3 p-2 bg-light rounded text-success">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="mb-0 fw-bold">{{ __('Math Exercise Set 4') }}</h6>
                            <span class="small text-muted">{{ __('Due: Wednesday') }}</span>
                        </div>
                        <span class="badge bg-success-subtle text-success px-2 py-1 rounded small">{{ __('New') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card p-4 h-100">
                <h5 class="fw-bold mb-4">{{ __('Announcements') }}</h5>
                <div class="alert alert-primary border-0 small mb-3">
                    <p class="mb-1 fw-bold">{{ __('School Trip') }}</p>
                    {{ __('Registration for the summer trip is now open until next week.') }}
                </div>
                <div class="alert alert-warning border-0 small mb-0">
                    <p class="mb-1 fw-bold">{{ __('Maintenance') }}</p>
                    {{ __('The school portal will be down for maintenance this Saturday.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
