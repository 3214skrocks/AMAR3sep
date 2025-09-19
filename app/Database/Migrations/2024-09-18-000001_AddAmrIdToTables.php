<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddAmrIdToTables extends Migration
{
    public function up()
    {
        $fields = [
            'amr_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'null' => false,
            ],
        ];

        $this->forge->addColumn('periodical1', $fields);
        $this->forge->addColumn('rare_books1', $fields);
        $this->forge->addColumn('catalogue1', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('periodical1', 'amr_id');
        $this->forge->dropColumn('rare_books1', 'amr_id');
        $this->forge->dropColumn('catalogue1', 'amr_id');
    }
}
