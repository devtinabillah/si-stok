<?php 

class Pengiriman_model extends CI_Model {

	public function getAllJenisBarang() {
		return $this->db->where('status', 1)
		->get('jenis_barang')
		->result_array();
	}

	public function id_masuk(){
	 	$this->db->select('count(*) as kodeTransaksi');
    	$this->db->from('transaksi');
    	$this->db->where('id_user = 1');
    	return $this->db->get()->row()->kodeTransaksi;

	}

	public function getBrandBarangByIdJenis($idJenisBarang) {
		return $this->db->select('info_barang.id, brand_barang.nama')
			->from('info_barang')
			->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
			->where(['id_barang' => $idJenisBarang,
					'info_barang.status' => 1
					])
			->get()
			->result_array();
	}

	public function getTipeBarangByInfoBarang($idInfoBarang) {
		return $this->db->select('tipe_barang.id, tipe_barang.tipe')
			->from('tipe_barang')
			->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
			->where(['info_barang.id' => $idInfoBarang, 'tipe_barang.status' => 1])
			->get()
			->result_array();
	}

	public function getTipeBarangByJenisAndBrand($idJenisBarang, $idBrandBarang) {
		return $this->db->select('*')
			->from('tipe_barang')
			->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
			->where([
				'info_barang.id_barang' => $idJenisBarang,
				'info_barang.id_brand' => $idBrandBarang,
				'tipe_barang.status' => 1			
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

	public function getAllPermintaan() {
		return $this->db->select('
				transaksi.id as id_permintaan, transaksi.kode_transaksi, transaksi.tanggal, transaksi.status as id_status,
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
			->where('role.id', ROLE_PENGIRIMAN)
			->order_by('tanggal', 'DESC')
			->get()
			->result_array();
	}

	public function updateStatusPermintaan($idTransaksi, $status) {
		$this->db->where('id', $idTransaksi)
			->update('transaksi', [
				'status' => $status
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function getFifoBarang($tipeBarang) {
		return $this->db->select('barang_masuk.id, barang_masuk.jumlah')
			->from('barang_masuk')
			->join('transaksi', 'transaksi.id = barang_masuk.id_transaksi')
			->where(['id_tipe_barang' => $tipeBarang, 'jumlah >' => 0])
			->order_by('tanggal', 'ASC')
			->limit(1)
			->get()
			->result_array();
	}

	public function updateBarangMasuk($idBarangMasuk, $jumlah) {
		$this->db->where('id', $idBarangMasuk)
			->update('barang_masuk', [
				'jumlah' => $jumlah
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function insertHistoryBarang($idBarangMasuk, $jumlah) {
		$this->db->insert('history_barang', [
			'id_barang_masuk' => $idBarangMasuk,
			'jumlah' => $jumlah
		]);
		return ($this->db->affected_rows() > 0);
	}

	public function jumlahStok($idTipeBarang){
		return $this->db->select("
				 SUM(`jumlah`) AS `jumlah`
			")
			->from('barang_masuk')
			->where('id_tipe_barang', $idTipeBarang)
			->get()
			->result_array();
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