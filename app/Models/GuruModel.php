<?php

namespace App\Models;

use CodeIgniter\Model;

class GuruModel extends Model
{
    protected $table            = 'guru';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nip', 'nama', 'gender', 'jabatan', 'no_telp'];

    public function getByFilters(?string $nama = null, ?string $nip = null): array
    {
        $builder = $this->builder();

        if ($nama !== null && $nama !== '') {
            $builder->like('nama', $nama);
        }

        if ($nip !== null && $nip !== '') {
            $builder->like('nip', $nip);
        }

        return $builder->get()->getResultArray();
    }
}
