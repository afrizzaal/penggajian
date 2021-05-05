<?php

class Data_Gaji extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if ($this->session->userdata('hak_akses') != '1') {
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
    $data['title'] = "Data Gaji Pegawai";
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $bulantahun = $bulan . $tahun;
    } else {
      $bulan = date('m');
      $tahun = date('Y');
      $bulantahun = $bulan . $tahun;
    }
    $data['potongan'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();
    $data['gaji'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.transport, data_jabatan.uang_makan, data_absensi.alpha
    FROM data_pegawai
    INNER JOIN data_absensi ON data_absensi.nik=data_pegawai.nik
    INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
    WHERE data_absensi.bulan='$bulantahun'
    ORDER BY data_pegawai.nama_pegawai ASC")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/data_gaji', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_gaji()
  {
    $data['title'] = "Cetak Data Gaji Pegawai";
    if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
      $bulan = $_GET['bulan'];
      $tahun = $_GET['tahun'];
      $bulantahun = $bulan . $tahun;
    } else {
      $bulan = date('m');
      $tahun = date('Y');
      $bulantahun = $bulan . $tahun;
    }
    $data['potongan'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();
    $data['cetak_gaji'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_pegawai.jenis_kelamin, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.transport, data_jabatan.uang_makan, data_absensi.alpha
    FROM data_pegawai
    INNER JOIN data_absensi ON data_absensi.nik=data_pegawai.nik
    INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
    WHERE data_absensi.bulan='$bulantahun'
    ORDER BY data_pegawai.nama_pegawai ASC")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('admin/cetak_gaji', $data);
  }
}
