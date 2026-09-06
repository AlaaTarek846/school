<template>
    <div class="modal fade" id="gallery-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ type == 'create' ? $t('global.add') : $t('global.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">
                                {{ $t('global.image') }}
                                <span class="text-muted fw-normal">(300 × 260)</span>
                            </label>
                            <div class="text-muted small mb-2">
                                <i class="ri-information-line"></i>
                                الحد الأقصى لحجم الصورة: <strong>800 كيلوبايت</strong>
                                <span v-if="type === 'create'"> - يمكن اختيار أكثر من صورة</span>
                            </div>

                            <div v-if="sizeError" class="alert alert-danger d-flex align-items-center py-2 mb-2">
                                <i class="ri-error-warning-line fs-5 me-2"></i>
                                <span>{{ sizeError }}</span>
                                <button type="button" class="btn-close ms-auto" @click="sizeError = ''"></button>
                            </div>

                            <div v-if="serverErrors.length" class="alert alert-danger py-2 mb-2">
                                <ul class="mb-0 ps-3">
                                    <li v-for="(err, i) in serverErrors" :key="i" class="small">{{ err }}</li>
                                </ul>
                            </div>

                            <!-- Upload Zone -->
                            <div class="gallery-upload-zone" :class="{ 'has-images': previews.length || imageUpload }"
                                 @click="triggerFileInput"
                                 @dragover.prevent
                                 @drop.prevent="handleDrop">

                                <input ref="fileInput" type="file" @change="previewImages"
                                       :accept="'image/jpeg,image/png,image/jpg,image/gif'"
                                       :multiple="type === 'create'"
                                       class="d-none">

                                <!-- Empty State -->
                                <div v-if="!previews.length && !imageUpload" class="gallery-upload-empty">
                                    <i class="ri-image-add-line"></i>
                                    <p class="mb-1">اسحب الصور هنا أو اضغط للاختيار</p>
                                    <small class="text-muted">
                                        JPEG, PNG, JPG, GIF — حتى 800 KB
                                        <span v-if="type === 'create'"> — عدة صور</span>
                                    </small>
                                </div>

                                <!-- Create: Multiple Previews -->
                                <div v-if="type === 'create' && previews.length" class="gallery-previews-grid">
                                    <div v-for="(preview, idx) in previews" :key="idx" class="gallery-preview-item">
                                        <img :src="preview.url" :alt="'Image ' + (idx + 1)">
                                        <button type="button" class="gallery-preview-remove" @click.stop="removePreview(idx)" title="إزالة">
                                            <i class="ri-close-line"></i>
                                        </button>
                                        <span class="gallery-preview-size">{{ preview.sizeKB }} KB</span>
                                    </div>
                                    <!-- Add More Button -->
                                    <div class="gallery-preview-item gallery-add-more" @click.stop="triggerFileInput">
                                        <i class="ri-add-line"></i>
                                        <small>إضافة</small>
                                    </div>
                                </div>

                                <!-- Edit: Single Preview -->
                                <div v-if="type === 'edit' && imageUpload" class="gallery-previews-grid">
                                    <div class="gallery-preview-item">
                                        <img :src="imageUpload.url" alt="Current image">
                                        <button type="button" class="gallery-preview-remove" @click.stop="removeAllImages" title="إزالة">
                                            <i class="ri-close-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Vuelidate Error -->
                            <div v-if="v$.image.$error" class="text-danger small mt-1">
                                <span v-if="v$.image.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
                    <button type="button" class="btn btn-primary" @click="submit" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm me-1" role="status"></span>
                        {{ loading ? $t('global.Loading') : $t('global.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch, defineEmits, defineProps } from "vue";
import useVuelidate from "@vuelidate/core";
import { requiredIf } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const props = defineProps(['type', 'dataRow']);
const emit = defineEmits(['created']);

const MAX_SIZE_KB = 800;
const MAX_SIZE_BYTES = MAX_SIZE_KB * 1024;

const loading = ref(false);
const imageUpload = ref('');
const imageFile = ref(null);
const previews = ref([]);
const selectedFiles = ref([]);
const sizeError = ref('');
const serverErrors = ref([]);
const fileInput = ref(null);

const state = reactive({
    image: null
});

const rules = computed(() => ({
    image: {
        required: requiredIf(() => {
            if (props.type === 'create') return !selectedFiles.value.length;
            return !imageUpload.value;
        })
    }
}));

const v$ = useVuelidate(rules, state);

watch(() => props.dataRow, (newVal) => {
    if (props.type === 'edit' && newVal) {
        imageUpload.value = newVal.image ? { url: newVal.image } : '';
        state.image = newVal.image;
        previews.value = [];
        selectedFiles.value = [];
    } else {
        resetForm();
    }
});

const resetForm = () => {
    state.image = null;
    imageFile.value = null;
    imageUpload.value = '';
    previews.value = [];
    selectedFiles.value = [];
    sizeError.value = '';
    serverErrors.value = [];
    v$.value.$reset();
};

const triggerFileInput = () => {
    fileInput.value?.click();
};

const handleDrop = (e) => {
    const files = e.dataTransfer.files;
    if (files.length) processFiles(files);
};

const validateFileSize = (file) => file.size <= MAX_SIZE_BYTES;

const processFiles = (fileList) => {
    sizeError.value = '';
    const rejectedNames = [];

    for (let i = 0; i < fileList.length; i++) {
        if (!validateFileSize(fileList[i])) {
            rejectedNames.push(fileList[i].name);
            continue;
        }
        selectedFiles.value.push(fileList[i]);
        previews.value.push({
            url: URL.createObjectURL(fileList[i]),
            sizeKB: Math.round(fileList[i].size / 1024)
        });
    }

    if (rejectedNames.length) {
        sizeError.value = `الصور التالية تتجاوز ${MAX_SIZE_KB} كيلوبايت: ${rejectedNames.join(', ')}`;
    }
};

const previewImages = (e) => {
    const files = e.target.files;
    if (!files || !files.length) return;

    if (props.type === 'edit') {
        const file = files[0];
        if (!validateFileSize(file)) {
            sizeError.value = `حجم الصورة يتجاوز ${MAX_SIZE_KB} كيلوبايت`;
            e.target.value = '';
            return;
        }
        state.image = file;
        imageFile.value = file;
        imageUpload.value = { url: URL.createObjectURL(file) };
        e.target.value = '';
        return;
    }

    processFiles(files);
    e.target.value = '';
};

const removePreview = (index) => {
    URL.revokeObjectURL(previews.value[index].url);
    previews.value.splice(index, 1);
    selectedFiles.value.splice(index, 1);
    if (!selectedFiles.value.length) state.image = null;
};

const removeAllImages = () => {
    previews.value.forEach(p => URL.revokeObjectURL(p.url));
    previews.value = [];
    selectedFiles.value = [];
    imageUpload.value = '';
    imageFile.value = null;
    state.image = null;
};

const submit = async () => {
    serverErrors.value = [];
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;

    if (props.type === 'create') {
        const formData = new FormData();
        selectedFiles.value.forEach((file) => formData.append('images[]', file));

        adminApi.post('galleries', formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
            .then(() => {
                Swal.fire(t('global.success'), t('global.AddedSuccessfully'), 'success');
                emit('created');
                bootstrap.Modal.getInstance(document.getElementById('gallery-model'))?.hide();
                resetForm();
            })
            .catch((err) => {
                if (err.response?.data?.errors) {
                    const errs = err.response.data.errors;
                    serverErrors.value = Object.values(errs).flat();
                }
            })
            .finally(() => loading.value = false);
    } else {
        const formData = new FormData();
        if (imageFile.value) formData.append('image', imageFile.value);
        formData.append('_method', 'PUT');

        adminApi.post(`galleries/${props.dataRow.id}`, formData, {
            headers: { 'Content-Type': 'multipart/form-data' }
        })
            .then(() => {
                Swal.fire(t('global.success'), t('global.UpdatedSuccessfully'), 'success');
                emit('created');
                bootstrap.Modal.getInstance(document.getElementById('gallery-model'))?.hide();
            })
            .catch((err) => {
                if (err.response?.data?.errors) {
                    const errs = err.response.data.errors;
                    serverErrors.value = Object.values(errs).flat();
                }
            })
            .finally(() => loading.value = false);
    }
};
</script>

<style scoped>
.gallery-upload-zone {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 30px 20px;
    text-align: center;
    cursor: pointer;
    transition: all 0.25s ease;
    background: #fafbfc;
    min-height: 140px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.gallery-upload-zone:hover {
    border-color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), 0.03);
}

.gallery-upload-zone.has-images {
    padding: 15px;
    border-style: solid;
    border-color: #e5e7eb;
    background: #fff;
}

.gallery-upload-empty i {
    font-size: 48px;
    color: #9ca3af;
    display: block;
    margin-bottom: 8px;
}

.gallery-upload-empty p {
    font-size: 15px;
    color: #4b5563;
    font-weight: 500;
}

.gallery-previews-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 12px;
    width: 100%;
}

.gallery-preview-item {
    position: relative;
    border-radius: 10px;
    overflow: hidden;
    aspect-ratio: 300 / 260;
    border: 1px solid #e5e7eb;
    background: #f3f4f6;
}

.gallery-preview-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.gallery-preview-remove {
    position: absolute;
    top: 4px;
    left: 4px;
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: rgba(220, 53, 69, 0.9);
    color: #fff;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    cursor: pointer;
    line-height: 1;
    padding: 0;
    transition: background 0.2s;
}

.gallery-preview-remove:hover {
    background: #dc3545;
}

.gallery-preview-size {
    position: absolute;
    bottom: 4px;
    right: 4px;
    background: rgba(0, 0, 0, 0.65);
    color: #fff;
    font-size: 11px;
    padding: 2px 6px;
    border-radius: 4px;
    font-weight: 500;
}

.gallery-add-more {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    border-style: dashed;
    border-color: #c4c9d0;
    background: #f9fafb;
    color: #6b7280;
    cursor: pointer;
    transition: all 0.2s;
}

.gallery-add-more:hover {
    border-color: var(--bs-primary);
    color: var(--bs-primary);
    background: rgba(var(--bs-primary-rgb), 0.04);
}

.gallery-add-more i {
    font-size: 24px;
}

.gallery-add-more small {
    font-size: 12px;
    margin-top: 2px;
}
</style>
