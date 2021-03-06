<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Stok Barang</title>
	<?php $this->load->view('_partials/header') ?>
</head>

<body>

	<?php $this->load->view('_partials/navbar/gudang') ?>

	<div class="container-fluid">

	<div class="card mt-3" >
  <h5 class="card-header" style="background-color: #00663d; color: white;">Daftar Barang Keluar</h5>
  <div class="card-body" style="background-color: #e6ffee; padding-left: 50px; padding-right: 50px;">
    
		<table class="table table-hover table-bordered text-center table-riwayat mt-3">
			<thead class="thead-dark">
				<th>Id Transaksi</th>
				<th>Tanggal</th>
				<th>Status</th>
				<th>Aksi</th>
				<th hidden></th>
			</thead>
			<tbody>
				<?php foreach($permintaan as $value): ?>
				<tr>
					<td ><?= $value['kode_transaksi'] ?></td>
					<td><?= $value['tanggal'] ?></td>
					<td>
						<?php if($value['id_status'] != STATUS_DITERIMA): ?>
						<div class="alert alert-warning d-inline-flex" style="padding: 0.5rem;" role="alert">
							<?= $value['status'] ?>
						</div>
						<?php else: ?>
						<div class="alert alert-success d-inline-flex" style="padding: 0.5rem;" role="alert">
							<?= $value['status'] ?>
						</div>
						<?php endif; ?>
					</td>
					<td hidden>
						<table class="table table-hover text-center">
							<thead class="thead-dark">
								<th>No.</th>
								<th>Nama Barang</th>
								<th>Brand Barang</th>
								<th>Tipe Barang</th>
								<th>Jumlah Barang</th>
							</thead>
							<tbody>
								<?php $i = 0; ?>
								<?php foreach($value['detail'] as $v): ?>
								<tr>
									<td><?= $i + 1 ?></td>
									<td><?= $v['jenis'] ?></td>
									<td><?= $v['brand'] ?></td>
									<td><?= $v['tipe'] ?></td>
									<td><?= $v['jumlah'] ?></td>
								</tr>
								<?php $i++; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</td>
					<td>
						<button class="btn btn-light btn-detail">Detail</button>

						<?php if ($value['id_status'] == STATUS_DIAJUKAN): ?>
						<a href="<?= base_url("gudang/gudang/terimaPermintaan/$value[id_permintaan]") ?>" class="btn btn-success">Terima</a>
						<?php elseif ($value['id_status'] == STATUS_DIPROSES): ?>
						<a href="<?= base_url("gudang/gudang/kirimPermintaan/$value[id_permintaan]") ?>" class="btn btn-primary">Kirim</a>
						<?php endif; ?>
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
</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
