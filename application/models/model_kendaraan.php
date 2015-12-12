<?php

class Model_kendaraan extends CI_Model{

	function __construct(){

	}

	function listDataKendaraan( $params=array() ){
		if( isset($params['jenis']) and $params['jenis']!='' ){
			//$this->db->where('jenis_kendaraan', $params['jenis']);
			$this->db->like('jenis_kendaraan', $params['jenis']);
		}

		$query = $this->db->get('Kendaraan')->result();
        return $query;
	}

	function tambahKendaraan( $params ){
		$bresult = $this->db->insert('Kendaraan', $params);
		return array($bresult, $id = $this->db->insert_id(), INSERT_iFLAG($bresult));
	}

	function hapusKendaraan($id){
		if( isset($id) and $id!='' ){
			$this->db->where('id_kendaraan', $id);
			return $this->db->delete('Kendaraan');
		}
	}

	function getDetailKendaraan( $params = array() ){
		if( isset($params['id_kendaraan']) ){
			$this->db->where('id_kendaraan', $params['id_kendaraan']);

			$query = $this->db->get('Kendaraan')->row();
			return $query;
		}
	}

	function editKendaraan(){
		$id_kendaraan = $this->input->post('id_kendaraan', true);
		$jenis_kendaraan = $this->input->post('jenis_kendaraan', true);

		$data = array(
			'id_kendaraan' => $id_kendaraan,
			'jenis_kendaraan' => $jenis_kendaraan
		);

		return $this->db->where('id_kendaraan', $id_kendaraan)->update('Kendaraan', $data);
	}
}