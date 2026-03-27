<template>
    <div class="modal fade show" tabindex="-1" style="display: block; background: rgba(0, 0, 0, 0.5);">
        <div class="modal-dialog modal-dialog-centered shadow-lg">
            <div class="modal-content border-0 rounded-4 overflow-hidden">
                <div class="modal-header bg-info text-white py-3">
                    <h5 class="modal-title d-flex align-items-center fw-bold">
                        <i class="ri-edit-circle-line me-2 fs-4"></i>
                        {{ $t('translation.Update Score & Status') }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" @click="$emit('close')"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-info-transparent d-flex align-items-center mb-4 rounded-3 small">
                        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
                        <div>
                            {{ $t('translation.Update results for') }} <strong>{{ item.student.name }}</strong> 
                            {{ $t('translation.in') }} <strong>{{ item.exam.title_ar }}</strong>
                        </div>
                    </div>
                    
                    <form @submit.prevent="update">
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted mb-2">
                                {{ $t('translation.Score Obtained') }} 
                                <span class="text-info">(max: {{ item.exam.total_score }})</span>
                            </label>
                            <div class="input-group input-group-lg shadow-sm">
                                <input 
                                    type="number" 
                                    v-model="form.answer_score" 
                                    class="form-control text-center fw-bold text-primary border-2 border-info-light" 
                                    :max="item.exam.total_score" 
                                    min="0"
                                    step="0.5"
                                    required
                                />
                                <span class="input-group-text bg-info-light border-2 border-info-light text-muted">
                                    / {{ item.exam.total_score }}
                                </span>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted mb-2">
                                {{ $t('translation.Pass Status') }}
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check form-check-inline-custom p-0 m-0 flex-grow-1">
                                    <input 
                                        type="radio" 
                                        v-model="form.is_passed" 
                                        :value="1" 
                                        id="passed-radio"
                                        class="btn-check"
                                    />
                                    <label class="btn btn-outline-success w-100 rounded-pill py-2 px-3 fw-bold shadow-sm" for="passed-radio">
                                        <i class="bi bi-check-circle me-1"></i>
                                        {{ $t('translation.Passed') }}
                                    </label>
                                </div>
                                <div class="form-check form-check-inline-custom p-0 m-0 flex-grow-1">
                                    <input 
                                        type="radio" 
                                        v-model="form.is_passed" 
                                        :value="0" 
                                        id="failed-radio"
                                        class="btn-check"
                                    />
                                    <label class="btn btn-outline-danger w-100 rounded-pill py-2 px-3 fw-bold shadow-sm" for="failed-radio">
                                        <i class="bi bi-x-circle me-1"></i>
                                        {{ $t('translation.Failed') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light border-0 py-3">
                    <button type="button" class="btn btn-secondary rounded-pill px-4" @click="$emit('close')">
                        {{ $t('global.close') }}
                    </button>
                    <button type="button" class="btn btn-info text-white rounded-pill px-4 shadow ripple" @click="update" :disabled="loading">
                        <span v-if="loading" class="spinner-border spinner-border-sm me-2"></span>
                        <i v-else class="bi bi-save me-1"></i>
                        {{ $t('global.save') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import adminApi from "../../../api/adminAxios";
import Swal from "sweetalert2";

export default {
    props: {
        isVisible: Boolean,
        item: Object
    },
    data() {
        return {
            form: {
                answer_score: this.item.answer_score,
                is_passed: this.item.is_completed ? this.item.is_passed : 1,
            },
            loading: false,
        };
    },
    methods: {
        async update() {
            this.loading = true;
            try {
                await adminApi.put(`/exam-answers/${this.item.id}`, this.form);
                this.$emit('refresh');
                this.$emit('close');
                Swal.fire({
                    icon: 'success',
                    title: this.$t('translation.Success'),
                    text: this.$t('translation.Record updated successfully'),
                    timer: 2000,
                    showConfirmButton: false,
                    position: 'top-end',
                    toast: true
                });
            } catch (error) {
                console.error("Error updating score:", error);
                if (error.response && error.response.status === 422) {
                    Swal.fire('Error', error.response.data.message, 'error');
                } else {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            } finally {
                this.loading = false;
            }
        }
    }
};
</script>

<style scoped>
.btn-check:checked + .btn-outline-success {
    background-color: var(--success-color);
    color: #white;
    border-color: var(--success-color);
}
.btn-check:checked + .btn-outline-danger {
    background-color: var(--danger-color);
    color: #white;
    border-color: var(--danger-color);
}
.bg-info-light {
    background-color: rgba(var(--info-rgb), 0.1);
}
.border-info-light {
    border-color: rgba(var(--info-rgb), 0.3) !important;
}
.ripple {
  position: relative;
  overflow: hidden;
  transition: all 0.3s;
}
</style>
