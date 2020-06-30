<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaPengembalian extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesAdmin();
		$this->session->set_flashdata('menu', 'kelola-pengembalian');
	}

	public function index()
	{
		$data['list_kondisi_barang'] = $this->kondisi_barang->get();
		$data['pemesanan'] = $this->pemesanan->getAllPemesanan(4);
		$this->load->view('admin/kelola_pengembalian/index', $data);
	}

	public function kembali()
	{
		$array = $_POST;
		$keys = array_keys($array);
		$matchingKeys = preg_grep('/^denda_+/', $keys);
		$filteredArray = array_intersect_key($array, array_flip($matchingKeys));
		$_POST['total_denda'] = array_sum($filteredArray);
		
		$matchingKeysKondisiBarang = preg_grep('/^kondisi_barang_+/', $keys);
		foreach ($matchingKeysKondisiBarang as $k => $v) {
			$_POST['list_kondisi_barang'][] = [
				'id_barang' => explode('_', $v)[2],
				'id_kondisi_barang' => $array[$v],
			];
		}
		
		$id_transaksi = $this->input->post('id_transaksi');
		$id_pengembalian = $this->pengembalian->insert();
		$this->pemesanan->changeStatus($id_transaksi, 4);
		foreach ($_POST['list_kondisi_barang'] as $key => $value) {
			$data = [
				'id_pengembalian'		=> $id_pengembalian,
				'id_barang'				=> $value['id_barang'],
				'id_kondisi_barang'		=> $value['id_kondisi_barang'],
				'status_barang'			=> $value['id_kondisi_barang'] == 1 ? 2 : 0,
			];
			$this->maintenance->insert($data);
		}
		redirect(base_url('admin/kelola/pengembalian'));
	}
}

/* End of file KelolaPengembalian.php */
/* Location: ./application/controllers/admin/KelolaPengembalian.php */
