<?php

class Potongan_Gaji extends CI_Controller
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
    $data['title'] = "Setting Potongan Gaji";
    $data['pot_gaji'] = $this->Penggajian_Model->get_data('potongan_gaji')->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/potongan_gaji', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data()
  {
    $data['title'] = "Tambah Potongan Gaji";
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/tambah_potongan_gaji', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data_aksi()
  {
    $this->_rules();
    if ($this->form_validation->run() == FALSE) {
      $this->tambah_data();
    } else {
      $potongan       = $this->input->post('potongan');
      $jml_potongan   = $this->input->post('jml_potongan');
      $data = array(
        'potongan'     => $potongan,
        'jml_potongan' => $jml_potongan
      );

      $this->Penggajian_Model->insert_data($data, 'potongan_gaji');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Data berhasil ditambahkan</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('admin/potongan_gaji');
    }
  }

  public function update_data($id)
  {
    $where = array('id' => $id);
    $data['title'] = "Update Potongan Gaji";
    $data['pot_gaji'] = $this->db->query("SELECT * FROM potongan_gaji WHERE id='$id'")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/update_potongan_gaji', $data);
    $this->load->view('templates/footer');
  }

  public function update_data_aksi()
  {
    $this->_rules();
    if ($this->form_validation->run() == FALSE) {
    } else {
      $id           = $this->input->post('id');
      $potongan     = $this->input->post('potongan');
      $jml_potongan = $this->input->post('jml_potongan');

      $data = array(
        'potongan'     => $potongan,
        'jml_potongan' => $jml_potongan
      );

      $where  = array(
        'id'  => $id
      );
      $this->Penggajian_Model->update_data('potongan_gaji', $data, $where);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Data berhasil diupdate.</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('admin/potongan_gaji');
    }
  }

  public function delete_data($id)
  {
    $where = array('id' => $id);
    $this->Penggajian_Model->delete_data('potongan_gaji', $where);
    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Data pegawai berhasil dihapus!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
    redirect('admin/potongan_gaji');
  }

  public function _rules()
  {
    $this->form_validation->set_rules('potongan', 'Jenis Potongan', 'required');
    $this->form_validation->set_rules('jml_potongan', 'Jumlah Potongan', 'required');
  }
}
