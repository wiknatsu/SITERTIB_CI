<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $db = \Config\Database::connect();

        $data = [
            'username' => 'admin',
            'password' => password_hash('admin!123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'guru_id' => null,
            'created_at' => Time::now()->toDateTimeString(),
            'updated_at' => Time::now()->toDateTimeString(),
        ];

        // avoid duplicate insertion if admin user already exists
        $existing = $db->table('users')->where('username', $data['username'])->get()->getRowArray();
        if (!$existing) {
            $db->table('users')->insert($data);
        }
    }
}
