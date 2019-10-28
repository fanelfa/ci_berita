<?php


defined('BASEPATH') or exit('No direct script access allowed');

class KategoriModel extends CI_Model
{
    public $tablename = 'kategori';

    public function create($data_assoc)
    {
        $query = $this->db->insert($this->tablename, $data_assoc);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        $query = $this->db->get($this->tablename);
        return $query->result();
    }

    public function update($id, $data_assoc)
    {
        $query = $this->db->where('id', $id)->update($this->tablename, $data_assoc);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function find($id)
    {
        $query = $this->db->get_where($this->tablename, array('id' => $id));
        if ($query != null) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function delete($id)
    {
        $query = $this->db->delete($this->tablename, array('id' => $id));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function search($field, $cari)
    {
        $query = $this->db->like($field, $cari);
        if ($query != null) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get_k_punya_berita()
    {
        $array_kategori = array();
        foreach ($this->punya_berita() as $value) {
            $query = $this->db->get_where($this->tablename, array('id' => $value->id_kategori));
            array_push($array_kategori, $query->row());
        }

        return $array_kategori;
    }

    public function punya_berita()
    {
        $this->db->distinct();
        $this->db->select('id_kategori');
        $this->db->from('berita');
        return $this->db->get()->result();
    }
}
