<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan extends CI_Model
{
	public function getLaporanBarang($id_barang, $date)
	{
		$tujuan = $this->db->get('tujuan')->result();

		foreach ($tujuan as $key => $value) {
			$tujuan[$key]->jumlah = $this->getCountTujuanBarang($id_barang, $value->id, $date); //set count per barang
		}

		return $tujuan;
    }
    
	public function getLaporanPengunjung($date)
	{
		$tujuan = $this->db->get('tujuan')->result();
		foreach ($tujuan as $key => $value) {
			$tujuan[$key]->jumlah = $this->getCountTujuanPengunjung($value->id, $date); // set count per tujuan
		}

		return $tujuan;
    }
    
    private function getCountTujuanBarang($id_barang, $id_tujuan, $date)
    {
		// query hitung barang per tujuan
        return $this->db->query("
			SELECT * 
			FROM barangs b, detail_transaksi dt, transaksi t, tujuan tu, pembayaran p
			WHERE b.id_barang=dt.id_barang AND dt.id_transaksi=t.id_transaksi AND t.id_tujuan=tu.id AND p.id_transaksi=t.id_transaksi AND p.status=1
			AND b.id_barang = $id_barang AND tu.id = $id_tujuan
			".
			($date['start'] != '' ? "AND t.tgl_sewa >= '" . $date['start'] . "' " : '') .
			($date['end'] != '' ? "AND t.tgl_sewa <= '" . $date['end'] . "' " : '')
		)->num_rows();
    }
    
    private function getCountTujuanPengunjung($id_tujuan, $date)
    {
		// query hitung tujuan + filter date
        return $this->db->query("
			SELECT * 
			FROM transaksi t, tujuan tu, pembayaran p
			WHERE t.id_tujuan=tu.id AND p.id_transaksi=t.id_transaksi AND p.status=1
			AND t.id_tujuan = $id_tujuan
			".
			($date['start'] != '' ? "AND t.tgl_sewa >= '" . $date['start'] . "' " : '') .
			($date['end'] != '' ? "AND t.tgl_sewa <= '" . $date['end'] . "' " : '')
		)->num_rows();
    }
}

/* End of file Model_Laporan.php */
/* Location: ./application/models/Model_Laporan.php */
