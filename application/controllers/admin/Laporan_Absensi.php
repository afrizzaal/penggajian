<?php

class Laporan_Absensi extends CI_Controller
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
    $data['title'] = "Laporan Absensi Pegawai";
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/filterl_absensi');
    $this->load->view('templates/footer');
  }

  public function cetak_absensi()
  {
    $data['title'] = "Cetak Laporan Absensi";

    // if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
    //   $bulan = $_GET['bulan'];
    //   $tahun = $_GET['tahun'];
    //   $bulantahun = $bulan . $tahun;
    // } else {
    //   $bulan = date('m');
    //   $tahun = date('Y');
    //   $bulantahun = $bulan . $tahun;
    // }
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $bulantahun = $bulan . $tahun;
    $data['lap_absensi'] = $this->db->query("SELECT * FROM data_absensi
    WHERE bulan='$bulantahun'
    ORDER BY nama_pegawai ASC")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('admin/cetak_absensi');
  }
}
