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
              <input id="nis" name="nis" type="text" value="<?php echo $siswa->nis; ?>">
              <label for="nis" class="">NIS</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_siswa" name="nama_siswa" type="text" value="<?php echo $siswa->nama_siswa; ?>">
              <label for="nama_siswa" class="">Nama siswa</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tmp_lahir" name="tmp_lahir" type="text" value="<?php echo $siswa->tmp_lahir; ?>">
              <label for="tmp_lahir" class="">Tempat Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tgl_lahir" class="datepicker" name="tgl_lahir" type="date" value="<?php echo $siswa->tgl_lahir; ?>">
              <label for="tgl_lahir" class="">Tanggal Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="jk" name="jk">
                  <option <?php echo ($siswa->jk === 'Laki-laki') ? 'selected' : ''; ?> value="Laki-laki">Laki-laki</option>
                  <option <?php echo ($siswa->jk === 'Perempuan') ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
              </select>
              <label>Jenis Kelamin</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="alamat" name="alamat" type="text" value="<?php echo $siswa->alamat; ?>">
              <label for="alamat" class="">Alamat</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_ayah" name="nama_ayah" type="text" value="<?php echo $siswa->nama_ayah; ?>">
              <label for="nama_ayah" class="">Nama Ayah</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_ibu" name="nama_ibu" type="text" value="<?php echo $siswa->nama_ibu; ?>">
              <label for="nama_ibu" class="">Nama Ibu</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="agama" name="agama">
                  <option <?php echo ($siswa->agama === 'Islam') ? 'selected' : ''; ?> value="Islam">Islam</option>
              </select>
              <label>Agama</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="idkelas" name="idkelas">
              <?php
              foreach($kelas as $row)
              {
                echo '<option value="'.$row->id.'">'.$row->nama_kelas.'</option>';
              }
              ?>
              </select>
              <label>Kelas</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $siswa->nis; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>