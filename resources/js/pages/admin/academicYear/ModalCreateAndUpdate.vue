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
                        <!-- Tabs Navigation -->
                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" :class="{ active: activeTab === 'basic' }" @click="activeTab = 'basic'" type="button">
                                    معلومات الاساسية <span class="text-danger">*</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" :class="{ active: activeTab === 'semesters' }" @click="activeTab = 'semesters'" type="button">
                                    الفصول الدراسية <span class="text-danger">*</span>
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Basic Info Tab -->
                            <div class="tab-pane fade" :class="{ 'show active': activeTab === 'basic' }">
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label class="form-label">العنوان <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.name"
                                            :class="{ 'is-invalid': v$.name.$error }"
                                        />
                                        <div v-if="v$.name.$error" class="invalid-feedback">
                                            مطلوب
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">تاريخ البدء <span class="text-danger">*</span></label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="form.start_date"
                                            :class="{ 'is-invalid': v$.start_date.$error }"
                                        />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">تاريخ الانتهاء <span class="text-danger">*</span></label>
                                        <input
                                            type="date"
                                            class="form-control"
                                            v-model="form.end_date"
                                            :class="{ 'is-invalid': v$.end_date.$error }"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Semesters Tab -->
                            <div class="tab-pane fade" :class="{ 'show active': activeTab === 'semesters' }">
                                <div v-for="(semester, index) in form.semesters" :key="index" class="row border rounded p-3 mb-3 bg-light position-relative">
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label">اسم الفصل (عربي) <span class="text-danger">*</span></label>
                                        <input type="text" v-model="semester.title_ar" class="form-control" placeholder="مثال: الفصل الأول" />
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label">Semester Name (En) <span class="text-danger">*</span></label>
                                        <input type="text" v-model="semester.title_en" class="form-control" placeholder="Example: Semester 1" />
                                    </div>
                                    <div v-if="form.semesters.length > 1" class="col-md-2 d-flex align-items-end mb-2 text-end">
                                        <button @click="removeSemester(index)" class="btn btn-danger-light btn-icon" type="button">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <button @click="addSemester" class="btn btn-success-light btn-wave" type="button">
                                    <i class="ri-add-line"></i> إضافة فصل دراسي
                                </button>
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
import { ref, reactive, computed, watch, defineEmits, defineProps } from "vue";
import { useI18n } from "vue-i18n";
import useVuelidate from "@vuelidate/core";
import { required } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";

const { t } = useI18n();
const props = defineProps(['isVisible', 'item']);
const emit = defineEmits(['close', 'refresh']);

const loading = ref(false);
const activeTab = ref('basic');

const form = reactive({
    name: "",
    start_date: "",
    end_date: "",
    semesters: [{ id: null, title_ar: "", title_en: "" }],
});

const rules = computed(() => {
    return {
        name: { required },
        start_date: { required },
        end_date: { required },
    };
});

const v$ = useVuelidate(rules, form);

const addSemester = () => {
    form.semesters.push({ id: null, title_ar: "", title_en: "" });
};

const removeSemester = (index) => {
    form.semesters.splice(index, 1);
};

const resetForm = () => {
    form.name = "";
    form.start_date = "";
    form.end_date = "";
    form.semesters = [{ id: null, title_ar: "", title_en: "" }];
    activeTab.value = 'basic';
    v$.value.$reset();
};

watch(() => props.item, (newItem) => {
    if (newItem) {
        form.name = newItem.name;
        form.start_date = newItem.start_date;
        form.end_date = newItem.end_date;
        form.semesters = newItem.semesters && newItem.semesters.length > 0 
            ? newItem.semesters.map(s => ({ id: s.id, title_ar: s.title_ar, title_en: s.title_en })) 
            : [{ id: null, title_ar: "", title_en: "" }];
    } else {
        resetForm();
    }
}, { immediate: true });

const closeModal = () => {
    emit("close");
};

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) {
        activeTab.value = 'basic';
        return;
    }

    const invalidSemester = form.semesters.some(s => !s.title_ar || !s.title_en);
    if (invalidSemester) {
        activeTab.value = 'semesters';
        Swal.fire("تحذير", "يرجى ملء جميع حقول الفصول الدراسية", "warning");
        return;
    }

    loading.value = true;
    try {
        if (props.item) {
            await adminApi.put(`/academic-years/${props.item.id}`, form);
        } else {
            await adminApi.post("/academic-years", form);
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
        console.error("Error saving academic year:", error);
        if (error.response && error.response.status === 422) {
            Swal.fire("تنبيه", error.response.data.message || "لا يمكن مسح بيانات مرتبطة", "warning");
        } else {
            Swal.fire("Error", "Something went wrong", "error");
        }
    } finally {
        loading.value = false;
    }
};
</script>
