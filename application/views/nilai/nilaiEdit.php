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
              <input id="id" name="id" type="text" value="<?php echo $nilai->id; ?>">
              <label for="id" class="">idNilai</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="idsiswa" name="idsiswa" type="text" value="<?php echo $nilai->idsiswa; ?>">
              <label for="idsiswa" class="">idSiswa</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="idkat" name="idkat" type="text" value="<?php echo $nilai->idkat; ?>">
              <label for="idkat" class="">idKat</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nilai" name="nilai" type="text" value="<?php echo $nilai->nilai; ?>">
              <label for="nilai" class="">Nilai</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="catatan"  name="catatan" type="text" value="<?php echo $nilai->catatan; ?>">
              <label for="catatan" class="">Catatan</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $nilai->nis; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>