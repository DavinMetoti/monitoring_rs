<div class="card">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">INPUT JADWAL DOKTER OPERASI</h6>
    </div>
    <div class="card-body">
        <div id="alert"></div>
        <div>
            <div class="mb-3">
                <label for="inisial-dokter-operasi" class="form-label">INISIAL DOKTER OPERASI</label>
                <input type="text" class="form-control" id="inisial-dokter-operasi" name="inisial_dokter_operasi">
            </div>
            <div class="mb-3">
                <label for="nama-dokter-operasi" class="form-label">NAMA DOKTER OPERASI</label>
                <input type="text" class="form-control" id="nama-dokter-operasi" name="nama_dokter_operasi">
            </div>
            <div class="mb-3">
                <label for="select_spesialis" class="form-label">SPESIALIS</label>
                <select id="select_spesialis" class="form-select" name="spesialis">
                    <option value="">Pilih Spesialis</option>
                    <?php foreach ($spesialis as $row) { ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama_spesialis; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="select_sub_spesialis" class="form-label">SUB SPESIALIS</label>
                <select id="select_sub_spesialis" class="form-select" name="sub_spesialis">
                    <option value="0">Pilih Sub Spesialis</option>
                    <?php foreach ($spesialis as $row) { ?>
                        <option value="<?php echo $row->id; ?>"><?php echo $row->nama_spesialis; ?></option>
                    <?php } ?>
                </select>
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
            <div class="mb-3"><button class="btn btn-info col-12" type="button" onclick="simpanData()">Tambah</button></div>
        </div>
    </div>
</div>

<div id="data-container"></div>


<script>
    var dataSementara = [];

    function simpanData() {
        var namaDokter = document.getElementById('nama-dokter-operasi').value;
        var inisialDokter = document.getElementById('inisial-dokter-operasi').value;
        var spesialis = document.getElementById('select_spesialis').value;
        var sub_spesialis = document.getElementById('select_sub_spesialis').value;
        var hariPraktek = document.getElementById('select_hari').value;
        var jamMulai = document.getElementById('jam-mulai-operasi').value;
        var jamSelesai = document.getElementById('jam-selesai-operasi').value;
        var alertDiv = document.getElementById('alert');

        if (namaDokter == "" || spesialis == "" || hariPraktek == "" || jamMulai == "" || jamSelesai == "") {
            alertDiv.innerHTML = '<div class="alert alert-danger" role="alert">Data tidak boleh kosong</div>';
        } else {
            var data = {
                inisial: inisialDokter,
                nama_dokter: namaDokter,
                spesialis: spesialis,
                hari_praktek: hariPraktek,
                jam_praktek_mulai: jamMulai,
                jam_praktek_akhir: jamSelesai,
                sub_spesialis: sub_spesialis,
            };
            dataSementara.push(data);

            tampilkanData();
        }


    }

    function tampilkanData() {
        var container = document.getElementById('data-container');
        container.innerHTML = ''; // Bersihkan konten sebelumnya

        // Membuat tabel untuk menampilkan data
        var tabel = document.createElement('table');
        tabel.className = 'table';

        // Membuat header tabel
        var header = tabel.createTHead();
        var barisHeader = header.insertRow(0);
        var kolomHeader = ['Inisial', 'Nama Dokter', 'Spesialis', 'Hari Jaga', 'Jam Jaga', 'Jam Jaga Selesai', 'Aksi'];

        // Menambahkan kolom header
        for (var i = 0; i < kolomHeader.length; i++) {
            var th = document.createElement('th');
            th.textContent = kolomHeader[i];
            barisHeader.appendChild(th);
        }

        var hariMap = {
            "Monday": "Senin",
            "Tuesday": "Selasa",
            "Wednesday": "Rabu",
            "Thursday": "Kamis",
            "Friday": "Jumat",
            "Saturday": "Sabtu",
            "Sunday": "Minggu"
        };

        // Iterasi melalui dataSementara untuk membangun baris tabel
        for (var j = 0; j < dataSementara.length; j++) {
            (function(j) { // Closure untuk menyimpan nilai j
                var baris = tabel.insertRow(j + 1);
                var nama_spesialis = "";
                var hariIndonesia = hariMap[dataSementara[j].hari_praktek];

                $.ajax({
                    type: 'POST',
                    url: 'getSpesialis',
                    dataType: 'json',
                    data: {
                        'id_spesialis': dataSementara[j].spesialis,
                    },
                    success: function(response) {
                        if (response.success) {
                            nama_spesialis = response.spesialis.nama_spesialis;
                            // Menambahkan data ke dalam sel-sel baris tabel
                            baris.insertCell(0).textContent = dataSementara[j].inisial;
                            baris.insertCell(1).textContent = dataSementara[j].nama_dokter;
                            baris.insertCell(2).textContent = nama_spesialis;
                            baris.insertCell(3).textContent = hariIndonesia;
                            baris.insertCell(4).textContent = dataSementara[j].jam_praktek_mulai;
                            baris.insertCell(5).textContent = dataSementara[j].jam_praktek_akhir;

                            // Tombol delete
                            var deleteCell = baris.insertCell(6);
                            var deleteButton = document.createElement('button');
                            deleteButton.textContent = 'Delete';
                            deleteButton.className = 'btn btn-danger';
                            deleteButton.onclick = function() {
                                hapusData(j);
                            };
                            deleteCell.appendChild(deleteButton);
                        } else {
                            console.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + ' - ' + error);
                    }
                });
            })(j); // Panggil closure dengan nilai j
        }

        // Tombol Simpan di header tabel
        var barisHeader = tabel.insertRow(0);
        var cell = barisHeader.insertCell(0);
        cell.colSpan = kolomHeader.length;
        var simpanButton = document.createElement('button');
        simpanButton.textContent = 'Simpan';
        simpanButton.className = 'btn btn-primary';
        simpanButton.onclick = simpanDataFix;
        cell.appendChild(simpanButton);

        container.appendChild(tabel);
    }


    function hapusData(index) {
        dataSementara.splice(index, 1); // Menghapus data dari array berdasarkan indeks
        tampilkanData(); // Menampilkan ulang data setelah penghapusan
    }

    function simpanDataFix() {
        // Kirim dataSementara ke server menggunakan AJAX
        $.ajax({
            type: 'POST',
            url: 'insert_jadwal_dokter_operasi',
            contentType: 'application/json',
            data: JSON.stringify(dataSementara),
            success: function(response) {
                window.location.href = '<?= base_url('admin/master/data_dokter') ?>';

            },
            error: function(xhr, status, error) {
                console.error('Gagal menyimpan data ke server:', error);
                // Lakukan penanganan error jika diperlukan
            }
        });
    }
</script>