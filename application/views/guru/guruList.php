<div class="row">
    <div class="col s12">
      <div class="card">
        <!-- <div class="card-content light-blue lighten-1 white-text"> -->
        <div class="card-content">
          <span class="card-title">Data Guru</span>
          <a href="<?php echo base_url('guru/add'); ?>" class="btn-floating right waves-effect waves-light amber tooltipped" data-position="top" data-tooltip="Tambah Data"><i class="material-icons">add</i></a>
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
                      <th>Nama Guru</th>
                      <th>Mata Pelajaran</th>
                      <th class="center-align">Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php if($guru): ?>
                  <?php $no = 0; foreach($guru as $row): ?>
                    <tr>
                      <td><?php echo ++$no; ?></td>
                      <td><?php echo $row->nama_guru; ?></td>
                      <td><?php echo $row->nama_mapel; ?></td>                      
                      <td class="center-align">
                        <a href="<?php echo base_url('guru/edit/' . $row->nip); ?>" class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Edit Data"><i class="material-icons">edit</i></a>
                        <a href="<?php echo base_url('guru/delete/' . $row->nip); ?>" class="btn-floating waves-effect waves-light tooltipped" data-position="top" data-tooltip="Delete Data"><i class="material-icons">delete</i></a>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php else: ?>
                  <tr>
                    <td class="center-align" colspan="7">Belum ada data guru</td>
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