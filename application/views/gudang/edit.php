<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stok Barang</title>
	<?php $this->load->view('_partials/header') ?>
	<style>
		input[type='number'] {
			-moz-appearance: textfield;
		}

		input::-webkit-outer-spin-button,
		input::-webkit-inner-spin-button {
			-webkit-appearance: none;
		}

	</style>
</head>

<body>

	<?php $this->load->view('_partials/navbar/gudang') ?>

	<div class="container-fluid">
	<?= $this->session->flashdata('message'); ?>
		<div class="row mt-3">
			<div class="col">
				<div class="card">
					<h5 class="card-header" style="background-color: #00663d; color: white;">Edit Jenis Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/editjenis/")?>" method="POST">
							<div class="form-group">
								<label for="jb-select">Jenis Barang</label>
								<select class="form-control" id="jb-select" name="jenis_barang" required>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Edit Jenis Barang</button>
							<button type="submit" formaction="<?= base_url("gudang/gudang/hapusjenis/") ?>" class="btn btn-danger btn-block">Hapus Jenis Barang</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<h5 class="card-header" style="background-color: #00663d; color: white;">Edit Brand Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/editbrand/") ?>" method="POST">
							<div class="form-group">
								<label for="jb2-select">Jenis Barang</label>
								<select class="form-control" id="jb2-select" name="jenis_barang" required>
								</select>
							</div>
							<div class="form-group">
								<label for="bb-select">Brand Barang</label>
								<select class="form-control" id="bb-select" name="brand_barang" required>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Edit Brand Barang</button>
							<button type="submit" formaction="<?= base_url("gudang/gudang/hapusbrand/") ?>" class="btn btn-danger btn-block">Hapus Brand Barang</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<h5 class="card-header" style="background-color: #00663d; color: white;">Edit Tipe Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/edittipe/") ?>" method="POST">
							<div class="form-group">
								<label for="jb3-select">Jenis Barang</label>
								<select class="form-control" id="jb3-select" name="jenis_barang" required>
								</select>
							</div>
							<div class="form-group">
								<label for="bb2-select">Brand Barang</label>
								<select class="form-control" id="bb2-select" name="brand_barang" required>
								</select>
							</div>
							<div class="form-group">
								<label for="tb-select">Tipe Barang</label>
								<select class="form-control" id="tb-select" name="tipe_barang" required>
								</select>
							</div>
							<button type="submit" class="btn btn-primary btn-block">Edit Tipe Barang</button>
							<button type="submit" formaction="<?= base_url("gudang/gudang/hapustipe/") ?>" class="btn btn-danger btn-block">Hapus Tipe Barang</button> 
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
