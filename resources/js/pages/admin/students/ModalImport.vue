<template>
  <div class="modal fade" id="import-model" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-primary-transparent">
          <h6 class="modal-title fw-bold" id="importModalLabel">
            <i class="ri-file-excel-2-line me-1 align-middle"></i>
            {{ $t('admin.import_excel') }} (استيراد الطلاب من Excel)
          </h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" @click="resetForm"></button>
        </div>

        <div class="modal-body p-4">
          <!-- Download Template Card -->
          <div class="alert alert-info border-info d-flex align-items-center justify-content-between mb-4">
            <div>
              <h6 class="alert-heading fw-bold mb-1"><i class="ri-information-line me-1"></i> تحميل نموذج Excel المعياري</h6>
              <p class="mb-0 fs-12 text-muted">قم بتنزيل النموذج وتعبئته بالبيانات مع الالتزام بالتعليمات والقوائم المنسدلة المرفقة بالشيت.</p>
            </div>
            <a href="/api/students/export-template" target="_blank" class="btn btn-sm btn-info shadow-sm text-nowrap ms-2">
              <i class="ri-download-2-line me-1"></i> تحميل النموذج
            </a>
          </div>

          <!-- Step 1: File Selection -->
          <div class="mb-3">
            <label class="form-label fw-semibold">{{ $t('admin.select_excel_file') }} (اختر ملف Excel)</label>
            <input type="file" class="form-control" @change="onFileChange" accept=".xlsx,.xls,.csv" id="excelFileInput" />
          </div>

          <!-- Loader during validation / import -->
          <div v-if="loading" class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted fw-semibold">{{ step === 1 ? 'جاري فحص وتدقيق بيانات الملف...' : 'جاري حفظ بيانات الطلاب في النظام...' }}</p>
          </div>

          <!-- Step 2: Validation Results Preview -->
          <div v-if="validationSummary && !loading" class="mt-3">
            <div class="row g-2 mb-3">
              <div class="col-6">
                <div class="p-3 border rounded bg-success-transparent text-success text-center">
                  <h4 class="mb-0 fw-bold">{{ validationSummary.valid_count }}</h4>
                  <small class="fw-semibold">عدد الصفوف السليمة (جاهزة للرفع)</small>
                </div>
              </div>
              <div class="col-6">
                <div class="p-3 border rounded bg-danger-transparent text-danger text-center">
                  <h4 class="mb-0 fw-bold">{{ validationSummary.invalid_count }}</h4>
                  <small class="fw-semibold">عدد الصفوف التي تحتوي أخطاء</small>
                </div>
              </div>
            </div>

            <!-- Errors Table -->
            <div v-if="validationSummary.invalid_count > 0" class="border border-danger rounded p-3 bg-light">
              <h6 class="text-danger fw-bold mb-2"><i class="ri-error-warning-line me-1"></i> قائمة الأخطاء المكتشفة بالملف:</h6>
              <p class="text-muted fs-12 mb-2">يرجى تصحيح الأخطاء التالية في ملف Excel ثم إعادة الفحص قبل الرفع:</p>
              <div class="table-responsive" style="max-height: 250px;">
                <table class="table table-sm table-bordered table-striped mb-0">
                  <thead class="table-danger">
                    <tr>
                      <th style="width: 70px;">رقم الصف</th>
                      <th>اسم الطالب</th>
                      <th>الكود</th>
                      <th>الأخطاء</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(item, idx) in validationSummary.errors" :key="idx">
                      <td class="text-center fw-bold">{{ item.row }}</td>
                      <td>{{ item.name }}</td>
                      <td><code>{{ item.code }}</code></td>
                      <td>
                        <ul class="mb-0 ps-3 text-danger fs-12">
                          <li v-for="(err, eIdx) in item.errors" :key="eIdx">{{ err }}</li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- Success preview box -->
            <div v-else class="alert alert-success border-success text-center my-3">
              <i class="ri-checkbox-circle-line fs-24 d-block mb-1"></i>
              <strong class="d-block fs-15">جميع البيانات بالملف سليمة 100%!</strong>
              <span>جاهز لرفع {{ validationSummary.valid_count }} طالب إلى النظام.</span>
            </div>
          </div>
        </div>

        <div class="modal-footer bg-light">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" @click="resetForm">{{ $t('global.close') }}</button>
          
          <button v-if="!validationSummary && file" type="button" class="btn btn-warning fw-semibold" @click="validateFile" :disabled="loading">
            <i class="ri-search-eye-line me-1"></i> فحص الشيت والتحقق
          </button>

          <button v-if="validationSummary" type="button" class="btn btn-primary fw-semibold" @click="confirmImport" :disabled="loading || validationSummary.valid_count === 0">
            <i class="ri-check-double-line me-1"></i> تأكيد وإتمام الرفع ({{ validationSummary.valid_count }})
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
import Swal from "sweetalert2";

const emit = defineEmits(['imported']);
const { t } = useI18n({});

const file = ref(null);
const loading = ref(false);
const step = ref(1);
const validationSummary = ref(null);

const onFileChange = (e) => {
  file.value = e.target.files[0];
  validationSummary.value = null;
};

const resetForm = () => {
  file.value = null;
  validationSummary.value = null;
  step.value = 1;
  const input = document.getElementById('excelFileInput');
  if (input) input.value = '';
};

const validateFile = () => {
  if (!file.value) return;

  loading.value = true;
  step.value = 1;
  let formData = new FormData();
  formData.append('file', file.value);

  adminApi.post(`students/validate-import`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  })
    .then((res) => {
      validationSummary.value = res.data.data;
    })
    .catch((err) => {
      Swal.fire('خطأ', err.response?.data?.message || 'حدث خطأ أثناء فحص الملف', 'error');
    })
    .finally(() => {
      loading.value = false;
    });
};

const confirmImport = () => {
  if (!file.value) return;

  if (validationSummary.value && validationSummary.value.invalid_count > 0) {
    Swal.fire({
      title: 'تحذير!',
      text: `الملف يحتوي على ${validationSummary.value.invalid_count} صف به أخطاء. هل تريد الاستمرار برفع الصفوف السليمة فقط (${validationSummary.value.valid_count})؟`,
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'نعم، قم بالرفع',
      cancelButtonText: 'إلغاء وتعديل الملف'
    }).then((result) => {
      if (result.isConfirmed) {
        executeImport();
      }
    });
  } else {
    executeImport();
  }
};

const executeImport = () => {
  loading.value = true;
  step.value = 2;
  let formData = new FormData();
  formData.append('file', file.value);

  adminApi.post(`students/import`, formData, {
    headers: { 'Content-Type': 'multipart/form-data' }
  })
    .then((res) => {
      Swal.fire({
        icon: 'success',
        title: 'تم الاستوراد بنجاح',
        text: `تم إضافة الطلاب السليمة بنجاح إلى النظام.`,
        showConfirmButton: true,
      });
      emit("imported");
      document.querySelector('#import-model .btn-close').click();
      resetForm();
    })
    .catch((err) => {
      Swal.fire('خطأ', err.response?.data?.message || 'حدث خطأ أثناء استيراد الملف', 'error');
    })
    .finally(() => {
      loading.value = false;
    });
};
</script>

