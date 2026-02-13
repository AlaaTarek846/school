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
                            <!-- Title AR -->
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

                            <!-- Title EN -->
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

const form = reactive({
    title_ar: "",
    title_en: "",
});

const rules = computed(() => {
    return {
        title_ar: { required },
        title_en: { required },
    };
});

const v$ = useVuelidate(rules, form);

const resetForm = () => {
    form.title_ar = "";
    form.title_en = "";
    v$.value.$reset();
};

watch(() => props.item, (newItem) => {
    if (newItem) {
        form.title_ar = newItem.title_ar;
        form.title_en = newItem.title_en;
    } else {
        resetForm();
    }
}, { immediate: true });

const closeModal = () => {
    emit("close");
};

const submitForm = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

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
        Swal.fire("Error", "Something went wrong", "error");
    } finally {
        loading.value = false;
    }
};
</script>
