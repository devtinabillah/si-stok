<?php 

class Pembelian_model extends CI_Model {
	
	public function getAllJenisBarang() {
		return $this->db->get('jenis_barang')->result_array();
	}

	public function getBrandBarangByIdJenis($idJenisBarang) {
		return $this->db->select('info_barang.id, brand_barang.nama')
			->from('info_barang')
			->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
			->where('id_barang', $idJenisBarang)
			->get()
			->result_array();
	}

	public function id_masuk(){
	 	$this->db->select('count(*) as kodeTransaksi');
    	$this->db->from('transaksi');
    	$this->db->where('id_user = 3');
    	return $this->db->get()->row()->kodeTransaksi;
	}

	public function getInfoBarangByJenisAndBrand($idJenisBarang, $idBrandBarang) {
		return $this->db->select('*')
			->from('info_barang')
			->where([
				'id_barang' => $idJenisBarang,
				'id_brand' => $idBrandBarang
			])
			->get()
			->result_array();
	}




	public function insertTransaksi($idUser, $kode_transaksi, $tanggal) {
		$this->db->insert('transaksi', [
			'id_user' => $idUser,
			'kode_transaksi' => $kode_transaksi,
			'tanggal' => $tanggal,
			'status' => STATUS_DIAJUKAN
		]);

		return $this->db->insert_id();
	}

	public function insertDetailTransaksi($data) {
		$this->db->insert_batch('detail_transaksi', $data);
		return ($this->db->affected_rows() > 0);
	}

	public function insertBarangMasuk($data) {
		$this->db->insert('barang_masuk', $data);
		return $this->db->insert_id();
	}

	public function insertHistoryBarang($data) {
		$this->db->insert_batch('history_barang', $data);
		return ($this->db->affected_rows() > 0);
	}

	public function getAllPengiriman() {
		return $this->db->select('
				transaksi.id as id_pengiriman, transaksi.kode_transaksi, transaksi.tanggal, transaksi.status as id_status,
				jenis_barang.nama as jenis, brand_barang.nama as brand, tipe_barang.tipe as tipe,
				detail_transaksi.jumlah, status.status
			')
			->from('transaksi')
			->join('status', 'status.id = transaksi.status')
			->join('user', 'user.id = transaksi.id_user')
			->join('role', 'role.id = user.role')
			->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id')
			->join('tipe_barang', 'tipe_barang.id = detail_transaksi.id_tipe_barang')
			->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
			->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
			->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
			->where('role.id', ROLE_PEMBELIAN)
			->order_by('tanggal', 'DESC')
			->get()
			->result_array();
	}

	public function getAllStok() {
		return $this->db->select("
				jenis_barang.nama as jenis_barang, brand_barang.nama as brand_barang,
				tipe_barang.tipe as tipe_barang, tipe_barang.limit_stok, tipe_barang.id as id_tipe,
			")
			->from('detail_transaksi')
			->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')
			->join('tipe_barang', 'tipe_barang.id = detail_transaksi.id_tipe_barang')
			->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
			->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
			->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
			->group_by('tipe_barang.id')
			->order_by('tanggal', 'ASC')
			->get()
			->result_array();
	}

	public function getFifoBarang($idTipeBarang) {
		return $this->db->select('barang_masuk.id_transaksi as id_fifo, barang_masuk.jumlah')
			->from('barang_masuk')
			->where('id_tipe_barang', $idTipeBarang)
			->get()
			->result_array();
	}

	public function updateStatusPengiriman($IdTransaksi, $status) {
		$this->db->where('id', $IdTransaksi)
			->update('transaksi', [
				'status' => $status
			]);

		return ($this->db->affected_rows() > 0);
	}
	
	public function deleteDetail($idTransaksi){
		$this->db->delete('detail_transaksi', ['id_transaksi' => $idTransaksi]);
		return ($this->db->affected_rows() > 0);
	}

	public function cariIdTransaksi($kode_transaksi){
		return $this->db->select('transaksi.id')
		->from('transaksi')
		->where('transaksi.kode_transaksi', $kode_transaksi) 
		->get()
		->result_array();
	}

	public function editTransaksi($id_transaksi){
		return $this->db->select('
			transaksi.id as id_transaksi, transaksi.kode_transaksi, transaksi.tanggal,
			jenis_barang.nama as jenis, brand_barang.nama as brand, tipe_barang.tipe as tipe,
			detail_transaksi.jumlah, jenis_barang.id as id_jenis, brand_barang.id as id_brand, tipe_barang.id as id_tipe
			')
		->from('transaksi')
		->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id')
		->join('tipe_barang', 'tipe_barang.id = detail_transaksi.id_tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->where('transaksi.id', $id_transaksi)
		->get()
		->result_array();
	}
}

?>