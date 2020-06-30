<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('customer/header');
?>
<div class="width mx-auto mt-64 pt-4 min-vh-100">

    <!--== Header Area End ==-->

    <!--== Breadcrumb Start ==-->
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('customer/dashboard') ?>">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </nav>
        </div>
    </div>
    <!--== Breadcrumb End ==-->
    <?php
        // dd($barang);
    ?>
    <!--== Gallery Page Content Start ==-->
    <section id="gallery-page-content" class="section-padding pt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="card card-no-shadow mb-4">
                        <div class="card-body">
                            <h3><?=$data->nama?></h3>
                            <div class="text-black-200 mb-lg-7 mb-4"><?=$data->email?></div>
                            <small class="text-muted">Mulai terdaftar sejak <?= idDateFormat(@$data->created_at, true) ?></small>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="card card-no-shadow">
                        <div class="card-body p-4">
                            <h5 class="mb-4">Edit Profil</h5>
							<form action="" method="post">
								<div class="row">
									<div class="col-lg-5 order-2 order-lg-1 my-3">
										<div class="bg-light p-4">
											<div class="text-black-300 pb-2">Username</div>
											<div class="text-black-300 pb-4"><?=$data->username?></div>
											<div class="text-black-300 pb-2">Password</div>
											<div class="text-black-300 pb-3">************</div>
											<hr class="mb-3">
											<div class="text-right">
												<button type="button" class="btn btn-link"  data-toggle="modal" data-target="#gantiAkunModal">Ubah</button>
											</div>
										</div>
									</div>
									<div class="offset-lg-1 col-lg-6 order-1 order-lg-2">
										<div class="form-group">
											<label class="input-label" for="userNama">Nama</label>
											<input type="text" class="form-control" name="nama" id="userNama" placeholder="Nama Lengkap" aria-label="Nama Lengkap" value="<?= @$data->nama ?>" required>
										</div>
										<div class="form-group">
											<label class="input-label" for="userAlamat">Alamat</label>
											<textarea class="form-control" name="alamat" id="userAlamat" placeholder="Alamat" aria-label="Alamat"><?= @$data->alamat ?></textarea>
										</div>
										<div class="form-group">
											<label class="input-label" for="userTelepon">No. Telpon</label>
											<div class="input-group">
												<div class="input-group-prepend">
													<span class="bg-white border-right-0 input-group-text">+62</span>
												</div>
												<input type="number" class="form-control" name="no_telp" id="userTelepon" value="<?= @$data->no_telp ?>" required>
											</div>
										</div>
										<div class="form-group">
											<label class="input-label" for="userEmail">Email</label>
											<input type="email" class="form-control" name="email" id="userEmail" placeholder="Email" value="<?= @$data->email ?>" aria-label="Email" required>
										</div>
										<div class="mt-6 text-right">
											<button class="btn btn-primary">Simpan</button>
										</div>
									</div>
								</div>
							</form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Gallery Page Content End ==-->
</div>
<!-- Modal -->
<div class="modal fade" id="gantiAkunModal" tabindex="-1" role="dialog" aria-labelledby="gantiAkunLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
		<form action="" method="post">
			<div class="modal-header">
				<h5 class="modal-title" id="gantiAkunLabel">Ubah</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label class="input-label" for="userName">Usename</label>
					<input type="text" class="form-control" name="username" id="userName" placeholder="Nama Lengkap" aria-label="Nama Lengkap" value="<?= @$data->username ?>" required>
				</div>
				<div class="form-group">
					<label class="input-label" for="userPassword">Password</label>
					<input type="password" class="form-control" name="password" id="userPassword" placeholder="*******" aria-label="*******" value="" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="reset" class="btn btn-secondary" data-dismiss="modal">Batal</button>
				<button type="submit" class="btn btn-primary">Simpan</button>
			</div>
		</form>
    </div>
  </div>
</div>
<?php $this->load->view('customer/footer'); ?>
