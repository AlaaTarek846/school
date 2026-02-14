<template>
    <div class="modal fade" id="video-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ props.type == 'create' ? $t('global.add') : $t('global.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">{{ $t('global.link') }}</label>
                            <input type="text" class="form-control" v-model="state.link" :class="{'is-invalid': v$.link.$error}">
                            <div v-if="v$.link.$error" class="invalid-feedback">
                                <span v-if="v$.link.url.$invalid">{{ $t('validation.url') }}</span>
                                <span v-if="v$.link.requiredUnless.$invalid">{{ $t('validation.fieldRequired') }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">{{ $t('global.video') }}</label>
                            <input type="file" class="form-control" @change="onFileChange" :class="{'is-invalid': v$.video.$error}" accept="video/*">
                            <div v-if="v$.video.$error" class="invalid-feedback">
                                <span v-if="v$.video.requiredUnless.$invalid">{{ $t('validation.fieldRequired') }}</span>
                            </div>
                            <div v-if="state.video_preview" class="mt-2">
                                <video width="320" height="240" controls :src="state.video_preview"></video>
                            </div>
                         </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ $t('global.close') }}</button>
                    <button type="button" class="btn btn-primary" @click="submit" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ $t('global.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, computed, watch, defineEmits, defineProps } from "vue";
import useVuelidate from "@vuelidate/core";
import { requiredUnless, url } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const props = defineProps(['type', 'dataRow']);
const emit = defineEmits(['created']);

const loading = ref(false);

const state = reactive({
    link: '',
    video: null,
    video_preview: null
});

const rules = computed(() => {
    const hasLink = state.link || (props.type === 'edit' && props.dataRow?.link);
    const hasVideo = state.video || (props.type === 'edit' && props.dataRow?.video);
    
    return {
        link: { url, requiredUnless: requiredUnless(hasVideo) },
        video: { requiredUnless: requiredUnless(hasLink || (props.type === 'edit' && props.dataRow?.video)) }
    };
});

const v$ = useVuelidate(rules, state);

const resetForm = () => {
    state.link = '';
    state.video = null;
    state.video_preview = null;
    v$.value.$reset();
};

const onFileChange = (e) => {
    const file = e.target.files[0];
    if (file) {
        state.video = file;
        state.video_preview = URL.createObjectURL(file);
    } else {
        state.video = null;
        state.video_preview = null;
    }
};

watch([() => props.dataRow, () => props.type], ([newRow, newType]) => {
    if (newType === 'edit' && newRow) {
        state.link = newRow.link;
        state.video = null;
        state.video_preview = newRow.video ? '/' + newRow.video : null;
    } else {
        resetForm();
    }
}, { immediate: true });

const submit = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;
    let formData = new FormData();
    if (state.link) formData.append('link', state.link);
    if (state.video) formData.append('video', state.video);

    if (props.type === 'create') {
        adminApi.post('videos', formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.AddedSuccessfully'), 'success');
                emit('created');
                const modalInstance = bootstrap.Modal.getInstance(document.getElementById('video-model'));
                if (modalInstance) modalInstance.hide();
                resetForm();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    } else {
        formData.append('_method', 'PUT');
        adminApi.post(`videos/${props.dataRow.id}`, formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.UpdatedSuccessfully'), 'success');
                emit('created');
                const modalInstance = bootstrap.Modal.getInstance(document.getElementById('video-model'));
                if (modalInstance) modalInstance.hide();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    }
};
</script>
