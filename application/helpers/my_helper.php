<?php
	if (!defined('BASEPATH')) exit('No direct script access allowed');

	if (!function_exists('dd')) {
		function dd($var) {
			echo "<pre>";
			print_r ($var);
			echo "</pre>";
			die();
		}
	}

	if (!function_exists('isPost')) {
		function isPost() {
			if ($_SERVER['REQUEST_METHOD'] === 'POST') {
				return TRUE;
			} else {
				return FALSE;
			}
		}
	}

	if (!function_exists('idrFormat')) {
		function idrFormat($var) {
			return "Rp " . number_format((float)$var, 0, ',', '.');
		}
	}

	if (!function_exists('idDateFormat')) {
		function idDateFormat($var, $with_time = false) {
			if ($with_time) {
				return date("d M Y H:i", strtotime($var));
			} else {
				return date("d M Y", strtotime($var));				
			}			
		}
	}

	if (!function_exists('getConfigPagination')) {
		/**
		 * Get Config Pagination
		 *
		 * @param string $base_url
		 * @param integer $total_rows
		 * @param integer $per_page
		 * @param integer $uri_segment
		 * @return array config
		 */
		function getConfigPagination($base_url, $total_rows, $per_page, $uri_segment)
		{
			$config = [];
			$config["base_url"] 	= $base_url;
			$config["total_rows"] 	= $total_rows;
			$config["per_page"] 	= $per_page;
			$config["uri_segment"] 	= $uri_segment;
			// theme
			$config['first_link']       = 'First';
			$config['last_link']        = 'Last';
			$config['next_link']        = 'Next';
			$config['prev_link']        = 'Prev';
			$config['full_tag_open']    = '<nav><ul class="pagination">';
			$config['full_tag_close']   = '</ul></nav>';
			$config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
			$config['num_tag_close']    = '</span></li>';
			$config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
			$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
			$config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
			$config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['prev_tagl_close']  = '</span>Next</li>';
			$config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
			$config['first_tagl_close'] = '</span></li>';
			$config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
			$config['last_tagl_close']  = '</span></li>';
			
			return $config;
		}
	}

	if (!function_exists('getFilterDate')) {
		/**
		 * Get Filter Date
		 *
		 * @return array date
		 */
		function getFilterDate($timestamp = true)
		{
			$start	= isset($_GET['start']) ? $_GET['start'] : '';
			$end	= isset($_GET['end']) ? $_GET['end'] : '';

			$date = [
				'start'	=> $start != '' ? $timestamp ? $start : date('Y-m-d', $start) : $start,
				'end'	=> $end != '' ? $timestamp ? $end : date('Y-m-d', $end) : $end,
			];

			return $date;
		}
	}
