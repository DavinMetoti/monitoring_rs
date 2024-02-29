<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">INPUT DATA TINDAKAN</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url() ?>admin/master/insert_tindakan" method="POST">
            <div class="mb-3">
                <label for="nama-tindakan" class="form-label">NAMA TINDAKAN</label>
                <input type="text" class="form-control" id="nama-tindakan" name="nama_tindakan">
            </div>
            <div class="mb-3">
                <label for="durasi" class="form-label">DURASI (MENIT)</label>
                <input type="text" class="form-control" id="durasi" name="durasi">
            </div>
            <div class="mb-3">
                <label for="alat-khusus" class="form-label">ALAT KHUSUS</label>
                <input type="text" class="form-control" id="alat-khusus" name="alat_khusus">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">KETERANGAN</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="mb-3"><button class="btn btn-info col-12" type="submit">SIMPAN</button></div>
        </form>
    </div>
</div>