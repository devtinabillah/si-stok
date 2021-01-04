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
<div class="row justify-content-center">
		<div class="col-auto">
		<div class="card mt-3" style="width: 700px;">
			<h5 class="card-header" style="background-color: #00663d; color: white;">Laporan Transaksi</h5>
			<div class="card-body" style="background-color: #e6ffee; padding-left: 50px; padding-right: 50px;">
				<form action="<?= base_url("gudang/gudang/lap_masuk") ?>" method="GET">
					<div class="form-group row">
						<div style="width: 200px;">
							<label for="bulan">Bulan</label>
							<select class="form-control" name="bulan">
								<option value=0 <?= ($this->input->get('bulan') == 0)  ? "selected" : ""; ?>>- NONE -</option>
								<option value="01" <?= ($this->input->get('bulan') == '01')  ? "selected" : ""; ?>>Januari</option>
								<option value="02" <?= ($this->input->get('bulan') == '02')  ? "selected" : ""; ?>>Februari</option>
								<option value="03" <?= ($this->input->get('bulan') == '03')  ? "selected" : ""; ?>>Maret</option>
								<option value="04" <?= ($this->input->get('bulan') == '04')  ? "selected" : ""; ?>>April</option>
								<option value="05" <?= ($this->input->get('bulan') == '05')  ? "selected" : ""; ?>>Mei</option>
								<option value="06" <?= ($this->input->get('bulan') == '06')  ? "selected" : ""; ?>>Juni</option>
								<option value="07" <?= ($this->input->get('bulan') == '07')  ? "selected" : ""; ?>>Juli</option>
								<option value="08" <?= ($this->input->get('bulan') == '08')  ? "selected" : ""; ?>>Agustus</option>
								<option value="09" <?= ($this->input->get('bulan') == '09')  ? "selected" : ""; ?>>September</option>
								<option value="10" <?= ($this->input->get('bulan') == '10')  ? "selected" : ""; ?>>Oktober</option>
								<option value="11" <?= ($this->input->get('bulan') == '11')  ? "selected" : ""; ?>>November</option>
								<option value="12" <?= ($this->input->get('bulan') == '12')  ? "selected" : ""; ?>>Desember</option>
							</select>
						</div>
						<div style="width: 25px;">

						</div>
						<div style="width: 200px;">
							<label for="tahun">Tahun</label>
							<select class="form-control" name="tahun">
								<option value=0>- NONE -</option>
								<?php for ($i = 2015; $i <= 2020; $i++) : ?>
									<option value="<?= $i ?>" <?= ($this->input->get('tahun') == $i)  ? "selected" : ""; ?>><?= $i ?></option>
								<?php endfor; ?>
							</select>
						</div>
						<div class="col" >
							<br>
							<button type="submit" class="btn btn-success" style="width: 75px; height: 50px; padding-top: 10px;">Cari</button>
						</div>
					</div>
				</form>

				<h5>Jumlah Transaksi Barang Masuk = <?= $lap_masuk ?></h5>
				<h5>Jumlah Transaksi Barang Keluar  = <?= $lap_keluar ?></h5>

			</div>
		</div>
	</div>
</div>
	</div>

	<?php $this->load->view('_partials/footer') ?>

</body>

</html>
