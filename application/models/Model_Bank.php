<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_Bank extends CI_Model {

	function getAll()
	{
		return $this->db->get('bank b')->result();
	}

	function insert()
	{
		$data = array(
			'nama_bank' => $this->input->post('nama_bank'),
			'rekening' => $this->input->post('rekening'),
			'pemilik_rekening'=>$this->input->post('pemilik_rekening'),
			'gambar'=>$this->upload->data('file_name')
		);
		return $this->db->insert('bank', $data);
	}

	function update()
	{
		$data = array(
			'nama_bank' => $this->input->post('nama_bank'),
			'rekening' => $this->input->post('rekening'),
			'pemilik_rekening'=>$this->input->post('pemilik_rekening'),
		);
		if (!empty($_FILES['gambar']['name'])) {
			$data['gambar'] = $this->upload->data('file_name');
		}
		$this->db->where('id_bank', $this->input->post('id_bank'));
		return $this->db->update('bank', $data);
	}

	function getById($id)
	{
		$this->db->where('id_bank', $id);
		return $this->db->get('bank')->row();
	}

	public function delete($id)
	{
		$this->db->where('id_bank', $id);
		return $this->db->delete('bank');;
	}

	public function updateStock($id_bank, $new_stock)
	{
		$bank = $this->getById($id_bank);

		$total_stock = $bank->stok + $new_stock;

		$this->db->where('id_bank', $bank->id_bank);
		$this->db->update('bank', ['stok' => $total_stock]);
	}

}

/* End of file Model_Bank.php */
/* Location: ./application/models/Model_Bank.php */
