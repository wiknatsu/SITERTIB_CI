<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGuruTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nip' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'gender' => [
                'type'       => 'ENUM',
                'constraint' => ['L', 'P'],
            ],
            'jabatan' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'no_telp' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('guru');
    }

    public function down()
    {
        $this->forge->dropTable('guru', true);
    }
}
