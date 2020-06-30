<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanBarangMasuk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesAdmin();
		$this->session->set_flashdata('menu', 'laporan-barangmasuk');
	}

	public function index()
	{
		$date_timestamp = getFilterDate();
		$date = getFilterDate(false);

		$config = getConfigPagination(base_url() . "admin/laporan/barangmasuk", count($this->maintenance->getAll(3, $date)), 5, 4);
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

		$data["links"] = $this->pagination->create_links();
		$data['data'] = $this->maintenance->getAll(3, $date, $config["per_page"], $page);
		$data['filter_date_start']	= $date_timestamp['start'];
		$data['filter_date_end']	= $date_timestamp['end'];
		$this->load->view('admin/laporan_barangmasuk/index', $data);
	}

}

/* End of file LaporanBarangMasuk.php */
/* Location: ./application/controllers/admin/LaporanBarangMasuk.php */
