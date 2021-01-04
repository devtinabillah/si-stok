<?php 

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model('Login_model', 'login');
	}

	public function index() {
		if ($this->session->userdata('role')) {
			$this->redirectByRole($this->session->userdata('role'));
		}

		$this->load->view('login');
	}

	public function doLogin() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$response = $this->login->login($username, md5($password));

		if (empty($response)) {
			redirect('/');
		}

		$this->session->set_userdata([
			'id' => $response[0]['id'],
			'username' => $response[0]['username'],
			'role' => $response[0]['role'],
			'nama' => $response[0]['nama']
		]);

		$this->redirectByRole($response[0]['role']);
	}

	private function redirectByRole($role) {
		switch($role) {
			case ROLE_PENGIRIMAN:
				redirect('pengiriman/pengiriman');
				break;
			case ROLE_GUDANG:
				redirect('gudang/gudang');
				break;
			case ROLE_PEMBELIAN:
				redirect('pembelian/pembelian');
				break;
			case ROLE_ADMIN:
				redirect('admin/admin');
				break;
		}
	}
}

?>