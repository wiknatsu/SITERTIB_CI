<?php

namespace App\Models;

use CodeIgniter\Model;

class PelanggaranMuridModel extends Model
{
    protected $table            = 'pelanggaran_murid';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['murid_id', 'pelanggaran_id', 'pelapor', 'tahun_ajaran_id', 'tanggal_pelanggaran', 'keterangan'];

    public function getByFilters(array $filters = []): array
    {
        $builder = $this->builder();

        if (!empty($filters['murid_id'])) {
            $builder->where('murid_id', $filters['murid_id']);
        }

        if (!empty($filters['tahun_ajaran_id'])) {
            $builder->where('tahun_ajaran_id', $filters['tahun_ajaran_id']);
        }

        if (!empty($filters['pelapor'])) {
            $builder->like('pelapor', $filters['pelapor']);
        }

        if (!empty($filters['tanggal_from']) && !empty($filters['tanggal_to'])) {
            $builder->where('tanggal_pelanggaran >=', $filters['tanggal_from']);
            $builder->where('tanggal_pelanggaran <=', $filters['tanggal_to']);
        }

        if (!empty($filters['kelas'])) {
            $builder->join('murid', 'murid.id = pelanggaran_murid.murid_id');
            $builder->like('murid.kelas', $filters['kelas']);
        }

        if (!empty($filters['nis'])) {
            $builder->join('murid', 'murid.id = pelanggaran_murid.murid_id');
            $builder->where('murid.nis', $filters['nis']);
        }

        $builder->select('pelanggaran_murid.*');

        return $builder->get()->getResultArray();
    }
}
