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
}