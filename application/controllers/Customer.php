<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{
	private $kendaraan = [
		1 => ['Motor', 4000],
		2 => ['Mobil', 8000]
	];

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesCustomer();
	}

	public function index()
	{
		$data['list_barang'] = $this->product->getAllBarang();
		$this->load->view("customer/dashboard", $data);
	}

	public function produk($id = '')
	{
		if (isPost() && $id != '') {
			$in_keranjang = $this->keranjang->insert();
			if($in_keranjang['status']){
				echo '
					<link rel="stylesheet" href="'.base_url('assets/cardoor/css/jquery-confirm.min.css').'">
					<script src="'.base_url('assets/cardoor/js/jquery-3.2.1.min.js').'"></script>
					<script src="'.base_url('assets/cardoor/js/jquery-confirm.min.js').'"></script>
					<script type="text/javascript">
						$(function() { 
							$.confirm({
								title: "Keranjang",
								content: "'.$in_keranjang['msg'].'",
								buttons: {
									cancel: {
										text:"Kembali",
										btnClass: "btn-brand",
										action: function () {}
									},
									confirm: {
										text:"Lihat Keranjang",
										btnClass: "btn-dark",
										action: function () {
											window.location.replace("'.base_url('customer/keranjang').'");
										}
									}
								}
							});
						});
					</script>';
			} else {
				echo '<script type="text/javascript">alert("'.$in_keranjang['msg'].'");</script>';
			}
		}

		if ($id == '') {
			if (isPost()) {
				$data['list_barang'] = $this->product->getSearchBarang($this->input->post('search'));
				$data['search'] = $this->input->post('search');
			} else {
				$data['list_barang'] = $this->product->getAllBarang();
				$data['search'] = "";
			}
			
			$data['list_kategori'] = $this->kategori_produk->getAll();		
			$this->load->view("customer/produk", $data);
		} else {
			$data['barang'] = $this->product->getProductById($id);
			$this->load->view("customer/detailproduk", $data);
		}
	}


	public function keranjang($action = '')
	{
		if (isPost()) {
			if ($action === 'delete') {
				if ($this->keranjang->delete()) {
					echo '<script type="text/javascript">alert(\'delete success\');</script>';
				} else {
					echo '<script type="text/javascript">alert(\'delete failed\');</script>';
				}
			}
			if ($action === 'checkout_1') {
				$data['kode_kendaraan']	= $this->input->post('kode_kendaraan');
				$data['kendaraan']		= $this->kendaraan[$this->input->post('kode_kendaraan')];
				$data['subtotal']		= $this->input->post('subtotal');
				$data['prev_subtotal']	= $data['subtotal'];
				$data['total_sewa']		= $data['subtotal'];
				$data['transaksi']		= $this->keranjang->getTransaksi();
				$data['list_tujuan']	= $this->keranjang->getTujuan();

				$this->load->view("customer/checkout", $data);
				return;
			}
			if ($action === 'checkout_2') {
				$config['upload_path']		= './assets/uploads/jaminan/';
				$config['allowed_types']	= 'gif|jpg|png';
				$config['remove_spaces']	= TRUE;
				$config['encrypt_name']		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('foto_jaminan')){
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center text-white" role="alert"><h4>'.$this->upload->display_errors().'</h4></div>');

					$data['kode_kendaraan']	= $this->input->post('kode_kendaraan');
					$data['kendaraan']		= @$this->kendaraan[$this->input->post('kode_kendaraan')];
					$data['subtotal']		= $this->input->post('prev_subtotal');
					$data['prev_subtotal']	= $data['subtotal'];
					$data['total_sewa']		= $data['subtotal'];
					$data['transaksi']		= $this->keranjang->getTransaksi();
					$data['list_tujuan']	= $this->keranjang->getTujuan();
					$data['transaksi'] = [
						'id_transaksi'		=> $this->input->post('id_transaksi'),
						'tgl_sewa'			=> $this->input->post('tgl_sewa'),
						'tgl_pengembalian'	=> $this->input->post('tgl_pengembalian'),
						'id_tujuan'			=> $this->input->post('id_tujuan'),
						'metode_pengambilan'=> $this->input->post('metode_pengambilan'),
						'kode_kendaraan'	=> $this->input->post('kode_kendaraan'),
						'alamat_pengiriman'	=> $this->input->post('alamat_pengiriman'),
						// 'jarak'				=> $this->input->post('jarak'),
						// 'biaya_pengiriman'	=> $this->input->post('biaya_pengiriman'),
						'jaminan'			=> $this->input->post('jaminan'),
						'no_identitas'		=> $this->input->post('no_identitas'),
						'no_telp'			=> $this->input->post('no_telp'),
						'total_harga'		=> $this->input->post('total_harga'),
					];

					$this->load->view("customer/checkout", $data);
					return;
				}
				if ($this->keranjang->checkout()) {
					$data['transaksi'] = $this->keranjang->getTransaksi();
					$data['transaksi']['kendaraan'] = $this->kendaraan[$data['transaksi']['kode_kendaraan']];
					$data['detail_transaksi'] = $this->keranjang->getKeranjang();
					$this->load->view("customer/checkout_detail_pemesanan", $data);
					return;
				}
			}
			if ($action === 'bayar') {
				if ($this->keranjang->bayar()) {
					echo '<form id="form-bayar" action="' . base_url('customer/pembayaran') . '" method="post">
						<input type="hidden" name="id_transaksi" value="' . $this->input->post('id_transaksi') . '">
						<button type="submit">Bayar</button>
						</form>
						<script>document.getElementById("form-bayar").submit();</script>';
				} else {
					echo '<script type="text/javascript">alert(\'Checkout failed\');</script>';
				}
			}
		}
		$data['keranjang'] = $this->keranjang->getKeranjang();
		$this->load->view("customer/keranjang", $data);
	}

	public function list_order($page = 1)
	{
		ini_set('display_errors', '0');
        ini_set('display_startup_errors', '0');
		error_reporting(E_ALL);

		$config = getConfigPagination(base_url()."customer/list_order",count($this->pembayaran->getListPembayaran()), 5, 3);
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

		$data["links"] = $this->pagination->create_links();
		$data['list_transaksi'] = $this->pembayaran->getListPembayaran($config["per_page"], $page);
		foreach ($data['list_transaksi'] as $key => $value) {
			$data['list_transaksi'][$key]['kendaraan'] = $this->kendaraan[$data['list_transaksi'][$key]['kode_kendaraan']];
		}

		$this->load->view("customer/list_order", $data);
	}

	public function pembayaran($action = '')
	{
		if (!isPost() || $this->pembayaran->getPembayaran()->status != 0) {
			redirect(base_url('customer/list_order'));
		}

		if ($action == 'upload') {
			$config['upload_path']		= './assets/uploads/bukti bayar/';
			$config['allowed_types']	= 'gif|jpg|png|jpeg';
			$config['remove_spaces']	= TRUE;
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload('bukti_bayar')){
				$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center text-white" role="alert"><h4>'.$this->upload->display_errors().'</h4></div>');
			} else {
				$data['upload_name'] = $this->upload->data('file_name');
			}
		}
		if ($action == 'send') {
			$this->pembayaran->changeStatusPembayaran($this->input->post('id_pembayaran'), 1);

			$this->session->set_flashdata('msg', '<div class="alert alert-success text-center text-white" role="alert"><h4>Silahkan tunggu admin untuk verifikasi</h4></div>');

			redirect(base_url('customer/list_order'));
		}
		$data['pembayaran'] = $this->pembayaran->getPembayaran();
		$data['bank']		= $this->bank->getAll();
		$this->load->view("customer/pembayaran", $data);
	}


/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */



	public function edit_profil()
	{
		$id = $this->session->userdata('id_user');

		if (isPost()) {
			$this->user->updateCustomer($id);			
		}

		$data['data'] = $this->user->getUserById($id);
		$this->load->view("customer/edit_profil", $data);
	}
}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
