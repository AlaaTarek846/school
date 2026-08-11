<template>
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        إدارة الامتحانات
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button
                            @click="openModal()"
                            class="btn btn-primary btn-wave waves-effect waves-light"
                        >
                            <i class="bi bi-plus-circle"></i> إضافة امتحانات
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Filters Section -->
                    <div class="row mb-4 pb-3 border-bottom">
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">السنة الدراسية</label>
                            <Select
                                v-model="filters.academic_year_id"
                                :options="filterData.academicYears"
                                optionLabel="name"
                                optionValue="id"
                                placeholder="الكل"
                                class="w-100"
                                @change="onYearChange"
                            />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">الفصل الدراسي</label>
                            <Select
                                v-model="filters.semester_id"
                                :options="filterData.semesters"
                                optionLabel="title_ar"
                                optionValue="id"
                                placeholder="الكل"
                                class="w-100"
                                :disabled="!filters.academic_year_id"
                                @change="applyFilters"
                            />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">المرحلة</label>
                            <Select
                                v-model="filters.education_stage_id"
                                :options="filterData.educationStages"
                                optionLabel="title_ar"
                                optionValue="id"
                                placeholder="الكل"
                                class="w-100"
                                @change="onStageChange"
                            />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">المادة</label>
                            <Select
                                v-model="filters.subject_id"
                                :options="filterData.subjects"
                                optionLabel="title_ar"
                                optionValue="id"
                                placeholder="الكل"
                                class="w-100"
                                :disabled="!filters.education_stage_id"
                            />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">من تاريخ</label>
                            <input type="date" v-model="filters.from_date" class="form-control" @change="applyFilters" />
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="form-label small fw-bold">إلى تاريخ</label>
                            <input type="date" v-model="filters.to_date" class="form-control" @change="applyFilters" />
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="form-label small fw-bold">بحث بالاسم</label>
                            <div class="input-group">
                                <input type="text" v-model="filters.search" class="form-control" placeholder="ابحث هنا..." @keyup.enter="applyFilters" />
                                <button @click="applyFilters" class="btn btn-info">
                                    <i class="ri-filter-3-line"></i> بحث وتصفية
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">المرحلة</th>
                                <th scope="col">المادة</th>
                                <th scope="col">الفصول</th>
                                <th scope="col">السنة / الفصل</th>
                                <th scope="col">الحالة</th>
                                <th scope="col">{{ $t("global.actions") }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="records.length > 0">
                            <tr v-for="(item, index) in records" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td>
                                    <div>{{ item.title_ar }}</div>
                                    <small class="text-muted">{{ item.title_en }}</small>
                                </td>
                                <td>{{ item.education_stage ? item.education_stage.title_ar : '-' }}</td>
                                <td>{{ item.subject ? item.subject.title_ar : '-' }}</td>
                                <td>
                                    <div v-if="item.classes && item.classes.length" class="d-flex flex-wrap gap-1">
                                        <span v-for="cls in item.classes" :key="cls.id" class="badge bg-primary-transparent text-primary">{{ cls.name }}</span>
                                    </div>
                                    <span v-else class="text-muted">-</span>
                                </td>
                                <td>
                                    <div>{{ item.academic_year ? item.academic_year.name : '-' }}</div>
                                    <small class="text-info">{{ item.semester ? item.semester.title_ar : '-' }}</small>
                                </td>
                                <td>
                                    <span :class="item.is_active ? 'text-success' : 'text-danger'">
                                        {{ item.is_active ? 'نشط' : 'غير نشط' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <a v-if="item.pdf" :href="'/storage/' + item.pdf" target="_blank" class="btn btn-sm btn-primary-light btn-icon rounded-pill" :title="item.pdf">
                                            <i :class="getFileIcon(item.pdf)"></i>
                                        </a>
                                        <button @click="edit(item)" class="btn btn-info btn-sm rounded-pill">
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button @click="deleteItem(item.id)" class="btn btn-danger btn-sm rounded-pill">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="8" class="text-center">
                                    {{ $t("global.NoDataFound") }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center mt-3">
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

    <modal-create-and-update
        v-if="isVisible"
        :isVisible="isVisible"
        :item="currentItem"
        @close="closeModal"
        @refresh="getResults"
    />
</template>

<script>
import adminApi from "../../../api/adminAxios";
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import Swal from "sweetalert2";

export default {
    components: {
        ModalCreateAndUpdate,
    },
    data() {
        return {
            records: [],
            pagination: {},
            isVisible: false,
            currentItem: null,
            filters: {
                academic_year_id: null,
                semester_id: null,
                education_stage_id: null,
                subject_id: null,
                from_date: "",
                to_date: "",
                search: "",
            },
            filterData: {
                academicYears: [],
                semesters: [],
                educationStages: [],
                subjects: [],
            },
            searchTimeout: null,
        };
    },
    async mounted() {
        await this.fetchFilterData();
        this.getResults();
    },
    methods: {
        async fetchFilterData() {
            try {
                const response = await adminApi.get("/exams-data");
                this.filterData.academicYears = response.data.data.academic_years;
                this.filterData.educationStages = response.data.data.education_stages;
                
                // Set latest year as default
                if (this.filterData.academicYears.length > 0) {
                    const latestYear = [...this.filterData.academicYears].sort((a, b) => b.id - a.id)[0];
                    this.filters.academic_year_id = latestYear.id;
                    await this.onYearChange();
                }
            } catch (error) {
                console.error("Error fetching filter data:", error);
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
                this.filters.subject_id = null;
                return;
            }
            try {
                const response = await adminApi.get(`/exams-stage-data/${this.filters.education_stage_id}`);
                this.filterData.subjects = response.data.data.subjects;
                this.applyFilters();
            } catch (error) {
                console.error("Error fetching subjects:", error);
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
                if (this.filters.subject_id) params += `&subject_id=${this.filters.subject_id}`;
                if (this.filters.from_date) params += `&from_date=${this.filters.from_date}`;
                if (this.filters.to_date) params += `&to_date=${this.filters.to_date}`;

                const response = await adminApi.get(`/exams?${params}`);
                this.records = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching exams:", error);
            }
        },
        getFileIcon(file) {
            const ext = file.split('.').pop().toLowerCase();
            if (['mp4', 'mpeg', 'avi', 'mov', 'webm', 'mkv'].includes(ext)) return 'ri-video-line';
            if (['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'].includes(ext)) return 'ri-image-line';
            if (['doc', 'docx'].includes(ext)) return 'ri-file-word-line';
            return 'ri-file-pdf-line';
        },
        openModal() {
            this.currentItem = null;
            this.isVisible = true;
        },
        edit(item) {
            this.currentItem = item;
            this.isVisible = true;
        },
        closeModal() {
            this.isVisible = false;
        },
        async deleteItem(id) {
            try {
                 const result = await Swal.fire({
                    title: this.$t("global.AreYouSure"),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: this.$t("global.YesDeleteIt"),
                });

                if (result.isConfirmed) {
                    await adminApi.delete(`/exams/${id}`);
                    this.getResults();
                    Swal.fire(this.$t("global.DeletedSuccessfully"), "", "success");
                }
            } catch (error) {
                console.error("Error deleting exam:", error);
                if (error.response && error.response.status === 422) {
                    Swal.fire("تنبيه", error.response.data.message || "لا يمكن الحذف لارتباط السجل ببيانات أخرى", "warning");
                } else {
                    Swal.fire("Error", "Something went wrong", "error");
                }
            }
        },
    },
    watch: {
        'filters.search': {
            handler(val) {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.applyFilters();
                }, 500);
            }
        },
        'filters.education_stage_id': {
            handler(val) {
                this.applyFilters();
            }
        },
        'filters.subject_id': {
            handler(val) {
                this.applyFilters();
            }
        }
    }
};
</script>
