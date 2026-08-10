<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'password', 'role', 'guru_id'];

    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    public function findByUsername(string $username): ?array
    {
        return $this->where('username', $username)->first();
    }

    public function findByIdWithGuru(int $id): ?array
    {
        $user = $this->find($id);
        if ($user === null) {
            return null;
        }

        if (!empty($user['guru_id'])) {
            $user['guru'] = model('GuruModel')->find($user['guru_id']);
        }

        return $user;
    }

    protected function hashPassword(array $data): array
    {
        if (!isset($data['data']['password']) || $data['data']['password'] === '') {
            return $data;
        }

        $password = $data['data']['password'];
        if (password_get_info($password)['algo'] !== 0) {
            return $data;
        }

        $data['data']['password'] = password_hash($password, PASSWORD_DEFAULT);

        return $data;
    }
}
