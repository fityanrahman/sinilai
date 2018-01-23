<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <form class="row" id="edit-user-form" method="post" action="">
          <?php if(validation_errors()): ?>
            <div class="col s12">
              <div class="card-panel red">
                <span class="white-text"><?php echo validation_errors('<p>', '</p>'); ?></span>
              </div>
            </div>
          <?php endif; ?>
          <?php if($message = $this->session->flashdata('message')): ?>
            <div class="col s12">
              <div class="card-panel <?php echo ($message['status']) ? 'green' : 'red'; ?>">
                <span class="white-text"><?php echo $message['message']; ?></span>
              </div>
            </div>
          <?php endif; ?>
          <div hidden class="input-field col s12 m6">
              <input id="id" name="id" type="text" value="<?php echo $kat_nilai->id; ?>">
              <label for="id" class="">id</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_nilai" name="nama_nilai" type="text" value="<?php echo $kat_nilai->nama_nilai; ?>">
              <label for="nama_nilai" class="">Nama Kategori Nilai</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tgl" class="datepicker" name="tgl" type="text" value="<?php echo $kat_nilai->tgl; ?>">
              <label for="tgl" class="">Tanggal</label>
          </div>
          <?php if ($this->session->userdata('level') === '2'){ ?>
          <div hidden class="input-field col s12 m6">
          <?php } else{ ?>
          <div class="input-field col s12 m6">
          <?php } ?>
              <input id="idmapel" name="idmapel" type="text" value="<?php echo $kat_nilai->idmapel; ?>">
              <label for="idmapel" class="">ID mapel</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $kat_nilai->id; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>