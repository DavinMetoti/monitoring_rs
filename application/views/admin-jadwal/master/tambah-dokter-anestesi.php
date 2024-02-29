<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">INPUT JADWAL DOKTER OPERASI</h6>
    </div>
    <div class="card-body">
        <?= $this->session->flashdata('message'); ?>
        <form action="<?= base_url() ?>admin/master/insert_jadwal_dokter_anestesi" method="POST">
            <div class="mb-3">
                <label for="inisial-dokter-operasi" class="form-label">INISIAL</label>
                <input type="text" class="form-control" id="inisial-dokter-operasi" name="inisial_dokter_operasi">
            </div>
            <div class="mb-3">
                <label for="nama-dokter-operasi" class="form-label">NAMA DOKTER ANESTESI</label>
                <input type="text" class="form-control" id="nama-dokter-operasi" name="nama_dokter_operasi">
            </div>
            <div class="mb-3">
                <label for="select_hari" class="form-label">HARI PRAKTEK</label>
                <select id="select_hari" class="form-select" name="hari_praktek">
                    <option value="">Pilih Hari Praktek</option>
                    <option value="Monday">SENIN</option>
                    <option value="Tuesday">SELASA</option>
                    <option value="Wednesday">RABU</option>
                    <option value="Thursday">KAMIS</option>
                    <option value="Friday">JUMAT</option>
                    <option value="Saturday">SABTU</option>
                    <option value="Sunday">MINGGU</option>
                </select>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jam-mulai-operasi" class="form-label">JAM MULAI PRAKTEK</label>
                        <input type="time" class="form-control" id="jam-mulai-operasi" name="jam_mulai_praktek">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jam-selesai-operasi" class="form-label">JAM SELESAI PRAKTEK</label>
                        <input type="time" class="form-control" id="jam-selesai-operasi" name="jam_selesai_praktek">
                    </div>
                </div>
            </div>
            <div class="mb-3"><button class="btn btn-info col-12" type="submit">SIMPAN</button></div>
        </form>
    </div>
</div>