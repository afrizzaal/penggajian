<?php

class Data_Pegawai extends CI_Controller
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
    $data['title'] = 'Data Pegawai';
    $data['pegawai'] = $this->Penggajian_Model->get_data('data_pegawai')->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/data_pegawai', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data()
  {
    $data['title'] = "Tambah Data Pegawai";
    $data['jabatan'] = $this->Penggajian_Model->get_data('data_jabatan')->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/tambah_data_pegawai', $data);
    $this->load->view('templates/footer');
  }

  public function tambah_data_aksi()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->tambah_data();
    } else {
      $nik           = $this->input->post('nik');
      $nama_pegawai  = $this->input->post('nama_pegawai');
      $jenis_kelamin = $this->input->post('jenis_kelamin');
      $tanggal_masuk = $this->input->post('tanggal_masuk');
      $jabatan       = $this->input->post('jabatan');
      $status        = $this->input->post('status');
      $hak_akses     = $this->input->post('hak_akses');
      $username      = $this->input->post('username');
      $password      = md5($this->input->post('password'));
      $photo         = $_FILES['photo']['name'];
      if ($photo = '') {
      } else {
        $config['upload_path'] = './assets/photo';
        $config['allowed_types'] = 'jpg|jpeg|png|tiff';
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('photo')) {
          echo "Photo gagal diupload!";
        } else {
          $photo = $this->upload->data('file_name');
        }
      }

      $data = array(
        'nik' => $nik,
        'nama_pegawai'  => $nama_pegawai,
        'jenis_kelamin' => $jenis_kelamin,
        'jabatan'       => $jabatan,
        'tanggal_masuk' => $tanggal_masuk,
        'status'        => $status,
        'hak_akses'     => $hak_akses,
        'username'      => $username,
        'password'      => $password,
        'photo'         => $photo,
      );

      $this->Penggajian_Model->insert_data($data, 'data_pegawai');
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Data berhasil ditambahkan</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>');
      redirect('admin/data_pegawai');
    }
  }


  public function update_data($id)
  {
    $where = array('id_pegawai' => $id);
    $data['title'] = "Update Data Pegawai";
    $data['jabatan'] = $this->Penggajian_Model->get_data('data_jabatan')->result();
    $data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai = '$id'")->result();
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('admin/update_data_pegawai', $data);
    $this->load->view('templates/footer');
  }

  public function update_data_aksi()
  {
    // echo "disini";
    // die;
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $id = $this->input->post('id_pegawai');
      // $this->update_data($id);
    } else {
      $id            = $this->input->post('id_pegawai');
      $nik           = $this->input->post('nik');
      $nama_pegawai  = $this->input->post('nama_pegawai');
      $jenis_kelamin = $this->input->post('jenis_kelamin');
      $jabatan       = $this->input->post('jabatan');
      $tanggal_masuk = $this->input->post('tanggal_masuk');
      $status        = $this->input->post('status');
      $hak_akses     = $this->input->post('hak_akses');
      $username      = $this->input->post('username');
      $password      = md5($this->input->post('password'));
      $photo         = $_FILES['photo']['name'];
      if ($photo) {
        $config['upload_path'] = './assets/photo';
        $config['allowed_types'] = 'jpg|jpeg|png|tiff';
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('photo')) {
          $photo = $this->upload->data('file_name');
          $this->db->set('photo', $photo);
        } else {
          echo $this->upload->display_errors();
        }
      }

      $data = array(
        'nik'           => $nik,
        'nama_pegawai'  => $nama_pegawai,
        'jenis_kelamin' => $jenis_kelamin,
        'jabatan'       => $jabatan,
        'tanggal_masuk' => $tanggal_masuk,
        'status'        => $status,
        'hak_akses'     => $hak_akses,
        'username'      => $username,
        'password'      => $password,

      );

      $where = array('id_pegawai' => $id);

      $this->Penggajian_Model->update_data('data_pegawai', $data, $where);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Data berhasil diupdate.</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('admin/data_pegawai');
    }
  }

  public function delete_data($id)
  {
    $where = array('id_pegawai' => $id);
    $this->Penggajian_Model->delete_data('data_pegawai', $where);
    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      Data pegawai berhasil dihapus!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
    redirect('admin/data_pegawai');
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nik', 'NIK', 'required');
    // $this->form_validation->set_rules('nik', 'NIK', 'required|is_unique[data_pegawai.nik]');
    $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
    $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
    $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
    $this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
    $this->form_validation->set_rules('status', 'Status', 'required');
    $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
    $this->form_validation->set_message('required', '%s wajib diisi.');
    // $this->form_validation->set_message('is_unique', '{field} ini sudah ada, ganti dengan yang lain.');
  }
}
