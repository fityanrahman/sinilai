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
              <input id="nama_kelas" name="nama_kelas" type="text" value="<?php echo $kelas->nama_kelas; ?>">
              <label for="nama_kelas" class="">Nama Kelas</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="idwalikelas" name="idwalikelas">
              <?php
              foreach($walikelas as $row)
              {
                if ($kelas->idwalikelas==$row->nip){
                  echo '<option value="'.$row->nip.'" selected>'.$row->nama_guru.'</option>';
                } else{
                echo "<option value='".$row->nip."'>".$row->nama_guru. "</option>";
              }
              }
              ?>
              </select>
              <label>Nama Walikelas</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $kelas->id; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>