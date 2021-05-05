<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <a class="btn btn-sm btn-primary mb-3" href="<?= base_url('admin/data_jabatan/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Data</a>
  <?= $this->session->flashdata('pesan') ?>
  <table class="table table-bordered table-striped ">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Nama Jabatan</th>
      <th class="text-center">Gaji Pokok</th>
      <th class="text-center">Tj. Transport</th>
      <th class="text-center">Uang Makan</th>
      <th class="text-center">Total</th>
      <th class="text-center">Action</th>
    </tr>
    <?php $no = 1;
    foreach ($jabatan as $j) : ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td class="text-center"><?= $j->nama_jabatan ?></td>
        <td class="text-center">Rp. <?= number_format($j->gaji_pokok, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($j->transport, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($j->uang_makan, 0, ',', '.') ?></td>
        <td class="text-center">Rp. <?= number_format($j->gaji_pokok + $j->transport + $j->uang_makan, 0, ',', '.') ?></td>
        <td>
          <center>
            <a class="btn btn-sm btn-warning" href="<?= base_url('admin/data_jabatan/update_data/' . $j->id_jabatan) ?>"><i class="fas fa-edit"></i></a>
            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/data_jabatan/delete_data/' . $j->id_jabatan) ?>"><i class="fas fa-trash"></i></a>
          </center>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>