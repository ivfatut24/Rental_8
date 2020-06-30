<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/adminltew/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/cardoor/css/jquery-confirm.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminltew/css/daterangepicker.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminltew/css/simplebar.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminltew/css/grid.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/adminltew/css/style.css') ?>">
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/jquery-3.4.1.slim.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/apexcharts.js') ?>"></script>

	<script type="text/javascript" src="<?php echo base_url('assets/cardoor/js/jquery-3.2.1.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/feather.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/simplebar.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/bootstrap.bundle.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/jquery.dataTables.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/datatable-theme.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/moment.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/moment-with-locales.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/adminltew/js/daterangepicker.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('assets/cardoor/js/jquery-confirm.min.js') ?>"></script>
    <script>
        // date helper
        const indoDateFormat = function(params) {
            var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
            var date = new Date(params);
            return ((date.getDate() > 9) ? date.getDate() : ('0' + date.getDate())) + ' ' + months[date.getMonth()] + ' ' + date.getFullYear();
        }

        const indoCurrencyFormat = function(params) {
            return params.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }
    </script>
	<script>
		var start	= 0;
		var end		= 0;
	</script>
    <noscript>
        <style>
            .simplebar-content-wrapper {
            overflow: auto;
            }
        </style>
    </noscript>
</head>
<body>
    <div class="wrapper">
        <nav id="sidebar" class="sidebar sidebar-sticky">
            <div class="sidebar-content js-simplebar">
                <a class="sidebar-brand" href="<?php echo base_url('admin') ?>">
                    <span class="align-middle logo">Administrator</span>
                </a>

                <ul class="sidebar-nav">
                    <li <?= $this->session->flashdata('menu')=="dashboard"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href="<?php echo base_url('admin') ?>" class="sidebar-link">
                            <i class="align-middle" data-feather="grid"></i> <span
                                class="align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Kelola
                    </li>
					<li <?= $this->session->flashdata('menu')=="kelola-pemesanan"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/kelola/pemesanan"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="shopping-bag"></i>
							<span class="align-middle">Pemesanan</span>
                        </a>
					</li>
					<li <?= $this->session->flashdata('menu')=="kelola-pembayaran"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/kelola/pembayaran"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="credit-card"></i>
							<span class="align-middle">Pembayaran</span>
                        </a>
					</li>
					<li <?= $this->session->flashdata('menu')=="kelola-pengembalian"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/kelola/pengembalian"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="box"></i>
							<span class="align-middle">Pengembalian</span>
                        </a>
					</li>

                    <li class="sidebar-header">
                         Laporan
                    </li>
                    <li <?= $this->session->flashdata('menu')=="laporan-produk"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href="<?= base_url('admin/laporan/produk'); ?>" class="sidebar-link">
							<i class="align-middle" data-feather="bar-chart-2"></i>
							<span class="align-middle">Laporan Penyewaan</span>
                        </a>
					</li>
                    <li <?= $this->session->flashdata('menu')=="laporan-customer"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href="<?= base_url('admin/laporan/customer'); ?>" class="sidebar-link">
                            <i class="align-middle" data-feather="bar-chart"></i>
                            <span class="align-middle">Laporan Pengunjung</span>
                        </a>
                    </li>
                     <li <?= $this->session->flashdata('menu')=="laporan-barangkeluar"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href="<?= base_url('admin/laporan/barangkeluar'); ?>" class="sidebar-link">
                            <i class="align-middle" data-feather="bar-chart"></i>
                            <span class="align-middle">Laporan Barang Keluar</span>
                        </a>
                    </li>

 <li <?= $this->session->flashdata('menu')=="laporan-barangmasuk"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href="<?= base_url('admin/laporan/barangmasuk'); ?>" class="sidebar-link">
                            <i class="align-middle" data-feather="bar-chart"></i>
                            <span class="align-middle">Laporan Barang Masuk</span>
                        </a>
                    </li>
                    <li class="sidebar-header">
                        Master Data
                    </li>
                <!--     <li <?php echo $this->session->flashdata('menu')=="data-kategoriproduk"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/produk/kategori"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="box"></i> 
							<span class="align-middle">Kategori Produk</span>
                        </a>
					</li>
                    <li <?php echo $this->session->flashdata('menu')=="data-tujuan"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/tujuan"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="list"></i> 
							<span class="align-middle">Tujuan</span>
                        </a>
					</li>
                    <li <?php echo $this->session->flashdata('menu')=="data-bank"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/bank"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="briefcase"></i> 
							<span class="align-middle">Bank</span>
                        </a>
					</li> -->
                     <li <?php echo $this->session->flashdata('menu')=="data-produk"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
                        <a href='<?php echo base_url("admin/produk"); ?>' class="sidebar-link">
                            <i class="align-middle" data-feather="briefcase"></i> 
                            <span class="align-middle">Produk</span>
                        </a>
                    </li>
					<li <?= $this->session->flashdata('menu')=="data-customer"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/customer"); ?>' class="sidebar-link">
							<i class="align-middle" data-feather="users"></i> 
							<span class="align-middle">Customer</span>
                        </a>
					</li>
					<li <?= $this->session->flashdata('menu')=="data-admin"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/admin"); ?>' class="sidebar-link">
                            <i class="align-middle" data-feather="user-plus"></i>
							<span class="align-middle">Admin</span>
                        </a>
                    </li>
					<li <?= $this->session->flashdata('menu')=="data-maintenance"?"class=\"sidebar-item active\"":"class=\"sidebar-item\"" ?>>
						<a href='<?php echo base_url("admin/maintenance"); ?>' class="sidebar-link">
                            <i class="align-middle" data-feather="user-check"></i>
							<span class="align-middle">Maintenance</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
		<div class="main">
            <nav class="navbar navbar-expand navbar-light bg-white sticky-top">
                <a class="sidebar-toggle d-flex mr-2">
                    <i class="hamburger align-self-center"></i>
                </a>

                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#"
                                data-toggle="dropdown">
                                <i class="align-middle" data-feather="user"></i>
                                <span class="text-dark">Admin</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item btn-logout" href="#" data-link="<?= base_url('logout')?>" >Sign out</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
			<main class="content">

		   
