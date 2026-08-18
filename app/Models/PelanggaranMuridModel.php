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
            $builder->where('pelanggaran_murid.murid_id', $filters['murid_id']);
        }

        if (!empty($filters['tahun_ajaran_id'])) {
            $builder->where('pelanggaran_murid.tahun_ajaran_id', $filters['tahun_ajaran_id']);
        }

        if (!empty($filters['pelapor'])) {
            $builder->like('pelanggaran_murid.pelapor', $filters['pelapor']);
        }

        if (!empty($filters['tanggal_from'])) {
            $builder->where('pelanggaran_murid.tanggal_pelanggaran >=', $filters['tanggal_from']);
        }

        if (!empty($filters['tanggal_to'])) {
            $builder->where('pelanggaran_murid.tanggal_pelanggaran <=', $filters['tanggal_to']);
        }

        if (!empty($filters['kelas'])) {
            $builder->join('murid', 'murid.id = pelanggaran_murid.murid_id', 'left');
            $builder->like('murid.kelas', $filters['kelas']);
        }

        if (!empty($filters['nis'])) {
            $builder->join('murid', 'murid.id = pelanggaran_murid.murid_id', 'left');
            $builder->where('murid.nis', $filters['nis']);
        }

        $builder->select('pelanggaran_murid.*');

        return $builder->get()->getResultArray();
    }

    /**
     * Fetch pelanggaran_murid records with full related data (murid, pelanggaran, tahun_ajaran).
     * Tahun ajaran is resolved from the tahun_ajaran_id stored at recording time,
     * so it always reflects the academic year when the violation was originally recorded.
     */
    public function getWithRelations(array $filters = []): array
    {
        $builder = $this->builder();

        $builder->select('
            pelanggaran_murid.*,
            murid.nama AS murid_nama,
            murid.nis AS murid_nis,
            murid.nisn AS murid_nisn,
            murid.kelas AS murid_kelas,
            murid.gender AS murid_gender,
            pelanggaran.nama_pelanggaran AS pelanggaran_nama_pelanggaran,
            pelanggaran.kategori_pelanggaran AS pelanggaran_kategori_pelanggaran,
            pelanggaran.kode_pelanggaran AS pelanggaran_kode_pelanggaran,
            tahun_ajaran.nama AS tahun_ajaran_nama,
            tahun_ajaran.semester AS tahun_ajaran_semester
        ');

        $builder->join('murid', 'murid.id = pelanggaran_murid.murid_id', 'left');
        $builder->join('pelanggaran', 'pelanggaran.id = pelanggaran_murid.pelanggaran_id', 'left');
        $builder->join('tahun_ajaran', 'tahun_ajaran.id = pelanggaran_murid.tahun_ajaran_id', 'left');

        // Apply filters
        if (!empty($filters['murid_id'])) {
            $builder->where('pelanggaran_murid.murid_id', $filters['murid_id']);
        }

        if (!empty($filters['tahun_ajaran_id'])) {
            $builder->where('pelanggaran_murid.tahun_ajaran_id', $filters['tahun_ajaran_id']);
        }

        if (!empty($filters['pelapor'])) {
            $builder->like('pelanggaran_murid.pelapor', $filters['pelapor']);
        }

        if (!empty($filters['tanggal_from'])) {
            $builder->where('pelanggaran_murid.tanggal_pelanggaran >=', $filters['tanggal_from']);
        }

        if (!empty($filters['tanggal_to'])) {
            $builder->where('pelanggaran_murid.tanggal_pelanggaran <=', $filters['tanggal_to']);
        }

        if (!empty($filters['kelas'])) {
            $builder->like('murid.kelas', $filters['kelas']);
        }

        if (!empty($filters['nis'])) {
            $builder->where('murid.nis', $filters['nis']);
        }

        $builder->orderBy('pelanggaran_murid.tanggal_pelanggaran', 'DESC');

        $rows = $builder->get()->getResultArray();

        // Restructure flat rows into nested objects for frontend consumption
        return array_map(function ($row) {
            return [
                'id'                   => $row['id'],
                'murid_id'             => $row['murid_id'],
                'pelanggaran_id'       => $row['pelanggaran_id'],
                'tahun_ajaran_id'      => $row['tahun_ajaran_id'],
                'pelapor'              => $row['pelapor'],
                'tanggal_pelanggaran'  => $row['tanggal_pelanggaran'],
                'keterangan'           => $row['keterangan'],
                'murid' => [
                    'id'     => $row['murid_id'],
                    'nama'   => $row['murid_nama'],
                    'nis'    => $row['murid_nis'],
                    'nisn'   => $row['murid_nisn'],
                    'kelas'  => $row['murid_kelas'],
                    'gender' => $row['murid_gender'],
                ],
                'pelanggaran' => [
                    'id'                   => $row['pelanggaran_id'],
                    'nama_pelanggaran'     => $row['pelanggaran_nama_pelanggaran'],
                    'kategori_pelanggaran' => $row['pelanggaran_kategori_pelanggaran'],
                    'kode_pelanggaran'     => $row['pelanggaran_kode_pelanggaran'],
                ],
                'tahun_ajaran' => [
                    'id'       => $row['tahun_ajaran_id'],
                    'nama'     => $row['tahun_ajaran_nama'],
                    'semester' => $row['tahun_ajaran_semester'],
                ],
            ];
        }, $rows);
    }
}
