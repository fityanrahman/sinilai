<?php
  class Model_guru extends CI_Model {
  
    public $table = 'guru';

    public function get()
    {
      // Jalankan query
      $this->db
        ->select('*')
        ->from('mapel')
        ->join('guru', 'guru.idmapel_guru = mapel.id');
      $query = $this->db->get();

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

    public function getListMapel()
    {
      $query = $this->db->query('SELECT * FROM mapel');
      return $query->result();
    }

    // public function get_offset($limit, $offset)
    public function get_offset()
    {
      // Jalankan query
      $query = $this->db
        ->select('*')
        ->from('mapel')
        ->join('guru', 'guru.idmapel_guru = mapel.id')
        // ->limit($limit, $offset)
        ->get();
 
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

    public function update($nip, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('nip', $nip)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($nip)
    {
      // Jalankan query
      $query = $this->db
        ->where('nip', $nip)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }
    
  }