<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Model_Pemesanan extends CI_Model {
	
		function getAllPemesanan($date = 0, $limit = 0, $start = 0)
		{
			/**
			 * params $date =>
			 * 0 = all not temp
			 * 1 = last month
			 * 2 = this month
			 * 3 = where verified + detail transaksi
			 * 4 = where status_transaksi = 3 => barang keluar/disewa
			 */


			$this->db->select('t.*, u.*, p.*, tu.*, pen.*, t.id_transaksi');				
			$this->db->join('users u', 't.id_user = u.id_user', 'left');				
			$this->db->join('pembayaran p', 't.id_transaksi = p.id_transaksi', 'left');
			$this->db->join('tujuan tu', 't.id_tujuan = tu.id', 'left');
			$this->db->join('pengembalian pen', 't.id_transaksi = pen.id_transaksi', 'left');
			

			$this->db->order_by('t.id_transaksi', 'desc');
			$this->db->where('status_transaksi !=', 0);			

			// where transaksi bulan lalu
			if ($date == 1) {
				$firstDay = new DateTime('first day of last month');
				$lastDay  = new DateTime('last day of last month');
				$this->db->where('tgl_pemesanan BETWEEN \''. $firstDay->format('Y-m-d h:i:s') .'\' AND \''. $lastDay->format('Y-m-d h:i:s') .'\'');
			}
			// where transaksi bulan ini
			if ($date == 2) {
				$firstDay = new DateTime('first day of this month');
				$lastDay  = new DateTime('last day of this month');
				$this->db->where('tgl_pemesanan BETWEEN \''. $firstDay->format('Y-m-d h:i:s') .'\' AND \''. $lastDay->format('Y-m-d h:i:s') .'\'');
			}
			if ($date == 3) {
				$this->db->where('p.status', 1);
				$this->db->where('p.is_verified', 1);
			}
			if ($date == 4) {
				$this->db->where('t.status_transaksi', 3);
			}

			if (is_array($date) && ($date['start'] != '' && $date['end'] != '')) {
				$this->db->where('tgl_sewa BETWEEN \''. $date['start'] .'\' AND \''. $date['end'] .'\'');
			}

			$ret = $this->db->get('transaksi t', $limit, $start)->result();
			foreach ($ret as $key => $value) {
				$this->db->join('barangs b', 'b.id_barang = dt.id_barang');
				$this->db->where('id_transaksi', $value->id_transaksi);			
				$ret[$key]->detail_transaksi = $this->db->get('detail_transaksi dt')->result_array();
			}
			return $ret;
		}
	
		/**
		 * status transaksi
		 *	0 = sementara 1 = transaksi 2 = siap 3 = keluar 4 = kembali
		 */
		function changeStatus($id_transaksi, $status_transaksi)
		{
			$this->db->update('transaksi', ['status_transaksi' => $status_transaksi], ['id_transaksi' => $id_transaksi]);
		}

	}	
	/* End of file Model_Pemesanan.php */	
?>
