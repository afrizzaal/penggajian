<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <style type="text/css">
    body {
      font-family: Arial;
      color: black;
    }
  </style>
</head>

<body>
  <center>
    <img class="img-fluid" src="<?= base_url() ?>assets/img/mgm.png" style="width: 300px;">
    <h1>PT. MULTIMODA GUMA MANDIRI</h1>
    <H2>Daftar Gaji Pegawai</H2>
    <hr style="width:50%; border-width: 5px; color: black">
  </center>

  <?php
  if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $bulantahun = $bulan . $tahun;
  } else {
    $bulan = date('m');
    $tahun = date('Y');
    $bulantahun = $bulan . $tahun;
  }
  ?>

  <table>
    <tr>
      <td>Bulan</td>
      <td>:</td>
      <td><?= $bulan; ?></td>
    </tr>
    <tr>
      <td>Tahun</td>
      <td>:</td>
      <td><?= $tahun; ?></td>
    </tr>
  </table>

  <table class="table table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">NIK</th>
      <th class="text-center">Nama Pegawai</th>
      <th class="text-center">Jenis Kelamin</th>
      <th class="text-center">Jabatan</th>
      <th class="text-center">Gaji Pokok</th>
      <th class="text-center">Tj. Transport</th>
      <th class="text-center">Uang Makan</th>
      <th class="text-center">Potongan</th>
      <th class="text-center">Total Gaji</th>
    </tr>
    <?php foreach ($potongan as $p) {
      $alpha = $p->jml_potongan;
    } ?>
    <?php $no = 1;
    foreach ($cetak_gaji as $g) : ?>
      <?php $potongan = $g->alpha * $alpha ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td class="text-center"><?= $g->nik ?></td>
        <td class="text-center"><?= $g->nama_pegawai ?></td>
        <td class="text-center"><?= $g->jenis_kelamin ?></td>
        <td class="text-center"><?= $g->nama_jabatan ?></td>
        <td class="text-center">Rp. <?= number_format($g->gaji_pokok, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->transport, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->uang_makan, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($potongan, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($g->gaji_pokok + $g->transport + $g->uang_makan - $potongan, 0, ',', '.') ?></td>
      </tr>
    <?php endforeach; ?>
  </table>

  <table width="100%">
    <tr>
      <td></td>
      <td width="200px">
        <p>Purwakarta, <?= date("d M Y") ?><br> Direktur </p>
        <br>
        <br>
        <p>____________________</p>
      </td>
    </tr>
  </table>
</body>

</html>

<script type="text/javascript">
  window.print();
</script>