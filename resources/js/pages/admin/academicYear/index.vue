<template>
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        السنوات الدراسية
                    </div>
                    <div class="d-flex flex-wrap gap-2">
                        <button
                            @click="openModal()"
                            class="btn btn-primary btn-wave waves-effect waves-light"
                        >
                            <i class="bi bi-plus-circle"></i> {{ $t("global.add") }}
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">العنوان</th>
                                <th scope="col">البداية</th>
                                <th scope="col">النهاية</th>
                                <th scope="col">عدد الفصول</th>
                                <th scope="col">{{ $t("global.actions") }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="records.length > 0">
                            <tr v-for="(item, index) in records" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.name }}</td>
                                <td>{{ item.start_date }}</td>
                                <td>{{ item.end_date }}</td>
                                <td>
                                    <span class="badge bg-primary-transparent">{{ item.semesters ? item.semesters.length : 0 }}</span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <button
                                            @click="showDetails(item)"
                                            class="btn btn-primary-light btn-sm rounded-pill"
                                            title="عرض الفصول"
                                        >
                                            <i class="ri-calendar-line"></i> الفصول
                                        </button>
                                        <button
                                            @click="edit(item)"
                                            class="btn btn-info btn-sm rounded-pill"
                                        >
                                            <i class="ri-edit-line"></i>
                                        </button>
                                        <button
                                            @click="deleteItem(item.id)"
                                            class="btn btn-danger btn-sm rounded-pill"
                                        >
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="7" class="text-center">
                                    {{ $t("global.NoDataFound") }}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center align-items-center">
                            <Pagination
                                :data="pagination"
                                @pagination-change-page="getResults"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <modal-create-and-update
        v-if="isVisible"
        :isVisible="isVisible"
        :item="currentItem"
        @close="closeModal"
        @refresh="getResults"
    />

    <modal-show-details
        v-if="isShowDetailsVisible"
        :isVisible="isShowDetailsVisible"
        :title="detailsTitle"
        :items="detailsItems"
        type="subjects" 
        @close="closeDetailsModal"
    />
</template>

<script>
import adminApi from "../../../api/adminAxios";
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import ModalShowDetails from "../educationStage/ModalShowDetails.vue";
import Swal from "sweetalert2";

export default {
    components: {
        ModalCreateAndUpdate,
        ModalShowDetails,
    },
    data() {
        return {
            records: [],
            pagination: {},
            isVisible: false,
            currentItem: null,
            search: "",
            // Details Modal State
            isShowDetailsVisible: false,
            detailsTitle: "",
            detailsItems: [],
        };
    },
    mounted() {
        this.getResults();
    },
    methods: {
        async getResults(page = 1) {
            try {
                const response = await adminApi.get(
                    `/academic-years?page=${page}&search=${this.search}`
                );
                this.records = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching academic years:", error);
            }
        },
        openModal() {
            this.currentItem = null;
            this.isVisible = true;
        },
        edit(item) {
            this.currentItem = item;
            this.isVisible = true;
        },
        closeModal() {
            this.isVisible = false;
        },
        showDetails(item) {
            this.detailsTitle = "الفصول الدراسية - " + item.name;
            this.detailsItems = item.semesters || [];
            this.isShowDetailsVisible = true;
        },
        closeDetailsModal() {
            this.isShowDetailsVisible = false;
        },
        async deleteItem(id) {
            try {
                 const result = await Swal.fire({
                    title: this.$t("global.AreYouSure"),
                    text: this.$t("global.YouWontBeAbleToRevertThis"),
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: this.$t("global.YesDeleteIt"),
                });

                if (result.isConfirmed) {
                    await adminApi.delete(`/academic-years/${id}`);
                    this.getResults();
                    Swal.fire(
                        this.$t("global.Deleted"),
                        this.$t("global.YourFileHasBeenDeleted"),
                        "success"
                    );
                }
            } catch (error) {
                console.error("Error deleting item:", error);
                if (error.response && error.response.status === 422) {
                    Swal.fire("تنبيه", error.response.data.message || "لا يمكن مسح بيانات مرتبطة", "warning");
                } else {
                    Swal.fire("Error", "Something went wrong", "error");
                }
            }
        },
    },
};
</script>
