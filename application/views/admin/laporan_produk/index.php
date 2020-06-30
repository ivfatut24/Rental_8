<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('admin/header');
?>
<script>
	// jika ada filter date nya
	start = moment.unix("<?= isset($filter_date_start) ? $filter_date_start : '\'\'' ?>");
	end = moment.unix("<?= isset($filter_date_end) ? $filter_date_end : '\'\'' ?>");
</script>
<div class="container-fluid p-0">
    <div class="row mb-5">
        <div class="col-lg-8 col-sm-8 col-12">
            <h1 class=" m-0 font-weight-light">Laporan Penyewaan</h1>
            <span class="text-black-80"> <?= count($data) ?> data</span>  
        </div>
        <div class="col-lg-4 col-sm-4 col-12 mt-3 mt-lg-0 text-lg-right text-sm-right">
            <div id="laporanRentang" class="ml-lg-2 mt-3 mt-lg-0 btn btn-icon-text p-2 bg-white rounded border">
                <i data-feather="calendar"></i>&nbsp;
                <span class="mx-2">Pilih Tanggal</span> <i data-feather="chevron-down"></i>
            </div>
        </div>
    </div>
	<?php
        // dd($data);
		foreach($data as $key => $value) :
	?>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                 <div class="col-8">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                        No. Booking
                    </div>
                    <div class="text-black-100">
                        #<?= $value->id_transaksi?>
                    </div>
                  
                        
                        </div>
                        <div class="col-lg-3">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                        Tgl Sewa
                    </div>
                    <div class="text-black-100">
                        <?= $value->tgl_sewa?>
                    </div>
                  
                        
                        </div>
                        <div class="col-lg-3">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                        Tgl Pengembalian
                    </div>
                    <div class="text-black-100">
                        <?= $value->tgl_pengembalian?>
                    </div>
                  
                        
                        </div>
                        <div class="col-lg-3">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                                Nama
                            </div>
                            <div class="text-black-100">
                            <?= $value->username?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                                Biaya Kirim
                            </div>
                            <div class="text-black-100">
                            <?= $value->biaya_pengiriman?>
                            </div>
                        </div>
                        
                        <!--  <div class="col-lg-6">
                            <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                                Denda
                            </div>
                            <div class="text-black-100">
                            <?= isset($value->denda) ? $value->total_denda : 0?>
                            </div>
                        </div>  -->
                    </div>
                </div>
                <div class="col-2">
                    <div class="float-right">
                        <div class="text-black-60 mb-1-4 font-size-tiny text-uppercase">
                            Total Sewa
                        </div>
                        <div class="text-black-100 font-weight-bold">
                            <?= idrFormat($value->total_harga) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
	<p><?= $links; ?></p>
</div>

<?php $this->load->view('admin/footer'); ?>
