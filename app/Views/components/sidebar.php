<aside class="sidebar flex flex-col" id="sidebar">
    <div class="p-6 flex items-center gap-3 shrink-0">
        <div class="w-10 h-10 rounded-xl bg-primary grid place-items-center shadow-lg shadow-primary/30">
            <svg viewBox="0 0 24 24" fill="none" class="w-5 h-5 text-white">
                <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3z" fill="currentColor" />
                <path d="M9 12l2 2 4-4" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
        </div>
        <div class="leading-tight">
            <p class="font-headline font-semibold text-[17px]">SITERTIB</p>
            <p class="text-caption" style="color: var(--text-soft);">Tata Tertib</p>
        </div>
    </div>

    <nav class="px-4 py-4 space-y-6 sidebar-nav flex-1 overflow-y-auto">
        <!-- Menu Utama -->
        <div>
            <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Menu Utama</p>
            <div class="space-y-1">
                <a href="/dashboard" class="nav-item" data-path="/dashboard">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
            </div>
        </div>

        <!-- Transaksi -->
        <div>
            <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Transaksi</p>
            <div class="space-y-1">
                <a href="/catat-pelanggaran" class="nav-item" data-path="/catat-pelanggaran">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                    </svg>
                    Input Pelanggaran
                </a>
                <a href="/riwayat-pelanggaran" class="nav-item" data-path="/riwayat-pelanggaran">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Riwayat Pelanggaran
                </a>
            </div>
        </div>

        <!-- Master Data (Admin Only - akan disembunyikan via JS) -->
        <div id="sidebarMasterData">
            <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Master Data</p>
            <div class="space-y-1">
                <a href="/murid" class="nav-item" data-path="/murid">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                    </svg>
                    Data Murid
                </a>
                <a href="/guru" class="nav-item" data-path="/guru">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    Data Guru
                </a>
                <a href="/jenis-pelanggaran" class="nav-item" data-path="/jenis-pelanggaran">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Jenis Pelanggaran
                </a>
                <a href="/tahun-ajaran" class="nav-item" data-path="/tahun-ajaran">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Tahun Ajaran
                </a>
            </div>
        </div>

        <!-- Konfigurasi Sistem (Admin Only) -->
        <div id="sidebarConfig">
            <p class="px-3 mb-2 text-[11px] font-semibold uppercase tracking-wider" style="color: var(--text-muted);">Konfigurasi</p>
            <div class="space-y-1">
                <a href="/users" class="nav-item" data-path="/users">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    Manajemen User
                </a>
                <a href="/sistem-backup" class="nav-item" data-path="/sistem-backup">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                    </svg>
                    Backup & Restore
                </a>
            </div>
        </div>
    </nav>

    <div class="p-4 border-t shrink-0" style="border-color: var(--border-subtle); background: var(--bg-surface);">
        <button id="logoutBtn" class="nav-item w-full text-error hover:bg-error/5">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Keluar (Logout)
        </button>
    </div>

    <script>
        // Sidebar active state
        (function() {
            const currentPath = window.location.pathname;
            document.querySelectorAll('.sidebar-nav .nav-item').forEach(item => {
                const path = item.getAttribute('data-path');
                if (path && currentPath === path) {
                    item.classList.add('active');
                }
            });

            // Hide admin-only menus for guru role
            const userRole = sessionStorage.getItem('user_role');
            if (userRole === 'guru') {
                const masterData = document.getElementById('sidebarMasterData');
                const config = document.getElementById('sidebarConfig');
                if (masterData) masterData.style.display = 'none';
                if (config) config.style.display = 'none';
            }
        })();
    </script>
</aside>