<template>
    <div class="row">
        <!-- Filters Area -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm rounded-4 overlay-container overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="p-2 bg-primary-transparent rounded-3 mx-2">
                            <i class="fas fa-filter text-primary fs-4"></i>
                        </div>
                        <h5 class="mb-0 fw-bold">{{ $t('translation.Filter Statistics') }}</h5>
                    </div>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">{{ $t('translation.Academic Year') }}</label>
                            <Select v-model="filters.academic_year_id" :options="academicYears" optionLabel="name" optionValue="id" :placeholder="$t('translation.Select Academic Year')" class="w-100 rounded-pill border-light-subtle shadow-sm" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">{{ $t('translation.Semester') }}</label>
                            <Select v-model="filters.semester_id" :options="semesters" optionLabel="title_ar" optionValue="id" :placeholder="$t('translation.Select Semester')" class="w-100 rounded-pill border-light-subtle shadow-sm" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold text-muted">{{ $t('translation.Subject') }}</label>
                            <Select v-model="filters.subject_id" :options="subjects" optionLabel="title_ar" optionValue="id" :placeholder="$t('translation.Select Subject')" class="w-100 rounded-pill border-light-subtle shadow-sm" :loading="loading" />
                        </div>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <button @click="resetFilters" class="btn btn-sm btn-light rounded-pill px-4 me-2">
                             <i class="fas fa-undo me-1"></i> {{ $t('translation.Reset') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 stat-card-hover overflow-hidden transition-all">
                <div class="card-body p-4 d-flex flex-column justify-content-between position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="fas fa-book-open display-4"></i>
                    </div>
                    <div>
                        <div class="avatar avatar-md bg-primary-transparent text-primary rounded-3 mb-3">
                            <i class="fas fa-book-open fs-4"></i>
                        </div>
                        <h6 class="text-muted small fw-bold mb-1">{{ $t('translation.Total Exams') }}</h6>
                        <h3 class="fw-bold mb-0">{{ stats.total_exams }}</h3>
                    </div>
                    <div class="mt-3">
                        <div class="progress rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-primary rounded-pill w-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 stat-card-hover overflow-hidden transition-all">
                <div class="card-body p-4 d-flex flex-column justify-content-between position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="fas fa-check-circle display-4 text-success"></i>
                    </div>
                    <div>
                        <div class="avatar avatar-md bg-success-transparent text-success rounded-3 mb-3">
                            <i class="fas fa-check-circle fs-4"></i>
                        </div>
                        <h6 class="text-muted small fw-bold mb-1">{{ $t('translation.Exams Passed') }}</h6>
                        <h3 class="fw-bold mb-0">{{ stats.passed_exams }}</h3>
                    </div>
                    <div class="mt-3">
                        <div class="progress rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-success rounded-pill" :style="{ width: getPercentage(stats.passed_exams, stats.total_exams) + '%' }"></div>
                        </div>
                        <div class="small text-success mt-1 fw-bold">{{ getPercentage(stats.passed_exams, stats.total_exams) }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 stat-card-hover overflow-hidden transition-all">
                <div class="card-body p-4 d-flex flex-column justify-content-between position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-10">
                        <i class="fas fa-times-circle display-4 text-danger"></i>
                    </div>
                    <div>
                        <div class="avatar avatar-md bg-danger-transparent text-danger rounded-3 mb-3">
                            <i class="fas fa-times-circle fs-4"></i>
                        </div>
                        <h6 class="text-muted small fw-bold mb-1">{{ $t('translation.Exams Failed') }}</h6>
                        <h3 class="fw-bold mb-0">{{ stats.failed_exams }}</h3>
                    </div>
                    <div class="mt-3">
                        <div class="progress rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-danger rounded-pill" :style="{ width: getPercentage(stats.failed_exams, stats.total_exams) + '%' }"></div>
                        </div>
                        <div class="small text-danger mt-1 fw-bold">{{ getPercentage(stats.failed_exams, stats.total_exams) }}%</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 stat-card-hover overflow-hidden transition-all bg-gradient-info text-white">
                <div class="card-body p-4 d-flex flex-column justify-content-between position-relative">
                    <div class="position-absolute top-0 end-0 p-3 opacity-20 text-white">
                        <i class="fas fa-chart-line display-4"></i>
                    </div>
                    <div>
                        <div class="avatar avatar-md bg-white-transparent text-white rounded-3 mb-3 border border-white border-opacity-25">
                            <i class="fas fa-chart-line fs-4"></i>
                        </div>
                        <h6 class="text-white-50 small fw-bold mb-1">{{ $t('translation.Average Score') }}</h6>
                        <h3 class="fw-bold mb-1">{{ stats.average_score }}%</h3>
                    </div>
                    <div class="mt-3">
                        <div class="progress bg-white-transparent rounded-pill" style="height: 6px;">
                            <div class="progress-bar bg-white rounded-pill" :style="{ width: stats.average_score + '%' }"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Results -->
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center px-4">
                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                        <i class="fas fa-history text-primary mx-2"></i> {{ $t('translation.Recent Results') }}
                    </h5>
                </div>
                <div class="card-body p-0">
                    <div v-if="loading" class="text-center py-5">
                       <loader />
                    </div>
                    <div v-else-if="stats.recent_results.length === 0" class="text-center py-5">
                        <div class="empty-state">
                            <i class="fas fa-folder-open display-1 text-muted opacity-25"></i>
                            <p class="text-muted mt-3">{{ $t('translation.No records found') }}</p>
                        </div>
                    </div>
                    <div v-else class="table-responsive">
                        <table class="table table-hover align-middle mb-0 custom-dashboard-table">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3">{{ $t('translation.Exam') }}</th>
                                    <th class="py-3 text-center">{{ $t('translation.Subject') }}</th>
                                    <th class="py-3 text-center">{{ $t('translation.Score') }}</th>
                                    <th class="py-3 text-center">{{ $t('translation.Status') }}</th>
                                    <th class="pe-4 py-3 text-end">{{ $t('translation.Date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="result in stats.recent_results" :key="result.id">
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ result.exam.title_ar }}</div>
                                        <div class="small text-muted">{{ result.exam.academic_year.name }} - {{ result.exam.semester.title_ar }}</div>
                                    </td>
                                    <td class="text-center">
                                       <span class="badge bg-primary-transparent text-primary rounded-pill px-3 fw-medium">
                                           {{ result.exam.subject.title_ar }}
                                       </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="fw-bold fs-5" :class="result.is_passed ? 'text-success' : 'text-danger'">
                                            {{ result.answer_score }} / {{ result.exam.total_score }}
                                        </div>
                                        <div class="progress mt-1 mx-auto" style="height: 4px; width: 60px;">
                                            <div class="progress-bar" :class="result.is_passed ? 'bg-success' : 'bg-danger'" :style="{ width: (result.answer_score / result.exam.total_score * 100) + '%' }"></div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span v-if="result.is_passed" class="badge bg-success-light text-success rounded-pill px-3">
                                            <i class="fas fa-check-circle me-1"></i> {{ $t('translation.Passed') }}
                                        </span>
                                        <span v-else class="badge bg-danger-light text-danger rounded-pill px-3">
                                            <i class="fas fa-times-circle me-1"></i> {{ $t('translation.Failed') }}
                                        </span>
                                    </td>
                                    <td class="pe-4 text-end text-muted small">
                                        {{ formatDate(result.created_at) }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        academicYears: Array,
        semesters: Array,
        subjects: Array
    },
    data() {
        return {
            loading: false,
            filters: {
                academic_year_id: null,
                semester_id: null,
                subject_id: null
            },
            stats: {
                total_exams: 0,
                passed_exams: 0,
                failed_exams: 0,
                average_score: 0,
                recent_results: []
            }
        };
    },
    watch: {
        filters: {
            handler() {
                this.fetchStatistics();
            },
            deep: true
        }
    },
    mounted() {
        this.fetchStatistics();
    },
    methods: {
        async fetchStatistics() {
            this.loading = true;
            try {
                const response = await axios.get('/student/api/dashboard-statistics', {
                    params: this.filters
                });
                if (response.status === 200) {
                    this.stats = response.data.data;
                }
            } catch (error) {
                console.error("Error fetching statistics:", error);
            } finally {
                this.loading = false;
            }
        },
        resetFilters() {
            this.filters = {
                academic_year_id: null,
                semester_id: null,
                subject_id: null
            };
        },
        getPercentage(value, total) {
            if (!total) return 0;
            return Math.round((value / total) * 100);
        },
        formatDate(dateStr) {
            if (!dateStr) return "-";
            const date = new Date(dateStr);
            return date.toLocaleDateString('ar-EG', { year: 'numeric', month: 'short', day: 'numeric' });
        }
    }
};
</script>

<style scoped>
.bg-primary-transparent { background-color: rgba(var(--bs-primary-rgb), 0.1); }
.bg-success-transparent { background-color: rgba(var(--bs-success-rgb), 0.1); }
.bg-danger-transparent { background-color: rgba(var(--bs-danger-rgb), 0.1); }
.bg-white-transparent { background-color: rgba(255, 255, 255, 0.2); }
.bg-success-light { background-color: #e8f5e9; }
.bg-danger-light { background-color: #ffebee; }
.bg-gradient-info { background: linear-gradient(45deg, #0dcaf0, #0aa2c0); }
.opacity-10 { opacity: 0.1; }
.opacity-20 { opacity: 0.2; }

.stat-card-hover:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 2rem rgba(0,0,0,0.1) !important;
}

.custom-dashboard-table thead th {
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-weight: 700;
}

.custom-dashboard-table tbody tr {
    transition: all 0.2s;
}

.avatar-md {
    width: 45px;
    height: 45px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.transition-all { transition: all 0.3s ease; }
</style>
