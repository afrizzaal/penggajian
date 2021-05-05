<?php

class Data_Jabatan extends CI_Controller
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
    $data['title'] = 'Data Jabatan';
    $data['jabatan'] = $this->Penggajian_Model->get_data('data_jabatan')->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/data_jabatan', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data()
  {
    $data['title'] = 'Tambah Data Jabatan';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/tambah_data_jabatan', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data_aksi()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->tambah_data();
    } else {
      $nama_jabatan = $this->input->post('nama_jabatan');
      $gaji_pokok   = $this->input->post('gaji_pokok');
      $transport    = $this->input->post('transport');
      $uang_makan   = $this->input->post('uang_makan');

      $data = array(
        'nama_jabatan'   => $nama_jabatan,
        'gaji_pokok'     => $gaji_pokok,
        'transport'      => $transport,
        'uang_makan'     => $uang_makan
      );
      $this->Penggajian_Model->insert_data($data, 'data_jabatan');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Jabatan berhasil ditambahkan!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('admin/data_jabatan');
    }
  }

  public function update_data($id)
  {
    $where = array('id_jabatan' => $id);
    $data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan='$id'")->result();
    $data['title'] = 'Edit Data Jabatan';
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/update_data_jabatan', $data);
    $this->load->view('templates/footer');
  }

  public function update_data_aksi()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
    } else {
      $id           = $this->input->post('id_jabatan');
      $nama_jabatan = $this->input->post('nama_jabatan');
      $gaji_pokok   = $this->input->post('gaji_pokok');
      $transport    = $this->input->post('transport');
      $uang_makan   = $this->input->post('uang_makan');

      $data = array(
        'nama_jabatan'   => $nama_jabatan,
        'gaji_pokok'     => $gaji_pokok,
        'transport'      => $transport,
        'uang_makan'     => $uang_makan
      );

      $where = array(
        'id_jabatan' => $id
      );
      $this->Penggajian_Model->update_data($data, 'data_jabatan', $where);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Data Jabatan berhasil diedit!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('admin/data_jabatan');
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');
    $this->form_validation->set_rules('gaji_pokok', 'Gaji Pokok', 'required');
    $this->form_validation->set_rules('transport', 'Tunjangan Transport', 'required');
    $this->form_validation->set_rules('uang_makan', 'Uang Makan', 'required');
    $this->form_validation->set_message('required', '%s wajib diisi.');
  }

  public function delete_data($id)
  {
    $where = array('id_jabatan' => $id);
    $this->Penggajian_Model->delete_data('data_jabatan', $where);
    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    Data Jabatan berhasil dihapus!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>');
    redirect('admin/data_jabatan');
  }
}
