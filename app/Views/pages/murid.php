<?= $this->extend('main') ?>
<?= $this->section('title') ?>Data Murid<?= $this->endSection() ?>
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

  .search-input { background: var(--surface-soft); border: 1px solid var(--border-subtle); border-radius: 10px; padding: 10px 16px 10px 40px; font-size: 14px; color: var(--text-strong); width: 280px; transition: all 0.2s; }
  .search-input:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); }

  .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
  .data-table thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border-subtle); font-family: 'DM Sans'; }
  .data-table tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--border-subtle); color: var(--text-strong); font-family: 'DM Sans'; vertical-align: middle; }
  .data-table tbody tr { transition: background 0.15s; }
  .data-table tbody tr:hover { background: var(--surface-soft); }
  .data-table tbody tr:last-child td { border-bottom: none; }

  .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; font-family: 'DM Sans'; }
  .badge-blue { background: rgba(37,99,235,0.1); color: #2563EB; }
  .badge-pink { background: rgba(225,29,72,0.1); color: #E11D48; }

  /* Modal */
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
<!-- Page Header -->
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-h2">Data Murid</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <div class="flex items-center gap-3 flex-wrap">
    <div class="relative">
      <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="searchInput" class="search-input" placeholder="Cari NIS atau nama...">
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
      Tambah Murid
    </button>
  </div>
</div>

<!-- Table Card -->
<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table" id="dataTable">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th class="cursor-pointer select-none" data-sort="nis" onclick="window.tableManagers['muridPagination'].setSort('nis')">
            <div class="flex items-center gap-1">NIS <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="nisn" onclick="window.tableManagers['muridPagination'].setSort('nisn')">
            <div class="flex items-center gap-1">NISN <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="nama" onclick="window.tableManagers['muridPagination'].setSort('nama')">
            <div class="flex items-center gap-1">Nama <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="gender" onclick="window.tableManagers['muridPagination'].setSort('gender')">
            <div class="flex items-center gap-1">Gender <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="kelas" onclick="window.tableManagers['muridPagination'].setSort('kelas')">
            <div class="flex items-center gap-1">Kelas <span class="sort-icon"></span></div>
          </th>
          <th style="width:100px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <!-- Loading skeleton -->
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
      </tbody>
    </table>
  </div>
  <div id="muridPagination" class="mt-4 border-t pt-4" style="border-color: var(--border-subtle);"></div>
</div>

<!-- Create/Edit Modal -->
<div class="modal-overlay" id="formModal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3" id="formModalTitle">Tambah Murid</h2>
      <button class="btn-icon" onclick="closeFormModal()">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <form id="muridForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      <div class="form-group">
        <label class="form-label">NIS <span class="text-error">*</span></label>
        <input type="text" id="formNis" class="form-input" placeholder="Masukkan NIS" required>
      </div>
      <div class="form-group">
        <label class="form-label">NISN</label>
        <input type="text" id="formNisn" class="form-input" placeholder="Masukkan NISN">
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
          <label class="form-label">Kelas <span class="text-error">*</span></label>
          <input type="text" id="formKelas" class="form-input" placeholder="cth: 10 IPA 1" required>
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

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-box" style="max-width:420px;">
    <div class="text-center">
      <div class="w-16 h-16 rounded-full bg-error/10 grid place-items-center mx-auto mb-4">
        <svg class="w-8 h-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Hapus Data Murid?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);">Data <strong id="deleteNama"></strong> akan dihapus permanen dan tidak dapat dikembalikan.</p>
      <div class="flex gap-3 justify-center">
        <button class="btn btn-secondary" onclick="closeDeleteModal()">Batal</button>
        <button class="btn btn-danger" id="confirmDeleteBtn" onclick="confirmDelete()">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
          Ya, Hapus
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Import Modal -->
<div class="modal-overlay" id="importModal">
  <div class="modal-box" style="max-width:460px;">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3">Import Data Murid</h2>
      <button class="btn-icon" onclick="closeImportModal()">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <form id="importForm" onsubmit="submitImport(event)">
      <div class="form-group">
        <label class="form-label">File Excel (.xlsx / .xls)</label>
        <input type="file" id="importFile" accept=".xlsx,.xls" class="form-input" required>
      </div>
      <p class="text-caption mb-4" style="color:var(--text-muted);">Pastikan format kolom sesuai template: NIS, NISN, Nama, Gender (L/P), Kelas.</p>
      <div class="flex justify-end gap-3">
        <button type="button" class="btn btn-secondary" onclick="closeImportModal()">Batal</button>
        <button type="submit" class="btn btn-primary" id="importSubmitBtn">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
          Import
        </button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  let allData = [];
  let deleteId = null;

  // ============= FETCH DATA =============
  window.tableManagers['muridPagination'] = new TableManager('tableBody', 'muridPagination', (m, index) => `
      <tr>
        <td>${index + 1}</td>
        <td><span class="text-mono">${m.nis || '-'}</span></td>
        <td><span class="text-mono">${m.nisn || '-'}</span></td>
        <td><strong>${m.nama}</strong></td>
        <td><span class="badge ${m.gender === 'L' ? 'badge-blue' : 'badge-pink'}">${m.gender === 'L' ? 'Laki-laki' : 'Perempuan'}</span></td>
        <td>${m.kelas || '-'}</td>
        <td>
          <div class="flex items-center gap-2">
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(m).replace(/'/g, "&apos;")})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${m.id}, '${m.nama.replace(/'/g, "\\'")}')">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
  `);
  
  window.tableManagers['muridPagination'].emptyRenderFn = () => {
    document.getElementById('tableBody').innerHTML = `
      <tr><td colspan="7">
        <div class="empty-state">
          <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg></div>
          <h3 class="text-h3 mb-1">Belum Ada Data Murid</h3>
          <p class="text-body" style="color:var(--text-soft);">Mulai tambahkan data murid atau import dari file Excel.</p>
        </div>
      </td></tr>`;
    document.getElementById('subtitleCount').textContent = 'Total: 0 murid';
  };

  async function fetchData() {
    try {
      const searchVal = document.getElementById('searchInput').value.trim();
      let url = '/api/murids';
      if (searchVal) url += `?nama=${encodeURIComponent(searchVal)}`;

      const res = await fetch(url, {
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }
      });
      if (!res.ok) throw new Error('Gagal memuat data');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);
      
      document.getElementById('subtitleCount').textContent = `Total: ${allData.length} murid terdaftar`;
      window.tableManagers['muridPagination'].setData(allData);
    } catch (err) {
      console.error(err);
      showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data murid.');
      window.tableManagers['muridPagination'].setData([]);
    }
  }

  // ============= SEARCH =============
  let searchTimeout;
  document.getElementById('searchInput').addEventListener('input', () => {
    clearTimeout(searchTimeout);
    searchTimeout = setTimeout(fetchData, 400);
  });

  // ============= MODAL LOGIC =============
  function openCreateModal() {
    document.getElementById('formModalTitle').textContent = 'Tambah Murid';
    document.getElementById('muridForm').reset();
    document.getElementById('editId').value = '';
    document.getElementById('formModal').classList.add('active');
  }

  function openEditModal(m) {
    document.getElementById('formModalTitle').textContent = 'Edit Murid';
    document.getElementById('editId').value = m.id;
    document.getElementById('formNis').value = m.nis || '';
    document.getElementById('formNisn').value = m.nisn || '';
    document.getElementById('formNama').value = m.nama || '';
    document.getElementById('formGender').value = m.gender || '';
    document.getElementById('formKelas').value = m.kelas || '';
    document.getElementById('formModal').classList.add('active');
  }

  function closeFormModal() { document.getElementById('formModal').classList.remove('active'); }

  function openDeleteModal(id, nama) {
    deleteId = id;
    document.getElementById('deleteNama').textContent = nama;
    document.getElementById('deleteModal').classList.add('active');
  }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }

  function openImportModal() { document.getElementById('importModal').classList.add('active'); }
  function closeImportModal() { document.getElementById('importModal').classList.remove('active'); document.getElementById('importForm').reset(); }

  // ============= CRUD =============
  async function submitForm(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const payload = {
      nis: document.getElementById('formNis').value.trim(),
      nisn: document.getElementById('formNisn').value.trim(),
      nama: document.getElementById('formNama').value.trim(),
      gender: document.getElementById('formGender').value,
      kelas: document.getElementById('formKelas').value.trim(),
    };
    const btn = document.getElementById('formSubmitBtn');
    btn.disabled = true; btn.innerHTML = '<span class="animate-spin">⏳</span> Menyimpan...';

    try {
      const url = id ? `/api/murids/${id}` : '/api/murids';
      const method = id ? 'PUT' : 'POST';
      const res = await fetch(url, {
        method,
        headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal menyimpan');
      showToast('success', id ? 'Berhasil Diperbarui' : 'Berhasil Ditambah', `Data murid "${payload.nama}" telah disimpan.`);
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
      const res = await fetch(`/api/murids/${deleteId}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }
      });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'Data murid telah dihapus.');
      closeDeleteModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Gagal Menghapus', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Ya, Hapus';
    }
  }

  // ============= IMPORT / EXPORT =============
  async function submitImport(e) {
    e.preventDefault();
    const file = document.getElementById('importFile').files[0];
    if (!file) return;
    const fd = new FormData();
    fd.append('file', file);
    const btn = document.getElementById('importSubmitBtn');
    btn.disabled = true; btn.textContent = 'Mengimport...';
    try {
      const res = await fetch('/api/murids-import', {
        method: 'POST',
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` },
        body: fd
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal import');
      showToast('success', 'Import Berhasil', data.message || 'Data murid berhasil diimport.');
      closeImportModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Import Gagal', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg> Import';
    }
  }

  async function exportData() {
    showToast('info', 'Export', 'Memproses unduhan...');
    try {
      const res = await fetch('/api/murids-export', { headers: { 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal mengunduh file');
      const blob = await res.blob();
      const objUrl = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = objUrl;
      link.setAttribute('download', 'Data_Murid.xlsx');
      document.body.appendChild(link);
      link.click();
      link.remove();
      window.URL.revokeObjectURL(objUrl);
    } catch (err) {
      showToast('error', 'Export Gagal', err.message);
    }
  }

  // ============= INIT =============
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
