<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Page</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Style untuk nomor indeks */
        .index-column {
            counter-reset: rowNumber;
        }

        .index-column td:first-child::before {
            content: counter(rowNumber);
            counter-increment: rowNumber;
        }
    </style>
</head>

<body>
    <h2 style="text-align: center;margin-bottom: 2rem;">JADWAL OPERASI RSUP DR KARYADI SEMARANG</h2>
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>NAMA</th>
                <th>OPERASI</th>
                <th>DIAGNOSA</th>
                <th>ALAT</th>
                <th>RUANGAN</th>
                <th>DOKTER OPERASI</th>
                <th>DOKTER ANESTESI</th>
                <th>TANGGAL</th>
                <th>MULAI</th>
                <th>SELESAI</th>
            </tr>
        </thead>
        <tbody class="index-column">
            <?php $index = 1; ?>
            <?php foreach ($jdwl_opr as $row) { ?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $row->nama_pasien; ?></td>
                    <td><?php echo $row->tindakan; ?></td>
                    <td><?php echo $row->diagnosa_pasien; ?></td>
                    <td><?php echo $row->alat_alat; ?></td>
                    <td><?php echo $row->kamar_operasi; ?></td>
                    <td><?php echo $row->dokter_opr; ?></td>
                    <td><?php echo $row->dokter_anestesi; ?></td>
                    <td><?php echo $row->tgl_operasi; ?></td>
                    <td><?php echo $row->durasi_mulai; ?></td>
                    <td><?php echo $row->durasi_selesai; ?></td>
                </tr>
                <?php $index++; ?>
            <?php } ?>
        </tbody>
    </table>
</body>

</html>