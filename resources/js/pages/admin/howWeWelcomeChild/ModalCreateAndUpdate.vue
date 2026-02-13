<template>
    <div class="modal fade" id="how-we-welcome-child-model" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ type == 'create' ? $t('global.add') : $t('global.update') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-2" v-for="lang in languages" :key="lang">
                            <label class="form-label">{{ $t('label.title') }} ({{ lang == 'ar' ? 'عربي' : 'English' }})</label>
                            <input type="text" class="form-control" v-model="v$[`title_${lang}`].$model"
                                   :class="{'is-invalid': v$[`title_${lang}`].$error}">
                            <div class="invalid-feedback" v-if="v$[`title_${lang}`].$error">
                                {{ $t('validation.fieldRequired') }}
                            </div>
                        </div>

                        <div class="col-md-12 mt-3" v-for="lang in languages" :key="'desc'+lang">
                            <label class="form-label">{{ $t('label.description') }} ({{ lang == 'ar' ? 'عربي' : 'English' }})</label>
                            <Editor :modules="customModules" v-model="v$[`description_${lang}`].$model" />
                            <div class="text-danger" v-if="v$[`description_${lang}`].$error">
                                {{ $t('validation.fieldRequired') }}
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">{{ $t('global.image') }} (500 * 300)</label>
                            <div class="row img-div-position">
                                <div class="col-12 text-end">
                                    <button type="button" class="btn btn-danger btn-sm" @click="removeImage" v-if="imageUpload">
                                        {{ $t('global.deleteImage') }}
                                    </button>
                                </div>
                                <div class="col-md-12 mt-3 d-flex flex-wrap flex-fill h-100">
                                    <div class="btn btn-outline-light waves-effect" style="width: 100%; height:90%">
                                        <span v-if="!imageUpload" style="margin-top:35%;">
                                            <br><i class="bi bi-cloud-upload fs-40" style="font-size: 85px;"></i>
                                            <i class="fas fa-cloud-upload-alt ml-3" aria-hidden="true"></i>
                                        </span>
                                        <input type="file" @change="previewImage" accept="image/*">
                                        <div id="container-images-welcome" class="row justify-content-center h-100"></div>
                                        <div v-if="imageUpload" class="row justify-content-center h-100">
                                            <figure class="col-3" v-if="imageUpload.url">
                                                <img :src="imageUpload.url" class="img-fluid rounded h-100 w-100 m-1" />
                                            </figure>
                                        </div>
                                    </div>
                                    <div class="col-md-12 my-1" v-if="v$.image.$error">
                                        <span class="text-danger">{{ $t('validation.fieldRequired') }}</span>
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
import { ref, reactive, computed, watch, defineEmits, defineProps, onMounted } from "vue";
import useVuelidate from "@vuelidate/core";
import { required, requiredIf } from "@vuelidate/validators";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import { useI18n } from "vue-i18n";
import { useStore } from "vuex";
import Editor from 'primevue/editor';

const { t } = useI18n();
const store = useStore();
const props = defineProps(['type', 'dataRow']);
const emit = defineEmits(['created']);
const languages = ref([]);

const loading = ref(false);
const imageUpload = ref('');
const imageFile = ref(null);

const customModules = ref({
    toolbar: [
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'direction': 'rtl' }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ['clean']
    ]
})

const state = reactive({
    title_ar: '',
    title_en: '',
    description_ar: '',
    description_en: '',
    image: null
});

const rules = computed(() => {
    return {
        title_ar: { required },
        title_en: { required },
        description_ar: { required },
        description_en: { required },
        image: { required: requiredIf(() => props.type === 'create' && !imageUpload.value) }
    };
});

const v$ = useVuelidate(rules, state);

onMounted(() => {
    languages.value = store.state.lang.languages;
    if(languages.value.length == 0){
        languages.value = ['ar', 'en']; // fallback
    }
});

watch(() => props.dataRow, (newVal) => {
    if (props.type === 'edit' && newVal) {
        state.title_ar = newVal.title_ar;
        state.title_en = newVal.title_en;
        state.description_ar = newVal.description_ar;
        state.description_en = newVal.description_en;
        imageUpload.value = newVal.image ? { url: newVal.image } : '';
        state.image = newVal.image;
    } else {
        resetForm();
    }
});

const resetForm = () => {
    state.title_ar = '';
    state.title_en = '';
    state.description_ar = '';
    state.description_en = '';
    state.image = null;
    imageFile.value = null;
    imageUpload.value = '';
    v$.value.$reset();
    let container = document.querySelector("#container-images-welcome");
    if(container) container.innerHTML = "";
};

const previewImage = (e) => {
    let container = document.querySelector("#container-images-welcome");
    container.innerHTML = "";
    imageUpload.value = '';

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
        container.appendChild(figure);
        reader.readAsDataURL(file);
    }
};

const removeImage = () => {
    imageUpload.value = '';
    imageFile.value = null;
    state.image = null;
    let container = document.querySelector("#container-images-welcome");
    if(container) container.innerHTML = "";
}

const submit = async () => {
    const result = await v$.value.$validate();
    if (!result) return;

    loading.value = true;
    let formData = new FormData();
    formData.append('title_ar', state.title_ar);
    formData.append('title_en', state.title_en);
    formData.append('description_ar', state.description_ar);
    formData.append('description_en', state.description_en);
    
    if (imageFile.value) {
        formData.append('image', imageFile.value);
    }

    if (props.type === 'create') {
        adminApi.post('how-we-welcome-child', formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.AddedSuccessfully'), 'success');
                emit('created');
                let modalEl = document.getElementById('how-we-welcome-child-model');
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
        adminApi.post(`how-we-welcome-child/${props.dataRow.id}`, formData)
            .then(() => {
                Swal.fire(t('global.success'), t('global.UpdatedSuccessfully'), 'success');
                emit('created');
                let modalEl = document.getElementById('how-we-welcome-child-model');
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
