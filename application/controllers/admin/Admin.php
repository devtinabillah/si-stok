<?php 

class Admin extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('Admin_model', 'admin');
	}

	public function index() {
		$stok = $this->admin->getAllStok();

		foreach($stok as $index => $value) {
			$fifo = $this->admin->getFifoBarang($value['id_tipe']);
			$jumlah = array_sum(array_column($fifo, 'jumlah'));
			$stok[$index]['stok'] = $jumlah;
			$stok[$index]['fifo'] = $fifo;
		}

		$this->load->view('admin/stok', ['stok' => $stok]);

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
}

?>