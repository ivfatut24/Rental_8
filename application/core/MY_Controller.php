<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Krasnoyarsk'); // GMT +7
		$this->load->model([
			'Model_Users'			=> 'user',
			'Model_Keranjang'		=> 'keranjang',
			'Model_Products'		=> 'product',
			'Model_KategoriProduk'	=> 'kategori_produk',
			'Model_Tujuan'			=> 'tujuan',
			'Model_Pemesanan'		=> 'pemesanan',
			'Model_Pembayaran'		=> 'pembayaran',
			'Model_Pengembalian'	=> 'pengembalian',
			'Model_Maintenance'		=> 'maintenance',
			'Model_DetailTransaksi'	=> 'detail_transaksi',
			'Model_Laporan'			=> 'laporan',
			'Model_Bank'			=> 'bank',
			'Model_Temp_customer'	=> 'temp_customer',
			'Model_KondisiBarang'	=> 'kondisi_barang',
			]);
		$this->load->library("pagination");
	}

	protected function cekHakAkses()
	{
		$user_level = $this->session->userdata('level');

		if (isset($user_level)) {
			if ($user_level == 0) {
				redirect('admin', 'refresh');
			} else if ($user_level == 1) {
				redirect('customer', 'refresh');
			} else if ($user_level == 2) {
				redirect('maintenance', 'refresh');
			}
		}
	}

	protected function cekAksesAdmin()
	{
		$user_level = $this->session->userdata('level');

		if (isset($user_level)) {
			if ($user_level != 0) {
				redirect('login', 'refresh');
			}
		} else {
			redirect('login', 'refresh');
		}
	}

	protected function cekAksesCustomer()
	{
		$user_level = $this->session->userdata('level');

		if (isset($user_level)) {
			if ($user_level != 1) {
				redirect('login', 'refresh');
			}
		} else {
			redirect('login', 'refresh');
		}
	}

	protected function cekAksesMaintenance()
	{
		$user_level = $this->session->userdata('level');

		if (isset($user_level)) {
			if ($user_level != 2) {
				redirect('login', 'refresh');
			}
		} else {
			redirect('login', 'refresh');
		}
	}

	protected function cekVerfikasi()
	{
		$verification = $this->session->userdata('is_verification');		

		if (isset($verification)) {
			if ($verification) {
				if ($this->uri->segment(1) == 'verification') return;
				redirect('verification');
			} else {
				if ($this->uri->segment(1) == 'login') return;
				redirect('login', 'refresh');
			}
		}  else {
			if ($this->uri->segment(1) == 'login' || $this->uri->segment(1) == 'register') return;
			redirect('login', 'refresh');
		}
	}

	public function destroySession()
	{
		$this->CI->session->sess_destroy();
		return true;
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */
