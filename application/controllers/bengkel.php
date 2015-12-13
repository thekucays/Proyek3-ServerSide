 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bengkel extends CI_Controller {

	function __construct(){
		parent::__construct();

		$this->load->model('model_bengkel');
	}

	function index(){
		$data['kec'] = '';

		$this->template2->write_view('content', 'bengkel/list', $data);
        $this->template2->render();
	}

	function list_data_ajax(){
        $data['records'] = $this->model_bengkel->listDataBengkel( $this->input->post());
        die( $this->load->view('bengkel/list_data_ajax', $data, TRUE));
    }

    function hapus_bengkel($id){
    	$hasil = $this->model_bengkel->hapusBengkel($id);

    	if($hasil){
    		redirect('bengkel', 'refresh');
    	}
    }

    function editBengkel($id){
        $save = $this->input->post('submit_save');

        if ($save){
            //$this->load->library('form_validation');
            //$this->form_validation->set_rules('deskripsi','Deskripsi Kendaraan','required');

            //if($this->form_validation->run()){ 
                $bresult = $this->model_jenis->rubahJenis();
                if($bresult){
                    redirect('bengkel/index');
                }
            //}
        }

        $params = array('id_bengkel' => $id);
        $this->_rubahJenis_form($params);
    }
    function _editBengkel_form($params = array()){
        if( isset($params['id_bengkel']) ){
            $data['jenis'] = $this->model_bengkel->getDetailBengkel($params);
            $this->template2->write_view('content', 'bengkel/form_edit_bengkel', $data);
            $this->template2->render();
        }
    }

    // auto complete di form edit nya
    function jenis_autocomplete(){
        $term = $this->input->post('term');

        $result = $this->model_so->customer_autocomplete($term);
        echo json_encode( $result );
        die();
    }

    function kecamatan_autocomplete(){
        $term = $this->input->post('term');

        $result = $this->model_so->customer_autocomplete($term);
        echo json_encode( $result );
        die();
    }
}