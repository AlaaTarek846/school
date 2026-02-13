<template>
    <div class="modal fade" id="gallery-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ type == 'create' ? $t('global.add') : $t('global.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-12 mt-3">
                            <label class="form-label">{{ $t('global.image') }} (300 * 260)</label>
                            <div class="row img-div-position">
                                <div class="col-12 text-end">
                                    <button
                                        type="button" class="btn btn-danger btn-sm"
                                        @click="removeImage"
                                        v-if="imageUpload"
                                    >
                                        {{ $t('global.deleteImage') }}
                                    </button>
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-wrap flex-fill h-100">
                                    <div class="btn btn-outline-light waves-effect" style="width: 100%; height:90%">

                                    <span v-if="!imageUpload" style="margin-top:35%;">
                                        <br><i class="bi bi-cloud-upload fs-40" style="font-size: 85px;"></i>
                                        <i class="fas fa-cloud-upload-alt ml-3" aria-hidden="true"></i>
                                    </span>

                                        <input name="mediaPackageUpload" type="file" @change="previewImage"
                                               id="photoPersonal1" accept="image/*">

                                        <div id="container-images" class="row justify-content-center h-100"></div>

                                        <div v-if="imageUpload" class="row justify-content-center h-100">
                                            <figure class="col-3" v-if="imageUpload.url">
                                                <img :src="imageUpload.url" class="img-fluid rounded h-100 w-100 m-1" />
                                            </figure>
                                        </div>

                                        <div class="col-md-12 my-1" v-if="v$.image.$error">
                                            <span class="text-danger" v-if="v$.image.required.$invalid">{{ $t('validation.fieldRequired') }}<br /></span>
                                        </div>

                                    </div>

                                </div>
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
import { ref, reactive, computed, watch, defineEmits, defineProps, nextTick } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, requiredIf } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const props = defineProps(['type', 'dataRow']);
const emit = defineEmits(['created']);

const loading = ref(false);
const imageUpload = ref('');
const imageFile = ref(null);

const state = reactive({
    image: null
});

const rules = computed(() => {
    return {
        image: { required: requiredIf(() => props.type === 'create' && !imageUpload.value) }
    };
});

const v$ = useVuelidate(rules, state);

watch(() => props.dataRow, (newVal) => {
    if (props.type === 'edit' && newVal) {
        imageUpload.value = newVal.image ? { url: newVal.image } : '';
        state.image = newVal.image;
    } else {
        resetForm();
    }
});

const resetForm = () => {
    state.image = null;
    imageFile.value = null;
    imageUpload.value = '';
    v$.value.$reset();
    let container = document.querySelector("#container-images");
    if(container) container.innerHTML = "";
};

const previewImage = (e) => {
    let containerImages = document.querySelector("#container-images");
    containerImages.innerHTML = "";
    imageUpload.value = ''; // Clear previous if any

    if (e.target.files && e.target.files[0]) {
        const file = e.target.files[0];
        state.image = file;
        imageFile.value = file;

        let reader = new FileReader();
        let figure = document.createElement('figure');
        figure.className = 'col-3';

        reader.onload = () => {
             let img = document.createElement('img');
             img.className = 'img-fluid rounded h-100 w-100 m-1';
             img.setAttribute('src', reader.result);
             figure.appendChild(img);
        }
        containerImages.appendChild(figure);
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    imageUpload.value = '';
    imageFile.value = null;
    state.image = null;
    let container = document.querySelector("#container-images");
    if(container) container.innerHTML = "";
}


const submit = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;
    let formData = new FormData();
    if (imageFile.value) {
        formData.append('image', imageFile.value);
    }

    if (props.type === 'create') {
        adminApi.post('galleries', formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.AddedSuccessfully'), 'success');
                emit('created');
                let modalEl = document.getElementById('gallery-model');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
                resetForm();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    } else {
        formData.append('_method', 'PUT');
        adminApi.post(`galleries/${props.dataRow.id}`, formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.UpdatedSuccessfully'), 'success');
                emit('created');
                let modalEl = document.getElementById('gallery-model');
                let modal = bootstrap.Modal.getInstance(modalEl);
                modal.hide();
            })
            .catch((err) => {
                console.error(err);
            })
            .finally(() => loading.value = false);
    }
};
</script>

<style scoped>
.ml-3 {
    margin-left: 1.5rem;
}

.waves-effect {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    user-select: none;
    -webkit-tap-highlight-color: transparent;
    width: 200px;
    height: 50px;
    text-align: center;
    line-height: 34px;
    margin: auto;
}

.waves-effect input[type="file"] {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    padding: 0;
    margin: 0;
    cursor: pointer;
    filter: alpha(opacity=0);
    opacity: 0;
}

.waves-effect[data-v-d8970579] {
    background-color: #e9e9e9;
}
</style>
