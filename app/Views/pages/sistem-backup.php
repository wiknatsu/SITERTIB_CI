<?= $this->extend('main') ?>
<?= $this->section('title') ?>Backup & Restore Sistem<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card { background-color: var(--surface-base); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 32px; transition: all 0.2s ease; }
  .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; padding: 12px 24px; border-radius: 12px; font-weight: 600; font-size: 14px; transition: all 0.2s ease; cursor: pointer; border: none; }
  .btn-primary { background-color: #E11D48; color: #fff; box-shadow: 0 8px 20px -8px rgba(225, 29, 72, 0.5); }
  .btn-primary:hover { background-color: #BE123C; transform: translateY(-1px); }
  .btn-secondary { background-color: var(--surface-soft); color: var(--text-strong); border: 1px solid var(--border-subtle); }
  .btn-secondary:hover { background-color: var(--border-subtle); }

  .icon-wrapper { width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center; margin-bottom: 20px; }
  .icon-blue { background: rgba(37,99,235,0.1); color: #2563EB; }
  .icon-pink { background: rgba(225,29,72,0.1); color: #E11D48; }

  .form-group { margin-bottom: 20px; }
  .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-soft); margin-bottom: 6px; font-family: 'DM Sans'; }
  .form-input { width: 100%; padding: 10px 14px; border: 1px solid var(--border-subtle); border-radius: 10px; font-size: 14px; color: var(--text-strong); background: var(--surface-soft); transition: all 0.2s; font-family: 'DM Sans'; }
  .form-input:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto">
  <div class="mb-8">
    <h1 class="text-h2">Backup & Restore Sistem</h1>
    <p class="text-body" style="color: var(--text-soft);">Kelola salinan data sistem untuk keamanan dan pemulihan data.</p>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
    
    <!-- Backup Section -->
    <div class="card shadow-xl shadow-black/5 flex flex-col">
      <div class="icon-wrapper icon-blue">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Backup Database</h3>
      <p class="text-body mb-8" style="color: var(--text-soft); flex: 1;">Unduh seluruh data sistem saat ini ke dalam file backup database. Di lingkungan produksi, backup akan menggunakan MySQL.</p>
       
      <button class="btn btn-secondary w-full" onclick="downloadBackup()">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
        Download Backup Sekarang
      </button>
    </div>

    <!-- Restore Section -->
    <div class="card shadow-xl shadow-black/5 flex flex-col">
      <div class="icon-wrapper icon-pink">
        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Restore Database</h3>
      <p class="text-body mb-6" style="color: var(--text-soft);">Pulihkan sistem dari file backup sebelumnya. <strong class="text-error">Peringatan:</strong> Data saat ini akan ditimpa seluruhnya.</p>
      
      <form id="restoreForm" class="mt-auto" onsubmit="submitRestore(event)">
        <div class="form-group">
          <input type="file" id="backupFile" accept=".sqlite,.db,.sql,.sql.gz" class="form-input" required>
        </div>
        <button type="submit" class="btn btn-primary w-full" id="restoreBtn">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
          Mulai Restore Data
        </button>
      </form>
    </div>

  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  async function downloadBackup() {
    showToast('info', 'Backup Diproses', 'Mengunduh file database backup...');
    try {
      const res = await fetch('/api/system/backup', { headers: { 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal mengunduh backup');
      const blob = await res.blob();
      const objUrl = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = objUrl;
      const disposition = res.headers.get('content-disposition') || '';
      const match = disposition.match(/filename="?([^";]+)"?/);
      link.setAttribute('download', match ? match[1] : 'database_backup.sqlite');
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(objUrl);
    } catch (err) {
      showToast('error', 'Backup Gagal', err.message);
    }
  }

  async function submitRestore(e) {
    e.preventDefault();
    const fileInput = document.getElementById('backupFile');
    const file = fileInput.files[0];
    if (!file) return;

    if (!confirm('Peringatan: Data saat ini akan diganti seluruhnya dengan data dari file backup. Anda yakin ingin melanjutkan?')) {
      return;
    }

    const fd = new FormData();
    fd.append('file', file);
    
    const btn = document.getElementById('restoreBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-spin mr-2">⏳</span> Merestore...';

    try {
      const res = await fetch('/api/system/restore', {
        method: 'POST',
        headers: { 'Authorization': `Bearer ${accessToken}` },
        body: fd
      });
      
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal merestore backup');
      
      showToast('success', 'Restore Berhasil', 'Database berhasil dipulihkan. Memuat ulang sistem...');
      fileInput.value = '';
      
      setTimeout(() => {
        window.location.reload();
      }, 1500);

    } catch (err) {
      showToast('error', 'Gagal Restore', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg> Mulai Restore Data';
    }
  }

  (async function init() {
    const user = await fetchUserProfile();
    document.getElementById('userName').textContent = user.guru?.nama || user.username;
    document.getElementById('userRoleDisplay').textContent = user.role === 'admin' ? 'Administrator' : 'Guru';
    document.getElementById('userNipDisplay').textContent = `NIP: ${user.guru?.nip || '-'}`;
    document.getElementById('userAvatar').textContent = (user.guru?.nama || user.username).charAt(0).toUpperCase();
  })();
</script>
<?= $this->endSection() ?>
