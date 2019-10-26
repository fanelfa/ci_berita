<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class KategoriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('KategoriModel');
        $this->asset = base_url() . "asset/";
    }

    public function index()
    {
        $p = $this->KategoriModel;
        print_r($p->read());
    }

    public function create()
    {
        echo 'ini pengirim/create';
    }

    public function store()
    {
        $data = array(
            'nama' => 'Teknologi',
        );

        $p = $this->KategoriModel;
        if ($p->create($data)) {
            echo 'Sukses';
        } else {
            echo 'Gagal create data';
        }
    }

    public function show($id)
    { }

    public function edit($id)
    {
        echo "edit id = $id";
    }

    public function update($id)
    { }

    public function destroy($id)
    {
        if ($this->KategoriModel->delete($id)) {
            echo 'Deleted!';
        } else {
            echo 'Gagal delete';
        }
    }
}
