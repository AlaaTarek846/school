<template>
    <div>
      <!-- Start:: data table -->
      <div class="row">
        <div class="col-xl-12">
          <loader v-if="loading" />
          <div class="card custom-card">
            <div class="card-header justify-content-between">
              <div class="col-md-3">
                 <Select v-model="filterColumns.columns[0].value" :options="sections" 
                        optionLabel="title_ar" optionValue="id"
                        :placeholder="$t('global.section')"
                        class="w-full w-100"
                        @change="getData()"
                ></Select>
              </div>
              <div class="prism-toggle">
                <button @click="showModelCreate"  class="btn btn-sm btn-primary-light" data-bs-toggle="modal" data-bs-target="#area-model">
                  <i class="ri-add-line me-1 fw-semibold align-middle"></i>{{ $t('global.add') }}
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive mb-2">
                <table class="table text-nowrap table-striped">
                  <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('global.section') }}</th>
                    <th scope="col">{{ $t('global.icon') }}</th>
                    <th scope="col">{{ $t('global.text') }}</th>
                    <th scope="col">{{ $t('global.action') }}</th>
                  </tr>
                  </thead>
                  <tbody v-if="data && data.length">
                  <tr v-for="(item,index) in data" :key="item.id">
                    <td scope="row">{{index + 1}}</td>
                    <td>{{ item.section ? item.section.title_ar : '' }}</td>
                    <td><i class="fa-light" :class="item.icon"></i> ({{ item.icon }})</td>
                    <td>{{ item.text_ar }}</td>
                    <td>
                      <div class="hstack gap-2 fs-15">
                        <button
                                @click.prevent="showEditMode(item)"
                                data-bs-toggle="modal" data-bs-target="#area-model"
                                class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                            class="ri-edit-line"></i></button>
                        <a href="#" @click.prevent="deleteData(item.id,index)"
                           class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"><i
                            class="ri-delete-bin-line"></i></a>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                  <tbody v-else>
                  <tr>
                    <th class="text-center" colspan="10">{{ $t('global.NoDataFound') }}</th>
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

    </div>
</template>

<script>
import ModalCreateAndUpdate from "./Modal.vue";
import crud from "../../../composable/crud_structure";
import adminApi from "../../../api/adminAxios";
import {onMounted, ref} from "vue";
import {useI18n} from "vue-i18n";

export default {
  name: "achievements",
  components:{
    ModalCreateAndUpdate
  },
  setup(){

    const {getData,loading,data,filterColumns,dataPaginate,step,uri,showModelCreate,showEditMode,deleteData,search,type,dataRow,modalShow,pagePaginate} = crud();
    const { t } = useI18n({});
    
    const sections = ref([]);

    search.value = {
      searchKey : '',
      searchInTranslations: false,
      columns: ['text_ar', 'text_en'],
    }

    const getSections = async () => {
      try {
        const res = await adminApi.get('get-achievement-sections');
        sections.value = res.data.data;
      } catch (e) {
        console.error(e);
      }
    };

    onMounted(() => {
        uri.value = 'achievements';
        getData();
        getSections();
        step.value = 1;
    });

    filterColumns.value = {
      columns: [
        {
          searchType: 'where',
          opreator: '=',
          column: 'achievement_section_id',
          value: '',
        },
      ],
    }

    return {getData,sections,filterColumns,loading,search,deleteData,showEditMode,showModelCreate,data,dataPaginate,type,dataRow,modalShow,pagePaginate};

  }
}
</script>
