<?php
  class Model_kelas extends CI_Model {
  
    public $table = 'kelas';

    public function get()
    {
      // Jalankan query
      $this->db
        ->select('*')
        ->from('guru')
        ->join('kelas', 'kelas.idwalikelas = guru.nip', 'left');
      $query = $this->db->get();
      // Return hasil query
      return $query;
    }

    public function getListWalikelas()
    {
      $query = $this->db->query('SELECT * FROM guru');
      return $query->result();
    }

    public function get_offset()
    {
      // Jalankan query
      $this->db
        ->select('*')
        ->from('guru')
        ->join('kelas', 'kelas.idwalikelas = guru.nip');
      $query = $this->db->get();
      // Return hasil query
      return $query;
    }

    public function get_where($where)
    {
      // Jalankan query
      $query = $this->db
        ->where($where)
        ->get($this->table);

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

    public function update($id, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('id', $id)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($id)
    {
      // Jalankan query
      $query = $this->db
        ->where('id', $id)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }
    
  }