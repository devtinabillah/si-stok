<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stok Barang</title>
	<?php $this->load->view('_partials/header') ?>
</head>
<body>
	<?php $this->load->view('_partials/navbar/gudang') ?>

	<div class="container-fluid">
		<br>
		<br>
		<div class="row justify-content-center">
		<div class="col-auto">
		<div class="card mt-3 mx-10" style="width: 500px;">
			<div class="card">
				<h5 class="card-header" style="background-color: #00663d; color: white;">Tambah Tipe Barang</h5>
				<div class="card-body" style="background-color: #e6ffee">
					<form action="<?= base_url("gudang/gudang/updatetipe/") . $this->uri->segment(4); ?>" method="POST">
						<div class="form-group">
							<input type="hidden" class="form-control" name="id_tipe" value="<?= $edittipe['id_tipe'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="jenis">Jenis Barang</label>
							<input type="text" class="form-control" name="jenis" value="<?= $edittipe['jenis_barang'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="brand">Brand Barang</label>
							<input type="text" class="form-control" name="brand" value="<?= $edittipe['brand_barang'] ?>" readonly>
						</div>
						<div class="form-group">
							<label for="tipe-barang">Tipe Barang</label>
							<input type="text" class="form-control" name="tipe_barang" value="<?= $edittipe['tipe_barang'] ?>" required>
						</div>
						<button type="submit" class="btn btn-success btn-block">Edit</button>
					</form>
				</div>
			</div>
		</div></div></div>
	</div>

	<?php $this->load->view('_partials/footer') ?>
</body>
</html>