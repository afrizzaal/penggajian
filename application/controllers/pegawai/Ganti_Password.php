<?php

class Ganti_Password extends CI_Controller
{
  public function index()
  {
    $data['title'] = 'Ganti Password';
    $this->load->view('pegawai/header', $data);
    $this->load->view('pegawai/sidebar');
    $this->load->view('pegawai/ganti_password', $data);
    $this->load->view('pegawai/footer');
  }

  public function ganti_password_aksi()
  {
    $pass_baru  = $this->input->post('pass_baru');
    $ulangi_pass  = $this->input->post('ulangi_pass');

    $this->form_validation->set_rules('pass_baru', 'Password Baru', 'required|matches[ulangi_pass]');
    $this->form_validation->set_rules('ulangi_pass', 'Ulangi Password', 'required');
    $this->form_validation->set_message('required', '%s wajib diisi.');

    if ($this->form_validation->run() != false) {
      $data = array('password' => md5($pass_baru));
      $id = array('id_pegawai' => $this->session->userdata('id_pegawai'));
      $this->Penggajian_Model->update_data('data_pegawai', $data, $id);
      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
      Password berhasil diganti!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>');
      redirect('welcome');
    } else {
      $data['title'] = 'Ganti Password';
      $this->load->view('pegawai/header', $data);
      $this->load->view('pegawai/sidebar');
      $this->load->view('pegawai/ganti_password', $data);
      $this->load->view('pegawai/footer');
    }
  }
}
