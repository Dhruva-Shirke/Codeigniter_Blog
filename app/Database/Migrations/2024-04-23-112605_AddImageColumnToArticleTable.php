<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddImageColumnToArticleTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('article', [
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => 128
            ]
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('article','image');
    }
}
