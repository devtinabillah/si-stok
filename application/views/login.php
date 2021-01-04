<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stok Barang</title>
	<?php $this->load->view('_partials/header') ?>
	<style>
		html, body {
			height: 100%;
		}
	</style>
</head>

<body style="background-color: #e6ffee">

	<div class="container-fluid h-100">
		<div class="d-flex justify-content-center h-100">
			<div>
			<img src="<?= base_url('assets/image/logoSamping.png') ?>" style="width: 800px; padding-top: 80px">
			<div class="card mx-auto mt-4" style="width: 400px;">

				<div class="card-header" style="background-color: #00663d; color: white;">
				<h5>Silahkan Login</h5>
				</div>
				<div class="card-body" style="background-color: #00663d; color: white">
					
					<form action="<?= base_url('login/doLogin') ?>" method="POST">
						<div class="form-group">
							<label for="username">Username</label>
							<input type="text" class="form-control" name="username" id="username">
						</div>
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" class="form-control" name="password" id="password">
						</div>
						<button type="submit" class="btn btn-primary btn-block">Login</button>
					</form>
				</div>
			</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>
</body>

</html>
