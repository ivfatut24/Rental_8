<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('maintenance/header');
?>
<script>
	// jika ada filter date nya
	start = moment.unix("<?= isset($filter_date_start) ? $filter_date_start : '\'\'' ?>");
	end = moment.unix("<?= isset($filter_date_end) ? $filter_date_end : '\'\'' ?>");
</script>
<div class="container-fluid p-0">
	<div class="row">
		<div class="col-lg-8 col-sm-8 col-12 d-lg-flex">
			<h1 class=" m-0 font-weight-light">Laporan barang masuk</h1>
		</div>
		<div class="col-lg-4 col-sm-4 col-12 mt-3 mt-lg-0 text-lg-right text-sm-right">
			<div id="laporanRentang" class="ml-lg-2 mt-3 mt-lg-0 btn btn-icon-text p-2 bg-white rounded border">
				<i data-feather="calendar"></i>&nbsp;
				<span class="mx-2">Pilih Tanggal</span> <i data-feather="chevron-down"></i>
			</div>			
		</div>
	</div>
	<div class="row mb-5">
		<div class="col-12">
			<span class="text-black-80"> <?= count($data) ?> data</span>
		</div>
	</div>
	<?php foreach($data as $key => $value): ?>
	<div class="card mb-4">
		<div class="card-body">
			<div class="row">
				<div class="col-6">
					<div class="row">
						<div class="col-auto">
							<img src="<?= base_url('assets/uploads/produk/').$value->gambar_barang ?>" alt="gambar produk" style="width:80px" class="img-thumbnail" />
						</div>
						<div class="col-auto">
							<h4 class="m-0">
								<?= $value->nama_barang ?>
							</h4>
							<div class="mt-2">
								<span class="text-black-60">Ukuran:</span>
								<span class="text-black-80 ml-1 font-weight-bold text-uppercase"><?= $value->ukuran ?></span>
							</div>
							<div class="mt-2">
								<span class="text-black-60"><?= idDateFormat($value->finished_at, true) ?></span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-6">
					<div class="row">
						<div class="col-lg-5">
							<div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
								Keterangan
							</div>
							<div class="text-black-80">
								<?= $value->keterangan_kondisi ? $value->keterangan_kondisi : 'Baik' ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php endforeach; ?>
	<p><?= $links; ?></p>
</div>
<?php $this->load->view('maintenance/footer'); ?>

