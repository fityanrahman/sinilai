<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nilai extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Cek apakah user sudah login
    $this->cekLogin();

    // Load model events
    $this->load->model('model_nilai');
    $this->load->model('model_kat_nilai');
    $this->load->model('model_siswa');
  }

  public function index($idkat=null)
  {
    // // Load library pagination
    // $this->load->library('pagination');
 
    // // Pengaturan pagination
    // $config['base_url'] = base_url('nilai/index/');
    // $config['total_rows'] = $this->model_nilai->get()->num_rows();
    // $config['per_page'] = 5;
    // $config['offset'] = $this->uri->segment(5);
 
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
    $nilai = $this->model_nilai->get_where(array('idkat' => $idkat))->row();
  

    // Data untuk page index
    $data['pageTitle'] = 'Data Nilai';
    if($this->session->userdata('level') === '2'){
        $array_where = array(
            'idkat' =>   $idkat,
            'iduser_guru'   => $this->session->userdata('id'),
        );
    $data['nilai'] = $this->model_nilai->get_offset($array_where)->result();
    }else if ($this->session->userdata('level') === '3'){
      $array_where = array(
        'idkat' =>   $idkat,
        'iduser_siswa' => $this->session->userdata('id'),
        'idkelas' => $nilai->idkelas,
    );
    $data['nilai'] = $this->model_nilai->get_offset($array_where)->result();
    // $data['nilai2'] = $nilai2;
    } else{
    $data['nilai'] = $this->model_nilai->get_offset(array('idkat' => $idkat))->result();
    // $data['nilai2'] = $nilai2;
    }
    $data['pageContent'] = $this->load->view('nilai/nilaiList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function mapel($idmapel){
    // Load library pagination
    $this->load->library('pagination');
 
    // Pengaturan pagination
    $config['base_url'] = base_url('nilai/index/');
    $config['total_rows'] = $this->model_nilai->get()->num_rows();
    $config['per_page'] = 5;
    $config['offset'] = $this->uri->segment(5);
 
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

    // Ambil data nilai dari database
    $nilai = $this->model_nilai->get_where(array('idmapel' => $idmapel))->row();
  
    // Data untuk page index
    $data['pageTitle'] = 'Data Nilai';
    if($this->session->userdata('level') === '2'){
        $array_where = array(
            'idmapel' =>   $idmapel,
            'iduser_guru'   => $this->session->userdata('id'),
        );
    $data['nilai'] = $this->model_nilai->get_offset($array_where)->result();
    }else if ($this->session->userdata('level') === '3'){
      $array_where = array(
        'idmapel' =>   $idmapel,
        'iduser_siswa' => $this->session->userdata('id'),
        'idkelas' => $nilai->idkelas,
    );
    $data['nilai'] = $this->model_nilai->get_offset($array_where)->result();
    // $data['nilai2'] = $nilai2;
    } else{
    $data['nilai'] = $this->model_nilai->get_offset(array('idmapel' => $idmapel))->result();
    // $data['nilai2'] = $nilai2;
    }
    $data['pageContent'] = $this->load->view('nilai/nilaiList', $data, TRUE);

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
      $this->form_validation->set_rules('nilai', 'Nama siswa', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'id' => $this->input->post('id'),
          'nilai' => $this->input->post('nilai'),
          'catatan' => $this->input->post('catatan'),
          'idsiswa' => $this->input->post('idsiswa'),
          'idkat' => $this->input->post('idkat'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_nilai->insert($data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil menambahkan Data siswa');
        else $message = array('status' => true, 'message' => 'Gagal menambahkan Data siswa');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('nilai/add', 'refresh');
      } 
    }
    
    // Data untuk page users/add
    $data['pageTitle'] = 'Tambah Data siswa';
    // if($this->session->userdata('level') === '2'){
    // $data['katnilai'] = $this->model_kat_nilai->get_where(array('iduser_guru' => $this->session->userdata('id')))->result();
    // } else{
    $data['katnilai'] = $this->model_kat_nilai->get()->result();
    // }
    $data['kelas'] = $this->model_nilai->getListKelas();
    $data['pageContent'] = $this->load->view('nilai/nilaiAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  function ambil_data(){

    $modul=$this->input->post('modul');
    $id=$this->input->post('id');
    
    if($modul=="nama_siswa"){
    echo $this->model_nilai->siswa($id);
    }
  
    }

  public function edit($id_nilai = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data nama event,
      // # required = tidak boleh kosong
      $this->form_validation->set_rules('nilai', 'nilai', 'required');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'id' => $this->input->post('id'),
          'nilai' => $this->input->post('nilai'),
          'catatan' => $this->input->post('catatan'),
          'idsiswa' => $this->input->post('idsiswa'),
          'idkat' => $this->input->post('idkat'),
        );

        // Jalankan function insert pada model_events
        $query = $this->model_nilai->update($id_nilai, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui Mata Pelajaran');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui Mata Pelajaran');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('nilai/edit/'.$id_nilai, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $nilai = $this->model_nilai->get_where(array('id' => $id_nilai))->row();
  
  
    // Jika data user tidak ada maka show 404
    if (!$nilai) show_404();

    // Data untuk page users/add
    $data['pageTitle'] = 'Edit Data siswa';
    $data['nilai'] = $nilai;
    // $data['nilai'] = $this->model_siswa->getListKelas();
    $data['pageContent'] = $this->load->view('nilai/nilaiEdit', $data, TRUE);

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