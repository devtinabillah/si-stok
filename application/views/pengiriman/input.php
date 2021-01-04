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

	<?php $this->load->view('_partials/navbar/pengiriman') ?>

	<div class="container-fluid">
	
	<div class="row justify-content-center">
		<div class="col-auto">
		<div class="card my-3" id="form-permintaan" style="background-color: #00663d; width: 650px;">
		
				<div class="row my-1" style="color: white;">
					<div class="col-sm-8">
						<h5 class="card-header">Input Permintaan Barang Keluar</h5>
					</div>
					<div class="col-sm-4">
						<p class="text-right" style="padding-right: 20px;"><?= date("d/m/Y") ?></p>
					</div>
				</div>
				<div class="card-body" style="background-color: #e6ffee">
				<?= $this->session->flashdata('message'); ?>
				<div class="input-barang">
						<div class="form-group row">
							<label for="kode_transaksi" class="col-sm-4 col-form-label">Id Transaksi</label>
							<input type="text" id="kode-transaksi" name="kode_transaksi" value="<?= $kode_transaksi; ?>" readonly>
						</div>
						<div class="form-group row">
							<label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
							<input type="date" name="tanggal" id="tanggal" value="<?php echo date('Y-m-d'); ?>">
						</div>
						<form>
						<div class="card my-1" style="background-color: #e6ffee">
							<div class="card-header">
								<b>Barang Permintaan</b>
							</div>
							<div class="card-body">
						<div class="form-group row">
							<label for="jenis-barang" class="col-sm-4 col-form-label">Jenis Barang</label>
							<div class="col-sm-8">
								<select class="form-control" id="jenis-barang" required>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="brand-barang" class="col-sm-4 col-form-label">Brand Barang</label>
							<div class="col-sm-8">
								<select class="form-control" id="brand-barang" required>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="tipe-barang" class="col-sm-4 col-form-label">Tipe Barang</label>
							<div class="col-sm-8">
								<select class="form-control" id="tipe-barang" required>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<label for="jumlah-barang" class="col-sm-4 col-form-label">Jumlah Barang</label>
							<div class="col-sm-8">
								<input type="number" min="1" class="form-control" id="jumlah-barang" required>
							</div>
						</div>
						<div class="d-flex flex-row-reverse">
							<button type="submit" class="btn btn-success btn-add">Tambah Barang</button>
						</div>
						</div>
						</div>
					</form>
				</div>
			</div>
			</div>
		</div>
		</div>

		<form action="<?= base_url('pengiriman/pengiriman/tambahPermintaan') ?>" method="POST" id="form-add">
			<table class="table table-hover text-center">
				<thead class="thead-dark">
					<th>No.</th>
					<th>Nama Barang</th>
					<th>Brand Barang</th>
					<th>Tipe Barang</th>
					<th>Jumlah Barang</th>
					<th>Aksi</th>
				</thead>
				<tbody>
				</tbody>
			</table>
			<button type="submit" class="btn btn-success btn-block btn-submit mb-3">Buat Permintaan</button>
		</form>
	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
