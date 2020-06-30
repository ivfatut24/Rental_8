<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model_Pengembalian extends CI_Model {

		public function insert()
		{
			$data = [
				'id_transaksi'		=> $this->input->post('id_transaksi'),
				'total_denda'		=> $this->input->post('total_denda'),				
			];

			$this->db->insert('pengembalian', $data);
			return $this->db->insert_id();
		}

	}	
	/* End of file Model_Pengembalian.php */	
?>
