<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

  public function __construct()
  {
    parent::__construct();
    
    // Check apakah sudah login
    $this->cekLogin();

    // Cek apakah user login 
    // sebagai administrator
    $this->isAdmin();

    // Load model user
    $this->load->model('model_user');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'User';
    $data['user'] = $this->model_user->get()->result();
    $data['pageContent'] = $this->load->view('user/userList', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function add($alamat=null)
  {
    $this->session->set_userdata('alamat', $this->agent->referrer());
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data username,
      // # required = tidak boleh kosong
      // # min_length[5] = username harus terdiri dari minimal 5 karakter
      // # is_unique[user.username] = username harus bernilai unique, 
      //   tidak boleh sama dengan record yg sudah ada pada tabel user
      // $this->form_validation->set_rules('id', 'Id', 'required|min_length[5]|is_unique[user.ni]|is_unique[user.ni]');

      // Mengatur validasi data username,
      // # required = tidak boleh kosong
      // # min_length[5] = username harus terdiri dari minimal 5 karakter
      // # is_unique[user.username] = username harus bernilai unique, 
      //   tidak boleh sama dengan record yg sudah ada pada tabel user
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');

      // Mengatur validasi data password,
      // # required = tidak boleh kosong
      // # min_length[3] = password harus terdiri dari minimal 3 karakter
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');

      // Mengatur validasi data level,
      // # required = tidak boleh kosong
      // # in_list[administrator, alumni] = hanya boleh bernilai 
      //   salah satu di antara administrator atau alumni
      $this->form_validation->set_rules('level', 'Level', 'required|in_list[1,2,3]');

      // Mengatur validasi data active,
      // # required = tidak boleh kosong
      // # in_list[0, 1] = hanya boleh bernilai 
      // salah satu di antara 0 atau 1
      $this->form_validation->set_rules('active', 'Active', 'required|in_list[0,1]');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'id' => $this->input->post('id'),
          'username' => $this->input->post('username'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'level' => $this->input->post('level'),
          'active' => $this->input->post('active')
        );

        // Jalankan function insert pada model_user
        $query = $this->model_user->insert($data);

        $ket='';
        if ($alamat=='guru'){
          $ket='guru';
        } else if ($alamat=='siswa'){
          $ket='siswa';
        } else if ($alamat=='admin'){
          $ket='admin';
        }


        // cek jika query berhasil
        if ($query) {
          $message = array('status' => true, 'message' => 'Berhasil menambahkan user '.$ket);
        } else {
          $message = array('status' => true, 'message' => 'Gagal menambahkan user '.$ket);
        }
        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);


        if ($alamat=='guru'){
          redirect('guru/add', 'refresh');
        } else if ($alamat=='siswa'){
          redirect('siswa/add', 'refresh');
        } else {
        // refresh page
        redirect('user/add', 'refresh');
        }

        
      } 
    }
    
    // Data untuk page user/add
    $data['pageTitle'] = 'Tambah Data User';
    $data['ket'] = $alamat;
    $data['pageContent'] = $this->load->view('user/userAdd', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function edit($id = null)
  {
    // Jika form di submit jalankan blok kode ini
    if ($this->input->post('submit')) {
      
      // Mengatur validasi data password,
      // # required = tidak boleh kosong
      // # min_length[5] = password harus terdiri dari minimal 5 karakter
      $this->form_validation->set_rules('username', 'Username', 'required|min_length[5]');

      // Mengatur validasi data password,
      // # required = tidak boleh kosong
      // # min_length[3] = password harus terdiri dari minimal 3 karakter
      $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]');

      // Mengatur validasi data level,
      // # required = tidak boleh kosong
      // # in_list[administrator, alumni] = hanya boleh bernilai 
      //   salah satu di antara administrator atau alumni
      $this->form_validation->set_rules('level', 'Level', 'required|in_list[1,2,3]');

      // Mengatur validasi data active,
      // # required = tidak boleh kosong
      // # in_list[0, 1] = hanya boleh bernilai 
      // salah satu di antara 0 atau 1
      $this->form_validation->set_rules('active', 'Active', 'required|in_list[0,1]');

      // Mengatur pesan error validasi data
      $this->form_validation->set_message('required', '%s tidak boleh kosong!');
      $this->form_validation->set_message('min_length', '%s minimal %d karakter!');

      // Jalankan validasi jika semuanya benar maka lanjutkan
      if ($this->form_validation->run() === TRUE) {

        $data = array(
          'username' => $this->input->post('username'),
          'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
          'level' => $this->input->post('level'),
          'active' => $this->input->post('active')
        );

        // Jalankan function insert pada model_user
        $query = $this->model_user->update($id, $data);

        // cek jika query berhasil
        if ($query) $message = array('status' => true, 'message' => 'Berhasil memperbarui user');
        else $message = array('status' => true, 'message' => 'Gagal memperbarui user');

        // simpan message sebagai session
        $this->session->set_flashdata('message', $message);

        // refresh page
        redirect('user/edit/'.$id, 'refresh');
      } 
    }
    
    // Ambil data user dari database
    $user = $this->model_user->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$user) show_404();

    // Data untuk page user/add
    $data['pageTitle'] = 'Edit Data User';
    $data['user'] = $user;
    $data['pageContent'] = $this->load->view('user/userEdit', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function delete($id)
  {
    // Ambil data user dari database
    $user = $this->model_user->get_where(array('id' => $id))->row();

    // Jika data user tidak ada maka show 404
    if (!$user) show_404();

    // Jalankan function delete pada model_user
    $query = $this->model_user->delete($id);

    // cek jika query berhasil
    if ($query) $message = array('status' => true, 'message' => 'Berhasil menghapus user');
    else $message = array('status' => true, 'message' => 'Gagal menghapus user');

    // simpan message sebagai session
    $this->session->set_flashdata('message', $message);

    // refresh page
    redirect('user', 'refresh');
  }
}