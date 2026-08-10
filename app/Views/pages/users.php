<?= $this->extend('main') ?>
<?= $this->section('title') ?>Manajemen User<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card { background-color: var(--surface-base); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 24px; transition: all 0.2s ease; }
  .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.2s ease; cursor: pointer; border: none; }
  .btn-primary { background-color: #E11D48; color: #fff; box-shadow: 0 8px 20px -8px rgba(225, 29, 72, 0.5); }
  .btn-primary:hover { background-color: #BE123C; transform: translateY(-1px); }
  .btn-secondary { background-color: var(--surface-soft); color: var(--text-strong); border: 1px solid var(--border-subtle); }
  .btn-secondary:hover { background-color: var(--border-subtle); }
  .btn-danger { background-color: #DC2626; color: #fff; }
  .btn-danger:hover { background-color: #B91C1C; }
  .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 8px; }
  .btn-icon { padding: 8px; border-radius: 8px; background: transparent; border: 1px solid var(--border-subtle); cursor: pointer; color: var(--text-soft); transition: all 0.2s; }
  .btn-icon:hover { background: var(--surface-soft); color: var(--text-strong); }
  .btn-icon.danger:hover { background: rgba(220,38,38,0.1); color: #DC2626; border-color: rgba(220,38,38,0.3); }

  .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
  .data-table thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border-subtle); font-family: 'DM Sans'; }
  .data-table tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--border-subtle); color: var(--text-strong); font-family: 'DM Sans'; vertical-align: middle; }
  .data-table tbody tr { transition: background 0.15s; }
  .data-table tbody tr:hover { background: var(--surface-soft); }
  .data-table tbody tr:last-child td { border-bottom: none; }

  .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; font-family: 'DM Sans'; }
  .badge-admin { background: rgba(37,99,235,0.1); color: #2563EB; }
  .badge-guru { background: rgba(225,29,72,0.1); color: #E11D48; }

  /* Modal */
  .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 80; display: none; align-items: center; justify-content: center; }
  .modal-overlay.active { display: flex; }
  .modal-box { background: var(--surface-base); border-radius: 20px; padding: 32px; width: 95%; max-width: 520px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: slideUp 0.3s cubic-bezier(0.22,1,0.36,1); }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px) scale(0.97); } to { opacity: 1; transform: translateY(0) scale(1); } }

  .form-group { margin-bottom: 20px; }
  .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-soft); margin-bottom: 6px; font-family: 'DM Sans'; }
  .form-input, .form-select { width: 100%; padding: 10px 14px; border: 1px solid var(--border-subtle); border-radius: 10px; font-size: 14px; color: var(--text-strong); background: var(--surface-soft); transition: all 0.2s; font-family: 'DM Sans'; }
  .form-input:focus, .form-select:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); }

  .skeleton { background: linear-gradient(90deg, var(--surface-soft) 25%, var(--border-subtle) 50%, var(--surface-soft) 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 6px; }
  @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

  .empty-state { text-align: center; padding: 60px 24px; }
  .empty-icon { width: 64px; height: 64px; margin: 0 auto 16px; border-radius: 50%; display: grid; place-items: center; background: var(--surface-soft); }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-h2">Manajemen User</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <div class="flex items-center gap-3">
    <button class="btn btn-secondary" onclick="syncGurus()" id="syncBtn">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
      Sync dari Data Guru
    </button>
    <button class="btn btn-primary" onclick="openCreateModal()">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      Tambah User Baru
    </button>
  </div>
</div>

<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th>Username</th>
          <th>Role</th>
          <th>Terkait Guru</th>
          <th style="width:100px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="5"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="5"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
      </tbody>
    </table>
  </div>
</div>

<!-- Form Modal -->
<div class="modal-overlay" id="formModal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3" id="formModalTitle">Tambah User</h2>
      <button class="btn-icon" onclick="closeFormModal()">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <form id="userForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      
      <div class="form-group">
        <label class="form-label">Username <span class="text-error">*</span></label>
        <input type="text" id="formUsername" class="form-input" placeholder="cth: budi.bk" required>
      </div>

      <div class="form-group">
        <label class="form-label">Password <span class="text-caption text-muted font-normal ml-1" id="pwHint">(Biarkan kosong jika tidak ingin mengubah sandi)</span></label>
        <input type="password" id="formPassword" class="form-input" placeholder="Masukkan password" required>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="form-group">
          <label class="form-label">Role <span class="text-error">*</span></label>
          <select id="formRole" class="form-select" required>
            <option value="guru">Guru</option>
            <option value="admin">Administrator</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Terkait Data Guru (Opsional)</label>
          <select id="formGuru" class="form-select">
            <option value="">-- Pilih Guru --</option>
          </select>
        </div>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button type="button" class="btn btn-secondary" onclick="closeFormModal()">Batal</button>
        <button type="submit" class="btn btn-primary" id="formSubmitBtn">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          Simpan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-box" style="max-width:420px;">
    <div class="text-center">
      <div class="w-16 h-16 rounded-full bg-error/10 grid place-items-center mx-auto mb-4">
        <svg class="w-8 h-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Hapus User?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);">User <strong id="deleteUsername"></strong> akan dihapus permanen. Aksi ini tidak dapat dibatalkan.</p>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        <button class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">
          Ya, Hapus
        </button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  let allData = [];
  let deleteId = null;

  async function loadGurus() {
    try {
      const res = await fetch('/api/gurus', { headers: { 'Authorization': `Bearer ${accessToken}` } });
      const data = await res.json();
      const gurus = Array.isArray(data) ? data : (data.data || []);
      const options = gurus.map(g => `<option value="${g.id}">${g.nama}</option>`).join('');
      document.getElementById('formGuru').innerHTML += options;
    } catch(e) {
      console.warn('Gagal memuat list guru');
    }
  }

  async function fetchData() {
    try {
      const res = await fetch('/api/users', { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal memuat data');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);
      renderTable(allData);
      document.getElementById('subtitleCount').textContent = `Total: ${allData.length} user`;
    } catch (err) {
      console.error(err);
      showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data user.');
      renderEmpty();
    }
  }

  function getRoleBadge(role) {
    if (role === 'admin') return `<span class="badge badge-admin">Administrator</span>`;
    return `<span class="badge badge-guru">Guru</span>`;
  }

  function renderTable(data) {
    const tbody = document.getElementById('tableBody');
    if (!data.length) { renderEmpty(); return; }
    
    tbody.innerHTML = data.map((u, i) => `
      <tr>
        <td>${i+1}</td>
        <td><strong>${u.username}</strong></td>
        <td>${getRoleBadge(u.role)}</td>
        <td>${u.guru ? u.guru.nama : '-'}</td>
        <td>
          <div class="flex items-center gap-2">
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(u)})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${u.id}, '${u.username}')">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
  }

  function renderEmpty() {
    document.getElementById('tableBody').innerHTML = `
      <tr><td colspan="5">
        <div class="empty-state">
          <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
          <h3 class="text-h3 mb-1">Belum Ada Data User</h3>
          <p class="text-body" style="color:var(--text-soft);">Tambahkan user untuk memberi akses ke sistem.</p>
        </div>
      </td></tr>`;
  }

  function openCreateModal() {
    document.getElementById('formModalTitle').textContent = 'Tambah User';
    document.getElementById('userForm').reset();
    document.getElementById('editId').value = '';
    document.getElementById('formPassword').required = true;
    document.getElementById('pwHint').classList.add('hidden');
    document.getElementById('formModal').classList.add('active');
  }

  function openEditModal(u) {
    document.getElementById('formModalTitle').textContent = 'Edit User';
    document.getElementById('editId').value = u.id;
    document.getElementById('formUsername').value = u.username;
    document.getElementById('formRole').value = u.role;
    document.getElementById('formGuru').value = u.guru_id || '';
    
    // For edit, password is not required
    document.getElementById('formPassword').value = '';
    document.getElementById('formPassword').required = false;
    document.getElementById('pwHint').classList.remove('hidden');

    document.getElementById('formModal').classList.add('active');
  }

  function closeFormModal() { document.getElementById('formModal').classList.remove('active'); }

  function openDeleteModal(id, username) {
    deleteId = id;
    document.getElementById('deleteUsername').textContent = username;
    document.getElementById('deleteModal').classList.add('active');
  }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }

  async function submitForm(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    
    const payload = {
      username: document.getElementById('formUsername').value.trim(),
      role: document.getElementById('formRole').value
    };

    const pwd = document.getElementById('formPassword').value;
    if(pwd) payload.password = pwd;

    const guruId = document.getElementById('formGuru').value;
    if(guruId) payload.guru_id = guruId;
    
    const btn = document.getElementById('formSubmitBtn');
    btn.disabled = true; btn.textContent = 'Menyimpan...';

    try {
      const url = id ? `/api/users/${id}` : '/api/users';
      const method = id ? 'PUT' : 'POST';
      const res = await fetch(url, {
        method,
        headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal menyimpan user');
      showToast('success', id ? 'Berhasil Diperbarui' : 'Berhasil Ditambah', `User "${payload.username}" telah disimpan.`);
      closeFormModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Gagal Menyimpan', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Simpan';
    }
  }

  async function confirmDelete() {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true; btn.textContent = 'Menghapus...';
    try {
      const res = await fetch(`/api/users/${deleteId}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }
      });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'User telah dihapus dari sistem.');
      closeDeleteModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Gagal Menghapus', err.message);
    } finally {
      btn.disabled = false;
      btn.textContent = 'Ya, Hapus';
    }
  }

  async function syncGurus() {
    const btn = document.getElementById('syncBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-spin mr-1">⏳</span> Sinkronisasi...';
    
    try {
      const res = await fetch('/api/users/sync-gurus', {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal sinkronisasi');
      
      showToast('success', 'Sinkronisasi Berhasil', data.message);
      fetchData(); // Reload table
    } catch(err) {
      showToast('error', 'Sinkronisasi Gagal', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg> Sync dari Data Guru';
    }
  }

  (async function init() {
    const user = await fetchUserProfile();
    document.getElementById('userName').textContent = user.guru?.nama || user.username;
    document.getElementById('userRoleDisplay').textContent = user.role === 'admin' ? 'Administrator' : 'Guru';
    document.getElementById('userNipDisplay').textContent = `NIP: ${user.guru?.nip || '-'}`;
    document.getElementById('userAvatar').textContent = (user.guru?.nama || user.username).charAt(0).toUpperCase();
    
    // Only Admin can access this page ideally, but if not, let API return 403
    loadGurus();
    fetchData();
  })();
</script>
<?= $this->endSection() ?>
