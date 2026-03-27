<template>
  <div class="modal fade" id="score-model" tabindex="-1" aria-labelledby="scoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="scoreModalLabel">
            {{ $t('admin.manage_score') }} - {{ studentData?.name }}
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">{{ $t('admin.total_score') }} <span class="text-danger">*</span></label>
              <input type="number" class="form-control" v-model="form.total_score" :placeholder="$t('admin.enter_score')">
            </div>

            <div class="col-md-12 mb-3">
              <div class="custom-toggle-switch d-flex align-items-center">
                <input id="is_passedToggle" v-model="form.is_passed" type="checkbox">
                <label for="is_passedToggle" class="label-primary"></label>
                <span class="ms-3">{{ $t('admin.is_passed') }}</span>
              </div>
            </div>
            
            <div class="col-md-12" v-if="errors && Object.keys(errors).length > 0">
              <div class="alert alert-danger p-2" v-for="(errMsg, errKey) in errors" :key="errKey">
                {{ errMsg[0] }}
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
          <button type="button" class="btn btn-primary" :disabled="loading" @click="submitScore">
            <span v-if="!loading">{{ $t('global.save') }}</span>
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
  studentData: { default: null }
});

const emit = defineEmits(['updated']);

const form = ref({
  total_score: 0,
  is_passed: false
});

const loading = ref(false);
const errors = ref({});

watch(() => props.studentData, (newVal) => {
  if (newVal) {
    form.value.total_score = newVal.total_score || 0;
    form.value.is_passed = !!newVal.is_passed;
    errors.value = {};
  }
}, { immediate: true });

const submitScore = () => {
  loading.value = true;
  errors.value = {};

  adminApi.put(`students/${props.studentData.id}/update-score`, form.value)
    .then((res) => {
      Swal.fire({
        icon: 'success',
        title: res.data.message,
        showConfirmButton: false,
        timer: 1500
      });
      emit('updated');
      // Close modal manually
      const modalElement = document.getElementById('score-model');
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
