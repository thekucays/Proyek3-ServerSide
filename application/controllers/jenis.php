 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jenis extends CI_Controller {
	function __construct(){
		parent::__construct();

		$this->load->model('model_jenis');
	}

	function index(){
		$data['jenis'] = '';

		$this->template2->write_view('content', 'jenis/list', $data);
        $this->template2->render();
	}

	function list_data_ajax(){
        $data['records'] = $this->model_jenis->listDataJenis( $this->input->post() );
        die( $this->load->view('jenis/list_data_ajax', $data, TRUE));
    }

    function hapusJenis($id){
    	$hasil = $this->model_jenis->hapusJenis($id);

    	if($hasil){
    		redirect('jenis', 'refresh');
    	}
    }

    function tambahJenis(){
    	$save = $this->input->post('save');
		if( $save ){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('deskripsi','Deskripsi Kendaraan','required');

            if($this->form_validation->run()){      
				// di unset supaya ga kebawa parameter nya pas di insert di model
				unset( $_POST['save'] );

				$this->db->trans_start();
				$hasil = $this->model_jenis->tambahJenis($_POST);

				if($hasil){
					$this->db->trans_complete();
				}
				else{
					$this->db->trans_rollback();
				}

				redirect('jenis', 'refresh');
			}
        }

        $this->_tambahJenis_form();
    }
    function _tambahJenis_form(){
    	$data = '';

    	$this->template2->write_view('content', 'jenis/form_add_jenis', $data);
        $this->template2->render();
    }

    function rubahJenis($id){
    	$save = $this->input->post('submit_save');

        if ($save){
			$this->load->library('form_validation');
            $this->form_validation->set_rules('deskripsi','Deskripsi Kendaraan','required');

            if($this->form_validation->run()){ 
	            $bresult = $this->model_jenis->rubahJenis();
	            if($bresult){
	            	redirect('jenis/index');
	            }
	        }
        }

        $params = array('id_jenis' => $id);
        $this->_rubahJenis_form($params);
    }
    function _rubahJenis_form($params = array()){
    	if( isset($params['id_jenis']) ){
    		$data['jenis'] = $this->model_jenis->getDetailJenis($params);
    		$this->template2->write_view('content', 'jenis/form_edit_jenis', $data);
    		$this->template2->render();
    	}
    }
}
