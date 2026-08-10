<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMuridTable extends Migration
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
            'nis' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'nisn' => [
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
            'kelas' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
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
        $this->forge->createTable('murid');
    }

    public function down()
    {
        $this->forge->dropTable('murid', true);
    }
}
