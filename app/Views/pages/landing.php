<!DOCTYPE html>
<html lang="id" class="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="/favicon.ico">
<title>SITERTIB · Sistem Pencatatan Tata Tertib</title>
<link rel="stylesheet" href="/css/landing.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen overflow-x-hidden relative transition-colors duration-500">

  <!-- Background -->
  <div class="fixed inset-0 bg-grid pointer-events-none"></div>
  <div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="blob bg-primary w-[480px] h-[480px] -top-32 -left-32"></div>
    <div class="blob bg-secondary w-[420px] h-[420px] top-1/3 -right-32" style="animation-delay: -4s;"></div>
    <div class="blob bg-tertiary w-[360px] h-[360px] bottom-0 left-1/4" style="animation-delay: -8s;"></div>
  </div>

  <!-- Navbar -->
  <header class="relative z-20 flex items-center justify-between px-6 lg:px-12 py-5">
    <div class="flex items-center gap-3">
      <div class="w-10 h-10 rounded-xl bg-primary grid place-items-center shadow-lg shadow-primary/30">
        <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-white">
          <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z" fill="currentColor"/>
          <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="leading-tight">
        <p class="font-headline font-semibold text-[17px]">SITERTIB</p>
        <p class="text-caption" style="color: var(--text-soft);">Sistem Pencatatan Tata Tertib</p>
      </div>
    </div>

    <div class="flex items-center gap-3">
      <button id="themeToggle" class="glass rounded-full w-11 h-11 grid place-items-center hover:scale-105 transition-transform" aria-label="Ganti tema">
        <svg class="w-5 h-5 light-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <circle cx="12" cy="12" r="4"/>
          <path stroke-linecap="round" d="M12 2v2M12 20v2M2 12h2M20 12h2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
        </svg>
        <svg class="w-5 h-5 dark-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
        </svg>
      </button>
      
      <!-- Tombol Login / Masuk -->
      <a href="/login" class="btn-primary px-5 py-2.5 rounded-xl font-headline font-semibold text-sm flex items-center gap-2">
        Masuk
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5-5 5M6 12h12"/>
        </svg>
      </a>
    </div>
  </header>

  <!-- Main Hero Section -->
  <main class="relative z-10 px-6 lg:px-12 pb-16 pt-8 lg:pt-16">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-8 items-center">
      
      <!-- Left: Text & NIS Input -->
      <section class="enter">
        <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full glass text-caption mb-6">
          <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
          <?= $tahunAjaranAktif ? 'Tahun Ajaran ' . $tahunAjaranAktif->nama . ' · Semester ' . ucfirst($tahunAjaranAktif->semester) : 'Tahun Ajaran Belum Diatur' ?>
        </span>

        <h1 class="text-h1 mb-5" style="color: var(--text-strong);">
          Transparansi kedisiplinan<br/>
          sekolah dimulai dari <span class="text-primary">sini.</span>
        </h1>
        <p class="text-body-lg max-w-lg mb-8" style="color: var(--text-soft);">
          SITERTIB menghadirkan sistem pelacakan tata tertib yang modern dan real-time. Cek riwayat pelanggaran siswa dengan mudah hanya menggunakan NIS.
        </p>

        <!-- Form Pengecekan NIS -->
        <div class="glass rounded-2xl p-3 max-w-lg mb-6">
          <form id="nisForm" class="flex flex-col sm:flex-row gap-3">
            <div class="relative flex-1">
              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
              </span>
              <input
                type="text"
                id="nisInput"
                placeholder="Masukkan NIS Siswa (cth: 2024001)"
                class="field-input w-full pl-12 pr-4 py-3 rounded-xl text-body"
              />
            </div>
            <button type="submit" class="btn-primary px-6 py-3 rounded-xl font-headline font-semibold text-base flex items-center justify-center gap-2 whitespace-nowrap">
              Cek Pelanggaran
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </button>
          </form>
        </div>

        <div id="resultContainer" class="max-w-lg">
          <!-- Hasil pencarian NIS akan muncul di sini -->
        </div>
      </section>

      <!-- Right: Visual Mockup -->
      <section class="enter enter-delay-1 relative hidden lg:block">
        <div class="mock-float relative max-w-md ml-auto">
          <div class="glass rounded-3xl p-6 shadow-2xl shadow-black/10">
            <div class="flex items-center justify-between mb-5">
              <div>
                <p class="text-caption" style="color: var(--text-soft);">Profil Siswa</p>
                <h3 class="text-h3">Budi Santoso</h3>
              </div>
              <div class="w-14 h-14 rounded-full bg-secondary/20 grid place-items-center text-secondary font-headline font-bold text-xl">
                BS
              </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="p-3 rounded-xl" style="background: var(--surface-soft);">
                <p class="text-caption mb-1" style="color: var(--text-soft);">NIS</p>
                <p class="text-mono font-semibold">20241005</p>
              </div>
              <div class="p-3 rounded-xl" style="background: var(--surface-soft);">
                <p class="text-caption mb-1" style="color: var(--text-soft);">Kelas</p>
                <p class="text-mono font-semibold">IX - A</p>
              </div>
            </div>

            <div class="flex items-center justify-between mb-3">
              <p class="font-headline font-semibold text-sm">Riwayat Pelanggaran</p>
              <span class="text-caption px-2 py-0.5 rounded-md bg-error/10 text-error font-medium">2 Kasus</span>
            </div>

            <div class="space-y-3">
              <div class="flex items-center gap-3 p-3 rounded-lg" style="background: var(--surface-soft);">
                <div class="w-2 h-8 rounded-full bg-warning"></div>
                <div class="flex-1">
                  <p class="text-sm font-medium">Terlambat masuk sekolah</p>
                  <p class="text-caption" style="color: var(--text-soft);">12 Agt 2024 · 07:45</p>
                </div>
                <span class="badge px-2 py-0.5 rounded-md bg-warning/10 text-warning text-xs font-semibold">Kerapian</span>
              </div>
              <div class="flex items-center gap-3 p-3 rounded-lg" style="background: var(--surface-soft);">
                <div class="w-2 h-8 rounded-full bg-error"></div>
                <div class="flex-1">
                  <p class="text-sm font-medium">Tidak memakai dasi</p>
                  <p class="text-caption" style="color: var(--text-soft);">15 Agt 2024 · 09:15</p>
                </div>
                <span class="badge px-2 py-0.5 rounded-md bg-error/10 text-error text-xs font-semibold">Sikap Prilaku</span>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto mt-20 grid grid-cols-1 md:grid-cols-3 gap-6">
      <div class="glass rounded-2xl p-6">
        <div class="w-12 h-12 rounded-xl grid place-items-center mb-4" style="background: rgba(225, 29, 72, 0.1); color: #E11D48;">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        </div>
        <h3 class="text-h3 mb-2">Pencatatan Real-time</h3>
        <p class="text-body" style="color: var(--text-soft);">Guru dan staf dapat mencatat pelanggaran siswa secara langsung melalui sistem, kapan saja dan di mana saja.</p>
      </div>
      <div class="glass rounded-2xl p-6">
        <div class="w-12 h-12 rounded-xl grid place-items-center mb-4" style="background: rgba(37, 99, 235, 0.1); color: #2563EB;">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
        </div>
        <h3 class="text-h3 mb-2">Laporan Komprehensif</h3>
        <p class="text-body" style="color: var(--text-soft);">Hasilkan laporan kedisiplinan harian, bulanan, hingga tahunan untuk evaluasi sekolah yang lebih baik.</p>
      </div>
      <div class="glass rounded-2xl p-6">
        <div class="w-12 h-12 rounded-xl grid place-items-center mb-4" style="background: rgba(22, 163, 74, 0.1); color: #16A34A;">
          <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
        </div>
        <h3 class="text-h3 mb-2">Transparansi Orang Tua</h3>
        <p class="text-body" style="color: var(--text-soft);">Orang tua/wali dapat memantau perkembangan kedisiplinan anaknya secara mandiri melalui portal publik ini.</p>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="relative z-10 border-t mt-10 py-6 px-12 text-center" style="border-color: var(--border-subtle);">
    <p class="text-caption" style="color: var(--text-soft);">© 2024 SITERTIB · Sistem Pencatatan Tata Tertib. Dibuat untuk sekolah yang lebih tertib.</p>
  </footer>

  <!-- Toast Container -->
  <div id="toastContainer" class="fixed top-5 right-5 z-50 space-y-3"></div>

<script>
  // ============= THEME TOGGLE =============
  const root = document.documentElement;
  const themeToggle = document.getElementById('themeToggle');
  const lightIcon = document.querySelector('.light-icon');
  const darkIcon = document.querySelector('.dark-icon');

  function applyTheme(theme) {
    if (theme === 'dark') {
      root.classList.add('dark');
      lightIcon.classList.add('hidden');
      darkIcon.classList.remove('hidden');
    } else {
      root.classList.remove('dark');
      lightIcon.classList.remove('hidden');
      darkIcon.classList.add('hidden');
    }
  }

  const savedTheme = localStorage.getItem('theme') || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
  applyTheme(savedTheme);

  themeToggle.addEventListener('click', () => {
    const next = root.classList.contains('dark') ? 'light' : 'dark';
    localStorage.setItem('theme', next);
    applyTheme(next);
  });

  // ============= TOAST =============
  function showToast(type, title, message) {
    const container = document.getElementById('toastContainer');
    const colors = {
      success: { bg: 'bg-success', icon: 'M5 13l4 4L19 7' },
      error: { bg: 'bg-error', icon: 'M6 18L18 6M6 6l12 12' },
      info: { bg: 'bg-secondary', icon: 'M13 16h-1v-4h-1m1-4h.01' }
    };
    const c = colors[type] || colors.info;
    const toast = document.createElement('div');
    toast.className = 'toast glass rounded-xl p-4 w-80 shadow-2xl flex items-start gap-3';
    toast.innerHTML = `
      <div class="w-9 h-9 rounded-lg ${c.bg} grid place-items-center text-white flex-shrink-0">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="${c.icon}"/>
        </svg>
      </div>
      <div class="flex-1 min-w-0">
        <p class="font-headline font-semibold text-sm">${title}</p>
        <p class="text-caption mt-0.5" style="color: var(--text-soft);">${message}</p>
      </div>
    `;
    container.appendChild(toast);
    setTimeout(() => {
      toast.style.transition = 'all 0.3s';
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(20px)';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }

  // ============= FORM NIS LOGIC =============
  const nisForm = document.getElementById('nisForm');
  const nisInput = document.getElementById('nisInput');
  const resultContainer = document.getElementById('resultContainer');

  nisForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    const nis = nisInput.value.trim();

    if (!nis) {
      showToast('error', 'Input Kosong', 'Silakan masukkan NIS siswa terlebih dahulu.');
      return;
    }

    window.location.href = `/riwayat-pelanggaran-murid?nis=${encodeURIComponent(nis)}`;
  });
</script>
</body>
</html>