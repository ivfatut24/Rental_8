<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('customer/header');
?>
<div class="width mx-auto mt-64 pt-4 min-vh-md-100">

    <!--== Header Area End ==-->

    
	
     <!--== Page Title Area Start ==-->
    <div class="px-xl-0 px-3 d-lg-flex justify-content-between">
        <h2 class="text-uppercase">Produk</h2>
        
        <form method="POST" action="" role="search">
            <div class="search-input-group mt-5 mt-lg-0" aria-expanded="true">
                <input type="text" name="search" class="search-input-group__input"
                    placeholder="Cari produk" value="<?= @$search ?>">
                <button type="submit" class="search-input-group__btn" value="Search" aria-label="Search">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </form>
    </div>
    <!--== Page Title Area End ==-->
    <!--== Gallery Page Content Start ==-->
    <section id="gallery-page-content" class="section-padding ">
        <div class="container p-0">
			<div class="popular-cars-wrap">
				<!-- Filtering Menu -->
				<div class="popucar-menu text-center">
					<a href="#" data-filter="*" class="active">all</a>
					<?php foreach ($list_kategori as $key => $barang) : ?>
                    <a href="#" data-filter=".<?= strtolower($barang->nama_kategori_produk) ?>"><?= $barang->nama_kategori_produk ?></a>
                    <?php endforeach ?>
				</div>
				<!-- Filtering Menu -->

		
				<div class="row popular-car-gird">
					<?php
						// dd($list_barang);
						foreach ($list_barang as $key => $barang) :
					?>
					<div class="col-lg-3 col-md-4 <?= strtolower($barang->nama_kategori_produk) ?>">
                        <div class="product-item">
                            <a href="<?php echo base_url("customer/produk/".$barang->id_barang) ?>" class="stretched-link"></a>
                            <img src="<?php echo base_url('assets/uploads/produk/'.$barang->gambar_barang) ?>">
                            <div class="product-title text-truncate" title="<?= $barang->nama_barang ?>"><?= $barang->nama_barang ?></div>
                            <div class="product-price">Rp <?= number_format($barang->harga_sewa, 0, ',', '.') ?>/per Hari</div>
                        </div>
                    </div>
					<?php endforeach ?>
				</div>
			</div>
        </div>
    </section>
    <!--== Gallery Page Content End ==-->
</div>   
<?php $this->load->view('customer/footer'); ?>
