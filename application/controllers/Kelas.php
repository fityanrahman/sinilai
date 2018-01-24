<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Cek apakah user login 
    // sebagai administrator
    $this->isAdmin();

    // Load model events
    $this->load->model('model_kelas');
  }

  public function index()
  {
    // // Load library pagination
    // $this->load->library('pagination');
 
    // // Pengaturan pagination
    // $config['base_url'] = base_url('kelas/index/');
    // $config['total_rows'] = $this->model_kelas->get()->num_rows();
    // $config['per_page'] = 9;
    // $config['offset'] = $this->uri->segment(3);
 
    // // Styling pagination
    // $config['first_link'] = false;
    // $config['last_link'] = false;
 
    // $config['full_tag_open'] = '<ul class="pagination">';
    // $config['full_tag_close'] = '</ul>';
 
    // $config['num_tag_open'] = '<li class="waves-effect">';
    // $config['num_tag_close'] = '</li>';
 
    // $config['prev_tag_open'] = '<li class="waves-effect">';
    // $config['prev_tag_close'] = '</li>';
 
    // $config['next_tag_open'] = '<li class="waves-effect">';
    // $config['next_tag_close'] = '</li>';
 
    // $config['cur_tag_open'] = '<li class="active"><a href="#">';
    // $config['cur_tag_close'] = '</a></li>';

    // $this->pagination->initialize($config);

    // Data untuk page index
    $data['pageTitle'] = 'Kelas';
    $data['kelas'] = $this->model_kelas->get_offset()->result();
    $data['pageContent'] = $this->load->view('kelas/kelasList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_kelas', 'Nama Kelas', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nama_kelas' => $this->input->post('nama_kelas'),
          'idwalikelas' => $this->input->post('idwalikelas'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_kelas->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan Kelas');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan Kelas');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('kelas/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data Kelas';
    $data['walikelas'] = $this->model_kelas->getListWalikelas();
    $data['pageContent'] = $this->load->view('kelas/kelasAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama', 'Nama Kelas', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nama' => $this->input->post('nama'),
          'nama_walikelas' => $this->input->post('nama_walikelas'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_kelas->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui Kelas');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui Kelas');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('kelas/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $kelas = $this->model_kelas->get_where(array('id' => $id))->row();
    
  
    // Jika data user tidak ada maka show 404
    if (!$kelas) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data Kelas';
    $data['kelas'] = $kelas;
    $data['walikelas'] = $this->model_kelas->getListWalikelas();
    $data['pageContent'] = $this->load->view('kelas/kelasEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data user dari database
    $user = $this->model_kelas->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$user) show_404();

    // Jalankan function delete pada model_events
    $query = $this->model_kelas->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus event');
    else $message = array('status' => true, 'message' => 'Gagal menghapus event');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('kelas', 'refresh');
  }
}