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
              <input id="perihal" name="perihal" type="text" value="<?php echo set_value('perihal'); ?>">
              <label for="perihal" class="">Perihal</label>
          </div>
          <div class="input-field col s12 m12">
              <input id="saran" name="saran" type="text" value="<?php echo set_value('saran'); ?>">
              <label for="saran" class="">Saran</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="submit" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>