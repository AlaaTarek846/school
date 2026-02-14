<template>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        الفيديو
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
                                <th scope="col">{{$t('global.link')}}</th>
                                <th scope="col">{{$t('global.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody v-if="data && data.length > 0">
                            <tr v-for="(item,index) in data" :key="item.id">
                                <td>{{index + 1}}</td>
                                <td>
                                    <a v-if="item.link" :href="item.link" target="_blank">{{ item.link }}</a>
                                    <a v-else-if="item.video" :href="'/' + item.video" target="_blank" class="btn btn-sm btn-outline-primary">
                                        <i class="ri-video-line"></i> {{ $t('global.ViewVideo') }}
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
                                    <td colspan="3" class="text-center text-danger">{{$t('global.NoDataFound')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer" v-if="dataPaginate && dataPaginate.current_page">
                    <Pagination :data="dataPaginate" @pagination-change-page="getData" />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <ModalCreateAndUpdate :type="type" :dataRow="dataRow" :key="type + (dataRow?.id || 'new')" @created="getData(1)" />
</template>

<script setup>
import {ref, onMounted, nextTick} from "vue";
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
    adminApi.get(`videos?page=${page}`)
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

const openModal = async () => {
    type.value = 'create';
    dataRow.value = {};
    await nextTick();
    let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('video-model'));
    myModal.show();
}

const edit = async (item) => {
    type.value = 'edit';
    dataRow.value = item;
    await nextTick();
    let myModal = bootstrap.Modal.getOrCreateInstance(document.getElementById('video-model'));
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
            adminApi.delete(`videos/${id}`)
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
