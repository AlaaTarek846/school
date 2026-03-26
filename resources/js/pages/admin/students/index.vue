<template>
  <div>
    <!-- Start:: data table -->
    <div class="row">
      <div class="col-xl-12">
        <loader v-if="loading" />
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="d-flex gap-2">
              <button @click="showModelCreate" class="btn btn-sm btn-primary-light" data-bs-toggle="modal" data-bs-target="#area-model">
                <i class="ri-add-line me-1 fw-semibold align-middle"></i>{{ $t('global.add') }}
              </button>
              <button class="btn btn-sm btn-success-light" data-bs-toggle="modal" data-bs-target="#import-model">
                <i class="ri-upload-2-line me-1 fw-semibold align-middle"></i>{{ $t('admin.import_excel') }}
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive mb-2">
              <table class="table text-nowrap table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('global.name') }}</th>
                    <th scope="col">{{ $t('global.email') }}</th>
                    <th scope="col">{{ $t('admin.code') }}</th>
                    <th scope="col">{{ $t('admin.gender') }}</th>
                    <th scope="col">{{ $t('admin.school_class') }}</th>
                    <th scope="col">{{ $t('admin.status') }}</th>
                    <th scope="col">{{ $t('global.action') }}</th>
                  </tr>
                </thead>
                <tbody v-if="data && data.length">
                  <tr v-for="(item,index) in data" :key="item.id">
                    <td scope="row">{{index + 1}}</td>
                    <td>{{item.name}}</td>
                    <td>{{item.email}}</td>
                    <td>{{item.code}}</td>
                    <td>{{ $t('admin.' + item.gender) }}</td>
                    <td>{{item.school_class_name}}</td>
                    <td>
                      <span :class="item.is_active ? 'badge bg-success-transparent' : 'badge bg-danger-transparent'">
                        {{ item.is_active ? $t('admin.active') : $t('admin.inactive') }}
                      </span>
                    </td>
                    <td>
                      <div class="hstack gap-2 fs-15">
                        <button
                          @click.prevent="showEditMode(item)"
                          data-bs-toggle="modal" data-bs-target="#area-model"
                          class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                            class="ri-edit-line"></i></button>
                        <a href="#" @click.prevent="deleteData(item.id, index)"
                           class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i
                            class="ri-delete-bin-line"></i></a>
                      </div>
                    </td>
                  </tr>
                </tbody>
                <tbody v-else>
                  <tr>
                    <th class="text-center" colspan="8">{{ $t('global.NoDataFound') }}</th>
                  </tr>
                </tbody>
              </table>
            </div>
            <Pagination :limit="2" :data="dataPaginate" @pagination-change-page="getData">
              <template #prev-nav>
                <span>&lt; {{$t('global.Previous')}}</span>
              </template>
              <template #next-nav>
                <span>{{$t('global.Next')}} &gt;</span>
              </template>
            </Pagination>
          </div>
        </div>
      </div>
    </div>
    <!-- End:: data table -->
    
    <ModalCreateAndUpdate v-model="modalShow" :type="type" :dataRow="dataRow" @created="getData(pagePaginate)" />
    <ModalImport @imported="getData(pagePaginate)" />

  </div>
</template>

<script>
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import ModalImport from "./ModalImport.vue";
import crud from "../../../composable/crud_structure";
import {onMounted, ref} from "vue";
import {useI18n} from "vue-i18n";

export default {
  name: "students",
  components:{
    ModalCreateAndUpdate,
    ModalImport
  },
  setup(){
    const {getData, loading, data, filterColumns, dataPaginate, step, uri, showModelCreate, showEditMode, deleteData, search, type, dataRow, modalShow, pagePaginate} = crud();
    const { t } = useI18n({});
    search.value = {
      searchKey : '',
      searchInTranslations: true,
      columns: ['id'],
      searchInRelations: []
    }
    
    onMounted(() => {
        uri.value = 'students';
        getData();
        step.value = 1;
    });

    filterColumns.value = {
      columns: [
        {
          searchType: 'where',
          opreator: '=',
          column: 'is_active',
          value: '',
        },
      ],
    }

    return {getData, filterColumns, loading, search, deleteData, showEditMode, showModelCreate, data, dataPaginate, type, dataRow, modalShow, pagePaginate};
  }
}
</script>
