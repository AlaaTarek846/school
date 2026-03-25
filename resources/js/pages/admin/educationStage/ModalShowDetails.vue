<template>
    <div>
        <div v-if="isVisible" class="modal fade show d-block" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ title }}
                        </h5>
                        <button type="button" class="btn-close" @click="closeModal"></button>
                    </div>
                    <div class="modal-body">
                        <ul class="list-group" v-if="items && items.length > 0">
                            <li v-for="(item, index) in items" :key="index" class="list-group-item d-flex justify-content-between align-items-center">
                                <template v-if="type === 'subjects'">
                                    <span>{{ item.title_ar }} ({{ item.title_en }})</span>
                                </template>
                                <template v-else>
                                    <span>{{ item.name }}</span>
                                </template>
                            </li>
                        </ul>
                        <div v-else class="text-center p-3 text-muted">
                            {{ $t("global.NoDataFound") }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="closeModal">
                            {{ $t("global.close") }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="isVisible" class="modal-backdrop fade show"></div>
    </div>
</template>

<script setup>
import { defineEmits, defineProps } from "vue";

const props = defineProps(['isVisible', 'title', 'items', 'type']);
const emit = defineEmits(['close']);

const closeModal = () => {
    emit("close");
};
</script>
