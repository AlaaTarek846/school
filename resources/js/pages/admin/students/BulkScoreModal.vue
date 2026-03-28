<template>
  <div class="modal fade" id="bulk-score-model" tabindex="-1" aria-labelledby="bulkScoreModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content border-0 shadow-lg">
        <div class="modal-header bg-primary text-white">
          <h6 class="modal-title" id="bulkScoreModalLabel">
            <i class="ri-edit-2-line me-2"></i>{{ $t('translation.bulk_manage_score') }}
          </h6>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body p-4">
          <div class="table-responsive">
            <table class="table table-hover align-middle">
              <thead class="bg-light">
                <tr>
                  <th class="ps-3">{{ $t('global.name') }}</th>
                  <th>{{ $t('admin.code') }}</th>
                  <th style="width: 150px;">{{ $t('admin.total_score') }}</th>
                  <th class="text-center">{{ $t('admin.status') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="student in localStudents" :key="student.id">
                  <td class="ps-3 fw-medium">{{ student.name }}</td>
                  <td><span class="badge bg-light text-dark">{{ student.code }}</span></td>
                  <td>
                    <input type="number" class="form-control form-control-sm border-2" 
                           v-model="student.form_score" 
                           :placeholder="$t('admin.enter_score')">
                  </td>
                  <td class="text-center">
                    <div class="form-check form-switch d-inline-block">
                        <input class="form-check-input custom-switch" type="checkbox" 
                               v-model="student.form_passed" 
                               :id="'switch-' + student.id">
                        <label class="form-check-label small ms-2" :for="'switch-' + student.id">
                            {{ student.form_passed ? $t('translation.pass') : $t('translation.fail') }}
                        </label>
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-12 mt-3" v-if="errors && Object.keys(errors).length > 0">
            <div class="alert alert-danger-transparent p-2 rounded-3 border-danger border-opacity-25" v-for="(errMsg, errKey) in errors" :key="errKey">
              <i class="ri-error-warning-line me-2"></i>{{ errMsg[0] }}
            </div>
          </div>
        </div>
        <div class="modal-footer bg-light border-0">
          <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
          <button type="button" class="btn btn-primary rounded-pill px-4 shadow-sm" :disabled="loading" @click="submitBulkScore">
            <span v-if="!loading"><i class="ri-save-line me-1"></i>{{ $t('global.save') }}</span>
            <span v-else class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';
import adminApi from "../../../api/adminAxios";

const props = defineProps({
  selectedStudents: { type: Array, default: () => [] }
});

const emit = defineEmits(['updated']);

const localStudents = ref([]);
const loading = ref(false);
const errors = ref({});

watch(() => props.selectedStudents, (newVal) => {
  if (newVal) {
    localStudents.value = newVal.map(s => ({
      ...s,
      form_score: s.total_score || 0,
      form_passed: !!s.is_passed
    }));
    errors.value = {};
  }
}, { immediate: true });

const submitBulkScore = () => {
  loading.value = true;
  errors.value = {};

  const payload = {
    students: localStudents.value.map(s => ({
      id: s.id,
      total_score: s.form_score,
      is_passed: s.form_passed
    }))
  };

  adminApi.post(`students/bulk-update-score`, payload)
    .then((res) => {
      Swal.fire({
        icon: 'success',
        title: res.data.message,
        showConfirmButton: false,
        timer: 1500
      });
      emit('updated');
      // Close modal manually
      const modalElement = document.getElementById('bulk-score-model');
      const modal = bootstrap.Modal.getInstance(modalElement);
      modal.hide();
    })
    .catch((err) => {
      errors.value = err.response?.data?.errors || { message: [err.message] };
    })
    .finally(() => {
      loading.value = false;
    });
};
</script>

<style scoped>
.modal-body {
    max-height: 60vh;
    overflow-y: auto;
}
.modal-body::-webkit-scrollbar {
    width: 8px;
    display: block;
}
.modal-body::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}
.modal-body::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}
.modal-body::-webkit-scrollbar-thumb:hover {
    background: #555;
}
.custom-switch {
    width: 2.5rem;
    height: 1.25rem;
    cursor: pointer;
}
.alert-danger-transparent {
    background-color: rgba(var(--bs-danger-rgb), 0.1);
    color: var(--bs-danger);
}
.modal-header {
    border-top-left-radius: calc(0.5rem - 1px);
    border-top-right-radius: calc(0.5rem - 1px);
}
</style>
