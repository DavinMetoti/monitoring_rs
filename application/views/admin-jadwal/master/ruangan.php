<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DATA KAMAR OPERASI</h6>
        <div class="d-none d-lg-block">
            <a href="<?= base_url() ?>admin/master/tambah_ruangan" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>NO</th>
                        <th>NAMA RUANGAN</th>
                        <th>STATUS DIGUNAKAN</th>
                        <th>KETERANGAN</th>
                        <th>STATUS</th>
                        <th>EDIT</th>
                        <th>AKTIVASI</th>
                    </tr>
                </thead>
                <tbody style="text-transform: uppercase; text-align: center;">
                    <?php foreach ($mst_data_ruangan as $row) { ?>
                        <tr>
                            <td><?php echo $row->id; ?></td>
                            <td><?php echo $row->nama_ruangan; ?></td>
                            <td>
                                <?php
                                if ($row->digunakan == 1) {
                                    echo '<span class="badge badge-warning">Operasional</span>';
                                } else {
                                    echo '<span class="badge badge-success">Tidak Operasional</span>';
                                }
                                ?>
                            </td>

                            <td><?php echo $row->keterangan; ?></td>
                            <td>
                                <?php
                                if ($row->status == 1) {
                                    echo '<span class="badge badge-success">AKTIF</span>';
                                } else {
                                    echo '<span class="badge badge-danger">NON-AKTIF</span>';
                                }
                                ?>
                            </td>
                            <td><a href="<?= base_url('admin/master/edit_ruangan/' . $row->id) ?>" class="btn btn-warning"><i class="ti ti-pencil"></i></a></td>

                            <td><a href="<?= base_url('admin/master/delete_ruangan_operasi/' . $row->id . '/' . ($row->status == 1 ? 0 : 1)) ?>" class="btn btn-danger"><i class="ti ti-click"></i></a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>