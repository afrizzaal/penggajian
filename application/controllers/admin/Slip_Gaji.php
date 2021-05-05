<?php

class Slip_Gaji extends CI_Controller
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
    $data['title'] = "Filter Slip Gaji Pegawai";
    $data['pegawai'] = $this->Penggajian_Model->get_data('data_pegawai')->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/filterSlipGaji', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_slip_gaji()
  {
    $data['title'] = "Cetak Slip Gaji Pegawai";
    $data['potongan'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();
    $nama = $this->input->post('nama_pegawai');
    $bulan = $this->input->post('bulan');
    $tahun = $this->input->post('tahun');
    $bulantahun = $bulan . $tahun;
    $data['print_slip'] = $this->db->query("SELECT data_pegawai.nik, data_pegawai.nama_pegawai, data_jabatan.nama_jabatan, data_jabatan.gaji_pokok, data_jabatan.transport, data_jabatan.uang_makan, data_absensi.alpha, data_absensi.bulan
    FROM data_pegawai
    INNER JOIN data_absensi ON data_absensi.nik=data_pegawai.nik
    INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
    WHERE data_absensi.bulan='$bulantahun' AND data_absensi.nama_pegawai='$nama'")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('admin/cetakSlipGaji', $data);
  }
}
