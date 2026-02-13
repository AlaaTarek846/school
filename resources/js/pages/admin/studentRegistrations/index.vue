<template>
    <div>
        <!-- Start:: data table -->
        <div class="row">
            <div class="col-xl-12">
                <loader v-if="loading" />
                <div class="card custom-card">
                    <div class="card-header justify-content-between">
                        <h6 class="card-title">طلبات تسجيل الطلاب</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mb-2">
                            <table class="table text-nowrap table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">
                                            {{ $t("global.name") }}
                                        </th>
                                        <th scope="col">
                                            {{ $t("global.email") }}
                                        </th>
                                        <th scope="col">
                                            {{ $t("global.phone") }}
                                        </th>
                                        <th scope="col">
                                           تاريخ الميلاد
                                        </th>
                                        <th scope="col">
                                            الملف
                                        </th>
                                        <th scope="col">
                                            {{ $t("global.created_at") }}
                                        </th>
                                        <th scope="col">
                                            {{ $t("global.action") }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody v-if="data && data.length">
                                    <tr
                                        v-for="(item, index) in data"
                                        :key="item.id"
                                    >
                                        <td scope="row">{{ index + 1 }}</td>
                                        <td>{{ item.name }}</td>
                                        <td>{{ item.email }}</td>
                                        <td>{{ item.phone }}</td>
                                        <td>{{ item.dob }}</td>
                                        <td>
                                            <a
                                                :href="item.file_url"
                                                target="_blank"
                                                class="btn btn-sm btn-primary-light"
                                            >
                                                <i
                                                    class="ri-download-line me-1"
                                                ></i
                                                >تحميل الملف
                                            </a>
                                        </td>
                                        <td>{{ item.created_at }}</td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a
                                                    href="#"
                                                    @click.prevent="
                                                        deleteData(
                                                            item.id,
                                                            index,
                                                        )
                                                    "
                                                    class="btn btn-icon btn-sm btn-danger-transparent rounded-pill"
                                                    ><i
                                                        class="ri-delete-bin-line"
                                                    ></i
                                                ></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody v-else>
                                    <tr>
                                        <th class="text-center" colspan="10">
                                            {{ $t("global.NoDataFound") }}
                                        </th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination
                            :limit="2"
                            :data="dataPaginate"
                            @pagination-change-page="getData"
                        >
                            <template #prev-nav>
                                <span>&lt; {{ $t("global.Previous") }}</span>
                            </template>
                            <template #next-nav>
                                <span>{{ $t("global.Next") }} &gt;</span>
                            </template>
                        </Pagination>
                    </div>
                </div>
            </div>
        </div>
        <!-- End:: data table -->
    </div>
</template>

<script>
import crud from "../../../composable/crud_structure";
import { onMounted } from "vue";
import { useI18n } from "vue-i18n";

export default {
    name: "studentRegistrations",
    components: {},
    setup() {
        const {
            getData,
            loading,
            data,
            filterColumns,
            dataPaginate,
            step,
            uri,
            showModelCreate,
            showEditMode,
            deleteData,
            search,
            type,
            dataRow,
            modalShow,
            pagePaginate,
        } = crud();
        const { t } = useI18n({});

        search.value = {
            searchKey: "",
            searchInTranslations: false,
            columns: ["name", "email", "phone"],
            searchInRelations: [],
        };

        onMounted(() => {
            uri.value = "student-registrations";
            getData();
            step.value = 1;
        });

        return {
            getData,
            filterColumns,
            loading,
            search,
            deleteData,
            showEditMode,
            showModelCreate,
            data,
            dataPaginate,
            type,
            dataRow,
            modalShow,
            pagePaginate,
        };
    },
};
</script>

<style scoped></style>
