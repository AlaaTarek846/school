@extends('layout.student.master')

@section('title', __('My Courses'))

@section('content')
<div class="container-fluid">
    <!-- Header & Filter -->
    <div class="row align-items-center mb-5">
        <div class="col-md-7">
            <h2 class="fw-bold mb-1">{{ __('My Courses') }}</h2>
            <p class="text-muted">{{ __('translation.academic_year') }}:
                <span class="text-primary fw-bold">
                    {{ $academicYears->firstWhere('id', $selectedYearId)->name ?? 'N/A' }}
                </span>
            </p>
        </div>
        <div class="col-md-5">
            <form action="{{ route('student.courses') }}" method="GET" id="yearFilterForm" class="d-flex justify-content-md-end">
                <div class="dropdown shadow-sm rounded-pill bg-white px-3 py-1">
                    <label class="small text-muted me-2 mb-0">{{ __('translation.Academic Year') }}</label>
                    <select name="academic_year_id" onchange="this.form.submit()" class="form-select form-select-sm border-0 fw-bold" style="width: auto; cursor: pointer;">
                        @foreach($academicYears as $year)
                            <option value="{{ $year->id }}" {{ $selectedYearId == $year->id ? 'selected' : '' }}>
                                {{ $year->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="row g-4">
        @forelse($subjects as $subject)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="card h-100 course-card">
                    <div class="course-header" style="background: {{ ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#5a5c69'][ $loop->index % 7] }};">
                        <div class="course-icon">
                            <i class="fas {{ ['fa-book', 'fa-flask', 'fa-calculator', 'fa-language', 'fa-history', 'fa-globe', 'fa-music'][ $loop->index % 7 ] }}"></i>
                        </div>
                    </div>
                    <div class="card-body p-4 text-center">
                        <h5 class="fw-bold mb-2">
                            {{ app()->getLocale() == 'ar' ? $subject->title_ar : $subject->title_en }}
                        </h5>
                        <div class="d-flex justify-content-center gap-2 mb-3">
                            <span class="badge bg-light text-dark rounded-pill px-3">{{ __('translation.Full Semester') }}</span>
                        </div>
{{--                        <button class="btn btn-outline-primary rounded-pill w-100 mt-2">--}}
{{--                            {{ __('translation.View Details') }}--}}
{{--                        </button>--}}
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="mb-4">
                    <i class="fas fa-folder-open fa-4x text-muted opacity-25"></i>
                </div>
                <h4 class="text-muted">{{ __('translation.No subjects found for this academic year') }}</h4>
            </div>
        @endforelse
    </div>
</div>

@push('css')
<style>
    .course-card {
        border-radius: 20px !important;
        transition: all 0.3s ease;
        border: 1px solid rgba(0,0,0,0.05) !important;
    }
    .course-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
    }
    .course-header {
        height: 120px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px 20px 0 0;
        position: relative;
    }
    .course-icon {
        width: 60px;
        height: 60px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(5px);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.8rem;
    }
    .form-select:focus {
        box-shadow: none;
    }
</style>
@endpush
@endsection
