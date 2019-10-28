<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

use Carbon\Carbon;

class BeritaController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model(array('BeritaModel','PengirimModel', 'KategoriModel'));
        $this->asset = base_url() . "asset/";

        Carbon::setLocale('id');
    }

    public function index($slug='')
    {
        $data['header'] = $this->load->view('berita/layout/header', '', TRUE);
        $data['footer'] = $this->load->view('berita/layout/footer', '', TRUE);

        $data['berita'] = array();
        if($slug==''){
            $berita = $this->BeritaModel->read();
            foreach($berita as $value){
                if($value->softdelete=='f'){
                    $value->waktu = Carbon::parse($value->updated_at, 'UTC')->format('d F Y');
                    array_push($data['berita'], $value);
                }
            }
            $this->load->view('berita/index', $data);
        }else{
            $berita = $this->BeritaModel->find_slug($slug);

            if ($this->cek_session($berita->id)) {
                $this->update_jumlah_baca($berita->id);
            }

            $data['berita_terkait'] = $this->BeritaModel->find_berita_terkait($berita->id_kategori, $berita->id);
            $data['berita'] = $berita;
            $data['waktu'] =  Carbon::parse($berita->updated_at, 'UTC')->format('d F Y'); 
            $this->load->view('berita/detail', $data);
        }
    }

    public function potong_paragraf($string, $char_max, $link){
        $string = strip_tags($string);
        if (strlen($string) > $char_max) {

            // truncate string
            $stringCut = substr($string, 0, $char_max);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);

            $str = '<p class="f1-s-1 cl6 p-b-24">';
            $str .= $string;
            $str .= '</p>';
            $str .= '<a href="'.$link.'" class="f1-s-1 cl9 hov-cl10 trans-03">';
            $str .= '    Baca Selengkapnya';
            $str .= '    <i class="m-l-2 fa fa-long-arrow-alt-right"></i>';
            $str .= '</a>';
        }
        return $str;
    }

    public function admin_index()
    {

        $data = [
            'pengirim' => $this->PengirimModel->read(),
            'kategori' => $this->KategoriModel->read(),
            'p_punya_berita' => $this->PengirimModel->get_p_punya_berita(),
            'k_punya_berita' => $this->KategoriModel->get_k_punya_berita(),
            'date' => $this->BeritaModel->tanggal_beda(),
            'berita' => $this->BeritaModel->get_beritarelasi(),
        ];

        // print_r($data['date']);
        $this->load->view('admin/berita/index', $data);
    }

    function get_berita_by($field, $id)
    {
        $data = [
            'pengirim' => $this->PengirimModel->read(),
            'kategori' => $this->KategoriModel->read(),
            'p_punya_berita' => $this->PengirimModel->get_p_punya_berita(),
            'k_punya_berita' => $this->KategoriModel->get_k_punya_berita(),
            'date' => $this->BeritaModel->tanggal_beda(),
            'berita' => $this->BeritaModel->get_beritarelasi($field, $id),
        ];

        $this->load->view('admin/berita/index', $data);
    }

    function get_berita_by_date($date)
    {
        $data = [
            'pengirim' => $this->PengirimModel->read(),
            'kategori' => $this->KategoriModel->read(),
            'p_punya_berita' => $this->PengirimModel->get_p_punya_berita(),
            'k_punya_berita' => $this->KategoriModel->get_k_punya_berita(),
            'date' => $this->BeritaModel->tanggal_beda(),
            'berita' => $this->BeritaModel->get_by_date($date),
        ];

        $this->load->view('admin/berita/index', $data);
    }

    public function store()
    {
        $extension = '';
        $slug = $this->generate_url_slug($this->input->post('judul'), 'berita');
        if (!empty($_FILES['gambar']['name'])) {
            $this->upload_image('gambar',$slug);
            $extension = str_replace('image/','', $_FILES['gambar']['type']);
        }

        $data = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'gambar' => ($extension==''?'': base_url() . "storage/berita/" . $slug . "." . $extension),
            'url_slug' => $slug,
            'softdelete' => $this->input->post('softdelete'),
            'id_kategori' => $this->input->post('kategori'),
            'id_pengirim' => $this->input->post('pengirim'),
        );

        $b = $this->BeritaModel;
        if ($b->create($data)) {
            redirect('/admin/berita/', 'refresh');
        } else {
            echo 'Gagal create data';
        }
    }

    public function upload_image($nama_file_form, $nama_file_baru){
        $config['upload_path']          = './storage/berita/';
        $config['allowed_types']        = 'jpg|png|jpeg';
        $config['file_name']            = $nama_file_baru;
        $config['overwrite']			= true;
        $config['max_size']             = 5120;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($nama_file_form)) {
            $error = array('error' => $this->upload->display_errors());
        } else {
            $data = array('upload_data' => $this->upload->data());
        } 
    }

    public function update($id)
    {
        $slug = $this->generate_url_slug($this->input->post('judul'), 'berita');
        $dt = new DateTime();
        $data = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'url_slug' => $slug,
            'softdelete' => $this->input->post('softdelete'),
            'id_kategori' => $this->input->post('kategori'),
            'id_pengirim' => $this->input->post('pengirim'),
            'updated_at' => $dt->format('Y-m-d H:i:s'),
        );

        $extension = '';
        if (!empty($_FILES['gambar']['name'])) {
            $this->upload_image('gambar',$slug);
            $extension = str_replace('image/','', $_FILES['gambar']['type']);

            $gambar = ($extension == '' ? '' : base_url() . "storage/berita/" . $slug . "." . $extension);
            $data['gambar'] = $gambar;
        }

        $b = $this->BeritaModel;
        if ($b->update($this->input->post('id'), $data)) {
            redirect('/admin/berita/', 'refresh');
        } else {
            echo 'Gagal create data';
        }

    }

    public function destroy($id)
    {
        if ($this->BeritaModel->delete($this->input->post('id'))) {
            redirect('/admin/berita/', 'refresh');
        } else {
            echo 'Gagal delete';
        }
    }

    function generate_url_slug($string, $table, $field = 'url_slug', $key = NULL, $value = NULL)
    {
        $t = &get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array();
        $params[$field] = $slug;

        if ($key) $params["$key !="] = $value;

        while ($t->db->where($params)->get($table)->num_rows()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

            $params[$field] = $slug;
        }
        return $slug;
    }

    function cek_session($id_berita)
    {
        if (isset($_SESSION['id_berita'])){
            if(!in_array($id_berita, $_SESSION['id_berita'])){
                array_push($_SESSION['id_berita'],$id_berita);
                return 1;
            }else return 0;
        } 
        else {
            $_SESSION['id_berita'] = array();
            array_push($_SESSION['id_berita'], $id_berita);
            return 1;
        }
    }

    function lihat_session()
    {
        if (isset($_SESSION['id_berita'])) {
            print_r($_SESSION['id_berita']);
        } else {
            echo 'No Session, Please read a blog first';
        }
    }

    function update_jumlah_baca($id){
        $b = $this->BeritaModel;
        $jml_baca_from_db = $this->BeritaModel->find($id)->jumlahbaca;
        if($jml_baca_from_db == null or $jml_baca_from_db == 0){
            $b->update($id, ['jumlahbaca'=>1]);
        }else{
            $b->update($id, ['jumlahbaca' => $jml_baca_from_db + 1]);
        }
    }


}
