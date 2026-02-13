<template>
    <div class="modal fade" id="video-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ type == 'create' ? $t('global.add') : $t('global.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label">{{ $t('global.link') }}</label>
                            <input type="text" class="form-control" v-model="state.link" :class="{'is-invalid': v$.link.$error}">
                            <div v-if="v$.link.$error" class="invalid-feedback">
                                <span v-if="v$.link.required.$invalid">{{ $t('validation.fieldRequired') }}</span>
                                <span v-if="v$.link.url.$invalid">{{ $t('validation.url') }}</span>
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
import { required, url } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const props = defineProps(['type', 'dataRow']);
const emit = defineEmits(['created']);

const loading = ref(false);

const state = reactive({
    link: ''
});

const rules = computed(() => {
    return {
        link: { required, url }
    };
});

const v$ = useVuelidate(rules, state);

watch(() => props.dataRow, (newVal) => {
    if (props.type === 'edit' && newVal) {
        state.link = newVal.link;
    } else {
        resetForm();
    }
});

const resetForm = () => {
    state.link = '';
    v$.value.$reset();
};

const submit = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;
    let data = { link: state.link };

    if (props.type === 'create') {
        adminApi.post('videos', data)
            .then(() => {
                Swal.fire(t('global.success'), t('global.AddedSuccessfully'), 'success');
                emit('created');
                bootstrap.Modal.getInstance(document.getElementById('video-model')).hide();
                resetForm();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    } else {
        adminApi.put(`videos/${props.dataRow.id}`, data)
            .then(() => {
                Swal.fire(t('global.success'), t('global.UpdatedSuccessfully'), 'success');
                emit('created');
                bootstrap.Modal.getInstance(document.getElementById('video-model')).hide();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    }
};
</script>
