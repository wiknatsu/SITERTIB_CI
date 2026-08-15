<?= $this->extend('main') ?>
<?= $this->section('title') ?>Data Guru<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card { background-color: var(--surface-base); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 24px; transition: all 0.2s ease; }
  .btn { display: inline-flex; align-items: center; gap: 8px; padding: 10px 16px; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.2s ease; cursor: pointer; border: none; background-color: var(--surface-soft); box-shadow: inset 0 0 0 1px rgba(148, 163, 184, 0.18); }
  .btn-primary { background: linear-gradient(135deg, #F43F5E 0%, #E11D48 100%); color: #fff; box-shadow: 0 10px 24px -12px rgba(225, 29, 72, 0.7); }
  .btn-primary:hover { background: linear-gradient(135deg, #E11D48 0%, #BE123C 100%); transform: translateY(-1px); }
  .btn-secondary { background-color: var(--surface-soft); color: var(--text-strong); border: 1px solid var(--border-subtle); box-shadow: inset 0 1px 0 rgba(255,255,255,0.5); }
  .btn-secondary:hover { background-color: rgba(148, 163, 184, 0.12); }
  .btn-danger { background-color: #DC2626; color: #fff; }
  .btn-danger:hover { background-color: #B91C1C; }
  .btn-sm { padding: 6px 12px; font-size: 13px; border-radius: 8px; }
  .btn-icon { padding: 8px; border-radius: 8px; background: var(--surface-soft); border: 1px solid var(--border-subtle); cursor: pointer; color: var(--text-soft); transition: all 0.2s; }
  .btn-icon:hover { background: rgba(148, 163, 184, 0.12); color: var(--text-strong); }
  .btn-icon.danger:hover { background: rgba(220,38,38,0.1); color: #DC2626; border-color: rgba(220,38,38,0.3); }

  .search-input { background: linear-gradient(180deg, rgba(255,255,255,0.96), var(--surface-soft)); border: 1px solid var(--border-subtle); border-radius: 10px; padding: 10px 16px 10px 40px; font-size: 14px; color: var(--text-strong); width: 280px; transition: all 0.2s; box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04); }
  .search-input:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1), inset 0 1px 2px rgba(15, 23, 42, 0.04); }

  .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
  .data-table thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border-subtle); font-family: 'DM Sans'; }
  .data-table tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--border-subtle); color: var(--text-strong); font-family: 'DM Sans'; vertical-align: middle; }
  .data-table tbody tr { transition: background 0.15s; }
  .data-table tbody tr:hover { background: var(--surface-soft); }
  .data-table tbody tr:last-child td { border-bottom: none; }

  .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; font-family: 'DM Sans'; }
  .badge-blue { background: rgba(37,99,235,0.1); color: #2563EB; }
  .badge-pink { background: rgba(225,29,72,0.1); color: #E11D48; }

  .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 80; display: none; align-items: center; justify-content: center; animation: fadeOverlay 0.2s ease; }
  .modal-overlay.active { display: flex; }
  .modal-box { background: var(--surface-base); border-radius: 20px; padding: 32px; width: 95%; max-width: 520px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: slideUp 0.3s cubic-bezier(0.22,1,0.36,1); }
  @keyframes fadeOverlay { from { opacity: 0; } to { opacity: 1; } }
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
    <h1 class="text-h2">Data Guru</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <div class="flex items-center gap-3 flex-wrap">
    <div class="relative">
      <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="searchInput" class="search-input" placeholder="Cari NIP atau nama...">
    </div>
    <button class="btn btn-secondary btn-sm" onclick="openImportModal()">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
      Import
    </button>
    <button class="btn btn-secondary btn-sm" onclick="exportData()">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      Export
    </button>
    <button class="btn btn-primary" onclick="openCreateModal()">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M12 4v16m8-8H4"/></svg>
      Tambah Guru
    </button>
  </div>
</div>

<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th class="cursor-pointer select-none" data-sort="nip" onclick="window.tableManagers['guruPagination'].setSort('nip')">
            <div class="flex items-center gap-1">NIP <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="nama" onclick="window.tableManagers['guruPagination'].setSort('nama')">
            <div class="flex items-center gap-1">Nama <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="gender" onclick="window.tableManagers['guruPagination'].setSort('gender')">
            <div class="flex items-center gap-1">Gender <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="jabatan" onclick="window.tableManagers['guruPagination'].setSort('jabatan')">
            <div class="flex items-center gap-1">Jabatan <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="no_telp" onclick="window.tableManagers['guruPagination'].setSort('no_telp')">
            <div class="flex items-center gap-1">No. Telp <span class="sort-icon"></span></div>
          </th>
          <th style="width:100px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
      </tbody>
    </table>
  </div>
  <div id="guruPagination" class="mt-4 border-t pt-4" style="border-color: var(--border-subtle);"></div>
</div>

<!-- Form Modal -->
<div class="modal-overlay" id="formModal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3" id="formModalTitle">Tambah Guru</h2>
      <button class="btn-icon" onclick="closeFormModal()"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <form id="guruForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      <div class="form-group">
        <label class="form-label">NIP <span class="text-error">*</span></label>
        <input type="text" id="formNip" class="form-input" placeholder="Masukkan NIP" required>
      </div>
      <div class="form-group">
        <label class="form-label">Nama Lengkap <span class="text-error">*</span></label>
        <input type="text" id="formNama" class="form-input" placeholder="Masukkan nama lengkap" required>
      </div>
      <div class="grid grid-cols-2 gap-4">
        <div class="form-group">
          <label class="form-label">Gender <span class="text-error">*</span></label>
          <select id="formGender" class="form-select" required>
            <option value="">Pilih</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Jabatan</label>
          <input type="text" id="formJabatan" class="form-input" placeholder="cth: Guru">
        </div>
      </div>
      <div class="form-group">
        <label class="form-label">No. Telepon</label>
        <input type="text" id="formTelp" class="form-input" placeholder="cth: 08123456789">
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
      <h3 class="text-h3 mb-2">Hapus Data Guru?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);">Data <strong id="deleteNama"></strong> akan dihapus permanen.</p>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        <button class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">Ya, Hapus</button>
      </div>
    </div>
  </div>
</div>

<!-- Import Modal -->
<div class="modal-overlay" id="importModal">
  <div class="modal-box" style="max-width:460px;">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3">Import Data Guru</h2>
      <button class="btn-icon" onclick="closeImportModal()"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <form id="importForm" onsubmit="submitImport(event)">
      <div class="form-group">
        <label class="form-label">File Excel (.xlsx / .xls)</label>
        <input type="file" id="importFile" accept=".xlsx,.xls" class="form-input" required>
      </div>
      <p class="text-caption mb-4" style="color:var(--text-muted);">Format kolom: NIP, Nama, Gender (L/P), Jabatan, No Telp.</p>
      <div class="flex justify-end gap-3">
        <button type="button" class="btn btn-secondary" onclick="closeImportModal()">Batal</button>
        <button type="submit" class="btn btn-primary" id="importSubmitBtn">Import</button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  let allData = [];
  let deleteId = null;

  window.tableManagers['guruPagination'] = new TableManager('tableBody', 'guruPagination', (g, index) => `
      <tr>
        <td>${index + 1}</td>
        <td><span class="text-mono">${g.nip || '-'}</span></td>
        <td><strong>${g.nama}</strong></td>
        <td><span class="badge ${g.gender==='L'?'badge-blue':'badge-pink'}">${g.gender==='L'?'Laki-laki':'Perempuan'}</span></td>
        <td>${g.jabatan || '-'}</td>
        <td>${g.no_telp || '-'}</td>
        <td>
          <div class="flex items-center gap-2">
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(g).replace(/'/g, "&apos;")})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${g.id}, '${g.nama.replace(/'/g, "\\'")}')">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
  `);

  window.tableManagers['guruPagination'].emptyRenderFn = () => {
    document.getElementById('tableBody').innerHTML = `<tr><td colspan="7"><div class="empty-state">
      <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg></div>
      <h3 class="text-h3 mb-1">Belum Ada Data Guru</h3>
      <p class="text-body" style="color:var(--text-soft);">Tambahkan data guru atau import dari file Excel.</p>
    </div></td></tr>`;
    document.getElementById('subtitleCount').textContent = 'Total: 0 guru';
  };

  async function fetchData() {
    try {
      const q = document.getElementById('searchInput').value.trim();
      let url = '/api/gurus';
      if (q) url += `?search=${encodeURIComponent(q)}`;
      const res = await fetch(url, { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal memuat');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);
      
      document.getElementById('subtitleCount').textContent = `Total: ${allData.length} guru terdaftar`;
      window.tableManagers['guruPagination'].setData(allData);
    } catch (err) {
      console.error(err);
      showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data guru.');
      window.tableManagers['guruPagination'].setData([]);
    }
  }

  let searchTimeout;
  document.getElementById('searchInput').addEventListener('input', () => { clearTimeout(searchTimeout); searchTimeout = setTimeout(fetchData, 400); });

  function openCreateModal() { document.getElementById('formModalTitle').textContent = 'Tambah Guru'; document.getElementById('guruForm').reset(); document.getElementById('editId').value = ''; document.getElementById('formModal').classList.add('active'); }
  function openEditModal(g) {
    document.getElementById('formModalTitle').textContent = 'Edit Guru';
    document.getElementById('editId').value = g.id;
    document.getElementById('formNip').value = g.nip || '';
    document.getElementById('formNama').value = g.nama || '';
    document.getElementById('formGender').value = g.gender || '';
    document.getElementById('formJabatan').value = g.jabatan || '';
    document.getElementById('formTelp').value = g.no_telp || '';
    document.getElementById('formModal').classList.add('active');
  }
  function closeFormModal() { document.getElementById('formModal').classList.remove('active'); }
  function openDeleteModal(id, nama) { deleteId = id; document.getElementById('deleteNama').textContent = nama; document.getElementById('deleteModal').classList.add('active'); }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }
  function openImportModal() { document.getElementById('importModal').classList.add('active'); }
  function closeImportModal() { document.getElementById('importModal').classList.remove('active'); document.getElementById('importForm').reset(); }

  async function submitForm(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const payload = { nip: document.getElementById('formNip').value.trim(), nama: document.getElementById('formNama').value.trim(), gender: document.getElementById('formGender').value, jabatan: document.getElementById('formJabatan').value.trim(), no_telp: document.getElementById('formTelp').value.trim() };
    const btn = document.getElementById('formSubmitBtn');
    btn.disabled = true; btn.textContent = 'Menyimpan...';
    try {
      const res = await fetch(id ? `/api/gurus/${id}` : '/api/gurus', { method: id ? 'PUT' : 'POST', headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` }, body: JSON.stringify(payload) });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal menyimpan');
      showToast('success', id ? 'Berhasil Diperbarui' : 'Berhasil Ditambah', `Data guru "${payload.nama}" telah disimpan.`);
      closeFormModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menyimpan', err.message); }
    finally { btn.disabled = false; btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Simpan'; }
  }

  async function confirmDelete() {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true; btn.textContent = 'Menghapus...';
    try {
      const res = await fetch(`/api/gurus/${deleteId}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'Data guru telah dihapus.');
      closeDeleteModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menghapus', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Ya, Hapus'; }
  }

  async function submitImport(e) {
    e.preventDefault();
    const file = document.getElementById('importFile').files[0];
    if (!file) return;
    const fd = new FormData(); fd.append('file', file);
    const btn = document.getElementById('importSubmitBtn');
    btn.disabled = true; btn.textContent = 'Mengimport...';
    try {
      const res = await fetch('/api/gurus-import', { method: 'POST', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }, body: fd });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal import');
      showToast('success', 'Import Berhasil', data.message || 'Data guru berhasil diimport.');
      closeImportModal(); fetchData();
    } catch (err) { showToast('error', 'Import Gagal', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Import'; }
  }

  async function exportData() {
    showToast('info', 'Export', 'Memproses unduhan...');
    try {
      const res = await fetch('/api/gurus-export', { headers: { 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal mengunduh file');
      const blob = await res.blob();
      const objUrl = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = objUrl;
      link.setAttribute('download', 'Data_Guru.xlsx');
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(objUrl);
    } catch (err) {
      showToast('error', 'Export Gagal', err.message);
    }
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
