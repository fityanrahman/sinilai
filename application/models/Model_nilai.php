<?php
  class Model_nilai extends CI_Model {
  
    public $table = 'nilai';

    public function get()
    {
      // Jalankan query
      $query = $this->db->get($this->table);

      // Return hasil query
      return $query;
    }

    public function getListKelas()
    {
      //mengambil list kelas untuk di select dinamis
      $query = $this->db->query('SELECT * FROM kelas');
      return $query->result();
    }

    public function siswa($kelasId){
      //menampilkan daftar siswa di select dinamis
      $siswa="<option value='0'>--pilih--</pilih>";

      $this->db->order_by('nama_siswa','ASC');
      $sis=$this->db->get_where('siswa',array('idkelas'=>$kelasId));

      foreach ($sis->result_array() as $data){
        $siswa.= "<option value='$data[nis]'>$data[nama_siswa]</option>";
      }
      return $siswa;
    }

    public function get_offset($where=null)
    {
      // Jalankan query
      if($where!==null)
      {
        $this->db->where($where);
      }
      $query = $this->db
        ->select('nilai.id as `id_nilai`, nama_siswa, nama_nilai, nilai, catatan, nama_mapel')
        ->from('nilai')
        ->join('siswa', 'siswa.nis = nilai.idsiswa')
        ->join('kelas', 'siswa.idkelas = kelas.id')
        ->join('kat_nilai', 'nilai.idkat = kat_nilai.id')
        ->join('mapel', 'mapel.id = kat_nilai.idmapel')
        ->join('guru', 'guru.idmapel_guru = mapel.id', 'left')
        ->join('user', 'guru.iduser_guru = user.id', 'left');
        // ->limit($limit, $offset);
 
      // Return hasil query
      return $this->db->get();
    }

    public function get_where($where)
    {
      // Jalankan query
      $query = $this->db
        ->select('*')
        ->from('nilai')
        ->join('siswa', 'siswa.nis = nilai.idsiswa')
        ->join('kat_nilai', 'kat_nilai.id = nilai.idkat')
        ->join('mapel', 'mapel.id = kat_nilai.idmapel')
        ->join('guru', 'guru.idmapel_guru = mapel.id')
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
    

    public function update($id_nilai, $data)
    {
      // Jalankan query
      $query = $this->db
        ->where('id', $id_nilai)
        ->update($this->table, $data);
      
      // Return hasil query
      return $query;
    }

    public function delete($id_nilai)
    {
      // Jalankan query
      $query = $this->db
        ->where('id', $id_nilai)
        ->delete($this->table);
      
      // Return hasil query
      return $query;
    }
    
  }