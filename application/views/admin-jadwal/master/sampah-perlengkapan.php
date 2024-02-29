<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DATA ALAT KHUSUS YANG DIHAPUS</h6>
        <!-- <div class="d-flex justify-content-between">
            <div class="d-none d-lg-block mr-2">
                <a href="<?= base_url() ?>admin/master/tambah_perlengkapan" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
            </div>
        </div> -->
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>ALAT KHUSUS</th>
                        <th>QTY</th>
                        <th>KETERANGAN</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="text-transform: uppercase; text-align: center;">
                    <?php foreach ($mst_data_perlengkapan as $row) { ?>
                        <tr>
                            <td><?php echo $row->perlengkapan; ?></td>
                            <td><?php echo $row->qty; ?></td>
                            <td><?php echo $row->keterangan; ?></td>
                            <td> <?php
                                    if ($row->qty != 0) {
                                        echo '<span class="badge badge-success">Tersedia</span>';
                                    } else {
                                        echo '<span class="badge badge-danger">Tidak Tersedia</span>';
                                    }
                                    ?></td>
                            <td>
                                <a href="<?= base_url('admin/master/restore_peralatan_operasi/' . $row->id_perlengkapan) ?>" class="btn btn-success"><i class="ti ti-check"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>