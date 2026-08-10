<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $db = db();

        $data = [
            'username' => 'admin',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'guru_id' => null,
            'created_at' => Time::now()->toDateTimeString(),
            'updated_at' => Time::now()->toDateTimeString(),
        ];

        $db->table('users')->insert($data);
    }
}
