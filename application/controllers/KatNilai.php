<?php defined('BASEPATH') OR exit('No direct script access allowed');

class KatNilai extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Load model events
    $this->load->model('model_kat_nilai');
  }

  public function index()
  {
    // Load library pagination
    // $this->load->library('pagination');
 
    // // Pengaturan pagination
    // $config['base_url'] = base_url('katnilai/index/');
    // $config['total_rows'] = $this->model_kat_nilai->get()->num_rows();
    // $config['per_page'] = 5;
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

    // Ambil data nilai dari database
    // $judulnilai = $this->model_kat_nilai->get()->row();

    // Data untuk page index
    $data['pageTitle'] = 'Data Kategori Nilai';
    if($this->session->userdata('level') === '2'){
      $array_where = array(
          'iduser_guru'   => $this->session->userdata('id'),
      );
      // $data['kat_nilai'] = $this->model_kat_nilai->get_offset($config['per_page'], $config['offset'], $array_where)->result();
    $data['kat_nilai'] = $this->model_kat_nilai->get_offset($array_where)->result();
    }else if ($this->session->userdata('level') === '3'){
      $array_where = array(
        'iduser_siswa' => $this->session->userdata('id'),
        // 'idkelas' => $nilai->idkelas,
    );
    $data['kat_nilai'] = $this->model_kat_nilai->get_offset($array_where)->result();
    } else{
    $data['kat_nilai'] = $this->model_kat_nilai->get_offset()->result();
    }
    // $data['judulnilai'] =$judulnilai;
    $data['pageContent'] = $this->load->view('katNilai/katNilaiList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function detail($id)
  {

    // Ambil data user dari database

    // Data untuk page detail
    $data['pageTitle'] = 'Data kat_nilai';
    $data['kat_nilai'] = $this->model_kat_nilai->get_where(array('id' => $id))->row();
    $data['pageContent'] = $this->load->view('katnilai/kat_nilaiDetail', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add()
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_nilai', 'Nama_nilai', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'id' => $this->input->post('id'),
          'nama_nilai' => $this->input->post('nama_nilai'),
          'tgl' => date_format(date_create($this->input->post('tgl')), 'Y-m-d'),
          'idmapel' => $this->input->post('idmapel'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_kat_nilai->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan Data Kategori Nilai');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan Data Kategori Nilai');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('katnilai/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data Kategori Nilai';
    $data['katnilai'] = $this->model_kat_nilai->get_idmapel($this->session->userdata('id'))->row();
    // $data['katnilai'] = $this->model_kat_nilai->getListKatNilai($this->session->userdata('id'))->result();
    $data['pageContent'] = $this->load->view('katnilai/katnilaiadd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nama_nilai', 'Nama_nilai', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'id' => $this->input->post('id'),
          'nama_nilai' => $this->input->post('nama_nilai'),
          'tgl' => date_format(date_create($this->input->post('tgl')), 'Y-m-d'),
          'idmapel' => $this->input->post('idmapel'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_kat_nilai->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui Mata Pelajaran');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui Mata Pelajaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('KatNilai/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $kat_nilai = $this->model_kat_nilai->get_where(array('id' => $id))->row();
    
  
    // Jika data user tidak ada maka show 404
    if (!$kat_nilai) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data kat_nilai';
    $data['kat_nilai'] = $kat_nilai;
    // $data['kelas'] = $this->model_kat_nilai->getListKelas();
    $data['pageContent'] = $this->load->view('katNilai/katNilaiEdit', $data, TRUE);

    // $search = $this->input->post('idmapel');
    // $view_data['search'] = $search;

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data user dari database
    $kat_nilai = $this->model_kat_nilai->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$kat_nilai) show_404();

    // Jalankan function delete pada model_events
    $query = $this->model_kat_nilai->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus event');
    else $message = array('status' => true, 'message' => 'Gagal menghapus event');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('katnilai', 'refresh');
  }
}