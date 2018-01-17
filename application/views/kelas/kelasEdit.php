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
          <div class="input-field col s12 m6">
              <input id="nama" name="nama" type="text" value="<?php echo $kelas->nama; ?>">
              <label for="nama" class="">Nama Kelas</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_walikelas" name="nama_walikelas" type="text" value="<?php echo $kelas->nama_walikelas; ?>">
              <label for="nama_walikelas" class="">Nama Walikelas</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $kelas->id; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>