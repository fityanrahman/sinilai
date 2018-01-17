<div class="row">
    <div class="col s12">
      <div class="card">
        <!-- <div class="card-content light-blue lighten-1 white-text"> -->
        <div class="card-content">
          <span class="card-title">Data siswa</span>
        </div>
        <div class="card-content">
          <table class="bordered highlight">
          <?php if($siswa): ?>
                <tr>
                    <th>NIS</th><td><?php echo $siswa->nis; ?></td>
                </tr>
                <tr>
                    <th>Nama Siswa</th><td><?php echo $siswa->nama_siswa; ?></td>
                </tr>
                <tr>
                    <th>Tempat Lahir</th><td><?php echo $siswa->tmp_lahir; ?></td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th><td><?php echo $siswa->tgl_lahir; ?></td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th><td><?php echo $siswa->jk; ?></td>
                </tr>
                <tr>
                    <th>Nama Ayah</th><td><?php echo $siswa->nama_ayah; ?></td>
                </tr>
                <tr>
                    <th>Nama Ibu</th><td><?php echo $siswa->nama_ibu; ?></td>
                </tr>
                <tr>
                    <th>Agama</th><td><?php echo $siswa->agama; ?></td>
                </tr>
                <tr>
                    <th>Kelas</th><td><?php echo $siswa->nama_kelas; ?></td>
                </tr>
                <?php else: ?>

                  <tr>
                    <td class="center-align" colspan="7">Belum ada data siswa</td>
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