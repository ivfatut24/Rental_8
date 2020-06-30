<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model_Maintenance extends CI_Model {

		public function getById($id_maintenance)
		{
			$this->db->select('*, m.created_at AS tgl_masuk_maintenance, b.created_at AS tgl_barang_ditambahkan');
			$this->db->join('barangs b', 'm.id_barang = b.id_barang', 'left');
			$this->db->join('kondisi_barang kb', 'm.id_kondisi_barang = kb.id_kondisi_barang', 'left');
			$this->db->where('id_maintenance', $id_maintenance);			
			return $this->db->get('maintenance m')->row();
		}
	function getAll($byStatus = -1, $date = 0, $limit = 0, $start = 0)
		{
			if ($byStatus != -1) {
				$this->db->where('m.status_barang', $byStatus);
			} else {
				$this->db->where('m.status_barang !=', 3);
			}

			if (is_array($date) && ($date['start'] != '' && $date['end'] != '')) {
				$this->db->where('finished_at BETWEEN \''. $date['start'] .'\' AND \''. $date['end'] .'\'');
			}

			if ($byStatus == 3) {
				$this->db->order_by('finished_at', 'desc');
			} else {
				$this->db->order_by('tgl_masuk_maintenance', 'desc');
			}

			$this->db->select('*, m.created_at AS tgl_masuk_maintenance, b.created_at AS tgl_barang_ditambahkan');
			$this->db->join('barangs b', 'm.id_barang = b.id_barang', 'left');
			$this->db->join('kondisi_barang kb', 'm.id_kondisi_barang = kb.id_kondisi_barang', 'left');
			return $this->db->get('maintenance m', $limit, $start)->result();
		}

		public function insert($data)
		{
			$this->db->insert('maintenance', $data);
		}

		// 0 = belum 1 = proses 2 = siap 3 = restock
		function changeStatus($id_maintenance, $status_barang)
		{
			$this->db->update('maintenance', ['status_barang' => $status_barang], ['id_maintenance' => $id_maintenance]);
		}

	}	
	/* End of file Model_Maintenance.php */	
?>
