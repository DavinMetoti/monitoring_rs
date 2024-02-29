<?php
defined('BASEPATH') or exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Master extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != 'login') {
            redirect(base_url());
        }
        $this->load->model('All');
    }

    public function index()
    {
        redirect('admin/master/data_dokter');
    }

    public function data_dokter()
    {
        $data['mst_jadwal_dokter'] = $this->All->selectAllJoinSpesialis();

        $data['title'] = 'Data Dokter';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/dokter-operasi');
        $this->load->view('template/footer');
    }

    public function tambah_admin()
    {
        $data['title'] = 'Tambah User';
        $data['url'] = 'admin/master/insert_user';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-user');
        $this->load->view('template/footer');
    }

    public function edit_admin($id)
    {

        $this->db->where('id_account', $id);
        $data["account"] = $this->db->get('account')->row();
        $data['url'] = 'admin/master/update_user/' . $id;
        $data['title'] = 'Edit User';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-user', $data);
        $this->load->view('template/footer');
    }

    public function daftar_admin()
    {
        $this->db->order_by('status', 'DESC');
        $data["admin_data"] = $this->db->get('account')->result();

        $data['title'] = 'Daftar User';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/daftar-user', $data);
        $this->load->view('template/footer');
    }

    public function insert_user()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role_access = $this->input->post('role_access');
        $created_at = date('Y-m-d H:i:s');
        $created_by = $this->session->userdata('username');
        $account = array(
            'username' => htmlspecialchars($username),
            'password' => $password,
            'role_access' => htmlspecialchars($role_access),
            'created_at' => $created_at,
            'created_by' => $created_by,
        );

        if ($username == "" && $password == "" || $role_access == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak lengkap</div>');
            redirect('admin/master/tambah_admin');
        } else {
            $this->db->insert('account', $account);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Admin berhasil ditambahkan</div>');
            redirect('admin/master/daftar_admin');
        }
    }

    public function update_user($id)
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role_access = $this->input->post('role_access');
        $created_at = date('Y-m-d H:i:s');
        $created_by = $this->session->userdata('username');
        $account = array(
            'username' => htmlspecialchars($username),
            'password' => $password,
            'role_access' => htmlspecialchars($role_access),
            'created_at' => $created_at,
            'created_by' => $created_by,
        );

        if ($username == "" && $password == "" || $role_access == "") {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data tidak lengkap</div>');
            redirect('admin/master/tambah_admin');
        } else {
            $this->db->where('id_account', $id);
            $this->db->update('account', $account);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Admin berhasil ditambahkan</div>');
            redirect('admin/master/daftar_admin');
        }
    }

    public function delete_user($id, $key)
    {
        $this->db->where('id_account', $id);
        $insert = $this->db->update('account', array('status' => $key));

        if ($insert) {
            if ($key == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menonaktifkan user</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengaktifkan user</div>');
            }
            redirect('admin/master/daftar_admin');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menonaktifkan tindakan</div>');
            redirect('admin/master/daftar_admin');
        }
    }



    public function data_dokter_anestesi()
    {

        $data['mst_jadwal_dokter'] = $this->All->selectAll('mst_jadwal_dokter_ant');
        $data['title'] = 'Data Dokter';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/dokter-anestesi');
        $this->load->view('template/footer');
    }

    public function getSpesialis()
    {
        $id = $this->input->post('id_spesialis');
        $spesialis = $this->db->get_where('spesialis', array('id' => $id))->row();

        if ($spesialis) {
            $response['success'] = true;
            $response['message'] = 'Data berhasil ditemukan.';
            $response['spesialis'] = $spesialis;
        } else {
            $response['success'] = false;
            $response['message'] = 'Data tidak ditemukan atau proses gagal.';
        }

        // Mengembalikan respons dalam format JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }



    public function tambah_dokter_operasi()
    {
        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Tambah Dokter Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-dokter-operasi');
        $this->load->view('template/footer');
    }

    public function delete_dokter_opr($id)
    {
        $this->db->where('id_dokter_opr', $id);
        $this->db->delete('mst_jadwal_dokter_opr');
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus jadwal dokter</div>');
            redirect('admin/master/data_dokter');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">gagal menghapus jadwal dokter</div>');
            redirect('admin/master/data_dokter');
        }
    }

    public function delete_dokter_ant($id)
    {
        $this->db->where('id_jadwal_dokter_ant', $id);
        $this->db->delete('mst_jadwal_dokter_ant');
        $affected_rows = $this->db->affected_rows();
        if ($affected_rows > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus jadwal dokter anestesi</div>');
            redirect('admin/master/data_dokter_anestesi');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">gagal menghapus jadwal dokter anestesi</div>');
            redirect('admin/master/data_dokter_anestesi');
        }
    }

    public function tambah_dokter_anestesi()
    {
        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Tambah Dokter Anestesi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-dokter-anestesi');
        $this->load->view('template/footer');
    }

    public function insert_jadwal_dokter_operasi()
    {
        $request_body = file_get_contents('php://input');
        $dataSementara = json_decode($request_body, true);

        if ($dataSementara) {
            $inserted = $this->insertDataSementara($dataSementara);

            if ($inserted) {
                http_response_code(200);
            } else {
                http_response_code(500);
            }
        } else {
            http_response_code(400);
        }
    }

    private function insertDataSementara($dataSementara)
    {
        if ($this->db->insert_batch('mst_jadwal_dokter_opr', $dataSementara)) {
            return true;
        } else {
            return false;
        }
    }

    public function insert_jadwal_dokter_anestesi()
    {
        $data = array(
            'inisial' => $this->input->post('inisial_dokter_operasi'),
            'nama_dokter' => $this->input->post('nama_dokter_operasi'),
            'hari_praktek' => $this->input->post('hari_praktek'),
            'jam_praktek_mulai' => $this->input->post('jam_mulai_praktek'),
            'jam_praktek_selesai' => $this->input->post('jam_selesai_praktek'),
        );

        $insert = $this->All->insertAll('mst_jadwal_dokter_ant', $data);

        if (isset($insert)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan jadwal dokter</div>');
            redirect('admin/master/data_dokter_anestesi');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan jadwal dokter</div>');
            redirect('admin/master/tambah_dokter_operasi');
        }
    }

    public function data_perlengkapan()
    {
        $now = date('H:i');

        $this->db->where('status', 1);
        $data['mst_data_perlengkapan'] = $this->db->get('perlengkapan')->result();

        foreach ($data['mst_data_perlengkapan'] as $key => $item) {
            $this->db->select('*');
            $this->db->from('jadwal_opr');
            $this->db->where('durasi_mulai <=', $now);
            $this->db->where('durasi_selesai >=', $now);
            $this->db->where('tgl_operasi', date('Y-m-d'));
            $this->db->like('alat_alat', $item->perlengkapan);
            $query = $this->db->get();

            // Simpan jumlah penggunaan dalam objek perlengkapan saat ini
            $data['mst_data_perlengkapan'][$key]->qty = $data['mst_data_perlengkapan'][$key]->qty - $query->num_rows();
            if ($data['mst_data_perlengkapan'][$key]->qty < 0) {
                $data['mst_data_perlengkapan'][$key]->qty = 0;
            }
        }

        $data['title'] = 'Daftar Perlengkapan';

        // Tampilkan view dengan data yang telah dimodifikasi
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/daftar-perlengkapan', $data);
        $this->load->view('template/footer');
    }


    public function get_history_alat()
    {
        $now = date('H:i');
        $nama_alat = $this->input->post('nama_alat');

        $this->db->select('jadwal_opr.*, mst_tindakan_opr.tindakan AS nama_tindakan_operasi');
        $this->db->from('jadwal_opr');
        $this->db->join('mst_tindakan_opr', 'jadwal_opr.tindakan_operasi = mst_tindakan_opr.id_tindakan', 'left');
        $this->db->where('durasi_mulai <=', $now);
        $this->db->where('durasi_selesai >=', $now);
        $this->db->where('tgl_operasi', date('Y-m-d'));
        $this->db->like('alat_alat', $nama_alat);
        $query = $this->db->get();

        $result = $query->result_array();

        // Mengembalikan hasil dalam bentuk JSON
        echo json_encode($result);
    }


    public function sampah_perlengkapan()
    {
        $this->db->where('status', 0);
        $data['mst_data_perlengkapan'] = $this->db->get('perlengkapan')->result();
        $data['title'] = 'Daftar Perlengkapan';

        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/sampah-perlengkapan', $data);
        $this->load->view('template/footer');
    }


    public function tambah_perlengkapan()
    {
        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Tambah Alat Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-perlengkapan');
        $this->load->view('template/footer');
    }

    public function edit_perlengkapan($id)
    {
        $this->db->where('id_perlengkapan', $id);
        $data['mst_data_perlengkapan'] = $this->db->get('perlengkapan')->row();
        $data['title'] = 'Tambah Alat Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/edit-perlengkapan');
        $this->load->view('template/footer');
    }

    public function insert_peralatan_operasi()
    {
        $data = array(
            'perlengkapan' => $this->input->post('nama_alat'),
            'qty' => $this->input->post('qty'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => 1,
        );

        $insert = $this->All->insertAll('perlengkapan', $data);

        if (isset($insert)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan alat</div>');
            redirect('admin/master/data_perlengkapan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan alat</div>');
            redirect('admin/master/tambah_perlengkapan');
        }
    }

    public function delete_peralatan_operasi($id)
    {

        $this->db->where('id_perlengkapan', $id);
        $this->db->update('perlengkapan', array('status' => 0));

        // Periksa apakah ada baris yang dipengaruhi
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menghapus alat</div>');

            redirect('admin/master/data_perlengkapan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menghapus alat</div>');
            redirect('admin/master/data_perlengkapan');
        }
    }

    public function restore_peralatan_operasi($id)
    {

        $this->db->where('id_perlengkapan', $id);
        $this->db->update('perlengkapan', array('status' => 1));

        // Periksa apakah ada baris yang dipengaruhi
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil merestore alat</div>');

            redirect('admin/master/data_perlengkapan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal merestore alat</div>');
            redirect('admin/master/data_perlengkapan');
        }
    }

    public function edit_peralatan_operasi($id)
    {
        $data = array(
            'perlengkapan' => $this->input->post('nama_alat'),
            'qty' => $this->input->post('qty'),
            'keterangan' => $this->input->post('keterangan'),
        );

        // Periksa apakah data yang akan diupdate sudah lengkap
        if (!empty($data['perlengkapan']) && !empty($data['qty']) && !empty($data['keterangan'])) {
            $this->db->where('id_perlengkapan', $id);
            $this->db->update('perlengkapan', $data);

            // Periksa apakah ada baris yang dipengaruhi
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah alat</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada perubahan dilakukan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mohon lengkapi semua data</div>');
        }

        redirect('admin/master/data_perlengkapan');
    }




    public function data_ruangan()
    {
        $now = date('H:i');
        $ruangan = $this->db->get('mst_ruangan_opr')->result();
        foreach ($ruangan as $key => $item) {

            $this->db->select('*');
            $this->db->from('jadwal_opr');
            $this->db->where('durasi_mulai <=', $now);
            $this->db->where('durasi_selesai >=', $now);
            $this->db->where('tgl_operasi', date('Y-m-d'));
            $this->db->where('kamar_operasi', $item->nama_ruangan);
            $query = $this->db->get();


            if ($query->num_rows() > 0) {
                $ruangan[$key]->digunakan = 1;
            } else {
                $ruangan[$key]->digunakan = 0;
            }
        }

        $data['mst_data_ruangan'] = $ruangan;
        $data['title'] = 'Daftar Ruangan Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/ruangan');
        $this->load->view('template/footer');
    }

    public function edit_ruangan($id)
    {
        $this->db->where('id', $id);
        $data['ruangan'] = $this->db->get('mst_ruangan_opr')->row();
        $data['title'] = 'Tambah Alat Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/edit-ruangan');
        $this->load->view('template/footer');
    }



    public function tambah_ruangan()
    {
        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Tambah Ruangan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-ruangan');
        $this->load->view('template/footer');
    }

    public function insert_ruangan()
    {
        $data = array(
            'nama_ruangan' => $this->input->post('nama_alat'),
            'keterangan' => $this->input->post('keterangan'),
            'status' => 1,
        );

        $insert = $this->All->insertAll('mst_ruangan_opr', $data);

        if (isset($insert)) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan ruangan</div>');
            redirect('admin/master/data_ruangan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan ruangan</div>');
            redirect('admin/master/tambah_ruangan');
        }
    }

    public function delete_ruangan_operasi($id, $key)
    {

        $this->db->where('id', $id);
        $this->db->update('mst_ruangan_opr', array('status' => $key));

        // Periksa apakah ada baris yang dipengaruhi
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menonaktifkan ruangan alat</div>');

            redirect('admin/master/data_ruangan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menonaktifkan ruangan alat</div>');
            redirect('admin/master/data_ruangan');
        }
    }

    public function edit_ruangan_operasi($id)
    {
        $data = array(
            'nama_ruangan' => $this->input->post('nama_ruangan'),
            'keterangan' => $this->input->post('keterangan'),
        );


        // Periksa apakah data yang akan diupdate sudah lengkap
        if (!empty($data['nama_ruangan'])  && !empty($data['keterangan'])) {
            $this->db->where('id', $id);
            $this->db->update('mst_ruangan_opr', $data);

            // Periksa apakah ada baris yang dipengaruhi
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengubah ruangan operasi</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Tidak ada perubahan dilakukan</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Mohon lengkapi semua data</div>');
        }

        redirect('admin/master/data_ruangan');
    }

    public function data_tindakan()
    {
        $data['mst_tindakan_opr'] = $this->All->selectAll('mst_tindakan_opr');
        $data['title'] = 'Daftar Tindakan Operasi';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/daftar-tindakan');
        $this->load->view('template/footer');
    }

    public function tambah_tindakan()
    {
        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Tambah Tindakan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/tambah-tindakan');
        $this->load->view('template/footer');
    }

    public function edit_tindakan($id)
    {
        $this->db->where('id_tindakan', $id);
        $data['tindakan'] = $this->db->get('mst_tindakan_opr')->row();

        // Atur nilai awal untuk properti durasi
        // Konversi waktu dari format "jam:menit:detik" menjadi menit
        $waktu = $data['tindakan']->durasi;
        list($jam, $menit, $detik) = explode(':', $waktu);
        $durasi_menit = ($jam * 60) + $menit;

        $data['tindakan']->durasi = $durasi_menit;

        $data['spesialis'] = $this->All->selectAll('spesialis');
        $data['title'] = 'Edit Tindakan';
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        $this->load->view('template/topbar');
        $this->load->view('admin-jadwal/master/edit-tindakan');
        $this->load->view('template/footer');
    }



    public function insert_tindakan()
    {
        // Mendapatkan nilai input dari form
        $nama_tindakan = $this->input->post('nama_tindakan');
        $durasi = $this->input->post('durasi');
        $alat_khusus = $this->input->post('alat_khusus');
        $keterangan = $this->input->post('keterangan');

        // Mengonversi durasi dari menit ke format jam:menit:detik
        $formatDurasi = gmdate('H:i:s', $durasi * 60);

        $data = array(
            'tindakan' => $nama_tindakan,
            'durasi' => $formatDurasi,
            'alat_khusus' => $alat_khusus,
            'keterangan' => $keterangan,
            'status' => 1,
        );

        // Memasukkan data ke dalam database
        $insert = $this->All->insertAll('mst_tindakan_opr', $data);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan tindakan</div>');
            redirect('admin/master/data_tindakan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan tindakan</div>');
            redirect('admin/master/tambah_tindakan');
        }
    }

    public function update_tindakan($id)
    {
        // Mendapatkan nilai input dari form
        $nama_tindakan = $this->input->post('nama_tindakan');
        $durasi = $this->input->post('durasi');
        $alat_khusus = $this->input->post('alat_khusus');
        $keterangan = $this->input->post('keterangan');
        $formatDurasi = gmdate('H:i:s', $durasi * 60);

        $data = array(
            'tindakan' => $nama_tindakan,
            'durasi' => $formatDurasi,
            'alat_khusus' => $alat_khusus,
            'keterangan' => $keterangan,
        );

        $this->db->where('id_tindakan', $id);
        $insert = $this->db->update('mst_tindakan_opr', $data);

        if ($insert) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil memperbarui tindakan</div>');
            redirect('admin/master/data_tindakan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal memperbarui tindakan</div>');
            redirect('admin/master/data_tindakan');
        }
    }

    public function delete_tindakan($id, $key)
    {
        $this->db->where('id_tindakan', $id);
        $insert = $this->db->update('mst_tindakan_opr', array('status' => $key));

        if ($insert) {
            if ($key == 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menonaktifkan tindakan</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengaktifkan tindakan</div>');
            }
            redirect('admin/master/data_tindakan');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menonaktifkan tindakan</div>');
            redirect('admin/master/data_tindakan');
        }
    }
}
