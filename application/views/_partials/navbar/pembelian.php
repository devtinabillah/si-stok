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
			<li class="nav-item <?= $this->uri->segment(3) == 'stok' ? 'active' : '' ?>">
				<h6><a class="nav-link" href="<?= base_url('pembelian/pembelian') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Persediaan Barang</a></h6>
			</li>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == 'inputPengiriman' ? 'active' : '' ?>">
				<h6><a class="nav-link" href="<?= base_url('pembelian/pembelian/inputPengiriman') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Input Pengiriman Barang Masuk</a></h6>
			</li>
			<li class="nav-item <?= $this->uri->segment(3) == 'daftarPengiriman' ? 'active' : '' ?>">
				<h6><a class="nav-link" href="<?= base_url('pembelian/pembelian/daftarPengiriman') ?>" style="color: white; padding-top: 25px; padding-right: 30px;">Daftar Pengiriman Barang Masuk</a></h6>
			</li>
			
		</ul>
		<a href="<?= base_url('logout') ?>" class="btn btn-dark" style="color: white;">Logout</a>
	</div>
</nav>
