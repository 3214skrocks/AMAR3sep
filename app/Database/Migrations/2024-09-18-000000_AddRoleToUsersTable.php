<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRoleToUsersTable extends Migration
{
    public function up()
    {
        $fields = [
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
        ];
        $this->forge->addColumn('users', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'role');
    }
}
