<template>
    <div class="row">
        <div class="col-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        قائمة المصروفات
                    </div>
<!--                    <div class="d-flex flex-wrap gap-2">-->
<!--                        <button-->
<!--                            @click="openModal()"-->
<!--                            class="btn btn-primary btn-wave waves-effect waves-light"-->
<!--                        >-->
<!--                            <i class="bi bi-plus-circle"></i> {{ $t("global.add") }}-->
<!--                        </button>-->
<!--                    </div>-->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">العنوان (عربي)</th>
                                <th scope="col">Title (En)</th>
                                <th scope="col">تفاصيل المصروفات</th>
                                <th scope="col">{{ $t("global.actions") }}</th>
                            </tr>
                            </thead>
                            <tbody v-if="records.length > 0">
                            <tr v-for="(item, index) in records" :key="item.id">
                                <td>{{ index + 1 }}</td>
                                <td>{{ item.title_ar }}</td>
                                <td>{{ item.title_en }}</td>
                                <td>
                                    <ul v-if="item.details && item.details.length">
                                        <li v-for="detail in item.details" :key="detail.id">
                                            {{ detail.education_stage ? detail.education_stage.title_ar : 'N/A' }}: {{ detail.price }}
                                        </li>
                                    </ul>
                                    <span v-else>No details</span>
                                </td>
                                <td>
                                    <div class="hstack gap-2 flex-wrap">
                                        <button
                                            @click="edit(item)"
                                            class="btn btn-info btn-sm rounded-pill"
                                        >
                                            <i class="ri-edit-line"></i>
                                        </button>
<!--                                        <button-->
<!--                                            @click="deleteItem(item.id)"-->
<!--                                            class="btn btn-danger btn-sm rounded-pill"-->
<!--                                        >-->
<!--                                            <i class="ri-delete-bin-line"></i>-->
<!--                                        </button>-->
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tbody v-else>
                            <tr>
                                <td colspan="5" class="text-center">
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
</template>

<script>
import adminApi from "../../../api/adminAxios";
import ModalCreateAndUpdate from "./ModalCreateAndUpdate.vue";

export default {
    components: {
        ModalCreateAndUpdate,
    },
    data() {
        return {
            records: [],
            pagination: {},
            isVisible: false,
            currentItem: null,
            search: "",
        };
    },
    mounted() {
        this.getResults();
    },
    methods: {
        async getResults(page = 1) {
            try {
                const response = await adminApi.get(
                    `/fees?page=${page}&search=${this.search}`
                );
                this.records = response.data.data;
                this.pagination = response.data.pagination;
            } catch (error) {
                console.error("Error fetching fees:", error);
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
                    await adminApi.delete(`/fees/${id}`);
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
