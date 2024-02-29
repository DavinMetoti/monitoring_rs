<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Operasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('All');
        $this->load->helper('form');
    }

    public function index()
    {
        $data['title'] = 'Monitoring Ruangan Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('admin-operator/monitor', $data);
        $this->load->view('admin-operator/footer', $data);
    }

    public function operator()
    {
        if ($this->session->userdata('status') != 'login') {
            redirect(base_url());
        } else {

            $tgl_operasi = date('Y-m-d');

            $this->db->where('tgl_operasi', $tgl_operasi);
            $this->db->where('status', 0);
            $query = $this->db->get('jadwal_opr');

            if ($query) {

                $data['jadwal_opr'] = $query->result();
            } else {

                $data['jadwal_opr'] = array();
            }

            $data['title'] = 'Operator Ruangan Operasi';

            $this->load->view('template/header', $data);
            $this->load->view('admin-operator/operator', $data);
            $this->load->view('admin-operator/footer', $data);
        }
    }

    public function getDataPasien()
    {
        $id_pasien = $this->input->post('nama-pasien');

        $this->db->select('jadwal_opr.*, mst_tindakan_opr.tindakan, mst_ruangan_opr.id AS id_kamar_operasi, spesialis.nama_spesialis, mst_jadwal_dokter_opr.nama_dokter');
        $this->db->from('jadwal_opr');
        $this->db->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan', 'left');
        $this->db->join('mst_ruangan_opr', 'jadwal_opr.kamar_operasi = mst_ruangan_opr.nama_ruangan', 'left');
        $this->db->join('mst_jadwal_dokter_opr', 'jadwal_opr.dokter_opr = mst_jadwal_dokter_opr.nama_dokter', 'left');
        $this->db->join('spesialis', 'mst_jadwal_dokter_opr.spesialis = spesialis.id', 'left');
        $this->db->where('jadwal_opr.id_jadwal_opr', $id_pasien);
        $query = $this->db->get();

        $result = $query->result_array();

        echo json_encode($result);
    }


    public function getEvent()
    {
        $this->db->select('events.*, jadwal_opr.*, mst_tindakan_opr.tindakan AS nama_tindakan_operasi');
        $this->db->from('events');
        $this->db->join('jadwal_opr', 'events.id_jadwal = jadwal_opr.id_jadwal_opr', 'left');
        $this->db->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan', 'left');
        $query = $this->db->get();
        $result = $query->result_array();

        echo json_encode($result);
    }


    public function getResource()
    {
        $query = $this->db->get('mst_ruangan_opr');
        $result = $query->result_array();

        echo json_encode($result);
    }

    public function updateMonitorOld_2()
    {
        $response = array();

        $resourceId = $this->input->post('resourceId');
        $title = $this->input->post('pasien');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $color = $this->input->post('color');
        $created_at = new DateTime();
        $id_jadwal = $this->input->post('id_jadwal');
        $tahapan = $this->input->post('tahapan');

        $existingData = $this->db->get_where('events', array('id_jadwal' => $id_jadwal))->row();

        $this->db->where('DATE(start)', date('Y-m-d'));
        $query = $this->db->get('events');
        $events_today = $query->result();

        foreach ($events_today as $event) {
            if ($end > $event->start) {
                $new_start = date('Y-m-d H:i:s', strtotime($event->start . ' +30 minutes'));
                if ($event->id_jadwal != $id_jadwal) {
                    $this->db->where('id_jadwal', $event->id_jadwal);
                    $this->db->update('events', array('start' => $new_start));
                }
            }
        }

        if ($existingData) {
            $insertData = array(
                'resourceId' => $resourceId,
                'pasien' => $title,
                'start' => $start, // Format start yang baru
                'end' => $end, // Format end yang baru
                'color' => $color,
                'created_at' => $created_at->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
                'id_jadwal' => $id_jadwal,
                'tahapan' => $tahapan,
            );

            $this->db->insert('events', $insertData);
            $previous_tahapan = $tahapan - 1;

            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->where('tahapan', 0);
            $this->db->update('events', array('start' => $end));

            if ($previous_tahapan != 0) {
                $this->db->where('tahapan', $previous_tahapan);
                $updateDataNew = array(
                    'end' => $start,
                );

                $previous_tahapan_row = $tahapan - 1;
                $this->db->where('id_jadwal', $id_jadwal);
                $this->db->where('tahapan', $previous_tahapan_row);
                $this->db->update('events', $updateDataNew);
            }

            if ($tahapan == 9) {
                $this->db->where('id_jadwal_opr', $id_jadwal);
                $this->db->update('jadwal_opr', array('status' => 1));
            }

            $response['success'] = true;
            $response['message'] = 'Data berhasil diperbarui.';
        } else {
            $insertData = array(
                'resourceId' => $resourceId,
                'pasien' => $title,
                'start' => $start, // Format start yang baru
                'end' => $end, // Format end yang baru
                'color' => $color,
                'created_at' => $created_at->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
                'id_jadwal' => $id_jadwal,
                'tahapan' => $tahapan,
            );


            $response['success'] = false;
            $response['message'] = 'Data tidak ditemukan atau proses gagal.';
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function updateMonitor()
    {
        $response = array();

        $resourceId = $this->input->post('resourceId');
        $title = $this->input->post('pasien');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $color = $this->input->post('color');
        $created_at = new DateTime();
        $id_jadwal = $this->input->post('id_jadwal');
        $tahapan = $this->input->post('tahapan');

        $previous_tahapan = $tahapan - 1;


        // $this->db->where('DATE(start)', date('Y-m-d'));
        // // $this->db->where('start >', $start);
        // $query = $this->db->get('events');
        
        $query = $this->db->query("SELECT * FROM events WHERE DATE(start) = '". date('Y-m-d')."' AND start > '".$start."'");
        $events_today = $query->result();

        // $this->db->where('id_jadwal', $id_jadwal);
        // $this->db->where('tahapan', 0);
        // $this->db->update('events', array('start' => $end));

        // if ($tahapan == 4 || $tahapan == 7) {
        //     $updateDataNew = array(
        //         'end' => $start,
        //     );

        //     $this->db->where('id_jadwal', $id_jadwal);
        //     $this->db->where('tahapan', $previous_tahapan);
        //     $this->db->update('events', $updateDataNew);
        // }

        foreach ($events_today as $event) {
            if ($end > $event->start) {
                $new_start = date('Y-m-d H:i:s', strtotime($event->start . ' +30 minutes'));
                $new_end = date('Y-m-d H:i:s', strtotime($event->end . ' +30 minutes'));
                if ($event->id_jadwal != $id_jadwal && $event->resourceId == $resourceId) {
                    $this->db->where('id_jadwal', $event->id_jadwal);
                    $this->db->update('events', array('start' => $new_start, 'end' => $new_end));
                }
            }
        }

        // if ($tahapan == 1 || $tahapan == 4 || $tahapan == 7) {
        //     $insertData = array(
        //         'resourceId' => $resourceId,
        //         'pasien' => $title,
        //         'start' => $start,
        //         'end' => $end,
        //         'color' => $color,
        //         'created_at' => $created_at->format('Y-m-d H:i:s'),
        //         'created_by' => $this->session->userdata('username'),
        //         'id_jadwal' => $id_jadwal,
        //         'tahapan' => $tahapan,
        //     );
        //     $this->db->insert('events', $insertData);
        // } else {
            $insertData = array(
                'resourceId' => $resourceId,
                'pasien' => $title,
                'end' => $end,
                'color' => $color,
                'created_at' => $created_at->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
                'id_jadwal' => $id_jadwal,
                'tahapan' => $tahapan,
            );

            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->where('tahapan', $previous_tahapan);
            $this->db->update('events', $insertData);
        // }

        if ($tahapan == 9) {


            // $this->db->where('id_jadwal', $id_jadwal);
            // // $this->db->where('tahapan', 0);
            // $this->db->delete('events', array('tahapan' => 0));
            
            $this->db->where('id_jadwal_opr', $id_jadwal);
            $this->db->update('jadwal_opr', array('status' => 1));
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }





    public function updateMonitor_old()
    {
        $resourceId = $this->input->post('resourceId');
        $title = $this->input->post('title');
        $start = $this->input->post('start');
        $end = $this->input->post('end');
        $color = $this->input->post('color');
        $created_at = new DateTime();
        $id_jadwal = $this->input->post('id_jadwal');
        $tahapan = $this->input->post('tahapan');
        $startDateTime = new DateTime($start);
        $endDateTime = new DateTime($end);

        $formattedStart = $startDateTime->format('Y-m-d\TH:i:sP');
        $formattedEnd = $endDateTime->format('Y-m-d\TH:i:sP');

        $existingData = $this->db->get_where('events', array('id_jadwal' => $id_jadwal, 'tahapan' => $tahapan))->row();

        if ($existingData) {

            if ($endDateTime > $existingData->end) {
                $updateData = array(
                    'end' => $formattedEnd, // Format end yang baru
                );

                $this->db->where('id_jadwal', $id_jadwal);
                $this->db->where('tahapan', $tahapan);
                $this->db->update('events', $updateData);
            }
        } else {

            $newEndDateTime = $startDateTime->modify('-1 second'); // Kurangi 1 detik dari waktu $start

            $insertData = array(
                'resourceId' => $resourceId,
                'title' => $title,
                'start' => $formattedStart, // Format start yang baru
                'end' => $end, // Format end yang baru
                'color' => $color,
                'created_at' => $created_at->format('Y-m-d H:i:s'),
                'created_by' => $this->session->userdata('username'),
                'id_jadwal' => $id_jadwal,
                'tahapan' => $tahapan,
            );

            $this->db->insert('events', $insertData);
        }

        $previousStep = $tahapan - 1;
        $previousData = $this->db->get_where('events', array('id_jadwal' => $id_jadwal, 'tahapan' => $previousStep))->row();

        if ($previousData) {

            $previousEndDateTime = new DateTime($start);
            $previousEndDateTime->modify('-1 second');

            $updatePreviousData = array(
                'end' => $previousEndDateTime->format('Y-m-d\TH:i:sP'),
            );

            $this->db->where('id_jadwal', $id_jadwal);
            $this->db->where('tahapan', $previousStep);
            $this->db->update('events', $updatePreviousData);
        }
    }
}
