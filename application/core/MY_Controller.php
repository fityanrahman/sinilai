<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller 
{
  public function cekLogin()
  {
    if (!$this->session->userdata('username')) {
      redirect('auth/login');
    }
  }

  public function getUserData()
  {
    // Ambil semua data session
    $userData = $this->session->userdata();
 
    // Return userdata
    return $userData;
  }
 
  public function isAdmin()
  {
    // Mengambil data session
    $userData = $this->getUserData();
 
    // Jika level user bukan administrator
    // maka redirect ke halaman 404
    if ($userData['level'] !== '1') show_404();
  }

}