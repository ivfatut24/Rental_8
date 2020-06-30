<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanProduk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesAdmin();
		$this->session->set_flashdata('menu', 'laporan-produk');
	}

	public function index($page = 1)
	{
		$date_timestamp = getFilterDate();
		$date = getFilterDate(false);

		$config = getConfigPagination(base_url() . "admin/laporan/produk", count($this->pemesanan->getAllPemesanan($date)), 5, 4);
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		$data['data'] = $this->pemesanan->getAllPemesanan($date, $config["per_page"], $page);
		$data['filter_date_start']	= $date_timestamp['start'];
		$data['filter_date_end']	= $date_timestamp['end'];
		$this->load->view('admin/laporan_produk/index', $data);
	}

}

/* End of file LaporanProduk.php */
/* Location: ./application/controllers/admin/LaporanProduk.php */
