<?= $this->extend('main') ?>
<?= $this->section('title') ?>Dashboard<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card {
    background-color: var(--surface-base);
    border: 1px solid var(--border-subtle);
    border-radius: 16px;
    padding: 24px;
    transition: all 0.2s ease;
  }

  .card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px -12px rgba(15, 23, 42, 0.1);
  }

  /* Buttons */
  .btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.2s ease;
  }

  .btn-primary {
    background-color: #E11D48;
    color: #fff;
    box-shadow: 0 8px 20px -8px rgba(225, 29, 72, 0.5);
  }

  .btn-primary:hover {
    background-color: #BE123C;
    transform: translateY(-1px);
  }

  /* Badges */
  .badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 4px 10px;
    border-radius: 6px;
    font-family: 'DM Sans';
    font-size: 12px;
    font-weight: 600;
  }

  .badge-error {
    background: rgba(220, 38, 38, 0.1);
    color: #DC2626;
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 48px 24px;
    color: var(--text-soft);
  }

  .empty-state-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 16px;
    border-radius: 50%;
    display: grid;
    place-items: center;
    background-color: var(--surface-soft);
  }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Stats Grid (3 Kolom, tanpa poin) -->
<section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
  <!-- Stat Card 1 -->
  <div class="card card-hover">
    <div class="flex justify-between items-start mb-4">
      <div class="w-12 h-12 rounded-xl grid place-items-center" style="background: rgba(225, 29, 72, 0.1); color: #E11D48;">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
      </div>
      <span class="badge badge-error">Bulan ini</span>
    </div>
    <p class="text-h2 font-bold" id="statViolations">0</p>
    <p class="text-body" style="color: var(--text-soft);">Total Pelanggaran</p>
  </div>

  <!-- Stat Card 2 -->
  <div class="card card-hover">
    <div class="flex justify-between items-start mb-4">
      <div class="w-12 h-12 rounded-xl grid place-items-center" style="background: rgba(37, 99, 235, 0.1); color: #2563EB;">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
        </svg>
      </div>
    </div>
    <p class="text-h2 font-bold" id="statStudents">0</p>
    <p class="text-body" style="color: var(--text-soft);">Siswa Terdaftar</p>
  </div>

  <!-- Stat Card 3 -->
  <div class="card card-hover">
    <div class="flex justify-between items-start mb-4">
      <div class="w-12 h-12 rounded-xl grid place-items-center" style="background: rgba(22, 163, 74, 0.1); color: #16A34A;">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
      </div>
    </div>
    <p class="text-h2 font-bold" id="statToday">0</p>
    <p class="text-body" style="color: var(--text-soft);">Pelanggaran Hari Ini</p>
  </div>
</section>

<!-- Chart & Recent Activity -->
<section class="grid grid-cols-1 xl:grid-cols-3 gap-6">

  <!-- Chart -->
  <div class="xl:col-span-2 card">
    <div class="flex justify-between items-center mb-6">
      <div>
        <h2 class="text-h3">Tren Pelanggaran</h2>
        <p class="text-caption" style="color: var(--text-soft);">7 hari terakhir</p>
      </div>
    </div>
    <div style="height: 320px; position: relative;">
      <canvas id="violationChart"></canvas>
    </div>
  </div>

  <!-- Recent Activity Table -->
  <div class="card flex flex-col">
    <div class="flex justify-between items-center mb-4">
      <h2 class="text-h3">Aktivitas Terbaru</h2>
    </div>

    <div class="flex-1" id="recentActivityContainer">
      <!-- Empty State rendered by JS -->
    </div>

  </div>
</section>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  async function fetchDashboardStats() {
    // Tanpa sistem poin, data dikembalikan kosong (0 / array kosong)
    return new Promise(resolve => {
      setTimeout(() => {
        resolve({
          stats: {
            total_violations: 0,
            total_students: 0,
            today_violations: 0
          },
          chart_data: {
            labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
            data: [0, 0, 0, 0, 0, 0, 0]
          },
          recent_activities: [] // Empty array -> trigger empty state
        });
      }, 800);
    });
  }

  // ====================================================================
  // RENDER LOGIC
  // ====================================================================
  async function initDashboard() {
    try {
      const [user, dashboardData] = await Promise.all([fetchUserProfile(), fetchDashboardStats()]);

      // Render User Info
      const displayName = user.guru.nama;
      document.getElementById('userName').textContent = displayName;
      document.getElementById('userRoleDisplay').textContent = user.role === 'admin' ? 'Administrator' : 'Guru';
      document.getElementById('userNipDisplay').textContent = `NIP: ${user.guru.nip}`;
      document.getElementById('userAvatar').textContent = displayName.charAt(0).toUpperCase();

      // Render Stats
      document.getElementById('statViolations').textContent = dashboardData.stats.total_violations;
      document.getElementById('statStudents').textContent = dashboardData.stats.total_students;
      document.getElementById('statToday').textContent = dashboardData.stats.today_violations;

      // Render Chart & Empty State
      renderChart(dashboardData.chart_data);
      renderRecentActivity(dashboardData.recent_activities);

    } catch (error) {
      console.error("Gagal memuat dashboard:", error);
      showToast('error', 'Gagal Memuat', 'Terjadi kesalahan saat mengambil data dashboard.');
    }
  }

  function renderChart(chartData) {
    const ctx = document.getElementById('violationChart').getContext('2d');
    const isDark = root.classList.contains('dark');

    new Chart(ctx, {
      type: 'line',
      data: {
        labels: chartData.labels,
        datasets: [{
          label: 'Pelanggaran',
          data: chartData.data,
          borderColor: '#E11D48',
          backgroundColor: 'rgba(225, 29, 72, 0.1)',
          borderWidth: 2,
          tension: 0.4,
          fill: true,
          pointBackgroundColor: '#E11D48',
          pointRadius: 4,
          pointHoverRadius: 6
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            backgroundColor: isDark ? '#1E293B' : '#FFFFFF',
            titleColor: isDark ? '#F8FAFC' : '#0F172A',
            bodyColor: isDark ? '#94A3B8' : '#475569',
            borderColor: isDark ? 'rgba(255,255,255,0.1)' : 'rgba(15,23,42,0.1)',
            borderWidth: 1,
            padding: 12,
            displayColors: false
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            grid: {
              color: isDark ? 'rgba(255,255,255,0.05)' : 'rgba(15,23,42,0.05)'
            },
            ticks: {
              color: isDark ? '#64748B' : '#94A3B8',
              stepSize: 1
            }
          },
          x: {
            grid: {
              display: false
            },
            ticks: {
              color: isDark ? '#64748B' : '#94A3B8'
            }
          }
        }
      }
    });
  }

  function renderRecentActivity(activities) {
    const container = document.getElementById('recentActivityContainer');

    if (activities.length === 0) {
      // EMPTY STATE UI
      container.innerHTML = `
        <div class="empty-state h-full flex flex-col items-center justify-center">
          <div class="empty-state-icon">
            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
          </div>
          <h3 class="text-h3 mb-1">Belum Ada Aktivitas</h3>
          <p class="text-body text-center max-w-xs mb-6" style="color: var(--text-soft);">
            Belum ada pelanggaran yang tercatat. Mulai catat pelanggaran siswa untuk melihatnya di sini.
          </p>
          <a href="/catat-pelanggaran" class="btn btn-primary">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Input Pelanggaran
          </a>
        </div>
      `;
    }
  }

  // Initialize dashboard when script loads
  initDashboard();
</script>
<?= $this->endSection() ?>
