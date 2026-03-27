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
                                <button class="nav-link" :class="{ active: activeTab === 'subjects' }" @click="activeTab = 'subjects'" type="button">
                                    المواد الدراسية <span class="text-danger">*</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" :class="{ active: activeTab === 'classes' }" @click="activeTab = 'classes'" type="button">
                                    فصول المرحلة <span class="text-danger">*</span>
                                </button>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <!-- Basic Info Tab -->
                            <div class="tab-pane fade" :class="{ 'show active': activeTab === 'basic' }">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">العنوان (عربي) <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.title_ar"
                                            :class="{ 'is-invalid': v$.title_ar.$error }"
                                        />
                                        <div v-if="v$.title_ar.$error" class="invalid-feedback">
                                            مطلوب
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Title (En) <span class="text-danger">*</span></label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            v-model="form.title_en"
                                            :class="{ 'is-invalid': v$.title_en.$error }"
                                        />
                                        <div v-if="v$.title_en.$error" class="invalid-feedback">
                                            Required
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Subjects Tab -->
                            <div class="tab-pane fade" :class="{ 'show active': activeTab === 'subjects' }">
                                <div v-for="(subject, index) in form.subjects" :key="index" class="row border rounded p-3 mb-3 bg-light position-relative">
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label">اسم المادة (عربي) <span class="text-danger">*</span></label>
                                        <input type="text" v-model="subject.title_ar" class="form-control" placeholder="مثال: اللغة العربية" />
                                    </div>
                                    <div class="col-md-5 mb-2">
                                        <label class="form-label">Subject Name (En) <span class="text-danger">*</span></label>
                                        <input type="text" v-model="subject.title_en" class="form-control" placeholder="Example: Arabic" />
                                    </div>
                                    <div v-if="form.subjects.length > 1" class="col-md-2 d-flex align-items-end mb-2 text-end">
                                        <button @click="removeSubject(index)" class="btn btn-danger-light btn-icon" type="button">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <button @click="addSubject" class="btn btn-success-light btn-wave" type="button">
                                    <i class="ri-add-line"></i> إضافة مادة
                                </button>
                            </div>

                            <!-- Classes Tab -->
                            <div class="tab-pane fade" :class="{ 'show active': activeTab === 'classes' }">
                                <div v-for="(schoolClass, index) in form.school_classes" :key="index" class="row border rounded p-3 mb-3 bg-light position-relative">
                                    <div class="col-md-10 mb-2">
                                        <label class="form-label">اسم الفصل <span class="text-danger">*</span></label>
                                        <input type="text" v-model="schoolClass.name" class="form-control" placeholder="مثال: فصل أ" />
                                    </div>
                                    <div v-if="form.school_classes.length > 1" class="col-md-2 d-flex align-items-end mb-2 text-end">
                                        <button @click="removeClass(index)" class="btn btn-danger-light btn-icon" type="button">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </div>
                                <button @click="addClass" class="btn btn-success-light btn-wave" type="button">
                                    <i class="ri-add-line"></i> إضافة فصل
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
    title_ar: "",
    title_en: "",
    subjects: [{ id: null, title_ar: "", title_en: "" }],
    school_classes: [{ id: null, name: "" }],
});

const rules = computed(() => {
    return {
        title_ar: { required },
        title_en: { required },
    };
});

const v$ = useVuelidate(rules, form);

const addSubject = () => {
    form.subjects.push({ id: null, title_ar: "", title_en: "" });
};

const removeSubject = (index) => {
    form.subjects.splice(index, 1);
};

const addClass = () => {
    form.school_classes.push({ id: null, name: "" });
};

const removeClass = (index) => {
    form.school_classes.splice(index, 1);
};

const resetForm = () => {
    form.title_ar = "";
    form.title_en = "";
    form.subjects = [{ id: null, title_ar: "", title_en: "" }];
    form.school_classes = [{ id: null, name: "" }];
    activeTab.value = 'basic';
    v$.value.$reset();
};

watch(() => props.item, (newItem) => {
    if (newItem) {
        form.title_ar = newItem.title_ar;
        form.title_en = newItem.title_en;
        form.subjects = newItem.subjects && newItem.subjects.length > 0 
            ? newItem.subjects.map(s => ({ id: s.id, title_ar: s.title_ar, title_en: s.title_en })) 
            : [{ id: null, title_ar: "", title_en: "" }];
        form.school_classes = newItem.school_classes && newItem.school_classes.length > 0 
            ? newItem.school_classes.map(c => ({ id: c.id, name: c.name })) 
            : [{ id: null, name: "" }];
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

    // Basic validation for subjects and classes (optional but good)
    const invalidSubject = form.subjects.some(s => !s.title_ar || !s.title_en);
    if (invalidSubject) {
        activeTab.value = 'subjects';
        Swal.fire("تحذير", "يرجى ملء جميع حقول المواد الدراسية", "warning");
        return;
    }

    const invalidClass = form.school_classes.some(c => !c.name);
    if (invalidClass) {
        activeTab.value = 'classes';
        Swal.fire("تحذير", "يرجى ملء جميع حقول فصول المرحلة", "warning");
        return;
    }

    loading.value = true;
    try {
        if (props.item) {
            await adminApi.put(`/education-stages/${props.item.id}`, form);
        } else {
            await adminApi.post("/education-stages", form);
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
        console.error("Error saving education stage:", error);
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
