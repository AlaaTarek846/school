<template>
    <div>
      <div class="row">
        <div class="col-xl-12">
          <loader v-if="loading" />
          <div class="card custom-card">
            <div class="card-header justify-content-between">
              <div class="card-title">فخر المدرسة</div>
            </div>
            <div class="card-body">
              <div class="table-responsive mb-2">
                <table class="table text-nowrap table-striped">
                  <thead>
                  <tr>
                    <th scope="col">المكان</th>
                    <th scope="col">العنوان</th>
                    <th scope="col">{{ $t('global.action') }}</th>
                  </tr>
                  </thead>
                  <tbody v-if="data && data.length">
                  <tr v-for="item in data" :key="item.id">
                    <td>{{ item.card_type == 'left' ? 'البطاقة اليسرى (كبيرة)' : 'البطاقة اليمنى' }}</td>
                    <td>{{ item.title_ar }}</td>
                    <td>
                      <div class="hstack gap-2 fs-15">
                        <button
                                @click.prevent="showEditMode(item)"
                                data-bs-toggle="modal" data-bs-target="#pride-modal"
                                class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                            class="ri-edit-line"></i></button>
                      </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <ModalUpdate v-model="modalShow" :dataRow="dataRow" @updated="getData" />
    </div>
</template>

<script>
import ModalUpdate from "./Modal.vue";
import adminApi from "../../../api/adminAxios";
import {onMounted, ref} from "vue";

export default {
  components: { ModalUpdate },
  setup() {
    const data = ref([]);
    const loading = ref(false);
    const modalShow = ref(false);
    const dataRow = ref(null);

    const getData = async () => {
      loading.value = true;
      try {
        const res = await adminApi.get('school-prides');
        data.value = res.data.data;
      } catch (e) {
        console.error(e);
      } finally {
        loading.value = false;
      }
    };

    const showEditMode = (item) => {
      dataRow.value = item;
      modalShow.value = true;
    };

    onMounted(getData);

    return { data, loading, modalShow, dataRow, getData, showEditMode };
  }
}
</script>
