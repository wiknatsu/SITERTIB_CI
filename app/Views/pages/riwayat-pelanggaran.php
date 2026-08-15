<?= $this->extend('main') ?>
<?= $this->section('title') ?>Riwayat Pelanggaran<?= $this->endSection() ?>
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

  /* Modal */
  .modal-overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 80; display: none; align-items: center; justify-content: center; }
  .modal-overlay.active { display: flex; }
  .modal-box { background: var(--surface-base); border-radius: 20px; padding: 32px; width: 95%; max-width: 520px; max-height: 90vh; overflow-y: auto; box-shadow: 0 25px 60px -15px rgba(0,0,0,0.3); animation: slideUp 0.3s cubic-bezier(0.22,1,0.36,1); }
  @keyframes slideUp { from { opacity: 0; transform: translateY(20px) scale(0.97); } to { opacity: 1; transform: translateY(0) scale(1); } }

  .form-group { margin-bottom: 20px; }
  .form-label { display: block; font-size: 13px; font-weight: 600; color: var(--text-soft); margin-bottom: 6px; font-family: 'DM Sans'; }
  .form-input, .form-select, .form-textarea { width: 100%; padding: 10px 14px; border: 1px solid var(--border-subtle); border-radius: 10px; font-size: 14px; color: var(--text-strong); background: var(--surface-soft); transition: all 0.2s; font-family: 'DM Sans'; }
  .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); }

  .skeleton { background: linear-gradient(90deg, var(--surface-soft) 25%, var(--border-subtle) 50%, var(--surface-soft) 75%); background-size: 200% 100%; animation: shimmer 1.5s infinite; border-radius: 6px; }
  @keyframes shimmer { 0% { background-position: 200% 0; } 100% { background-position: -200% 0; } }

  .empty-state { text-align: center; padding: 60px 24px; }
  .empty-icon { width: 64px; height: 64px; margin: 0 auto 16px; border-radius: 50%; display: grid; place-items: center; background: var(--surface-soft); }
</style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-6">
  <div>
    <h1 class="text-h2">Riwayat Pelanggaran</h1>
    <p class="text-caption" style="color: var(--text-soft);" id="subtitleCount">Memuat data...</p>
  </div>
  <div class="flex items-center gap-3 flex-wrap">
    <input type="date" id="filterTglMulai" class="filter-select text-caption" placeholder="Mulai">
    <span class="text-muted text-sm">s/d</span>
    <input type="date" id="filterTglSelesai" class="filter-select text-caption" placeholder="Selesai">
    <select id="filterKelas" class="filter-select text-caption">
      <option value="">Semua Kelas</option>
    </select>
    <input type="search" id="searchInput" class="search-input" placeholder="Cari siswa, pelanggaran, pelapor...">
    
    <button class="btn btn-primary btn-sm h-10" onclick="applyFilter()">Terapkan Filter</button>
    
    <button class="btn btn-secondary btn-sm h-10" onclick="exportData()">
      <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
      Export Excel
    </button>
  </div>
</div>

<div class="card">
  <div class="overflow-x-auto">
    <table class="data-table">
      <thead>
        <tr>
          <th class="cursor-pointer select-none" data-sort="tanggal_pelanggaran" onclick="window.tableManagers['rwPagination'].setSort('tanggal_pelanggaran')">
            <div class="flex items-center gap-1">Tanggal <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="murid_nama" onclick="window.tableManagers['rwPagination'].setSort('murid_nama')">
            <div class="flex items-center gap-1">Siswa <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="murid_kelas" onclick="window.tableManagers['rwPagination'].setSort('murid_kelas')">
            <div class="flex items-center gap-1">Kelas <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="pelanggaran_nama" onclick="window.tableManagers['rwPagination'].setSort('pelanggaran_nama')">
            <div class="flex items-center gap-1">Pelanggaran <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="pelanggaran_kategori" onclick="window.tableManagers['rwPagination'].setSort('pelanggaran_kategori')">
            <div class="flex items-center gap-1">Kategori <span class="sort-icon"></span></div>
          </th>
          <th class="cursor-pointer select-none" data-sort="pelapor" onclick="window.tableManagers['rwPagination'].setSort('pelapor')">
            <div class="flex items-center gap-1">Pelapor <span class="sort-icon"></span></div>
          </th>
          <th style="width:100px;" class="admin-only hidden">Aksi</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
        <tr><td colspan="7"><div class="skeleton" style="height:20px;width:100%;margin:8px 0;"></div></td></tr>
      </tbody>
    </table>
  </div>
  <div id="rwPagination" class="mt-4 border-t pt-4" style="border-color: var(--border-subtle);"></div>
</div>

<!-- Edit Modal (Admin Only) -->
<div class="modal-overlay" id="formModal">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-6">
      <h2 class="text-h3">Edit Pelanggaran</h2>
      <button class="btn-icon" onclick="closeFormModal()">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <form id="editForm" onsubmit="submitForm(event)">
      <input type="hidden" id="editId">
      
      <div class="form-group">
        <label class="form-label">Siswa Pelanggar</label>
        <select id="formMurid" class="form-select" required></select>
      </div>

      <div class="form-group">
        <label class="form-label">Jenis Pelanggaran</label>
        <select id="formPelanggaran" class="form-select" required></select>
      </div>

      <div class="form-group">
        <label class="form-label">Tanggal Kejadian</label>
        <input type="date" id="formTanggal" class="form-input" required>
      </div>

      <div class="form-group">
        <label class="form-label">Keterangan</label>
        <textarea id="formKeterangan" class="form-textarea" rows="3"></textarea>
      </div>

      <div class="flex justify-end gap-3 mt-6">
        <button type="button" class="btn btn-secondary" onclick="closeFormModal()">Batal</button>
        <button type="submit" class="btn btn-primary" id="formSubmitBtn">
          <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg>
          Simpan Perubahan
        </button>
      </div>
    </form>
  </div>
</div>

<!-- Delete Confirmation Modal (Admin Only) -->
<div class="modal-overlay" id="deleteModal">
  <div class="modal-box" style="max-width:420px;">
    <div class="text-center">
      <div class="w-16 h-16 rounded-full bg-error/10 grid place-items-center mx-auto mb-4">
        <svg class="w-8 h-8 text-error" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
      </div>
      <h3 class="text-h3 mb-2">Hapus Catatan Pelanggaran?</h3>
      <p class="text-body mb-6" style="color:var(--text-soft);">Tindakan ini tidak dapat dibatalkan.</p>
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
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  let isAdmin = false;
  let allData = [];
  let deleteId = null;

  // Options for dropdowns (loaded once)
  let optMurid = '';
  let optPelanggaran = '';

  async function loadOptions() {
    try {
      const [muridRes, pelRes] = await Promise.all([
        fetch('/api/murids', { headers: { 'Authorization': `Bearer ${accessToken}` } }),
        fetch('/api/pelanggarans', { headers: { 'Authorization': `Bearer ${accessToken}` } })
      ]);
      const mData = await muridRes.json();
      const pData = await pelRes.json();
      const murids = Array.isArray(mData) ? mData : (mData.data || []);
      const pels = Array.isArray(pData) ? pData : (pData.data || []);
      
      optMurid = murids.map(m => `<option value="${m.id}">${m.nama} (${m.kelas||'-'})</option>`).join('');
      optPelanggaran = pels.map(p => `<option value="${p.id}">[${p.kategori_pelanggaran}] ${p.nama_pelanggaran}</option>`).join('');
      
      document.getElementById('formMurid').innerHTML = '<option value="">Pilih Siswa</option>' + optMurid;
      document.getElementById('formPelanggaran').innerHTML = '<option value="">Pilih Pelanggaran</option>' + optPelanggaran;

      // populate class filter options (unique kelas from murid list)
      const kelasList = Array.from(new Set(murids.map(m => m.kelas).filter(k => k && k !== ''))).sort();
      const kelasOptions = ['<option value="">Semua Kelas</option>'].concat(kelasList.map(k => `<option value="${k}">${k}</option>`)).join('');
      const fk = document.getElementById('filterKelas');
      if (fk) fk.innerHTML = kelasOptions;
    } catch(e) {
      console.warn('Gagal load options', e);
    }
  }

  function formatDate(dStr) {
    if(!dStr) return '-';
    const d = new Date(dStr);
    return d.toLocaleDateString('id-ID', { day:'numeric', month:'short', year:'numeric' });
  }

  function getBadge(k) {
    const map = { 'Sikap Prilaku': 'badge-green', 'Kerapian': 'badge-yellow', 'Kehadiran/Ketaatan/Pembiasaan': 'badge-red' };
    return `<span class="badge ${map[k] || 'badge-green'}">${k || '-'}</span>`;
  }

  function initTableManager() {
    window.tableManagers['rwPagination'] = new TableManager('tableBody', 'rwPagination', (d, index) => {
      // Flatten nested properties for sorting
      d.murid_nama = d.murid ? d.murid.nama : '';
      d.murid_kelas = d.murid ? d.murid.kelas : '';
      d.pelanggaran_nama = d.pelanggaran ? d.pelanggaran.nama_pelanggaran : '';
      d.pelanggaran_kategori = d.pelanggaran ? d.pelanggaran.kategori_pelanggaran : '';

      return `
      <tr>
        <td><span class="text-caption">${formatDate(d.tanggal_pelanggaran)}</span></td>
        <td><strong>${d.murid ? d.murid.nama : 'Data terhapus'}</strong></td>
        <td>${d.murid ? d.murid.kelas : '-'}</td>
        <td>${d.pelanggaran ? d.pelanggaran.nama_pelanggaran : '-'}</td>
        <td>${d.pelanggaran ? getBadge(d.pelanggaran.kategori_pelanggaran) : '-'}</td>
        <td>${d.pelapor || '-'}</td>
        ${isAdmin ? `
        <td>
          <div class="flex items-center gap-2">
            <button class="btn-icon" title="Edit" onclick='openEditModal(${JSON.stringify(d).replace(/'/g, "&apos;")})'>
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </button>
            <button class="btn-icon danger" title="Hapus" onclick="openDeleteModal(${d.id})">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            </button>
          </div>
        </td>` : ''}
      </tr>`;
    });

    window.tableManagers['rwPagination'].emptyRenderFn = () => {
      document.getElementById('tableBody').innerHTML = `
        <tr><td colspan="${isAdmin ? 7 : 6}">
          <div class="empty-state">
            <div class="empty-icon"><svg class="w-8 h-8" style="color:var(--text-muted);" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
            <h3 class="text-h3 mb-1">Belum Ada Riwayat</h3>
            <p class="text-body" style="color:var(--text-soft);">Belum ada catatan pelanggaran yang ditemukan.</p>
          </div>
        </td></tr>`;
      document.getElementById('subtitleCount').textContent = 'Total: 0 catatan';
    };
  }

  async function fetchData() {
    try {
      const tglMulai = document.getElementById('filterTglMulai').value;
      const tglSelesai = document.getElementById('filterTglSelesai').value;
      const kelas = (document.getElementById('filterKelas') || {}).value || '';
      const search = (document.getElementById('searchInput') || {}).value.trim().toLowerCase();

      let url = '/api/pelanggaran-murids';
      let params = [];
      if(tglMulai) params.push(`tanggal_from=${tglMulai}`);
      if(tglSelesai) params.push(`tanggal_to=${tglSelesai}`);
      if(kelas) params.push(`kelas=${encodeURIComponent(kelas)}`);
      if(params.length > 0) url += '?' + params.join('&');

      const res = await fetch(url, { headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal memuat data');
      const data = await res.json();
      allData = Array.isArray(data) ? data : (data.data || []);

      // Client-side search across several fields
      let filtered = allData;
      if (search) {
        filtered = allData.filter(d => {
          const hay = [
            d.murid ? d.murid.nama : '',
            d.murid ? d.murid.kelas : '',
            d.pelanggaran ? d.pelanggaran.nama_pelanggaran : '',
            d.pelanggaran ? d.pelanggaran.kategori_pelanggaran : '',
            d.pelapor || '',
            d.keterangan || ''
          ].join(' ').toLowerCase();
          return hay.indexOf(search) !== -1;
        });
      }

      document.getElementById('subtitleCount').textContent = `Total: ${filtered.length} catatan pelanggaran`;
      window.tableManagers['rwPagination'].setData(filtered);
    } catch (err) {
      console.error(err);
      showToast('error', 'Gagal Memuat', 'Tidak dapat mengambil data riwayat.');
      window.tableManagers['rwPagination'].setData([]);
    }
  }

  function applyFilter() {
    fetchData();
  }

  // Debounce search input
  let _searchTimer = null;
  const _si = document.getElementById('searchInput');
  if (_si) {
    _si.addEventListener('input', () => {
      clearTimeout(_searchTimer);
      _searchTimer = setTimeout(() => fetchData(), 300);
    });
  }

  // ============= ADMIN MODALS =============
  function openEditModal(d) {
    if(!isAdmin) return;
    document.getElementById('editId').value = d.id;
    document.getElementById('formMurid').value = d.murid_id || '';
    document.getElementById('formPelanggaran').value = d.pelanggaran_id || '';
    document.getElementById('formTanggal').value = d.tanggal_pelanggaran ? d.tanggal_pelanggaran.substring(0,10) : '';
    document.getElementById('formKeterangan').value = d.keterangan || '';
    document.getElementById('formModal').classList.add('active');
  }
  function closeFormModal() { document.getElementById('formModal').classList.remove('active'); }

  function openDeleteModal(id) {
    if(!isAdmin) return;
    deleteId = id;
    document.getElementById('deleteModal').classList.add('active');
  }
  function closeDeleteModal() { document.getElementById('deleteModal').classList.remove('active'); deleteId = null; }

  async function submitForm(e) {
    e.preventDefault();
    const id = document.getElementById('editId').value;
    const payload = {
      murid_id: document.getElementById('formMurid').value,
      pelanggaran_id: document.getElementById('formPelanggaran').value,
      tanggal_pelanggaran: document.getElementById('formTanggal').value,
      keterangan: document.getElementById('formKeterangan').value
    };
    
    const btn = document.getElementById('formSubmitBtn');
    btn.disabled = true; btn.textContent = 'Menyimpan...';
    try {
      const res = await fetch(`/api/pelanggaran-murids/${id}`, {
        method: 'PUT',
        headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'Authorization': `Bearer ${accessToken}` },
        body: JSON.stringify(payload)
      });
      const data = await res.json();
      if (!res.ok) throw new Error(data.message || 'Gagal menyimpan');
      showToast('success', 'Berhasil Diperbarui', 'Catatan pelanggaran telah diperbarui.');
      closeFormModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Gagal Menyimpan', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" d="M5 13l4 4L19 7"/></svg> Simpan Perubahan';
    }
  }

  async function confirmDelete() {
    if (!deleteId) return;
    const btn = document.getElementById('confirmDeleteBtn');
    btn.disabled = true; btn.textContent = 'Menghapus...';
    try {
      const res = await fetch(`/api/pelanggaran-murids/${deleteId}`, {
        method: 'DELETE',
        headers: { 'Accept': 'application/json', 'Authorization': `Bearer ${accessToken}` }
      });
      if (!res.ok) { const d = await res.json(); throw new Error(d.message || 'Gagal menghapus'); }
      showToast('success', 'Berhasil Dihapus', 'Catatan telah dihapus.');
      closeDeleteModal();
      fetchData();
    } catch (err) {
      showToast('error', 'Gagal Menghapus', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg> Ya, Hapus';
    }
  }

  async function exportData() {
    const tglMulai = document.getElementById('filterTglMulai').value;
    const tglSelesai = document.getElementById('filterTglSelesai').value;
    let url = `/api/pelanggaran-murids-export`;
    let params = [];
    if(tglMulai) params.push(`tanggal_from=${tglMulai}`);
    if(tglSelesai) params.push(`tanggal_to=${tglSelesai}`);
    if(params.length > 0) url += '?' + params.join('&');
    
    showToast('info', 'Export', 'Memproses unduhan...');
    try {
      const res = await fetch(url, { headers: { 'Authorization': `Bearer ${accessToken}` } });
      if (!res.ok) throw new Error('Gagal mengunduh file');
      const blob = await res.blob();
      const objUrl = window.URL.createObjectURL(blob);
      const link = document.createElement('a');
      link.href = objUrl;
      link.setAttribute('download', 'Riwayat_Pelanggaran.xlsx');
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
    
    isAdmin = user.role === 'admin';
    if(isAdmin) {
      document.querySelectorAll('.admin-only').forEach(el => el.classList.remove('hidden'));
    }
    // Load options (murid, kelas, pelanggaran) for filters and admin modals
    loadOptions();
    
    initTableManager();
    fetchData();
  })();
</script>
<?= $this->endSection() ?>
