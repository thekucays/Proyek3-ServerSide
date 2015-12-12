<?php

class Model_bengkel extends CI_Model{

	function __construct(){

	}

	function listDataBengkel( $params=array() ){
		if( isset($params['isTubeless']) and $params['isTubeless']!='' ){
			$this->db->where('isTubeless', $params['isTubeless']);
		}

		if( isset($params['jenis']) and $params['jenis']!='' ){
			$this->db->where('jenis', $params['jenis']);
		}

		$query = $this->db->get('Bengkel')->result();
        return $query;
	}

	function hapusBengkel($id){
		if( isset($id) and $id!='' ){
			$this->db->where('id_bengkel', $id);
			 return $this->db->delete('Bengkel');
		}
	}
}