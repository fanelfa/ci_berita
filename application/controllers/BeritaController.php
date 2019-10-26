<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class BeritaController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model(array('BeritaModel','PengirimModel', 'KategoriModel'));
        $this->asset = base_url() . "asset/";
    }

    public function index()
    {
        $data['header'] = $this->load->view('berita/layout/header', '', TRUE);
        $data['footer'] = $this->load->view('berita/layout/footer', '', TRUE);
        $this->load->view('berita/index', $data);
    }


    public function create()
    {
        $pengirim = $this->PengirimModel->read();
        $kategori = $this->KategoriModel->read();

        $data['pengirim'] = $pengirim;
        $data['kategori'] = $kategori;

        $data['header'] = $this->load->view('berita/layout/header', '', TRUE);
        $data['footer'] = $this->load->view('berita/layout/footer', '', TRUE);
        $this->load->view('berita/create', $data);
    }

    public function store()
    {
        $extension = '';
        $nama_file_baru = "beritax".((string)$this->input->post('pengirim'))."x". ((string) $this->input->post('kategori'))."x". ((string)date("d-m-Y"));
        if (!empty($_FILES['gambar']['name'])) {
            $this->upload_image('gambar',$nama_file_baru);
            $extension = str_replace('image/','', $_FILES['gambar']['type']);
        }

        $data = array(
            'judul' => $this->input->post('judul'),
            'isi' => $this->input->post('isi'),
            'gambar' => ($extension==''?'': base_url() . "storage/berita/" . $nama_file_baru . "." . $extension),
            'softdelete' => $this->input->post('softdelete'),
            'id_kategori' => $this->input->post('kategori'),
            'id_pengirim' => $this->input->post('pengirim'),
        );

        $b = $this->BeritaModel;
        if ($b->create($data)) {
            echo 'Sukses';
        } else {
            echo 'Gagal create data';
        }
    }

    public function upload_image($nama_file_form, $nama_file_baru){
        $config['upload_path']          = './storage/berita/';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['file_name']            = $nama_file_baru;
        $config['overwrite']			= true;
        $config['max_size']             = 5120; // 5MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($nama_file_form)) {
            $error = array('error' => $this->upload->display_errors());
            // print_r($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            // print_r($data);
            // return $data;
        } 
    }

    public function show($id)
    { }

    public function edit($id)
    {
        echo "edit id = $id";
    }

    public function update($id)
    {

    }

    public function destroy($id)
    {
        if ($this->BeritaModel->delete($id)) {
            echo 'Deleted!';
        } else {
            echo 'Gagal delete';
        }
    }

}
