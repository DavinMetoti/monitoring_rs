<?php
defined('BASEPATH') or exit('No direct script access allowed');

class All extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function selectAll($table)
    {
        $query = $this->db->get($table);
        return $query->result();
    }

    public function selectWhere($table, $data)
    {
        $this->db->select('jadwal_opr.*');
        $this->db->from('jadwal_opr');
        $this->db->where('jadwal_opr.dokter_anestesi', $data);
        $query = $this->db->get();
        $count = $query->num_rows();
        return $query->result();
    }


    public function insertAll($table, $data)
    {
        $query = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }

    public function selectAllJoinSpesialis()
    {
        $this->db->select('mst_jadwal_dokter_opr.*, spesialis.nama_spesialis AS spesialis_nama, sub_spesialis.nama_spesialis AS sub_spesialis_nama');
        $this->db->from('mst_jadwal_dokter_opr');
        $this->db->join('spesialis', 'spesialis.id = mst_jadwal_dokter_opr.spesialis', 'left');
        $this->db->join('spesialis AS sub_spesialis', 'sub_spesialis.id = mst_jadwal_dokter_opr.sub_spesialis', 'left');

        $this->db->order_by('CAST(jam_praktek_mulai AS UNSIGNED)', 'asc');

        $query = $this->db->get();
        return $query->result();
    }

    public function getDokterByHariPraktekAndDurasi($tanggal_operasi, $hari_praktek, $durasi_awal, $durasi_selesai)
    {
        $this->db->select('mst_jadwal_dokter_opr.*, spesialis.nama_spesialis');
        $this->db->from('mst_jadwal_dokter_opr');
        $this->db->join('spesialis', 'spesialis.id = mst_jadwal_dokter_opr.spesialis');
        $this->db->where('mst_jadwal_dokter_opr.hari_praktek', $hari_praktek);
        $this->db->group_start();
        $this->db->where('(mst_jadwal_dokter_opr.jam_praktek_mulai IS NOT NULL AND mst_jadwal_dokter_opr.jam_praktek_mulai >', $durasi_selesai);
        $this->db->or_where('mst_jadwal_dokter_opr.jam_praktek_mulai IS NULL)', NULL, false);
        $this->db->or_where('(mst_jadwal_dokter_opr.jam_praktek_akhir IS NOT NULL AND mst_jadwal_dokter_opr.jam_praktek_akhir <', $durasi_awal);
        $this->db->or_where('mst_jadwal_dokter_opr.jam_praktek_akhir IS NULL)', NULL, false);
        $this->db->group_end();


        $query = $this->db->get();
        $result = $query->result();

        $filtered_result = array();
        foreach ($result as $dokter) {
            $this->db->from('jadwal_opr');
            $this->db->where('dokter_opr', $dokter->nama_dokter);
            $this->db->where('tgl_operasi', $tanggal_operasi);
            $this->db->where('durasi_mulai <', $durasi_selesai);
            $this->db->where('durasi_selesai >', $durasi_awal);
            $count = $this->db->count_all_results();

            if ($count < 1) {
                $filtered_result[] = $dokter;
            }
        }

        return $filtered_result;
    }



    public function getDokterAnestesiByHariPraktekAndDurasi($tanggal_operasi, $hari_praktek, $durasi_awal, $durasi_selesai)
    {
        $this->db->select('mst_jadwal_dokter_ant.*');
        $this->db->from('mst_jadwal_dokter_ant');
        $this->db->where('mst_jadwal_dokter_ant.hari_praktek', $hari_praktek);
        $this->db->group_start();
        $this->db->where('(mst_jadwal_dokter_ant.jam_praktek_mulai IS NOT NULL AND mst_jadwal_dokter_ant.jam_praktek_mulai >', $durasi_selesai);
        $this->db->or_where('mst_jadwal_dokter_ant.jam_praktek_mulai IS NULL)', NULL, false);
        $this->db->or_where('(mst_jadwal_dokter_ant.jam_praktek_selesai IS NOT NULL AND mst_jadwal_dokter_ant.jam_praktek_selesai <', $durasi_awal);
        $this->db->or_where('mst_jadwal_dokter_ant.jam_praktek_selesai IS NULL)', NULL, false);
        $this->db->group_end();
        $query = $this->db->get();
        $result = $query->result();


        $filtered_result = array();
        // $arrays = array();
        // $arrays["numrows1"] =  $query->num_rows();
        foreach ($result as $dokter) {
            $this->db->select('jadwal_opr.*');
            $this->db->from('jadwal_opr');
            $this->db->where('dokter_anestesi', $dokter->nama_dokter);
            $this->db->where('tgl_operasi', $tanggal_operasi);
            $this->db->where('durasi_mulai <', $durasi_selesai);
            $this->db->where('durasi_selesai >', $durasi_awal);
            // $count = $this->db->count_all_results();
            $count = $this->db->get();
            $results = $count->num_rows();
            $arrays["numrows2"] = $results;


            if ($results < 2) {
                $filtered_result[] = $dokter;
            }
        }

        // return $filtered_result;
        return $filtered_result;
    }

    public function getRuanganOperasi($tanggal, $durasi_awal, $durasi_selesai)
    {
        // Ambil data ruangan operasi
        $query = $this->db->get('mst_ruangan_opr');
        $result = $query->result();
        $filtered_result = array();

        foreach ($result as $ruangan) {
            // Hitung jumlah jadwal operasi di ruangan operasi yang sama
            $this->db->where('kamar_operasi', $ruangan->nama_ruangan);
            $this->db->where('tgl_operasi', $tanggal);
            $this->db->where('durasi_mulai <', $durasi_selesai);
            $this->db->where('durasi_selesai >', $durasi_awal);

            $count = $this->db->count_all_results('jadwal_opr');

            // Jika jumlah jadwal operasi kurang dari 2 dan tidak ada tumpang tindih dengan jadwal yang ada, tambahkan ke hasil filter
            if ($count < 1) {
                $filtered_result[] = $ruangan;
            }
        }
        return $filtered_result;
    }

    public function getPeralatanOperasi($tanggal, $durasi_awal, $durasi_selesai)
    {
        $this->db->where('status', 1);
        $perlengkapan = $this->db->get('perlengkapan')->result();

        $filtered_result = array();

        foreach ($perlengkapan as $key => $item) {
            $this->db->select('*');
            $this->db->from('jadwal_opr');
            $this->db->where('durasi_mulai <', $durasi_selesai);
            $this->db->where('durasi_selesai >', $durasi_awal);
            $this->db->where('tgl_operasi', $tanggal);
            $this->db->like('alat_alat', $item->perlengkapan);
            $query = $this->db->get();
            $used_qty = $query->num_rows();
            $perlengkapan[$key]->qty = $perlengkapan[$key]->qty - $used_qty;

            if ($perlengkapan[$key]->qty < 0) {
                $perlengkapan[$key]->qty = 0;
            }
            if ($perlengkapan[$key]->qty != 0) {
                $filtered_result[] = $perlengkapan[$key];
            }
        }

        return $filtered_result;
    }
}
