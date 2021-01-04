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

	<?php $this->load->view('_partials/navbar/pembelian') ?>

	<div class="container-fluid">
	<div class="card mt-3" >
  <h5 class="card-header" style="background-color: #00663d; color: white;">Persediaan Barang</h5>
  <div class="card-body" style="background-color: #e6ffee; padding-left: 50px; padding-right: 50px;">
		<table class="table table-hover text-center table-stok mt-3">
			<thead class="thead-dark">
				<th>No.</th>
				<th>Jenis Barang</th>
				<th>Brand Barang</th>
				<th>Tipe Barang</th>
				<th>Limit</th>
				<th>Stok</th>
				<th hidden></th>
			</thead>
			<tbody>
				<?php foreach($stok as $index => $value): ?>
				<tr>
					<td><?= $index + 1 ?></td>
					<td><?= $value['jenis_barang'] ?></td>
					<td><?= $value['brand_barang'] ?></td>
					<td><?= $value['tipe_barang'] ?></td>
					<td>5</td>
					<td><?= $value['stok'] ?></td>
					<td hidden>
						<table class="table table-hover text-center mt-3">
							<thead class="thead-dark">
								<th>No.</th>
								<th>Kode FIFO</th>
								<th>Jumlah</th>
							</thead>
							<tbody>
								<?php foreach($value['fifo'] as $i => $v): ?>
									<tr>
										<td><?= $i + 1 ?></td>
										<td><?= $v['id_fifo'] ?></td>
										<td><?= $v['jumlah'] ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>

		<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
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

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
