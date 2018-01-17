<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Siswa extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Load model events
    $this->load->model('model_siswa');
  }

  public function index()
  {
    // Load library pagination
    $this->load->library('pagination');
 
    // Pengaturan pagination
    $config['base_url'] = base_url('siswa/index/');
    $config['total_rows'] = $this->model_siswa->get()->num_rows();
    $config['per_page'] = 5;
    $config['offset'] = $this->uri->segment(3);
 
    // Styling pagination
    $config['first_link'] = false;
    $config['last_link'] = false;
 
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
 
    $config['num_tag_open'] = '<li class="waves-effect">';
    $config['num_tag_close'] = '</li>';
 
    $config['prev_tag_open'] = '<li class="waves-effect">';
    $config['prev_tag_close'] = '</li>';
 
    $config['next_tag_open'] = '<li class="waves-effect">';
    $config['next_tag_close'] = '</li>';
 
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';

    $this->pagination->initialize($config);

    // Data untuk page index
    $data['pageTitle'] = 'Data Siswa';
    $data['siswa'] = $this->model_siswa->get_offset($config['per_page'], $config['offset'])->result();
    $data['pageContent'] = $this->load->view('siswa/siswaList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function detail($nis)
  {

    // Ambil data user dari database

    // Data untuk page detail
    $data['pageTitle'] = 'Data Siswa';
    $data['siswa'] = $this->model_siswa->get_where(array('nis' => $nis))->row();
    $data['pageContent'] = $this->load->view('siswa/siswaDetail', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_siswa', 'Nama siswa', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'nama_siswa' => $this->input->post('nama_siswa'),
          'tmp_lahir' => $this->input->post('tmp_lahir'),
          'tgl_lahir' => date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'nama_ayah' => $this->input->post('nama_ayah'),
          'nama_ibu' => $this->input->post('nama_ibu'),
          'agama' => $this->input->post('agama'),
          'idkelas' => $this->input->post('idkelas'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_siswa->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan Data siswa');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan Data siswa');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('siswa/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data siswa';
    $data['kelas'] = $this->model_siswa->getListKelas();
    $data['pageContent'] = $this->load->view('siswa/siswaAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function edit($nis = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_siswa', 'Nama siswa', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'nis' => $this->input->post('nis'),
          'nama_siswa' => $this->input->post('nama_siswa'),
          'tmp_lahir' => $this->input->post('tmp_lahir'),
          'tgl_lahir' => date_format(date_create($this->input->post('tgl_lahir')), 'Y-m-d'),
          'jk' => $this->input->post('jk'),
          'alamat' => $this->input->post('alamat'),
          'nama_ayah' => $this->input->post('nama_ayah'),
          'nama_ibu' => $this->input->post('nama_ibu'),
          'agama' => $this->input->post('agama'),
          'idkelas' => $this->input->post('idkelas'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_siswa->update($nis, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui Mata Pelajaran');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui Mata Pelajaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('siswa/edit/'.$nis, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $siswa = $this->model_siswa->get_where(array('nis' => $nis))->row();
    
  
    // Jika data user tidak ada maka show 404
    if (!$siswa) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data siswa';
    $data['siswa'] = $siswa;
    $data['kelas'] = $this->model_siswa->getListKelas();
    $data['pageContent'] = $this->load->view('siswa/siswaEdit', $data, TRUE);

    // $search = $this->input->post('idmapel');
    // $view_data['search'] = $search;

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function delete($nis)
  {
    // Ambil data user dari database
    $siswa = $this->model_siswa->get_where(array('nis' => $nis))->row();

    // Jika data user tidak ada maka show 404
    if (!$siswa) show_404();

    // Jalankan function delete pada model_events
    $query = $this->model_siswa->delete($nis);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus event');
    else $message = array('status' => true, 'message' => 'Gagal menghapus event');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('siswa', 'refresh');
  }
}