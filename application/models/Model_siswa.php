<?php
  class Model_siswa extends CI_Model {
  
    public $table = 'siswa';

    public function get()
    {
      // Jalankan query
      $query = $this->db->get($this->table);

      // Return hasil query
      return $query;
    }

    public function getLastID()
    {
      // Jalankan query
      $query = $this->db->query('SELECT * FROM user ORDER BY id DESC LIMIT 1');

      // Return hasil query
      return $query;
    }

    public function getListKelas()
    {
      $query = $this->db->query('SELECT * FROM kelas');
      return $query->result();
    }

    public function get_offset($limit, $offset)
    {
      // Jalankan query
      $query = $this->db
        ->select('*')
        ->from('kelas')
        ->join('siswa', 'siswa.idkelas = kelas.id')
        ->limit($limit, $offset)
        ->get();
 
      // Return hasil query
      return $query;
    }

    public function get_where($where)
    {
      // Jalankan query
      $query = $this->db
        ->select('*')
        ->from('kelas')
        ->join('siswa', 'siswa.idkelas = kelas.id')
        ->where($where)
        ->get();

      // Return hasil query
      return $query;
    }

    public function insert($data)
    {
      // Jalankan query
      $query = $this->db->insert($this->table, $data);

      // Return hasil query
      return $query;
    }

    public function update($nis, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('nis', $nis)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($nis)
    {
      // Jalankan query
      $query = $this->db
        ->where('nis', $nis)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }
    
  }