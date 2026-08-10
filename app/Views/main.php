<!DOCTYPE html>
<html lang="id" class="light">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/favicon.ico">
    <title><?= $this->renderSection('title') ?> · SITERTIB</title>
    <link rel="stylesheet" href="/css/app.css">
<script src="/js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=DM+Sans:wght@400;500;600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet" />
    <?= $this->renderSection('custom-css') ?>
</head>

<body class="overflow-x-hidden">

    <!-- Backdrop Overlay for Mobile Sidebar -->
    <div id="sidebarOverlay" class="sidebar-overlay" onclick="closeSidebar()"></div>

    <div class="app-layout">

        <!-- Sidebar -->
        <?= $this->include('components/sidebar') ?>

        <!-- Main Area -->
        <div class="main-area">

            <!-- Topbar -->
            <?= $this->include('components/topbar') ?>

            <!-- Main Content -->
            <main class="main-content fade-in">

                <?= $this->renderSection('content') ?>

            </main>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toastContainer" class="fixed top-5 right-5 z-[100] space-y-3"></div>

    <script>
        // ====================================================================
        // AUTH GUARD (Cek Token Wajib)
        // ====================================================================
        const accessToken = sessionStorage.getItem('access_token');
        function authHeaders(extra = {}) {
            const headers = { ...extra };
            if (accessToken) {
                headers.Authorization = accessToken;
            }
            return headers;
        }
        if (!accessToken) {
            // Redirect paksa ke halaman login jika token tidak ada
            window.location.href = '/login';
        }

        // ====================================================================
        // THEME TOGGLE
        // ====================================================================
        const root = document.documentElement;

        function applyTheme(theme) {
            if (theme === 'dark') {
                root.classList.add('dark');
                document.querySelector('.light-icon').classList.add('hidden');
                document.querySelector('.dark-icon').classList.remove('hidden');
            } else {
                root.classList.remove('dark');
                document.querySelector('.light-icon').classList.remove('hidden');
                document.querySelector('.dark-icon').classList.add('hidden');
            }
        }
        applyTheme(localStorage.getItem('theme') || 'light');
        document.getElementById('themeToggle').addEventListener('click', () => {
            const next = root.classList.contains('dark') ? 'light' : 'dark';
            localStorage.setItem('theme', next);
            applyTheme(next);
        });

        // ====================================================================
        // SIDEBAR TOGGLE (HIDE ON OUTSIDE CLICK)
        // ====================================================================
        function openSidebar() {
            document.getElementById('sidebar').classList.add('open');
            document.getElementById('sidebarOverlay').classList.add('open');
            document.body.style.overflow = 'hidden'; // Cegah scroll background
        }

        function closeSidebar() {
            document.getElementById('sidebar').classList.remove('open');
            document.getElementById('sidebarOverlay').classList.remove('open');
            document.body.style.overflow = '';
        }

        // ====================================================================
        // TOAST NOTIFICATION
        // ====================================================================
        function showToast(type, title, message) {
            const container = document.getElementById('toastContainer');
            const colors = {
                success: {
                    bg: 'bg-success',
                    icon: 'M5 13l4 4L19 7'
                },
                error: {
                    bg: 'bg-error',
                    icon: 'M6 18L18 6M6 6l12 12'
                },
                info: {
                    bg: 'bg-secondary',
                    icon: 'M13 16h-1v-4h-1m1-4h.01'
                }
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

        async function fetchUserProfile() {
            try {
                const res = await fetch('/api/user', {
                    headers: {
                        'Accept': 'application/json',
                        'Authorization': `Bearer ${accessToken}`
                    }
                });

                if (res.status === 401) {
                    // Token tidak valid -> keluarkan user
                    sessionStorage.removeItem('access_token');
                    sessionStorage.removeItem('user_role');
                    sessionStorage.removeItem('username');
                    sessionStorage.removeItem('login_at');
                    window.location.href = '/login';
                    return;
                }

                if (!res.ok) throw new Error('Gagal memuat profil');

                const data = await res.json();
                console.log(data);

                return {
                    username: data.username || sessionStorage.getItem('username') || 'Pengguna',
                    role: data.role || sessionStorage.getItem('user_role') || 'guru',
                    guru: data.guru || {
                        nama: sessionStorage.getItem('username') === 'admin' ? 'Administrator' : 'Budi Santoso',
                        nip: '-'
                    }
                };
            } catch (err) {
                console.error('fetchUserProfile error', err);
                // Fallback ke sessionStorage kalau API gagal
                return {
                    username: sessionStorage.getItem('username') || 'Pengguna',
                    role: sessionStorage.getItem('user_role') || 'guru',
                    guru: {
                        nama: sessionStorage.getItem('username') === 'admin' ? 'Administrator' : 'Budi Santoso',
                        nip: '198501012010011001'
                    }
                };
            }
        }

        

        // ====================================================================
        // LOGOUT LOGIC
        // ====================================================================
        document.getElementById('logoutBtn').addEventListener('click', async () => {
            try {
                // Simulasi POST /api/logout
                // await fetch('/api/logout', { method: 'POST', headers: { 'Authorization': `Bearer ${accessToken}` }});

                sessionStorage.removeItem('access_token');
                sessionStorage.removeItem('user_role');
                sessionStorage.removeItem('username');
                sessionStorage.removeItem('login_at');

                showToast('success', 'Logout Berhasil', 'Anda akan diarahkan ke halaman login.');

                setTimeout(() => {
                    window.location.href = '/login';
                }, 1000);
            } catch (err) {
                showToast('error', 'Gagal Logout', 'Terjadi kesalahan sistem.');
            }
        });
    </script>
    <script>
        // ====================================================================
        // TABLE PAGINATION & SORTING (JS)
        // ====================================================================
        class TableManager {
            constructor(tableBodyId, paginationContainerId, renderRowFn) {
                this.tableBody = document.getElementById(tableBodyId);
                this.paginationContainer = document.getElementById(paginationContainerId);
                this.renderRowFn = renderRowFn;
                this.data = [];
                this.currentPage = 1;
                this.itemsPerPage = 10;
                this.sortCol = null;
                this.sortAsc = true;
                this.emptyRenderFn = null;
            }

            setData(data) {
                this.data = data;
                this.currentPage = 1;
                this.render();
            }

            setSort(col) {
                if (this.sortCol === col) {
                    this.sortAsc = !this.sortAsc;
                } else {
                    this.sortCol = col;
                    this.sortAsc = true;
                }
                this.render();
            }

            render() {
                if (!this.data || this.data.length === 0) {
                    if (this.paginationContainer) this.paginationContainer.innerHTML = '';
                    if (this.emptyRenderFn) this.emptyRenderFn();
                    return;
                }

                let displayData = [...this.data];

                // Sort
                if (this.sortCol) {
                    displayData.sort((a, b) => {
                        let va = a[this.sortCol];
                        let vb = b[this.sortCol];
                        if (va === null || va === undefined) va = '';
                        if (vb === null || vb === undefined) vb = '';
                        if (typeof va === 'string') va = va.toLowerCase();
                        if (typeof vb === 'string') vb = vb.toLowerCase();
                        if (va < vb) return this.sortAsc ? -1 : 1;
                        if (va > vb) return this.sortAsc ? 1 : -1;
                        return 0;
                    });
                }

                // Paginate
                const totalPages = Math.ceil(displayData.length / this.itemsPerPage);
                if (this.currentPage > totalPages) this.currentPage = totalPages || 1;
                const start = (this.currentPage - 1) * this.itemsPerPage;
                const paginatedData = displayData.slice(start, start + this.itemsPerPage);

                // Render rows
                if (this.tableBody) {
                    this.tableBody.innerHTML = paginatedData.map((item, index) => this.renderRowFn(item, start + index)).join('');
                }

                // Render pagination controls
                this.renderPaginationControls(totalPages, displayData.length, start, paginatedData.length);
            }

            renderPaginationControls(totalPages, totalItems, start, currentLength) {
                if (!this.paginationContainer) return;
                if (totalItems === 0) {
                    this.paginationContainer.innerHTML = '';
                    return;
                }

                let html = `<div class="flex flex-col sm:flex-row items-center justify-between w-full gap-4 text-sm" style="color: var(--text-soft);">`;
                html += `<div>Menampilkan ${start + 1} sampai ${start + currentLength} dari ${totalItems} data</div>`;
                
                if (totalPages > 1) {
                    html += `<div class="flex items-center gap-1">`;
                    
                    // Prev
                    html += `<button class="btn-icon ${this.currentPage === 1 ? 'opacity-50 cursor-not-allowed' : ''}" 
                              ${this.currentPage === 1 ? 'disabled' : ''} 
                              onclick="window.tableManagers['${this.paginationContainer.id}'].changePage(${this.currentPage - 1})">
                              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                             </button>`;

                    // Pages
                    for (let i = 1; i <= totalPages; i++) {
                        if (i === 1 || i === totalPages || (i >= this.currentPage - 1 && i <= this.currentPage + 1)) {
                            const activeClass = this.currentPage === i ? 'bg-primary/10 text-primary border-primary' : '';
                            html += `<button class="btn-icon ${activeClass}" 
                                      onclick="window.tableManagers['${this.paginationContainer.id}'].changePage(${i})">${i}</button>`;
                        } else if (i === this.currentPage - 2 || i === this.currentPage + 2) {
                            html += `<span class="px-2">...</span>`;
                        }
                    }

                    // Next
                    html += `<button class="btn-icon ${this.currentPage === totalPages ? 'opacity-50 cursor-not-allowed' : ''}" 
                              ${this.currentPage === totalPages ? 'disabled' : ''} 
                              onclick="window.tableManagers['${this.paginationContainer.id}'].changePage(${this.currentPage + 1})">
                              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                             </button>`;

                    html += `</div>`;
                } else {
                    html += `<div></div>`;
                }

                html += `</div>`;
                this.paginationContainer.innerHTML = html;
                
                // Update sorting icons in headers
                document.querySelectorAll('.sort-icon').forEach(el => {
                    el.innerHTML = '<svg class="w-3 h-3 opacity-30" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/></svg>';
                });
                if (this.sortCol) {
                    const activeHeader = document.querySelector(`th[data-sort="${this.sortCol}"] .sort-icon`);
                    if (activeHeader) {
                        activeHeader.innerHTML = this.sortAsc 
                            ? '<svg class="w-3 h-3 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>'
                            : '<svg class="w-3 h-3 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>';
                    }
                }
            }

            changePage(page) {
                this.currentPage = page;
                this.render();
            }
        }
        window.tableManagers = {};
    </script>
    <?= $this->renderSection('custom-js') ?>
</body>

</html>