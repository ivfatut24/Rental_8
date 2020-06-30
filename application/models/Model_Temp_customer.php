<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Temp_customer extends CI_Model
{

	public function getById($id)
	{
		$this->db->where('id_user', $id);
		return $this->db->get('temp_customer')->row_array();
	}

	function registerCustomer()
	{
		$digits = 5;
		$security_code = str_pad(rand(0, pow(10, $digits)-1), $digits, '0', STR_PAD_LEFT);

		$data = array(
			'nama' => $this->input->post('nama'),
			'alamat' => $this->input->post('alamat'),
			'email' => $this->input->post('email'),
			'no_telp' => $this->input->post('no_telp'),
			'username' => $this->input->post('username'),
			'password' => md5($this->input->post('password')),
			'security_code' => $security_code,
		);
		
		if ($this->db->insert('temp_customer', $data)) {
			$data['id_user'] = $this->db->insert_id();			
			return [
				'status' => true,
				'data'	=> $data
			];
		} else {
			return [
				'status' => false,
				'data'	=> $data
			];
		}		
	}

	public function delete($id)
	{
		$this->db->where('id_user', $id);
		return $this->db->delete('temp_customer');
	}
}

/* End of file Model_Temp_customer.php */
/* Location: ./application/models/Model_Temp_customer.php */
