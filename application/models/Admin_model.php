<?php 

class Admin_model extends CI_Model {

	public function getJenis($jenisBarang){
		return $this->db->select('*')
		->from('jenis_barang')
		->like('lower(nama)', strtolower($jenisBarang))
		->get()
		->result_array();
	}	

	public function insertJenisBarang($jenisBarang) {
		$this->db->insert('jenis_barang', [
			'nama' => $jenisBarang
		]);

		return $this->db->insert_id();
	}

	public function getBrand($idJenisBarang, $brandBarang){
		return $this->db->select('*')
		->from('info_barang')
		->join('jenis_barang','jenis_barang.id = info_barang.id_barang')
		->join('brand_barang','brand_barang.id = info_barang.id_brand')
		->where(['info_barang.id_barang' => $idJenisBarang, 'lower(brand_barang.nama)' => strtolower($brandBarang)])
		->get()
		->result_array();
	}

	public function insertBrandBarang($brandBarang) {
		$this->db->insert('brand_barang', [
			'nama' => $brandBarang
		]);

		return $this->db->insert_id();
	}

	public function insertInfoBarang($idJenisBarang, $idBrandBarang) {
		$this->db->insert('info_barang', [
			'id_barang' => $idJenisBarang,
			'id_brand' => $idBrandBarang
		]);

		return $this->db->insert_id();
	}

	public function getTipe($idInfoBarang, $tipeBarang){
		return $this->db->select('*')
		->from('tipe_barang')
		->join('info_barang','info_barang.id = tipe_barang.id_info_barang')
		->where(['info_barang.id' => $idInfoBarang, 'lower(tipe_barang.tipe)' => strtolower($tipeBarang)])
		->get()
		->result_array();
	}

	public function insertTipeBarang($kode_barang, $idInfoBarang, $tipeBarang, $limitBarang) {
		$this->db->insert('tipe_barang', [
			'kode_barang' => $kode_barang,
			'id_info_barang' => $idInfoBarang,
			'tipe' => $tipeBarang,
			'limit_stok' => $limitBarang
		]);

		return ($this->db->affected_rows() > 0);
	}

	public function getAllStok() {
		return $this->db->select("
			jenis_barang.nama as jenis_barang, brand_barang.nama as brand_barang,
			tipe_barang.tipe as tipe_barang, tipe_barang.kode_barang, tipe_barang.limit_stok, tipe_barang.id as id_tipe,
			")
		->from('detail_transaksi')
		->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')
		->join('tipe_barang', 'tipe_barang.id = detail_transaksi.id_tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->group_by('tipe_barang.id')
		->order_by('kode_barang', 'ASC')
		->get()
		->result_array();
	}

		public function getFifoBarang($idTipeBarang) {
		return $this->db->select('transaksi.kode_transaksi, sum(barang_masuk.jumlah) as jumlah')
			->from('barang_masuk')
			->join('transaksi', 'transaksi.id = barang_masuk.id_transaksi')
			->where('id_tipe_barang', $idTipeBarang)
			->where('jumlah != 0')
			->group_by('transaksi.kode_transaksi')
			->get()
			->result_array();
	}


	public function lap_masuk($query){
		return $this->db->select('count(*) as jumlah')
		->from('transaksi')
		->where($query) 
		->get()
		->result_array();
	}


	public function cariIdBarang($kode_barang){
		return $this->db->select('tipe_barang.id')
		->from('tipe_barang')
		->where('tipe_barang.kode_barang', $kode_barang) 
		->get()
		->result_array();
	}

	public function updateTipeBarang($kode_barang, $tipe_barang) {
		$this->db->where('id', $kode_barang)
			->update('tipe_barang', [
				'tipe' => $tipe_barang
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function deleteBarang($kode_barang) {
		$this->db->where('id', $kode_barang)
			->update('tipe_barang', [
				'status' => 1
			]);

		return ($this->db->affected_rows() > 0);
	}
	
	public function editBarang($kode_barang){
		return $this->db->select("
			jenis_barang.nama as jenis_barang, brand_barang.nama as brand_barang,
			tipe_barang.tipe as tipe_barang, tipe_barang.kode_barang, tipe_barang.id as id_tipe,
			")
		->from('tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->where('tipe_barang.kode_barang', $kode_barang)
		->get()
		->result_array();
	}
}

?>