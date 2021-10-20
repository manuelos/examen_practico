<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContacts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'	=> [
                    'type'			=> 'INT',
                    'constraint'	=> 11,
                    'unsigned'		=> true,
                    'auto_increment'=> true,
            ],
            'name'	=> [
                    'type'			=> 'VARCHAR',
                    'constraint'	=> '100',
					'null'			=> false,
            ],
            'email'	=> [
                    'type'			=> 'VARCHAR',
                    'constraint'	=> '255',
					'null'			=> false,
            ],
			'street_address'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '100',
				'null'			=> false,
			],
			'number_address'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '50',
				'null'			=> false,
			],
			'suburb_address'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '100',
				'null'			=> false,
			],
			'zip_code'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '10',
				'null'			=> true,
			],
			'city'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '100',
				'null'			=> false,
			],
			'state'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '100',
				'null'			=> true,
			],
			'phone'	=> [
				'type'			=> 'VARCHAR',
				'constraint'	=> '15',
				'null'			=> false,
			],
			'latitude'	=> [
				'type'			=> 'DECIMAL',
				'constraint'	=> '10,8',
				'null'			=> false,
			],
			'longitude'	=> [
				'type'			=> 'DECIMAL',
				'constraint'	=> '11,8',
				'null'			=> false,
			],
			'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
			'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
			'deleted_at DATETIME'
		
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts');
    }
}
