<?= $this->extend('main') ?>
<?= $this->section('title') ?>Catat Pelanggaran<?= $this->endSection() ?>
<?= $this->section('custom-css') ?>
<style>
  .card { background-color: var(--surface-base); border: 1px solid var(--border-subtle); border-radius: 16px; padding: 24px; transition: all 0.2s ease; }
  .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 10px; font-weight: 600; font-size: 14px; transition: all 0.2s ease; cursor: pointer; border: none; }
  .btn-primary { background-color: #E11D48; color: #fff; box-shadow: 0 8px 20px -8px rgba(225, 29, 72, 0.5); }
  .btn-primary:hover { background-color: #BE123C; transform: translateY(-1px); }
  
  .form-group { margin-bottom: 24px; }
  .form-label { display: block; font-size: 14px; font-weight: 600; color: var(--text-soft); margin-bottom: 8px; font-family: 'DM Sans'; }
  .form-input, .form-select, .form-textarea { width: 100%; padding: 12px 16px; border: 1px solid var(--border-subtle); border-radius: 12px; font-size: 14px; color: var(--text-strong); background: var(--surface-soft); transition: all 0.2s; font-family: 'DM Sans'; }
  .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); background: var(--surface-base); }
  
  .info-box { background: rgba(37,99,235,0.05); border: 1px solid rgba(37,99,235,0.1); border-radius: 12px; padding: 16px; display: flex; gap: 12px; margin-bottom: 24px; }
  
  /* Override TomSelect default styles to match our design */
  .ts-control { padding: 12px 16px; border: 1px solid var(--border-subtle); border-radius: 12px; font-size: 14px; background: var(--surface-soft); font-family: 'DM Sans'; }
  .ts-control.focus { border-color: #E11D48; box-shadow: 0 0 0 3px rgba(225,29,72,0.1); background: var(--surface-base); }
  .ts-dropdown { border-radius: 12px; font-family: 'DM Sans'; }
</style>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="max-w-3xl mx-auto">
  <div class="mb-8">
    <h1 class="text-h2">Input Pelanggaran Baru</h1>
    <p class="text-body" style="color: var(--text-soft);">Catat pelanggaran siswa secara real-time. Data akan tersimpan sesuai tahun ajaran aktif.</p>
  </div>

  <div class="card shadow-2xl shadow-black/5">
    
    <div class="info-box">
      <div class="text-secondary mt-0.5">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      </div>
      <div>
        <p class="text-sm font-semibold" style="color:var(--text-strong);">Panduan Pencatatan</p>
        <p class="text-caption mt-1" style="color:var(--text-soft);">Pastikan Anda memilih nama siswa dan jenis pelanggaran yang tepat. Pelanggaran berat akan otomatis ternotifikasi ke pihak terkait.</p>
      </div>
    </div>

    <form id="pelanggaranForm" onsubmit="submitPelanggaran(event)">
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="form-group mb-0">
          <label class="form-label">Siswa Pelanggar <span class="text-error">*</span></label>
          <select id="murid_ids" class="form-select" multiple required>
            <option value="">Memuat data siswa...</option>
          </select>
        </div>
        
        <div class="form-group mb-0">
          <label class="form-label">Tanggal Kejadian <span class="text-error">*</span></label>
          <input type="date" id="tanggal_pelanggaran" class="form-input" required>
        </div>
      </div>

      <div class="form-group mt-6">
        <label class="form-label">Jenis Pelanggaran <span class="text-error">*</span></label>
        <select id="pelanggaran_id" class="form-select" required>
          <option value="">Memuat jenis pelanggaran...</option>
        </select>
      </div>

      <div class="form-group mt-6">
        <label class="form-label">Nama Pelapor <span class="text-error">*</span></label>
        <select id="pelapor" class="form-select" required>
          <option value="">Memuat data pelapor...</option>
        </select>
      </div>

      <div class="form-group">
        <label class="form-label">Keterangan Tambahan (Opsional)</label>
        <textarea id="keterangan" class="form-textarea" rows="4" placeholder="Tuliskan detail kejadian, lokasi, atau barang bukti (jika ada)..."></textarea>
      </div>

      <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t" style="border-color: var(--border-subtle);">
        <button type="button" class="btn bg-transparent border border-slate-200 dark:border-slate-700 hover:bg-slate-50 dark:hover:bg-slate-800" onclick="window.location.reload()">
          Reset Form
        </button>
        <button type="submit" class="btn btn-primary" id="submitBtn">
          <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
          Simpan Catatan
        </button>
      </div>
    </form>
  </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('custom-js') ?>
<script>
  // Set default date to today
  document.getElementById('tanggal_pelanggaran').valueAsDate = new Date();

  let tomMurid, tomPelanggaran, tomPelapor;

  async function loadFormData(userName, userRole) {
    try {
      const [muridRes, pelRes, guruRes] = await Promise.all([
        fetch('/api/murids', { headers: { 'Authorization': `Bearer ${accessToken}` } }),
        fetch('/api/pelanggarans', { headers: { 'Authorization': `Bearer ${accessToken}` } }),
        fetch('/api/gurus', { headers: { 'Authorization': `Bearer ${accessToken}` } })
      ]);

      const muridData = await muridRes.json();
      const pelData = await pelRes.json();
      const guruData = await guruRes.json();

      const murids = Array.isArray(muridData) ? muridData : (muridData.data || []);
      const pelanggarans = Array.isArray(pelData) ? pelData : (pelData.data || []);
      const gurus = Array.isArray(guruData) ? guruData : (guruData.data || []);

      const selectMurid = document.getElementById('murid_ids');
      selectMurid.innerHTML = '<option value="">Pilih Siswa...</option>' + 
        murids.map(m => `<option value="${m.id}">${m.nama} (${m.kelas || '-'})</option>`).join('');

      const selectPel = document.getElementById('pelanggaran_id');
      selectPel.innerHTML = '<option value="">Pilih Pelanggaran...</option>' + 
        pelanggarans.map(p => `<option value="${p.id}">[${p.kategori_pelanggaran}] ${p.nama_pelanggaran}</option>`).join('');

      const selectPelapor = document.getElementById('pelapor');
      let pelaporOptions = '<option value="">Pilih Pelapor...</option>';
      pelaporOptions += `<optgroup label="Guru">` + gurus.map(g => `<option value="${g.nama}">${g.nama}</option>`).join('') + `</optgroup>`;
      pelaporOptions += `<optgroup label="Murid">` + murids.map(m => `<option value="${m.nama}">${m.nama}</option>`).join('') + `</optgroup>`;
      selectPelapor.innerHTML = pelaporOptions;

      if(tomMurid) tomMurid.destroy();
      tomMurid = new TomSelect('#murid_ids', {
        plugins: ['remove_button'],
        placeholder: 'Pilih beberapa siswa...',
        maxOptions: null
      });

      if(tomPelanggaran) tomPelanggaran.destroy();
      tomPelanggaran = new TomSelect('#pelanggaran_id', {
        placeholder: 'Pilih pelanggaran...',
        maxOptions: null
      });

      if(tomPelapor) tomPelapor.destroy();
      tomPelapor = new TomSelect('#pelapor', {
        placeholder: 'Pilih pelapor...',
        maxOptions: null
      });

      if (userRole === 'guru' && userName) {
        tomPelapor.setValue(userName);
      }

    } catch (err) {
      console.error(err);
      showToast('error', 'Gagal Memuat Form', 'Tidak dapat mengambil data referensi form.');
    }
  }

  async function submitPelanggaran(e) {
    e.preventDefault();
    
    const payload = {
      murid_ids: tomMurid.getValue(),
      pelanggaran_id: tomPelanggaran.getValue(),
      tanggal_pelanggaran: document.getElementById('tanggal_pelanggaran').value,
      pelapor: tomPelapor.getValue(),
      keterangan: document.getElementById('keterangan').value
    };

    if (!payload.murid_ids || payload.murid_ids.length === 0) {
      showToast('error', 'Validasi Gagal', 'Silakan pilih setidaknya satu siswa.');
      return;
    }

    const btn = document.getElementById('submitBtn');
    btn.disabled = true;
    btn.innerHTML = '<span class="animate-spin mr-2">⏳</span> Menyimpan...';

    try {
      const res = await fetch('/api/pelanggaran-murids', {
        method: 'POST',
        headers: {
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${accessToken}`
        },
        body: JSON.stringify(payload)
      });
      
      const data = await res.json();
      
      if (!res.ok) throw new Error(data.message || 'Gagal menyimpan catatan pelanggaran.');

      showToast('success', 'Berhasil Dicatat', 'Catatan pelanggaran telah berhasil disimpan.');
      
      // Reset form properly
      document.getElementById('pelanggaranForm').reset();
      document.getElementById('tanggal_pelanggaran').valueAsDate = new Date();
      tomMurid.clear();
      tomPelanggaran.clear();
      
      const user = await fetchUserProfile();
      if (user.role === 'guru') {
         tomPelapor.setValue(user.guru?.nama || user.username);
      } else {
         tomPelapor.clear();
      }

    } catch (err) {
      showToast('error', 'Kesalahan', err.message);
    } finally {
      btn.disabled = false;
      btn.innerHTML = '<svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg> Simpan Catatan';
    }
  }

  (async function init() {
    const user = await fetchUserProfile();
    document.getElementById('userName').textContent = user.guru?.nama || user.username;
    document.getElementById('userRoleDisplay').textContent = user.role === 'admin' ? 'Administrator' : 'Guru';
    document.getElementById('userNipDisplay').textContent = `NIP: ${user.guru?.nip || '-'}`;
    document.getElementById('userAvatar').textContent = (user.guru?.nama || user.username).charAt(0).toUpperCase();
    
    const userName = user.guru?.nama || user.username;
    loadFormData(userName, user.role);
  })();
</script>
<?= $this->endSection() ?>
