<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggaranTable extends Migration
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
            'kode_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'unique'     => true,
            ],
            'nama_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'kategori_pelanggaran' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
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
        $this->forge->createTable('pelanggaran');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran', true);
    }
}
