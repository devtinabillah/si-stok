<?php 

class Gudang extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Gudang_model', 'gudang');
	}

	public function index() {
		$permintaan = $this->gudang->getAllPermintaan();

		$data = [];
		foreach($permintaan as $index => $value) {
			$data[$value['id_permintaan']] = [
				'id_permintaan' => $value['id_permintaan'],
				'kode_transaksi' => $value['kode_transaksi'],
				'tanggal' => $value['tanggal'],
				'id_status' => $value['id_status'],
				'status' => $value['status']
			];

			$data[$value['id_permintaan']]['detail'] = array_map(function ($item) use ($value) {
				if ($item['id_permintaan'] == $value['id_permintaan']) {
					return [
						'jenis' => $item['jenis'],
						'brand' => $item['brand'],
						'tipe' => $item['tipe'],
						'jumlah' => $item['jumlah']
					];
				}
			}, $permintaan);
		}

		foreach($data as $index => $value) {
			foreach($value['detail'] as $i => $j) {
				if (is_null($j)) {
					unset($data[$index]['detail'][$i]);
				}
			}
		}
		
		$this->load->view('gudang/permintaan', ['permintaan' => $data]);
	}

	public function terimaPermintaan($idTransaksi) {
		$isSuccess = $this->gudang->updateStatusTransaksi($idTransaksi, STATUS_DIPROSES);
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Permintaan Diterima</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Permintaan Gagal Diterima</center></div>');
		}
		redirect('gudang/gudang');
	}

	public function kirimPermintaan($idTransaksi) {
		$isSuccess = $this->gudang->updateStatusTransaksi($idTransaksi, STATUS_DIKIRIM);
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Permintaan Dikirim</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Permintaan Gagal Dikirim</center></div>');
		}
		redirect('gudang/gudang');
	}

	public function pengiriman() {
		$pengiriman = $this->gudang->getAllPengiriman();

		$data = [];
		foreach($pengiriman as $index => $value) {
			$data[$value['id_transaksi']] = [
				'id_transaksi' => $value['id_transaksi'],
				'kode_transaksi' => $value['kode_transaksi'],
				'tanggal' => $value['tanggal'],
				'id_status' => $value['id_status'],
				'status' => $value['status']
			];

			$data[$value['id_transaksi']]['detail'] = array_map(function ($item) use ($value) {
				if ($item['id_transaksi'] == $value['id_transaksi']) {
					return [
						'jenis' => $item['jenis'],
						'brand' => $item['brand'],
						'tipe' => $item['tipe'],
						'jumlah' => $item['jumlah']
					];
				}
			}, $pengiriman);
		}

		foreach($data as $index => $value) {
			foreach($value['detail'] as $i => $j) {
				if (is_null($j)) {
					unset($data[$index]['detail'][$i]);
				}
			}
		}
		
		$this->load->view('gudang/pengiriman', ['pengiriman' => $data]);
	}

	public function terimaPengiriman($idTransaksi) {
		$isSuccess = $this->gudang->updateStatusTransaksi($idTransaksi, STATUS_DITERIMA);
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Permintaan Diterima</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Permintaan Gagal Diterima</center></div>');
		}
		redirect('gudang/gudang/pengiriman');
	}

	public function stok() {
		
		$stok = $this->gudang->getAllStok();

		foreach($stok as $index => $value) {
			$fifo = $this->gudang->getFifoBarang($value['id_tipe']);
			// $jumlah = array_sum(array_column($fifo, 'jumlah'));
			$jumlahMasuk = $this->gudang->jumlahMasuk($value['id_tipe']);
			$jumlahKeluar = $this->gudang->jumlahKeluar($value['id_tipe']);

			$stok[$index]['stok'] = (($jumlahMasuk[0]['jumlah']== null) ? 0: $jumlahMasuk[0]['jumlah']) - (($jumlahKeluar[0]['jumlah'] == null) ? 0: $jumlahKeluar[0]['jumlah']);			
			$stok[$index]['jumlah_masuk'] = ($jumlahMasuk[0]['jumlah']== null) ? 0: $jumlahMasuk[0]['jumlah'];
			$stok[$index]['jumlah_keluar'] = ($jumlahKeluar[0]['jumlah'] == null) ? 0: $jumlahKeluar[0]['jumlah'];
			
			$stok[$index]['fifo'] = $fifo;
		}

		$this->load->view('gudang/stok', ['stok' => $stok]);
	}

	public function inputBarang() {
		$this->load->view('gudang/input_barang');
	}


	public function insertJenisBarang() {
		$jenisBarang = $this->input->post('jenis_barang');
		$jenisExist = !empty($this->gudang->getJenis($jenisBarang));
		if ($jenisExist){
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Jenis Barang Sudah Terdaftar</center></div>');
			redirect('gudang/gudang/inputbarang');
		}

		$isSuccess = $this->gudang->insertJenisBarang($jenisBarang);
		
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Berhasil Mengubah Data</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Gagal Menambahkan Data</center></div>');
		}
		
		redirect('gudang/gudang/inputbarang');
	}

	public function insertBrandBarang() {
		$idJenisBarang = $this->input->post('jenis_barang');
		$brandBarang = $this->input->post('brand_barang');

		$brandExist = !empty($this->gudang->getBrand($idJenisBarang, $brandBarang));
		if ($brandExist){
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Jenis Barang Sudah Terdaftar</center></div>');
			redirect('gudang/gudang/inputbarang');
		}

		$idBrandBarang = $this->gudang->insertBrandBarang($brandBarang);
		$isSuccess = $this->gudang->insertInfoBarang($idJenisBarang, $idBrandBarang);

		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Berhasil Mengubah Data</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Gagal Menambahkan Data</center></div>');
		}
		
		redirect('gudang/gudang/inputbarang');
	}

	public function convertNumber($number){
		if ($number >= 10) {
			return strval($number);
		} else {
			return "0" . strval($number);
		}
	}

	
	public function insertTipeBarang() {
		$idInfoBarang = $this->input->post('brand_barang');
		$tipeBarang = $this->input->post('tipe_barang');
		$limitStok = $this->input->post('limit_stok');

		$tipeExist = !empty($this->gudang->getTipe($idInfoBarang, $tipeBarang));
		if ($tipeExist){
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Tipe Barang Sudah Terdaftar</center></div>');
			redirect('gudang/gudang/inputbarang');
		}

		$infoBarang = $this->gudang->kode_info($idInfoBarang)[0];
		$id_barang = $infoBarang['id_barang'];
		$id_brand = $infoBarang['id_brand'];
		$jumlah = $this->gudang->getJumlahTipe($id_barang, $id_brand)[0]['jumlah']+1;

		$convertJenis = $this->convertNumber($id_barang);
		$convertBrand = $this->convertNumber($id_brand);
		$convertTipe = $this->convertNumber($jumlah);

		$kode_barang = $convertJenis . $convertBrand . $convertTipe;
		

		$isSuccess = $this->gudang->insertTipeBarang($kode_barang, $idInfoBarang, $tipeBarang, $limitStok);		
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary my-3" role="alert"><center>Berhasil Menambahkan Data</center></div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Gagal Menambahkan Data</center></div>');
		}
		
		redirect('gudang/gudang/inputbarang');
	}

	public function lap_masuk(){
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');

		$data = ['id_user' => 1];

		if (isset($bulan) && $bulan != '0') {
			$data['month(tanggal)'] = $bulan;
		}

		if (isset($tahun) && $tahun != '0') {
			$data['year(tanggal)'] = $tahun;
		}

		$lap_keluar = $this->gudang->lap_masuk($data)[0]['jumlah'];

		$data['id_user'] = 3;
		$lap_masuk = $this->gudang->lap_masuk($data)[0]['jumlah'];

		$this->load->view('gudang/lap_brgmasuk', ['lap_masuk' => $lap_masuk, 'lap_keluar' => $lap_keluar]);
	}


	public function dataProduk(){
		$this->load->view('gudang/data_produk');
	}
	
	public function editdatabarang(){
		$this->load->view('gudang/edit');
	}

	public function editjenis(){
		$jenis_barang = $this->input->post('jenis_barang');
		$editjenis = $this->gudang->editJenis($jenis_barang);
		$data = [];
		foreach($editjenis as $index => $value) {
			$data[0] = [
				'id' => $value['id'],
				'nama' => $value['nama']
			];

		}

		$this->load->view('gudang/edit_jenis', ['editjenis' => $data[0]]);
	}

	public function updateJenis(){
		$id_jenis = $this->input->post('id_jenis');
		$nama_jenis = $this->input->post('jenis_barang');

		$updateJenis = $this->gudang->updateJenis($id_jenis, $nama_jenis);
		if($updateJenis){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	}

	public function editbrand(){
		$jenis_barang = $this->input->post('jenis_barang');
		$brand_barang = $this->input->post('brand_barang');

		$editbrand = $this->gudang->editbrand($brand_barang);
		$data = [];
		foreach($editbrand as $index => $value) {
			$data[0] = [
				'id_brand' => $value['id'],
				'jenis_barang' => $value['jenis'],
				'brand_barang' => $value['brand']
			];

		}

		$this->load->view('gudang/edit_brand', ['editbrand' => $data[0]]);
	}

	public function updatebrand(){
		$id_brand = $this->input->post('id_brand');
		$brand_barang = $this->input->post('brand_barang');


		$updatebrand = $this->gudang->updatebrand($id_brand, $brand_barang);
		if($updatebrand){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	}
	
	public function edittipe(){
		$jenis_barang = $this->input->post('jenis_barang');
		$brand_barang = $this->input->post('brand_barang');
		$tipe_barang = $this->input->post('tipe_barang');

		$edittipe = $this->gudang->edittipe($tipe_barang);
		$data = [];
		foreach($edittipe as $index => $value) {
			$data[0] = [
				'id_tipe' => $value['id'],
				'jenis_barang' => $value['jenis'],
				'brand_barang' => $value['brand'],
				'tipe_barang' => $value['tipe']
			];

		}

		

		$this->load->view('gudang/edit_tipe', ['edittipe' => $data[0]]);
	}

	public function updatetipe(){
		$id_tipe = $this->input->post('id_tipe');
		$tipe_barang = $this->input->post('tipe_barang');

		$updatetipe = $this->gudang->updatetipe($id_tipe, $tipe_barang);
		if($updatetipe){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	} 

	public function hapusjenis(){
		$id_jenis = $this->input->post('jenis_barang');


		$hapusjenis = $this->gudang->hapusjenis($id_jenis);
		if($hapusjenis){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	} 
	public function hapusbrand(){
		$id_jenis = $this->input->post('jenis_barang');
		$id_brand = $this->input->post('brand_barang');

		$hapusbrand = $this->gudang->hapusbrand($id_brand, $id_jenis);
		if($hapusbrand){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	} 
	public function hapustipe(){
		$id_tipe = $this->input->post('tipe_barang');


		$hapustipe = $this->gudang->hapustipe($id_tipe);
		if($hapustipe){
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil mengubah data barang !</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal mengubah data barang, </div>');
		}
		redirect('gudang/gudang/editdatabarang');

	} 
}

?>