<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class PengirimController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('PengirimModel');
        $this->asset = base_url()."asset/";
    }

    public function index()
    {
        // echo "<b>index pengirim</b>";
        // echo $this->asset;
        
        $p = $this->PengirimModel;
        print_r($p->read());
    }

    public function create()
    {
        echo 'ini pengirim/create';
    }
    
    public function store()
    {
        $data = array(
            'nama' => 'Fandi Ilham',
            'bio' => 'Cah Ndeso',
        );

        $p = $this->PengirimModel;
        if ($p->create($data)) {
            echo 'Sukses';
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

    }

    public function destroy($id)
    {
        if($this->PengirimModel->delete($id)){
            echo 'Deleted!';
        }else{
            echo 'Gagal delete';
        }
    }

}
