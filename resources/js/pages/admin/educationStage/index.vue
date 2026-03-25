<template>
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        مراحل التعليم
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
                                <th scope="col">العنوان (عربي)</th>
                                <th scope="col">Title (En)</th>
                                <th scope="col">عدد المواد</th>
                                <th scope="col">عدد الفصول</th>
                                <th scope="col">{{ $t("global.actions") }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="records.length > 0">
                            <tr v-for="(item, index) in records" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.title_ar }}</td>
                                <td>{{ item.title_en }}</td>
                                <td>
                                    <span class="badge bg-primary-transparent">{{ item.subjects ? item.subjects.length : 0 }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary-transparent">{{ item.school_classes ? item.school_classes.length : 0 }}</span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <button
                                            @click="showDetails(item, 'subjects')"
                                            class="btn btn-primary-light btn-sm rounded-pill"
                                            title="عرض المواد"
                                        >
                                            <i class="ri-book-open-line"></i> المواد
                                        </button>
                                        <button
                                            @click="showDetails(item, 'classes')"
                                            class="btn btn-secondary-light btn-sm rounded-pill"
                                            title="عرض الفصول"
                                        >
                                            <i class="ri-layout-grid-line"></i> الفصول
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
                                <td colspan="6" class="text-center">
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
        :type="detailsType"
        @close="closeDetailsModal"
    />
</template>

<script>
import adminApi from "../../../api/adminAxios";
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";
import ModalShowDetails from "./ModalShowDetails.vue";

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
            detailsType: "",
        };
    },
    mounted() {
        this.getResults();
    },
    methods: {
        async getResults(page = 1) {
            try {
                const response = await adminApi.get(
                    `/education-stages?page=${page}&search=${this.search}`
                );
                this.records = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching education stages:", error);
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
        showDetails(item, type) {
            this.detailsType = type;
            if (type === 'subjects') {
                this.detailsTitle = "المواد الدراسية - " + item.title_ar;
                this.detailsItems = item.subjects || [];
            } else {
                this.detailsTitle = "فصول المرحلة - " + item.title_ar;
                this.detailsItems = item.school_classes || [];
            }
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
                    await adminApi.delete(`/education-stages/${id}`);
                    this.getResults();
                    Swal.fire(
                        this.$t("global.Deleted"),
                        this.$t("global.YourFileHasBeenDeleted"),
                        "success"
                    );
                }
            } catch (error) {
                console.error("Error deleting item:", error);
                Swal.fire("Error", "Something went wrong", "error");
            }
        },
    },
};
</script>
