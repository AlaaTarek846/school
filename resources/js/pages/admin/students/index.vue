<template>
  <div>
    <!-- Start:: data table -->
    <div class="row">
      <div class="col-xl-12">
        <loader v-if="loading" />
        <div class="card custom-card">
          <div class="card-header justify-content-between">
            <div class="d-flex flex-wrap gap-3 align-items-center w-100">
              <div class="d-flex gap-2">
                <button @click="showModelCreate" class="btn btn-sm btn-primary-light" data-bs-toggle="modal" data-bs-target="#area-model">
                  <i class="ri-add-line me-1 fw-semibold align-middle"></i>{{ $t('global.add') }}
                </button>
                <button class="btn btn-sm btn-success-light" data-bs-toggle="modal" data-bs-target="#import-model">
                  <i class="ri-upload-2-line me-1 fw-semibold align-middle"></i>{{ $t('admin.import_excel') }}
                </button>
                <button v-if="selectedIds.length > 0" class="btn btn-sm btn-info-light animate__animated animate__fadeIn" data-bs-toggle="modal" data-bs-target="#bulk-score-model">
                  <i class="ri-clipboard-line me-1 fw-semibold align-middle"></i>{{ $t('translation.bulk_manage_score') }}
                  <span class="badge bg-info ms-1">{{ selectedIds.length }}</span>
                </button>
              </div>

              <div class="flex-fill">
                <input type="text" class="form-control form-control-sm" :placeholder="$t('global.Search') + '...'" v-model="search.searchKey">
              </div>

              <div style="min-width: 150px;">
                <select class="form-control form-control-sm" v-model="selectedStage" @change="handleStageChange">
                  <option value="">{{ $t('admin.education_stage') }} ({{ $t('global.all') }})</option>
                  <option v-for="stage in educationStages" :key="stage.id" :value="stage.id">
                    {{ $i18n.locale == 'ar' ? stage.title_ar : stage.title_en }}
                  </option>
                </select>
              </div>

              <div style="min-width: 150px;" v-if="selectedStage">
                <select class="form-control form-control-sm" v-model="selectedClass" @change="handleClassChange">
                  <option value="">{{ $t('admin.school_class') }} ({{ $t('global.all') }})</option>
                  <option v-for="cls in schoolClasses" :key="cls.id" :value="cls.id">{{ cls.name }}</option>
                </select>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="table-responsive mb-2">
              <table class="table text-nowrap table-striped">
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px;">
                      <input class="form-check-input" type="checkbox" @change="toggleSelectAll" :checked="isAllSelected">
                    </th>
                    <th scope="col">#</th>
                    <th scope="col">{{ $t('global.name') }}</th>
                    <th scope="col">{{ $t('admin.code') }}</th>
                    <th scope="col">{{ $t('admin.gender') }}</th>
                    <th scope="col">{{ $t('admin.education_stage') }}</th>
                    <th scope="col">{{ $t('admin.school_class') }}</th>
                    <th scope="col">{{ $t('admin.total_score') }}</th>
                    <th scope="col">{{ $t('admin.status') }}</th>
                    <th scope="col">{{ $t('global.action') }}</th>
                  </tr>
                </thead>
                <tbody v-if="data && data.length">
                  <tr v-for="(item,index) in data" :key="item.id" :class="{'table-primary-transparent': selectedIds.includes(item.id)}">
                    <td>
                      <input class="form-check-input" type="checkbox" :value="item.id" v-model="selectedIds">
                    </td>
                    <td scope="row">{{index + 1}}</td>
                    <td class="fw-medium text-primary">{{item.name}}</td>
                    <td><span class="badge bg-light text-dark border">{{item.code}}</span></td>
                    <td>{{ $t('admin.' + item.gender) }}</td>
                    <td>{{item.education_stage_name}}</td>
                    <td>{{item.school_class_name}}</td>
                    <td>
                      <span class="fw-bold">{{item.total_score}}</span>
                    </td>
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
                          class="btn btn-icon btn-sm btn-info-transparent rounded-pill shadow-sm"><i
                            class="ri-edit-line"></i></button>
                        <a href="#" @click.prevent="deleteData(item.id, index)"
                           class="btn btn-icon btn-sm btn-danger-transparent rounded-pill shadow-sm"><i
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
    <ModalImport @imported="getData(pagePaginate)" />
    <BulkScoreModal :selectedStudents="selectedStudents" @updated="handleBulkUpdated" />

  </div>
</template>

<script>
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import ModalImport from "./ModalImport.vue";
import BulkScoreModal from "./BulkScoreModal.vue";
import crud from "../../../composable/crud_structure";
import {onMounted, ref, watch, computed} from "vue";
import {useI18n} from "vue-i18n";
import adminApi from "../../../api/adminAxios";

export default {
  name: "students",
  components:{
    ModalCreateAndUpdate,
    ModalImport,
    BulkScoreModal
  },
  setup(){
    const {getData, loading, data, filterColumns, dataPaginate, step, uri, showModelCreate, showEditMode, deleteData, search, type, dataRow, modalShow, pagePaginate} = crud();
    const { t } = useI18n({});

    const educationStages = ref([]);
    const schoolClasses = ref([]);
    const selectedStage = ref('');
    const selectedClass = ref('');
    const selectedIds = ref([]);

    const selectedStudents = computed(() => {
      return data.value.filter(s => selectedIds.value.includes(s.id));
    });

    const isAllSelected = computed(() => {
      return data.value.length > 0 && selectedIds.value.length === data.value.length;
    });

    const toggleSelectAll = () => {
      if (isAllSelected.value) {
        selectedIds.value = [];
      } else {
        selectedIds.value = data.value.map(s => s.id);
      }
    };

    const handleBulkUpdated = () => {
      selectedIds.value = [];
      getData(pagePaginate.value);
    };

    search.value = {
      searchKey : '',
      searchInTranslations: false,
      columns: ['name', 'code', 'username', 'email', 'phone_1'],
      searchInRelations: []
    }

    onMounted(() => {
        uri.value = 'students';
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
        getData();
        fetchStages();
        step.value = 1;
    });

    const fetchStages = () => {
      adminApi.get(`students/form-data`).then((res) => {
        educationStages.value = res.data.data.educationStages;
      });
    };

    const handleStageChange = () => {
      selectedClass.value = '';
      schoolClasses.value = [];
      
      // Update filter columns
      const filters = [
        {
          searchType: 'where',
          opreator: '=',
          column: 'is_active',
          value: '',
        }
      ];

      if (selectedStage.value) {
        filters.push({
          searchType: 'whereRelation',
          relation_name: 'currentEnrollment',
          column: 'education_stage_id',
          opreator: '=',
          value: selectedStage.value,
        });

        // Fetch classes for this stage
        adminApi.get(`students/get-classes/${selectedStage.value}`).then((res) => {
          schoolClasses.value = res.data.data;
        });
      }

      filterColumns.value.columns = filters;
    };

    const handleClassChange = () => {
      const filters = [
        {
          searchType: 'where',
          opreator: '=',
          column: 'is_active',
          value: '',
        }
      ];

      if (selectedStage.value) {
        filters.push({
          searchType: 'whereRelation',
          relation_name: 'currentEnrollment',
          column: 'education_stage_id',
          opreator: '=',
          value: selectedStage.value,
        });
      }

      if (selectedClass.value) {
        filters.push({
          searchType: 'whereRelation',
          relation_name: 'currentEnrollment',
          column: 'school_class_id',
          opreator: '=',
          value: selectedClass.value,
        });
      }

      filterColumns.value.columns = filters;
    };

    return {
      getData, loading, data, dataPaginate, type, dataRow, modalShow, pagePaginate,
      search, filterColumns, deleteData, showEditMode, showModelCreate,
      educationStages, schoolClasses, selectedStage, selectedClass,
      handleStageChange, handleClassChange,
      selectedIds, selectedStudents, isAllSelected, toggleSelectAll, handleBulkUpdated
    };
  }
}
</script>

<style scoped>
.table-primary-transparent {
    background-color: rgba(var(--bs-primary-rgb), 0.05) !important;
}
.form-check-input {
    cursor: pointer;
}
.card-header .btn {
    transition: all 0.3s ease;
}
tr {
    transition: background-color 0.2s ease;
}
</style>
