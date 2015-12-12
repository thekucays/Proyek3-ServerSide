<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
		$this->load->model("model_user");
    }

	public function index(){}
	public function get_data()
	{
		$this->load->model("model_user");
		$data = $this->model_user->get_data();
		echo json_encode($data);
	}
	public function get_data_detail()
	{
		$id = $this->input->post("id",true);
		$this->load->model("model_user");
		$data = $this->model_user->get_one_data($id);
		echo json_encode($data);
	}
	public function get_data_user_privilege()
	{
		$this->load->model("model_user");
		$user_id = $this->input->post("user_id",true);
		$data = $this->model_user->get_data_user_privilege($user_id);
		echo json_encode($data);
	}
	public function get_data_detail_user_privilege()
	{
		$id = $this->input->post("id",true);
		$this->load->model("model_user");
		$data = $this->model_user->get_one_data_user_privilege($id);
		echo json_encode($data);
	}
	public function get_data_user_location()
	{
		$this->load->model("model_user");
		$user_id = $this->input->post("user_id",true);
		$data = $this->model_user->get_data_user_location($user_id);
		echo json_encode($data);
	}
	public function get_data_detail_user_location()
	{
		$id = $this->input->post("id",true);
		$this->load->model("model_user");
		$data = $this->model_user->get_one_data_user_location($id);
		echo json_encode($data);
	}
	public function save_data()
	{
		$this->load->library('form_validation');
		$this->load->model("model_user");
		$id = $this->input->post("id",true);
        $pwd = $this->input->post('password');
		$success = false;
		$message = "";
		if($id == 0){
			$this->form_validation->set_rules('email',lang('label_email'),'required|trim|valid_email|is_unique[[user].email]');
			$this->form_validation->set_rules('username',lang('label_username'),'required|trim|is_unique[[user].username]');
			$this->form_validation->set_message('is_unique', '%s '.lang('is_taken'));
			if($this->form_validation->run()){

                if( !$pwd )
                    $_POST['password'] = md5('123456');
                else
                    $_POST['password'] = md5($_POST['password']);

				//$success = $this->model_user->add_data();
				list($bresult, $user_id, $location_id) = $this->model_user->add_data();
				if($bresult){
					// berhasil masuk ke tabel user, lanjutin masukin ke tabel user_location
					$success = true;
					$addUserLocation = $this->model_user->_add_data($user_id, $location_id);
					
					if($addUserLocation){
						$message = lang('message_success_insert');
					}
					else{
						$message = lang('message_error_insert');	
					}

				}else{
					$message = lang('message_error_insert');
				}
			} else {
				$success = false;
				$message = lang('message_error_insert').validation_errors();
			}
		} else {
			$old_data = $this->model_user->get_one_data($id);
			$username = $this->input->post("username",true);
			$email = $this->input->post("email",true);
			$need_to_validate = false;
			if($old_data->username != $username){
				$this->form_validation->set_rules('username',lang('label_username'),'required|trim|is_unique[[user].username]');
				$need_to_validate = true;
			}
			if($old_data->email != $email){
				$this->form_validation->set_rules('email',lang('label_email'),'required|trim|valid_email|is_unique[[user].email]');
				$need_to_validate = true;
			}
			$this->form_validation->set_message('is_unique', '%s '.lang('is_taken'));
			if(($this->form_validation->run() and $need_to_validate) or !$need_to_validate  ){
				$success = $this->model_user->update_data();
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
		$data = $this->model_user->get_data();
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}
	public function save_data_user_privilege()
	{
		$this->load->model("model_user");
		$id = $this->input->post("id",true);
		$user_id = $this->input->post("user_id",true);
		$success = false;
		if($id == 0){
			$success = $this->model_user->add_data_user_privilege();
			if($success){
				$message = lang('message_success_insert');
			}else{
				$message = lang('message_error_insert');
			}
		} else {
			$success = $this->model_user->update_data_user_privilege();
			if($success){
				$message = lang('message_success_update');
			}else{
				$message = lang('message_error_update');
			}
		}
		$data = $this->model_user->get_data_user_privilege($user_id);
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}
	public function save_data_user_location()
	{
		$this->load->model("model_user");
		$id = $this->input->post("id",true);
		$location_id = $this->input->post("location_id",true);
		$user_id = $this->input->post("user_id",true);
		$success = false;
		if($id == 0){
			//$success = $this->model_user->add_data_user_location();
			$success = $this->model_user->add_data_user_location($this->input->post());
			if($success){
				$message = lang('message_success_insert');
			}else{
				$message = lang('message_error_insert');
			}
		} else {
			//$success = $this->model_user->update_data_user_location();
			$success = $this->model_user->update_data_user_location($this->input->post());
			if($success){
				$message = lang('message_success_update');
			}else{
				$message = lang('message_error_update');
			}
		}
		$data = $this->model_user->get_data_user_location($user_id);
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}
	public function delete_data()
	{
		$this->load->model("model_user");
		$success = $this->model_user->delete_data();
		if($success){
			$message = lang('message_success_delete');
		}else{
			$message = lang('message_error_delete');
		}
		$data = $this->model_user->get_data();
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}

	public function delete_data_user_privilege()
	{
		$this->load->model("model_user");
		$id = $this->input->post("id",true);
		$user_id = $this->model_user->get_one_data_user_privilege($id)->user_id;
		$success = $this->model_user->delete_data_user_privilege();
		if($success){
			$message = lang('message_success_delete');
		}else{
			$message = lang('message_error_delete');
		}
		$data = $this->model_user->get_data_user_privilege($user_id);
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}

	public function delete_data_user_location()
	{
		$this->load->model("model_user");
		$id = $this->input->post("id",true);
		$user_id = $this->model_user->get_one_data_user_location($id)->user_id;
		$success = $this->model_user->delete_data_user_location();
		if($success){
			$message = lang('message_success_delete');
		}else{
			$message = lang('message_error_delete');
		}
		$data = $this->model_user->get_data_user_location($user_id);
		$json   = array(
			"success"   => $success,
			"message"   => $message,
			"data"      => $data
		);
		echo json_encode($json);
	}

    function login()
    {
//        $COMMON_USER = 18;
//            $this->output->enable_profiler(true);
        $submit             = $this->input->post('submit');
        $forgot_password    = $this->input->post('forgot_password');

        if ( $forgot_password )
        {
            redirect('user/forgot_password');
        }

        if ( $submit )
        {
            $params = array(
                'object' => &$this,
                'server' => &$_SERVER,
                'try_username' => $this->input->post('username'),
                );

//            log_index($params);

            $params = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password'),
                'tablename' => 'appl_general..[user]',
                );
            $user_info = $this->model_user->login($params);

            if ( $user_info !== false)
            {
                if (isset($user_info->bverified) and $user_info->bverified == 0)
                {
                    $this->session->set_flashdata('flash_message', lang('PleaseVerifyByEmail'));
                    redirect('user/login');
                    return;
                }

                if ($user_info->idelete == 1)
                {
                    $this->session->set_flashdata('flash_message', lang('UserIsSuspended'));
                    redirect('user/login');
                    return;
                }

                $this->session->set_userdata('is_authed',1);
                $this->session->set_userdata('user_info', $user_info);
                $this->session->set_flashdata('flash_message', lang('LoginSuccess'));

                $params = array(
                    'object' => &$this,
                    'server' => &$_SERVER,
                    );

//                log_index($params);
                redirect('main/dashboard');
                return;
            }
            else
                $this->session->set_flashdata('flash_message', lang('LoginFailed'));
        }
        else
            null;

    //            $this->load->view('login');
        $this->template2->set_template('bootstrap');
        $this->template2->write_view('content', 'login', '', TRUE);
        $this->template2->render();
    }

    function logout()
    {
        $this->session->set_userdata('user_info', null);
        $this->session->set_userdata('is_authed', null);
        $this->session->set_flashdata('flash_message', lang('Goodbye'));
        redirect('user/login');
    }

    function forgot_password()
    {
        $submit = $this->input->post('submit');
        $email = $this->input->post('email');

        if ( $submit and $email)
        {
            $params = array('email' => $email);
            $user = $this->user_model->profile2($params);

            $this->session->set_flashdata('flash_message', lang('AnEmailHasBeenSent'));

            if ( $user )
            {
                $token = md5(rand(10000000,1000000000));
                $params = array(
                    'email' => $email,
                    'token' => $token,
                    'user_id' => $user->id,
                    );
                $this->user_model->insert_forgot_password_token($params);

                $data = array('email' => $email, 'token' => $token, 'user_info' => $user);
                $this->load->library('phpmailer2');
                $this->phpmailer2->addAddress($email, $user->name);
                $this->phpmailer2->addFrom($this->cs_email, 'Customer Service BOSS');
                $this->phpmailer2->subject(lang('ForgotPassword'));
                $this->phpmailer2->message($this->load->view('user/forgot_password_mail', $data, TRUE) );

//                $this->phpmailer2->print_debugger();

                if ( !$this->phpmailer2->send() )
                {
                    log_message('error',sprintf('%s (%s): %s, %s', __FILE__,__LINE__,'Email not sent', $this->phpmailer2->ErrorInfo));
                }
                redirect('user/login');
            }
            else
                null;

            redirect('user/forgot_password');
        }
        else
            null;

        $this->template2->write_view('content', 'user/forgot_password', '');
        $this->template2->render();
    }

    function reset_and_email()
    {
        if ( !$this->valid )
            die(_ajax_upload_error(lang('ErrorPermissionDenied')));

        $id = $this->input->post('id');

        if ( $id )
        {
            $params = array(
                'user_id' => $id,
                'password' => '123456',
                'bverified' => 1,
                );

            list( $flag, $user_id, $message) = $this->user_model->reset_password($params);

            if ( !$flag )
                die(_ajax_upload_error(lang('ErrorDataUpdateFailed')));

            $data_mail['user_info'] = $this->user_model->profile2(array('id' => $id));
            $data_mail['default_pwd'] = $params['password'];

            $this->load->library('phpmailer2');

            $this->phpmailer2->addAddress($data_mail['user_info']->email, $data_mail['user_info']->name);
            $this->phpmailer2->addFrom($this->cs_email, 'Customer Service BOSS');
            $this->phpmailer2->addBcc('adesantoasman@gmail.com', 'adesanto asman');
//            $this->phpmailer2->addBcc('marlinda.tjhie@gmail.com', 'Marlinda');
            $this->phpmailer2->subject('Password Reset by Admin');
            $this->phpmailer2->message($this->load->view('user/reset_pwd_by_admin', $data_mail, TRUE) );

//                $this->phpmailer2->print_debugger();

            if ( !$this->phpmailer2->send() )
            {
                log_message('error',sprintf('%s (%s): %s, %s', __FILE__,__LINE__,'Email not sent', $this->phpmailer2->ErrorInfo));
            }

            die(_ajax_upload_success(lang('Success')));
        }
        else
            die(_ajax_upload_error(lang('ErrorIdIsNull')));
    }
}
