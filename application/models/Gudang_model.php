<?php 

class Gudang_model extends CI_Model {

	public function getJenis($jenisBarang){
		return $this->db->select('*')
		->from('jenis_barang')
		->where('status', 1)
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
		->where([
			'info_barang.id_barang' => $idJenisBarang, 
			'lower(brand_barang.nama)' => strtolower($brandBarang), 
			'jenis_barang.status = 1',
			'info_barang.status = 1'
		])
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
		->where([
			'info_barang.id' => $idInfoBarang, 
			'lower(tipe_barang.tipe)' => strtolower($tipeBarang), 
			'jenis_barang.status = 1',
			'info_barang.status = 1',
			'tipe_barang.status = 1'
		])
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

	public function kode_info($idInfoBarang) {
		return $this->db->select('*')
		->from('info_barang')
		->where('id', $idInfoBarang)
		->get()
		->result_array();
	}

	public function getJumlahTipe($idJenisBarang, $idBrandBarang){
		return $this->db->select('count(*) as jumlah')
		->from('tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->where(['jenis_barang.id'=>$idJenisBarang, 'brand_barang.id'=>$idBrandBarang])
		->get()
		->result_array();
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

	public function updateStatusTransaksi($idTransaksi, $status) {
		$this->db->where('id', $idTransaksi)
		->update('transaksi', [
			'status' => $status
		]);

		return ($this->db->affected_rows() > 0);
	}

	public function getAllPengiriman() {
		return $this->db->select('
			transaksi.id as id_transaksi, transaksi.kode_transaksi, transaksi.tanggal, transaksi.status as id_status,
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
			tipe_barang.tipe as tipe_barang, tipe_barang.kode_barang, tipe_barang.limit_stok, tipe_barang.id as id_tipe,
			")
		->from('detail_transaksi')
		->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')
		->join('tipe_barang', 'tipe_barang.id = detail_transaksi.id_tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->where([
			'tipe_barang.status' => 1, 
			'jenis_barang.status' => 1
			])
		->group_by('tipe_barang.id')
		->order_by('kode_barang', 'ASC')
		->get()
		->result_array();
	}

	public function jumlahMasuk($idTipeBarang) {
		return $this->db->select("SUM(`detail_transaksi`.`jumlah`) AS `jumlah`
			")
		->from('detail_transaksi')
		->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')
		->join('user', 'user.id = transaksi.id_user')
		->where(['user.role'=>ROLE_PEMBELIAN, 'detail_transaksi.id_tipe_barang'=>$idTipeBarang])
		->get()
		->result_array();
	}

	public function jumlahKeluar($idTipeBarang) {
		return $this->db->select("
			SUM(`detail_transaksi`.`jumlah`) AS `jumlah`
			")
		->from('detail_transaksi')
		->join('transaksi', 'transaksi.id = detail_transaksi.id_transaksi')
		->join('user', 'user.id = transaksi.id_user')
		->where(['user.role'=>ROLE_PENGIRIMAN, 'detail_transaksi.id_tipe_barang'=>$idTipeBarang])
		->get()
		->result_array();
	}

	public function jumlah($id_barang) {
		
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

	public function cariIdDetailTransaksi($kode_transaksi, $id_tipe, $jumlah){
		return $this->db->select('transaksi.id as id_transaksi, detail_transaksi.id')
		->from('transaksi')
		->join('detail_transaksi', 'detail_transaksi.id_transaksi = transaksi.id')
		->where(['transaksi.kode_transaksi' => $kode_transaksi, 'detail_transaksi.id_tipe_barang' => $id_tipe, 'detail_transaksi.jumlah' => $jumlah]) 
		->get()
		->result_array();
	}

	public function cariIdTransaksi($kode_transaksi){
		return $this->db->select('transaksi.id')
		->from('transaksi')
		->where('transaksi.kode_transaksi', $kode_transaksi) 
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


	public function editJenis($id){
		return $this->db->select("id, nama")
		->from('jenis_barang')
		->where('id', $id)
		->get()
		->result_array();
	}

	public function updateJenis($id_jenis, $nama_jenis) {
		$this->db->where('id', $id_jenis)
			->update('jenis_barang', [
				'nama' => $nama_jenis
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function editbrand($id){
		return $this->db->select("jenis_barang.nama as jenis, brand_barang.nama as brand, brand_barang.id as id")
		->from('info_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->where('info_barang.id', $id)
		->get()
		->result_array();
	}

	public function updatebrand($id_brand, $brand_barang) {
		$this->db->where('id', $id_brand)
			->update('brand_barang', [
				'nama' => $brand_barang
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function edittipe($id){
		return $this->db->select("
			jenis_barang.nama as jenis, brand_barang.nama as brand,
			tipe_barang.tipe as tipe, tipe_barang.id as id
			")
		->from('tipe_barang')
		->join('info_barang', 'info_barang.id = tipe_barang.id_info_barang')
		->join('brand_barang', 'brand_barang.id = info_barang.id_brand')
		->join('jenis_barang', 'jenis_barang.id = info_barang.id_barang')
		->where('tipe_barang.id', $id)
		->get()
		->result_array();
	}


	public function updatetipe($id_tipe, $tipe_barang) {
		$this->db->where('id', $id_tipe)
			->update('tipe_barang', [
				'tipe' => $tipe_barang
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function hapusjenis($id_jenis) {
		$this->db->where('id', $id_jenis)
			->update('jenis_barang', [
				'status' => 0
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function hapusbrand($id_brand, $id_jenis) {
		$this->db->where(['id_brand' => $id_brand, 'id_barang' => $id_jenis])
			->update('info_barang', [
				'status' => 0
			]);

		return ($this->db->affected_rows() > 0);
	}

	public function hapustipe($id_tipe) {
		$this->db->where('id', $id_tipe)
			->update('tipe_barang', [
				'status' => 0
			]);

		return ($this->db->affected_rows() > 0);
	}


}


?>