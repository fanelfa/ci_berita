<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PengirimController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('PengirimModel');
        $this->asset = base_url()."asset/";
    }

    public function index()
    {        
        $p = $this->PengirimModel;
        $data['pengirim'] = $p->read();
        $this->load->view('admin/pengirim/index', $data);
    }

    public function create()
    {
        echo 'ini pengirim/create';
    }
    
    public function store()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'bio' => $this->input->post('bio'),
        );

        $p = $this->PengirimModel;
        if ($p->create($data)) {
            redirect('/admin/pengirim/', 'refresh');
        } else {
            echo 'Gagal create data';
        }
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        echo "edit id = $id";
    }

    public function update($id)
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'bio' => $this->input->post('bio'),
        );

        $p = $this->PengirimModel;
        if ($p->update($this->input->post('id'), $data)) {
            redirect('/admin/pengirim/', 'refresh');
        } else {
            echo 'Gagal create data';
        }
    }

    public function destroy($id)
    {
        if($this->PengirimModel->delete($this->input->post('id'))){
            redirect('/admin/pengirim/', 'refresh');
        }else{
            echo 'Gagal delete';
        }
    }


}
