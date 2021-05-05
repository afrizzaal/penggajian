<?php

class Data_Gaji extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('hak_akses') != '2') {
      $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Anda belum login!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>');
      redirect('welcome');
    }
  }

  public function index()
  {
    $data['title'] = "Data Gaji";
    $nik = $this->session->userdata('nik');
    $data['potongan'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();
    $data['gaji'] = $this->db->query("SELECT data_pegawai.nama_pegawai, data_pegawai.nik, data_jabatan.gaji_pokok, data_jabatan.transport, data_jabatan.uang_makan, data_absensi.alpha, data_absensi.bulan, data_absensi.id_kehadiran FROM data_pegawai INNER JOIN data_absensi ON data_absensi.nik=data_pegawai.nik INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan WHERE data_absensi.nik='$nik' ORDER BY data_absensi.bulan DESC")->result();
    $this->load->view('pegawai/header', $data);
    $this->load->view('pegawai/sidebar');
    $this->load->view('pegawai/data_gaji', $data);
    $this->load->view('pegawai/footer');
  }

  public function cetak_slip($id)
  {
    $data['title'] = "Cetak Slip Gaji";
    $data['potongan'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();

    $data['print_slip'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.transport, data_jabatan.uang_makan, data_absensi.alpha, data_absensi.bulan
    FROM data_pegawai
    INNER JOIN data_absensi ON data_absensi.nik=data_pegawai.nik
    INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
    WHERE data_absensi.id_kehadiran='$id'")->result();
    $this->load->view('pegawai/header', $data);
    $this->load->view('pegawai/cetak_slipg', $data);
  }
}
