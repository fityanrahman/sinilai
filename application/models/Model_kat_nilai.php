<?php
  class Model_kat_nilai extends CI_Model {
  
    public $table = 'kat_nilai';

    public function get()
    {
      // Jalankan query
      $query = $this->db->get($this->table);

      // Return hasil query
      return $query;
    }

   public function get_idmapel($where=null)
   {
    if($where!==null){$this->db->where('iduser_guru', $where);}
    $this->db
      ->select('*')
      ->from('mapel')
      ->join('guru', 'guru.idmapel_guru = mapel.id', 'inner');

      return $this->db->get();

   }

  //  public function get_offset($limit, $offset, $where=null)
    public function get_offset($where=null)
    {
      // Jalankan query
      // if($where!==null){$this->db->where('iduser_guru', $where);}
      if($where!==null)
      {
        $this->db->where($where);
      }
      $query = $this->db
        ->select('kat_nilai.id as `id_kat`, nama_nilai, nama_kelas, tgl, nama_mapel, kat_nilai.idmapel as `idmapel_katnilai`')
        ->from('kat_nilai')
        ->join('nilai', 'nilai.idkat = kat_nilai.id', 'left')
        ->join('siswa', 'siswa.nis = nilai.idsiswa', 'left')
        ->join('kelas', 'kelas.id = siswa.idkelas', 'left')
        ->join('mapel', 'kat_nilai.idmapel = mapel.id', 'left')
        ->join('guru', 'guru.idmapel_guru = mapel.id', 'left')
        ->join('user', 'guru.iduser_guru = user.id', 'left')
        ->group_by('kat_nilai.id');
        // ->limit($limit, $offset);
 
 
      // Return hasil query
      return $this->db->get();
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