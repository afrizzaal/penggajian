<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <table class="table table-striped table-bordered">
    <tr>
      <th class="text-center">Bulan/Tahun</th>
      <th class="text-center">Gaji Pokok</th>
      <th class="text-center">Transport</th>
      <th class="text-center">Uang Makan</th>
      <th class="text-center">Potongan</th>
      <th class="text-center">Total Gaji</th>
      <th class="text-center">Cetak Slip</th>
    </tr>
    <?php foreach ($potongan as $p) : ?>
      <?php $potongan = $p->jml_potongan; ?>
    <?php endforeach; ?>
    <?php foreach ($gaji as $g) : ?>
      <?php $pot_gaji = $g->alpha * $potongan ?>
      <tr>
        <td class="text-center"><?= $g->bulan ?></td>
        <td class="text-center">Rp. <?= number_format($g->gaji_pokok, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->transport, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->uang_makan, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($pot_gaji, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->gaji_pokok + $g->transport + $g->uang_makan - $pot_gaji, 0, ',', '.') ?></td>
        <td class="text-center">
          <center>
            <a class="btn btn-sm btn-primary" href="<?= base_url('pegawai/data_gaji/cetak_slip/' . $g->id_kehadiran) ?>"><i class="fas fa-print"></i></a>
          </center>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>

</div>