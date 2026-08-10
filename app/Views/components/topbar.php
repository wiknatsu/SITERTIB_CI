<header class="topbar flex items-center justify-between px-6 lg:px-8">
    <div class="flex items-center gap-4">
        <button class="sidebar-toggle w-10 h-10 rounded-lg border place-items-center" style="border-color: var(--border-subtle);" onclick="openSidebar()">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div>
            <p class="text-caption" style="color: var(--text-soft);">Halo, selamat datang kembali</p>
            <h1 class="text-h3" id="userName">Memuat nama...</h1>
        </div>
    </div>

    <div class="flex items-center gap-4">
        <button id="themeToggle" class="w-10 h-10 rounded-full grid place-items-center hover:bg-black/5 dark:hover:bg-white/10 transition-colors" aria-label="Ganti tema">
            <svg class="w-5 h-5 light-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="4" />
                <path stroke-linecap="round" d="M12 2v2M12 20v2M2 12h2M20 12h2M4.93 4.93l1.41 1.41M17.66 17.66l1.41 1.41M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41" />
            </svg>
            <svg class="w-5 h-5 dark-icon hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
        </button>
        <div class="flex items-center gap-3">
            <div class="text-right hidden md:block">
                <p class="text-body font-semibold text-sm" id="userRoleDisplay">-</p>
                <p class="text-caption" style="color: var(--text-soft);" id="userNipDisplay">NIP: -</p>
            </div>
            <div class="w-10 h-10 rounded-full bg-primary text-white grid place-items-center font-headline font-semibold" id="userAvatar">?</div>
        </div>
    </div>
</header>
