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
			<div class="card-body" style="background-color: #e6ffee; padding: 250px 50px;">
				<center>
				<a href="<?= base_url('gudang/gudang/inputbarang');?>" class="btn btn-primary mb-3" style="height: 100px; width: 250px; text-align: center; margin: auto;"> Tambah Data Barang</a>
				<a href="<?= base_url('gudang/gudang/editdatabarang');?>" class="btn btn-success mb-3" style="height: 100px; width: 250px;"> Edit Data Barang</a>
				</center>
			</div>
		</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
