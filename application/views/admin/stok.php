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
 
		<table class="table table-hover table-bordered text-center table-stok mt-3">
			<thead class="thead-dark">
				<th>No.</th>
				<th>Kode Barang</th>
				<th>Jenis Barang</th>
				<th>Brand Barang</th>
				<th>Tipe Barang</th>
				<th>Stok</th>
			</thead>
			<tbody>
				<?php foreach($stok as $index => $value): ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td><?= $value['kode_barang'] ?></td>
					<td><?= $value['jenis_barang'] ?></td>
					<td><?= $value['brand_barang'] ?></td>
					<td><?= $value['tipe_barang'] ?></td>
					<td><?= $value['stok'] ?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Detail Barang</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5>Detail Barang</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						
					</div>
				</div>
			</div>
		</div>
</div>
</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
