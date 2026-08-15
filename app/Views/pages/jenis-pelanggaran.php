<?= $this->extend('main') ?>
<?= $this->section('title') ?>Jenis Pelanggaran<?= $this->endSection() ?>
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

  .search-input { background: linear-gradient(180deg, rgba(255,255,255,0.96), var(--surface-soft)); border: 1px solid var(--border-subtle); border-radius: 10px; padding: 10px 16px 10px 40px; font-size: 14px; color: var(--text-strong); width: 260px; transition: all 0.2s; box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04); }
  .search-input:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1), inset 0 1px 2px rgba(15, 23, 42, 0.04); }

  .filter-select { background: linear-gradient(180deg, rgba(255,255,255,0.96), var(--surface-soft)); border: 1px solid var(--border-subtle); border-radius: 10px; padding: 10px 14px; font-size: 14px; color: var(--text-strong); transition: all 0.2s; font-family: 'DM Sans'; box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04); }
  .filter-select:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1), inset 0 1px 2px rgba(15, 23, 42, 0.04); }

  .data-table { width: 100%; border-collapse: separate; border-spacing: 0; }
  .data-table thead th { text-align: left; padding: 12px 16px; font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); border-bottom: 1px solid var(--border-subtle); font-family: 'DM Sans'; }
  .data-table tbody td { padding: 14px 16px; font-size: 14px; border-bottom: 1px solid var(--border-subtle); color: var(--text-strong); font-family: 'DM Sans'; vertical-align: middle; }
  .data-table tbody tr { transition: background 0.15s; }
  .data-table tbody tr:hover { background: var(--surface-soft); }
  .data-table tbody tr:last-child td { border-bottom: none; }

  .badge { display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; font-family: 'DM Sans'; }
  .badge-green { background: rgba(22,163,74,0.1); color: #16A34A; }
  .badge-yellow { background: rgba(217,119,6,0.1); color: #D97706; }
  .badge-red { background: rgba(220,38,38,0.1); color: #DC2626; }

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
    <h1 class="text-h2">Jenis Pelanggaran</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <div class="flex items-center gap-3 flex-wrap">
    <div class="relative">
      <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path stroke-linecap="round" d="M21 21l-4.35-4.35"/></svg>
      <input type="text" id="searchInput" class="search-input" placeholder="Cari kode atau nama...">
    </div>
    <select id="filterKategori" class="filter-select" onchange="applyFilter()">
      <option value="">Semua Kategori</option>
      <option value="Sikap Prilaku">Sikap Prilaku</option>
      <option value="Kerapian">Kerapian</option>
      <option value="Kehadiran/Ketaatan/Pembiasaan">Kehadiran/Ketaatan/Pembiasaan</option>
    </select>
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
      Tambah
    </button>
  </div>
</div>

<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table">
      <thead>
        <tr>
          <th style="width:50px;">No</th>
          <th class="cursor-pointer select-none" data-sort="kode_pelanggaran" onclick="window.tableManagers['jpPagination'].setSort('kode_pelanggaran')">
            <div class="flex items-center gap-1">Kode <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="nama_pelanggaran" onclick="window.tableManagers['jpPagination'].setSort('nama_pelanggaran')">
            <div class="flex items-center gap-1">Nama Pelanggaran <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="kategori_pelanggaran" onclick="window.tableManagers['jpPagination'].setSort('kategori_pelanggaran')">
            <div class="flex items-center gap-1">Kategori <span class="sort-icon"></span></div>
          </th>
          <th style="width:100px;">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="5"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="5"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="5"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
      </tbody>
    </table>
  </div>
  <div id="jpPagination" class="mt-4 border-t pt-4" style="border-color: var(--border-subtle);"></div>
</div>

<!-- Form Modal -->
<div class="modal-overlay" id="formModal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3" id="formModalTitle">Tambah Pelanggaran</h2>
      <button class="btn-icon" onclick="closeFormModal()"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <form id="pelanggaranForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      <div class="form-group">
        <label class="form-label">Kode Pelanggaran <span class="text-error">*</span></label>
        <input type="text" id="formKode" class="form-input" placeholder="cth: P001" required>
      </div>
      <div class="form-group">
        <label class="form-label">Nama Pelanggaran <span class="text-error">*</span></label>
        <input type="text" id="formNama" class="form-input" placeholder="Masukkan nama pelanggaran" required>
      </div>
      <div class="form-group">
        <label class="form-label">Kategori <span class="text-error">*</span></label>
        <select id="formKategori" class="form-select" required onchange="handleKategoriChange()">
          <option value="">Pilih Kategori</option>
          <option value="Sikap Prilaku">Sikap Prilaku</option>
          <option value="Kerapian">Kerapian</option>
          <option value="Kehadiran/Ketaatan/Pembiasaan">Kehadiran/Ketaatan/Pembiasaan</option>
          <option value="Lainnya">Lainnya...</option>
        </select>
        <input type="text" id="formKategoriLainnya" class="form-input mt-2" placeholder="Masukkan kategori lainnya" style="display: none;">
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
      <h3 class="text-h3 mb-2">Hapus Jenis Pelanggaran?</h3>
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
      <h2 class="text-h3">Import Data Pelanggaran</h2>
      <button class="btn-icon" onclick="closeImportModal()"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg></button>
    </div>
    <form id="importForm" onsubmit="submitImport(event)">
      <div class="form-group">
        <label class="form-label">File Excel (.xlsx / .xls)</label>
        <input type="file" id="importFile" accept=".xlsx,.xls" class="form-input" required>
      </div>
      <p class="text-caption mb-4" style="color:var(--text-muted);">Format: Kode, Nama Pelanggaran, Kategori (Sikap Prilaku/Kerapian/Kehadiran/Ketaatan/Pembiasaan, dll).</p>
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

  async function fetchData() {
    try {
      const res = await fetch('/api/pelanggarans', { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal memuat');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);
      applyFilter();
    } catch (err) { console.error(err); showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data.'); window.tableManagers['jpPagination'].emptyRenderFn(); }
  }

  window.tableManagers['jpPagination'] = new TableManager('tableBody', 'jpPagination', (p, index) => `
      <tr>
        <td>${index + 1}</td>
        <td><span class="text-mono">${p.kode_pelanggaran || '-'}</span></td>
        <td><strong>${p.nama_pelanggaran}</strong></td>
        <td>${getKategoriBadge(p.kategori_pelanggaran)}</td>
        <td>
          <div class="flex items-center gap-2">
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(p).replace(/'/g, "&apos;")})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${p.id}, '${p.nama_pelanggaran.replace(/'/g, "\\'")}')">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>
      </tr>
  `);

  window.tableManagers['jpPagination'].emptyRenderFn = () => {
    document.getElementById('tableBody').innerHTML = `<tr><td colspan="5"><div class="empty-state">
      <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg></div>
      <h3 class="text-h3 mb-1">Belum Ada Data</h3>
      <p class="text-body" style="color:var(--text-soft);">Tambahkan jenis pelanggaran atau import dari file Excel.</p>
    </div></td></tr>`;
  };

  function applyFilter() {
    const q = document.getElementById('searchInput').value.trim().toLowerCase();
    const kat = document.getElementById('filterKategori').value;
    let filtered = allData;
    if (q) filtered = filtered.filter(p => (p.kode_pelanggaran||'').toLowerCase().includes(q) || (p.nama_pelanggaran||'').toLowerCase().includes(q));
    if (kat) filtered = filtered.filter(p => p.kategori_pelanggaran === kat);
    
    document.getElementById('subtitleCount').textContent = `Menampilkan ${filtered.length} dari ${allData.length} data`;
    window.tableManagers['jpPagination'].setData(filtered);
  }

  function getKategoriBadge(k) {
    const map = { 'Sikap Prilaku': 'badge-green', 'Kerapian': 'badge-yellow', 'Kehadiran/Ketaatan/Pembiasaan': 'badge-red' };
    return `<span class="badge ${map[k] || 'badge-green'}">${k || '-'}</span>`;
  }

  let searchTimeout;
  document.getElementById('searchInput').addEventListener('input', () => { clearTimeout(searchTimeout); searchTimeout = setTimeout(applyFilter, 300); });

  function handleKategoriChange() {
    const select = document.getElementById('formKategori');
    const input = document.getElementById('formKategoriLainnya');
    if (select.value === 'Lainnya') {
      input.style.display = 'block';
      input.required = true;
    } else {
      input.style.display = 'none';
      input.required = false;
    }
  }

  function openCreateModal() { 
    document.getElementById('formModalTitle').textContent = 'Tambah Pelanggaran'; 
    document.getElementById('pelanggaranForm').reset(); 
    document.getElementById('editId').value = ''; 
    const inputLain = document.getElementById('formKategoriLainnya');
    inputLain.style.display = 'none';
    inputLain.required = false;
    document.getElementById('formModal').classList.add('active'); 
  }
  function openEditModal(p) {
    document.getElementById('formModalTitle').textContent = 'Edit Pelanggaran';
    document.getElementById('editId').value = p.id;
    document.getElementById('formKode').value = p.kode_pelanggaran || '';
    document.getElementById('formNama').value = p.nama_pelanggaran || '';
    
    const selectKat = document.getElementById('formKategori');
    const inputKat = document.getElementById('formKategoriLainnya');
    const options = Array.from(selectKat.options).map(o => o.value);
    if (p.kategori_pelanggaran && !options.includes(p.kategori_pelanggaran) && p.kategori_pelanggaran !== 'Lainnya') {
      selectKat.value = 'Lainnya';
      inputKat.value = p.kategori_pelanggaran;
      inputKat.style.display = 'block';
      inputKat.required = true;
    } else {
      selectKat.value = p.kategori_pelanggaran || '';
      inputKat.value = '';
      inputKat.style.display = 'none';
      inputKat.required = false;
    }
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
    const kategoriVal = document.getElementById('formKategori').value;
    const finalKategori = kategoriVal === 'Lainnya' ? document.getElementById('formKategoriLainnya').value.trim() : kategoriVal;
    const payload = { kode_pelanggaran: document.getElementById('formKode').value.trim(), nama_pelanggaran: document.getElementById('formNama').value.trim(), kategori_pelanggaran: finalKategori };
    const btn = document.getElementById('formSubmitBtn'); btn.disabled = true; btn.textContent = 'Menyimpan...';
    try {
      const res = await fetch(id ? `/api/pelanggarans/${id}` : '/api/pelanggarans', { method: id ? 'PUT' : 'POST', headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` }, body: JSON.stringify(payload) });
      const data = await res.json(); if (!res.ok) throw new Error(data.message || 'Gagal menyimpan');
      showToast('success', id ? 'Berhasil Diperbarui' : 'Berhasil Ditambah', `Data "${payload.nama_pelanggaran}" telah disimpan.`);
      closeFormModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menyimpan', err.message); }
    finally { btn.disabled = false; btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Simpan'; }
  }

  async function confirmDelete() {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDeleteBtn'); btn.disabled = true; btn.textContent = 'Menghapus...';
    try {
      const res = await fetch(`/api/pelanggarans/${deleteId}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'Jenis pelanggaran telah dihapus.'); closeDeleteModal(); fetchData();
    } catch (err) { showToast('error', 'Gagal Menghapus', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Ya, Hapus'; }
  }

  async function submitImport(e) {
    e.preventDefault();
    const file = document.getElementById('importFile').files[0]; if (!file) return;
    const fd = new FormData(); fd.append('file', file);
    const btn = document.getElementById('importSubmitBtn'); btn.disabled = true; btn.textContent = 'Mengimport...';
    try {
      const res = await fetch('/api/pelanggarans-import', { method: 'POST', headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }, body: fd });
      const data = await res.json(); if (!res.ok) throw new Error(data.message || 'Gagal import');
      showToast('success', 'Import Berhasil', data.message || 'Data berhasil diimport.'); closeImportModal(); fetchData();
    } catch (err) { showToast('error', 'Import Gagal', err.message); }
    finally { btn.disabled = false; btn.textContent = 'Import'; }
  }

  async function exportData() {
    showToast('info', 'Export', 'Memproses unduhan...');
    try {
      const res = await fetch('/api/pelanggarans-export', { headers: { 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal mengunduh file');
      const blob = await res.blob();
      const objUrl = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = objUrl;
      link.setAttribute('download', 'Jenis_Pelanggaran.xlsx');
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
