<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends CI_Controller
{
    // fungsi selalu dijalankan.
    public function __construct()
    {
        parent::__construct();
        // load models.
        $this->load->model('Mahasiswa_model');
    }

    // fungsi pertama dijalankan.
    public function index()
    {
        // $array data mulai.
        $data = [
            // judul tab.
            "judul" => "Data Mahasiswa",
            // load fungsi dari model.
            "mahasiswa" => $this->Mahasiswa_model->getAllMahasiswa()
        ];
        // array data selesai.
        // load view mulai
        // mengandung array $data
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        // mengandung array $data
        $this->load->view('mahasiswa/v_mahasiswa', $data);
        $this->load->view('template/footer');
        // load view selesai.
    }

    // fungsi tambah
    public function add()
    {
        // data array mulai.
        $data = [
            // judul tab.
            "judul" => "Tambah Data Mahasiswa"
        ];
        // data array selesai.
        // mengeatur validasi dari inputan "name" mulai.
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[32]');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|numeric|max_length[13]');
        // mengatur validasi dari inputan "name" selesai.
        // pengkondisian jika validasi berjalan mulai.
        // jika validasi salah maka.
        if ($this->form_validation->run() == FALSE) {
            // load view mulai.
            // mengandung array $data
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            // mengandung array $data
            $this->load->view('mahasiswa/v_tambah', $data);
            $this->load->view('template/footer');
            // load view selesai.
        }
        // jika benar maka.
        else {
            // load fungsi dari model.
            $this->Mahasiswa_model->tambahDataMahasiswa();
            // membuat session flash.
            $this->session->set_flashdata('flash', 'Data berhasil ditambahkan!');
            // kembali ke controller mahasiswa.
            redirect('mahasiswa'); // kembali ke controller mahasiswa.
        }
        // pengkodisian jika validasi berjalan selesai.
    }

    // fungsi ubah berdasarkan paramater $id.
    public function update($id)
    {
        // data array mulai.
        $data = [
            // judul tab.
            'judul' => 'Ubah Data Mahasiswa',
            // load fungsi model dengan mengirimkan $id.
            'mahasiswa' => $this->Mahasiswa_model->getMahasiswaById($id)
        ];
        // data array selesai.
        // mengatur validasi dari inputan "name" mulai.
        $this->form_validation->set_rules('nim', 'NIM', 'required|numeric|max_length[12]');
        $this->form_validation->set_rules('nama', 'Nama', 'required|max_length[32]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[32]');
        $this->form_validation->set_rules('telp', 'Telepon', 'required|numeric|max_length[13]');
        // mengatur validasi dari inputan "name" selesai.
        // pengkodisian jika validasi berjalan mulai.
        // jika validasi salah maka.
        if ($this->form_validation->run() == FALSE) {
            // jika validasi salah maka.
            // load view.
            // mengandung array $data.
            $this->load->view('template/header', $data);
            $this->load->view('template/sidebar');
            // mengandung array $data
            $this->load->view('mahasiswa/v_ubah', $data);
            $this->load->view('template/footer');
        }
        // jika benar maka.
        else {
            // load fungsi model.
            $this->Mahasiswa_model->ubahDataMahasiswa($id);
            // membuat session flash.
            $this->session->set_flashdata('flash', 'Data berhasil diubah!');
            // kembali ke controller mahasiswa.
            redirect('mahasiswa');
        }
        // pengkodisian jika validasi berjalan selesai.
    }

    // fungsi hapus berdasarkan paramater $id.
    public function delete($id)
    {
        // load fungsi model dengan mengirimkan $id.
        $this->Mahasiswa_model->hapusDataMahasiswa($id);
        // membuat session flash.
        $this->session->set_flashdata('flash', 'Data berhasil dihapus!');
        // kembali ke controller mahasiswa.
        redirect('mahasiswa');
    }

    // fungsi riwayat.
    public function log()
    {
        // data array mulai.
        $data = [
            // judul tab.
            'judul' => "Riwayat No. HP Mahasiswa",
            // load fungsi model.
            'mahasiswa' => $this->Mahasiswa_model->getLog()
        ];
        // data array selesai.
        // load view mulai.
        // mengandung data array.
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar');
        // mengandung data array.
        $this->load->view('mahasiswa/v_log', $data);
        $this->load->view('template/footer');
        // load view selesai.
    }
}

/* End of file Mahasiswa.php */
