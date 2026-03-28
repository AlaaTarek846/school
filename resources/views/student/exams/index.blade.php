@extends('layout.student.master')

@section('title', __('translation.Exams'))

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-primary text-white border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4 position-relative">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="fw-bold mb-1"><i class="fas fa-file-alt me-2"></i> {{ __('translation.Exams') }}</h2>
                            <p class="mb-0 text-white-50">{{ __('View and manage your academic exams') }}</p>
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
                            <select name="academic_year_id" class="form-select border-0 bg-light rounded-3 p-2 shadow-none">
                                <option value="">{{ __('translation.All Years') }}</option>
                                @foreach($academicYears as $year)
                                    <option value="{{ $year->id }}" {{ $enrollment->academic_year_id == $year->id ? 'selected' : '' }}>{{ $year->name }}</option>
                                @endforeach
                            </select>
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
                    <p class="mt-2 text-muted">{{ __('translation.Loading exams...') }}</p>
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
                    <i class="fas fa-info-circle me-2"></i> {{ __('translation.Exam Details') }}
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
                    html = '<div class="col-12 text-center py-5 exam-card-item"><div class="text-muted"><i class="fas fa-folder-open fa-3x mb-3"></i><p>{{ __("translation.No exams found") }}</p></div></div>';
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
                        if (exam.student_answers && exam.student_answers.length > 0) {
                            submittedHtml = `<span class="badge bg-info-subtle text-info rounded-pill px-3 py-1 small ms-2 animate__animated animate__pulse animate__infinite"><i class="fas fa-check-circle me-1"></i> {{ __('translation.Submitted') }}</span>`;
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
                                                ${exam.pdf ? `<li><a class="dropdown-item py-2" href="/storage/${exam.pdf}" target="_blank"><i class="fas fa-download me-2 text-success"></i> {{ __('translation.Download Exam') }}</a></li>` : ''}
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
                                        ${(exam.is_available && (!exam.student_answers || exam.student_answers.length === 0)) ? `
                                        <button class="btn btn-success flex-grow-1 border-0 rounded-pill py-2 small fw-bold upload-btn" data-id="${exam.id}">
                                            <i class="fas fa-upload me-1"></i> {{ __('translation.Upload Answer') }}
                                        </button>
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

        let answersHtml = '';
        if(exam.student_answers && exam.student_answers.length > 0) {
            answersHtml = '<div class="mt-4"><h6 class="fw-bold mb-3"><i class="fas fa-history me-2"></i> {{ __("translation.Your Submissions") }}</h6><div class="list-group rounded-3">';
            exam.student_answers[0].files.forEach((file, index) => {
                answersHtml += `
                <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-light">
                    <span class="small"><i class="fas fa-file-pdf me-2 text-danger"></i> {{ __("translation.File") }} ${index + 1}</span>
                    <a href="/storage/${file.pdf}" target="_blank" class="btn btn-sm btn-outline-primary border-0 rounded-pill px-3 fw-bold">
                        <i class="fas fa-download me-1"></i> {{ __('translation.Download') }}
                    </a>
                </div>`;
            });
            answersHtml += '</div></div>';
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
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <p class="text-muted mb-0">{{ __('translation.Total Score') }}</p>
                                <p class="fw-bold mb-0 text-success">${exam.total_score}</p>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-2 bg-light rounded-3">
                                <p class="text-muted mb-0">{{ __('translation.Pass Score') }}</p>
                                <p class="fw-bold mb-0 text-primary">${exam.pass_score}</p>
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
                ${(exam.is_available && (!exam.student_answers || exam.student_answers.length === 0)) ? `
                <div class="card border-primary border-dashed bg-primary-subtle rounded-4 h-100 p-4 text-center">
                    <div class="my-auto">
                        <div class="mb-3">
                            <i class="fas fa-cloud-upload-alt fa-3x text-primary opacity-50"></i>
                        </div>
                        <h6 class="fw-bold text-primary mb-2">{{ __('translation.Upload Answer') }}</h6>
                        <p class="small text-muted mb-4">{{ __('translation.Upload your exam answer files here') }}</p>
                        <form id="uploadForm" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="exam_id" value="${exam.id}">
                            <input type="file" name="files[]" id="examFiles" class="d-none" multiple accept=".pdf,.doc,.docx,.jpg,.png,.jpeg">
                            <label for="examFiles" class="btn btn-primary rounded-pill px-4 py-2 fw-bold shadow-sm mb-3">
                                <i class="fas fa-folder-open me-2"></i> {{ __('translation.Choose Files') }}
                            </label>
                            <div id="fileList" class="mb-3 small text-start"></div>
                            <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold d-none" id="submitUpload">
                                <i class="fas fa-paper-plane me-2"></i> {{ __('translation.Submit') }}
                            </button>
                        </form>
                    </div>
                </div>
                ` : `
                <div class="card border-0 bg-light rounded-4 h-100 p-4 text-center">
                    <div class="my-auto">
                        <div class="mb-3">
                            <i class="fas fa-${(exam.student_answers && exam.student_answers.length > 0) ? 'check-circle text-success' : 'lock text-muted'} fa-3x opacity-50"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-2">
                            ${(exam.student_answers && exam.student_answers.length > 0) ? "{{ __('translation.Already Submitted') }}" : "{{ __('translation.Upload Locked') }}"}
                        </h6>
                        <p class="small text-muted mb-0">
                            ${(exam.student_answers && exam.student_answers.length > 0) ? "{{ __('translation.You have already submitted an answer for this exam') }}" : (exam.is_past ? "{{ __('translation.This exam has ended') }}" : "{{ __('translation.This exam has not started yet') }}")}
                        </p>
                        ${answersHtml}
                    </div>
                </div>
                `}
            </div>
        </div>`;
        $('#modalBody').html(body);
        $('#examModal').modal('show');

        $('#examFiles').off('change').on('change', function() {
            let files = this.files;
            let html = '';
            if(files.length > 0) {
                html = '<ul class="list-group list-group-flush">';
                for(let i=0; i<files.length; i++) {
                    html += `<li class="list-group-item bg-transparent px-0 border-light"><i class="fas fa-file-alt text-primary me-2"></i> ${files[i].name} <span class="text-muted small">(${(files[i].size / 1024).toFixed(1)} KB)</span></li>`;
                }
                html += '</ul>';
                $('#submitUpload').removeClass('d-none');
            } else {
                $('#submitUpload').addClass('d-none');
            }
            $('#fileList').html(html);
        });

        $('#uploadForm').off('submit').on('submit', function(e) {
            e.preventDefault();
            let btn = $(this).find('button[type="submit"]');
            btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> {{ __("translation.Uploading...") }}');

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('student.api.exams.upload') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: "{{ __('translation.Success') }}",
                        text: response.message,
                        confirmButtonColor: '#3f51b5',
                        confirmButtonText: "{{ __('translation.OK') }}"
                    });
                    $('#examModal').modal('hide');
                    loadExams(currentPage);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let msg = xhr.responseJSON.message || "{{ __('translation.Upload failed') }}";
                    if(errors) {
                        msg = Object.values(errors).flat().join('\n');
                    }
                    Swal.fire({
                        icon: 'error',
                        title: "{{ __('translation.Error') }}",
                        text: msg,
                        confirmButtonColor: '#f50057',
                        confirmButtonText: "{{ __('translation.OK') }}"
                    });
                    btn.prop('disabled', false).html('<i class="fas fa-paper-plane me-2"></i> {{ __("translation.Submit") }}');
                }
            });
        });
    });

    $(document).on('click', '.upload-btn', function(e) {
        e.preventDefault();
        $(this).siblings('button.view-exam').click();
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
.upload-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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
