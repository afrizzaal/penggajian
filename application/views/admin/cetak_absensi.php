<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title; ?></title>
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
  $bulan = $this->input->post('bulan');
  $tahun = $this->input->post('tahun');
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
      <th class="text-center">Nama Pegawai</th>
      <th class="text-center">NIK</th>
      <th class="text-center">Jabatan</th>
      <th class="text-center">Hadir</th>
      <th class="text-center">Sakit</th>
      <th class="text-center">Alpha</th>
    </tr>
    <?php $no = 1;
    foreach ($lap_absensi as $l) : ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td class="text-center"><?= $l->nama_pegawai ?></td>
        <td class="text-center"><?= $l->nik ?></td>
        <td class="text-center"><?= $l->nama_jabatan ?></td>
        <td class="text-center"><?= $l->hadir ?></td>
        <td class="text-center"><?= $l->sakit ?></td>
        <td class="text-center"><?= $l->alpha ?></td>
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