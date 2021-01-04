<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edit Barang Keluar</title>
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
		<?= $this->session->flashdata('message'); ?>
		<div class="row justify-content-center">
		<div class="col-auto">
		<div class="card my-3" id="form-permintaan" style="background-color: #00663d; width: 650px;">
			<div class="row my-1" style="color: white;">
				<div class="col-sm-8">
					<h5 class="card-header">Edit Transaksi</h5>
				</div>
			</div>
			<div class="card-body" style="background-color: #e6ffee">
				<div class="input-barang">
					<div class="form-group row">
						<label for="kode_transaksi" class="col-sm-4 col-form-label">Id Transaksi</label>
						<input type="text" id="kode-transaksi" name="kode_transaksi"
							value="<?= $edit['kode_transaksi'] ?>" readonly>
					</div>
					<div class="form-group row">
						<label for="tanggal" class="col-sm-4 col-form-label">Tanggal</label>
						<input type="date" name="tanggal" id="tanggal" value="<?= $edit['tanggal'] ?>">
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


		<form action="<?= base_url('pengiriman/pengiriman/updateTransaksi') ?>" method="POST" id="form-add">
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
				<?php $counter = 1; ?>
					<?php foreach ($edit['detail'] as $i => $v) : ?>
					<tr>
						<td>
							<input type="text" readonly class="form-control-plaintext text-center"
								value="<?= $counter ?>">
						</td>
						<td>
							<input type="hidden" value="<?= $v['id_jenis'] ?>" name="jenis_barang[]">
							<input type="text" readonly class="form-control-plaintext text-center"
								value="<?= $v['jenis'] ?>">
						</td>
						<td>
							<input type="hidden" value="<?= $v['id_brand'] ?>" name="brand_barang[]">
							<input type="text" readonly class="form-control-plaintext text-center"
								value="<?= $v['brand'] ?>">
						</td>
						<td>
							<input type="hidden" value="<?= $v['id_tipe'] ?>" name="tipe_barang[]">
							<input type="text" readonly class="form-control-plaintext text-center"
								value="<?= $v['tipe'] ?>">
						</td>
						<td>
							<input type="text" readonly class="form-control-plaintext text-center"
								value="<?= $v['jumlah'] ?>" name="jumlah_barang[]">
						</td>
						<td>
							<button type="button" class="btn btn-warning btn-edit btn-block">Edit</button>
							<button type="button" class="btn btn-danger btn-delete btn-block">Delete</button>
						</td>
					</tr>
					<?php $counter++; ?>
					<?php endforeach; ?>
				</tbody>
			</table>
			<button type="submit" class="btn btn-success btn-block btn-submit mb-3">Edit Permintaan</button>
		</form>
	</div>

	<?php $this->load->view('_partials/footer') ?>
</body>

</html>
