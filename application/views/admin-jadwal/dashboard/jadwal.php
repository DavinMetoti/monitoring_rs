<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center ">
            <h6 class="m-0 font-bold text-primary">JADWAL PELAKSANAAN OPERASI</h6>
            <!-- <a href="<?= base_url() ?>admin/jadwal/generatePDF" target="blank" class="btn btn-info"><span><i class="ti ti-printer mr-3"></i></span>Cetak</a> -->
            <div class="d-flex justify-content-between gap-2">
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span><i class="ti ti-printer mr-3"></i></span>PDF
                </button>
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#excel">
                    <span><i class="ti ti-file-spreadsheet mr-3"></i></span>EXCEL
                </button>
            </div>
        </div>
        <div class="card-body">
            <?= $this->session->flashdata('message'); ?>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>NAMA</th>
                            <th>OPERASI</th>
                            <th>DIAGNOSA</th>
                            <th>ALAT</th>
                            <th>ALAT TAMBAHAN</th>
                            <th>RUANGAN</th>
                            <th>DOKTER OPERASI</th>
                            <th>DOKTER ANESTESI</th>
                            <th>TANGGAL</th>
                            <th>MULAI</th>
                            <th>SELESAI</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($jdwl_opr as $row) { ?>
                            <tr>
                                <td><?php echo $row->nama_pasien; ?></td>
                                <td><?php echo $row->nama_tindakan_operasi; ?></td>
                                <td><?php echo $row->diagnosa_pasien; ?></td>
                                <td><?php echo $row->alat_alat; ?></td>
                                <td><?php echo !empty($row->alat_lain) ? $row->alat_lain : '-'; ?></td>
                                <td><?php echo $row->kamar_operasi; ?></td>
                                <td><?php echo $row->dokter_opr; ?></td>
                                <td><?php echo $row->dokter_anestesi; ?></td>
                                <td><?php echo $row->tgl_operasi; ?></td>
                                <td><?php echo $row->durasi_mulai; ?></td>
                                <td><?php echo date('H:i', strtotime($row->durasi_selesai)); ?></td>
                                <td>
                                    <a href="<?= base_url() ?>admin/jadwal/delete_jadwal/<?= $row->id_jadwal_opr; ?>" class="btn btn-danger"><i class="ti ti-trash"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cetak Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>admin/jadwal/generatePDF" method="POST">
                    <div class="mb-3">
                        <label for="tgl-lahir-pasien" class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tgl-lahir-pasien" name="tgl_jadwal">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">CETAK</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="excel" tabindex="-1" aria-labelledby="excelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Export Jadwal (*Xlxs)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url() ?>admin/jadwal/export_excel" method="POST">
                    <div class="mb-3">
                        <label for="tgl-lahir-pasien" class="form-label">Pilih Tanggal</label>
                        <input type="date" class="form-control" id="tgl-lahir-pasien" name="tgl_operasi">
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">CETAK</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
            </div>
        </div>
    </div>
</div>