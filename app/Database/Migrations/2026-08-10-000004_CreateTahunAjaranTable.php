<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTahunAjaranTable extends Migration
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
            'nama' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'semester' => [
                'type'       => 'ENUM',
                'constraint' => ['ganjil', 'genap'],
            ],
            'is_active' => [
                'type'       => 'BOOLEAN',
                'default'    => false,
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
        $this->forge->createTable('tahun_ajaran');
    }

    public function down()
    {
        $this->forge->dropTable('tahun_ajaran', true);
    }
}
