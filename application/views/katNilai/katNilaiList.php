<div class="row">
    <div class="col s12">
      <div class="card">
        <!-- <div class="card-content light-blue lighten-1 white-text"> -->
        <div class="card-content">
          <span class="card-title">Data Kategori Nilai</span>
          <!-- debug query -->
          <?php $query =$this->db->last_query(); ?>
          <?php print_r($query);?> 
          <!-- debug query -->
          <a href="<?php echo base_url('katNilai/add'); ?>" class="btn-floating right waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
        </div>
        <div class="card-content">
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <table class="bordered highlight">
              <thead>
                  <tr>
                      <th>No</th>
                      <th>Nama Kategori Nilai</th>
                      <th>Mata Pelajaran</th>
                      <th>Kelas</th>
                      <th>Tanggal</th>
                      <?php if($this->session->userdata('level') !== '3'): ?>
                      <th class="center-align">Action</th>
                      <?php endif;?>
                  </tr>
              </thead>
              <tbody>
                <?php if($kat_nilai): ?>
                  <?php $no = 0; foreach($kat_nilai as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><a href="<?php echo base_url('nilai/index/'.$row->id_kat);?>"</a> <?php echo $row->nama_nilai; ?></td>
                      <td><?php echo $row->nama_mapel; ?></td>
                      <td><?php echo $row->nama_kelas; ?></td>
                      <td><?php echo $row->tgl; ?></td>
                      <?php if($this->session->userdata('level') !== '3'): ?>
                      <td class="center-align">
                        <a href="<?php echo base_url('katNilai/edit/' . $row->id_kat); ?>" class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a href="<?php echo base_url('katNilai/delete/' . $row->id_kat); ?>" class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                      </td>
                      <?php endif;?>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td class="center-align" colspan="7">Belum ada data kategori</td>
                  </tr>
                <?php endif; ?>
              </tbody>
          </table>
          <div class="center-align">
            <?php echo $this->pagination->create_links(); ?>
          </div>
        </div>
      </div>
    </div>
</div>