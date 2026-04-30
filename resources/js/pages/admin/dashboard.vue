<template>
  <div class="container-fluid py-4">
    <loader v-if="loading" />

    <!-- Welcome Section -->
    <div class="d-md-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="mb-0 fw-bold">الرئيسية</h4>
            <p class="text-muted mb-0 small">{{ $t('auth.WelcomeBack') }}</p>
        </div>
        <div class="mt-md-0 mt-3">
            <button class="btn btn-primary-light btn-wave" @click="fetchStats">
                <i class="ri-refresh-line align-middle me-1"></i>
                {{ $t('global.Reset') }}
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card border-0 overflow-hidden shadow-sm stat-card primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 fs-12 fw-semibold">{{ $t('dashboard.total_students') }}</p>
                            <h3 class="mb-0 fw-bold">{{ stats.summary.total_students }}</h3>
                            <div class="mt-2">
                                <span class="badge bg-success-transparent fs-11">
                                    <i class="ri-check-line me-1"></i>{{ stats.summary.active_students }} {{ $t('dashboard.active_students') }}
                                </span>
                            </div>
                        </div>
                        <div class="avatar avatar-lg bg-primary-transparent rounded-circle shadow-sm">
                            <i class="ri-user-smile-line fs-24 text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card border-0 overflow-hidden shadow-sm stat-card success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 fs-12 fw-semibold">{{ $t('dashboard.total_classes') }}</p>
                            <h3 class="mb-0 fw-bold">{{ stats.summary.total_classes }}</h3>
                            <div class="mt-2">
                                <span class="text-muted small">{{ $t('dashboard.school_classes') }}</span>
                            </div>
                        </div>
                        <div class="avatar avatar-lg bg-success-transparent rounded-circle shadow-sm">
                            <i class="ri-building-line fs-24 text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card border-0 overflow-hidden shadow-sm stat-card info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 fs-12 fw-semibold">{{ $t('dashboard.total_subjects') }}</p>
                            <h3 class="mb-0 fw-bold">{{ stats.summary.total_subjects }}</h3>
                            <div class="mt-2">
                                <span class="text-muted small">{{ $t('dashboard.subjects') }}</span>
                            </div>
                        </div>
                        <div class="avatar avatar-lg bg-info-transparent rounded-circle shadow-sm">
                            <i class="ri-book-open-line fs-24 text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card custom-card border-0 overflow-hidden shadow-sm stat-card warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <p class="text-muted mb-1 fs-12 fw-semibold">{{ $t('dashboard.total_exams') }}</p>
                            <h3 class="mb-0 fw-bold">{{ stats.summary.total_exams }}</h3>
                            <div class="mt-2">
                                <span class="text-muted small">{{ $t('dashboard.exams_count') }}</span>
                            </div>
                        </div>
                        <div class="avatar avatar-lg bg-warning-transparent rounded-circle shadow-sm">
                            <i class="ri-award-line fs-24 text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Row -->
    <div class="row g-4 mb-4">
        <div class="col-xl-8" id="stage-chart">
            <div class="card custom-card border-0 shadow-sm h-100">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ $t('dashboard.stage_distribution') }}
                    </div>
                </div>
                <div class="card-body">
                    <div v-if="stageChartData" style="height: 380px;">
                        <Chart :key="'stage-' + chartKey" type="bar" :data="stageChartData" :options="barOptions" style="height: 380px;" />
                    </div>
                    <div v-else class="h-100 d-flex align-items-center justify-content-center text-muted small" style="height: 380px;">
                         {{ $t('global.Loading') }}...
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card custom-card border-0 shadow-sm h-100">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ $t('dashboard.gender_distribution') }}
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-center align-items-center" style="height: 380px;">
                    <div v-if="genderChartData" class="w-100">
                        <Chart :key="'gender-' + chartKey" type="doughnut" :data="genderChartData" :options="donutOptions" style="max-height: 250px;" />
                        <div class="mt-4 w-100">
                            <div v-for="(val, key) in stats.distributions.gender" :key="key" class="d-flex align-items-center justify-content-between mb-2">
                                <span class="text-muted small">
                                    <i class="ri-checkbox-blank-circle-fill me-1" :class="val.gender === 'male' ? 'text-primary' : 'text-danger'"></i>
                                    {{ val.gender === 'male' ? $t('dashboard.male') : $t('dashboard.female') }}
                                </span>
                                <span class="fw-bold">{{ val.count }}</span>
                            </div>
                        </div>
                    </div>
                    <div v-else class="text-muted small">
                         {{ $t('global.Loading') }}...
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Activity & Content Stats -->
    <div class="row g-4">
        <div class="col-xl-12">
            <div class="card custom-card border-0 shadow-sm">
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ $t('dashboard.recent_enrollments') }}
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4">{{ $t('global.name') }}</th>
                                    <th>{{ $t('admin.code') }}</th>
                                    <th>{{ $t('admin.school_class') }}</th>
                                    <th class="text-end pe-4">{{ $t('global.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="student in stats.latest.students" :key="student.id">
                                    <td class="ps-4 fw-semibold text-primary">{{ student.name }}</td>
                                    <td><span class="badge bg-light text-dark">{{ student.code }}</span></td>
                                    <td>{{ student.class }}</td>
                                    <td class="text-end pe-4 text-muted small">{{ student.date }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import adminApi from "../../api/adminAxios";
import Chart from "primevue/chart";
import 'chart.js/auto'; // Required for PrimeVue 4 Chart component to work out-of-the-box

export default {
  name: "dashboard",
  components: {
    Chart
  },
  data() {
    return {
      loading: false,
      chartKey: 0, // Used to force re-render when data changes
      stats: {
        summary: { total_students: 0, active_students: 0, total_classes: 0, total_subjects: 0, total_exams: 0 },
        distributions: { gender: [], stages: [] },
        content: { articles: 0, services: 0 },
        latest: { students: [] }
      },
      stageChartData: null,
      genderChartData: null,
      barOptions: {
          plugins: { 
            legend: { display: false },
            tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', padding: 12, borderRadius: 8 }
          },
          scales: { y: { beginAtZero: true, grid: { color: 'rgba(0,0,0,0.05)' } }, x: { grid: { display: false } } },
          responsive: true,
          maintainAspectRatio: false
      },
      donutOptions: {
          cutout: '70%',
          plugins: { 
            legend: { display: false },
            tooltip: { backgroundColor: 'rgba(0,0,0,0.8)', padding: 12, borderRadius: 8 }
          },
          responsive: true,
          maintainAspectRatio: false
      }
    };
  },
  mounted() {
    this.fetchStats();
  },
  methods: {
    async fetchStats() {
      this.loading = true;
      try {
        const response = await adminApi.get('dashboard-stats');
        this.stats = response.data.data;
        this.prepareChartData();
      } catch (error) {
        console.error("Failed to fetch dashboard stats", error);
      } finally {
        this.loading = false;
      }
    },
    prepareChartData() {
        if (!this.stats.distributions.stages.length && !this.stats.distributions.gender.length) return;

        // Stage Chart
        this.stageChartData = {
            labels: this.stats.distributions.stages.map(s => s.title),
            datasets: [{
                label: this.$t('dashboard.total_students'),
                data: this.stats.distributions.stages.map(s => s.count),
                backgroundColor: 'rgba(67, 95, 251, 0.7)',
                hoverBackgroundColor: 'rgba(67, 95, 251, 0.9)',
                borderRadius: 8,
                barThickness: 30
            }]
        };

        // Gender Chart
        const males = this.stats.distributions.gender.find(g => g.gender === 'male')?.count || 0;
        const females = this.stats.distributions.gender.find(g => g.gender === 'female')?.count || 0;
        
        this.genderChartData = {
            labels: [this.$t('dashboard.male'), this.$t('dashboard.female')],
            datasets: [{
                data: [males, females],
                backgroundColor: ['#435ffb', '#e83e8c'],
                hoverOffset: 10,
                borderWidth: 0
            }]
        };

        this.chartKey++; // Force re-render
    }
  }
};
</script>

<style scoped>
.stat-card {
    transition: transform 0.3s ease-in-out;
    border-radius: 12px;
}
.stat-card:hover {
    transform: translateY(-5px);
}
.stat-card.primary { border-inline-start: 4px solid var(--primary) !important; }
.stat-card.success { border-inline-start: 4px solid var(--success) !important; }
.stat-card.info { border-inline-start: 4px solid var(--info) !important; }
.stat-card.warning { border-inline-start: 4px solid var(--warning) !important; }

.avatar-lg { width: 3.5rem; height: 3.5rem; }
.avatar-md { width: 3rem; height: 3rem; }

.card-title {
    font-size: 1rem;
    font-weight: 700;
    color: #333;
}
.card-header {
    border-bottom: 1px solid rgba(0,0,0,0.05);
    background: transparent;
    padding: 1rem 1.25rem;
}
.table thead th {
    font-size: 11px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 0.5px;
}
</style>