@extends('layout.student.master')

@section('title', __('translation.Exam Results'))

@push('css')
<style>
    .card-filter {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
    }
    .table-container {
        border-radius: 15px;
        overflow: hidden;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        background: #fff;
    }
    .table thead th {
        background-color: #f8f9fa;
        border-bottom: 2px solid #eee;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
        color: #777;
        padding: 1.25rem 1rem;
    }
    .table tbody td {
        padding: 1.25rem 1rem;
        vertical-align: middle;
        border-bottom: 1px solid #f1f1f1;
    }
    .status-badge {
        padding: 6px 15px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.75rem;
    }
    .badge-passed { background-color: #e8f5e9; color: #2e7d32; }
    .badge-failed { background-color: #ffebee; color: #c62828; }
    .badge-pending { background-color: #fff3e0; color: #ef6c00; }
    
    .hover-row:hover {
        background-color: #fcfcfc;
    }
    .btn-view {
        width: 35px;
        height: 35px;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        transition: all 0.2s;
    }
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    [dir="rtl"] .breadcrumb-item + .breadcrumb-item::before {
        float: right;
        padding-right: 0;
        padding-left: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4 animate__animated animate__fadeInDown">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-dark mb-1">{{ __('translation.Exam Results') }}</h3>
                <p class="text-muted small mb-0">{{ __('translation.welcome_student') }} {{ $student->name }}</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('student.dashboard') }}" class="text-decoration-none">{{ __('translation.main') }}</a>
                    </li>
                    <li class="breadcrumb-item active">{{ __('translation.Exam Results') }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3 mb-4">
            <div class="card card-filter p-4 sticky-top animate__animated animate__fadeInLeft" style="top: 20px;">
                <h5 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="fas fa-filter text-primary me-2"></i>
                    {{ __('translation.Filters') }}
                </h5>
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

                    <button type="submit" class="btn btn-primary w-100 rounded-pill py-2 fw-bold mt-4 shadow-sm">
                        <i class="fas fa-search me-2"></i> {{ __('translation.Search') }}
                    </button>
                </form>
            </div>
        </div>

        <!-- Results Content -->
        <div class="col-lg-9 h-100 animate__animated animate__fadeInUp">
            <div class="table-container p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>{{ __('translation.Subject') }}</th>
                                <th>{{ __('translation.Exams') }}</th>
                                <th>{{ __('translation.Submission Date') }}</th>
                                <th>{{ __('translation.Score') }}</th>
                                <th>{{ __('translation.Status') }}</th>
                                <th>{{ __('translation.Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody id="resultsContainer">
                            <!-- Data loaded via AJAX -->
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="spinner-border text-primary" role="status"></div>
                                    <p class="mt-2 text-muted">{{ __('translation.Loading exams...') }}</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
            <!-- Pagination -->
            <div id="paginationContainer" class="mt-4 d-flex justify-content-center"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="examTitle">{{ __('translation.Submission Details') }}</h5>
                <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="modalContent">
                <!-- Content via JS -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    let currentPage = 1;
    let currentResults = [];

    $(document).ready(function() {
        loadResults();

        $('#filterForm').on('submit', function(e) {
            e.preventDefault();
            currentPage = 1;
            loadResults();
        });
    });

    function loadResults(page = 1) {
        let formData = $('#filterForm').serialize();
        $('#resultsContainer').html(`
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="spinner-border text-primary" role="status"></div>
                    <p class="mt-2 text-muted">{{ __('translation.Loading exams...') }}</p>
                </td>
            </tr>
        `);

        $.ajax({
            url: "{{ route('student.api.exams.results') }}?page=" + page,
            type: "GET",
            data: formData,
            success: function(response) {
                currentResults = response.data;
                renderResults(response.data);
                renderPagination(response.pagination);
            },
            error: function() {
                $('#resultsContainer').html('<tr><td colspan="6" class="text-center py-5 text-danger font-bold">{{ __('translation.Something went wrong') }}</td></tr>');
            }
        });
    }

    function renderResults(results) {
        if (results.length === 0) {
            $('#resultsContainer').html('<tr><td colspan="6" class="text-center py-5 text-muted"><i class="fas fa-folder-open fa-3x mb-3"></i><p>{{ __("translation.No results found") }}</p></td></tr>');
            return;
        }

        let html = '';
        let locale = "{{ app()->getLocale() }}";

        results.forEach(res => {
            let examTitle = locale === 'ar' ? res.exam.title_ar : res.exam.title_en;
            let subjectName = locale === 'ar' ? (res.exam.subject ? res.exam.subject.title_ar : '') : (res.exam.subject ? res.exam.subject.title_en : '');
            let date = new Date(res.created_at).toLocaleDateString(locale === 'ar' ? 'ar-EG' : 'en-US', {
                year: 'numeric', month: 'short', day: 'numeric'
            });

            let statusHtml = '';
            let scoreHtml = '---';

            if (res.is_completed) {
                if (res.is_passed) {
                    statusHtml = `<span class="status-badge badge-passed"><i class="fas fa-check-circle me-1"></i> {{ __('translation.Passed') }}</span>`;
                } else {
                    statusHtml = `<span class="status-badge badge-failed"><i class="fas fa-times-circle me-1"></i> {{ __('translation.Failed') }}</span>`;
                }
                scoreHtml = `<span class="fw-bold text-dark">${res.answer_score}</span> / <span class="small text-muted">${res.exam.total_score}</span>`;
            } else {
                statusHtml = `<span class="status-badge badge-pending"><i class="fas fa-clock me-1"></i> {{ __('translation.Under Review') }}</span>`;
            }

            html += `
                <tr class="hover-row">
                    <td class="fw-bold text-primary">${subjectName}</td>
                    <td>${examTitle}</td>
                    <td class="text-muted small">${date}</td>
                    <td>${scoreHtml}</td>
                    <td>${statusHtml}</td>
                    <td>
                        <button class="btn btn-view btn-outline-primary border-light shadow-none view-btn" data-id="${res.id}">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            `;
        });

        $('#resultsContainer').html(html);
        
        $('.view-btn').on('click', function() {
            let id = $(this).data('id');
            showDetails(id);
        });
    }

    function renderPagination(pagination) {
        if (!pagination || pagination.total_pages <= 1) {
            $('#paginationContainer').html('');
            return;
        }

        let html = '<nav><ul class="pagination pagination-sm">';
        
        // Prev
        html += `<li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
            <a class="page-link rounded-circle mx-1 border-0 shadow-sm" href="javascript:void(0)" onclick="loadResults(${pagination.current_page - 1})">
                <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }}"></i>
            </a>
        </li>`;

        for (let i = 1; i <= pagination.total_pages; i++) {
            if (i === 1 || i === pagination.total_pages || (i >= pagination.current_page - 1 && i <= pagination.current_page + 1)) {
                html += `<li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                    <a class="page-link rounded-circle mx-1 border-0 shadow-sm ${i === pagination.current_page ? 'bg-primary' : 'bg-white text-dark'}" href="javascript:void(0)" onclick="loadResults(${i})">${i}</a>
                </li>`;
            } else if (i === pagination.current_page - 2 || i === pagination.current_page + 2) {
                html += `<li class="page-item disabled"><span class="page-link border-0 bg-transparent">...</span></li>`;
            }
        }

        // Next
        html += `<li class="page-item ${pagination.current_page === pagination.total_pages ? 'disabled' : ''}">
            <a class="page-link rounded-circle mx-1 border-0 shadow-sm" href="javascript:void(0)" onclick="loadResults(${pagination.current_page + 1})">
                <i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }}"></i>
            </a>
        </li>`;

        html += '</ul></nav>';
        $('#paginationContainer').html(html);
    }

    function showDetails(id) {
        let result = currentResults.find(r => r.id == id);
        if (!result) return;
        
        let locale = "{{ app()->getLocale() }}";
        let examTitle = locale === 'ar' ? result.exam.title_ar : result.exam.title_en;
        
        let filesHtml = '';
        if (result.files && result.files.length > 0) {
            filesHtml = '<div class="mt-4"><h6 class="fw-bold mb-3"><i class="fas fa-paperclip me-2"></i> {{ __("translation.Upload Files") }}</h6><div class="list-group rounded-3">';
            result.files.forEach((file, index) => {
                filesHtml += `
                <div class="list-group-item d-flex justify-content-between align-items-center py-3 border-light bg-light-subtle">
                    <span class="small fw-bold"><i class="fas fa-file-pdf me-2 text-danger"></i> {{ __("translation.File") }} ${index + 1}</span>
                    <a href="/storage/${file.pdf}" target="_blank" class="btn btn-sm btn-primary rounded-pill px-3 shadow-none">
                        <i class="fas fa-download me-1"></i> {{ __('translation.Download') }}
                    </a>
                </div>`;
            });
            filesHtml += '</div></div>';
        }

        let html = `
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <div class="small text-muted mb-1">{{ __('translation.Exams') }}</div>
                        <div class="fw-bold text-dark h6 mb-3">${examTitle}</div>
                        
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="small text-muted mb-1">{{ __('translation.Score') }}</div>
                                <div class="fw-bold text-primary">${result.is_completed ? result.answer_score + ' / ' + result.exam.total_score : '---'}</div>
                            </div>
                            <div class="col-6">
                                <div class="small text-muted mb-1">{{ __('translation.Result') }}</div>
                                <div class="fw-bold">${result.is_completed ? (result.is_passed ? '<span class="text-success">{{ __("translation.Passed") }}</span>' : '<span class="text-danger">{{ __("translation.Failed") }}</span>') : '<span class="text-warning">{{ __("translation.Under Review") }}</span>'}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-3 bg-light rounded-3 h-100">
                        <div class="small text-muted mb-1">{{ __('translation.Notes') }}</div>
                        <div class="text-dark small" style="white-space: pre-line;">${result.notes || '{{ __("translation.No notes provided") }}'}</div>
                    </div>
                </div>
            </div>
            ${filesHtml}
        `;

        $('#examTitle').text(examTitle);
        $('#modalContent').html(html);
        $('#detailModal').modal('show');
    }
</script>
@endpush
