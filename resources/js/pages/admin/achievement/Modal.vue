<template>
  <div class="modal fade" id="area-model" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">{{ type == 'create' ? $t('global.add') : $t('global.edit') }}</h6>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">القسم</label>
              <Select v-model="form.achievement_section_id" :options="sections" optionLabel="title_ar" optionValue="id" class="w-100" />
              <error-message :errors="errors" name="achievement_section_id"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">الأيقونة</label>
              <Select v-model="form.icon" :options="icons" optionLabel="name" optionValue="id" class="w-100" filter placeholder="اختر أيقونة">
                  <template #option="slotProps">
                      <div class="d-flex align-items-center">
                          <i class="fa-light me-2 fs-18" :class="slotProps.option.id"></i>
                          <span>{{ slotProps.option.name }}</span>
                      </div>
                  </template>
                  <template #value="slotProps">
                      <div v-if="slotProps.value" class="d-flex align-items-center">
                          <i class="fa-light me-2 fs-18" :class="slotProps.value"></i>
                          <span>{{ icons.find(i => i.id == slotProps.value)?.name }}</span>
                      </div>
                      <span v-else>{{ slotProps.placeholder }}</span>
                  </template>
              </Select>
              <error-message :errors="errors" name="icon"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">أيقونة الوسام</label>
              <Select v-model="form.badge_icon" :options="badgeIcons" optionLabel="name" optionValue="id" class="w-100" filter placeholder="اختر وسام">
                  <template #option="slotProps">
                      <div class="d-flex align-items-center">
                          <i class="fa-solid me-2 fs-18" :class="slotProps.option.id"></i>
                          <span>{{ slotProps.option.name }}</span>
                      </div>
                  </template>
                  <template #value="slotProps">
                      <div v-if="slotProps.value" class="d-flex align-items-center">
                          <i class="fa-solid me-2 fs-18" :class="slotProps.value"></i>
                          <span>{{ badgeIcons.find(i => i.id == slotProps.value)?.name }}</span>
                      </div>
                      <span v-else>{{ slotProps.placeholder }}</span>
                  </template>
              </Select>
              <error-message :errors="errors" name="badge_icon"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">النص (عربي)</label>
              <input type="text" v-model="form.text_ar" class="form-control">
              <error-message :errors="errors" name="text_ar"></error-message>
            </div>
            <div class="col-md-6">
              <label class="form-label">النص (EN)</label>
              <input type="text" v-model="form.text_en" class="form-control">
              <error-message :errors="errors" name="text_en"></error-message>
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
import { ref, watch, onMounted } from "vue";
import Swal from "sweetalert2";

export default {
  props: ['type', 'dataRow'],
  emits: ['created'],
  setup(props, { emit }) {
    const form = ref({
      achievement_section_id: null,
      icon: '',
      badge_icon: 'fa-trophy',
      text_ar: '',
      text_en: ''
    });
    const errors = ref({});
    const loading = ref(false);
    const sections = ref([]);
    
    const icons = [
        { id: 'fa-microphone-stand', name: 'ميكروفون' },
        { id: 'fa-lightbulb-on', name: 'مصباح/ابتكار' },
        { id: 'fa-table-tennis-paddle-ball', name: 'تنس طاولة' },
        { id: 'fa-person-swimming', name: 'سباحة' },
        { id: 'fa-basketball', name: 'كرة سلة' },
        { id: 'fa-book-open', name: 'كتاب مفتوح' },
        { id: 'fa-graduation-cap', name: 'قبعة تخرج' },
        { id: 'fa-palette', name: 'لوحة ألوان' },
        { id: 'fa-music', name: 'موسيقى' },
        { id: 'fa-user-graduate', name: 'خريج' },
        { id: 'fa-award', name: 'جائزة' },
        { id: 'fa-calculator', name: 'حاسبة/رياضيات' },
        { id: 'fa-microscope', name: 'مجهر/علوم' }
    ];

    const badgeIcons = [
        { id: 'fa-trophy', name: 'كأس' },
        { id: 'fa-medal', name: 'ميدالية' },
        { id: 'fa-award', name: 'وسام' },
        { id: 'fa-star', name: 'نجمة' },
        { id: 'fa-crown', name: 'تاج' }
    ];

    const getSections = async () => {
      try {
        const res = await adminApi.get('get-achievement-sections');
        sections.value = res.data.data;
        if (props.type == 'create' && sections.value.length > 0) {
            form.value.achievement_section_id = sections.value[0].id;
        }
      } catch (e) {
        console.error(e);
      }
    };

    onMounted(getSections);

    watch(() => props.dataRow, (newVal) => {
      if (props.type == 'edit' && newVal) {
        form.value = { ...newVal };
      } else {
        form.value = {
          achievement_section_id: sections.value.length > 0 ? sections.value[0].id : null,
          icon: '',
          badge_icon: 'fa-trophy',
          text_ar: '',
          text_en: ''
        };
      }
    });

    const save = async () => {
      loading.value = true;
      errors.value = {};
      try {
        if (props.type == 'create') {
          await adminApi.post('achievements', form.value);
        } else {
          await adminApi.put(`achievements/${props.dataRow.id}`, form.value);
        }
        Swal.fire({ icon: 'success', title: 'تم الحفظ بنجاح', showConfirmButton: false, timer: 1500 });
        emit('created');
        document.querySelector('.btn-close').click();
      } catch (error) {
        if (error.response && error.response.status === 422) {
          errors.value = error.response.data.errors;
        }
      } finally {
        loading.value = false;
      }
    };

    return { form, errors, loading, sections, icons, badgeIcons, save };
  }
}
</script>
