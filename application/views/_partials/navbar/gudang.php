<nav class="navbar navbar-expand-lg navbar-light bg-success" style="height: 75px;">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
		aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarNav">
		<ul class="navbar-nav mr-auto">
			<li>
				<a class="nav-link" href="#" style="width: 290px"><img src="<?= base_url('assets/image/logoSamping.png') ?>" width="250px" height="60px"></a>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == NULL ? 'active' : '' ?>">
				<a class="nav-link font-weight-bolder" href="<?= base_url('gudang/gudang') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Daftar Barang Keluar</a>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == 'pengiriman' ? 'active' : '' ?>">
				<a class="nav-link font-weight-bolder" href="<?= base_url('gudang/gudang/pengiriman') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Daftar Barang Masuk</a>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == 'stok' ? 'active' : '' ?>">
				<a class="nav-link font-weight-bolder" href="<?= base_url('gudang/gudang/stok') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Persediaan Barang</a>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == 'stok' ? 'active' : '' ?>">
				<a class="nav-link font-weight-bolder" href="<?= base_url('gudang/gudang/lap_masuk') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Laporan Transaksi</a>
			</li>
			<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle font-weight-bolder" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white; padding-top: 25px; padding-right: 30px;">Data Produk</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item text-dark" href="<?= base_url('gudang/gudang/inputbarang');?>">Tambah Data Produk</a>
						<a class="dropdown-item text-dark" href="<?= base_url('gudang/gudang/editdatabarang');?>">Edit Data Produk</a>
				</div>
			</li>
		</ul>
		<a href="<?= base_url('logout') ?>" class="btn btn-dark">Logout</a>
	</div>
</nav>
