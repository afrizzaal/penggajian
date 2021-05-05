<?php

class Profile extends CI_Controller
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
    $data['title'] = "Profile";
    $id = $this->session->userdata('id_pegawai');
    $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result();
    $this->load->view('pegawai/header', $data);
    $this->load->view('pegawai/sidebar');
    $this->load->view('pegawai/profile', $data);
    $this->load->view('pegawai/footer');
  }
}
