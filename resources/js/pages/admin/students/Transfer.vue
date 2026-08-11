<template>
  <div class="container-fluid">
    <loader v-if="loading" />

    <div class="row">
      <div class="col-xl-12">
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="card-title">
              {{ $t('translation.student_transfer') }}
            </div>
            <div class="d-flex gap-2">
                <button v-if="selectedIds.length > 0" class="btn btn-danger btn-wave" @click="deleteSelectedStudents">
                    <i class="ri-delete-bin-line align-middle me-1"></i>
                    {{ $t('label.delete all') }}
                    <span class="badge bg-white text-danger ms-1">{{ selectedIds.length }}</span>
                </button>
                <button v-if="selectedIds.length > 0" class="btn btn-primary btn-wave" data-bs-toggle="modal" data-bs-target="#transfer-modal">
                    <i class="ri-arrow-left-right-line align-middle me-1"></i>
                    {{ $t('translation.transfer_selected') }}
                    <span class="badge bg-white text-primary ms-1">{{ selectedIds.length }}</span>
                </button>
            </div>
          </div>
          <div class="card-body">
            <!-- Filters -->
            <div class="row mb-4 g-3 align-items-end">
              <div class="col-md-3">
                <label class="form-label fw-bold">{{ $t('admin.academic_year') }}</label>
                <select class="form-select" v-model="filters.academic_year_id" @change="handleYearChange">
                  <option value="">{{ $t('translation.select') }}</option>
                  <option v-for="year in academicYears" :key="year.id" :value="year.id">
                    {{ year.name }}
                  </option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-bold">{{ $t('admin.education_stage') }}</label>
                <select class="form-select" v-model="filters.education_stage_id" @change="handleStageChange">
                  <option value="">{{ $t('translation.select') }}</option>
                  <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">
                    {{ $i18n.locale == 'ar' ? stage.title_ar : stage.title_en }}
                  </option>
                </select>
              </div>
              <div class="col-md-3">
                <label class="form-label fw-bold">{{ $t('admin.school_class') }}</label>
                <select class="form-select" v-model="filters.school_class_id" @change="fetchStudents">
                  <option value="">{{ $t('global.all') }}</option>
                  <option v-for="cls in schoolClasses" :key="cls.id" :value="cls.id">
                    {{ cls.name }}
                  </option>
                </select>
              </div>
              <!-- <div class="col-md-2">
                <label class="form-label fw-bold">{{ $t('admin.semester') }}</label>
                <select class="form-select" v-model="filters.semester_id" @change="fetchStudents">
                  <option value="">{{ $t('global.all') }}</option>
                  <option v-for="sem in semesters" :key="sem.id" :value="sem.id">
                    {{ $i18n.locale == 'ar' ? sem.title_ar : sem.title_en }}
                  </option>
                </select>
              </div> -->
              <div class="col-md-3">
                <button class="btn btn-secondary w-100" @click="resetFilters">
                    <i class="ri-refresh-line align-middle me-1"></i>
                    {{ $t('translation.Reset') }}
                </button>
              </div>
            </div>

            <!-- Students Table -->
            <div class="table-responsive" v-if="students.length > 0">
              <table class="table table-bordered text-nowrap table-hover border-primary">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px;">
                      <input class="form-check-input" type="checkbox" @change="toggleSelectAll" :checked="isAllSelected">
                    </th>
                    <th scope="col">{{ $t('global.name') }}</th>
                    <th scope="col">{{ $t('admin.code') }}</th>
                    <th scope="col">{{ $t('admin.school_class') }}</th>

                  </tr>
                </thead>
                <tbody>
                  <tr v-for="student in students" :key="student.id" :class="{'table-info-transparent': selectedIds.includes(student.id)}">
                    <td>
                      <input class="form-check-input" type="checkbox" :value="student.id" v-model="selectedIds" :disabled="student.final_status === false">
                    </td>
                    <td class="fw-semibold">{{ student.name }}</td>
                    <td><span class="badge bg-outline-primary">{{ student.code }}</span></td>
                    <td>{{ student.current_class }}</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div v-else-if="!loading && filters.academic_year_id && filters.education_stage_id" class="text-center py-5">
                <div class="mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="text-muted opacity-50">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                        <line x1="9" y1="9" x2="15" y2="15"></line>
                        <line x1="15" y1="9" x2="9" y2="15"></line>
                    </svg>
                </div>
                <p class="text-muted fs-16">{{ $t('global.NoDataFound') }}</p>
            </div>
            <div v-else-if="!loading" class="text-center py-5">
                <div class="alert alert-custom-info">
                    <i class="ri-information-line me-2"></i>
                    {{ $i18n.locale == 'ar' ? 'يرجى اختيار العام الدراسي والمرحلة للبدء' : 'Please select academic year and stage to begin' }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Transfer Modal -->
    <div class="modal fade" id="transfer-modal" tabindex="-1" aria-hidden="true" ref="transferModalRef">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-lg border-0">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title">{{ $t('translation.select_target') }}</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body p-4">
            <div class="alert alert-warning-transparent d-flex align-items-center mb-4">
                <i class="ri-alert-fill fs-4 me-2"></i>
                <div>
                    {{ $t('translation.selected_students') }}: <strong>{{ selectedIds.length }}</strong>
                </div>
            </div>

            <form @submit.prevent="executeTransfer">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label fw-bold">{{ $t('admin.academic_year') }}</label>
                  <select class="form-select" v-model="target.academic_year_id" @change="handleTargetYearChange" required>
                    <option value="">{{ $t('translation.select') }}</option>
                    <option v-for="year in academicYears" :key="year.id" :value="year.id">
                      {{ year.name }}
                    </option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">{{ $t('admin.semester') }}</label>
                  <select class="form-select" v-model="target.semester_id" required>
                    <option value="">{{ $t('translation.select') }}</option>
                    <option v-for="sem in targetSemesters" :key="sem.id" :value="sem.id">
                      {{ $i18n.locale == 'ar' ? sem.title_ar : sem.title_en }}
                    </option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">{{ $t('admin.education_stage') }}</label>
                  <select class="form-select" v-model="target.education_stage_id" @change="handleTargetStageChange" required>
                    <option value="">{{ $t('translation.select') }}</option>
                    <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">
                      {{ $i18n.locale == 'ar' ? stage.title_ar : stage.title_en }}
                    </option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label fw-bold">{{ $t('admin.school_class') }}</label>
                  <select class="form-select" v-model="target.school_class_id" required>
                    <option value="">{{ $t('translation.select') }}</option>
                    <option v-for="cls in targetClasses" :key="cls.id" :value="cls.id">
                      {{ cls.name }}
                    </option>
                  </select>
                </div>
              </div>

              <div class="mt-4">
                <button type="submit" class="btn btn-primary w-100 py-2 d-flex align-items-center justify-content-center" :disabled="submitting">
                  <span v-if="submitting" class="spinner-border spinner-border-sm me-2" role="status"></span>
                  <i v-else class="ri-check-line me-1"></i>
                  {{ $t('translation.transfer_selected') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Swal from "sweetalert2";
import adminApi from "../../../api/adminAxios";

export default {
  name: "student-transfer-page",
  data() {
    return {
      loading: false,
      submitting: false,
      students: [],
      yearSemesters: [],
      academicYears: [],
      educationStages: [],
      semesters: [],
      schoolClasses: [],
      filters: {
        academic_year_id: '',
        education_stage_id: '',
        school_class_id: '',
        semester_id: ''
      },
      selectedIds: [],
      target: {
        academic_year_id: '',
        education_stage_id: '',
        semester_id: '',
        school_class_id: ''
      },
      targetSemesters: [],
      targetClasses: []
    };
  },
  computed: {
    isAllSelected() {
      const selectable = this.students.filter(s => s.final_status !== false);
      return selectable.length > 0 && this.selectedIds.length === selectable.length;
    }
  },
  mounted() {
    this.getInitialData();
  },
  methods: {
    async getInitialData() {
      this.loading = true;
      try {
        const response = await adminApi.get('students/form-data');
        this.academicYears = response.data.data.academicYears;
        this.educationStages = response.data.data.educationStages;

        // Auto-select latest year if exists
        if (this.academicYears.length > 0) {
            // Assuming latest is the one with highest ID or marked as default if exists
            this.target.academic_year_id = this.academicYears[this.academicYears.length - 1].id;
            this.handleTargetYearChange();
        }
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    async handleYearChange() {
      if (!this.filters.academic_year_id) {
        this.semesters = [];
        this.students = [];
        return;
      }
      try {
        const response = await adminApi.get(`students/get-semesters/${this.filters.academic_year_id}`);
        this.semesters = response.data.data;
        this.fetchStudents();
      } catch (error) {
        console.error(error);
      }
    },
    async handleStageChange() {
        this.filters.school_class_id = '';
        if (!this.filters.education_stage_id) {
            this.schoolClasses = [];
            this.students = [];
            return;
        }
        try {
            const response = await adminApi.get(`students/get-classes/${this.filters.education_stage_id}`);
            this.schoolClasses = response.data.data;
            this.fetchStudents();
        } catch (error) {
            console.error(error);
        }
    },
    async fetchStudents() {
      if (!this.filters.academic_year_id || !this.filters.education_stage_id) return;

      this.loading = true;
      this.selectedIds = [];
      try {
        const response = await adminApi.get('students-transfer-data', { params: this.filters });
        this.students = response.data.data.students;
        this.yearSemesters = response.data.data.semesters;
      } catch (error) {
        console.error(error);
      } finally {
        this.loading = false;
      }
    },
    resetFilters() {
        this.filters = {
            academic_year_id: '',
            education_stage_id: '',
            semester_id: ''
        };
        this.students = [];
    },
    toggleSelectAll() {
      if (this.isAllSelected) {
        this.selectedIds = [];
      } else {
        this.selectedIds = this.students
          .filter(s => s.final_status !== false)
          .map(s => s.id);
      }
    },
    async handleTargetYearChange() {
      if (!this.target.academic_year_id) {
        this.targetSemesters = [];
        return;
      }
      const response = await adminApi.get(`students/get-semesters/${this.target.academic_year_id}`);
      this.targetSemesters = response.data.data;
      if (this.targetSemesters.length > 0) {
          this.target.semester_id = this.targetSemesters[0].id;
      }
    },
    async handleTargetStageChange() {
      if (!this.target.education_stage_id) {
        this.targetClasses = [];
        return;
      }
      const response = await adminApi.get(`students/get-classes/${this.target.education_stage_id}`);
      this.targetClasses = response.data.data;
      if (this.targetClasses.length > 0) {
          this.target.school_class_id = this.targetClasses[0].id;
      }
    },
    async deleteSelectedStudents() {
      if (this.selectedIds.length === 0) return;

      const result = await Swal.fire({
        icon: 'warning',
        title: this.$t('global.AreYouSure'),
        text: this.$t('global.YouWontBeAbleToRevertThis'),
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: this.$t('global.YesDeleteIt'),
      });

      if (!result.isConfirmed) return;

      this.submitting = true;
      try {
        await adminApi.post('students-transfer-delete', {
          student_ids: this.selectedIds
        });

        Swal.fire(
          this.$t('global.Deleted'),
          this.$t('global.YourFileHasBeenDeleted'),
          'success'
        );

        this.selectedIds = [];
        this.fetchStudents();
      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: error.response?.data?.message || 'Something went wrong'
        });
      } finally {
        this.submitting = false;
      }
    },
    async executeTransfer() {
      if (this.selectedIds.length === 0) return;

      this.submitting = true;
      try {
        await adminApi.post('students-transfer-execute', {
          student_ids: this.selectedIds,
          ...this.target
        });

        Swal.fire({
          icon: 'success',
          title: this.$t('translation.transfer_success'),
          showConfirmButton: false,
          timer: 1500
        });

        this.resetFilters();

        // Refresh list
        this.fetchStudents();

        // Close modal
        const modalEl = document.getElementById('transfer-modal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

      } catch (error) {
        console.error(error);
        Swal.fire({
          icon: 'error',
          title: 'Error',
          text: error.response?.data?.message || 'Something went wrong'
        });
      } finally {
        this.submitting = false;
      }
    }
  }
};
</script>

<style scoped>
.table-hover tbody tr:hover {
    background-color: rgba(var(--primary-rgb), 0.05);
}
.alert-custom-info {
    border-right: 4px solid var(--primary);
    background: rgba(var(--primary-rgb), 0.1);
    color: var(--primary);
}
[dir="rtl"] .alert-custom-info {
    border-right: 4px solid var(--primary);
    border-left: 0;
}
.italic {
    font-style: italic;
}
</style>
