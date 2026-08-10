<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranModel extends Model
{
    protected $table            = 'pelanggaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_pelanggaran', 'nama_pelanggaran', 'kategori_pelanggaran'];

    public function getByFilters(?string $namaPelanggaran = null, ?string $kategori = null): array
    {
        $builder = $this->builder();

        if ($namaPelanggaran !== null && $namaPelanggaran !== '') {
            $builder->like('nama_pelanggaran', $namaPelanggaran);
        }

        if ($kategori !== null && $kategori !== '') {
            $builder->where('kategori_pelanggaran', $kategori);
        }

        return $builder->get()->getResultArray();
    }
}
