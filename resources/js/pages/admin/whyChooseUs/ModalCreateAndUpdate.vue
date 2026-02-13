<template>
    <div class="modal fade" id="area-model" tabindex="-1"
         aria-labelledby="exampleModalLgLabel" aria-hidden="true" >
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLgLabel">
                        {{type == 'create' ? $t('global.add') : $t('global.update')}}
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6 mb-2" v-for="lang in languages">
                            <label class="form-label">{{ $t('label.title') }} ({{ lang == 'ar' ? 'عربي' : 'English' }})</label>
                            <input type="text" class="form-control form-control-lg"  v-model="v$[`title_${lang}`].$model"
                                   :class="{'is-invalid': v$[`title_${lang}`].$error || errors[`title_${lang}`],
                                   'is-valid': !v$[`title_${lang}`].$invalid && !errors[`title_${lang}`]}">

                            <div class="invalid-feedback">
                                <span v-if="v$[`title_${lang}`].required.$invalid">{{ $t('validation.fieldRequired') }}<br /> </span>
                                <span v-if="v$[`title_${lang}`].minLength.$invalid">{{ $t('validation.TitleIsMustHaveAtLeast') }} {{
                                        v$[`title_${lang}`].minLength.$params.min
                                    }} {{ $t('validation.Letters') }} <br />
                                </span>
                                <span v-if="v$[`title_${lang}`].maxLength.$invalid">{{ $t('validation.TitleIsMustHaveAtMost') }} {{
                                        v$[`title_${lang}`].maxLength.$params.max
                                    }} {{ $t('validation.Letters') }}
                                </span></div>
                            <template v-if="errors[`title_${lang}`]">
                                <error-message v-for="(errorMessage, index) in errors[`title_${lang}`]" :key="index">
                                    {{ errorMessage }}
                                </error-message>
                            </template>
                        </div>

                        <div class="col-md-12 mt-3" v-for="lang in languages">
                            <label class="form-label">{{ $t('label.description') }} ({{ lang == 'ar' ? 'عربي' : 'English' }})</label>
                            <Editor ref="descRef" :modules="customModules" v-model="v$[`description_${lang}`].$model"></Editor>
                            <template v-if="errors[`description_${lang}`]">
                                <error-message v-for="(errorMessage, index) in errors[`description_${lang}`]" :key="index">
                                    {{ errorMessage }}
                                </error-message>
                            </template>
                        </div>
                        <h4 class="my-2">التفاصيل</h4>
                        <div class="row border p-2 mb-2" v-for="(detail, index) in submitData.data.details" :key="index">
                            <div class="col-md-6 mt-1" v-for="lang in languages">
                                <label class="form-label">{{ $t('label.title') }} ({{ lang == 'ar' ? 'عربي' : 'English' }})</label>
                                <input type="text" class="form-control form-control-lg"  v-model="submitData.data.details[index][`title_${lang}`]"
                                       :class="{ 'is-invalid': v$.details.$each.$response.$data[index][`title_${lang}`].$error || errors[`details[${index}][title_${lang}]`],
                                    'is-valid': !v$.details.$each.$response.$data[index][`title_${lang}`].$invalid && !errors[`details[${index}][title_${lang}]`] }">
                                <div class="invalid-feedback">
                                <span v-if="v$.details.$each.$response.$data[index][`title_${lang}`].required.$invalid">{{
                                        $t('global.ThisFieldIsRequired') }}<br />
                                </span>
                                </div>
                                <template v-if="errors[`details[${index}][title_${lang}]`]">
                                    <error-message v-for="(errorMessage, index) in errors[`details[${index}][title_${lang}]`]" :key="index">
                                        {{ errorMessage }}
                                    </error-message>
                                </template>
                            </div>



                            <div class="col-md-6 mt-1">
                                <label class="form-label">العدد</label>
                                <input type="number" class="form-control form-control-lg" v-model="submitData.data.details[index].count"
                                       :class="{ 'is-invalid': v$.details.$each.$response.$data[index].count.$error || errors[`details[${index}][count]`],
                                      'is-valid': !v$.details.$each.$response.$data[index].count.$invalid && !errors[`details[${index}][count]`] }">
                                <div class="invalid-feedback">
                                    <span v-if="v$.details.$each.$response.$data[index].count.required.$invalid">{{
                                            $t('global.ThisFieldIsRequired') }}<br />
                                    </span>
                                    <span v-if="v$.details.$each.$response.$data[index].count.integer.$invalid">{{
                                            $t('validation.MustBeInteger') }}<br />
                                    </span>
                                </div>
                            </div>





                            <div class="col-md-12 mt-2 text-end">
                                <button
                                    type="button" class="btn btn-danger btn-sm mx-1"
                                    @click="removeSize(index)"
                                    :title="$t('global.Delete')"
                                    v-if="submitData.data.details.length > 1"
                                >
                                    <i class="ri-delete-bin-line"></i>
                                </button>
                                <button
                                    type="button" class="btn btn-success btn-sm"
                                    :title="$t('global.addLine')"
                                    v-if="(submitData.data.details.length - 1) == index"
                                    @click="addSizeDetail"
                                >
                                    <i class="ri-add-line"></i>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <label class="form-label">{{ $t('global.image') }} (500 * 460)</label>
                            <div class="row img-div-position">
                                <div class="col-12 text-end">
                                    <button
                                        type="button" class="btn btn-danger btn-sm"
                                        @click="imageUpload = ''"
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

                                        <input name="mediaPackageUpload" type="file" @change="preview"
                                               id="photoPersonal1" accept="image/*">

                                        <div id="container-images" class="row justify-content-center h-100"></div>

                                        <div v-if="imageUpload" class="row justify-content-center h-100">
                                            <figure class="col-3" v-if="imageUpload.mime_type && !imageUpload.mime_type.includes('application/pdf')">
                                                <img :src="imageUpload.url" class="img-fluid rounded h-100 w-100 m-1" />
                                            </figure>
                                            <figure class="col-3" v-else-if="imageUpload.url">
                                                 <img :src="imageUpload.url" class="img-fluid rounded h-100 w-100 m-1" />
                                            </figure>
                                            <figure class="col-3" v-else>
                                                <img src="/assets/images/pdf.png" class="img-fluid rounded h-100 w-100 m-1" />
                                            </figure>
                                        </div>

                                        <div class="col-md-12 my-1" v-if="v$.image.$error">
                                            <span class="text-danger" v-if="v$.image.required.$invalid">{{ $t('validation.fieldRequired') }}<br /></span>
                                        </div>
                                        <template v-if="errors['image']">
                                            <error-message v-for="(errorMessage, index) in errors['image']" :key="index">
                                                {{ errorMessage }}
                                            </error-message>
                                        </template>

                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
                </div>
                <div class="modal-footer">
                    <button v-if="type != 'edit'" :disabled="!is_disabled"
                            @click.prevent="resetModal" type="button" class="btn btn-secondary">{{$t('global.AddNewRecord')}}</button>
                    <template v-if="!is_disabled">
                        <button type="submit" v-if="!loading" @click.prevent="AddSubmit" class="btn btn-primary">{{ $t('global.Submit') }}</button>

                        <button class="btn btn-primary btn-loader" v-else>
                            <span class="me-2">{{$t('global.Loading')}}</span>
                            <span class="loading"><i class="ri-loader-2-fill fs-16"></i></span>
                        </button>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {computed, onMounted, reactive, ref, toRefs, watch, nextTick, defineEmits} from "vue";
import {useI18n} from "vue-i18n";
import {maxLength, minLength, required, numeric, requiredIf, minValue, helpers, url, integer} from "@vuelidate/validators";
import useVuelidate from "@vuelidate/core";
import adminApi from "../../../api/adminAxios";
import {useStore} from "vuex";
import Editor from 'primevue/editor';

const components = { Editor };

const customModules = ref({
    toolbar: [
        ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
        ['blockquote', 'code-block'],

        [{ 'header': 1 }, { 'header': 2 }],               // custom button values
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
        [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
        [{ 'direction': 'rtl' }],                        // text direction

        [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

        [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults
        [{ 'font': [] }],
        [{ 'align': [] }],

        ['clean']                                         // remove formatting button
    ],
    theme: 'snow',
})

const props = defineProps({
    type: {default: 'create'},
    dataRow: {default: ''},
});

const emit = defineEmits(['created','getStatus']);

setTimeout(async () => {
    let myModalEl = document.getElementById('area-model')
    myModalEl.addEventListener('show.bs.modal', function (event) {
        resetModal();
    })
    myModalEl.addEventListener('hidden.bs.modal', function (event) {
        resetModalHidden();
    })
}, 150);
const errors = ref([]);
const areas = ref([]);
const languages = ref([]);
const cities = ref([]);
const langValidation = ref({});
const langValidation2 = ref({});
let loading = ref(false);
let is_disabled = ref(false);
const { t } = useI18n({});
const store = useStore();
const id = ref(null);
const imageUpload = ref('');

onMounted(()=>{
    languages.value = store.state.lang.languages;
});

function defaultData(){

    submitData.data.description_ar = '';
    submitData.data.description_en = '';
    submitData.data.title_ar = '';
    submitData.data.title_en = '';
    submitData.data.status = true;
    submitData.data.image = '';
    submitData.data.details = [{}];
    if(languages.value.length == 0){
        languages.value = store.state.lang.languages;
    }
    let langSize = {};
    languages.value.forEach((el)=>{
        let title = `title_${el}`;
        submitData.data.details[0][title] = '';
        langSize[title] = {minLength: minLength(1),maxLength:maxLength(200), required};
    });
    submitData.data.details[0].count = 0;

    langValidation2.value = {
        $each: helpers.forEach({
            ...langSize,
            count: {required, integer}
        })
    };
    is_disabled.value = false;
    loading.value = false;
    errors.value = [];
    imageUpload.value = '';
    let i = document.querySelector('#container-images');
    if(i) { i.innerHTML = ''; }
}
function resetModal() {
    defaultData();
    setTimeout(async () => {
        if (props.type != 'edit') {
        } else {
            id.value = props.dataRow.id;

            adminApi.get(`why-choose-us/${id.value}`)
                .then((res) => {
                    loading.value = true;
                    let l = res.data.data;
                    imageUpload.value = l.image ? { url: l.image } : '';
                    submitData.data.description_ar = l.description_ar;
                    submitData.data.description_en = l.description_en;
                    submitData.data.title_en = l.title_en;
                    submitData.data.title_ar = l.title_ar;
                    submitData.data.details = [];
                    l.details.forEach((el,index) => {
                        submitData.data.details.push({});
                        languages.value.forEach((n)=>{
                            let title = `title_${n}`;
                            submitData.data.details[index][title] = el[title];
                        });
                        submitData.data.details[index].count = el.count;
                    });
                })
                .catch((err) => {
                    console.log(err);
                })
                .finally(() => {
                    loading.value = false;
                })
        }
    }, 50);
}
function resetModalHidden() {
    defaultData();
    nextTick(() => { v$.value.$reset() });
}
//start design
const submitData =  reactive({
    data:{
        description_ar: '',
        description_en: '',
        title_en: '',
        title_ar: '',
        status: true,
        image: '',
        details: []
    }
});

const rules = computed(() => {
    return {
        title_ar: {minLength: minLength(1),maxLength:maxLength(100),required,},
        title_en: {minLength: minLength(1),maxLength:maxLength(100),required,},
        description_ar: {minLength: minLength(1),required,},
        description_en: {minLength: minLength(1),required,},
        details: {
            ...langValidation2.value,
        },
        image: {required: requiredIf( (value) => {
                return props.type == 'create' || !imageUpload.value;
            })
        },
    }
});

const v$ = useVuelidate(rules,submitData.data);

const AddSubmit = () =>  {

    v$.value.$validate();
    errors.value = {};

    let formData = new FormData();
    formData.append('title_ar', submitData.data.title_ar);
    formData.append('title_en', submitData.data.title_en);
    formData.append('description_ar', submitData.data.description_ar);
    formData.append('description_en', submitData.data.description_en);
    if(submitData.data.image){
        formData.append('image', submitData.data.image);
    }
    
    submitData.data.details.forEach((el,index)=>{
        languages.value.forEach((e)=>{
            formData.append(`details[${index}][title_${e}]`, submitData.data.details[index][`title_${e}`]);
        });
        formData.append(`details[${index}][count]`, submitData.data.details[index].count);
    });

    if (props.type !== 'edit') {
        if (!v$.value.$error) {
            is_disabled.value = false;
            loading.value = true;
            adminApi.post(`why-choose-us`, formData)
                .then((res) => {
                    Swal.fire({
                        icon: 'success',
                        title: `${t('global.AddedSuccessfully')}`,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    emit("created");
                    is_disabled.value = true;
                })
                .catch((err) => {
                    errors.value = err.response?.data?.errors;
                })
                .finally(() => {
                    loading.value = false;
                });
        }
    }else if(!v$.value.$error) {
        is_disabled.value = false;
        loading.value = true;
        formData.append('_method','PUT');
        adminApi.post(`why-choose-us/${id.value}`,formData)
            .then((res) => {
                Swal.fire({
                    icon: 'success',
                    title: `${t('global.EditSuccessfully')}`,
                    showConfirmButton: false,
                    timer: 1500
                });
                emit("created");
            })
            .catch((err) => {
                errors.value = err.response?.data?.errors;
            })
            .finally(() => {
                loading.value = false;
            });
    }

}




const preview = (e) => {
    let containerImages = document.querySelector("#container-images");
    containerImages.innerHTML = "";

    if(e) {
        submitData.data.image = {};
        submitData.data.image = e.target.files[0];
        
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
        reader.readAsDataURL(submitData.data.image);
    }
};



function removeSize(index) {
    submitData.data.details.splice(index, 1);
}
function addSizeDetail(index) {
    submitData.data.details.push({});
    languages.value.forEach((el)=>{
        submitData.data.details[submitData.data.details.length - 1][`title_${el}`] = '';
    });
    submitData.data.details[submitData.data.details.length - 1].count = 0;
}
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
