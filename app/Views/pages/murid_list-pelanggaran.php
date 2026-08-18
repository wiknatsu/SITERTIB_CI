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
        <div class="glass rounded-3xl p-6 lg:p-10 shadow-xl shadow-slate-200/50 dark:shadow-none border border-white/50 dark:border-slate-800">
          
          <!-- Header Profile -->
          <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6 pb-8 mb-8 border-b border-slate-200 dark:border-slate-700/60">
            <div class="flex items-center gap-5 sm:gap-6">
              <div class="relative flex-shrink-0">
                <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-primary to-secondary p-[2px] shadow-lg shadow-primary/20">
                  <div class="w-full h-full bg-white dark:bg-slate-900 rounded-[14px] flex items-center justify-center">
                    <span class="text-transparent bg-clip-text bg-gradient-to-br from-primary to-secondary font-headline font-bold text-3xl">
                      ${(murid?.nama || 'M').charAt(0).toUpperCase()}
                    </span>
                  </div>
                </div>
                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-white dark:bg-slate-800 rounded-full flex items-center justify-center shadow-md">
                  <div class="w-3.5 h-3.5 bg-success rounded-full ring-2 ring-white dark:ring-slate-800"></div>
                </div>
              </div>
              <div>
                <h2 class="text-2xl sm:text-3xl font-headline font-bold text-slate-800 dark:text-white mb-2 leading-tight">${murid?.nama || '-'}</h2>
                <div class="flex flex-wrap items-center gap-3 text-sm font-medium text-slate-500 dark:text-slate-400">
                  <span class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg> 
                    NIS: <span class="font-semibold text-slate-700 dark:text-slate-300">${murid?.nis || nis}</span>
                  </span>
                  <span class="flex items-center gap-1.5 bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg> 
                    Kelas: <span class="font-semibold text-slate-700 dark:text-slate-300">${murid?.kelas || '-'}</span>
                  </span>
                </div>
              </div>
            </div>
            
            <div class="w-full md:w-auto bg-slate-50 dark:bg-slate-800/80 rounded-2xl p-4 sm:p-5 border border-slate-200 dark:border-slate-700 text-center md:text-right min-w-[140px]">
              <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest mb-1.5">Total Pelanggaran</p>
              <div class="flex items-baseline justify-center md:justify-end gap-1.5">
                <span class="text-4xl font-headline font-extrabold ${totalPelanggaran > 0 ? 'text-error' : 'text-success'} leading-none">${totalPelanggaran}</span>
                <span class="text-sm font-semibold text-slate-500">Kasus</span>
              </div>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div>
              <h3 class="text-xl font-headline font-bold text-slate-800 dark:text-white flex items-center gap-2">
                <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Riwayat Kedisiplinan
              </h3>
              <p class="text-sm text-slate-500 mt-1">Catatan pelanggaran diurutkan dari yang terbaru.</p>
            </div>
            ${totalPelanggaran > 0 ? `
              <div class="bg-error/10 text-error px-4 py-2 rounded-xl text-sm font-bold flex items-center gap-2 border border-error/20">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a1 1 0 00.9 1.5h16.56a1 1 0 00.9-1.5L13.71 3.86a1 1 0 00-1.72 0z"></path></svg>
                Perlu Perhatian
              </div>
            ` : ''}
          </div>

          ${totalPelanggaran > 0 ? `
            <div class="space-y-0 relative mt-4">
              ${pelanggaran.map((item, index) => `
                <div class="relative pl-8 sm:pl-12 pb-10 last:pb-0 group">
                  <!-- Timeline Line -->
                  ${index !== pelanggaran.length - 1 ? `<div class="absolute left-[11px] sm:left-[19px] top-6 bottom-[-24px] w-0.5 bg-slate-200 dark:bg-slate-700 group-hover:bg-error/40 transition-colors duration-300 rounded-full"></div>` : ''}
                  
                  <!-- Timeline Dot -->
                  <div class="absolute left-0 sm:left-2 top-6 w-6 h-6 rounded-full border-4 border-white dark:border-slate-900 bg-error flex items-center justify-center shadow-sm z-10 group-hover:scale-125 transition-transform duration-300">
                    <div class="w-1.5 h-1.5 bg-white rounded-full"></div>
                  </div>

                  <!-- Card -->
                  <div class="bg-white dark:bg-slate-800/60 rounded-2xl border p-5 sm:p-6 shadow-sm hover:shadow-lg transition-all duration-300 border-slate-200 dark:border-slate-700 hover:border-error/40">
                    
                    <div class="flex flex-col gap-3 mb-4">
                      <div class="flex items-center gap-3 flex-wrap">
                         <span class="px-3 py-1.5 text-[11px] leading-none uppercase tracking-wider font-extrabold rounded-md bg-error/10 text-error border border-error/20 flex items-center justify-center">
                           ${item.pelanggaran?.kategori_pelanggaran || 'Kategori'}
                         </span>
                         <span class="text-xs font-semibold flex items-center gap-1.5 text-slate-500 bg-slate-100 dark:bg-slate-800 px-3 py-1.5 rounded-md border border-slate-200 dark:border-slate-700 leading-none">
                           <svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                           ${item.tanggal_pelanggaran ? new Date(item.tanggal_pelanggaran).toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' }) : '-'}
                         </span>
                      </div>
                      <h4 class="font-headline font-semibold text-lg sm:text-xl text-slate-800 dark:text-slate-100 leading-snug">
                        ${item.pelanggaran?.nama_pelanggaran || 'Pelanggaran Tidak Diketahui'}
                      </h4>
                    </div>
                    
                    <div class="bg-slate-50 dark:bg-slate-900/50 rounded-xl p-4 mb-5 border border-slate-100 dark:border-slate-800 relative overflow-hidden">
                      <div class="absolute left-0 top-0 bottom-0 w-1 bg-error/50"></div>
                      <p class="text-sm text-slate-600 dark:text-slate-300 leading-relaxed">
                        <span class="font-bold text-slate-800 dark:text-slate-200 block mb-1 text-[11px] uppercase tracking-wider">Keterangan:</span>
                        ${item.keterangan ? item.keterangan : '<span class="italic text-slate-400">Tidak ada keterangan detail terkait kejadian ini.</span>'}
                      </p>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-4 sm:gap-8 pt-4 border-t border-slate-100 dark:border-slate-700/50">
                       <div class="flex items-center gap-3 group/info">
                          <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 group-hover/info:bg-primary/10 group-hover/info:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                          </div>
                          <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-bold mb-0.5">Dilaporkan Oleh</p>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300">${item.pelapor || '-'}</p>
                          </div>
                       </div>
                       <div class="w-px h-8 bg-slate-200 dark:bg-slate-700 hidden sm:block"></div>
                       <div class="flex items-center gap-3 group/info">
                          <div class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-500 group-hover/info:bg-primary/10 group-hover/info:text-primary transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                          </div>
                          <div>
                            <p class="text-[10px] uppercase tracking-wider text-slate-400 font-bold mb-0.5">Tahun Ajaran</p>
                            <p class="text-xs font-bold text-slate-700 dark:text-slate-300">${item.tahun_ajaran?.nama || '-'}${item.tahun_ajaran?.semester ? ' (' + item.tahun_ajaran.semester.charAt(0).toUpperCase() + item.tahun_ajaran.semester.slice(1) + ')' : ''}</p>
                          </div>
                       </div>
                    </div>
                  </div>
                </div>
              `).join('')}
            </div>
          ` : `
            <div class="empty-state py-16 px-4">
              <div class="empty-state-icon mx-auto mb-6 w-20 h-20 bg-success/10 rounded-full flex items-center justify-center shadow-inner shadow-success/20">
                <svg class="w-10 h-10 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
              </div>
              <h3 class="text-2xl font-headline font-bold text-slate-800 dark:text-white mb-2 text-center">Tidak Ada Pelanggaran</h3>
              <p class="text-body max-w-md mx-auto text-center leading-relaxed" style="color: var(--text-soft);">
                Luar biasa! Siswa dengan NIS <span class="font-mono font-bold text-slate-700 dark:text-slate-300">${murid?.nis || nis}</span> tercatat berkelakuan baik dan bersih dari catatan pelanggaran tata tertib.
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
