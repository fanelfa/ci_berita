<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaModel extends CI_Model
{
    public $tablename = 'berita';

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
}
