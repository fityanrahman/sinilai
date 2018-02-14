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

    // public function getLastID()
    // {
    //   // Jalankan query
    //   $query = $this->db->query('SELECT * FROM user ORDER BY add_time DESC LIMIT 1');

    //   // Return hasil query
    //   return $query;
    // }

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
        ->select('*')
        ->from('mapel')
        ->join('guru', 'guru.idmapel_guru = mapel.id')
        ->where($where)
        ->get();

      // Return hasil query
      return $query;
    }

    public function insert($table, $data)
    {
      // Jalankan query
      $query = $this->db->insert($table, $data);

      // Return hasil query
      // return $this->db->insert_id();// return last insert id
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

    public function delete($iduser)
    {
      // Jalankan query
      $query = $this->db
        ->where('id', $iduser)
        ->delete('user');
      
      // Return hasil query
      return $query;
    }
    
  }