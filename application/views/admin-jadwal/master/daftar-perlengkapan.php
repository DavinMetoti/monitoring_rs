<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">DATA ALAT KHUSUS</h6>
        <div class="d-flex justify-content-between">
            <div class="d-none d-lg-block mr-2">
                <a href="<?= base_url() ?>admin/master/tambah_perlengkapan" class="btn btn-info"><span style="margin-right: 5px;"><i class="ti ti-plus"></i></span>Tambah</a>
            </div>
            <div class="d-none d-lg-block">
                <a href="<?= base_url() ?>admin/master/sampah_perlengkapan" class="btn btn-warning"><span style="margin-right: 5px;"><i class="ti ti-trash"></i></span>Peralatan Dihapus</a>
            </div>
        </div>
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
                                <button class="btn btn-info" onclick="getHistory('<?= $row->perlengkapan ?>')"><i class="ti ti-eye"></i></button>
                                <a href="<?= base_url('admin/master/delete_peralatan_operasi/' . $row->id_perlengkapan) ?>" class="btn btn-danger"><i class="ti ti-trash"></i></a>
                                <a href="<?= base_url('admin/master/edit_perlengkapan/' . $row->id_perlengkapan) ?>" class="btn btn-warning"><i class="ti ti-pencil"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal untuk menampilkan hasil -->
<div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="min-width: 87%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="resultModalLabel">Hasil Permintaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="resultBody">
                <div id="tableContainer"></div>
                <div id="no_use"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function getHistory(params) {
        var data = {
            nama_alat: params,
        };
        $.ajax({
            type: "POST",
            url: "get_history_alat",
            data: data,
            success: function(response) {
                try {
                    var result = JSON.parse(response);

                    var tableHtml = '<table class="table">';
                    tableHtml += '<thead>';
                    tableHtml += '<tr>';
                    tableHtml += '<th>Nama Pasien</th>';
                    tableHtml += '<th>Tanggal Operasi</th>';
                    tableHtml += '<th>Dokter</th>';
                    tableHtml += '<th>Tindakan</th>';
                    tableHtml += '<th>Mulai</th>';
                    tableHtml += '<th>Selesai</th>';
                    tableHtml += '</tr>';
                    tableHtml += '</thead>';
                    tableHtml += '<tbody>';

                    result.forEach(function(item) {
                        tableHtml += '<tr>';
                        tableHtml += '<td>' + item.nama_pasien + '</td>';
                        tableHtml += '<td>' + item.tgl_operasi + '</td>';
                        tableHtml += '<td>' + item.dokter_opr + '</td>';
                        tableHtml += '<td>' + item.nama_tindakan_operasi + '</td>';
                        tableHtml += '<td>' + item.durasi_mulai + '</td>';
                        tableHtml += '<td>' + item.durasi_selesai + '</td>';
                        tableHtml += '</tr>';
                    });

                    tableHtml += '</tbody>';
                    tableHtml += '</table>';

                    if (result.length != 0) {
                        $('#resultModal').modal('show');
                        $('#tableContainer').show();
                        $('#tableContainer').html(tableHtml);
                        $('#no_use').hide();
                    } else {
                        $('#resultModal').modal('show');
                        $('#tableContainer').hide();
                        $('#no_use').show();
                        $('#no_use').text("Alat belum digunakan.");
                        $('#resultBody').show();
                    }

                } catch (error) {
                    $('#resultBody').text("Alat belum digunakan.");
                    $('#resultModal').modal('show');
                    console.error(error);
                }
            },
            error: function(xhr, status, error) {
                $('#resultBody').text("Alat belum digunakan.");
                $('#resultModal').modal('show');
                console.error(error);
            }
        });
    }

    function close() {
        $('#resultModal').modal('hidden');
    }
</script>