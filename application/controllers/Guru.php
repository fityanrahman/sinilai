<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Guru extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Cek apakah user login 
    // sebagai administrator
    $this->isAdmin();

    // Load model events
    $this->load->model('model_guru');
  }

  public function index()
  {
    // Load library pagination
    // $this->load->library('pagination');
 
    // // Pengaturan pagination
    // $config['base_url'] = base_url('guru/index/');
    // $config['total_rows'] = $this->model_guru->get()->num_rows();
    // $config['per_page'] = 8;
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
    $data['pageTitle'] = 'Data Guru';
    // $data['guru'] = $this->model_guru->get_offset($config['per_page'], $config['offset'])->result();
    $data['guru'] = $this->model_guru->get_offset()->result();
    $data['pageContent'] = $this->load->view('guru/guruList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nip' => $this->input->post('nip'),
          'nama_guru' => $this->input->post('nama_guru'),
          'tmp_lahir' => $this->input->post('tmp_lahir'),
          'tgl_lahir' => date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'agama' => $this->input->post('agama'),
          'merit' => $this->input->post('merit'),
          'tlp' => $this->input->post('tlp'),
          'email' => $this->input->post('email'),
          'idmapel' => $this->input->post('idmapel'),
          'iduser_guru' => $this->input->post('iduser_guru'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_guru->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan Data Guru');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan Data Guru');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('guru/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data Guru';
    $data['iduser'] = $this->model_guru->getLastID()->row();
    $data['mapel'] = $this->model_guru->getListMapel();
    $data['pageContent'] = $this->load->view('guru/guruAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function edit($nip = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nip' => $this->input->post('nip'),
          'nama_guru' => $this->input->post('nama_guru'),
          'tmp_lahir' => $this->input->post('tmp_lahir'),
          'tgl_lahir' => date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'agama' => $this->input->post('agama'),
          'merit' => $this->input->post('merit'),
          'tlp' => $this->input->post('tlp'),
          'email' => $this->input->post('email'),
          'idmapel' => $this->input->post('idmapel'),
          'iduser_guru' => $this->input->post('iduser_guru'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_guru->update($nip, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui Mata Pelajaran');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui Mata Pelajaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('guru/edit/'.$nip, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $guru = $this->model_guru->get_where(array('nip' => $nip))->row();
    
  
    // Jika data user tidak ada maka show 404
    if (!$guru) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data Guru';
    $data['guru'] = $guru;
    $data['mapel'] = $this->model_guru->getListMapel();
    $data['pageContent'] = $this->load->view('guru/guruEdit', $data, TRUE);

    // $search = $this->input->post('idmapel');
    // $view_data['search'] = $search;

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function delete($nip)
  {
    // Ambil data user dari database
    $guru = $this->model_guru->get_where(array('nip' => $nip))->row();

    // Jika data user tidak ada maka show 404
    if (!$guru) show_404();

    // Jalankan function delete pada model_events
    $query = $this->model_guru->delete($nip);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus event');
    else $message = array('status' => true, 'message' => 'Gagal menghapus event');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('guru', 'refresh');
  }
}