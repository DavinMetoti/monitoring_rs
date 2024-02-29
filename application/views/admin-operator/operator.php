<div class="container-fluid mt-4">
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="ti ti-navigation-up"></i></button>
    <div class="d-flex justify-content-between align-items-stretch mt-5 mb-5">
        <button class="btn btn-danger col mr-2" onclick="updateAndInsert(1)" id="btn-1">SIGN IN</button>
        <button class="btn btn-danger col mr-2" onclick="updateAndInsert(2)" id="btn-2">MULAI INDUKSI</button>
        <button class="btn btn-danger col mr-2" onclick="updateAndInsert(3)" id="btn-3">SELESAI INDUKSI</button>
        <button class="btn btn-warning col mr-2" onclick="updateAndInsert(4)" id="btn-4">TIME OUT</button>
        <button class="btn btn-warning col mr-2" onclick="updateAndInsert(5)" id="btn-5">INCISI</button>
        <button class="btn btn-warning col mr-2" onclick="updateAndInsert(6)" id="btn-6">SIGN OUT</button>
        <button class="btn btn-success col mr-2" onclick="updateAndInsert(7)" id="btn-7">CLOSURE</button>
        <button class="btn btn-success col mr-2" onclick="updateAndInsert(8)" id="btn-8">EXTUBASI</button>
        <button class="btn btn-success col mr-2" onclick="updateAndInsert(9)" id="btn-9">TRANFER</button>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">DATA PASIEN</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="nama-pasien-dropdown" class="form-label">Nama Pasien</label>
                            <select id="nama-pasien-dropdown" class="nama-pasien-dropdown form-select" name="nama-pasien" onchange="getDataPasien(this.value)">
                                <option value="">Pilih Nama Pasien</option>
                                <?php foreach ($jadwal_opr as $row) { ?>
                                    <option value="<?php echo $row->id_jadwal_opr; ?>" data-pasien='<?php echo json_encode($row->data_pasien); ?>'><?php echo $row->nama_pasien. " - ". $row->kamar_operasi. " - ".$row->durasi_mulai; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="no-registrasi" class="form-label">No Registrasi</label>
                            <input type="text" class="form-control" id="no-registrasi" name="no-registrasi">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="no-rm" class="form-label">No RM</label>
                            <input type="text" class="form-control" id="no-rm" name="no-rm">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="tanggal-lahir" class="form-label">Tanggal Lahir</label>
                            <input type="text" class="form-control" id="tanggal-lahir" name="tanggal-lahir">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <input type="text" class="form-control" id="gender" name="gender">
                        </div>
                    </div>
                    <!-- <div class="col-12">
                        <div class="mb-3">
                            <label for="debitur" class="form-label">Debitur</label>
                            <input type="text" class="form-control" id="debitur" name="debitur">
                        </div>
                    </div> -->
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas">
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="mb-3">
                            <label for="ruang-rawat" class="form-label">Ruang Rawat</label>
                            <input type="text" class="form-control" id="ruang-rawat" name="ruang-rawat">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">ORDER OPERASI</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="jenis-operasi" class="form-label">Jenis Operasi</label>
                                    <input type="text" class="form-control" id="jenis-operasi" name="jenis-operasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="rencana-operasi" class="form-label">Rencana Operasi</label>
                                    <input type="text" class="form-control" id="rencana-operasi" name="rencana-operasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="ruang-operasi" class="form-label">Ruang Operasi</label>
                                    <input type="text" class="form-control" id="ruang-operasi" name="ruang-operasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="rencana-tind-anestesi" class="form-label">Rencana Tind Anestesi</label>
                                    <input type="text" class="form-control" id="rencana-tind-anestesi" name="rencana-tind-anestesi">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">VERIFIKASI ORDER</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="jadwal-operasi" class="form-label">Jadwal Operasi</label>
                                    <input type="text" class="form-control" id="jadwal-operasi" name="jadwal-operasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="serah-terima" class="form-label">Serah Terima</label>
                                    <input type="text" class="form-control" id="serah-terima" name="serah-terima">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="spesialisasi" class="form-label">Spesialisasi</label>
                                    <input type="text" class="form-control" id="spesialisasi" name="spesialisasi">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="estimasi-waktu" class="form-label">Estimasi Waktu (MENIT)</label>
                                    <input type="text" class="form-control" id="estimasi-waktu" name="estimasi-waktu">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">OPERATOR DAN DPJP ANASTESI</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card shadow bg-success ">
                                <div class="card-body text-white font-weight-bold">
                                    <p id="dokter-opr-not-null">Pasien Belum dipilih</p>
                                    <p id="dokter-opr-null" style="display: none;">Pasien Belum dipilih</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow bg-success ">
                                <div class="card-body text-white font-weight-bold">
                                    <p id="dokter-ant-not-null">Pasien Belum dipilih</p>
                                    <p id="dokter-ant-null" style="display: none;">Pasien Belum dipilih</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow bg-secondary ">
                                <div class="card-body text-white font-weight-bold">
                                    <p id="kamar-not-null">Pasien Belum dipilih</p>
                                    <p id="kamar-null" style="display: none;">Pasien Belum dipilih</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">DIAGNOSA OPERASI</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <textarea class="form-control" id="text-area-diagnosa" rows="3" name="diagnosa"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">TINDAKAN OPERASI</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="col-12">
                                <div class="mb-3">
                                    <textarea class="form-control" id="text-area-tindakan" rows="3" name="tindakan"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function getDataPasien(key) {
        var button1 = document.getElementById("btn-1");
        button1.innerHTML = 'SIGN IN';
        var button2 = document.getElementById("btn-2");
        button2.innerHTML = 'MULAI INDUKSI';
        var button3 = document.getElementById("btn-3");
        button3.innerHTML = 'SELESAI INDUKSI';
        var button4 = document.getElementById("btn-4");
        button4.innerHTML = 'TIME OUT';
        var button5 = document.getElementById("btn-5");
        button5.innerHTML = 'INCISI';
        var button6 = document.getElementById("btn-6");
        button6.innerHTML = 'SIGN OUT';
        var button7 = document.getElementById("btn-7");
        button7.innerHTML = 'CLOSURE';
        var button8 = document.getElementById("btn-8");
        button8.innerHTML = 'EXTUBASI';
        var button9 = document.getElementById("btn-9");
        button9.innerHTML = 'TRANSFER';
        $.ajax({
            type: 'POST',
            url: 'getDataPasien', // Ganti dengan endpoint API yang sesuai
            data: {
                'nama-pasien': key,
            },
            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {
                    setValue(response);
                } else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }

    function setValue(result) {
        var register = document.getElementById('no-registrasi');
        var nomor_rm = document.getElementById('no-rm');
        var ruang_operasi = document.getElementById('ruang-operasi');
        var jenis_operasi = document.getElementById('jenis-operasi');
        var rencana_operasi = document.getElementById('rencana-operasi');
        var serah_terima = document.getElementById('serah-terima');
        var spesialisasi = document.getElementById('spesialisasi');
        var estimasi_waktu = document.getElementById('estimasi-waktu');
        var renc_anestesi = document.getElementById('rencana-tind-anestesi');
        var gender = document.getElementById('gender');
        var tanggallahir = document.getElementById('tanggal-lahir');
        var kelas = document.getElementById('kelas');
        var ruangRawat = document.getElementById('ruang-rawat');
        var jadwal_opr = document.getElementById('jadwal-operasi');
        var dokterOprNull = document.getElementById('dokter-opr-null');
        var dokterOprNotNull = document.getElementById('dokter-opr-not-null');
        var dokterantNull = document.getElementById('dokter-ant-null');
        var dokterantNotNull = document.getElementById('dokter-ant-not-null');
        var kamarNull = document.getElementById('kamar-null');
        var kamarNotNull = document.getElementById('kamar-not-null');
        var diagnosaTextArea = document.getElementById('text-area-diagnosa');
        var tindakanTextArea = document.getElementById('text-area-tindakan');
        var durasiMulaiSplit = result[0].durasi_mulai.split(":");
        var durasiSelesaiSplit = result[0].durasi_selesai.split(":");
        var durasiMulaiMenit = parseInt(durasiMulaiSplit[0]) * 60 + parseInt(durasiMulaiSplit[1]);
        var durasiSelesaiMenit = parseInt(durasiSelesaiSplit[0]) * 60 + parseInt(durasiSelesaiSplit[1]);
        var selisihMenit = durasiSelesaiMenit - durasiMulaiMenit;

        if (result.length > 0) {
            register.value = result[0].register;
            nomor_rm.value = result[0].nomor_rm;
            spesialisasi.value = result[0].nama_spesialis;
            jenis_operasi.value = result[0].tindakan;
            rencana_operasi.value = result[0].nama_spesialis;
            serah_terima.value = result[0].jam_serah_terima;
            ruang_operasi.value = result[0].kamar_operasi;
            renc_anestesi.value = result[0].jenis_anestesi;
            gender.value = result[0].jenis_kelamin == 1 ? 'L' : 'P';
            tanggallahir.value = result[0].tgl_lahir_pasien;
            kelas.value = result[0].kelas_pasien;
            ruangRawat.value = result[0].ruangan_pasien;
            jadwal_opr.value = result[0].tgl_operasi;
            estimasi_waktu.value = selisihMenit;

            dokterOprNotNull.textContent = result[0].dokter_opr;
            dokterOprNull.style.display = 'none';
            dokterOprNotNull.style.display = 'block';
            dokterantNotNull.textContent = result[0].dokter_anestesi;
            dokterantNull.style.display = 'none';
            dokterantNotNull.style.display = 'block';
            kamarNotNull.textContent = result[0].kamar_operasi;
            kamarNull.style.display = 'none';
            kamarNotNull.style.display = 'block';
            diagnosaTextArea.value = result[0].diagnosa_pasien;
            tindakanTextArea.value = result[0].tindakan;
        } else {
            register.value = '';
            gender.value = '';
            tanggallahir.value = '';
            kelas.value = '';
            ruangRawat.value = '';
            jadwal_opr.value = '';

            dokterOprNull.textContent = "Pasien Belum dipilih";
            dokterOprNotNull.style.display = 'none';
            dokterOprNull.style.display = 'block';
            dokterantNull.textContent = "Pasien Belum dipilih";
            dokterantNotNull.style.display = 'none';
            dokterantNull.style.display = 'block';
            kamarNull.textContent = "Pasien Belum dipilih";
            kamarNotNull.style.display = 'none';
            kamarNull.style.display = 'block';
        }
    }

    function updateAndInsert(key) {
        var pasien = document.getElementById('nama-pasien-dropdown').value; // Ambil nilai dari elemen
        if (pasien == null || pasien == "") {
            butterup.toast({
                title: 'Gagal',
                message: 'Pasien Belum Terpilih',
                type: 'error',
            });
        } else {
            $.ajax({
                type: 'POST',
                url: 'getDataPasien',
                data: {
                    'nama-pasien': pasien
                },
                dataType: 'json',
                success: function(response) {
                    if (response.length != 0) {
                        insertUpdateEvent(key, response)
                    } else {
                        console.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + ' - ' + error);
                }
            });
        }
    }

    function insertUpdateEvent(key, params) {
        var now = new Date();
        var start = formatDate(now);
        var last = new Date(now.getTime());
        var end = formatDate(last);
        var startNew = formatDateNew(now)
        var buttonId = 'btn-' + key;
        var button = document.getElementById(buttonId);
        if (key == 1) {
            button.innerHTML = 'SIGN IN';
        } else if (key == 2) {
            button.innerHTML = 'MULAI INDUKSI';
        } else if (key == 3) {
            button.innerHTML = 'SELESAI INDUKSI';
        } else if (key == 4) {
            button.innerHTML = 'TIME OUT';
        } else if (key == 5) {
            button.innerHTML = 'INCISI';
        } else if (key == 6) {
            button.innerHTML = 'SIGN OUT';
        } else if (key == 7) {
            button.innerHTML = 'CLOSURE';
        } else if (key == 8) {
            button.innerHTML = 'EXTUBASI';
        } else {
            button.innerHTML = 'TRANSER';

        }
        
        // if (key == 4) {
            // now.setMinutes(now.getMinutes());
            // start = formatDate(now);
            // last = new Date(now.getTime() + 30 * 60000);
            // end = formatDate(last);
        // }
        // if (key == 7) {
        //     now.setMinutes(now.getMinutes() + 20);
        //     start = formatDate(now);
        //     last = new Date(now.getTime() + 30 * 60000);
        //     end = formatDate(last);
        // }

        if (button) {
            button.innerHTML += ' ' + startNew;
        }

        $.ajax({
            type: 'POST',
            url: 'updateMonitor',
            data: {
                'resourceId': params[0].id_kamar_operasi,
                'pasien': params[0].nama_pasien,
                'start': start,
                'end': end,
                'color': getColor(key), // Fungsi untuk mendapatkan warna berdasarkan key
                'id_jadwal': params[0].id_jadwal_opr,
                'tahapan': key
            },


            dataType: 'json',
            success: function(response) {
                if (response.length != 0) {} else {
                    console.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error: ' + status + ' - ' + error);
            }
        });
    }


    // Fungsi untuk memformat waktu menjadi "YYYY-MM-DDTHH:MM:SS±HH:MM"
    function formatDate(date) {
        var year = date.getFullYear();
        var month = padNumber(date.getMonth() + 1);
        var day = padNumber(date.getDate());
        var hours = padNumber(date.getHours());
        var minutes = padNumber(date.getMinutes());
        var seconds = padNumber(date.getSeconds());
        var offset = -date.getTimezoneOffset() / 60;
        var offsetHours = padNumber(Math.abs(offset));
        var offsetMinutes = padNumber(Math.abs((offset * 60) % 60));
        var offsetSign = offset >= 0 ? '+' : '-';

        return `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
    }

    function formatDateNew(date) {
        var year = date.getFullYear();
        var month = padNumber(date.getMonth() + 1);
        var day = padNumber(date.getDate());
        var hours = padNumber(date.getHours());
        var minutes = padNumber(date.getMinutes());
        var seconds = padNumber(date.getSeconds());
        var offset = -date.getTimezoneOffset() / 60;
        var offsetHours = padNumber(Math.abs(offset));
        var offsetMinutes = padNumber(Math.abs((offset * 60) % 60));
        var offsetSign = offset >= 0 ? '+' : '-';

        return `${hours}:${minutes}:${seconds}`;
    }

    // Fungsi untuk menambahkan nol di depan angka jika kurang dari 10
    function padNumber(number) {
        return (number < 10 ? '0' : '') + number;
    }

    // Fungsi untuk mendapatkan warna berdasarkan key
    function getColor(key) {
        if (key == 1 || key == 2 || key == 3) {
            return 'red';
        } else if (key == 4 || key == 5 || key == 6) {
            return 'orange';
        } else {
            return 'green';
        }
    }
</script>