<!DOCTYPE html>
<html lang="id" class="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="icon" href="/favicon.ico">
<title>Riwayat Pelanggaran Murid · SITERTIB</title>
<link rel="stylesheet" href="/css/murid_list.css">
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet" />
</head>
<body class="min-h-screen overflow-x-hidden relative transition-colors duration-500">

  <!-- Background -->
  <div class="fixed inset-0 bg-grid pointer-events-none"></div>
  <div class="fixed inset-0 pointer-events-none overflow-hidden">
    <div class="blob bg-primary w-[400px] h-[400px] -top-32 -left-32"></div>
    <div class="blob bg-secondary w-[400px] h-[400px] bottom-0 -right-32" style="animation-delay: -4s;"></div>
  </div>

  <!-- Navbar -->
  <header class="relative z-20 flex items-center justify-between px-6 lg:px-12 py-5">
    <a href="/" class="flex items-center gap-3">
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
    </a>

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
      <a href="/login" class="btn-primary px-5 py-2.5 rounded-xl font-headline font-semibold text-sm flex items-center gap-2">
        Masuk
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
          <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5-5 5M6 12h12"/>
        </svg>
      </a>
    </div>
  </header>

  <!-- Main Content -->
  <main class="relative z-10 px-6 lg:px-12 pb-16 pt-8">
    <div class="max-w-4xl mx-auto">
      
      <!-- Breadcrumb & Title -->
      <div class="mb-8 fade-in">
        <a href="/" class="text-caption text-secondary hover:underline flex items-center gap-1.5 mb-3">
          <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
          Kembali ke Beranda
        </a>
        <h1 class="text-h1 mb-2">Riwayat Pelanggaran Murid</h1>
        <p class="text-body-lg" style="color: var(--text-soft);">Masukkan NIS siswa untuk melihat riwayat kedisiplinan secara transparan.</p>
      </div>

      <!-- Search Form -->
      <div class="glass rounded-2xl p-3 mb-8 fade-in">
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
            Cek Riwayat
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </button>
        </form>
      </div>

      <!-- Result Container -->
      <div id="resultContainer" class="fade-in">
        <!-- Konten akan dirender oleh JS berdasarkan URL -->
      </div>

    </div>
  </main>

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
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="${c.icon}"/></svg>
      </div>
      <div class="flex-1 min-w-0">
        <p class="font-headline font-semibold text-sm">${title}</p>
        <p class="text-caption mt-0.5" style="color: var(--text-soft);">${message}</p>
      </div>
    `;
    container.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
  }

  // ============= URL ROUTING & RENDER LOGIC =============
  const nisForm = document.getElementById('nisForm');
  const nisInput = document.getElementById('nisInput');
  const resultContainer = document.getElementById('resultContainer');

  // Tangani submit form: ubah URL tanpa reload halaman
  nisForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const nis = nisInput.value.trim();
    if (!nis) {
      showToast('error', 'Input Kosong', 'Silakan masukkan NIS terlebih dahulu.');
      return;
    }
    
    // Update URL
    const newUrl = `${window.location.pathname}?nis=${encodeURIComponent(nis)}`;
    history.pushState({ nis }, '', newUrl);
    
    // Render ulang berdasarkan NIS baru
    handleRouteChange();
  });

  // Tangani perubahan history (misal tombol back/forward browser)
  window.addEventListener('popstate', handleRouteChange);

  async function handleRouteChange() {
    const params = new URLSearchParams(window.location.search);
    const nis = params.get('nis');

    if (nis) {
      nisInput.value = nis;
      await renderViolations(nis);
    } else {
      nisInput.value = '';
      renderInitialState();
    }
  }

  function renderInitialState() {
    resultContainer.innerHTML = `
      <div class="glass rounded-2xl p-8 lg:p-12">
        <div class="empty-state max-w-md mx-auto">
          <div class="empty-state-icon">
            <svg class="w-8 h-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
          <h3 class="text-h3 mb-2">Pencarian Riwayat</h3>
          <p class="text-body" style="color: var(--text-soft);">
            Masukkan NIS siswa pada kolom di atas untuk melihat daftar riwayat pelanggaran tata tertib sekolah.
          </p>
        </div>
      </div>
    `;
  }

  async function renderViolations(nis) {
    resultContainer.innerHTML = `
      <div class="glass rounded-2xl p-8 lg:p-12">
        <div class="flex flex-col items-center justify-center py-12">
          <svg class="w-10 h-10 animate-spin text-primary mb-4" fill="none" viewBox="0 0 24 24">
            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" opacity="0.25"/>
            <path d="M12 2a10 10 0 0110 10" stroke="currentColor" stroke-width="4" stroke-linecap="round"/>
          </svg>
          <p class="text-body">Memuat data untuk NIS: <span class="font-mono font-semibold">${nis}</span>...</p>
        </div>
      </div>
    `;

    try {
      const response = await fetch(`/api/pelanggaran-murid/${encodeURIComponent(nis)}`, {
        headers: { 'Accept': 'application/json' }
      });

      const data = await response.json().catch(() => ({}));

      if (!response.ok) {
        resultContainer.innerHTML = `
          <div class="glass rounded-2xl p-6 lg:p-8">
            <div class="empty-state py-12">
              <div class="empty-state-icon" style="background: rgba(220, 38, 38, 0.1);">
                <svg class="w-8 h-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a1 1 0 00.9 1.5h16.56a1 1 0 00.9-1.5L13.71 3.86a1 1 0 00-1.72 0z"/>
                </svg>
              </div>
              <h3 class="text-h3 mb-1">Data Tidak Ditemukan</h3>
              <p class="text-body max-w-sm mx-auto" style="color: var(--text-soft);">
                ${data.message || 'Tidak ada data murid dengan NIS tersebut.'}
              </p>
            </div>
          </div>
        `;
        return;
      }

      const murid = data.murid || null;
      const pelanggaran = Array.isArray(data.pelanggaran) ? data.pelanggaran : [];
      const totalPelanggaran = data.total_pelanggaran ?? pelanggaran.length;

      resultContainer.innerHTML = `
        <div class="glass rounded-2xl p-6 lg:p-8">
          <div class="flex items-center gap-4 pb-6 mb-6 border-b" style="border-color: var(--border-subtle);">
            <div class="w-16 h-16 rounded-full bg-secondary/20 grid place-items-center text-secondary font-headline font-bold text-2xl">
              ${(murid?.nama || 'M').charAt(0).toUpperCase()}
            </div>
            <div>
              <p class="text-caption" style="color: var(--text-soft);">NIS</p>
              <h2 class="text-h2">${murid?.nis || nis}</h2>
              <p class="text-body mt-1" style="color: var(--text-soft);">Nama: <span class="font-semibold">${murid?.nama || '-'}</span></p>
              <p class="text-body mt-1" style="color: var(--text-soft);">Kelas: <span class="font-semibold">${murid?.kelas || '-'}</span></p>
            </div>
          </div>

          <div class="flex items-center justify-between mb-4">
            <h3 class="text-h3">Daftar Riwayat Pelanggaran</h3>
            <span class="badge ${totalPelanggaran > 0 ? 'badge-warning' : 'badge-success'}">${totalPelanggaran} Pelanggaran</span>
          </div>

          ${totalPelanggaran > 0 ? `
            <div class="space-y-3">
              ${pelanggaran.map(item => `
                <div class="rounded-xl border p-4" style="border-color: var(--border-subtle); background: var(--surface-soft);">
                  <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                    <div>
                      <p class="font-headline font-semibold">${item.pelanggaran?.nama || 'Pelanggaran'}</p>
                      <p class="text-caption" style="color: var(--text-soft);">${item.tanggal_pelanggaran ? new Date(item.tanggal_pelanggaran).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-'}</p>
                    </div>
                    <span class="badge badge-error">${item.pelanggaran?.kategori || 'Pelanggaran'}</span>
                  </div>
                  <p class="text-body" style="color: var(--text-soft);">${item.keterangan || 'Tidak ada keterangan.'}</p>
                  <p class="text-caption mt-2" style="color: var(--text-soft);">Pelapor: ${item.pelapor || '-'} · Tahun Ajaran: ${item.tahun_ajaran?.nama || '-'}</p>
                </div>
              `).join('')}
            </div>
          ` : `
            <div class="empty-state py-12">
              <div class="empty-state-icon" style="background: rgba(22, 163, 74, 0.1);">
                <svg class="w-8 h-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-h3 mb-1">Tidak Ada Riwayat Pelanggaran</h3>
              <p class="text-body max-w-sm mx-auto" style="color: var(--text-soft);">
                Siswa dengan NIS <span class="font-mono font-semibold">${murid?.nis || nis}</span> tercatat berkelakuan baik dan tidak memiliki pelanggaran.
              </p>
            </div>
          `}
        </div>
      `;
    } catch (error) {
      resultContainer.innerHTML = `
        <div class="glass rounded-2xl p-6 lg:p-8">
          <div class="empty-state py-12">
            <div class="empty-state-icon" style="background: rgba(220, 38, 38, 0.1);">
              <svg class="w-8 h-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a1 1 0 00.9 1.5h16.56a1 1 0 00.9-1.5L13.71 3.86a1 1 0 00-1.72 0z"/>
              </svg>
            </div>
            <h3 class="text-h3 mb-1">Gagal Mengambil Data</h3>
            <p class="text-body max-w-sm mx-auto" style="color: var(--text-soft);">
              Terjadi kesalahan saat menghubungi server. Silakan coba lagi.
            </p>
          </div>
        </div>
      `;
    }
  }

  // Inisialisasi saat halaman dimuat
  handleRouteChange();
</script>
</body>
</html>