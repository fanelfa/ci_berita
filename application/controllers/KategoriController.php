<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class KategoriController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('KategoriModel');
        $this->asset = base_url() . "asset/";
    }

    public function index()
    {
        $p = $this->KategoriModel;
        $data['kategori'] = $p->read();
        $this->load->view('admin/kategori/index', $data);
    }

    public function create()
    {
    }

    public function store()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );

        $p = $this->KategoriModel;
        if ($p->create($data)) {
            redirect('/admin/kategori/', 'refresh');
        } else {
            echo 'Gagal create data';
        }
    }

    public function show($id)
    { }

    public function edit($id)
    {
    }

    public function update($id)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
        );

        $p = $this->KategoriModel;
        if ($p->update($this->input->post('id'), $data)) {
            redirect('/admin/kategori/', 'refresh');
        } else {
            echo 'Gagal create data';
        }
    }

    public function destroy($id)
    {
        if ($this->KategoriModel->delete($this->input->post('id'))) {
            redirect('/admin/kategori/', 'refresh');
        } else {
            echo 'Gagal delete';
        }
    }
}
