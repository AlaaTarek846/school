<template>
    <div>
        <div v-if="isVisible" class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ item ? $t("global.update") : $t("global.add") }}
                        </h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body" style="max-height: 80vh; overflow-y: auto;">
                        <!-- Shared Information Section -->
                        <div class="card custom-card border-primary mb-4">
                            <div class="card-header bg-primary-transparent">
                                <div class="card-title text-primary">المعلومات الأساسية (المشتركة)</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">السنة الدراسية <span class="text-danger">*</span></label>
                                        <Select
                                            v-model="form.academic_year_id"
                                            :options="academicYears"
                                            optionLabel="name"
                                            optionValue="id"
                                            placeholder="اختر السنة الدراسية"
                                            class="w-100"
                                            @change="fetchSemesters"
                                            :class="{ 'p-invalid': v$.academic_year_id.$error }"
                                        />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">الفصل الدراسي <span class="text-danger">*</span></label>
                                        <Select
                                            v-model="form.semester_id"
                                            :options="semesters"
                                            optionLabel="title_ar"
                                            optionValue="id"
                                            placeholder="اختر الفصل الدراسي"
                                            class="w-100"
                                            :disabled="!form.academic_year_id || semestersLoading"
                                            :class="{ 'p-invalid': v$.semester_id.$error }"
                                        />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">المرحلة التعليمية <span class="text-danger">*</span></label>
                                        <Select
                                            v-model="form.education_stage_id"
                                            :options="educationStages"
                                            optionLabel="title_ar"
                                            optionValue="id"
                                            placeholder="اختر المرحلة"
                                            class="w-100"
                                            @change="fetchStageData"
                                            :class="{ 'p-invalid': v$.education_stage_id.$error }"
                                        />
                                    </div>
                                    <div class="col-md-8 mb-3">
                                        <label class="form-label">الفصول <span class="text-danger">*</span></label>
                                        <MultiSelect
                                            v-model="form.class_ids"
                                            :options="classes"
                                            optionLabel="name"
                                            optionValue="id"
                                            placeholder="اختر الفصول"
                                            class="w-100"
                                            :disabled="!form.education_stage_id || stageDataLoading"
                                            :class="{ 'p-invalid': v$.class_ids.$error }"
                                        />
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">تاريخ البدء</label>
                                        <input type="date" v-model="form.start_date" class="form-control" />
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <label class="form-label">تاريخ الانتهاء</label>
                                        <input type="date" v-model="form.end_date" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Exams Repeater Section -->
                        <div class="card custom-card mb-4 border-info">
                            <div class="card-header bg-info-transparent d-flex justify-content-between align-items-center">
                                <div class="card-title text-info">بيانات الامتحان</div>
                                <button v-if="!item" @click="addExam" class="btn btn-success btn-sm btn-wave" type="button">
                                    <i class="ri-add-line"></i> إضافة امتحان آخر
                                </button>
                            </div>
                            <div class="card-body">
                                <div v-for="(exam, index) in form.exams" :key="index" class="border rounded p-3 mb-4 bg-light shadow-sm position-relative">
                                    <div class="position-absolute top-0 end-0 p-2" v-if="form.exams.length > 1 && !item">
                                        <button @click="removeExam(index)" class="btn btn-danger-light btn-sm btn-icon rounded-pill" type="button">
                                            <i class="ri-close-line text-danger"></i>
                                        </button>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">العنوان (عربي) <span class="text-danger">*</span></label>
                                            <input type="text" v-model="exam.title_ar" class="form-control" placeholder="اسم الامتحان بالعربي" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Title (En) <span class="text-danger">*</span></label>
                                            <input type="text" v-model="exam.title_en" class="form-control" placeholder="Exam Title in English" />
                                        </div>
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">المادة الدراسية <span class="text-danger">*</span></label>
                                            <Select
                                                v-model="exam.subject_id"
                                                :options="getAvailableSubjects(index)"
                                                optionLabel="title_ar"
                                                optionValue="id"
                                                placeholder="اختر المادة"
                                                class="w-100"
                                                :disabled="!form.education_stage_id || stageDataLoading"
                                            />
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">الدرجة الكلية <span class="text-danger">*</span></label>
                                            <input type="number" v-model="exam.total_score" class="form-control" />
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">درجة النجاح <span class="text-danger">*</span></label>
                                            <input type="number" v-model="exam.pass_score" class="form-control" />
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">ملف الامتحان</label>
                                            <input type="file" @change="handleFileUpload($event, index)" class="form-control" />
                                            <div v-if="exam.existing_pdf" class="mt-1">
                                                <a :href="'/storage/' + exam.existing_pdf" target="_blank" class="text-info small">
                                                    <i class="ri-file-pdf-line"></i> عرض الملف الحالي
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label fw-bold small text-muted">ملاحظات إضافية (اختياري)</label>
                                            <Editor v-model="exam.notes" :modules="customModules" editorStyle="height: 150px" placeholder="أدخل أي ملاحظات إضافية هنا..." />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-primary"
                            @click="submitForm"
                            :disabled="loading"
                        >
                            <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ $t("global.save") }}
                        </button>
                        <button type="button" class="btn btn-secondary" @click="closeModal">
                            {{ $t("global.close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isVisible" class="modal-backdrop fade show"></div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch, defineEmits, defineProps, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import Editor from "primevue/editor";

const customModules = ref({
    toolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean']
    ]
});

const { t } = useI18n();
const props = defineProps(['isVisible', 'item']);
const emit = defineEmits(['close', 'refresh']);

const loading = ref(false);
const semestersLoading = ref(false);
const stageDataLoading = ref(false);

const academicYears = ref([]);
const educationStages = ref([]);
const semesters = ref([]);
const subjects = ref([]);
const classes = ref([]);

const form = reactive({
    academic_year_id: null,
    semester_id: null,
    education_stage_id: null,
    class_ids: [],
    start_date: "",
    end_date: "",
    exams: [
        {
            subject_id: null,
            title_ar: "",
            title_en: "",
            total_score: 0,
            pass_score: 0,
            notes: "",
            pdf: null,
            existing_pdf: null,
        }
    ],
});

const rules = computed(() => {
    return {
        academic_year_id: { required },
        semester_id: { required },
        education_stage_id: { required },
        class_ids: { required },
    };
});

const v$ = useVuelidate(rules, form);

const fetchInitialData = async () => {
    try {
        const response = await adminApi.get("/exams-data");
        academicYears.value = response.data.data.academic_years;
        educationStages.value = response.data.data.education_stages;
    } catch (error) {
        console.error("Error fetching initial data:", error);
    }
};

const fetchSemesters = async () => {
    if (!form.academic_year_id) {
        semesters.value = [];
        return;
    }
    semestersLoading.value = true;
    try {
        const response = await adminApi.get(`/exams-semesters/${form.academic_year_id}`);
        semesters.value = response.data.data;
    } catch (error) {
        console.error("Error fetching semesters:", error);
    } finally {
        semestersLoading.value = false;
    }
};

const fetchStageData = async () => {
    if (!form.education_stage_id) {
        subjects.value = [];
        classes.value = [];
        return;
    }
    stageDataLoading.value = true;
    try {
        const response = await adminApi.get(`/exams-stage-data/${form.education_stage_id}`);
        subjects.value = response.data.data.subjects;
        classes.value = response.data.data.classes;
    } catch (error) {
        console.error("Error fetching stage data:", error);
    } finally {
        stageDataLoading.value = false;
    }
};

const addExam = () => {
    form.exams.unshift({
        subject_id: null,
        title_ar: "",
        title_en: "",
        total_score: 0,
        pass_score: 0,
        notes: "",
        pdf: null,
    });
};

const removeExam = (index) => {
    form.exams.splice(index, 1);
};

const handleFileUpload = (event, index) => {
    form.exams[index].pdf = event.target.files[0];
};

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) {
        Swal.fire("تنبيه", "يرجى ملء جميع الحقول المطلوبة بمربع المعلومات الأساسية", "warning");
        return;
    }

    // Validate Exams Repeater
    const isExamsValid = form.exams.every(exam => 
        exam.subject_id && exam.title_ar && exam.title_en && exam.total_score >= 0 && exam.pass_score >= 0
    );

    if (!isExamsValid) {
        Swal.fire("تنبيه", "يرجى ملء بيانات الامتحان بشكل صحيح", "warning");
        return;
    }

    loading.value = true;
    
    // Use FormData for file upload
    const formData = new FormData();
    formData.append("academic_year_id", form.academic_year_id);
    formData.append("semester_id", form.semester_id);
    formData.append("education_stage_id", form.education_stage_id);
    formData.append("start_date", form.start_date);
    formData.append("end_date", form.end_date);
    
    form.class_ids.forEach((id, index) => {
        formData.append(`class_ids[${index}]`, id);
    });

    form.exams.forEach((exam, index) => {
        formData.append(`exams[${index}][subject_id]`, exam.subject_id);
        formData.append(`exams[${index}][title_ar]`, exam.title_ar);
        formData.append(`exams[${index}][title_en]`, exam.title_en);
        formData.append(`exams[${index}][total_score]`, exam.total_score);
        formData.append(`exams[${index}][pass_score]`, exam.pass_score);
        formData.append(`exams[${index}][notes]`, exam.notes || "");
        if (exam.pdf) {
            formData.append(`exams[${index}][pdf]`, exam.pdf);
        }
    });

    try {
        if (props.item) {
            await adminApi.post(`/exams/${props.item.id}?_method=PUT`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        } else {
            await adminApi.post("/exams", formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }
        emit("refresh");
        closeModal();
        Swal.fire(t("global.success"), "", "success");
    } catch (error) {
        console.error("Error saving exams:", error);
        if (error.response && error.response.status === 422) {
            Swal.fire("تنبيه", error.response.data.message || "لا يمكن الحفظ لوجود سجلات مرتبطة", "warning");
        } else {
            Swal.fire("Error", "Something went wrong", "error");
        }
    } finally {
        loading.value = false;
    }
};

const closeModal = () => {
    emit("close");
};

watch(() => props.item, async (newItem) => {
    if (newItem) {
        form.academic_year_id = newItem.academic_year_id;
        form.education_stage_id = newItem.education_stage_id;
        
        // Wait for dependent data
        await fetchSemesters();
        await fetchStageData();
        
        form.semester_id = newItem.semester_id;
        form.start_date = newItem.start_date;
        form.end_date = newItem.end_date;
        form.class_ids = newItem.classes ? newItem.classes.map(c => c.id) : [];
        
        form.exams = [
            {
                subject_id: newItem.subject_id,
                title_ar: newItem.title_ar,
                title_en: newItem.title_en,
                total_score: newItem.total_score,
                pass_score: newItem.pass_score,
                notes: newItem.notes,
                pdf: null,
                existing_pdf: newItem.pdf,
            }
        ];
    } else {
        // Reset form
        form.academic_year_id = null;
        form.semester_id = null;
        form.education_stage_id = null;
        form.class_ids = [];
        form.start_date = "";
        form.end_date = "";
        form.exams = [{ subject_id: null, title_ar: "", title_en: "", total_score: 0, pass_score: 0, notes: "", pdf: null }];
        v$.value.$reset();
    }
}, { immediate: true });

const getAvailableSubjects = (currentIndex) => {
    const selectedSubjectIds = form.exams
        .map((exam, index) => index !== currentIndex ? exam.subject_id : null)
        .filter(id => id !== null);
    
    return subjects.value.filter(subject => !selectedSubjectIds.includes(subject.id));
};

onMounted(() => {
    fetchInitialData();
});
</script>

<style scoped>
.p-invalid {
    border-color: #f44336 !important;
}
:deep(.p-editor-container) {
    display: block !important;
    border: 1px solid #ddd !important;
    border-radius: 4px !important;
}
:deep(.p-editor-content) {
    height: 150px !important;
}
:deep(.ql-editor) {
    min-height: 150px !important;
}
</style>
