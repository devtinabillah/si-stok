<?php 

class Pembelian extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Pembelian_model', 'pembelian');
	}

	public function index() {
		$stok = $this->pembelian->getAllStok();

		foreach($stok as $index => $value) {
			$fifo = $this->pembelian->getFifoBarang($value['id_tipe']);
			$jumlah = array_sum(array_column($fifo, 'jumlah'));
			$stok[$index]['stok'] = $jumlah;
			$stok[$index]['fifo'] = $fifo;
		}

		$this->load->view('pembelian/stok', ['stok' => $stok]);
	}


	public function inputPengiriman() {
		$id_masuk['kodeTransaksi'] = $this->pembelian->id_masuk();
		$idmasuk = $id_masuk['kodeTransaksi'];

		date_default_timezone_set("Asia/Jakarta");
		$date = date('yy-mm-dd');

		$urutan = (int) substr($idmasuk, -3);
		$urutan++;
		$huruf = "BM";
		$tahun=substr($date, 0, 4);

		$bulan=substr($date, 5, 2);
		$data['kode_transaksi'] = $huruf . $tahun . $bulan .  sprintf("%03s", $urutan);

		$this->load->view('pembelian/input_pengiriman', $data);
	}

	public function tambahPengiriman() {
		$length = count($this->input->post('jenis_barang'));
		$jenisArr = $this->input->post('jenis_barang');
		$tipeArr = $this->input->post('tipe_barang');
		$brandArr = $this->input->post('brand_barang');
		$jumlahArr = $this->input->post('jumlah_barang');
		$kode_transaksi = $this->input->post('kode');
		$tanggal = $this->input->post('tgl');
		
		$listItem = [];
		for($i = 0; $i < $length; $i++) {
			$listItem[] = [
				'jenis_barang' => $jenisArr[$i],
				'tipe_barang' => $tipeArr[$i],
				'brand_barang' => $brandArr[$i],
				'jumlah_barang' => $jumlahArr[$i]
			];
		}
		
		$idUser = $this->session->userdata('id');
		$idTransaksi = $this->pembelian->insertTransaksi($idUser, $kode_transaksi, $tanggal);
		
		if (!$idTransaksi) {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal menambahkan pengiriman, silahkan coba lagi!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil menambahkan pengiriman!</div>');
		}

		$data = [];
		foreach($listItem as $value) {
			$data[] = [
				'id_transaksi' => $idTransaksi,
				'id_tipe_barang' => $value['tipe_barang'],
				'jumlah' => $value['jumlah_barang']
			];
		}

		$insertStatusDetailTransaksi = $this->pembelian->insertDetailTransaksi($data);
		/////

		$isSuccess = $insertStatusDetailTransaksi;
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil menambahkan pengiriman!</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal menambahkan pengiriman, silahkan coba lagi!</div>');
		}
		redirect('pembelian/pembelian/inputPengiriman');
	}

	public function editTransaksi($id_transaksi){
		$pengiriman = $this->pembelian->editTransaksi($id_transaksi);

		$data = [];
		foreach($pengiriman as $index => $value) {
			$data[0] = [
				'id_transaksi' => $value['id_transaksi'],
				'kode_transaksi' => $value['kode_transaksi'],
				'tanggal' => $value['tanggal'],
			];

			$data[0]['detail'] = array_map(function ($item) use ($value) {
				if ($item['id_transaksi'] == $value['id_transaksi']) {
					return [
						'id_jenis' => $item['id_jenis'],
						'id_brand' => $item['id_brand'],
						'id_tipe' => $item['id_tipe'],
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

		$this->load->view('pembelian/edit_pengiriman', ['edit' => $data[0]]);
	}

	public function updateTransaksi() {
		$length = count($this->input->post('jenis_barang'));
		$jenisArr = $this->input->post('jenis_barang');
		$tipeArr = $this->input->post('tipe_barang');
		$brandArr = $this->input->post('brand_barang');
		$jumlahArr = $this->input->post('jumlah_barang');
		$kode_transaksi = $this->input->post('kode');
		$tanggal = $this->input->post('tgl');
		
		$listItem = [];
		for($i = 0; $i < $length; $i++) {
			$listItem[] = [
				'jenis_barang' => $jenisArr[$i],
				'brand_barang' => $brandArr[$i],
				'tipe_barang' => $tipeArr[$i],
				'jumlah_barang' => $jumlahArr[$i]
			];
		}
		
		$data = [];
		$idTransaksi = $this->pembelian->cariIdTransaksi($kode_transaksi)[0]['id'];
		foreach($listItem as $value) {
			$data[] = [
				'id_transaksi' => $idTransaksi,
				'id_tipe_barang' => $value['tipe_barang'],
				'jumlah' => $value['jumlah_barang']
			];
		}

		
		$deleteDetail = $this->pembelian->deleteDetail($idTransaksi);

		$insertDetail = $this->pembelian->insertDetailTransaksi($data);

		$data = array_map(function($item) {
			return [
				'id_barang_masuk' => $this->pembelian->insertBarangMasuk($item),
				'jumlah' => $item['jumlah']
			];
		}, $data);

		$insertStatusHistoryBarang = $this->pembelian->insertHistoryBarang($data);
		$updateStatusPengiriman = $this->pembelian->updateStatusPengiriman($idTransaksi, STATUS_DIKIRIM);

		$isSuccess = $deleteDetail && $insertDetail && $insertStatusHistoryBarang && $updateStatusTransaksi;
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil memperbarui pengiriman!</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal memperbarui pengiriman</div>');
		}
		redirect('pembelian/pembelian/daftarPengiriman');
	}

	public function daftarPengiriman() {
		$pengiriman = $this->pembelian->getAllPengiriman();

		$data = [];
		foreach($pengiriman as $index => $value) {
			$data[$value['id_pengiriman']] = [
				'id_pengiriman' => $value['id_pengiriman'],
				'kode_transaksi' => $value['kode_transaksi'],
				'tanggal' => $value['tanggal'],
				'id_status' => $value['id_status'],
				'status' => $value['status']
			];

			$data[$value['id_pengiriman']]['detail'] = array_map(function ($item) use ($value) {
				if ($item['id_pengiriman'] == $value['id_pengiriman']) {
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

		$this->load->view('pembelian/riwayat_pengiriman', ['pengiriman' => $data]);
	}

	
}

?>