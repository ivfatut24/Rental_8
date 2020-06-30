<?php
    defined('BASEPATH') or exit('No direct script access allowed');

    class Model_KondisiBarang extends CI_Model
    {
        function get($id = '')
        {
            if ($id != '') {
                $this->db->where('id_kondisi_barang', $id);
            }
            
            return $this->db->get('kondisi_barang')->result_array();
        }
    }

    /* End of file Model_KondisiBarang.php */
    /* Location: ./application/models/Model_KondisiBarang.php */
