<?php

namespace App\Models;

use CodeIgniter\Model;

class TahunAjaranModel extends Model
{
    protected $table            = 'tahun_ajaran';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama', 'semester', 'is_active'];

    public function getActive(): ?array
    {
        return $this->where('is_active', 1)->first();
    }
}
