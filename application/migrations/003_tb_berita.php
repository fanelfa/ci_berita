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
                'null' => FALSE,
            ),
            'gambar' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'softdelete' => array(
                'type' => 'BOOLEAN',
                'null' => FALSE,
                'default' => FALSE,
            ),
            'jumlahbaca' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            'url_slug' => array(
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => TRUE,
            ),
            'id_kategori' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'id_pengirim' => array(
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'null' => FALSE,
            ),
            'created_at TIMESTAMP NOT NULL DEFAULT NOW()',
            'updated_at TIMESTAMP NOT NULL DEFAULT NOW()',
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('berita');
        $this->db->query($this->add_foreign_key('berita', 'id_kategori', 'kategori(id)', 'CASCADE', 'CASCADE'));
        $this->db->query($this->add_foreign_key('berita', 'id_pengirim', 'pengirim(id)', 'CASCADE', 'CASCADE'));
    }

    public function down()
    {
        // $this->db->query($this->drop_foreign_key('berita', 'id_kategori'));
        $this->dbforge->drop_table('berita');
    }


    private function add_foreign_key($table, $foreign_key, $references, $on_delete = 'RESTRICT', $on_update = 'RESTRICT')
    {
        $constraint = "{$table}_{$foreign_key}_fk";
        $sql = "ALTER TABLE {$table} ADD CONSTRAINT {$constraint} FOREIGN KEY ({$foreign_key}) REFERENCES {$references} ON DELETE {$on_delete} ON UPDATE {$on_update}";
        return $sql;
    }

    private function drop_foreign_key($table, $foreign_key)
    {
        return "ALTER TABLE {$table} DROP CONSTRAINT {$table}_{$foreign_key}_fkey";
    }
}
