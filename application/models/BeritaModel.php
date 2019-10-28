<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class BeritaModel extends CI_Model
{
    public $tablename = 'berita';

    public function create($data_assoc)
    {
        $dt = new DateTime();
        $data_assoc['created_at'] = $dt->format('Y-m-d H:i:s');
        $data_assoc['updated_at'] = $dt->format('Y-m-d H:i:s');
        $query = $this->db->insert($this->tablename, $data_assoc);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function read()
    {
        // $query = $this->db->get($this->tablename);
        // return $query->result();

        $this->db->from($this->tablename);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
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
            return $query->row();
        } else {
            return false;
        }
    }

    function get_berita_where($condition)
    {
        $query = $this->db->get_where($this->tablename, $condition);
        if ($query != null) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function find_slug($slug)
    {
        // $query = $this->db->get_where($this->tablename, array('url_slug' => $slug));
        // if ($query != null) {
        //     return $query->row();
        // } else {
        //     return false;
        // }

        $this->db->select('berita.judul, berita.jumlahbaca, berita.id, berita.id_pengirim, berita.id_kategori, berita.gambar, berita.softdelete, berita.url_slug, berita.isi, berita.updated_at, pengirim.nama as sender, kategori.nama as kate');
        $this->db->where('berita.url_slug', $slug);
        $this->db->from('berita');
        $this->db->join('pengirim', 'berita.id_pengirim = pengirim.id');
        $this->db->join('kategori', 'kategori.id = berita.id_kategori');
        return $this->db->get()->row();
    }

    public function find_berita_terkait($id_kategori, $id_berita)
    {
        $this->db->select('berita.judul, berita.id, berita.url_slug');
        $this->db->where('berita.id_kategori', $id_kategori);
        $this->db->from('berita');
        $bt = $this->db->get()->result();

        $data = array();
        foreach($bt as $value){
            if($value->id != $id_berita){
                array_push($data, $value);
            }
        }
        return $data;
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

    public function get_beritarelasi($field=null, $id=null){
        $this->db->select('berita.judul, berita.id, berita.id_pengirim, berita.id_kategori, berita.gambar, berita.softdelete, berita.url_slug, berita.isi, berita.updated_at, pengirim.nama as sender, kategori.nama as kate');
        if ($field != null) {
            $this->db->where($field, $id);
        }
        $this->db->from('berita');
        $this->db->join('pengirim', 'berita.id_pengirim = pengirim.id');
        $this->db->join('kategori', 'kategori.id = berita.id_kategori');
        $this->db->order_by("berita.updated_at", "DESC");
        return $this->db->get()->result();
    }

    public function tanggal_beda()
    {
        $this->db->distinct();
        $this->db->select('DATE(updated_at)');
        $this->db->from($this->tablename);
        return $this->db->get()->result();
    }

    public function get_by_date($date){
        $this->db->select('berita.judul, berita.jumlahbaca, berita.id, berita.id_pengirim, berita.id_kategori, berita.gambar, berita.softdelete, berita.url_slug, berita.isi, berita.updated_at, pengirim.nama as sender, kategori.nama as kate');
        $this->db->where('DATE(berita.updated_at)', $date);
        $this->db->from($this->tablename);
        $this->db->join('pengirim', 'berita.id_pengirim = pengirim.id');
        $this->db->join('kategori', 'kategori.id = berita.id_kategori');
        return $this->db->get()->result();
    }
}
