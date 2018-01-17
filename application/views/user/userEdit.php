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
              <input id="username" name="username" type="text" value="<?php echo $user->username; ?>">
              <label for="username" class="">Username</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="password" name="password" type="password" value="">
              <label for="password" class="">Password</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="level" name="level">
                  <option <?php echo ($user->level === '1') ? 'selected' : ''; ?> value="1">Admin</option>
                  <option <?php echo ($user->level === '2') ? 'selected' : ''; ?> value="2">Guru</option>
                  <option <?php echo ($user->level === '3') ? 'selected' : ''; ?> value="3">Siswa</option>
              </select>
              <label>Pilih Level</label>
          </div>
          <div class="input-field col s12 m6">
              <select id="active" name="active">
                  <option <?php echo ($user->active === '0') ? 'selected' : ''; ?> value="0">Tidak</option>
                  <option <?php echo ($user->active === '1') ? 'selected' : ''; ?> value="1">Ya</option>
              </select>
              <label>Active</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="<?php echo $user->ni; ?>" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>