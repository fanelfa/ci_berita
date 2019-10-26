<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tb_kategori extends CI_Migration
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
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('kategori');
    }

    public function down()
    {
        $this->dbforge->drop_table('kategori');
    }
}
