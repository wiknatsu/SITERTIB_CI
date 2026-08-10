<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePelanggaranMuridTable extends Migration
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
            'murid_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pelanggaran_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'pelapor' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'tahun_ajaran_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'tanggal_pelanggaran' => [
                'type' => 'DATE',
            ],
            'keterangan' => [
                'type' => 'TEXT',
                'null' => true,
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
        $this->forge->addKey('murid_id');
        $this->forge->addKey('pelanggaran_id');
        $this->forge->addKey('tahun_ajaran_id');

        $this->forge->addForeignKey('murid_id', 'murid', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('pelanggaran_id', 'pelanggaran', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('tahun_ajaran_id', 'tahun_ajaran', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('pelanggaran_murid');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggaran_murid', true);
    }
}
