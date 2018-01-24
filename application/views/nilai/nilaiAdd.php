<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title"><?php echo $pageTitle; ?></span>
        <!-- debug query -->
          <?php $query =$this->db->last_query(); ?>
          <?php print_r($query);?> 
        <!-- debug query -->
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
                <select id="idkat" name="idkat">
                <?php
                foreach($katnilai as $row)
                {
                  echo '<option value="'.$row->id.'">'.$row->nama_nilai.'</option>';
                }
                ?>
                </select>
                <label>Nama Kategori Nilai</label>
            </div>
            <div class="input-field col s12 m6">
            <select id='kelas' name='kelas'>
            <?php
            foreach($kelas as $row)
            {
              echo '<option value="'.$row->id.'">'.$row->nama_kelas.'</option>';
            }
            ?>
            </select>
            <label>Kelas</label>
          </div>
          <div class="input-field col s12 m6">
            <select id='idsiswa' name='idsiswa'>
            <option value='0'>--pilih--</option>
            </select>
            <label>Nama Siswa</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="nilai" name="nilai" type="text" value="<?php echo set_value('nilai'); ?>">
              <label for="nilai" class="">Nilai</label>
          </div>
          <div class="input-field col s12 m6">
              <input id="catatan"  name="catatan" type="text" value="<?php echo set_value('catatan'); ?>">
              <label for="catatan" class="">Catatan</label>
          </div>
          <div class="input-field col s12 right-align">
              <button type="submit" name="submit" value="add_siswa" class="btn amber waves-effect waves-green">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<div id="tes"></div>
<script type="text/javascript">
$(function(){

$.ajaxSetup({
type:"POST",
url: "ambil_data",
cache: false,
});

$("#kelas").change(function(){

    var value=$(this).val();
    if(value>0){
    $.ajax({
    data:{modul:'nama_siswa',id:value},
    success: function(respond){
    $("#idsiswa").html(respond);
    $("#idsiswa").material_select();

    }
    })
    }
    
    });
    
})

</script>
