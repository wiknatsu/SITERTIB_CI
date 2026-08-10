<?php

namespace App\Models;

use CodeIgniter\Model;

class MuridModel extends Model
{
    protected $table            = 'murid';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nis', 'nisn', 'nama', 'gender', 'kelas'];

    public function getByFilters(?string $nama = null, ?string $nis = null, ?string $kelas = null): array
    {
        $builder = $this->builder();

        if ($nama !== null && $nama !== '') {
            $builder->like('nama', $nama);
        }

        if ($nis !== null && $nis !== '') {
            $builder->like('nis', $nis);
        }

        if ($kelas !== null && $kelas !== '') {
            $builder->like('kelas', $kelas);
        }

        return $builder->get()->getResultArray();
    }
}
