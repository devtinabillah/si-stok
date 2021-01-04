<?php 

class Pengiriman extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Pengiriman_model', 'pengiriman');
	}

	public function index() {
		// $jenisBarang = $this->pengiriman->getAllJenisBarang();
		// $brandByIdJenis = $this->pengiriman->getBrandBarangByIdJenis(1);
		// $tipeByIdInfo = $this->pengiriman->getTipeBarangByInfoBarang(1);

		// echo '<pre>';
		// var_dump($jenisBarang);
		// var_dump($brandByIdJenis);
		// var_dump($tipeByIdInfo);
		// return;
		$id_masuk['kodeTransaksi'] = $this->pengiriman->id_masuk();
		$idmasuk = $id_masuk['kodeTransaksi'];

		date_default_timezone_set("Asia/Jakarta");
		$date = date('yy-mm-dd');

		$urutan = (int) substr($idmasuk, -3);
		$urutan++;
		$huruf = "BK";
		$tahun=substr($date, 0, 4);

		$bulan=substr($date, 5, 2);
		$data['kode_transaksi'] = $huruf . $tahun . $bulan .  sprintf("%03s", $urutan);

		$this->load->view('pengiriman/input', $data);
	}

	public function riwayat() {
		$permintaan = $this->pengiriman->getAllPermintaan();

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
		
		$this->load->view('pengiriman/riwayat', ['permintaan' => $data]);
	}

	public function tambahPermintaan() {
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

		// CEK JUMLAH
		foreach ($listItem as $value) {
			$jumlah = $value['jumlah_barang'];
			$jumlahStok = $this->pengiriman->jumlahStok($value['tipe_barang'])[0]['jumlah'];
			
			if ($jumlahStok < $jumlah) {
				$this->session->set_flashdata('message', '<div class="alert alert-warning my-3" role="alert"><center>Gagal Menambahkan Permintaan! Jumlah Persediaan Tidak Mencukupi!</center></div>');
				redirect('pengiriman/pengiriman');
			}
		}

		$idUser = $this->session->userdata('id');
		$idTransaksi = $this->pengiriman->insertTransaksi($idUser, $kode_transaksi, $tanggal);
		


		if (!$idTransaksi) {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan permintaan!</div>');
		}

		$data = [];
		foreach($listItem as $value) {
			$data[] = [
				'id_transaksi' => $idTransaksi,
				'id_tipe_barang' => $value['tipe_barang'],
				'jumlah' => $value['jumlah_barang']
			];
		}

		$insertStatusDetailTransaksi = $this->pengiriman->insertDetailTransaksi($data);
		$listUpdateStatus = [];

		foreach($data as $value) {
			$fifo = $this->pengiriman->getFifoBarang($value['id_tipe_barang'])[0];

			if($jumlah <= $fifo['jumlah']) {
				$jumlah = $fifo['jumlah'] - $jumlah;
				$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($fifo['id'], $jumlah);
				$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($fifo['id'], $jumlah);
				continue;
			} else {
				$remainder = $fifo['jumlah'] - $jumlah;
				$idFifo = $fifo['id'];
				
				while($remainder < 0) {
					$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($idFifo, 0);
					$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($idFifo, 0);
					$fifo = $this->pengiriman->getFifoBarang($value['id_tipe_barang'])[0];
					$remainder = $fifo['jumlah'] + $remainder;
					$idFifo = $fifo['id'];
				}

				$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($idFifo, $remainder);
				$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($idFifo, $remainder);
			}
		}
		

		$isSuccess = $insertStatusDetailTransaksi;
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil menambahkan permintaan!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal menambahkan permintaan!</div>');
		}
		redirect('pengiriman/pengiriman');
	}

	public function editTransaksi($id_transaksi){
		$pengiriman = $this->pengiriman->editTransaksi($id_transaksi);

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

		$this->load->view('pengiriman/edit_pengiriman', ['edit' => $data[0]]);
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
		$idTransaksi = $this->pengiriman->cariIdTransaksi($kode_transaksi)[0]['id'];
		foreach($listItem as $value) {
			$data[] = [
				'id_transaksi' => $idTransaksi,
				'id_tipe_barang' => $value['tipe_barang'],
				'jumlah' => $value['jumlah_barang']
			];
		}

		
		$deleteDetail = $this->pengiriman->deleteDetail($idTransaksi);

		$insertDetail = $this->pengiriman->insertDetailTransaksi($data);

		$listUpdateStatus = [];

		foreach($data as $value) {
			$fifo = $this->pengiriman->getFifoBarang($value['id_tipe_barang'])[0];

			if($jumlah <= $fifo['jumlah']) {
				$jumlah = $fifo['jumlah'] - $jumlah;
				$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($fifo['id'], $jumlah);
				$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($fifo['id'], $jumlah);
				continue;
			} else {
				$remainder = $fifo['jumlah'] - $jumlah;
				$idFifo = $fifo['id'];
				
				while($remainder < 0) {
					$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($idFifo, 0);
					$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($idFifo, 0);
					$fifo = $this->pengiriman->getFifoBarang($value['id_tipe_barang'])[0];
					$remainder = $fifo['jumlah'] + $remainder;
					$idFifo = $fifo['id'];
				}

				$listUpdateStatus[] = $this->pengiriman->updateBarangMasuk($idFifo, $remainder);
				$listUpdateStatus[] = $this->pengiriman->insertHistoryBarang($idFifo, $remainder);
			}
		}

		$isSuccess = $deleteDetail && $insertDetail && $listUpdateStatus;
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Berhasil memperbarui permintaan!</div>');
		} else {
			$this->session->set_flashdata('message', '<div> class="alert alert-warning" role="alert">Gagal memperbarui permintaan, silahkan coba lagi!</div>');
		}
		redirect('pengiriman/pengiriman/riwayat');
	}

	public function getAllJenisBarang() {
		$jenisBarang = $this->pengiriman->getAllJenisBarang();
		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'success',
			'data' => $jenisBarang
		]);
	}

	public function getBrandBarangByIdJenis($idJenis) {
		$brandBarang = $this->pengiriman->getBrandBarangByIdJenis($idJenis);
		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'success',
			'data' => $brandBarang
		]);
	}

	public function getTipeBarangByInfoBarang($idInfo) {
		$tipeBarang = $this->pengiriman->getTipeBarangByInfoBarang($idInfo);
		header('Content-Type: application/json');
		echo json_encode([
			'status' => 'success',
			'data' => $tipeBarang
		]);
	}

	public function terimaPermintaan($idTransaksi) {
		$isSuccess = $this->pengiriman->updateStatusPermintaan($idTransaksi, STATUS_DITERIMA);
		if ($isSuccess) {
			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Barang Diterima!</div>');
		} else {
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Gagal mengubah status!</div>');
		}
		redirect('pengiriman/pengiriman/riwayat');
	}
}

?>