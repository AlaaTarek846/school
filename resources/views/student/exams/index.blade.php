@extends('layout.student.master')

@section('title', __('translation.Assignments'))

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-1"><i class="fas fa-file-alt me-2"></i> {{ __('translation.Assignments') }}</h2>
                            <p class="mb-0 text-white-50">{{ __('translation.View and manage your assignments') }}</p>
                        </div>
                    </div>
                    <!-- Decorative Circle -->
                    <div class="position-absolute end-0 top-0 mt-n4 me-n4 opacity-10">
                        <i class="fas fa-file-signature" style="font-size: 150px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 sticky-top" style="top: 20px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-bold mb-0 text-primary">
                        <i class="fas fa-filter me-2"></i> {{ __('translation.Filters') }}
                    </h5>
                </div>
                <div class="card-body p-4">
                    <form id="filterForm">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('translation.Academic Year') }}</label>
                            @if($academicYears->count() > 0)
                                <input type="text" class="form-control border-0 bg-light rounded-3 p-2 shadow-none" value="{{ $academicYears->first()->name }}" disabled>
                                <input type="hidden" name="academic_year_id" value="{{ $academicYears->first()->id }}">
                            @endif
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('translation.Semester') }}</label>
                            <select name="semester_id" class="form-select border-0 bg-light rounded-3 p-2 shadow-none">
                                <option value="">{{ __('translation.All Semesters') }}</option>
                                @foreach($semesters as $semester)
                                    <option value="{{ $semester->id }}" {{ $enrollment->semester_id == $semester->id ? 'selected' : '' }}>
                                        {{ $semester->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('translation.Subject') }}</label>
                            <select name="subject_id" class="form-select border-0 bg-light rounded-3 p-2 shadow-none">
                                <option value="">{{ __('translation.All Subjects') }}</option>
                                @foreach($subjects as $subject)
                                    <option value="{{ $subject->id }}">{{ $subject->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('translation.From Date') }}</label>
                            <input type="date" name="from_date" class="form-control border-0 bg-light rounded-3 p-2 shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">{{ __('translation.To Date') }}</label>
                            <input type="date" name="to_date" class="form-control border-0 bg-light rounded-3 p-2 shadow-none">
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mt-2 shadow-sm">
                            <i class="fas fa-search me-2"></i> {{ __('translation.Search') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Exams List -->
        <div class="col-lg-9">
            <div id="examsContainer" class="row g-4 mb-4">
                <!-- Data will be loaded via AJAX -->
                <div class="col-12 text-center py-5" id="loader">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">{{ __('translation.Loading assignments...') }}</p>
                </div>
            </div>

            <!-- Pagination -->
            <div id="paginationContainer" class="d-flex justify-content-center mt-4"></div>
        </div>
    </div>
</div>

<!-- Exam Details & Upload Modal -->
<div class="modal fade" id="examModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="modal-header bg-primary text-white border-0 py-3">
                <h5 class="modal-title fw-bold" id="examModalLabel">
                    <i class="fas fa-info-circle me-2"></i> {{ __('translation.Assignment Details') }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalBody">
                <!-- Content injected via JS -->
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let currentPage = 1;

    let currentExams = [];

    function loadExams(page = 1) {
        currentPage = page;
        $('#loader').show();
        $('#examsContainer').find('.exam-card-item').remove();
        $('#paginationContainer').empty();

        let formData = $('#filterForm').serialize() + '&page=' + page;

        $.ajax({
            url: "{{ route('student.api.exams') }}",
            type: "GET",
            data: formData,
            success: function(response) {
                $('#loader').hide();
                let exams = response.data;
                currentExams = exams; // Store globally
                let pagination = response.pagination;
                let html = '';

                if (!exams || exams.length === 0) {
                    html = '<div class="col-12 text-center py-5 exam-card-item"><div class="text-muted"><i class="fas fa-folder-open fa-3x mb-3"></i><p>{{ __("translation.No assignments found") }}</p></div></div>';
                } else {
                    exams.forEach(exam => {
                        let statusClass = '';
                        let statusText = '';

                        if (exam.is_available) {
                            statusClass = 'bg-success';
                            statusText = "{{ __('translation.Available') }}";
                        } else if (exam.is_past) {
                            statusClass = 'bg-secondary';
                            statusText = "{{ __('translation.Past') }}";
                        } else {
                            statusClass = 'bg-warning';
                            statusText = "{{ __('translation.Upcoming') }}";
                        }

                        let submittedHtml = '';
                        let fileUrl = exam.pdf ? "{{ route('student.api.assignment-file', ':id') }}".replace(':id', exam.id) : '';
                        if (exam.is_available && exam.pdf) {
                            submittedHtml = `<span class="badge bg-info-subtle text-info rounded-pill px-3 py-1 small ms-2"><i class="fas fa-paperclip me-1"></i> {{ __('translation.Assignment File') }}</span>`;
                        }

                        let locale = "{{ app()->getLocale() }}";
                        let title = locale === 'ar' ? exam.title_ar : exam.title_en;
                        let subjectName = locale === 'ar' ? (exam.subject ? exam.subject.title_ar : '') : (exam.subject ? exam.subject.title_en : '');

                        function formatTime(dt) {
                            if (!dt || !dt.includes(' ')) return '--:--';
                            return dt.split(' ')[1].substring(0, 5);
                        }

                        html += `
                        <div class="col-md-6 col-xl-4 exam-card-item animate__animated animate__fadeIn">
                            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden hover-lift card-exam">
                                <div class="card-body p-4">
                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <span class="badge ${statusClass} rounded-pill px-3 py-1 small">${statusText}</span>
                                            ${submittedHtml}
                                        </div>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-light border-0 rounded-circle" data-bs-toggle="dropdown">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-3">
                                                <li><a class="dropdown-item py-2 view-exam" href="#" data-id="${exam.id}"><i class="fas fa-eye me-2 text-primary"></i> {{ __('translation.View Details') }}</a></li>
                                                ${(exam.is_available && exam.pdf) ? `<li><a class="dropdown-item py-2" href="${fileUrl}" target="_blank"><i class="fas fa-download me-2 text-success"></i> {{ __('translation.Download Assignment') }}</a></li>` : ''}
                                            </ul>
                                        </div>
                                    </div>
                                    <h5 class="fw-bold mb-1 text-dark text-truncate">${title}</h5>
                                    <p class="text-primary small fw-bold mb-3">${subjectName}</p>

                                    <div class="mb-3 small text-muted">
                                        <div class="d-flex align-items-center mb-1">
                                            <i class="far fa-calendar-alt mx-1"></i> ${exam.start_date.split(' ')[0]} - ${exam.end_date.split(' ')[0]}
                                        </div>
                                    </div>

                                    <div class="mt-auto d-flex gap-2">
                                        <button class="btn btn-primary-light flex-grow-1 border-0 rounded-pill py-2 small fw-bold view-exam" data-id="${exam.id}">
                                            {{ __('translation.View Details') }}
                                        </button>
                                        ${(exam.is_available && exam.pdf) ? `
                                        <a href="${fileUrl}" target="_blank" class="btn btn-success flex-grow-1 border-0 rounded-pill py-2 small fw-bold">
                                            <i class="fas fa-download me-1"></i> {{ __('translation.Download Assignment') }}
                                        </a>
                                        ` : ''}
                                    </div>
                                </div>
                            </div>
                        </div>`;
                    });
                }
                $('#examsContainer').append(html);
                renderPagination(pagination);
            }
        });
    }

    function renderPagination(pagination) {
        if (!pagination || pagination.last_page <= 1) return;

        let html = '<nav aria-label="Page navigation"><ul class="pagination pagination-md mb-0">';

        // Prev button
        html += `
        <li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
            <a class="page-link border-0 rounded-start-pill px-3 shadow-none" href="#" data-page="${pagination.current_page - 1}">
                <i class="fas fa-chevron-${"{{ app()->getLocale() }}" === 'ar' ? 'right' : 'left'}"></i>
            </a>
        </li>`;

        // Page numbers (limited range for clean look)
        let start = Math.max(1, pagination.current_page - 2);
        let end = Math.min(pagination.last_page, start + 4);
        if (end - start < 4) start = Math.max(1, end - 4);

        for (let i = start; i <= end; i++) {
            html += `
            <li class="page-item ${pagination.current_page === i ? 'active' : ''}">
                <a class="page-link border-0 px-3 shadow-none ${pagination.current_page === i ? '' : 'bg-light text-dark'}" href="#" data-page="${i}">${i}</a>
            </li>`;
        }

        // Next button
        html += `
        <li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
            <a class="page-link border-0 rounded-end-pill px-3 shadow-none" href="#" data-page="${pagination.current_page + 1}">
                <i class="fas fa-chevron-${"{{ app()->getLocale() }}" === 'ar' ? 'left' : 'right'}"></i>
            </a>
        </li>`;

        html += '</ul></nav>';
        $('#paginationContainer').html(html);
    }

    $(document).on('click', '#paginationContainer .page-link', function(e) {
        e.preventDefault();
        let page = $(this).data('page');
        if (page) loadExams(page);
    });

    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        loadExams(1);
    });

    loadExams(1);

    $(document).on('click', '.view-exam', function(e) {
        e.preventDefault();
        let examId = $(this).data('id');
        let exam = currentExams.find(ex => ex.id == examId);

        if (!exam) return;

        let locale = "{{ app()->getLocale() }}";
        let title = locale === 'ar' ? exam.title_ar : exam.title_en;
        let subjectName = locale === 'ar' ? (exam.subject ? exam.subject.title_ar : '') : (exam.subject ? exam.subject.title_en : '');
        let notes = exam.notes || "{{ __('translation.No notes provided') }}";
        let fileUrl = exam.pdf ? "{{ route('student.api.assignment-file', ':id') }}".replace(':id', exam.id) : '';

        let fileHtml = '';
        if (exam.pdf && exam.is_available) {
            let ext = exam.pdf.split('.').pop().toLowerCase();
            if (fileUrl) {
                if (['mp4', 'mpeg', 'avi', 'mov', 'webm', 'mkv'].includes(ext)) {
                    fileHtml = `
                    <video controls class="w-100 rounded-3 mb-3" style="max-height: 260px;">
                        <source src="${fileUrl}">
                    </video>
                    <a href="${fileUrl}" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold">
                        <i class="fas fa-download me-2"></i> {{ __('translation.Download Assignment') }}
                    </a>`;
                } else if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(ext)) {
                    fileHtml = `
                    <img src="${fileUrl}" alt="{{ __('translation.Assignment File') }}" class="img-fluid rounded-3 mb-3" style="max-height: 260px; object-fit: contain; width: 100%;">
                    <a href="${fileUrl}" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold">
                        <i class="fas fa-download me-2"></i> {{ __('translation.Download Assignment') }}
                    </a>`;
                } else {
                    fileHtml = `
                    <div class="text-center py-4 mb-3 bg-white rounded-3">
                        <i class="fas fa-file-pdf fa-4x text-danger opacity-50 mb-2"></i>
                        <p class="small text-muted mb-0">{{ __('translation.Assignment File') }}</p>
                    </div>
                    <a href="${fileUrl}" target="_blank" class="btn btn-success w-100 rounded-pill py-2 fw-bold">
                        <i class="fas fa-download me-2"></i> {{ __('translation.Download Assignment') }}
                    </a>`;
                }
            }
        } else if (exam.pdf) {
            fileHtml = `
            <div class="text-center py-5">
                <i class="fas fa-lock fa-3x text-muted opacity-25 mb-2"></i>
                <p class="text-muted small mb-0">{{ __('translation.File is not available yet') }}</p>
            </div>`;
        } else {
            fileHtml = `
            <div class="text-center py-5">
                <i class="fas fa-file-alt fa-3x text-muted opacity-25 mb-2"></i>
                <p class="text-muted small mb-0">{{ __('translation.No file attached') }}</p>
            </div>`;
        }

        let body = `
        <div class="row">
            <div class="col-md-6 border-end-sm">
                <div class="mb-4">
                    <h4 class="fw-bold text-dark mb-1">${title}</h4>
                    <p class="text-primary fw-bold mb-0">${subjectName}</p>
                </div>
                <div class="mb-3 small">
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <p class="text-muted mb-0">{{ __('translation.Start Date') }}</p>
                                <p class="fw-bold mb-0">${exam.start_date}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <p class="text-muted mb-0">{{ __('translation.End Date') }}</p>
                                <p class="fw-bold mb-0">${exam.end_date}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <h6 class="fw-bold small text-muted text-uppercase mb-2">{{ __('translation.Notes') }}</h6>
                    <p class="small text-muted bg-light p-3 rounded-3">${notes}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 bg-light rounded-4 h-100 p-4">
                    <div class="my-auto">
                        <h6 class="fw-bold text-dark mb-3"><i class="fas fa-paperclip me-2 text-primary"></i> {{ __('translation.Assignment File') }}</h6>
                        ${fileHtml}
                    </div>
                </div>
            </div>
        </div>`;
        $('#modalBody').html(body);
        $('#examModal').modal('show');
    });
});
</script>
@endpush

@push('css')
<style>
.hover-lift {
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}
.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 1rem 3rem rgba(0,0,0,0.1) !important;
}

[dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
    float: right;
    padding-right: 0;
    padding-left: 0.5rem;
}
.border-dashed {
    border-style: dashed !important;
    border-width: 2px !important;
}
.bg-primary-subtle {
    background-color: rgba(13, 110, 253, 0.05);
}
.btn-primary-light {
    background-color: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}
.btn-primary-light:hover {
    background-color: #0d6efd;
    color: #fff;
}
@media (min-width: 768px) {
    .border-end-sm {
        border-inline-end: 1px solid #eee !important;
    }
}
.animate__animated {
    animation-duration: 0.6s;
}
.card-exam {
    border-radius: 20px !important;
}
</style>
@endpush
