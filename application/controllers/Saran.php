<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Saran extends MY_Controller {

  public function __construct()
  {
    parent::__construct();

    $this->load->helper(array('form'));
    
    // Cek apakah user sudah login
    $this->cekLogin();

    //
    $this->user = $this->db->get_where('user', array('id' => $this->session->userdata['id']), 1)->row();


    // Load model events
    // $this->load->model('model_saran');
  }

  public function index()
  {
    // Data untuk page index
    $data['pageTitle'] = 'Saran';
    $data['teman'] = $this->db->where('id !=', $this->session->userdata('id'))->get('user');
    // $data['pageContent'] = $this->load->view('saran/saran', array(
    //   'teman' => $teman, 
    // ));
    $data['pageContent'] = $this->load->view('saran/saran', $data, TRUE);

    // Jalankan view template/layout
    $this->load->view('incsite/layout', $data);
  }

  public function getChats()
    {
        header('Content-Type: application/json');
        if ($this->input->is_ajax_request()) {
            // Find friend
            $friend = $this->db->get_where('user', array('id' => $this->input->post('chatWith')), 1)->row();

            // Get Chats
            $sarans = $this->db
                ->select('saran.*, user.username')
                ->from('saran')
                ->join('user', 'saran.send_by = user.id')
                ->where('(send_by = '. $this->user->id .' AND send_to = '. $friend->id .')')
                ->or_where('(send_to = '. $this->user->id .' AND send_by = '. $friend->id .')')
                ->order_by('saran.time', 'desc')
                ->limit(100)
                ->get()
                ->result();

            $result = array(
                'username' => $friend->username,
                'sarans' => $sarans
            );
            echo json_encode($result);
        }
    }

    public function sendMessage()
    {
        $this->db->insert('saran', array(
            'messagesaran' => htmlentities($this->input->post('messagesaran', true)),
            'send_to' => $this->input->post('chatWith'),
            'send_by' => $this->user->id
        ));
    }

}