<?php


// defined('BASEPATH') OR exit('No direct script access allowed');

class PengirimModel extends CI_Model
{
    public $tablename = 'pengirim';

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->load->database();
    //     $this->tablename = ;
    // }

    public function create($data_assoc)
    {
        // $query = $this->db->query("insert into ".$this->tablename." (nama, bio) values('$nama','$bio')");
        $query = $this->db->insert($this->tablename, $data_assoc);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        // $query = $this->db->query("select * from ".$this->tablename." ".($id=null?"":"where id = $id"));
        $query = $this->db->get($this->tablename);
        return $query->result();
    }

    public function update($id, $data_assoc){
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
        if($query!=null){
            return $query->row();
        }else{
            return false;
        }
    }


    public function delete($id)
    {
        // $query = $this->db->query("delete from crud where id ='$id'");
        $query = $this->db->delete($this->tablename, array('id'=>$id));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function search($field, $cari){
        $query = $this->db->like($field, $cari);
        if ($query != null) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function get_p_punya_berita()
    {
        $array_pengirim = array();
        foreach($this->punya_berita() as $value){
            $query = $this->db->get_where($this->tablename, array('id' => $value->id_pengirim));
            array_push($array_pengirim, $query->row());
        }

        return $array_pengirim;
    }

    public function punya_berita(){
        $this->db->distinct();
        $this->db->select('id_pengirim');
        $this->db->from('berita');
        return $this->db->get()->result();
    }

}
