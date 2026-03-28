<template>
<div class="modal fade" id="area-model" tabindex="-1" aria-labelledby="exampleModalLgLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
     <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
       <div class="modal-header bg-primary text-white py-3">
         <h6 class="modal-title fw-bold" id="exampleModalLgLabel">
           <i class="ri-user-add-line me-2" v-if="type == 'create'"></i>
           <i class="ri-user-settings-line me-2" v-else></i>
           {{ type == 'create' ? $t('global.add') : $t('global.update') }}
         </h6>
         <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
       </div>
       <div class="modal-body p-4">
         <!-- section 1: Account Information -->
         <div class="section-title mb-3">
           <h6 class="text-primary fw-bold mb-0 d-flex align-items-center">
             <i class="ri-shield-user-line me-2 fs-18"></i> {{ $t('translation.accountInfo') || 'Account Information' }}
           </h6>
           <hr class="mt-2 mb-3 opacity-10">
         </div>

         <div class="row g-3 mb-4">
           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('global.name') }} <span class="text-danger">*</span></label>
             <input type="text" class="form-control form-control-md" v-model="v$.name.$model" :class="{'is-invalid': v$.name.$error || errors['name']}">
             <div class="invalid-feedback">
               <span v-if="v$.name.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
             </div>
           </div>

           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.code') }} <span class="text-danger">*</span></label>
             <input type="text" class="form-control form-control-md" v-model="v$.code.$model" :class="{'is-invalid': v$.code.$error || errors['code']}">
             <div class="invalid-feedback">
               <span v-if="v$.code.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
             </div>
           </div>

           <div class="col-md-4">
             <label class="form-label small fw-bold">{{ $t('admin.username') }} <span class="text-danger">*</span></label>
             <input type="text" class="form-control form-control-md" v-model="v$.username.$model" :class="{'is-invalid': v$.username.$error || errors['username']}">
             <div class="invalid-feedback">
               <span v-if="v$.username.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
             </div>
           </div>

           <div class="col-md-4">
             <label class="form-label small fw-bold">{{ $t('global.email') }}</label>
             <input type="email" class="form-control form-control-md" v-model="v$.email.$model" :class="{'is-invalid': v$.email.$error || errors['email']}">
             <div class="invalid-feedback">
               <span v-if="v$.email.email.$invalid">{{ $t('validation.emailValid') }}</span>
             </div>
           </div>

           <div class="col-md-4">
             <label class="form-label small fw-bold">{{ $t('global.password') }} <span v-if="type == 'create'" class="text-danger">*</span></label>
             <input type="password" class="form-control form-control-md" v-model="v$.password.$model" :class="{'is-invalid': v$.password.$error || errors['password']}">
             <div class="invalid-feedback">
               <span v-if="v$.password.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
               <span v-if="v$.password.minLength.$invalid">{{ $t('validation.minLength', { min: 8 }) }}</span>
             </div>
           </div>
         </div>

         <!-- section 2: Academic Placement -->
         <div class="section-title mb-3">
           <h6 class="text-success fw-bold mb-0 d-flex align-items-center">
             <i class="ri-book-open-line me-2 fs-18"></i> {{ $t('translation.academic_info') || 'Academic Placement' }}
           </h6>
           <hr class="mt-2 mb-3 opacity-10">
         </div>

         <div class="row g-3 mb-4 section-bg-light p-3 rounded-3 mx-0">
           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.academic_year') }} <span class="text-danger">*</span></label>
             <select class="form-select form-control-md" v-model="v$.academic_year_id.$model" :class="{'is-invalid': v$.academic_year_id.$error || errors['academic_year_id']}">
               <option v-for="year in academicYears" :key="year.id" :value="year.id">{{ year.name }}</option>
             </select>
           </div>

           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.semester') }} <span class="text-danger">*</span></label>
             <select class="form-select form-control-md" v-model="v$.semester_id.$model" :class="{'is-invalid': v$.semester_id.$error || errors['semester_id']}">
               <option v-for="semester in semesters" :key="semester.id" :value="semester.id">{{ $i18n.locale == 'ar' ? semester.title_ar : semester.title_en }}</option>
             </select>
           </div>

           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.education_stage') }} <span class="text-danger">*</span></label>
             <select class="form-select form-control-md" v-model="v$.education_stage_id.$model" :class="{'is-invalid': v$.education_stage_id.$error || errors['education_stage_id']}">
               <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">{{ $i18n.locale == 'ar' ? stage.title_ar : stage.title_en }}</option>
             </select>
           </div>

           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.school_class') }} <span class="text-danger">*</span></label>
             <select class="form-select form-control-md" v-model="v$.school_class_id.$model" :class="{'is-invalid': v$.school_class_id.$error || errors['school_class_id']}">
               <option v-for="cls in schoolClasses" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
             </select>
           </div>
         </div>

         <!-- section 3: Personal Details -->
         <div class="section-title mb-3">
           <h6 class="text-info fw-bold mb-0 d-flex align-items-center">
             <i class="ri-profile-line me-2 fs-18"></i> {{ $t('translation.personal_info') || 'Personal Details' }}
           </h6>
           <hr class="mt-2 mb-3 opacity-10">
         </div>

         <div class="row g-3 mb-4">
           <div class="col-md-3">
             <label class="form-label small fw-bold">{{ $t('admin.gender') }} <span class="text-danger">*</span></label>
             <select class="form-select form-control-md" v-model="v$.gender.$model" :class="{'is-invalid': v$.gender.$error || errors['gender']}">
               <option value="male">{{ $t('admin.male') }}</option>
               <option value="female">{{ $t('admin.female') }}</option>
             </select>
           </div>

           <div class="col-md-3">
             <label class="form-label small fw-bold">{{ $t('admin.birth_day') }}</label>
             <input type="date" class="form-control form-control-md" v-model="submitData.data.birth_day" :class="{'is-invalid': errors['birth_day']}">
           </div>

           <div class="col-md-3">
             <label class="form-label small fw-bold text-truncate w-100">{{ $t('admin.phone_1') }}</label>
             <input type="text" class="form-control form-control-md" v-model="v$.phone_1.$model" :class="{'is-invalid': v$.phone_1.$error || errors['phone_1']}">
           </div>

           <div class="col-md-3">
             <label class="form-label small fw-bold text-truncate w-100">{{ $t('admin.phone_2') }}</label>
             <input type="text" class="form-control form-control-md" v-model="v$.phone_2.$model" :class="{'is-invalid': v$.phone_2.$error || errors['phone_2']}">
           </div>
         </div>

         <!-- section 4: Location & Status -->
         <div class="section-title mb-3">
           <h6 class="text-warning fw-bold mb-0 d-flex align-items-center">
             <i class="ri-map-pin-user-line me-2 fs-18"></i> {{ $t('translation.location_info') || 'Location & Status' }}
           </h6>
           <hr class="mt-2 mb-3 opacity-10">
         </div>

         <div class="row g-3">
           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.governorate') }}</label>
             <input type="text" class="form-control form-control-md" v-model="submitData.data.governorate" :class="{'is-invalid': errors['governorate']}">
           </div>

           <div class="col-md-6">
             <label class="form-label small fw-bold">{{ $t('admin.city') }}</label>
             <input type="text" class="form-control form-control-md" v-model="submitData.data.city" :class="{'is-invalid': errors['city']}">
           </div>

           <div class="col-md-12">
             <label class="form-label small fw-bold">{{ $t('admin.address') }}</label>
             <input type="text" class="form-control form-control-md" v-model="submitData.data.address" :class="{'is-invalid': errors['address']}">
           </div>

           <div class="col-md-6 pt-2">
             <div class="status-toggle-card p-2 border rounded-pill d-flex align-items-center justify-content-between px-3 h-100 bg-light-transparent">
               <span class="small fw-bold"><i class="ri-checkbox-circle-line me-1 text-success"></i> {{ $t('admin.status') }}</span>
               <div class="form-check form-switch mb-0">
                 <input class="form-check-input custom-switch-primary" id="is_activeToggle" v-model="submitData.data.is_active" type="checkbox" role="switch">
               </div>
             </div>
           </div>

           <div class="col-md-6 pt-2">
             <div class="status-toggle-card p-2 border rounded-pill d-flex align-items-center justify-content-between px-3 h-100 bg-light-transparent">
               <span class="small fw-bold"><i class="ri-flag-2-line me-1 text-info"></i> {{ $t('admin.is_completed') }}</span>
               <div class="form-check form-switch mb-0">
                 <input class="form-check-input custom-switch-info" id="is_completedToggle" v-model="submitData.data.is_completed" type="checkbox" role="switch">
               </div>
             </div>
           </div>

           <div class="col-md-12 mt-4" v-if="Object.keys(errors).length > 0">
             <div class="alert alert-danger border-0 shadow-sm rounded-3">
               <ul class="mb-0 small">
                 <li v-for="(errMsg, errKey) in errors" :key="errKey">{{ errMsg[0] }}</li>
               </ul>
             </div>
           </div>
         </div>
      </div>
       <div class="modal-footer bg-light border-0 py-3">
         <button v-if="type != 'edit'" :disabled="!is_disabled" @click.prevent="resetModal" type="button" class="btn btn-outline-secondary rounded-pill px-4">{{$t('global.AddNewRecord')}}</button>
         <template v-if="!is_disabled">
           <button type="submit" v-if="!loading" @click.prevent="AddSubmit" class="btn btn-primary rounded-pill px-5 shadow-sm">
             <i class="ri-check-line me-1"></i> {{ $t('global.Submit') }}
           </button>
           <button class="btn btn-primary btn-loader rounded-pill px-5" v-else>
             <span class="me-2">{{$t('global.Loading')}}</span>
             <span class="loading"><i class="ri-loader-2-fill fs-16"></i></span>
           </button>
         </template>
       </div>
     </div>
   </div>
 </div>
 </template>

<script setup>
import { computed, onMounted, reactive, ref, nextTick, watch } from "vue";
import { useI18n } from "vue-i18n";
import { minLength, required, requiredIf, email } from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import adminApi from "../../../api/adminAxios";

const props = defineProps({
  type: { default: 'create' },
  dataRow: { default: '' },
});

const emit = defineEmits(['created']);

const errors = ref([]);
const loading = ref(false);
const is_disabled = ref(false);
const { t } = useI18n({});
const id = ref(null);

const academicYears = ref([]);
const educationStages = ref([]);
const semesters = ref([]);
const schoolClasses = ref([]);

setTimeout(async () => {
  let myModalEl = document.getElementById('area-model');
  if (myModalEl) {
    myModalEl.addEventListener('show.bs.modal', function (event) {
      resetModal();
    });
    myModalEl.addEventListener('hidden.bs.modal', function (event) {
      resetModalHidden();
    });
  }
}, 150);

onMounted(() => {
  fetchFormData();
});

function fetchFormData() {
  adminApi.get(`students/form-data`).then((res) => {
    academicYears.value = res.data.data.academicYears;
    educationStages.value = res.data.data.educationStages;
  });
}

const submitData = reactive({
  data: {
    name: '',
    username: '',
    email: '',
    code: '',
    password: '',
    gender: 'male',
    phone_1: '',
    phone_2: '',
    governorate: '',
    city: '',
    address: '',
    birth_day: '',
    is_active: true,
    is_completed: false,
    academic_year_id: '',
    semester_id: '',
    education_stage_id: '',
    school_class_id: '',
  }
});

const rules = computed(() => {
  return {
    name: { required },
    username: { required },
    email: { email: (val) => !val || /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) },
    code: { required },
    password: {
      required: requiredIf(() => props.type === 'create'),
      minLength: minLength(8)
    },
    gender: { required },
    phone_1: {},
    phone_2: {},
    is_active: {},
    is_completed: {},
    academic_year_id: { required },
    semester_id: { required },
    education_stage_id: { required },
    school_class_id: { required },
  }
});

const v$ = useVuelidate(rules, submitData.data);

const fetchSemesters = (academicYearId) => {
  if (!academicYearId) {
    semesters.value = [];
    return;
  }
  adminApi.get(`students/get-semesters/${academicYearId}`).then((res) => {
    semesters.value = res.data.data;
    if (!semesters.value.find(s => s.id === submitData.data.semester_id)) {
      submitData.data.semester_id = semesters.value.length ? semesters.value[0].id : '';
    }
  });
};

const fetchClasses = (educationStageId) => {
  if (!educationStageId) {
    schoolClasses.value = [];
    return;
  }
  adminApi.get(`students/get-classes/${educationStageId}`).then((res) => {
    schoolClasses.value = res.data.data;
    if (!schoolClasses.value.find(c => c.id === submitData.data.school_class_id)) {
      submitData.data.school_class_id = schoolClasses.value.length ? schoolClasses.value[0].id : '';
    }
  });
};

watch(() => submitData.data.academic_year_id, (newVal) => {
  fetchSemesters(newVal);
});

watch(() => submitData.data.education_stage_id, (newVal) => {
  fetchClasses(newVal);
});

function defaultData() {
  submitData.data.name = '';
  submitData.data.username = '';
  submitData.data.email = '';
  submitData.data.code = '';
  submitData.data.password = '';
  submitData.data.gender = 'male';
  submitData.data.phone_1 = '';
  submitData.data.phone_2 = '';
  submitData.data.governorate = '';
  submitData.data.city = '';
  submitData.data.address = '';
  submitData.data.birth_day = '';
  submitData.data.is_active = true;
  submitData.data.is_completed = false;
  submitData.data.academic_year_id = academicYears.value.length ? academicYears.value[academicYears.value.length - 1].id : '';
  submitData.data.semester_id = '';
  submitData.data.education_stage_id = educationStages.value.length ? educationStages.value[0].id : '';
  submitData.data.school_class_id = '';

  is_disabled.value = false;
  loading.value = false;
  errors.value = [];
}

function resetModal() {
  defaultData();
  setTimeout(async () => {
    if (props.type === 'edit' && props.dataRow) {
      id.value = props.dataRow.id;
      adminApi.get(`students/${id.value}`)
        .then((res) => {
          let l = res.data.data;
          submitData.data.name = l.name;
          submitData.data.username = l.username;
          submitData.data.email = l.email;
          submitData.data.code = l.code;
          submitData.data.gender = l.gender;
          submitData.data.phone_1 = l.phone_1;
          submitData.data.phone_2 = l.phone_2;
          submitData.data.governorate = l.governorate;
          submitData.data.city = l.city;
          submitData.data.address = l.address;
          submitData.data.birth_day = l.birth_day;
          submitData.data.is_active = !!l.is_active;
          submitData.data.is_completed = !!l.is_completed;
          submitData.data.academic_year_id = l.academic_year_id;
          submitData.data.education_stage_id = l.education_stage_id;

          // Wait briefly for the API fetch to complete. The watchers will trigger immediately from the assignment above,
          // then this block executes to place the exact saved value instead of the first generic option.
          setTimeout(() => {
              submitData.data.semester_id = l.semester_id;
              submitData.data.school_class_id = l.school_class_id;
          }, 300);
        })
        .catch((err) => {
          console.log(err);
        });
    }
  }, 50);
}

function resetModalHidden() {
  defaultData();
  nextTick(() => { v$.value.$reset() });
}

const AddSubmit = () => {
  v$.value.$validate();
  errors.value = {};

  if (!v$.value.$error) {
    is_disabled.value = false;
    loading.value = true;

    let formData = new FormData();
    Object.keys(submitData.data).forEach(key => {
      let val = submitData.data[key];
      if (key === 'is_active' || key === 'is_completed') val = val ? 1 : 0;
      if (val !== null && val !== '') {
        formData.append(key, val);
      }
    });

    if (props.type !== 'edit') {
      adminApi.post(`students`, formData)
        .then(() => {
          Swal.fire({
            icon: 'success',
            title: t('global.AddedSuccessfully'),
            showConfirmButton: false,
            timer: 1500
          });
          emit("created");
          is_disabled.value = true;
        })
        .catch((err) => {
          errors.value = err.response?.data?.errors || { err: [err.message] };
        })
        .finally(() => {
          loading.value = false;
        });
    } else {
      formData.append('_method', 'PUT');
      adminApi.post(`students/${id.value}`, formData)
        .then(() => {
          Swal.fire({
            icon: 'success',
            title: t('global.EditSuccessfully'),
            showConfirmButton: false,
            timer: 1500
          });
          emit("created");
        })
        .catch((err) => {
          errors.value = err.response?.data?.errors || { err: [err.message] };
        })
        .finally(() => {
          loading.value = false;
        });
    }
   }
 };
 </script>

 <style scoped>
 .modal-content {
   transition: all 0.3s ease;
 }
 .section-bg-light {
   background-color: #f8f9fa;
   border: 1px dashed #dee2e6;
 }
 .form-label {
   color: #495057;
   transition: color 0.2s;
 }
 .form-control:focus, .form-select:focus {
   border-color: var(--bs-primary);
   box-shadow: 0 0 0 0.25rem rgba(var(--bs-primary-rgb), 0.1);
 }
 .custom-switch-primary:checked {
   background-color: var(--bs-primary);
   border-color: var(--bs-primary);
 }
 .custom-switch-info:checked {
   background-color: var(--bs-info);
   border-color: var(--bs-info);
 }
 .status-toggle-card {
   transition: all 0.2s;
 }
 .status-toggle-card:hover {
   border-color: var(--bs-primary) !important;
   background-color: rgba(var(--bs-primary-rgb), 0.02) !important;
 }
 .bg-light-transparent {
    background-color: rgba(248, 249, 250, 0.5);
 }
 .invalid-feedback {
   font-size: 0.75rem;
 }
 </style>
