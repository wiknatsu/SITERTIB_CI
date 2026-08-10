<!DOCTYPE html>
<html lang="id" class="light">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>Masuk · SITERTIB</title>
<link rel="stylesheet" href="/css/login.css">
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

  <!-- Top bar -->
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

    <button id="themeToggle" class="theme-toggle glass rounded-full w-11 h-11 grid place-items-center hover:scale-105 transition-transform" aria-label="Ganti tema">
      <svg class="theme-icon w-5 h-5 light-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="4"/>
        <path stroke-linecap="round" d="M12 2v2M12 20v2M2 12h2M20 12h2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/>
      </svg>
      <svg class="theme-icon w-5 h-5 dark-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/>
      </svg>
    </button>
  </header>

  <!-- Main content -->
  <main class="relative z-10 px-6 lg:px-12 pb-12">
    <div class="max-w-7xl mx-auto grid lg:grid-cols-2 gap-12 lg:gap-8 items-center min-h-[calc(100vh-120px)]">

      <!-- Left: Branding + mock -->
      <section class="relative hidden lg:block enter">
        <div class="relative">
          <span class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full glass text-caption mb-6">
            <span class="w-2 h-2 rounded-full bg-success animate-pulse"></span>
            <?= $tahunAjaranAktif ? 'Tahun Ajaran ' . $tahunAjaranAktif->nama . ' · Semester ' . ucfirst($tahunAjaranAktif->semester) : 'Tahun Ajaran Belum Diatur' ?>
          </span>

          <h1 class="text-h1 mb-5" style="color: var(--text-strong);">
            Bangun sekolah<br/>
            yang lebih <span class="text-primary">tertib</span><br/>
            dan terpantau.
          </h1>
          <p class="text-body-lg max-w-md mb-10" style="color: var(--text-soft);">
            Catat pelanggaran, kelola poin, dan pantau kedisiplinan siswa secara real-time dalam satu platform terpadu.
          </p>

          <!-- Floating mock cards -->
          <div class="relative h-[280px]">
            <!-- Card 1: Pelanggaran Hari Ini -->
            <div class="mock-card absolute left-0 top-4 w-72 glass rounded-2xl p-5 shadow-2xl shadow-black/5">
              <div class="flex items-center justify-between mb-4">
                <p class="font-headline font-semibold text-sm">Pelanggaran Hari Ini</p>
                <span class="text-caption px-2 py-0.5 rounded-md bg-error/15 text-error font-medium">3 kasus</span>
              </div>
              <div class="space-y-3">
                <div class="flex items-center gap-3">
                  <div class="w-1 h-8 rounded-full bg-primary"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium">Terlambat masuk · 9A</p>
                    <p class="text-mono" style="color: var(--text-soft);">5 poin</p>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-1 h-8 rounded-full bg-warning"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium">Seragam tidak rapi · 8B</p>
                    <p class="text-mono" style="color: var(--text-soft);">3 poin</p>
                  </div>
                </div>
                <div class="flex items-center gap-3">
                  <div class="w-1 h-8 rounded-full bg-error"></div>
                  <div class="flex-1">
                    <p class="text-sm font-medium">Membuang sampah sembarangan</p>
                    <p class="text-mono" style="color: var(--text-soft);">10 poin</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Card 2: Rekap Poin -->
            <div class="mock-card-2 absolute right-0 bottom-0 w-60 glass rounded-2xl p-5 shadow-2xl shadow-black/5">
              <p class="font-headline font-semibold text-sm mb-3">Rekap Poin Minggu Ini</p>
              <div class="flex items-end gap-2 mb-2">
                <span class="text-h2 text-primary">142</span>
                <span class="text-caption text-error mb-1.5">▲ 18</span>
              </div>
              <div class="flex items-end gap-1.5 h-12">
                <div class="flex-1 rounded-t bg-primary/30" style="height: 40%"></div>
                <div class="flex-1 rounded-t bg-primary/40" style="height: 55%"></div>
                <div class="flex-1 rounded-t bg-primary/50" style="height: 65%"></div>
                <div class="flex-1 rounded-t bg-primary/60" style="height: 50%"></div>
                <div class="flex-1 rounded-t bg-primary/70" style="height: 75%"></div>
                <div class="flex-1 rounded-t bg-primary/80" style="height: 70%"></div>
                <div class="flex-1 rounded-t bg-primary" style="height: 90%"></div>
              </div>
              <p class="text-caption mt-2" style="color: var(--text-soft);">32 pelanggaran tercatat</p>
            </div>
          </div>
        </div>
      </section>

      <!-- Right: Form -->
      <section class="enter enter-delay-1 w-full max-w-md mx-auto lg:mx-0 lg:ml-auto">
        <div class="glass rounded-3xl p-8 lg:p-10 shadow-2xl shadow-black/5">

          <div class="mb-8">
            <h2 class="text-h2 mb-2">Selamat datang</h2>
            <p class="text-body" style="color: var(--text-soft);">
              Masuk untuk mengakses dashboard pencatatan tata tertib.
            </p>
          </div>

          <!-- Role selector -->
          <!-- <div class="grid grid-cols-2 gap-2 p-1 rounded-xl mb-7" style="background: var(--border-subtle);">
            <button type="button" data-role="guru" class="role-btn py-2.5 rounded-lg text-sm font-medium font-headline transition-all bg-white dark:bg-slate-800 shadow-sm text-primary">
              Guru
            </button>
            <button type="button" data-role="admin" class="role-btn py-2.5 rounded-lg text-sm font-medium font-headline transition-all" style="color: var(--text-soft);">
              Admin
            </button>
          </div> -->

          <form id="loginForm" class="space-y-5" novalidate>
            <!-- Username -->
            <div>
              <label for="username" class="block text-caption mb-2 font-medium" style="color: var(--text-soft);">
                Nama Pengguna
              </label>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                  </svg>
                </span>
                <input
                  id="username"
                  name="username"
                  type="text"
                  autocomplete="username"
                  placeholder="cth: budi.santoso"
                  class="field-input w-full pl-12 pr-4 py-3.5 rounded-xl text-body"
                />
              </div>
              <p class="error-msg text-caption text-error mt-1.5 hidden"></p>
            </div>

            <!-- Password -->
            <div>
              <div class="flex items-center justify-between mb-2">
                <label for="password" class="block text-caption font-medium" style="color: var(--text-soft);">
                  Kata Sandi
                </label>
                <button type="button" id="forgotBtn" class="text-caption text-secondary hover:underline">Lupa sandi?</button>
              </div>
              <div class="relative">
                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <rect x="4" y="11" width="16" height="9" rx="2"/>
                    <path stroke-linecap="round" d="M8 11V7a4 4 0 118 0v4"/>
                  </svg>
                </span>
                <input
                  id="password"
                  name="password"
                  type="password"
                  autocomplete="current-password"
                  placeholder="••••••••"
                  class="field-input w-full pl-12 pr-12 py-3.5 rounded-xl text-body"
                />
                <button type="button" id="togglePw" class="absolute right-3 top-1/2 -translate-y-1/2 p-1.5 rounded-lg hover:bg-black/5 dark:hover:bg-white/10 text-slate-400" aria-label="Tampilkan sandi">
                  <svg class="w-5 h-5 eye-open" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.5 12s3.5-7 9.5-7 9.5 7 9.5 7-3.5 7-9.5 7-9.5-7-9.5-7z"/>
                    <circle cx="12" cy="12" r="3"/>
                  </svg>
                  <svg class="w-5 h-5 eye-closed hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18M10.6 10.6a3 3 0 004.2 4.2M9.4 5.2A9.3 9.3 0 0112 5c6 0 9.5 7 9.5 7a16 16 0 01-2.6 3.4M6.1 6.1A16 16 0 002.5 12s3.5 7 9.5 7a9.3 9.3 0 003.4-.6"/>
                  </svg>
                </button>
              </div>
              <p class="error-msg text-caption text-error mt-1.5 hidden"></p>
            </div>

            <!-- Remember -->
            <div class="flex items-center gap-2.5">
              <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" id="remember" class="sr-only peer" />
                <div class="w-5 h-5 rounded-md border-2 border-slate-300 dark:border-slate-600 peer-checked:bg-primary peer-checked:border-primary transition-all grid place-items-center">
                  <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                  </svg>
                </div>
              </label>
              <label for="remember" class="text-caption cursor-pointer" style="color: var(--text-soft);">Ingat saya selama 7 hari</label>
            </div>

            <!-- Submit -->
            <button type="submit" id="submitBtn" class="btn-primary w-full py-3.5 rounded-xl font-headline font-semibold text-base flex items-center justify-center gap-2 mt-2">
              <span id="submitText">Masuk ke Dashboard</span>
              <svg id="submitSpinner" class="hidden w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="3" opacity="0.25"/>
                <path d="M12 2a10 10 0 0110 10" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
              </svg>
              <svg id="submitArrow" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5-5 5M6 12h12"/>
              </svg>
            </button>

          </form>

          <a href="<?= base_url(); ?>" class="btn-secondary w-full py-3.5 rounded-xl font-headline font-semibold text-base flex items-center justify-center gap-2 mt-3">Kembali ke Beranda</a>

          <p class="text-caption text-center mt-7" style="color: var(--text-soft);">
            Butuh bantuan? Hubungi <a href="#" class="text-secondary hover:underline">Admin Sekolah</a>
          </p>
        </div>
      </section>
    </div>
  </main>

  <!-- Toast container -->
  <div id="toastContainer" class="fixed top-5 right-5 z-50 space-y-3"></div>

<script>
  // ============= THEME =============
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

  // Redirect to dashboard if already logged in
  (function redirectIfAlreadyLoggedIn() {
    const token = sessionStorage.getItem('access_token');
    if (token) {
      window.location.replace('/dashboard');
    }
  })();

  themeToggle.addEventListener('click', () => {
    const next = root.classList.contains('dark') ? 'light' : 'dark';
    localStorage.setItem('theme', next);
    applyTheme(next);
  });

  // ============= ROLE SELECTOR =============
  let currentRole = 'guru';
  const roleButtons = document.querySelectorAll('.role-btn');
  roleButtons.forEach(btn => {
    btn.addEventListener('click', () => {
      currentRole = btn.dataset.role;
      roleButtons.forEach(b => {
        b.classList.remove('bg-white', 'dark:bg-slate-800', 'shadow-sm', 'text-primary');
        b.style.color = 'var(--text-soft)';
      });
      btn.classList.add('bg-white', 'dark:bg-slate-800', 'shadow-sm', 'text-primary');
      btn.style.color = '';
    });
  });

  // ============= PASSWORD TOGGLE =============
  const pwInput = document.getElementById('password');
  const togglePw = document.getElementById('togglePw');
  togglePw.addEventListener('click', () => {
    const isPw = pwInput.type === 'password';
    pwInput.type = isPw ? 'text' : 'password';
    togglePw.querySelector('.eye-open').classList.toggle('hidden', isPw);
    togglePw.querySelector('.eye-closed').classList.toggle('hidden', !isPw);
  });

  // ============= VALIDATION HELPERS =============
  function showError(input, msg) {
    input.classList.add('error');
    const wrap = input.closest('div').parentElement;
    const errEl = wrap.querySelector('.error-msg');
    if (errEl) {
      errEl.textContent = msg;
      errEl.classList.remove('hidden');
    }
  }
  function clearError(input) {
    input.classList.remove('error');
    const wrap = input.closest('div').parentElement;
    const errEl = wrap.querySelector('.error-msg');
    if (errEl) errEl.classList.add('hidden');
  }

  document.getElementById('username').addEventListener('input', e => clearError(e.target));
  document.getElementById('password').addEventListener('input', e => clearError(e.target));

  // ============= TOAST =============
  function showToast(type, title, message) {
    const container = document.getElementById('toastContainer');
    const colors = {
      success: { bg: 'bg-success', icon: 'M5 13l4 4L19 7' },
      error: { bg: 'bg-error', icon: 'M6 18L18 6M6 6l12 12' },
      info: { bg: 'bg-secondary', icon: 'M13 16h-1v-4h-1m1-4h.01' },
      warning: { bg: 'bg-warning', icon: 'M12 9v2m0 4h.01M5 19h14a2 2 0 001.7-3L13.7 4a2 2 0 00-3.4 0L3.3 16A2 2 0 005 19z' },
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
      <button class="text-slate-400 hover:text-slate-600" onclick="this.parentElement.remove()">
        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 6l12 12M6 18L18 6"/></svg>
      </button>
    `;
    container.appendChild(toast);
    setTimeout(() => {
      toast.style.transition = 'all 0.3s';
      toast.style.opacity = '0';
      toast.style.transform = 'translateX(20px)';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }

  // ============= FORM SUBMIT =============
  const form = document.getElementById('loginForm');
  const submitBtn = document.getElementById('submitBtn');
  const submitText = document.getElementById('submitText');
  const submitSpinner = document.getElementById('submitSpinner');
  const submitArrow = document.getElementById('submitArrow');

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const username = usernameInput.value.trim();
    const password = passwordInput.value;

    let valid = true;
    if (!username) {
      showError(usernameInput, 'Nama pengguna wajib diisi.');
      valid = false;
    } else if (username.length < 3) {
      showError(usernameInput, 'Nama pengguna minimal 3 karakter.');
      valid = false;
    }
    if (!password) {
      showError(passwordInput, 'Kata sandi wajib diisi.');
      valid = false;
    } else if (password.length < 6) {
      showError(passwordInput, 'Kata sandi minimal 6 karakter.');
      valid = false;
    }
    if (!valid) {
      showToast('warning', 'Form belum lengkap', 'Periksa kembali isian Anda.');
      return;
    }

    // Loading state
    submitBtn.disabled = true;
    submitText.textContent = 'Memverifikasi...';
    submitSpinner.classList.remove('hidden');
    submitArrow.classList.add('hidden');

    try {
      // Panggilan ke API login
      const res = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, password })
      });

      const data = await res.json();

      if (!res.ok) {
        const message = data.message || 'Nama pengguna atau kata sandi salah.';
        showToast('error', 'Login gagal', message);
        showError(passwordInput, 'Kredensial tidak cocok.');
      } else {
        // Simpan token dan info user
        if (data.access_token) {
          sessionStorage.setItem('access_token', data.access_token);
        }
        sessionStorage.setItem('user_role', (data.user && data.user.role) ? data.user.role : currentRole);
        sessionStorage.setItem('username', (data.user && data.user.username) ? data.user.username : username);
        sessionStorage.setItem('login_at', new Date().toISOString());

        showToast('success', 'Berhasil masuk', `Selamat datang, ${sessionStorage.getItem('username')}! Mengarahkan ke dashboard...`);

        // Redirect ke dashboard utama
        setTimeout(() => {
          window.location.replace('/dashboard');
        }, 700);
      }
    } catch (err) {
      showToast('error', 'Kesalahan jaringan', 'Tidak dapat terhubung ke server. Coba lagi.');
    } finally {
      submitBtn.disabled = false;
      submitText.textContent = 'Masuk ke Dashboard';
      submitSpinner.classList.add('hidden');
      submitArrow.classList.remove('hidden');
    }
  });

  // ============= FORGOT PASSWORD =============
  document.getElementById('forgotBtn').addEventListener('click', () => {
    showToast('info', 'Reset kata sandi', 'Hubungi admin sekolah untuk reset sandi Anda.');
  });
</script>
</body>
</html><?php /**PATH D:\Project\LARAVEL\SITERTIB\resources\views/login.blade.php ENDPATH**/ ?>
