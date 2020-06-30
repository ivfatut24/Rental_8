<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DataBank extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesAdmin();
		$this->session->set_flashdata('menu', 'data-bank');
	}

	public function index()
	{
		$data['data'] = $this->bank->getAll();
		$this->load->view('admin/data_bank/index', $data);
	}

	public function create()
	{
		$this->form_validation->set_rules('nama_bank', 'Nama Bank', 'trim|required');
		$this->form_validation->set_rules('rekening', 'Rekening', 'trim|required');
		$this->form_validation->set_rules('pemilik_rekening', 'Pemilik Rekening', 'trim|required');
		if($this->form_validation->run() == FALSE) {
			$this->load->view('admin/data_bank/form');
		} else {
			$config['upload_path']		='./assets/uploads/bank/';
			$config['allowed_types']	='gif|jpg|png';
			$config['remove_spaces']	= TRUE;
			$config['encrypt_name']		= TRUE;
			$this->load->library('upload', $config);
			if( ! $this->upload->do_upload('gambar'))
			{
				$data['error'] = $this->upload->display_errors();
				$this->load->view('admin/data_bank/form', $data);
			} else {
				if ($this->bank->insert()) {
					echo '<script type="text/javascript">alert(\'Bank Berhasil Ditambahkan\');</script>';
					redirect('admin/bank','refresh');
				}else{
					echo '<script type="text/javascript">alert(\'Bank Gagal ditambahkan\');</script>';
					redirect('admin/bank/create');
				}
			}			
		}
	}

	public function update($id)
	{
		$data['data'] = $this->bank->getById($id);

		if(empty($_POST)) {
			$data['error'] = validation_errors();
			$this->load->view('admin/data_bank/form', $data);
		}else{
			if (!empty($_FILES['gambar']['name'])) {
				$config['upload_path']		= './assets/uploads/bank/';
				$config['allowed_types']	= 'gif|jpg|png';
				$config['remove_spaces']	= TRUE;
				$config['encrypt_name']		= TRUE;
				$this->load->library('upload', $config);
				if( ! $this->upload->do_upload('gambar'))
				{
					$data['error'] = $this->upload->display_errors(); ;
					$this->load->view('admin/data_bank/form', $data);
				} else {
					if ($this->bank->update()) {
						echo '<script type="text/javascript">alert(\'Bank Berhasil Diubah\');</script>';
						redirect('admin/bank','refresh');
					}else{
						echo '<script type="text/javascript">alert(\'Bank Gagal Diubah\');</script>';
						redirect('admin/bank/update/'.$id);
					}
				}
			}else{
				if ($this->bank->update()) {
					echo '<script type="text/javascript">alert(\'Bank Berhasil Diubah\');</script>';
					redirect('admin/bank','refresh');
				}else{
					echo '<script type="text/javascript">alert(\'Bank Gagal Diubah\');</script>';
					redirect('admin/bank/update/'.$id);
				}
			}
		}
	}

	public function detailBank($id)
	{
		$data['data'] = $this->bank->getById($id);
		$this->load->view('admin/data_bank/detail',$data);	
	}

	public function delete($id)
	{
		if ($this->bank->delete($id)) {
			echo '<script type="text/javascript">alert(\'Bank Berhasil dihapus\');</script>';
			redirect('admin/bank','refresh');
		}else{
			echo '<script type="text/javascript">alert(\'Bank Gagal dihapus\');</script>';
			redirect('admin/bank','refresh');
		}
	}

}

/* End of file DataBank.php */
/* Location: ./application/controllers/admin/DataBank.php */
