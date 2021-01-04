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

	<?php $this->load->view('_partials/navbar/admin') ?>

	<div class="container-fluid">
		<div class="card mt-3" >
  <h5 class="card-header" style="background-color: #00663d; color: white;">Persediaan Barang</h5>
  <div class="card-body" style="background-color: #e6ffee; padding-left: 50px; padding-right: 50px;">
  	<a href="<?= base_url('admin/admin/inputbarang');?>" class="btn btn-primary mb-3" style="float: right;"> Tambah Barang</a>
		<table class="table table-hover table-bordered text-center table-stok mt-3">
			<thead class="thead-dark">
				<th>No.</th>
				<th>Jenis Barang</th>
				<th>Detail Brand</th>
				<th>Delete</th>
			</thead>
			<tbody>
				<?php foreach($stok as $index => $value): ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td><?= $value['kode_barang'] ?></td>
					<td><?= $value['jenis_barang'] ?></td>
					<td><?= $value['jenis_barang'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

</div>
</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>




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
		<div class="card mt-3 mx-3" >
			<div class="card">
				<h5 class="card-header" style="background-color: #00663d; color: white;">Tambah Tipe Barang</h5>
				<div class="card-body" style="background-color: #e6ffee">
					 	<a href="<?= base_url('admin/admin/inputbarang');?>" class="btn btn-primary mb-3" style="float: right;"> Tambah Barang</a>
					<table class="table table-hover table-bordered text-center table-stok mt-3">
			<thead class="thead-dark">
				<th>No.</th>
				<th>Jenis Barang</th>
				<th>Detail Brand</th>
				<th>Delete</th>
			</thead>
			<tbody>
				<?php foreach($stok as $index => $value): ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td><?= $value['kode_barang'] ?></td>
					<td><?= $value['jenis_barang'] ?></td>
					<td><?= $value['jenis_barang'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>


				</div>
			</div>
		</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>
</body>
</html>