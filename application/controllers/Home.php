<?php defined("BASEPATH") OR exit("No direct script access allowed");

  class Home extends MY_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->cekLogin();
    }
    public function index()
    {
      // Data ini akan ditampilkan di header.php pada tag <title>
      $data["pageTitle"] = "Beranda | Sistem Informasi Nilai Al-Ishlah";

      // Data ini akan ditampilkan di content.php
      $data['pageContent'] = $this->load->view('home/index', $data, TRUE);

      // Memanggil view layout.php
       $this->load->view("incsite/layout", $data);
    }
  }