<div class="row">
    <div class="col s12">
      <div class="card">
        <!-- <div class="card-content light-blue lighten-1 white-text"> -->
        <div class="card-content">
          <span class="card-title"><?php echo $pageTitle; ?></span>
        </div>
        <div class="card-content">
          <table class="bordered highlight">
          <?php if($guru): ?>
                <tr>
                    <th>NIP</th><td><?php echo $guru->nip; ?></td>
                </tr>
                <tr>
                    <th>Nama Guru</th><td><?php echo $guru->nama_guru; ?></td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th><td><?php echo $guru->tmp_lahir; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th><td><?php echo $guru->tgl_lahir; ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th><td><?php echo $guru->jk; ?></td>
                </tr>
                <tr>
                    <th>Alamat</th><td><?php echo $guru->alamat; ?></td>
                </tr>
                <tr>
                    <th>Agama</th><td><?php echo $guru->agama; ?></td>
                </tr>
                <tr>
                    <th>Status Merital</th><td><?php echo $guru->merit; ?></td>
                </tr>
                <tr>
                    <th>Tlp</th><td><?php echo $guru->tlp; ?></td>
                </tr>
                <tr>
                    <th>Email</th><td><?php echo $guru->email; ?></td>
                </tr>
                <?php else: ?>

                  <tr>
                    <td class="center-align" colspan="7">Belum ada data guru</td>
                  </tr>
                <?php endif; ?>
              </tbody>
          </table>
          <div class="center-align">
          </div>
        </div>
      </div>
    </div>
</div>