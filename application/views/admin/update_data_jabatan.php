<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <?php foreach ($jabatan as $j) : ?>
    <form method="post" action="<?= base_url('admin/data_jabatan/update_data_aksi') ?>">

      <div class="form-group">
        <label>Nama Jabatan</label>
        <input type="hidden" name="id_jabatan" class="form-control" value="<?= $j->id_jabatan ?>">
        <input type="text" name="nama_jabatan" class="form-control" value="<?= $j->nama_jabatan ?>">
        <?php echo form_error('nama_jabatan', '<div class="text-danger small ml-3">', '</div>') ?>
      </div>

      <div class="form-group">
        <label>Gaji Pokok</label>
        <input type="number" name="gaji_pokok" class="form-control" value="<?= $j->gaji_pokok ?>">
        <?php echo form_error('gaji_pokok', '<div class="text-danger small ml-3">', '</div>') ?>
      </div>

      <div class="form-group">
        <label>Tunjangan Transport</label>
        <input type="number" name="transport" class="form-control" value="<?= $j->transport ?>">
        <?php echo form_error('transport', '<div class="text-danger small ml-3">', '</div>') ?>
      </div>

      <div class="form-group">
        <label>Uang Makan</label>
        <input type="number" name="uang_makan" class="form-control" value="<?= $j->uang_makan ?>">
        <?php echo form_error('uang_makan', '<div class="text-danger small ml-3">', '</div>') ?>
      </div>

      <button type="submit" class="btn btn-sm btn-primary">Edit Data</button>
    </form>
  <?php endforeach; ?>
</div>