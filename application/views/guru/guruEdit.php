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
              <input id="nip" name="nip" type="text" value="<?php echo $guru->nip; ?>">
              <label for="nip" class="">Nama Guru</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_guru" name="nama_guru" type="text" value="<?php echo $guru->nama_guru; ?>">
              <label for="nama_guru" class="">Nama Guru</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tmp_lahir" name="tmp_lahir" type="text" value="<?php echo $guru->tmp_lahir; ?>">
              <label for="tmp_lahir" class="">Tempat Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tgl_lahir" class="datepicker" name="tgl_lahir" type="date" value="<?php echo $guru->tgl_lahir; ?>">
              <label for="tgl_lahir" class="">Tanggal Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="jk" name="jk">
                  <option <?php echo ($guru->jk === 'Laki-laki') ? 'selected' : ''; ?> value="Laki-laki">Laki-laki</option>
                  <option <?php echo ($guru->jk === 'Perempuan') ? 'selected' : ''; ?> value="Perempuan">Perempuan</option>
              </select>
              <label>Jenis Kelamin</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="alamat" name="alamat" type="text" value="<?php echo $guru->alamat; ?>">
              <label for="alamat" class="">Alamat</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="agama" name="agama">
                  <option <?php echo ($guru->agama === 'Islam') ? 'selected' : ''; ?> value="Islam">Islam</option>
              </select>
              <label>Agama</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="merit" name="merit">
                  <option <?php echo ($guru->merit === 'Menikah') ? 'selected' : ''; ?> value="Menikah">Menikah</option>
                  <option <?php echo ($guru->merit === 'Lajang') ? 'selected' : ''; ?> value="Lajang">Lajang</option>
                  <option <?php echo ($guru->merit === 'Duda') ? 'selected' : ''; ?> value="Duda">Duda</option>
                  <option <?php echo ($guru->merit === 'Janda') ? 'selected' : ''; ?> value="Janda">Janda</option>
              </select>
              <label>Status Pernikahan</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tlp" name="tlp" type="text" value="<?php echo $guru->tlp; ?>">
              <label for="tlp" class="">Telp</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="email" name="email" type="text" value="<?php echo $guru->email; ?>">
              <label for="email" class="">Email</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="idmapel" name="idmapel">
              <?php
              foreach($mapel as $row)
              {
                if ($guru->idmapel==$row->id){
                echo '<option value="'.$row->id.'" selected>'.$row->nama_mapel.'</option>';
              } else {
                echo '<option value="'.$row->id.'">'.$row->nama_mapel.'</option>';
              }
            }
              ?>
              </select>
              <label>Mata Pelajaran</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="iduser_siswa" name="iduser_siswa" type="text" value="<?php echo $guru->iduser_guru; ?>">
              <label for="iduser_siswa" class="">IDuser</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $guru->nip; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>