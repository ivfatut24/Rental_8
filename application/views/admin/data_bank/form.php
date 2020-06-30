<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<div class="container px-0 px-lg-3">
    <div class="mb-3">
		<a href="<?= base_url('admin/bank/')?>" class="btn btn-secondary btn-icon-text">
			<i data-feather="arrow-left" class="mr-1"></i>
			<span>Kembali</span>
		</a>
		<div class="float-right">
			<h4 class="m-0 text-black-60 font-weight-normal border-right pr-2" style="border-width:4px!important;"><?php if (isset($data)): ?>Edit<?php else: ?>Tambah<?php endif; ?> Bank</h4>
		</div>
    </div>
	<div class="card">
		<div class="card-body">
		<?= form_open_multipart(isset($data)?'admin/bank/update/'.$data->id_bank:'admin/bank/create'); ?> 

		<?= validation_errors(); ?>
		<?php if (isset($data)): ?>
			<input type="hidden" name="id_bank" value="<?= $data->id_bank; ?>">
		<?php endif ?>
			<div class="form-group row">
				<label class="col-form-label text-sm-right col-sm-2">Nama Bank</label>
				<div class="col-sm-10">
					<input name="nama_bank" type="text" id="nama_bank" class="form-control" placeholder="Nama Bank" required value="<?= isset($data)?$data->nama_bank:''; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label text-sm-right col-sm-2">Rekening</label>
				<div class="col-sm-10">
					<input name="rekening" type="text" id="rekening" class="form-control" placeholder="Rekening" required value="<?= isset($data)?$data->rekening:''; ?>" />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-form-label text-sm-right col-sm-2">Nama Pemilik Rekening</label>
				<div class="col-sm-10">
					<input name="pemilik_rekening" type="text" id="pemilik_rekening" class="form-control" placeholder="Pemilik Rekening" required value="<?= isset($data)?$data->pemilik_rekening:''; ?>" />
				</div>
			</div>
			<?php if (isset($data)): ?>
				<div class="form-group row">
					<label class="col-sm-2 text-sm-right col-form-label">Gambar Sebelumnya</label>
					<div class="col-sm-10">
						<img class="img-thumbnail" src="<?= base_url('assets/uploads/bank/'.$data->gambar)?>" style="width: 100px;height: 100px">
					</div>
				</div>
			<?php endif ?>
			<div class="form-group row mt-3">
				<label class="col-sm-2 col-form-label text-sm-right">Gambar Bank</label>
				<div class="col-sm-10">
					<input name="gambar" type="file" class="form-control"/>
				</div>
			</div>
			<div class="form-group row mt-lg-5 mt-4">
				<div class="col-sm-10 ml-sm-auto">
					<input type="submit" name="input" value="Simpan" class="btn btn-primary" />&nbsp;
					<a href="<?= base_url('admin/bank')?>" class="btn btn-secondary">Batal </a>
				</div>
			</div>
		<?= form_close(); ?>
		</div>
	</div>
</div>
<?php $this->load->view('admin/footer'); ?>
