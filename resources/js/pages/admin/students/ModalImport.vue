<template>
  <div class="modal fade" id="import-model" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="importModalLabel">{{ $t('admin.import_excel') }}</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 mb-3">
              <label class="form-label">{{ $t('admin.select_excel_file') }}</label>
              <input type="file" class="form-control" @change="onFileChange" accept=".xlsx,.xls,.csv" id="excelFileInput" />
            </div>
            <div class="col-md-12" v-if="validationErrors && validationErrors.length">
              <div class="alert alert-danger" style="max-height: 300px; overflow-y: auto;">
                <ul class="mb-0">
                  <li v-for="(error, index) in validationErrors" :key="index">{{ error }}</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
          <button type="button" class="btn btn-primary" @click="importSubmit" :disabled="loading || !file">
            <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
            {{ $t('global.Submit') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, defineEmits } from "vue";
import { useI18n } from "vue-i18n";
import adminApi from "../../../api/adminAxios";

const emit = defineEmits(['imported']);
const { t } = useI18n({});
const file = ref(null);
const loading = ref(false);
const validationErrors = ref([]);

const onFileChange = (e) => {
  file.value = e.target.files[0];
};

const importSubmit = () => {
  if (!file.value) return;

  validationErrors.value = [];
  loading.value = true;
  
  let formData = new FormData();
  formData.append('file', file.value);

  adminApi.post(`students/import`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  })
    .then((res) => {
      Swal.fire({
        icon: 'success',
        title: t('admin.imported_successfully'),
        showConfirmButton: false,
        timer: 1500
      });
      emit("imported");
      document.querySelector('#import-model .btn-close').click();
      document.getElementById('excelFileInput').value = '';
      file.value = null;
    })
    .catch((err) => {
      if (err.response?.data?.data?.errors) {
        validationErrors.value = err.response.data.data.errors;
      } else if (err.response?.data?.message) {
        validationErrors.value = [err.response.data.message];
      } else {
        validationErrors.value = [t('admin.error_occurred')];
      }
    })
    .finally(() => {
      loading.value = false;
    });
};
</script>
