<?= $this->extend('main') ?>
<?= $this->section('title') ?>Tahun Ajaran<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card { background-color: var(--surface-base); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 24px; transition: all 0.2s ease; }
  .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.2s ease; cursor: pointer; border: none; }
  .btn-primary { background-color: #E11D48; color: #fff; box-shadow: 0 8px 20px -8px rgba(225, 29, 72, 0.5); }
  .btn-primary:hover { background-color: #BE123C; transform: translateY(-1px); }
  .btn-secondary { background-color: var(--surface-soft); color: var(--text-strong); border: 1px solid var(--border-subtle); }
  .btn-secondary:hover { background-color: var(--border-subtle); }
  .btn-success { background-color: #16A34A; color: #fff; }
  .btn-success:hover { background-color: #15803D; }
  .btn-danger { background-color: #DC2626; color: #fff; }
  .btn-danger:hover { background-color: #B91C1C; }
  .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 8px; }
  .btn-icon { padding: 8px; border-radius: 8px; background: transparent; border: 1px solid var(--border-subtle); cursor: pointer; color: var(--text-soft); transition: all 0.2s; }
  .btn-icon:hover { background: var(--surface-soft); color: var(--text-strong); }
  .btn-icon.danger:hover { background: rgba(220,38,38,0.1); color: #DC2626; border-color: rgba(220,38,38,0.3); }
  .btn-icon.success:hover { background: rgba(22,163,74,0.1); color: #16A34A; border-color: rgba(22,163,74,0.3); }

  .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
  .data-table thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border-subtle); font-family: 'DM Sans'; }
  .data-table tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--border-subtle); color: var(--text-strong); font-family: 'DM Sans'; vertical-align: middle; }
  .data-table tbody tr { transition: background 0.15s; }
  .data-table tbody tr:hover { background: var(--surface-soft); }
  .data-table tbody tr:last-child td { border-bottom: none; }

  .badge { display: inline-flex; align-items: center; gap: 6px; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; font-family: 'DM Sans'; }
  .badge-active { background: rgba(22,163,74,0.1); color: #16A34A; }
  .badge-inactive { background: var(--surface-soft); color: var(--text-muted); }
  .badge-active::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: #16A34A; animation: pulse 2s infinite; }
  @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.5; } }

  .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 80; display: none; align-items: center; justify-content: center; }
  .modal-overlay.active { display: flex; }
  .modal-box { background: var(--surface-base); border-radius: 20px; padding: 32px; width: 95%; max-width: 480px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: slideUp 0.3s cubic-bezier(0.22,1,0.36,1); }
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
    <h1 class="text-h2">Tahun Ajaran</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <button class="btn btn-primary" onclick="openCreateModal()">
    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
    Tambah Tahun Ajaran
  </button>
</div>

<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th>Tahun Ajaran</th>
          <th>Semester</th>
          <th>Status</th>
          <th style="width:160px;">Aksi</th>
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
      <h2 class="text-h3" id="formModalTitle">Tambah Tahun Ajaran</h2>
      <button class="btn-icon" onclick="closeFormModal()"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <form id="taForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      <div class="form-group">
        <label class="form-label">Nama Tahun Ajaran <span class="text-error">*</span></label>
        <input type="text" id="formNama" class="form-input" placeholder="cth: 2024/2025" required>
      </div>
      <div class="form-group">
        <label class="form-label">Semester <span class="text-error">*</span></label>
        <select id="formSemester" class="form-select" required>
          <option value="">Pilih Semester</option>
          <option value="ganjil">Ganjil</option>
          <option value="genap">Genap</option>
        </select>
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
      <h3 class="text-h3 mb-2">Hapus Tahun Ajaran?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);">Data <strong id="deleteNama"></strong> akan dihapus permanen.</p>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        <button class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Set Active Modal -->
<div class="modal-overlay" id="activeModal">
  <div class="modal-box" style="max-width:420px;">
    <div class="text-center">
      <div class="w-16 h-16 rounded-full bg-success/10 grid place-items-center mx-auto mb-4">
        <svg class="w-8 h-8 text-success" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Aktifkan Tahun Ajaran?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);"><strong id="activeNama"></strong> akan dijadikan tahun ajaran aktif. Tahun ajaran lain akan menjadi tidak aktif.</p>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" onclick="closeActiveModal()">Batal</button>
        <button class="btn btn-success" id="confirmActiveBtn" onclick="confirmSetActive()">Ya, Aktifkan</button>
      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  let allData = [];
  let deleteId = null;
  let activeId = null;

  async function fetchData() {
    try {
      const res = await fetch('/api/tahun-ajarans', { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal memuat');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);
      renderTable(allData);
      document.getElementById('subtitleCount').textContent = `Total: ${allData.length} tahun ajaran`;
    } catch (err) { console.error(err); showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data.'); renderEmpty(); }
  }

  function renderTable(data) {
    const tbody = document.getElementById('tableBody');
    if (!data.length) { renderEmpty(); return; }
    tbody.innerHTML = data.map((t, i) => `
      <tr>
        <td>${i+1}</td>
        <td><strong>${t.nama}</strong></td>
        <td>${t.semester}</td>
        <td>${t.is_active ? '<span class="badge badge-active">Aktif</span>' : '<span class="badge badge-inactive">Tidak Aktif</span>'}</td>
        <td>
          <div class="flex items-center gap-2">
            ${!t.is_active ? `<button class="btn-icon success" title="Set Aktif" onclick="openActiveModal(${t.id}, '${t.nama} - ${t.semester}')"><svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></button>` : ''}
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(t)})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${t.id}, '${t.nama} - ${t.semester}')">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
    `).join('');
  }

  function renderEmpty() {
    document.getElementById('tableBody').innerHTML = `<tr><td colspan="5"><div class="empty-state">
      <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg></div>
      <h3 class="text-h3 mb-1">Belum Ada Tahun Ajaran</h3>
      <p class="text-body" style="color:var(--text-soft);">Tambahkan tahun ajaran untuk memulai sistem pencatatan.</p>
    </div></td></tr>`;
    document.getElementById('subtitleCount').textContent = 'Total: 0 tahun ajaran';
  }

  function openCreateModal() { document.getElementById('formModalTitle').textContent = 'Tambah Tahun Ajaran'; document.getElementById('taForm').reset(); document.getElementById('editId').value = ''; document.getElementById('formModal').classList.add('active'); }
  function openEditModal(t) { document.getElementById('formModalTitle').textContent = 'Edit Tahun Ajaran'; document.getElementById('editId').value = t.id; document.getElementById('formNama').value = t.nama || ''; document.getElementById('formSemester').value = t.semester || ''; document.getElementById('formModal').classList.add('active'); }
  function closeFormModal() { document.getElementById('formModal').classList.remove('active'); }
  function openDeleteModal(id, nama) { deleteId = id; document.getElementById('deleteNama').textContent = nama; document.getElementById('deleteModal').classList.add('active'); }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }
  function openActiveModal(id, nama) { activeId = id; document.getElementById('activeNama').textContent = nama; document.getElementById('activeModal').classList.add('active'); }
  function closeActiveModal() { document.getElementById('activeModal').classList.remove('active'); activeId = null; }

  async function submitForm(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const payload = { nama: document.getElementById('formNama').value.trim(), semester: document.getElementById('formSemester').value };
    const btn = document.getElementById('formSubmitBtn'); btn.disabled = true; btn.textContent = 'Menyimpan...';
    try {
      const res = await fetch(id ? `/api/tahun-ajarans/${id}` : '/api/tahun-ajarans', { method: id ? 'PUT' : 'POST', headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` }, body: JSON.stringify(payload) });
      const data = await res.json(); if (!res.ok) throw new Error(data.message || 'Gagal menyimpan');
      showToast('success', id ? 'Berhasil Diperbarui' : 'Berhasil Ditambah', `Tahun ajaran "${payload.nama}" telah disimpan.`);
      closeFormModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menyimpan', err.message); }
    finally { btn.disabled = false; btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Simpan'; }
  }

  async function confirmDelete() {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDeleteBtn'); btn.disabled = true; btn.textContent = 'Menghapus...';
    try {
      const res = await fetch(`/api/tahun-ajarans/${deleteId}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'Tahun ajaran telah dihapus.'); closeDeleteModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menghapus', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Ya, Hapus'; }
  }

  async function confirmSetActive() {
    if (!activeId) return;
    const btn = document.getElementById('confirmActiveBtn'); btn.disabled = true; btn.textContent = 'Mengaktifkan...';
    try {
      const res = await fetch(`/api/tahun-ajarans/${activeId}/set-active`, { method: 'PUT', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal mengaktifkan'); }
      showToast('success', 'Berhasil', 'Tahun ajaran berhasil diaktifkan.'); closeActiveModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Ya, Aktifkan'; }
  }

  (async function init() {
    const user = await fetchUserProfile();
    document.getElementById('userName').textContent = user.guru?.nama || user.username;
    document.getElementById('userRoleDisplay').textContent = user.role === 'admin' ? 'Administrator' : 'Guru';
    document.getElementById('userNipDisplay').textContent = `NIP: ${user.guru?.nip || '-'}`;
    document.getElementById('userAvatar').textContent = (user.guru?.nama || user.username).charAt(0).toUpperCase();
    fetchData();
  })();
</script>
<?= $this->endSection() ?>
