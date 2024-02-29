<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DATA DOKTER ANESTESI</h6>
        <div class="d-none d-lg-block">
            <a href="<?= base_url() ?>admin/master/tambah_dokter_anestesi" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
        </div>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead class="text-center">
                    <tr>
                        <th>INISIAL</th>
                        <th>NAMA DOKTER</th>
                        <th>HARI</th>
                        <th>MULAI PRAKTEK</th>
                        <th>AKHIR PRAKTEK</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody style="text-transform: uppercase; text-align: center;">
                    <?php foreach ($mst_jadwal_dokter as $row) { ?>
                        <tr>
                            <td><?php echo $row->inisial; ?></td>
                            <td><?php echo $row->nama_dokter; ?></td>
                            <td>
                                <?php
                                $hariInggris = $row->hari_praktek;
                                $hariIndonesia = '';

                                switch ($hariInggris) {
                                    case 'Monday':
                                        $hariIndonesia = 'Senin';
                                        break;
                                    case 'Tuesday':
                                        $hariIndonesia = 'Selasa';
                                        break;
                                    case 'Wednesday':
                                        $hariIndonesia = 'Rabu';
                                        break;
                                    case 'Thursday':
                                        $hariIndonesia = 'Kamis';
                                        break;
                                    case 'Friday':
                                        $hariIndonesia = 'Jumat';
                                        break;
                                    case 'Saturday':
                                        $hariIndonesia = 'Sabtu';
                                        break;
                                    case 'Sunday':
                                        $hariIndonesia = 'Minggu';
                                        break;
                                    default:
                                        $hariIndonesia = 'Tidak Valid';
                                        break;
                                }

                                echo $hariIndonesia;
                                ?>
                            </td>
                            <td><?php echo $row->jam_praktek_mulai; ?></td>
                            <td><?php echo $row->jam_praktek_selesai; ?></td>
                            <td>
                                <form method="POST" action="<?= base_url('admin/master/delete_dokter_ant/' . $row->id_jadwal_dokter_ant) ?>">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>