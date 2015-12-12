<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Urlmapper extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model("model_urlmapper");
    }

	public function index(){}
	public function get_data()
	{
		$data = $this->model_urlmapper->get_data();
		echo json_encode($data);
	}
	public function get_data_detail()
	{
		$id = $this->input->post("id",true);
		$data = $this->model_urlmapper->get_one_data($id);
		echo json_encode($data);
	}
	public function save_data()
	{
		$this->load->library('form_validation');
		$id = $this->input->post("id",true);
		$success = false;
		$message = "";
		if($id == 0){
			$this->form_validation->set_rules('code',lang('label_urlmapper_code'),'required|trim|is_unique[URLMAPPER.CODE]');
			$this->form_validation->set_message('is_unique', '%s '.lang('is_taken'));
			if($this->form_validation->run()){
				$success = $this->model_urlmapper->add_data();
				if($success){
					$message = lang('message_success_insert');
				}else{
					$message = lang('message_error_insert');
				}
			} else {
				$success = false;
				$message = lang('message_error_insert').validation_errors();
			}
		} else {
			$old_data = $this->model_urlmapper->get_one_data($id);
			$code = $this->input->post("code",true);
			$need_to_validate = false;
			if($old_data->CODE != $code){
				$this->form_validation->set_rules('code',lang('label_urlmapper_code'),'required|trim|is_unique[URLMAPPER.CODE]');
				$need_to_validate = true;
			}
			$this->form_validation->set_message('is_unique', '%s '.lang('is_taken'));
			if(($this->form_validation->run() and $need_to_validate) or !$need_to_validate  ){
				$success = $this->model_urlmapper->update_data();
				if($success){
					$message = lang('message_success_update');
				}else{
					$message = lang('message_error_update');
				}
			} else {
				$success = false;
				$message = lang('message_error_update').validation_errors();
			}
		}
		$data = $this->model_urlmapper->get_data();
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}
	public function delete_data()
	{
		$success = $this->model_urlmapper->delete_data();
		if($success){
			$message = lang('message_success_delete');
		}else{
			$message = lang('message_error_delete');
		}
		$data = $this->model_urlmapper->get_data();
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}
}
