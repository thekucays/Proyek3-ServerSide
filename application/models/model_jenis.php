<?php

class Model_jenis extends CI_Model{

	function __construct(){

	}

	function listDataJenis( $params=array() ){
		if( isset($params['deskripsi']) and $params['deskripsi']!='' ){
			//$this->db->where('jenis_kendaraan', $params['jenis']);
			$this->db->like('deskripsi', $params['deskripsi']);
		}

		$query = $this->db->get('Jenis')->result();
        return $query;
	}

	function tambahJenis( $params ){
		$bresult = $this->db->insert('Jenis', $params);
		return array($bresult, $id = $this->db->insert_id(), INSERT_iFLAG($bresult));
	}

	function hapusJenis($id){
		if( isset($id) and $id!='' ){
			$this->db->where('id_jenis', $id);
			return $this->db->delete('Jenis');
		}
	}

	function getDetailJenis( $params = array() ){
		if( isset($params['id_jenis']) ){
			$this->db->where('id_jenis', $params['id_jenis']);

			$query = $this->db->get('Jenis')->row();
			return $query;
		}
	}

	function rubahJenis(){
		$id_jenis = $this->input->post('id_jenis', true);
		$deskripsi = $this->input->post('deskripsi', true);

		$data = array(
			'id_jenis' => $id_jenis,
			'deskripsi' => $deskripsi
		);

		return $this->db->where('id_jenis', $id_jenis)->update('Jenis', $data);
	}
}