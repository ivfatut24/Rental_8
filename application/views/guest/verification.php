<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('guest/header');
?>
<div class="width mx-auto mt-64 pt-4 min-vh-100">
    <!--== Verification Start ==-->
    <section id="gallery-page-content" class="section-padding pt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-no-shadow">
                        <div class="card-body p-4 text-center">
							<?php if($this->session->flashdata('success') !== null) : ?>
								<?= $this->session->flashdata('success') ?>
							<?php else : ?>
                            <h3 class="mb-4 text-center">
								<?= $this->session->flashdata('msg') ?>								
							</h3>
                            <!-- <h3 class="mb-4 text-center">Verifikasi</h3> -->
							<div class="row text-center">
								<div class="offset-lg-3 col-lg-6">
									<span class="fa fa-mobile-alt fa-5x"></span>
									<h5>Masukkan Kode Verifikasi</h5>
									<p>Kode verifikasi telah dikirimkan melalui SMS ke <br><strong>****-****-<?= @strlen($no_telp) > 5 ? substr($no_telp, strlen($no_telp) - 3) : '***' ?></strong></p>
									<hr>
									<div class="form-group offset-lg-3 col-lg-6">
										<form action="" method="post">
											<input type="text" class="form-control text-center" name="security_code" id="security-code" placeholder="Masukkan Kode Keamanan" aria-label="Kode Keamanan" minlength="5" maxlength="5" autocomplete="off" required>
											<br>
											<button class="col-lg-6 btn btn-primary">Kirim</button>
										</form>
									</div>
								</div>
							</div>
							<?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--== Verification End ==-->
</div>
<?php $this->load->view('guest/footer'); ?>
