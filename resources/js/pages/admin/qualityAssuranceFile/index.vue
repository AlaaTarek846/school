<template>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        ملفات ضمان الجودة
                    </div>
                    <div class="prism-toggle">
                        <button @click="openModal" class="btn btn-primary ripple btn-wave waves-effect waves-light">
                            <i class="ri-add-line"></i>
                            {{$t('global.add')}}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{$t('global.image')}}</th>
                                <th scope="col">{{$t('label.title')}}</th>
                                <th scope="col">PDF</th>
                                <th scope="col">{{$t('global.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody v-if="data && data.length > 0">
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td>{{index + 1}}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar avatar-sm me-2">
                                            <img :src="item.image" alt="img" class="rounded-circle">
                                        </div>
                                    </div>
                                </td>
                                <td>{{ item.title_ar }} / {{ item.title_en }}</td>
                                <td>
                                    <a v-if="item.pdf" :href="item.pdf" target="_blank" class="btn btn-sm btn-outline-danger">
                                        <i class="ri-file-pdf-line"></i> PDF
                                    </a>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">
                                        <a @click="edit(item)" class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i class="ri-edit-line"></i></a>
                                        <a @click="deleteItem(item.id)" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i class="ri-delete-bin-line"></i></a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="5" class="text-center text-danger">{{$t('global.NoDataFound')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <Pagination :data="dataPaginate" @pagination-change-page="getData" />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <ModalCreateAndUpdate :type="type" :dataRow="dataRow" @created="getData(1)" />
</template>

<script setup>
import {ref, onMounted} from "vue";
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import {useI18n} from "vue-i18n";

const {t} = useI18n();
const data = ref([]);
const dataPaginate = ref({});
const type = ref('create');
const dataRow = ref({});
const loading = ref(false);

const getData = (page = 1) => {
    loading.value = true;
    adminApi.get(`quality-assurance-files?page=${page}`)
        .then((res) => {
            data.value = res.data.data;
            dataPaginate.value = res.data.pagination;
        })
        .catch((err) => {
            console.error(err);
        })
        .finally(() => {
            loading.value = false;
        });
}

const openModal = () => {
    type.value = 'create';
    dataRow.value = {};
    let myModal = new bootstrap.Modal(document.getElementById('quality-assurance-file-model'), {
        keyboard: false
    });
    myModal.show();
}

const edit = (item) => {
    type.value = 'edit';
    dataRow.value = item;
    let myModal = new bootstrap.Modal(document.getElementById('quality-assurance-file-model'), {
        keyboard: false
    });
    myModal.show();
}

const deleteItem = (id) => {
    Swal.fire({
        title: t('global.AreYouSure'),
        text: t('global.YouWontBeAbleToRevertThis'),
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: t('global.YesDeleteIt')
    }).then((result) => {
        if (result.isConfirmed) {
            adminApi.delete(`quality-assurance-files/${id}`)
                .then((res) => {
                    Swal.fire(
                        t('global.Deleted'),
                        t('global.YourFileHasBeenDeleted'),
                        'success'
                    )
                    getData();
                })
                .catch((err) => {
                    console.error(err);
                });
        }
    })
}

onMounted(() => {
    getData();
});
</script>
