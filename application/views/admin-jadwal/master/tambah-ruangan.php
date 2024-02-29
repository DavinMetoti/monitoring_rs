<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">INPUT DATA KAMAR OPERASI</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url() ?>admin/master/insert_ruangan" method="POST">
            <div class="mb-3">
                <label for="nama-alat" class="form-label">NAMA KAMAR OPERASI</label>
                <input type="text" class="form-control" id="nama-alat" name="nama_alat">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">KETERANGAN</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="mb-3"><button class="btn btn-info col-12" type="submit">SIMPAN</button></div>
        </form>
    </div>
</div>