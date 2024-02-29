<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DATA TINDAKAN OPERASI</h6>
        <div class="d-none d-lg-block">
            <a href="<?= base_url() ?>admin/master/tambah_tindakan" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>NO</th>
                        <th>NAMA TINDAKAN</th>
                        <th>DURASI</th>
                        <th>ALAT KHUSUS</th>
                        <th>KETERANGAN</th>
                        <th>EDIT</th>
                        <th>STATUS</th>
                    </tr>
                </thead>
                <tbody style="text-transform: uppercase; text-align: center;">
                    <?php $nomor = 1; // Inisialisasi variabel penomoran 
                    ?>
                    <?php foreach ($mst_tindakan_opr as $row) { ?>
                        <tr>
                            <td><?php echo $nomor++; ?></td>
                            <td><?php echo $row->tindakan; ?></td>
                            <td><?php echo $row->durasi; ?></td>
                            <td><?php echo $row->alat_khusus; ?></td>
                            <td><?php echo $row->keterangan; ?></td>
                            <td><a class="btn btn-warning" href="<?= base_url('admin/master/edit_tindakan/' . $row->id_tindakan) ?>"><i class="ti ti-pencil"></i></a></td>
                            <td>
                                <?php if ($row->status == 1) : ?>
                                    <a class="btn btn-success" href="<?= base_url('admin/master/delete_tindakan/' . $row->id_tindakan . '/0') ?>"><i class="ti ti-power"></i></a>
                                <?php else : ?>
                                    <a class="btn btn-danger" href="<?= base_url('admin/master/delete_tindakan/' . $row->id_tindakan . '/1') ?>"><i class="ti ti-power"></i></a>
                                <?php endif; ?>
                            </td>

                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>