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
                            <!-- Fees Info -->
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
                        <h6>تفاصيل المصروفات (Fee Details)</h6>
                        
                        <div v-for="(detail, index) in form.details" :key="index" class="row align-items-end mb-2">
                            <div class="col-md-5">
                                <label class="form-label">المرحلة الدراسية <span class="text-danger">*</span></label>
                                <select 
                                    class="form-control" 
                                    v-model="detail.education_stage_id"
                                    :class="{ 'is-invalid': v$.details.$each.$response.$data[index].education_stage_id.$error }"
                                >
                                    <option value="" disabled>اختر المرحلة</option>
                                    <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">
                                        {{ stage.title_ar }} / {{ stage.title_en }}
                                    </option>
                                </select>
                                <div v-if="v$.details.$each.$response.$data[index].education_stage_id.$error" class="invalid-feedback">Required</div>
                            </div>
                            <div class="col-md-5">
                                <label class="form-label">السعر (Price) <span class="text-danger">*</span></label>
                                <input 
                                    type="number" 
                                    class="form-control" 
                                    v-model="detail.price"
                                    :class="{ 'is-invalid': v$.details.$each.$response.$data[index].price.$error }"
                                >
                                <div v-if="v$.details.$each.$response.$data[index].price.$error" class="invalid-feedback">Required</div>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-danger" @click="removeDetail(index)" v-if="form.details.length > 1">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        
                        <button class="btn btn-success mt-2" @click="addDetail">
                            <i class="bi bi-plus"></i> إضافة مرحلة أخرى
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
import { required, minValue, numeric, helpers } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";

const { t } = useI18n();
const props = defineProps(['isVisible', 'item']);
const emit = defineEmits(['close', 'refresh']);

const loading = ref(false);
const educationStages = ref([]);

const form = reactive({
    title_ar: "",
    title_en: "",
    note_ar: "",
    note_en: "",
    details: [
        { education_stage_id: "", price: "" }
    ]
});

const rules = computed(() => {
    return {
        title_ar: { required },
        title_en: { required },
        details: {
            required,
            $each: helpers.forEach({
                education_stage_id: { required },
                price: { required, numeric, minValue: minValue(0) }
            })
        }
    };
});

const v$ = useVuelidate(rules, form);

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
    form.details.splice(0, form.details.length, { education_stage_id: "", price: "" });
    v$.value.$reset();
};

onMounted(() => {
    fetchEducationStages();
});

// watch on isVisible is redundant if we fetch on mounted (component is mounted when isVisible is true via v-if in parent)
// But to be safe if parent changes logic, we can keep it, but strictly it's not needed with v-if.
// Let's remove it to simplify and avoid double fetch if v-if works as expected.

watch(() => props.item, (newItem) => {
    if (newItem) {
        form.title_ar = newItem.title_ar;
        form.title_en = newItem.title_en;
        form.note_ar = newItem.note_ar;
        form.note_en = newItem.note_en;
        
        if (newItem.details && newItem.details.length > 0) {
             // We need to completely replace details array, but it's reactive.
             // Best to map and assign.
             const newDetails = newItem.details.map(d => ({
                education_stage_id: d.education_stage_id,
                price: d.price
            }));
            form.details.splice(0, form.details.length, ...newDetails);
        } else {
             form.details.splice(0, form.details.length, { education_stage_id: "", price: "" });
        }

    } else {
        resetForm();
    }
}, { immediate: true });

const addDetail = () => {
    form.details.push({ education_stage_id: "", price: "" });
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
        if (props.item) {
            await adminApi.put(`/fees/${props.item.id}`, form);
        } else {
            await adminApi.post("/fees", form);
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
        console.error("Error saving fee:", error);
        Swal.fire("Error", "Something went wrong", "error");
    } finally {
        loading.value = false;
    }
};
</script>
