<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tb_pengirim extends CI_Migration
{

    public function up()
    {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ),
            'nama' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
            ),
            'bio' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('pengirim');
    }

    public function down()
    {
        $this->dbforge->drop_table('pengirim');
    }
    
}
