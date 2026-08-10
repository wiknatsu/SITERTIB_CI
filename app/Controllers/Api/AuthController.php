<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        $rules = [
            'username' => 'required|string|min_length[3]',
            'password' => 'required|string',
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

        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userModel = model(UserModel::class);
        $user = $userModel->findByUsername($username);

        if ($user === null || !password_verify($password, $user['password'])) {
            return $this->respond([
                'message' => 'Username atau password salah.'
            ], ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $session = session();
        $session->set([
            'user_id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
            'logged_in' => true,
        ]);

        $payload = [
            'id' => $user['id'],
            'username' => $user['username'],
            'role' => $user['role'],
        ];

        if (!empty($user['guru_id'])) {
            $payload['guru'] = model('GuruModel')->find($user['guru_id']);
        }

        return $this->respond([
            'message' => 'Login success',
            'access_token' => session_id() ?: null,
            'user' => $payload,
        ]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return $this->respond([
            'message' => 'Logged out successfully',
        ]);
    }

    public function me()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (empty($userId)) {
            return $this->respond([
                'message' => 'Unauthenticated',
            ], ResponseInterface::HTTP_UNAUTHORIZED);
        }

        $user = model(UserModel::class)->find($userId);
        if ($user === null) {
            return $this->respond([
                'message' => 'User not found',
            ], ResponseInterface::HTTP_NOT_FOUND);
        }

        if (!empty($user['guru_id'])) {
            $user['guru'] = model('GuruModel')->find($user['guru_id']);
        }

        return $this->respond($user);
    }
}
