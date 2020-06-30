<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekVerfikasi();
	}

	public function index()
	{
		// $this->session->sess_expiration = 10;
		// dd($_SESSION);
		// var_dump(empty($this->session->userdata('is_verification')));die;
		
		$data = [];
		if (isPost()) {
			$data = array(
				'nama' => $this->input->post('nama'),
				'alamat' => $this->input->post('alamat'),
				'email' => $this->input->post('email'),
				'no_telp' => $this->input->post('no_telp'),
				'username' => $this->input->post('username'),
			);

			$password				= md5($this->input->post('password'));
			$password_konfirmasi	= md5($this->input->post('password_konfirmasi'));

			if ($password === $password_konfirmasi) {
				$register = $this->temp_customer->registerCustomer();
				$data = $register['data'];
				if ($register['status']) {
					$basic  = new \Nexmo\Client\Credentials\Basic('a33c71f0', 'Z03TlKbDvAhosAr9');
					$client = new \Nexmo\Client($basic);

					$message = $client->message()->send([
						'to'	=> '62'.$data['no_telp'],
						'from'	=> 'Ciliwung Camp [Test]',
						'text'	=> 'Kode keamanan Registrasi Ciliwung Camp, jangan berikan kepada siapapun. Silahkan masukkan kode berikut '.$data['security_code'].' . Terima Kasih',
					]);
					
					$array = array(
						'id_user' => $data['id_user'],
						'is_verification' => true,
					);					
					$this->session->set_userdata( $array );					

					redirect(base_url('verification'));
				} else {
					$this->session->set_flashdata('msg', '<h4 class="btn btn-danger text-center">Registrasi Gagal</h4>');
				}				
			} else {
				$this->session->set_flashdata('msg', '<h4 class="btn btn-warning text-center">Konfirmasi Password Salah</h4>');
			}			
		}
		$this->load->view('guest/register', $data);
	}

	public function verification()
	{
		$data = $this->temp_customer->getById($this->session->userdata('id_user'));

		if (isPost()) {
			if ($this->input->post('security_code') == $data['security_code']) {
				$this->user->insertCustomer([
					'nama'		=> $data['nama'],
					'alamat'	=> $data['alamat'],
					'email'		=> $data['email'],
					'no_telp'	=> $data['no_telp'],
					'username'	=> $data['username'],
					'password'	=> $data['password'],
					'level'		=> 1,
					'is_active'	=> 1,
				]);
				$this->temp_customer->delete($data['id_user']);
				
				$this->session->sess_destroy();				

				$this->session->set_flashdata('success', '<h4 class="btn btn-success text-center">Registrasi Berhasil<br>Silahkan login...</h4>');
				echo "<script type='text/JavaScript'>setTimeout(function () {
					window.location.href = '".base_url('login')."';
				}, 2000);</script>"; // 2 detik
				$data = [];
			} else {
				$this->session->set_flashdata('msg', '<h4 class="btn btn-danger text-center">Kode Salah</h4>');
			}
		}

		$this->load->view('guest/verification', $data);		
	}

}

/* End of file Register.php */
/* Location: ./application/controllers/Register.php */
