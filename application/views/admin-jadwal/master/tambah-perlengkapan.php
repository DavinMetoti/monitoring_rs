<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">INPUT ALAT KHUSUS</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url() ?>admin/master/insert_peralatan_operasi" method="POST">
            <div class="mb-3">
                <label for="nama-alat" class="form-label">NAMA ALAT</label>
                <input type="text" class="form-control" id="nama-alat" name="nama_alat">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">QTY</label>
                <input type="text" class="form-control" id="qty" name="qty">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">KETERANGAN</label>
                <input type="text" class="form-control" id="keterangan" name="keterangan">
            </div>
            <div class="mb-3"><button class="btn btn-info col-12" type="submit">SIMPAN</button></div>
        </form>
    </div>
</div>