 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kendaraan extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('model_kendaraan');
	}

	function index(){
		$data['kec'] = '';

		$this->template2->write_view('content', 'kendaraan/list', $data);
        $this->template2->render();
	}

	function list_data_ajax(){
        $data['records'] = $this->model_kendaraan->listDataKendaraan( $this->input->post() );
        die( $this->load->view('kendaraan/list_data_ajax', $data, TRUE));
    }

    function hapusKendaraan($id){
    	$hasil = $this->model_kendaraan->hapusKendaraan($id);

    	if($hasil){
    		redirect('kendaraan', 'refresh');
    	}
    }

    function addKendaraan(){
    	$save = $this->input->post('save');
		if( $save ){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('jenis_kendaraan','Jenis Kendaraan','required');

            if($this->form_validation->run()){      
				// di unset supaya ga kebawa parameter nya pas di insert di model
				unset( $_POST['save'] );

				$this->db->trans_start();
				$hasil = $this->model_kendaraan->tambahKendaraan($_POST);

				if($hasil){
					$this->db->trans_complete();
				}
				else{
					$this->db->trans_rollback();
				}

				redirect('kendaraan', 'refresh');
			}
        }

        $this->_addKendaraan_form();
    }
    function _addKendaraan_form(){
    	$data = '';

    	$this->template2->write_view('content', 'kendaraan/form_add_kendaraan', $data);
        $this->template2->render();
    }

    function editKendaraan($id){
    	$save = $this->input->post('submit_save');

        if ($save){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('jenis_kendaraan','Jenis Kendaraan','required');

            if($this->form_validation->run()){ 
	            $bresult = $this->model_kendaraan->editKendaraan();
	            if($bresult){
	            	redirect('kendaraan/index');
	            }
	        }
        }

        $params = array('id_kendaraan' => $id);
        $this->_editKendaraan_form($params);
    }
    function _editKendaraan_form($params = array()){
    	if( isset($params['id_kendaraan']) ){
    		$data['kendaraan'] = $this->model_kendaraan->getDetailKendaraan($params);
    		$this->template2->write_view('content', 'kendaraan/form_edit_kendaraan', $data);
    		$this->template2->render();
    	}
    }
}
