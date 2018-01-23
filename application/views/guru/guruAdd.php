<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title"><?php echo $pageTitle; ?></span>
      </div>
      <div class="card-content">
        <form class="row" id="add-user-form" method="post" action="">
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
              <input id="nip" name="nip" type="text" value="<?php echo set_value('nip'); ?>">
              <label for="nip" class="">NIP</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nama_guru" name="nama_guru" type="text" value="<?php echo set_value('nama_guru'); ?>">
              <label for="nama_guru" class="">Nama Guru</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tmp_lahir" name="tmp_lahir" type="text" value="<?php echo set_value('tmp_lahir'); ?>">
              <label for="tmp_lahir" class="">Tempat Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tgl_lahir" class="datepicker" name="tgl_lahir" type="text" value="<?php echo set_value('tgl_lahir'); ?>">
              <label for="tgl_lahir" class="">Tanggal Lahir</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="jk" name="jk">
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
              </select>
              <label>Jenis Kelamin</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="alamat" name="alamat" type="text" value="<?php echo set_value('alamat'); ?>">
              <label for="alamat" class="">Alamat</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="agama" name="agama">
                  <option value="Islam">Islam</option>
              </select>
              <label>Agama</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="merit" name="merit">
                  <option value="Menikah">Menikah</option>
                  <option value="Lajang">Lajang</option>
                  <option value="Duda">Duda</option>
                  <option value="Janda">Janda</option>
              </select>
              <label>Status Pernikahan</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="tlp" name="tlp" type="text" value="<?php echo set_value('tlp'); ?>">
              <label for="tlp" class="">Telp</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="email" name="email" type="email" value="<?php echo set_value('email'); ?>">
              <label for="email" class="">Email</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="idmapel" name="idmapel">
              <?php
              foreach($mapel as $row)
              {
                echo '<option value="'.$row->id.'">'.$row->nama_mapel.'</option>';
              }
              ?>
              </select>
              <label>Mata Pelajaran</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="iduser_guru" name="iduser_guru" type="text" value="<?php echo $iduser->id; ?>">
              <label for="iduser_guru" class="">IDuser</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="add_guru" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>