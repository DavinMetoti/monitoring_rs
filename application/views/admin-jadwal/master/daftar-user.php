<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DAFTAR ADMIN</h6>
        <div class="d-none d-lg-block">
            <a href="<?= base_url() ?>admin/master/tambah_admin" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>USERNAME</th>
                        <th>HAK AKSES</th>
                        <th>STATUS</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="text-transform: uppercase; text-align: center;">
                    <?php foreach ($admin_data as $row) { ?>
                        <tr>
                            <td><?php echo $row->username; ?></td>
                            <td>
                                <?php
                                $master = $row->role_access;
                                $hak_akses = '';

                                switch ($master) {
                                    case '1':
                                        $hak_akses = '<span class="badge badge-info">JADWAL</span>';
                                        break;
                                    case '2':
                                        $hak_akses = '<span class="badge badge-primary">OPERATOR</span>';
                                        break;
                                    default:
                                        $hak_akses = 'Tidak Valid';
                                        break;
                                }

                                echo $hak_akses;
                                ?>
                            </td>
                            <td>
                                <?php
                                if ($row->status == 1) {
                                    echo '<span class="badge badge-success">AKTIF</span>';
                                } else {
                                    echo '<span class="badge badge-danger">NON-AKTIF</span>';
                                }

                                ?>
                            </td>
                            <td>
                                <a class="btn btn-warning" href="<?= base_url('admin/master/edit_admin/' . $row->id_account) ?>"><i class="ti ti-pencil"></i></a>
                                <?php if ($row->status == 1) : ?>
                                    <a class="btn btn-success" href="<?= base_url('admin/master/delete_user/' . $row->id_account . '/0') ?>"><i class="ti ti-power"></i></a>
                                <?php else : ?>
                                    <a class="btn btn-danger" href="<?= base_url('admin/master/delete_user/' . $row->id_account . '/1') ?>"><i class="ti ti-power"></i></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>