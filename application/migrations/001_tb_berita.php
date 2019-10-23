<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Tb_berita extends CI_Migration
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
            'judul' => array(
                'type' => 'VARCHAR',
                'constraint' => '200',
            ),
            'isi' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            'gambar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'softdelete' => array(

            ),
            'jumlahbaca' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'auto_increment' => FALSE
            ),
            'url_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => FALSE,
            ),
            'id_kategori' => array(

            ),
            'id_pengirim' => array(

            ),
            'created_at' => array(

            ),
            'updated_at' => array(

            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('berita');
    }

    public function down()
    {
        $this->dbforge->drop_table('berita');
    }
}
