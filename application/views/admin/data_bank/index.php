<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('admin/header');
?>
<div class="container-fluid p-0">
    <div class="row mb-3">
        <div class="col-lg-8 col-sm-8 col-12">
            <h1 class=" m-0 font-weight-light">Bank</h1>
            <span class="text-black-80"> <?= count($data)?> data</span>
        </div>
        <div class="col-lg-4 col-sm-4 col-12 mt-3 mt-lg-0 text-lg-right text-sm-right">
            <a href="<?php echo base_url('admin/bank/create/')?>" class="btn-icon-text btn btn-brand">
                <i data-feather="plus" class="align-middle"></i>
                <span class="ml-1 align-middle">Tambah Bank</span>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nama Bank</th>
                                    <th>Rekening</th>
                                    <th>Pemilik Rekening</th>
                                    <th>Gambar</th>
                                    <th width="50px" class="text-center nosort"></th>
                                </tr>
                            </thead>

                            </tbody>
                            <?php foreach ($data as $key => $value): ?>
                            <tr>
                                <td class="align-top">
                                    <div class="font-size-lg font-weight-bold">
                                        <?= $value->nama_bank ?>
                                    </div>
                                </td>
                                <td class="align-top">
                                    <div class="font-size-lg font-weight-bold">
                                        <?= $value->rekening ?>
                                    </div>
                                </td>
                                <td class="align-top">
                                    <div class="font-size-lg font-weight-bold">
                                        <?= $value->pemilik_rekening ?>
                                    </div>
                                </td>
                                <td class="align-top">
                                    <div class="font-size-lg font-weight-bold">
										<img src="<?= base_url('assets/uploads/bank/').$value->gambar ?>" alt="gambar bank <?php echo $value->nama_bank ?>" style="width:80px" class="img-thumbnail" />
                                    </div>
                                </td>
                                <td class="align-top text-center">
                                    <div class="dropdown show">
                                        <a href="#" data-toggle="dropdown" data-display="static" class="btn btn-outline-secondary btn-sm">
                                            <i class="align-middle" data-feather="more-horizontal"></i>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item d-flex align-items-center" 
                                            href="<?= base_url('admin/bank/update/'.$value->id_bank)?>"
                                            >
                                                <span data-feather="edit" class="mr-1"></span><span>Edit bank</span>
                                        </a>
                                            <a class="dropdown-item d-flex align-items-center text-danger btn-link" href="#"
                                            data-content="Yakin hapus <b><?= $value->nama_bank ?></b>?" data-cancel="tidak" data-confirm="Ya"
                                            data-link="<?= base_url('admin/bank/delete/'.$value->id_bank)?>"
                                            >
                                                <span data-feather="trash-2" class="mr-1"></span><span>Hapus</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>

                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->load->view('admin/footer'); ?>
