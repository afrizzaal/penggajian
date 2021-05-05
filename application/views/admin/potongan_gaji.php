<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <?= $this->session->flashdata('pesan') ?>
  <a class="btn btn-sm btn-success mb-3 mt-3" href="<?= base_url('admin/potongan_gaji/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Data</a>

  <table class="table table-bordered table-striped">
    <tr>
      <th class="text-center">No</th>
      <th class="text-center">Jenis Potongan</th>
      <th class="text-center">Jumlah Potongan</th>
      <th class="text-center">Action</th>
    </tr>
    <?php $no = 1;
    foreach ($pot_gaji as $p) : ?>
      <tr>
        <td class="text-center"><?= $no++ ?></td>
        <td class="text-center"><?= $p->potongan ?></td>
        <td class="text-center">Rp. <?= number_format($p->jml_potongan, 0, ',', '.') ?></td>
        <td>
          <center>
            <a class="btn btn-sm btn-warning" href="<?= base_url('admin/potongan_gaji/update_data/' . $p->id) ?>"><i class="fas fa-edit"></i></a>
            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" class="btn btn-sm btn-danger" href="<?= base_url('admin/potongan_gaji/delete_data/' . $p->id) ?>"><i class="fas fa-trash"></i></a>
          </center>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>