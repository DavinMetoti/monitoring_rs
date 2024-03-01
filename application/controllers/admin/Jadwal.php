<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


class Jadwal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('status') != 'login') {
			redirect(base_url());
		}
		$this->load->model('All');
		$this->load->helper('form');
	}

	public function index()
	{
		redirect('admin/jadwal/monitoring');
	}

	public function monitoring()
	{
		$data['title'] = 'Admin Dashboard'; // Set the page title

		// Load views
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin-jadwal/dashboard/monitor');
		$this->load->view('template/footer');
	}

	public function data_jadwal()
	{
		// $data['tindakan_opr'] = $this->All->selectAll('mst_tindakan_opr');
		$data['jdwl_opr'] = $this->db->select('jadwal_opr.*, mst_tindakan_opr.tindakan as nama_tindakan_operasi')
			->from('jadwal_opr')
			->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan')
			->where('jadwal_opr.status', 0)
			->get()
			->result();

		$data['title'] = 'Jadwal Operasi'; // Set the page title

		// Load views
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin-jadwal/dashboard/jadwal', $data);
		$this->load->view('template/footer');
	}

	public function delete_jadwal($id)
	{
		// Query untuk memeriksa jumlah data terkait di tabel events_id_jadwal
		$this->db->where('id_jadwal', $id);
		$this->db->from('events');
		$count = $this->db->count_all_results();

		if ($count > 1) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus karena sedang berjalan</div>');
			redirect('admin/jadwal/data_jadwal');
		} else {
			$this->db->trans_start();
			$this->db->where('id_jadwal_opr', $id);
			$this->db->delete('jadwal_opr', array('id_jadwal_opr' => $id));
			$this->db->delete('events', array('id_jadwal' => $id));
			$this->db->trans_complete();
			if ($this->db->trans_status() === FALSE) {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus jadwal</div>');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus jadwal</div>');
			}

			redirect('admin/jadwal/data_jadwal');
		}
	}


	public function edit_jadwal($id)
	{
		$this->db->where('id_jadwal_opr', $id);
		$data['jadwal_operasi'] = $this->db->get('jadwal_opr')->row();
		$data['title'] = 'Edit Jadwal Operasi';
		$data['tindakan_opr'] = $this->All->selectAll('mst_tindakan_opr');

		// Load views
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin-jadwal/dashboard/edit-jadwal', $data);
		$this->load->view('template/footer');
	}

	public function buat_jadwal_operasi()
	{
		$this->db->where('status', 1);
		$data['tindakan_opr'] = $this->db->get('mst_tindakan_opr')->result();
		$data['title'] = 'Buat Jadwal Operasi'; // Set the page title

		// Load views
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar');
		$this->load->view('template/topbar');
		$this->load->view('admin-jadwal/dashboard/buat-jadwal', $data);
		$this->load->view('template/footer');
	}

	public function fetch_dokter_operator_api()
	{
		$tgl_operasi = $this->input->post('tgl_operasi');
		$durasi_awal = $this->input->post('durasi_awal');
		$durasi_selesai = $this->input->post('durasi_selesai');
		$tindakan = $this->input->post('id_tindakan');
		$diagnosa_operasi = $this->input->post('diagnosa_operasi');
		$hari_operasi = date('l', strtotime($tgl_operasi));

		// Assuming getDokterByHariPraktekAndDurasi returns the desired result
		$result = $this->All->getDokterByHariPraktekAndDurasi($tgl_operasi, $hari_operasi, $durasi_awal, $durasi_selesai);

		// Check if the result is not empty before encoding and sending the JSON response
		if ($result !== null) {
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			// Handle the case where the result is empty or there is an error
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Unable to fetch dokter operator data.']);
		}
	}

	public function fetch_dokter_anestesi_api()
	{
		$tgl_operasi = $this->input->post('tgl_operasi');
		$durasi_awal = $this->input->post('durasi_awal');
		$durasi_selesai = $this->input->post('durasi_selesai');
		$tindakan = $this->input->post('id_tindakan');
		$diagnosa_operasi = $this->input->post('diagnosa_operasi');
		$hari_operasi = date('l', strtotime($tgl_operasi));

		// Assuming getDokterByHariPraktekAndDurasi returns the desired result
		$result = $this->All->getDokterAnestesiByHariPraktekAndDurasi($tgl_operasi, $hari_operasi, $durasi_awal, $durasi_selesai);

		// Check if the result is not empty before encoding and sending the JSON response
		if ($result !== null) {
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			// Handle the case where the result is empty or there is an error
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Unable to fetch dokter operator data.']);
		}
	}

	public function fetch_kamar_opr()
	{
		$tgl_operasi = $this->input->post('tgl_operasi');
		$durasi_awal = $this->input->post('durasi_awal');
		$durasi_selesai = $this->input->post('durasi_selesai');
		$result = $this->All->getRuanganOperasi($tgl_operasi, $durasi_awal, $durasi_selesai);
		if ($result !== null) {
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			// Handle the case where the result is empty or there is an error
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Unable to fetch kamar operasi data.']);
		}
	}

	public function fetch_alat_opr()
	{
		$tgl_operasi = $this->input->post('tgl_operasi');
		$durasi_awal = $this->input->post('durasi_awal');
		$durasi_selesai = $this->input->post('durasi_selesai');
		$result = $this->All->getPeralatanOperasi($tgl_operasi, $durasi_awal, $durasi_selesai);
		if ($result !== null) {
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			// Handle the case where the result is empty or there is an error
			header('Content-Type: application/json');
			echo json_encode(['status' => 'error', 'message' => 'Unable to fetch kamar operasi data.']);
		}
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

	public function generatePDF()
	{
		// Ambil tanggal jadwal dari inputan post
		$tgl = $this->input->post('tgl_jadwal');

		// Lakukan kueri untuk mendapatkan jadwal operasi berdasarkan tanggal
		$this->db->select('jadwal_opr.*, mst_tindakan_opr.tindakan, mst_ruangan_opr.id AS id_kamar_operasi');
		$this->db->from('jadwal_opr');
		$this->db->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan', 'left');
		$this->db->join('mst_ruangan_opr', 'jadwal_opr.kamar_operasi = mst_ruangan_opr.nama_ruangan', 'left');
		$this->db->where('jadwal_opr.tgl_operasi', $tgl);
		$query = $this->db->get();

		// Ambil hasil kueri
		$data['jdwl_opr'] = $query->result();

		// Periksa apakah hasilnya kosong, jika iya, keluarkan pesan dan hentikan eksekusi
		if (empty($data['jdwl_opr'])) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Tidak ditemukan jadwal</div>');
			redirect('admin/jadwal/data_jadwal');
		}

		// Load library MPDF
		$mpdf = new \Mpdf\Mpdf(['orientation' => 'L']);

		// Load view print_page dengan data jadwal operasi
		$html = $this->load->view('admin-jadwal/dashboard/print_page', $data, true);

		// Tulis HTML ke dokumen PDF
		$mpdf->WriteHTML($html);

		// Tampilkan atau unduh dokumen PDF
		$mpdf->Output();
	}

	public function export_excel()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();	

		foreach (range("A", "S") as $coulumID) {
			$spreadsheet->getActiveSheet()->getColumnDimension($coulumID)->setAutoSize(true);
		}

		$sheet->setCellValue('A1', "NO");
		$sheet->setCellValue('B1', "NAMA PASIEN");
		$sheet->setCellValue('C1', "KELAS");
		$sheet->setCellValue('D1', "TGL LAHIR");
		$sheet->setCellValue('E1', "L/P");
		$sheet->setCellValue('F1', "RUANG");
		$sheet->setCellValue('G1', "NO MR");
		$sheet->setCellValue('H1', "REGISTER");
		$sheet->setCellValue('I1', "DIAGNOSA");
		$sheet->setCellValue('J1', "TINDAKAN");
		$sheet->setCellValue('K1', "TAMBAHAN ALAT");
		$sheet->setCellValue('L1', "OPERATOR");
		$sheet->setCellValue('M1', "ASISTEN");
		$sheet->setCellValue('N1', "PERAWAT");
		$sheet->setCellValue('O1', "OK");
		$sheet->setCellValue('P1', "JNS ANESTESI");
		$sheet->setCellValue('Q1', "DPJP ANESTESI");
		$sheet->setCellValue('R1', "JAM SERAH TERIMA");
		$sheet->setCellValue('S1', "JAM MULAI");
		$sheet->setCellValue('T1', "JAM SELESAI");

		$tgl_operasi = $this->input->post('tgl_operasi');
		$tgl_operasi_baru = date('Y-m-d', strtotime($tgl_operasi));
		$this->db->select('jadwal_opr.*, mst_tindakan_opr.tindakan as nama_tindakan_operasi');
		$this->db->from('jadwal_opr');
		$this->db->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan');
		$this->db->where('jadwal_opr.tgl_operasi', $tgl_operasi_baru);
		$data = $this->db->get()->result_array();
		$x = 1;
		foreach ($data as $row) {
			$x++;
			$sheet->setCellValue('A' . $x, $x - 1);
			$sheet->setCellValue('B' . $x, $row['nama_pasien']);
			$sheet->setCellValue('C' . $x, $row['kelas_pasien']);
			$sheet->setCellValue('D' . $x, $row['tgl_lahir_pasien']);
			$sheet->setCellValue('E' . $x, $row['jenis_kelamin']);
			$sheet->setCellValue('F' . $x, $row['ruangan_pasien']);
			$sheet->setCellValue('G' . $x, $row['nomor_rm']);
			$sheet->setCellValue('H' . $x, $row['register']);
			$sheet->setCellValue('I' . $x, $row['diagnosa_pasien']);
			$sheet->setCellValue('J' . $x, $row['nama_tindakan_operasi']);
			$sheet->setCellValue('K' . $x, $row['alat_alat']);
			$sheet->setCellValue('L' . $x, $row['dokter_opr']);
			$sheet->setCellValue('M' . $x, $row['dokter_a_opr']);
			$sheet->setCellValue('N' . $x, $row['perawat']);
			$sheet->setCellValue('O' . $x, $row['kamar_operasi']);
			$sheet->setCellValue('P' . $x, $row['jenis_anestesi']);
			$sheet->setCellValue('Q' . $x, $row['dokter_anestesi']);
			$sheet->setCellValue('R' . $x, $row['jam_serah_terima']);
			$sheet->setCellValue('S' . $x, $row['durasi_mulai'].':00');
			$sheet->setCellValue('T' . $x, $row['durasi_selesai']);
		}
		$fileName = 'Jadwal-OK-' . $tgl_operasi . ".xlsx";
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $fileName . '"');     
		header('Cache-Control: max-age=0');
		$writer = new Xlsx($spreadsheet);
		$writer->save('php://output');
		exit;
	}

	public function insert_jadwal()
	{
		$nama_pasien = $this->input->post('nama_pasien');
		$rekam_medis = $this->input->post('rekam_medis');
		$kelas_pasien = $this->input->post('kelas_pasien');
		$tgl_lahir_pasien = $this->input->post('tgl_lahir_pasien');
		$jns_kelamin = $this->input->post('gender');
		$ruangan_pasien = $this->input->post('ruangan_pasien');
		$register_pasien = $this->input->post('register_pasien');
		$tgl_operasi = $this->input->post('tgl_operasi');
		$durasi_awal = $this->input->post('durasi_awal');
		$durasi_selesai = $this->input->post('durasi_selesai');
		$tindakan = $this->input->post('id_tindakan');
		$diagnosa_operasi = $this->input->post('diagnosa_operasi');
		$alat_alat_array = $this->input->post('alat_alat_operasi');
		$kamar_operasi = $this->input->post('kamar_operasi');
		$dokter_opr = $this->input->post('dokter_opr');
		$a_dokter_opr = $this->input->post('assisten_operator');
		$anestesi = $this->input->post('dokter_anestesi');
		$a_dokter_ant = $this->input->post('assisten_anestesi');
		$perawat = $this->input->post('perawat');
		$jenis_anestesi = $this->input->post('jenis_anestesi');
		$jam_serah_terima = $this->input->post('jam_serah_terima');
		$alat_lain = $this->input->post('alat_lain');
		$created_at = new DateTime();
		$created_at_formatted = $created_at->format('Y-m-d H:i:s');

		$jadwal_opr = array(
			'nama_pasien' => $nama_pasien,
			'nomor_rm' => $rekam_medis,
			'kelas_pasien' => $kelas_pasien,
			'tgl_lahir_pasien' => $tgl_lahir_pasien,
			'jenis_kelamin' => $jns_kelamin,
			'ruangan_pasien' => $ruangan_pasien,
			'register' => $register_pasien,
			'tgl_operasi' => $tgl_operasi,
			'durasi_mulai' => $durasi_awal,
			'durasi_selesai' => $durasi_selesai,
			'tindakan_operasi' => $tindakan,
			'diagnosa_pasien' => $diagnosa_operasi,
			'alat_alat' => $alat_alat_array,
			'kamar_operasi' => $kamar_operasi,
			'dokter_opr' => $dokter_opr,
			'dokter_a_opr' => $a_dokter_opr,
			'dokter_a_anestesi' => $a_dokter_ant,
			'perawat' => $perawat,
			'jam_serah_terima' => $jam_serah_terima,
			'jenis_anestesi' => $jenis_anestesi,
			'status' => 0,
			'alat_lain' => $alat_lain,
			'dokter_anestesi' => $anestesi,
			'created_at' => $created_at_formatted
		);

		$insert = $this->All->insertAll('jadwal_opr', $jadwal_opr);

		if ($insert) {
			// Get the ID of the inserted jadwal_opr
			$id_jadwal_opr = $this->db->insert_id();

			$this->db->where('nama_ruangan', $kamar_operasi);
			$id_kamar_operasi = $this->db->get('mst_ruangan_opr')->result();
			var_dump($id_kamar_operasi);

			// Create the event data
			$event = array(
				'resourceId' => $id_kamar_operasi[0]->id,
				'pasien' => $nama_pasien,
				'start' => date('Y-m-d\TH:i:s', strtotime("$tgl_operasi $durasi_awal")),
				'end' => date('Y-m-d\TH:i:s', strtotime("$tgl_operasi $durasi_selesai")),
				'created_at' => $created_at_formatted,
				'created_by' => $this->session->userdata('username'),
				'color' => 'grey',
				'id_jadwal' => $id_jadwal_opr,
				'tahapan' => 0
			);

			// Insert the event data
			$insert_event = $this->All->insertAll('events', $event);

			if ($insert_event) {
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan jadwal operasi</div>');
				redirect('admin/jadwal/data_jadwal');
			} else {
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan jadwal operasi</div>');
				redirect('admin/master/buat_jadwal_operasi');
			}
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan jadwal operasi</div>');
			redirect('admin/master/buat_jadwal_operasi');
		}
	}

	public function getCurrentEvent()
	{
		$id_jadwal = $this->input->post('id_jadwal');
	}
}
