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
					<h5 class="card-header" style="background-color: #00663d; color: white;">Tambah Jenis Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/insertJenisBarang") ?>" method="POST">
							<div class="form-group">
								<label for="jenis-barang">Jenis Barang</label>
								<input type="text" class="form-control" id="jenis-barang" name="jenis_barang" required>
							</div>
							<button type="submit" class="btn btn-success btn-block">Tambah</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<h5 class="card-header" style="background-color: #00663d; color: white;">Tambah Brand Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/insertBrandBarang") ?>" method="POST">
							<div class="form-group">
								<label for="jb-select">Jenis Barang</label>
								<select class="form-control" id="jb-select" name="jenis_barang" required>
								</select>
							</div>
							<div class="form-group">
								<label for="brand-barang">Brand Barang</label>
								<input type="text" class="form-control" id="brand-barang" name="brand_barang" required>
							</div>
							<button type="submit" class="btn btn-success btn-block">Tambah</button>
						</form>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<h5 class="card-header" style="background-color: #00663d; color: white;">Tambah Tipe Barang</h5>
					<div class="card-body" style="background-color: #e6ffee">
						<form action="<?= base_url("gudang/gudang/insertTipeBarang") ?>" method="POST">
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
							<div class="form-group">
								<label for="tipe-barang">Tipe Barang</label>
								<input type="text" class="form-control" id="tipe-barang" name="tipe_barang" required>
							</div>
							<div class="form-group">
								<input type="number" value="5" class="form-control" id="limit-stok" name="limit_stok" required hidden>
							</div>
							<button type="submit" class="btn btn-success btn-block">Tambah</button>
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
