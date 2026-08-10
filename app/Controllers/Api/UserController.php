<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\GuruModel;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;

class UserController extends BaseController
{
    use ResponseTrait;

    private function sanitizeUser(array $user): array
    {
        unset($user['password']);

        if (!empty($user['guru_id'])) {
            $user['guru'] = model(GuruModel::class)->find($user['guru_id']);
        }

        return $user;
    }

    public function index()
    {
        $userModel = model(UserModel::class);
        $users = $userModel->findAll();

        foreach ($users as &$user) {
            $user = $this->sanitizeUser($user);
        }

        return $this->respond($users);
    }

    public function show($id = null)
    {
        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        return $this->respond($this->sanitizeUser($user));
    }

    public function create()
    {
        $rules = [
            'username' => 'required|string|min_length[3]|is_unique[users.username]',
            'password' => 'required|string|min_length[6]',
            'role' => 'required|in_list[admin,guru]',
            'guru_id' => 'permit_empty|integer|is_not_unique[guru.id]',
        ];

        try {
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            return $this->failValidationErrors([
                'request' => 'Payload JSON tidak valid. Pastikan body dikirim sebagai JSON yang benar.',
            ]);
        }

        $userModel = model(UserModel::class);
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => $this->request->getVar('password'),
            'role' => $this->request->getVar('role'),
            'guru_id' => $this->request->getVar('guru_id') ?: null,
        ];

        $id = $userModel->insert($data);

        return $this->respondCreated($this->sanitizeUser($userModel->find($id)));
    }

    public function update($id = null)
    {
        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        $rules = [
            'username' => 'permit_empty|string|min_length[3]|is_unique[users.username,id,' . $id . ']',
            'password' => 'permit_empty|string|min_length[6]',
            'role' => 'permit_empty|in_list[admin,guru]',
            'guru_id' => 'permit_empty|integer|is_not_unique[guru.id]',
        ];

        try {
            if (!$this->validate($rules)) {
                return $this->failValidationErrors($this->validator->getErrors());
            }
        } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
            return $this->failValidationErrors([
                'request' => 'Payload JSON tidak valid. Pastikan body dikirim sebagai JSON yang benar.',
            ]);
        }

        $payload = [];
        foreach (['username', 'password', 'role', 'guru_id'] as $field) {
            $value = $this->request->getVar($field);
            if ($value !== null && $value !== '') {
                $payload[$field] = $value;
            }
        }

        if (array_key_exists('guru_id', $payload) && $payload['guru_id'] === '') {
            $payload['guru_id'] = null;
        }

        if (empty($payload)) {
            return $this->respond($user);
        }

        $userModel->update($id, $payload);
        $updated = $userModel->find($id);

        return $this->respond($this->sanitizeUser($updated));
    }

    public function delete($id = null)
    {
        $userModel = model(UserModel::class);
        $user = $userModel->find($id);

        if ($user === null) {
            return $this->failNotFound('User not found');
        }

        $userModel->delete($id);

        return $this->respond([
            'message' => 'User deleted successfully',
        ]);
    }

    public function syncFromGurus()
    {
        $guruModel = model(GuruModel::class);
        $userModel = model(UserModel::class);

        $gurus = $guruModel->findAll();
        $created = 0;
        $skipped = [];

        foreach ($gurus as $guru) {
            if ($userModel->where('guru_id', $guru['id'])->first() !== null) {
                continue;
            }

            if ($userModel->where('username', $guru['nip'])->first() !== null) {
                $skipped[] = "Guru dengan NIP {$guru['nip']} sudah memiliki akun.";
                continue;
            }

            $userModel->insert([
                'username' => $guru['nip'],
                'password' => $guru['nip'],
                'role' => 'guru',
                'guru_id' => $guru['id'],
            ]);
            $created++;
        }

        $message = "Sinkronisasi selesai. {$created} akun guru dibuat.";
        if (!empty($skipped)) {
            $message .= ' ' . count($skipped) . ' guru diabaikan karena akun sudah ada.';
        }

        return $this->respond([
            'message' => $message,
            'created' => $created,
            'skipped' => $skipped,
        ]);
    }
}
