const BASE_URL = 'http://localhost/si-stok'


$(document).ready(function () {
	let row = -1

	$('.btn-submit').attr('disabled', (row.length) ? false : true)

	if ($('#jenis-barang').length) {
		loadJenisBarang('#jenis-barang')
	}

	if ($('#jb-select').length) {
		loadJenisBarang('#jb-select')
	}
	
	if ($('#jb2-select').length) {
		loadJenisBarang('#jb2-select')
	}

	if ($('#jb3-select').length) {
		loadJenisBarang('#jb3-select')
	}

	$('#jenis-barang').change(function () {
		const id = $('#jenis-barang option:selected').val()
		loadBrandBarang(id, '#brand-barang')
	})

	$('#jb2-select').change(function () {
		const id = $('#jb2-select option:selected').val()
		loadBrandBarang(id, '#bb-select')
	})

	$('#jb3-select').change(function () {
		const id = $('#jb3-select option:selected').val()
		loadBrandBarang(id, '#bb2-select')
	})

	$('#brand-barang').change(function () {
		const id = $('#brand-barang option:checked').val()

		if (id == "") {
			$('#tipe-barang').empty()
			return
		}

		loadTipeBarang(id)
	})

	$('#bb2-select').change(function () {
		const id = $('#bb2-select option:checked').val()

		if (id == "") {
			$('#tb-select').empty()
			return
		}

		loadTipeBarang(id)
	})

	$('.input-barang').on('click', '.btn-add', function () {
		const idJenisBarang = $('#jenis-barang>option:selected').val()
		const jenisBarang = $('#jenis-barang>option:selected').text()
		const idTipeBarang = $('#tipe-barang>option:selected').val()
		const tipeBarang = $('#tipe-barang>option:selected').text()
		const idBrandBarang = $('#brand-barang>option:selected').val()
		const brandBarang = $('#brand-barang>option:selected').text()
		const jumlahBarang = parseInt($('#jumlah-barang').val())

		if (!Number.isInteger(jumlahBarang)) {
			return
		}

		// Append to table
		const tbody = $('table tbody')
		tbody.append(`
			<tr>
				<td>
					<input type="text" readonly class="form-control-plaintext text-center" value="${tbody.children().length + 1}">
				</td>
				<td>
					<input type="hidden" value="${idJenisBarang}" name="jenis_barang[]">
					<input type="text" readonly class="form-control-plaintext text-center" value="${jenisBarang}">
				</td>
				<td>
					<input type="hidden" value="${idBrandBarang}" name="brand_barang[]">
					<input type="text" readonly class="form-control-plaintext text-center" value="${brandBarang}">
				</td>
				<td>
					<input type="hidden" value="${idTipeBarang}" name="tipe_barang[]">
					<input type="text" readonly class="form-control-plaintext text-center" value="${tipeBarang}">
				</td>
				<td>
					<input type="text" readonly class="form-control-plaintext text-center" value="${jumlahBarang}" name="jumlah_barang[]">
				</td>
				<td>
					<button type="button" class="btn btn-warning btn-edit btn-block">Edit</button>
					<button type="button" class="btn btn-danger btn-delete btn-block">Delete</button>
				</td>
			</tr>
		`)

		$('.btn-submit').attr('disabled', (tbody.children().length) ? false : true)
		resetInput()
	})

	$('.input-barang').on('click', '.btn-change', function () {
		$('.btn-change')
			.removeClass('btn-warning btn-change')
			.addClass('btn-primary btn-add')
			.text("Tambah Barang")

		const idJenisBarang = $('#jenis-barang>option:selected').val()
		const jenisBarang = $('#jenis-barang>option:selected').text()
		const idTipeBarang = $('#tipe-barang>option:selected').val()
		const tipeBarang = $('#tipe-barang>option:selected').text()
		const idBrandBarang = $('#brand-barang>option:selected').val()
		const brandBarang = $('#brand-barang>option:selected').text()
		const jumlahBarang = parseInt($('#jumlah-barang').val())

		const td = $('table tbody').children().eq(row).children()
		td.eq(0).children().val(row + 1)
		td.eq(1).children().eq(0).val(idJenisBarang)
		td.eq(1).children().eq(1).val(jenisBarang)
		td.eq(2).children().eq(0).val(idBrandBarang)
		td.eq(2).children().eq(1).val(brandBarang)
		td.eq(3).children().eq(0).val(idTipeBarang)
		td.eq(3).children().eq(1).val(tipeBarang)
		td.eq(4).children().val(jumlahBarang)

		resetInput()
	})

	$('.input-barang').on('click', '.btn-cancel', function () {
		resetInput()
	})

	$('table').on('click', '.btn-delete', function () {
		$(this).parent().parent().remove()

		const row = $('tbody').children()
		for (let i = 0; i < row.length; i++) {
			row.eq(i).children().first().children().val(i + 1);
		}

		$('.btn-submit').attr('disabled', (row.length) ? false : true)
	})

	$('table').on('click', '.btn-edit', function () {
		$('html, body').animate({
			scrollTop: $("#form-permintaan").offset().top
		}, 500)

		const td = $(this).parent().siblings()
		row = td.parent().index()

		const jenisBarang = td.eq(1).children().eq(1).val()
		const tipeBarang = td.eq(2).children().eq(1).val()
		const brandBarang = td.eq(3).children().eq(1).val()
		const jumlahBarang = td.eq(4).children().val()

		$(`#jenis-barang>option:contains(${jenisBarang})`).prop('selected', true).trigger('change')
		setTimeout(() => {
			$(`#tipe-barang>option:contains(${tipeBarang})`).prop('selected', true).trigger('change')
		}, 150);
		setTimeout(() => {
			$(`#brand-barang>option:contains(${brandBarang})`).prop('selected', true).trigger('change')
		}, 200);
		$('#jumlah-barang').val(jumlahBarang)

		$('.btn-add')
			.removeClass('btn-primary btn-add')
			.addClass('btn-warning btn-change')
			.text("Edit Barang")
			.parent()
			.append('<button type="submit" class="btn btn-danger btn-cancel mr-3">Batal Edit</button>')
	})

	$('.table-riwayat').on('click', '.btn-detail', function() {
		const table = $(this).parent().siblings().eq(3).children()
		$('.modal-body').html(table.clone())
		$('#modal-detail').modal('show')
	})

	$('.table-riwayatgdg').on('click', '.btn-detail', function() {
		const table = $(this).parent().siblings().eq(3).children()
		$('.modal-body').html(table.clone())
		$('#modal-detail').modal('show')
	})

	$('.table-stok').on('click', '.btn-detail', function() {
		const table = $(this).parent().siblings().eq(5).children()
		$('.modal-body').html(table.clone())
		$('#modal-detail').modal('show')
	})

	$('.table-stok').DataTable({
		dom: 'Bftip',
		buttons: [{
				extend: 'excelHtml5',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 8]
				}
			},
			{
				extend: 'pdfHtml5',
				exportOptions: {
					columns: [0, 1, 2, 3, 4, 8]
				}
			}
		]
	});

	$('.table-riwayat').DataTable({
		dom: 'ftip',
		order: [1, 'desc']
	});

	$('.table-riwayatgdg').DataTable({
		dom: 'ftip',
		order: [1, 'desc']
	});

	$('#form-add').submit(function(e) {
		let kode = $('#kode-transaksi').val()
		let tgl = $('#tanggal').val()
		$(this).append(`<input type="hidden" value="${kode}" name="kode">`)
		$(this).append(`<input type="hidden" value="${tgl}" name="tgl">`)
	})

	if ($('#form-add table tbody').length) {
		$('.btn-submit').attr('disabled', false)
	}

	function resetInput() {
		row = -1
		$('.btn-change')
			.removeClass('btn-warning btn-change')
			.addClass('btn-primary btn-add')
			.text("Tambah Barang")
		$('.btn-cancel').remove()
		$('.input-barang form').trigger('reset')
		$('#jenis-barang').trigger('change')
	}
 
	function loadJenisBarang(idSelect) {
		$.ajax({
			url: `${BASE_URL}/pengiriman/pengiriman/getAllJenisBarang`,
			method: 'GET',
			success: function (result) {
				result.data.forEach(jenis => {
					$(idSelect).append(
						`<option value=${jenis.id}>${jenis.nama}</option>`
					)
				});

				$(idSelect).trigger('change')
			}
		})
	}

	function loadBrandBarang(idJenis, idSelect) {
		$.ajax({
			url: `${BASE_URL}/pengiriman/pengiriman/getBrandBarangByIdJenis/${idJenis}`,
			method: 'GET',
			success: function (result) {
				$(idSelect).empty()

				const idBrand = $('#brand-barang option:checked').val()
				if (idBrand == "") {
					$('#tipe-barang').empty()
				}

				result.data.forEach(brand => {
					$(idSelect).append(
						`<option value=${brand.id}>${brand.nama}</option>`
					)
				});

				$(idSelect).trigger('change')
			}
		})
	}

	function loadTipeBarang(idInfo) {
		$.ajax({
			url: `${BASE_URL}/pengiriman/pengiriman/getTipeBarangByInfoBarang/${idInfo}`,
			method: 'GET',
			success: function (result) {
				$('#tipe-barang').empty()
				$('#tb-select').empty()
				result.data.forEach(tipe => {
					$('#tipe-barang').append(
						`<option value=${tipe.id}>${tipe.tipe}</option>`
					)
					$('#tb-select').append(
						`<option value=${tipe.id}>${tipe.tipe}</option>`
					)
				});
			}
		})
	}
})
