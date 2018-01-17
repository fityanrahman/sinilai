<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Load model events
    $this->load->model('model_saran');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Saran';
    $data['pageContent'] = $this->load->view('saran/saran', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('perihal', 'perihal', 'required');

      // Mengatur validasi data contact,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('saran', 'saran', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'perihal' => $this->input->post('perihal'),
          'saran' => $this->input->post('saran'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_saran->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan saran<br>Terima Kasih :)');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan saran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('saran', 'refresh');   
      } 
    }

    // Data untuk page user/add
    $data['pageTitle'] = 'Tambah Data Saran';
    $data['pageContent'] = $this->load->view('saran/saran', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

}