<template>
  <div class="modal fade" id="pride-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title">تعديل فخر المدرسة</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" v-if="form">
          <div class="row g-3">
            <div class="col-md-12" v-if="form.card_type == 'left'">
              <label class="form-label">الصورة</label>
              <input type="file" @change="handleFileUpload" class="form-control" accept="image/*">
              <div v-if="form.image" class="mt-2">
                 <img :src="imagePreview || form.image" style="height: 100px; border-radius: 8px;">
              </div>
            </div>
            <div class="col-md-6" v-if="form.card_type == 'left'">
              <label class="form-label">أيقونة التراكب (Overlay Icon)</label>
              <Select v-model="form.overlay_icon" :options="icons" optionLabel="name" optionValue="id" class="w-100" filter placeholder="اختر أيقونة">
                  <template #option="slotProps">
                      <div class="d-flex align-items-center">
                          <i class="me-2 fs-18" :class="slotProps.option.id"></i>
                          <span>{{ slotProps.option.name }}</span>
                      </div>
                  </template>
                  <template #value="slotProps">
                      <div v-if="slotProps.value" class="d-flex align-items-center">
                          <i class="me-2 fs-18" :class="slotProps.value"></i>
                          <span>{{ icons.find(i => i.id == slotProps.value)?.name }}</span>
                      </div>
                      <span v-else>{{ slotProps.placeholder }}</span>
                  </template>
              </Select>
            </div>
            <div class="col-md-6" v-if="form.card_type == 'left'">
              <label class="form-label">نص التراكب (عربي)</label>
              <input type="text" v-model="form.overlay_text_ar" class="form-control">
              <error-message :errors="errors" name="overlay_text_ar"></error-message>
            </div>
            
            <div class="col-md-6" v-if="form.card_type == 'right'">
              <label class="form-label">الأيقونة</label>
              <Select v-model="form.icon" :options="icons" optionLabel="name" optionValue="id" class="w-100" filter placeholder="اختر أيقونة">
                  <template #option="slotProps">
                      <div class="d-flex align-items-center">
                          <i class="me-2 fs-18" :class="slotProps.option.id"></i>
                          <span>{{ slotProps.option.name }}</span>
                      </div>
                  </template>
                  <template #value="slotProps">
                      <div v-if="slotProps.value" class="d-flex align-items-center">
                          <i class="me-2 fs-18" :class="slotProps.value"></i>
                          <span>{{ icons.find(i => i.id == slotProps.value)?.name }}</span>
                      </div>
                      <span v-else>{{ slotProps.placeholder }}</span>
                  </template>
              </Select>
            </div>

            <div class="col-md-6">
              <label class="form-label">العنوان (عربي)</label>
              <input type="text" v-model="form.title_ar" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">العنوان (EN)</label>
              <input type="text" v-model="form.title_en" class="form-control">
            </div>

            <div class="col-md-6">
              <label class="form-label">الوصف (عربي)</label>
              <textarea v-model="form.description_ar" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">الوصف (EN)</label>
              <textarea v-model="form.description_en" class="form-control" rows="3"></textarea>
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
  props: ['dataRow'],
  emits: ['updated'],
  setup(props, { emit }) {
    const form = ref(null);
    const errors = ref({});
    const loading = ref(false);
    const imageFile = ref(null);
    const imagePreview = ref(null);

    const icons = [
        { id: 'fa-solid fa-crown', name: 'تاج' },
        { id: 'fa-solid fa-trophy', name: 'كأس' },
        { id: 'fa-solid fa-medal', name: 'ميدالية' },
        { id: 'fa-solid fa-award', name: 'وسام' },
        { id: 'fa-solid fa-star', name: 'نجمة' },
        { id: 'fa-light fa-users-medical', name: 'مجتمع/أنشطة' },
        { id: 'fa-solid fa-graduation-cap', name: 'تخرج' },
        { id: 'fa-solid fa-microscope', name: 'علوم/بحث' },
        { id: 'fa-solid fa-palette', name: 'فنون' },
        { id: 'fa-solid fa-basketball', name: 'رياضة' }
    ];

    watch(() => props.dataRow, (newVal) => {
      if (newVal) {
        form.value = { ...newVal };
        imageFile.value = null;
        imagePreview.value = null;
      }
    });

    const handleFileUpload = (e) => {
      const file = e.target.files[0];
      if (file) {
        imageFile.value = file;
        imagePreview.value = URL.createObjectURL(file);
      }
    };

    const save = async () => {
      loading.value = true;
      try {
        const formData = new FormData();
        formData.append('_method', 'PUT');
        for (const key in form.value) {
           if (form.value[key] !== null && key !== 'image') {
              formData.append(key, form.value[key]);
           }
        }
        if (imageFile.value) {
          formData.append('image', imageFile.value);
        }

        await adminApi.post(`school-prides/${props.dataRow.id}`, formData, {
          headers: { 'Content-Type': 'multipart/form-data' }
        });

        Swal.fire({ icon: 'success', title: 'تم التحديث بنجاح', showConfirmButton: false, timer: 1500 });
        emit('updated');
        document.querySelector('#pride-modal .btn-close').click();
      } catch (error) {
        console.error(error);
      } finally {
        loading.value = false;
      }
    };

    return { form, errors, loading, save, handleFileUpload, imagePreview, icons };
  }
}
</script>
