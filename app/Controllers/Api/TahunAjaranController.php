<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\TahunAjaranModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class TahunAjaranController extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        $model = model(TahunAjaranModel::class);

        return $this->respond($model->findAll());
    }

    public function show($id = null)
    {
        $model = model(TahunAjaranModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Tahun Ajaran not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $rules = [
            'nama' => 'required|string|max_length[100]',
            'semester' => 'required|in_list[ganjil,genap]',
            'is_active' => 'permit_empty|in_list[0,1,true,false]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $model = model(TahunAjaranModel::class);

        $isActive = $this->request->getVar('is_active');
        if ($isActive == '1' || $isActive === true || $isActive === 'true') {
            $model->where('is_active', 1)->set(['is_active' => 0])->update();
        }

        $data = [
            'nama' => $this->request->getVar('nama'),
            'semester' => $this->request->getVar('semester'),
            'is_active' => ($isActive == '1' || $isActive === true || $isActive === 'true') ? 1 : 0,
        ];

        $id = $model->insert($data);

        return $this->respondCreated($model->find($id));
    }

    public function update($id = null)
    {
        $model = model(TahunAjaranModel::class);
        $dataExist = $model->find($id);

        if ($dataExist === null) {
            return $this->failNotFound('Tahun Ajaran not found');
        }

        $rules = [
            'nama' => 'permit_empty|string|max_length[100]',
            'semester' => 'permit_empty|in_list[ganjil,genap]',
            'is_active' => 'permit_empty|in_list[0,1,true,false]',
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $data = [];
        foreach (['nama', 'semester', 'is_active'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $data[$field] = $field === 'is_active' ? ((bool) $value ? 1 : 0) : $value;
            }
        }

        if (!empty($data['is_active']) && $data['is_active'] == 1) {
            $model->where('id !=', $id)->set(['is_active' => 0])->update();
        }

        if (empty($data)) {
            return $this->respond($dataExist);
        }

        $model->update($id, $data);

        return $this->respond($model->find($id));
    }

    public function delete($id = null)
    {
        $model = model(TahunAjaranModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Tahun Ajaran not found');
        }

        $model->delete($id);

        return $this->respond([
            'message' => 'Tahun Ajaran deleted successfully',
        ]);
    }

    public function setActive($id = null)
    {
        $model = model(TahunAjaranModel::class);
        $data = $model->find($id);

        if ($data === null) {
            return $this->failNotFound('Tahun Ajaran not found');
        }

        $model->where('id !=', $id)->set(['is_active' => 0])->update();
        $model->update($id, ['is_active' => 1]);

        return $this->respond([
            'message' => 'Tahun Ajaran is now active',
            'data' => $model->find($id),
        ]);
    }
}
