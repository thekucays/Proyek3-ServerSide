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

	function editBengkel(){
		$data = array(
			'id_bengkel' => $this->input->post('id_bengkel', true),
			'nama_bengkel' => $this->input->post('nama_bengkel', true),
			'koordinat' => $this->input->post('koordinat', true),
			'jenis' => $this->input->post('jenis', true),
			'deskripsi' => $this->input->post('deskripsi', true),
			'rating' => $this->input->post('rating', true),
			'kode-kec' => $this->input->post('kode-kec', true),
			'isTubeless' => $this->input->post('isTubeless', true),
			'contact_person' => $this->input->post('contact_person', true)
		);

		return $this->db->where('id_bengkel', $this->input->post('id_bengkel', true))->update('Bengkel', $data);
	}

	function getDetailBengkel( $params = array() ){
		if(isset($params['id_bengkel'])){
			$this->db->where('id_bengkel', $params['id_bengkel']);

			$query = $this->db->get('Bengkel')->row();
			return $query;
		}
	}
}