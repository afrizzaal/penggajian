<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
  <style type="text/css">
    body {
      font-family: arial;
      color: black;
    }
  </style>
</head>

<body>
  <center>
    <img class="img-fluid" src="<?= base_url() ?>assets/img/mgm.png" style="width: 300px;">
    <h1>PT. MULTIMODA GUMA MANDIRI</h1>
    <H2>Slip Gaji Pegawai</H2>
    <hr style="width:50%; border-width: 5px; color: black">
  </center>
  <br>

  <?php foreach ($potongan as $p) {
    $potongan = $p->jml_potongan;
  } ?>

  <?php
  foreach ($print_slip as $ps) : ?>
    <?php $potongan_gaji = $ps->alpha * $potongan; ?>
    <table style="width: 100%;">
      <tr>
        <td width="10%">Nama Pegawai</td>
        <td width="3%">:</td>
        <td><?= $ps->nama_pegawai; ?></td>
      </tr>
      <tr>
        <td>NIK</td>
        <td>:</td>
        <td><?= $ps->nik; ?></td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td><?= $ps->nama_jabatan; ?></td>
      </tr>
      <tr>
        <td>Bulan</td>
        <td>:</td>
        <td><?= substr($ps->bulan, 0, 2); ?></td>
      </tr>
      <tr>
        <td>Tahun</td>
        <td>:</td>
        <td><?= substr($ps->bulan, 2, 4); ?></td>
      </tr>
    </table>

    <table class="table table-striped table-bordered mt-3">
      <tr>
        <th class="text-center" width="5%">No</th>
        <th class="text-center">Keterangan</th>
        <th class="text-center">Jumlah</th>
      </tr>
      <tr>
        <td class="text-center">1</td>
        <td>Gaji Pokok</td>
        <td>Rp. <?= number_format($ps->gaji_pokok, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td class="text-center">2</td>
        <td>Tunjangan Transport</td>
        <td>Rp. <?= number_format($ps->transport, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td class="text-center">3</td>
        <td>Uang makan</td>
        <td>Rp. <?= number_format($ps->uang_makan, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <td class="text-center">4</td>
        <td>Potongan</td>
        <td>Rp. <?= number_format($potongan_gaji, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th colspan="2" style="text-align:right;">Total Gaji</th>
        <th>Rp. <?= number_format($ps->gaji_pokok + $ps->transport + $ps->uang_makan - $potongan_gaji, 0, ',', '.') ?></th>
      </tr>
    </table>

    <table width="100%">
      <tr>
        <td></td>
        <td>
          <p>Pegawai</p>
          <br>
          <br>
          <p class="font-weight-bold"><?= $ps->nama_pegawai; ?></p>
        </td>
        <td width="200px">
          <p>Purwakarta, <?= date("d M Y") ?> <br> Direktur</p>
          <br>
          <br>
          <p>____________________</p>
        </td>
      </tr>
    </table>
  <?php endforeach; ?>
</body>

</html>

<script type="text/javascript">
  window.print();
</script>