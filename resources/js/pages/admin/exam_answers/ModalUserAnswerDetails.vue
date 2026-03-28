<template>
    <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-primary text-white py-3">
                    <h5 class="modal-title d-flex align-items-center fw-bold">
                        <i class="bi bi-person-badge me-2 fs-4"></i>
                        {{ $t('translation.Exam Answer Details') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" @click="$emit('close')"></button>
                </div>
                <div class="modal-body p-4 bg-light-subtle">
                    <div class="row g-4">
                        <!-- Student Section -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100 rounded-3">
                                <div class="card-body">
                                    <h6 class="text-primary fw-bold mb-3 border-bottom pb-2">
                                        {{ $t('translation.Student Info') }}
                                    </h6>
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="avatar avatar-md bg-primary text-white rounded-circle me-3">
                                            {{ item.student.name.charAt(0) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ item.student.name }}</div>
                                            <div class="text-muted small">#{{ item.student.code }}</div>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled small mb-0">
                                        <li class="mb-2"><strong>{{ $t('translation.Phone') }}:</strong> {{ item.student.phone_1 || '-' }}</li>
                                        <li class="mb-2"><strong>{{ $t('translation.Stage') }}:</strong> {{ item.education_stage?.title_ar }}</li>
                                        <li><strong>{{ $t('translation.Class') }}:</strong> {{ item.school_class?.name }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Exam Section -->
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100 rounded-3">
                                <div class="card-body">
                                    <h6 class="text-info fw-bold mb-3 border-bottom pb-2">
                                        {{ $t('translation.Exam Info') }}
                                    </h6>
                                    <h5 class="fw-bold text-dark mb-1">{{ item.exam.title_ar }}</h5>
                                    <div class="badge bg-info-transparent text-info rounded-pill mb-3">
                                        {{ item.exam.subject?.title_ar }}
                                    </div>
                                    <ul class="list-unstyled small mb-0">
                                        <li class="mb-2"><strong>{{ $t('translation.Academic Year') }}:</strong> {{ item.exam.academic_year?.name }}</li>
                                        <li class="mb-2"><strong>{{ $t('translation.Semester') }}:</strong> {{ item.exam.semester?.title_ar }}</li>
                                        <li><strong>{{ $t('translation.Total Score') }}:</strong> {{ item.exam.total_score }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Results Section -->
                        <div class="col-12 mt-4" v-if="item.is_completed">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                <div class="card-header bg-primary-transparent border-0 py-3">
                                    <h6 class="mb-0 fw-bold">
                                        {{ $t('translation.Results') }}
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-4 text-center border-end">
                                            <div class="display-5 fw-bold text-primary mb-0">{{ item.answer_score }}</div>
                                            <div class="text-muted small uppercase op-7">{{ $t('translation.Obtained Score') }}</div>
                                        </div>
                                        <div class="col-md-4 text-center border-end">
                                            <div :class="item.is_passed ? 'text-success' : 'text-danger'" class="fs-2 fw-bold mb-0">
                                                {{ item.is_passed ? $t('translation.Passed') : $t('translation.Failed') }}
                                            </div>
                                            <div class="text-muted small uppercase op-7">{{ $t('translation.Pass Status') }}</div>
                                        </div>
                                        <div class="col-md-4 text-center">
                                            <div class="fs-4 fw-bold mb-0">
                                                {{ ((item.answer_score / item.exam.total_score) * 100).toFixed(1) }}%
                                            </div>
                                            <div class="text-muted small uppercase op-7">{{ $t('translation.Percentage') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Files Section -->
                        <div class="col-12 mt-4" v-if="item.files && item.files.length > 0">
                            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                                <div class="card-header bg-light border-0 py-3">
                                    <h6 class="mb-0 fw-bold text-dark">
                                        <i class="bi bi-paperclip me-2"></i> {{ $t('translation.Answer Files') }}
                                    </h6>
                                </div>
                                <div class="card-body p-0">
                                    <div class="list-group list-group-flush">
                                        <a v-for="(file, index) in item.files" :key="file.id" :href="'/storage/' + file.pdf" target="_blank" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center p-3 border-bottom border-light">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar avatar-sm bg-primary-transparent text-primary rounded-circle me-3">
                                                    <i class="bi bi-file-earmark-pdf-fill"></i>
                                                </div>
                                                <div class="fw-bold">{{ $t('translation.File') }} {{ index + 1 }}</div>
                                            </div>
                                            <span class="btn btn-sm btn-primary-light rounded-pill px-3 shadow-sm">
                                                <i class="bi bi-download me-1"></i> {{ $t('translation.Download') }}
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Section -->
                        <div class="col-12 mt-4" v-if="item.notes">
                            <div class="alert alert-light border-0 shadow-sm rounded-3">
                                <h6 class="alert-heading fw-bold small text-muted">{{ $t('translation.Notes') }}</h6>
                                <p class="mb-0 small">{{ item.notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" @click="$emit('close')">
                        {{ $t('global.close') }}
                    </button>
                    <button type="button" class="btn btn-primary rounded-pill px-4 shadow" @click="printDetails">
                        <i class="bi bi-printer me-2"></i>
                        {{ $t('translation.Print') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        isVisible: Boolean,
        item: Object
    },
    methods: {
        printDetails() {
            window.print();
        }
    }
};
</script>

<style scoped>
.avatar-md {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    font-weight: bold;
}
.bg-primary-transparent {
    background-color: rgba(var(--primary-rgb), 0.1);
}
.bg-info-transparent {
    background-color: rgba(var(--info-rgb), 0.1);
}
.op-7 {
    opacity: 0.7;
}
</style>
