<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
  </div>

  <div class="card" style="width: 50%">
    <div class="card-body">
      <form action="<?= base_url('admin/potongan_gaji/update_data_aksi') ?>" method="post">

        <?php foreach ($pot_gaji as $p) : ?>
          <div class="form-group">
            <label>Jenis Potongan</label>
            <input type="hidden" name="id" class="form-control" value="<?= $p->id ?>">
            <input type="text" name="potongan" class="form-control" value="<?= $p->potongan ?>">
            <?php echo form_error('potongan', '<div class="text-danger small ml-3">', '</div>') ?>
          </div>
          <div class="form-group">
            <label>Jumlah Potongan</label>
            <input type="text" name="jml_potongan" class="form-control" value="<?= $p->jml_potongan ?>">
            <?php echo form_error('jml_potongan', '<div class="text-danger small ml-3">', '</div>') ?>
          </div>
          <button type="submit" class="btn btn-primary">Update</button>
      </form>
    <?php endforeach; ?>
    </div>
  </div>

</div>