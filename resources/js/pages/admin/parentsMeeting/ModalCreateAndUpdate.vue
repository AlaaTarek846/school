<template>
    <div>
        <div v-if="isVisible" class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ item ? $t("global.update") : $t("global.add") }}
                        </h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">العنوان (عربي) <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.title_ar"
                                    :class="{ 'is-invalid': v$.title_ar.$error }"
                                />
                                <div v-if="v$.title_ar.$error" class="invalid-feedback">مطلوب</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Title (En) <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="form.title_en"
                                    :class="{ 'is-invalid': v$.title_en.$error }"
                                />
                                <div v-if="v$.title_en.$error" class="invalid-feedback">Required</div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">ملاحظات (عربي)</label>
                                <textarea class="form-control" v-model="form.note_ar"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Notes (En)</label>
                                <textarea class="form-control" v-model="form.note_en"></textarea>
                            </div>
                        </div>

                        <hr>
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    id="is_general_time"
                                    v-model="form.is_general_time"
                                >
                                <label class="form-check-label" for="is_general_time">
                                    وقت عام لكل المراحل
                                </label>
                            </div>
                            <small class="text-muted">
                                لو مفعّل: تضيف وقت واحد (من → إلى) لكل الصفوف. لو مش مفعّل: وقت مستقل لكل صف.
                            </small>
                        </div>

                        <div v-if="form.is_general_time" class="row mb-3 border rounded p-3 bg-light">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">من <span class="text-danger">*</span></label>
                                <input
                                    type="time"
                                    class="form-control"
                                    v-model="form.time_from"
                                    :class="{ 'is-invalid': fieldError('time_from') }"
                                >
                                <div v-if="fieldError('time_from')" class="invalid-feedback">مطلوب</div>
                            </div>
                            <div class="col-md-6 mb-2">
                                <label class="form-label">إلى <span class="text-danger">*</span></label>
                                <input
                                    type="time"
                                    class="form-control"
                                    v-model="form.time_to"
                                    :class="{ 'is-invalid': fieldError('time_to') }"
                                >
                                <div v-if="fieldError('time_to')" class="invalid-feedback">مطلوب</div>
                            </div>
                        </div>

                        <h6>تفاصيل الاجتماع (Meeting Details)</h6>

                        <div
                            v-for="(detail, index) in form.details"
                            :key="detail._key"
                            class="border rounded p-3 mb-3"
                        >
                            <div class="row align-items-end">
                                <div class="col-md-10 mb-2">
                                    <label class="form-label">المرحلة الدراسية <span class="text-danger">*</span></label>
                                    <select
                                        class="form-control"
                                        v-model="detail.education_stage_id"
                                        :class="{ 'is-invalid': detailError(index, 'education_stage_id') }"
                                    >
                                        <option value="" disabled>اختر المرحلة</option>
                                        <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">
                                            {{ stage.title_ar }} / {{ stage.title_en }}
                                        </option>
                                    </select>
                                    <div
                                        v-if="detailError(index, 'education_stage_id')"
                                        class="invalid-feedback"
                                    >Required</div>
                                </div>
                                <div class="col-md-2 mb-2">
                                    <button
                                        type="button"
                                        class="btn btn-danger"
                                        @click="removeDetail(index)"
                                        v-if="form.details.length > 1"
                                    >
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>

                            <div v-if="!form.is_general_time" class="row mt-2">
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">من <span class="text-danger">*</span></label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="detail.time_from"
                                        :class="{ 'is-invalid': detailError(index, 'time_from') }"
                                    >
                                    <div
                                        v-if="detailError(index, 'time_from')"
                                        class="invalid-feedback"
                                    >مطلوب</div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="form-label">إلى <span class="text-danger">*</span></label>
                                    <input
                                        type="time"
                                        class="form-control"
                                        v-model="detail.time_to"
                                        :class="{ 'is-invalid': detailError(index, 'time_to') }"
                                    >
                                    <div
                                        v-if="detailError(index, 'time_to')"
                                        class="invalid-feedback"
                                    >مطلوب</div>
                                </div>
                            </div>

                            <div class="mt-2">
                                <label class="form-label">أيام الأسبوع (ما عدا الجمعة) <span class="text-danger">*</span></label>
                                <div class="d-flex flex-wrap gap-3">
                                    <div
                                        v-for="day in weekDays"
                                        :key="day.value"
                                        class="form-check"
                                    >
                                        <input
                                            class="form-check-input"
                                            type="checkbox"
                                            :id="`day-${detail._key}-${day.value}`"
                                            :value="day.value"
                                            v-model="detail.days"
                                        >
                                        <label class="form-check-label" :for="`day-${detail._key}-${day.value}`">
                                            {{ day.label }}
                                        </label>
                                    </div>
                                </div>
                                <div
                                    v-if="detailError(index, 'days')"
                                    class="text-danger small mt-1"
                                >اختر يوم واحد على الأقل</div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-success mt-2" @click="addDetail">
                            <i class="bi bi-plus"></i> إضافة تفصيلة أخرى
                        </button>

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
import { required, requiredIf, helpers } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";

const { t } = useI18n();
const props = defineProps(['isVisible', 'item']);
const emit = defineEmits(['close', 'refresh']);

const loading = ref(false);
const educationStages = ref([]);
let detailKey = 0;

const weekDays = [
    { value: "saturday", label: "السبت" },
    { value: "sunday", label: "الأحد" },
    { value: "monday", label: "الإثنين" },
    { value: "tuesday", label: "الثلاثاء" },
    { value: "wednesday", label: "الأربعاء" },
    { value: "thursday", label: "الخميس" },
];

const emptyDetail = () => ({
    _key: ++detailKey,
    education_stage_id: "",
    time_from: "",
    time_to: "",
    days: [],
});

const form = reactive({
    title_ar: "",
    title_en: "",
    note_ar: "",
    note_en: "",
    is_general_time: false,
    time_from: "",
    time_to: "",
    details: [emptyDetail()]
});

const normalizeTime = (value) => {
    if (!value) return "";
    return String(value).substring(0, 5);
};

const rules = computed(() => ({
    title_ar: { required },
    title_en: { required },
    time_from: { required: requiredIf(() => form.is_general_time) },
    time_to: { required: requiredIf(() => form.is_general_time) },
    details: {
        required,
        $each: helpers.forEach({
            education_stage_id: { required },
            days: { required },
            time_from: { required: requiredIf(() => !form.is_general_time) },
            time_to: { required: requiredIf(() => !form.is_general_time) },
        })
    }
}));

const v$ = useVuelidate(rules, form);

const fieldError = (field) => !!(v$.value?.[field]?.$error);

const detailError = (index, field) => {
    return !!(v$.value?.details?.$each?.$response?.$data?.[index]?.[field]?.$error);
};

const fetchEducationStages = async () => {
    try {
        const response = await adminApi.get('/education-stages?per_page=100');
        educationStages.value = response.data.data;
    } catch (error) {
        console.error("Error fetching stages:", error);
    }
};

const resetForm = () => {
    form.title_ar = "";
    form.title_en = "";
    form.note_ar = "";
    form.note_en = "";
    form.is_general_time = false;
    form.time_from = "";
    form.time_to = "";
    form.details.splice(0, form.details.length, emptyDetail());
    v$.value.$reset();
};

onMounted(() => {
    fetchEducationStages();
});

watch(() => props.item, (newItem) => {
    if (newItem) {
        form.title_ar = newItem.title_ar;
        form.title_en = newItem.title_en;
        form.note_ar = newItem.note_ar;
        form.note_en = newItem.note_en;
        form.is_general_time = !!newItem.is_general_time;
        form.time_from = normalizeTime(newItem.time_from);
        form.time_to = normalizeTime(newItem.time_to);

        if (newItem.details && newItem.details.length > 0) {
             const newDetails = newItem.details.map(d => ({
                _key: ++detailKey,
                education_stage_id: d.education_stage_id,
                time_from: normalizeTime(d.time_from),
                time_to: normalizeTime(d.time_to),
                days: Array.isArray(d.days) ? [...d.days] : [],
            }));
            form.details.splice(0, form.details.length, ...newDetails);
        } else {
             form.details.splice(0, form.details.length, emptyDetail());
        }

    } else {
        resetForm();
    }
}, { immediate: true });

const addDetail = () => {
    form.details.push(emptyDetail());
};

const removeDetail = (index) => {
    form.details.splice(index, 1);
};

const closeModal = () => {
    emit("close");
};

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;
    try {
        const payload = {
            title_ar: form.title_ar,
            title_en: form.title_en,
            note_ar: form.note_ar,
            note_en: form.note_en,
            is_general_time: form.is_general_time,
            time_from: form.is_general_time ? form.time_from : null,
            time_to: form.is_general_time ? form.time_to : null,
            details: form.details.map((d) => ({
                education_stage_id: d.education_stage_id,
                days: d.days,
                time_from: form.is_general_time ? null : d.time_from,
                time_to: form.is_general_time ? null : d.time_to,
            })),
        };

        if (props.item) {
            await adminApi.put(`/parents-meetings/${props.item.id}`, payload);
        } else {
            await adminApi.post("/parents-meetings", payload);
        }
        emit("refresh");
        closeModal();
        Swal.fire(
            t("global.success"),
            props.item
                ? t("global.UpdatedSuccessfully")
                : t("global.AddedSuccessfully"),
            "success"
        );
    } catch (error) {
        console.error("Error saving parents meeting:", error);
        const errors = error.response?.data?.errors;
        let message = error.response?.data?.message || "حدث خطأ أثناء الحفظ";

        if (errors && typeof errors === "object") {
            message = Object.values(errors).flat().join("<br>");
        }

        Swal.fire({
            icon: "error",
            title: "خطأ",
            html: message,
        });
    } finally {
        loading.value = false;
    }
};
</script>
