<div class="container-fluid">
    <form action="<?= base_url() ?>admin/jadwal/insert_jadwal" method="POST" class="card shadow mb-5">
        <div class="card-header py-3">
            <h6 class="m-0 font-bold text-primary">FORM JADWAL PELAKSANAAN OPERASI</h6>
        </div>
        <div class="card-body">
            <div class="alert alert-warning" role="alert">Setalah mengganti tanggal harap pilih ulang kembali jamnya</div>
            <div class="row">
                <div class="col-12">
                    <div class="mb-3">
                        <label for="nama-pasien" class="form-label">Nama Pasien</label>
                        <input type="text" class="form-control" id="nama-pasien" name="nama_pasien" value="<?= isset($nama_pasien) ? $nama_pasien : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="rekam-medis" class="form-label">Nomor Rekam Medis</label>
                        <input type="text" class="form-control" id="rekam-medis" name="rekam_medis" value="<?= isset($rekam_medis) ? $rekam_medis : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="Kelas-pasien" class="form-label">Kelas Pasien</label>
                        <input type="text" class="form-control" id="Kelas-pasien" name="kelas_pasien" value="<?= isset($kelas_pasien) ? $kelas_pasien : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="tgl-lahir-pasien" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tgl-lahir-pasien" name="tgl_lahir_pasien">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jns-kelamin" class="form-label">Jenis Kelamin</label>
                        <select id="jns-kelamin" class="form-select" name="gender">
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value=1>Laki-Laki</option>
                            <option value=2>Perempuan</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="select_ruangan" class="form-label">Ruangan Pasien</label>
                        <select id="select_ruangan" class="form-select" name="ruangan_pasien">
                            <option value="">Pilih Ruangan</option>
                            <option value="Dahlia">Dahlia</option>
                            <option value="Mawar">Mawar</option>
                            <option value="Nusa Indah">Nusa Indah</option>
                            <option value="Teratai">Teratai</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="register-pasien" class="form-label">Register</label>
                        <input type="text" class="form-control" id="register-pasien" name="register_pasien">
                    </div>
                </div>
            </div>
            <!-- Input Tanggal Operasi -->
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="tanggal-operasi" class="form-label">Tanggal Operasi</label>
                        <input type="date" class="form-control" id="tanggal-operasi" name="tgl_operasi" value="<?= isset($tgl_operasi) ? $tgl_operasi : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jam-serah-terima" class="form-label">Jam Serah Terima</label>
                        <input type="time" class="form-control" id="jam-serah-terima" name="jam_serah_terima" value="<?= isset($jam_serah_terima) ? $jam_serah_terima : ''; ?>">
                    </div>
                </div>
            </div>
            <!-- Input Diagnosa Pasien -->
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="diagnosa-operasi" class="form-label">Diagnosa Pasien</label>
                        <input type="text" class="form-control" id="diagnosa-operasi" name="diagnosa_operasi" value="<?= isset($diagnosa_operasi) ? $diagnosa_operasi : ''; ?>">
                    </div>
                </div>
                <!-- Input Tindakan Operasi -->
                <div class="col-6">
                    <div class="mb-3">
                        <label for="select_tindakan" class="form-label">Tindakan Operasi</label>
                        <select id="select_tindakan" class="form-select" name="id_tindakan" onchange="updateDurasiSelesai()">
                            <option value="">Pilih Tindakan</option>
                            <?php foreach ($tindakan_opr as $option) : ?>
                                <option value="<?= $option->id_tindakan; ?>" data-durasi="<?= $option->durasi; ?>" <?= isset($id_tindakan) && $id_tindakan == $option->id_tindakan ? 'selected' : ''; ?>>
                                    <?= $option->tindakan; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Input Durasi Awal -->
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="waktu-mulai" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="durasi-mulai" oninput="updateDurasiSelesai()" name="durasi_awal">
                    </div>
                </div>
                <!-- Input Durasi Selesai -->
                <div class="col-6">
                    <div class="mb-3">
                        <label for="waktu-akhir" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" id="durasi-selesai" name="durasi_selesai">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label">Dokter Operator</label>
                            <select data-placeholder="Choose dokter bedah" id="dokter-bedah" data-allow-clear="1" name="dokter_opr">
                                <option>Pilih Dokter Operator</option>
                                <?php foreach ($mst_dokter_opr as $option) : ?>
                                    <option value="<?= $option->inisial; ?>">
                                        <?= $option->nama_dokter; ?> - <?= $option->nama_spesialis; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label">Dokter Anestesi</label>
                            <select data-placeholder="Choose dokter bius" id="dokter-bius" name="dokter_anestesi" data-allow-clear="1">
                                <option>Pilih Dokter Anestesi</option>
                                <?php foreach ($dokter_anestesi as $option) : ?>
                                    <option value="<?= $option->inisial; ?>">
                                        <?= $option->nama_dokter; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="jenis-anestesi" class="form-label">Jenis Anestesi</label>
                        <input type="text" class="form-control" id="jenis-anestesi" name="jenis_anestesi" value="<?= isset($jenis_anestesi) ? $jenis_anestesi : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="asisten-operator" class="form-label">Asisten Operator</label>
                        <input type="text" class="form-control" id="asisten-operator" name="assisten_operator" value="<?= isset($assisten_operator) ? $assisten_operator : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="asisten-anestesi" class="form-label">Asisten Anestesi</label>
                        <input type="text" class="form-control" id="asisten-anestesi" name="assisten_anestesi" value="<?= isset($assisten_anestesi) ? $assisten_anestesi : ''; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="perawat" class="form-label">Perawat</label>
                        <input type="text" class="form-control" id="perawat" name="perawat" value="<?= isset($perawat) ? $perawat : ''; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <div class="form-group">
                            <label class="form-label">Alat Khusus</label>
                            <select multiple data-placeholder="Choose anything" id="alat-alat" name="alat_alat" data-allow-clear="1">
                                <option value="1">Pilih Alat</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6" hidden>
                    <div class="mb-3">
                        <input type="text" class="form-control" readonly id="alat" name="alat_alat_operasi">
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="kamar-operasi" class="form-label">Kamar Operasi</label>
                        <select id="kamar-operasi" class="form-select" name="kamar_operasi">
                            <option value="">Pilih Kamar Operasi</option>
                            <?php foreach ($kamar_opr as $option) : ?>
                                <option value="<?= $option->id; ?>">
                                    <?= $option->nama_ruangan; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3">
                        <label for="alat-lainnya" class="form-label">Alat Lainnya</label>
                        <textarea class="form-control" id="text-area-alat-lain" rows="3" name="alat_lain"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-info col-12">SIMPAN JADWAL</button>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha256-7dA7lq5P94hkBsWdff7qobYkp9ope/L5LQy2t/ljPLo=" crossorigin="anonymous"></script>
<!-- select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" integrity="sha256-AFAYEOkzB6iIKnTYZOdUf9FFje6lOTYdwRJKwTN5mks=" crossorigin="anonymous"></script>
<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<script>
    var tindakanOpr = <?php echo json_encode($tindakan_opr); ?>;

    $(document).ready(function() {
        $('#alat-alat').change(function() {
            var selectedValues = $(this).val();
            var selectedString = selectedValues.join(','); // Mengubah array menjadi string dengan koma sebagai pemisah

            // Memasukkan nilai selectedString ke dalam elemen dengan id 'alat'
            document.getElementById('alat').value = selectedString;
        });
    });



    function updateDurasiSelesai() {
        var selectTindakan = document.getElementById("select_tindakan");
        var durasiMulai = document.getElementById("durasi-mulai");
        var durasiSelesai = document.getElementById("durasi-selesai");
        var dokterBedahSelect = document.getElementById("dokter-bedah");
        var tanggal = document.getElementById("tanggal-operasi");

        var selectedTindakan = tindakanOpr.find(function(tindakan) {
            return tindakan.id_tindakan == selectTindakan.value;
        });

        if (selectedTindakan) {
            // durasiSelesai.value = addHoursToTime(durasiMulai.value, convertToHours(selectedTindakan.durasi));
            durasiSelesai.value = addTime(durasiMulai.value, selectedTindakan.durasi);
            if (durasiMulai.value != "") {
                fetchDokterOperatorAPI(tanggal.value, durasiSelesai.value, durasiMulai.value);
            }
        } else {
            durasiSelesai.value = getCurrentTime();
            // Clear the dokter-bedah dropdown when no tindakan is selected
            dokterBedahSelect.innerHTML = '<option value="">DOKTER TIDAK DITEMUKAN</option>';
        }
    }

    function fetchDokterOperatorAPI(tanggal, durasiSelesai, durasiMulai) {
        $.ajax({
            type: 'POST',
            url: 'fetch_dokter_operator_api', // Replace with your actual API endpoint
            data: {
                'durasi_awal': durasiMulai,
                'durasi_selesai': durasiSelesai,
                'tgl_operasi': tanggal, // Use 'tgl_operasi' instead of 'tanggal-operasi'
                'id_tindakan': $("#select_tindakan").val() // Include the selected tindakan
            },
            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {
                    populateDokterOperatorDropdown(response);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
        $.ajax({
            type: 'POST',
            url: 'fetch_dokter_anestesi_api', // Replace with your actual API endpoint
            data: {
                'durasi_awal': durasiMulai,
                'durasi_selesai': durasiSelesai,
                'tgl_operasi': tanggal, // Use 'tgl_operasi' instead of 'tanggal-operasi'
            },
            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {
                    populateDokterAnestesiDropdown(response);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
        $.ajax({
            type: 'POST',
            url: 'fetch_kamar_opr',
            data: {
                'durasi_awal': durasiMulai,
                'durasi_selesai': durasiSelesai,
                'tgl_operasi': tanggal, // Use 'tgl_operasi' instead of 'tanggal-operasi'
            }, // Replace with your actual API endpoint
            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {
                    kamarOperasiDropdown(response);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
        $.ajax({
            type: 'POST',
            url: 'fetch_alat_opr',
            data: {
                'durasi_awal': durasiMulai,
                'durasi_selesai': durasiSelesai,
                'tgl_operasi': tanggal, // Use 'tgl_operasi' instead of 'tanggal-operasi'
            }, // Replace with your actual API endpoint
            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {
                    alatOperasiDropdown(response);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }

    function populateDokterOperatorDropdown(dokterOperatorData) {
        var dokterBedahSelect = document.getElementById("dokter-bedah");

        dokterBedahSelect.innerHTML = '<option value="">Pilih Dokter Operator</option>';

        dokterOperatorData.forEach(function(dokter) {
            var option = document.createElement("option");
            option.value = dokter.nama_dokter;
            option.text = dokter.nama_dokter + ' - ' + dokter.nama_spesialis;
            dokterBedahSelect.add(option);
        });
    }

    function kamarOperasiDropdown(dokterOperatorData) {
        var kamarOperasi = document.getElementById("kamar-operasi");

        kamarOperasi.innerHTML = '<option value="">Pilih Pilih kamar Operasi</option>';

        dokterOperatorData.forEach(function(operasi) {
            var option = document.createElement("option");
            option.value = operasi.nama_ruangan;
            option.text = operasi.nama_ruangan
            kamarOperasi.add(option);
        });
    }

    function populateDokterAnestesiDropdown(dokterOperatorData) {
        var dokterAnestesiSelect = document.getElementById("dokter-bius");

        dokterAnestesiSelect.innerHTML = '<option value="">Pilih Dokter Anestesi</option>';

        dokterOperatorData.forEach(function(dokter) {
            var option = document.createElement("option");
            option.value = dokter.nama_dokter;
            option.text = dokter.nama_dokter
            dokterAnestesiSelect.add(option);
        });
    }

    function alatOperasiDropdown(dokterOperatorData) {
        var alatOperasi = document.getElementById("alat-alat");

        alatOperasi.innerHTML = '<option value="">Pilih Pilih Alat Operasi</option>';

        dokterOperatorData.forEach(function(operasi) {
            var option = document.createElement("option");
            option.value = operasi.perlengkapan;
            option.text = operasi.perlengkapan
            alatOperasi.add(option);
        });
    }

    function getCurrentTime() {
        var now = new Date();
        var hours = now.getHours().toString().padStart(2, "0");
        var minutes = now.getMinutes().toString().padStart(2, "0");
        return hours + ":" + minutes;
    }

    function convertToHours(time) {
        var parts = time.split(":");
        var hours = parseInt(parts[0]);
        var minutes = parseInt(parts[1]);
        var seconds = parseInt(parts[2]);

        var totalHours = hours + minutes / 60 + seconds / 3600;

        return totalHours;
    }

    function addHoursToTime(time, duration) {
        var parts = time.split(":");
        var hours = parseInt(parts[0]);
        var minutes = parseInt(parts[1]);

        hours = (hours + duration) % 24;

        var newHours = hours.toString().padStart(2, "0");
        var newMinutes = minutes.toString().padStart(2, "0");

        return newHours + ":" + newMinutes;
    }


    function addTime(time1, time2) {

        var parts1 = time1.split(":");
        var hours1 = parseInt(parts1[0]);
        var minutes1 = parseInt(parts1[1]);
        var seconds1 = parseInt(parts1[2] || 0); // default 0 if seconds not present

        var parts2 = time2.split(":");
        var hours2 = parseInt(parts2[0]);
        var minutes2 = parseInt(parts2[1]);
        var seconds2 = parseInt(parts2[2] || 0); // default 0 if seconds not present

        var totalSeconds = (hours1 + hours2) * 3600 + (minutes1 + minutes2) * 60 + seconds1 + seconds2;

        var hours = Math.floor(totalSeconds / 3600) % 24;
        var minutes = Math.floor((totalSeconds % 3600) / 60);
        var seconds = totalSeconds % 60;

        var newHours = hours.toString().padStart(2, "0");
        var newMinutes = minutes.toString().padStart(2, "0");
        var newSeconds = seconds.toString().padStart(2, "0");

        return newHours + ":" + newMinutes + ":" + newSeconds;
    }

    document.getElementById("durasi-mulai").addEventListener("input", updateDurasiSelesai);
</script>