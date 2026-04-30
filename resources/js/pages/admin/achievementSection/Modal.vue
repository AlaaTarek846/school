<template>
  <div class="modal fade" id="section-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">{{ type == 'create' ? $t('global.add') : $t('global.edit') }}</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">العنوان (عربي)</label>
              <input type="text" v-model="form.title_ar" class="form-control">
              <error-message :errors="errors" name="title_ar"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">العنوان (EN)</label>
              <input type="text" v-model="form.title_en" class="form-control">
              <error-message :errors="errors" name="title_en"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">لون الحدود</label>
              <input type="color" v-model="form.border_color" class="form-control form-control-color w-100">
              <error-message :errors="errors" name="border_color"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">لون الخلفية</label>
              <input type="color" v-model="form.background_color" class="form-control form-control-color w-100">
              <error-message :errors="errors" name="background_color"></error-message>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
          <button @click="save" type="button" class="btn btn-primary" :disabled="loading">
            <span v-if="loading" class="spinner-border spinner-border-sm me-1"></span>
            {{ $t('global.save') }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import adminApi from "../../../api/adminAxios";
import { ref, watch } from "vue";
import Swal from "sweetalert2";

export default {
  props: ['type', 'dataRow'],
  emits: ['created'],
  setup(props, { emit }) {
    const form = ref({
      title_ar: '',
      title_en: '',
      border_color: '#435ffb',
      background_color: '#ffffff'
    });
    const errors = ref({});
    const loading = ref(false);

    watch(() => props.dataRow, (newVal) => {
      if (props.type == 'edit' && newVal) {
        form.value = { ...newVal };
      } else {
        form.value = {
          title_ar: '',
          title_en: '',
          border_color: '#435ffb',
          background_color: '#ffffff'
        };
      }
    });

    const save = async () => {
      loading.value = true;
      errors.value = {};
      try {
        if (props.type == 'create') {
          await adminApi.post('achievement-sections', form.value);
        } else {
          await adminApi.put(`achievement-sections/${props.dataRow.id}`, form.value);
        }
        Swal.fire({ icon: 'success', title: 'تم الحفظ بنجاح', showConfirmButton: false, timer: 1500 });
        emit('created');
        document.querySelector('#section-modal .btn-close').click();
      } catch (error) {
        if (error.response && error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      } finally {
        loading.value = false;
      }
    };

    return { form, errors, loading, save };
  }
}
</script>
