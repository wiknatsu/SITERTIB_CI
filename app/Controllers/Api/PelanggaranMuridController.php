<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MuridModel;
use App\Models\PelanggaranMuridModel;
use App\Models\TahunAjaranModel;
use CodeIgniter\API\ResponseTrait;

class PelanggaranMuridController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = model(PelanggaranMuridModel::class);

        $filters = [
            'murid_id' => $this->request->getGet('murid_id'),
            'tahun_ajaran_id' => $this->request->getGet('tahun_ajaran_id'),
            'pelapor' => $this->request->getGet('pelapor'),
            'tanggal_from' => $this->request->getGet('tanggal_from'),
            'tanggal_to' => $this->request->getGet('tanggal_to'),
            'kelas' => $this->request->getGet('kelas'),
            'nis' => $this->request->getGet('nis'),
        ];

        return $this->respond($model->getByFilters($filters));
    }

    public function show($id = null)
    {
        $model = model(PelanggaranMuridModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Pelanggaran Murid not found');
        }

        return $this->respond($data);
    }

    public function searchByNis($nis = null)
    {
        $modelMurid = model(MuridModel::class);
        $murid = $modelMurid->where('nis', $nis)->first();

        if ($murid === null) {
            return $this->failNotFound('Murid not found');
        }

        $model = model(PelanggaranMuridModel::class);
        $records = $model->where('murid_id', $murid['id'])->orderBy('tanggal_pelanggaran', 'DESC')->findAll();

        return $this->respond([
            'murid' => $murid,
            'total_pelanggaran' => count($records),
            'pelanggaran' => $records,
        ]);
    }

    public function create()
    {
        $rules = [
            'murid_ids' => 'required|is_array',
            'murid_ids.*' => 'required|integer',
            'pelanggaran_id' => 'required|integer',
            'tanggal_pelanggaran' => 'required|valid_date',
            'keterangan' => 'permit_empty|string',
            'pelapor' => 'required|string',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $tahunAjaranModel = model(TahunAjaranModel::class);
        $activeYear = $tahunAjaranModel->getActive();

        if ($activeYear === null) {
            return $this->respond([
                'message' => 'No active Tahun Ajaran found.',
            ], 400);
        }

        $model = model(PelanggaranMuridModel::class);
        $created = [];

        foreach ($this->request->getVar('murid_ids') as $muridId) {
            $data = [
                'murid_id' => $muridId,
                'pelanggaran_id' => $this->request->getVar('pelanggaran_id'),
                'pelapor' => $this->request->getVar('pelapor'),
                'tahun_ajaran_id' => $activeYear['id'],
                'tanggal_pelanggaran' => $this->request->getVar('tanggal_pelanggaran'),
                'keterangan' => $this->request->getVar('keterangan'),
            ];

            $model->insert($data);
            $created[] = $model->find($model->getInsertID());
        }

        return $this->respondCreated($created);
    }

    public function update($id = null)
    {
        $model = model(PelanggaranMuridModel::class);
        $dataExist = $model->find($id);

        if ($dataExist === null) {
            return $this->failNotFound('Pelanggaran Murid not found');
        }

        $rules = [
            'murid_id' => 'permit_empty|integer',
            'pelanggaran_id' => 'permit_empty|integer',
            'tanggal_pelanggaran' => 'permit_empty|valid_date',
            'keterangan' => 'permit_empty|string',
            'pelapor' => 'permit_empty|string',
            'tahun_ajaran_id' => 'permit_empty|integer',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [];
        foreach (['murid_id', 'pelanggaran_id', 'tanggal_pelanggaran', 'keterangan', 'pelapor', 'tahun_ajaran_id'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $value;
            }
        }

        if (empty($data)) {
            return $this->respond($dataExist);
        }

        $model->update($id, $data);

        return $this->respond($model->find($id));
    }

    public function delete($id = null)
    {
        $model = model(PelanggaranMuridModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Pelanggaran Murid not found');
        }

        $model->delete($id);

        return $this->respond([
            'message' => 'Pelanggaran Murid deleted successfully',
        ]);
    }
}
