<template>
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between align-items-center">
                    <div class="card-title">
                        <i class="bi bi-file-earmark-check me-2 text-primary"></i>
                        {{ $t('translation.Exam Answers') }}
                    </div>
                </div>
                <div class="card-body">
                    <!-- Advanced Filters Section -->
                    <div class="row mb-4 pb-3 border-bottom gy-3">
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">{{ $t('translation.Academic Year') }}</label>
                            <Select
                                v-model="filters.academic_year_id"
                                :options="filterData.academicYears"
                                optionLabel="name"
                                optionValue="id"
                                :placeholder="$t('translation.All')"
                                class="w-100"
                                @change="onYearChange"
                            />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">{{ $t('translation.Semester') }}</label>
                            <Select
                                v-model="filters.semester_id"
                                :options="filterData.semesters"
                                optionLabel="title_ar"
                                optionValue="id"
                                :placeholder="$t('translation.All')"
                                class="w-100"
                                :disabled="!filters.academic_year_id"
                                @change="applyFilters"
                            />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">{{ $t('translation.Stage') }}</label>
                            <Select
                                v-model="filters.education_stage_id"
                                :options="filterData.educationStages"
                                optionLabel="title_ar"
                                optionValue="id"
                                :placeholder="$t('translation.All')"
                                class="w-100"
                                @change="onStageChange"
                            />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">{{ $t('translation.Class') }}</label>
                            <Select
                                v-model="filters.class_id"
                                :options="filterData.schoolClasses"
                                optionLabel="name"
                                optionValue="id"
                                :placeholder="$t('translation.All')"
                                class="w-100"
                                :disabled="!filters.education_stage_id"
                                @change="applyFilters"
                            />
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-bold">{{ $t('translation.Subject') }}</label>
                            <Select
                                v-model="filters.subject_id"
                                :options="filterData.subjects"
                                optionLabel="title_ar"
                                optionValue="id"
                                :placeholder="$t('translation.All')"
                                class="w-100"
                                :disabled="!filters.education_stage_id"
                                @change="applyFilters"
                            />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label small fw-bold">{{ $t('translation.Student Search') }}</label>
                            <div class="input-group shadow-sm rounded">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="bi bi-search text-muted"></i>
                                </span>
                                <input
                                    type="text"
                                    v-model="filters.search"
                                    class="form-control border-start-0"
                                    :placeholder="$t('translation.Search by name or code')"
                                    @keyup.enter="applyFilters"
                                />
                                <button @click="applyFilters" class="btn btn-primary px-4">
                                    {{ $t('translation.Filter') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive mt-2">
                        <table class="table text-nowrap table-hover border">
                            <thead class="bg-light">
                            <tr>
                                <th scope="col" class="ps-4">#</th>
                                <th scope="col">{{ $t('translation.Student') }}</th>
                                <th scope="col">{{ $t('translation.Stage') }} / {{ $t('translation.Class') }}</th>
                                <th scope="col">{{ $t('translation.Exam') }}</th>
                                <th scope="col">{{ $t('translation.Subject') }}</th>
                                <th scope="col">{{ $t('translation.Score') }}</th>
                                <th scope="col">{{ $t('translation.Status') }}</th>
                                <th scope="col" class="text-center">{{ $t('global.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="records.length > 0">
                            <tr v-for="(item, index) in records" :key="item.id">
                                <td class="ps-4">{{ index + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm bg-primary-transparent text-primary rounded-circle me-3">
                                            {{ item.student.name.charAt(0) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ item.student.name }}</div>
                                            <small class="text-muted">{{ item.student.code }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-medium">{{ item.education_stage?.title_ar }}</div>
                                    <small class="text-muted">{{ item.school_class?.name }}</small>
                                </td>
                                <td>
                                    <div class="fw-medium text-primary">{{ item.exam.title_ar }}</div>
                                    <small class="text-muted">{{ item.exam.academic_year?.name }}</small>
                                </td>
                                <td>{{ item.exam.subject?.title_ar }}</td>
                                <td>
                                    <span class="badge bg-outline-info rounded-pill px-3 py-2">
                                        {{ item.answer_score }} / {{ item.exam.total_score }}
                                    </span>
                                </td>
                                <td>
                                    <span v-if="item.is_completed" :class="item.is_passed ? 'badge bg-success-transparent text-success' : 'badge bg-danger-transparent text-danger'" class="rounded-pill p-2 px-3 fw-bold">
                                        <i :class="item.is_passed ? 'bi bi-check-circle-fill' : 'bi bi-x-circle-fill'" class="me-1"></i>
                                        {{ item.is_passed ? $t('translation.Passed') : $t('translation.Failed') }}
                                    </span>
                                    <span v-else class="badge bg-warning-transparent text-warning rounded-pill p-2 px-3 fw-bold">
                                        <i class="bi bi-clock-history me-1"></i>
                                        {{ $t('translation.Pending') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 justify-content-center">
                                        <div class="dropdown" v-if="item.files && item.files.length > 0">
                                            <button class="btn btn-sm btn-icon btn-secondary-light rounded-circle shadow-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false" :title="$t('translation.Answer Files')">
                                                <i class="ri-download-line"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                                <li v-for="(file, index) in item.files" :key="file.id">
                                                    <a class="dropdown-item d-flex align-items-center py-2" :href="'/storage/' + file.pdf" target="_blank">
                                                        <i class="ri-file-download-line me-2 text-primary"></i>
                                                        <span class="fw-medium">{{ $t('translation.File') }} {{ index + 1 }}</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <button @click="viewDetails(item)" class="btn btn-sm btn-icon btn-primary-light rounded-circle shadow-sm" :title="$t('translation.View Details')">
                                            <i class="ri-eye-line"></i>
                                        </button>
                                        <button @click="openUpdateModal(item)" class="btn btn-sm btn-icon btn-info-light rounded-circle shadow-sm" :title="$t('translation.Update Score')">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inboxes fs-1 d-block mb-3 op-3"></i>
                                        {{ $t('global.NoDataFound') }}
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div class="d-flex justify-content-between align-items-center mt-4">
                            <p class="text-muted small mb-0">
                                {{ $t('translation.showing') }} {{ records.length }} {{ $t('translation.of') }} {{ pagination.total }} {{ $t('translation.records') }}
                            </p>
                            <Pagination
                                :data="pagination"
                                @pagination-change-page="getResults"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    <modal-user-answer-details
        v-if="detailsVisible"
        :isVisible="detailsVisible"
        :item="currentItem"
        @close="detailsVisible = false"
    />

    <modal-update-answer
        v-if="updateVisible"
        :isVisible="updateVisible"
        :item="currentItem"
        @close="updateVisible = false"
        @refresh="getResults"
    />
</template>

<script>
import adminApi from "../../../api/adminAxios";
import ModalUserAnswerDetails from "./ModalUserAnswerDetails.vue";
import ModalUpdateAnswer from "./ModalUpdateAnswer.vue";

export default {
    components: {
        ModalUserAnswerDetails,
        ModalUpdateAnswer,
    },
    data() {
        return {
            records: [],
            pagination: {},
            detailsVisible: false,
            updateVisible: false,
            currentItem: null,
            filters: {
                academic_year_id: null,
                semester_id: null,
                education_stage_id: null,
                class_id: null,
                subject_id: null,
                search: "",
            },
            filterData: {
                academicYears: [],
                semesters: [],
                educationStages: [],
                schoolClasses: [],
                subjects: [],
            },
            searchTimeout: null,
        };
    },
    async mounted() {
        await this.fetchInitialData();
        this.getResults();
    },
    methods: {
        async fetchInitialData() {
            try {
                const response = await adminApi.get("/exam-answers-data");
                this.filterData.academicYears = response.data.data.academic_years;
                this.filterData.educationStages = response.data.data.education_stages;

                // Set current year
                if (this.filterData.academicYears.length > 0) {
                    const currentYear = this.filterData.academicYears[this.filterData.academicYears.length - 1]  || this.filterData.academicYears[0];
                    this.filters.academic_year_id = currentYear.id;
                    await this.onYearChange();
                }
            } catch (error) {
                console.error("Error fetching initial data:", error);
            }
        },
        async onYearChange() {
            if (!this.filters.academic_year_id) {
                this.filterData.semesters = [];
                this.filters.semester_id = null;
                return;
            }
            try {
                const response = await adminApi.get(`/exams-semesters/${this.filters.academic_year_id}`);
                this.filterData.semesters = response.data.data;
                this.applyFilters();
            } catch (error) {
                console.error("Error fetching semesters:", error);
            }
        },
        async onStageChange() {
            if (!this.filters.education_stage_id) {
                this.filterData.subjects = [];
                this.filterData.schoolClasses = [];
                this.filters.subject_id = null;
                this.filters.class_id = null;
                return;
            }
            try {
                const response = await adminApi.get(`/exams-stage-data/${this.filters.education_stage_id}`);
                this.filterData.subjects = response.data.data.subjects;
                this.filterData.schoolClasses = response.data.data.classes;
                this.applyFilters();
            } catch (error) {
                console.error("Error fetching stage data:", error);
            }
        },
        applyFilters() {
            this.getResults(1);
        },
        async getResults(page = 1) {
            try {
                let params = `page=${page}&search=${this.filters.search}`;
                if (this.filters.academic_year_id) params += `&academic_year_id=${this.filters.academic_year_id}`;
                if (this.filters.semester_id) params += `&semester_id=${this.filters.semester_id}`;
                if (this.filters.education_stage_id) params += `&education_stage_id=${this.filters.education_stage_id}`;
                if (this.filters.class_id) params += `&class_id=${this.filters.class_id}`;
                if (this.filters.subject_id) params += `&subject_id=${this.filters.subject_id}`;

                const response = await adminApi.get(`/exam-answers?${params}`);
                this.records = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching results:", error);
            }
        },
        viewDetails(item) {
            this.currentItem = item;
            this.detailsVisible = true;
        },
        openUpdateModal(item) {
            this.currentItem = item;
            this.updateVisible = true;
        }
    },
    watch: {
        'filters.search': {
            handler(val) {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.applyFilters();
                }, 500);
            }
        }
    }
};
</script>

<style scoped>
.custom-card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border-radius: 1rem;
}
.op-3 {
    opacity: 0.3;
}
</style>
