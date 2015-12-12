<?php
class Model_user extends CI_Model{

    function __construct()
    {
        $this->prefix =
            $this->session->userdata('prefix_');
    }

	public function get_one_data($id){
		$this->db->select(
            'u.*,
             del.name as idelete_name'
        );
        $this->db->join('idelete del','del.id=u.idelete','left');
		$this->db->where('u.idelete',0);
		$this->db->where('u.id',$id);
		$query = $this->db->get("[user] u")->row();
		return $query;
	}
	public function get_data()
	{
		$this->db->select(
            'u.*,
             d.name as department_name,
             r.name as rank_name,
			 g.name as group_name,
             del.name as idelete_name'
        );
		$this->db->where('u.idelete',0);
		$this->db->from('[user] u');
        $this->db->join('department d','d.id=u.department_id');
		$this->db->join('rank r','r.id=u.rank_id');
		$this->db->join('[group] g','g.id=u.group_id');
		$this->db->join('idelete del','del.id=u.idelete');
		$query = $this->db->get()->result();

		$data   = array();
		foreach($query as $result){
			$data[] = $result;
		}
		return $data;
	}
	public function get_one_data_user_privilege($id)
	{
		$this->db->select(
            'up.*,
             m.name as menu_name,
             u.username,
             del.name as idelete_name'
        );
		$this->db->where("up.id",$id);
		$this->db->where('up.idelete',0);
		$this->db->from('user_privilege up');
        $this->db->join('menu m','m.id=up.menu_id');
		$this->db->join('[user] u','u.id=up.user_id');
		$this->db->join('idelete del','del.id=up.idelete');
		$query = $this->db->get()->row();
		return $query;
	}

	public function get_data_user_privilege($user_id)
	{
		$this->db->select(
            'up.*,
             m.name as menu_name,
             u.username,
             del.name as idelete_name'
        );
		$this->db->where("up.user_id",$user_id);
		$this->db->where('up.idelete',0);
		$this->db->from('user_privilege up');
        $this->db->join('menu m','m.id=up.menu_id');
		$this->db->join('[user] u','u.id=up.user_id');
		$this->db->join('idelete del','del.id=up.idelete');
		$query = $this->db->get()->result();

		$data   = array();
		foreach($query as $result)
        {
            $data[] = $result;
		}
		return $data;
	}

	public function get_one_data_user_location($id)
	{
		/*$this->db->select(
            'ul.*,
             l.name as location_name,
             u.username,
             del.name as idelete_name'
        );*/
        $this->db->select(
            'ul.*,
             l.NAWIL as location_name,
             u.username,
             del.name as idelete_name'
        );
		$this->db->where("ul.id",$id);
		$this->db->where('ul.idelete',0);
		$this->db->from('user_location ul');

		// diganti dengan join ke tabel ARF10
        //$this->db->join('location l','l.id=ul.location_id');
        $this->db->join($this->prefix.'_AR..ARF10 l', 'l.WIL=ul.location_id');

		$this->db->join('[user] u','u.id=ul.user_id');
		$this->db->join('idelete del','del.id=ul.idelete');
		$query = $this->db->get()->row();
		return $query;
	}

	public function get_data_user_location($user_id)
	{
		$this->db->select(
            'ul.*,
             l.NAWIL as location_name,
             u.username,
             del.name as idelete_name'
        );
		$this->db->where("ul.user_id",$user_id);
		$this->db->where('ul.idelete',0);
		$this->db->from('user_location ul');
        
        // diganti dengan join ke tabel ARF10
        //$this->db->join('location l','l.id=ul.location_id');
		$this->db->join($this->prefix.'_AR..ARF10 l', 'l.WIL=ul.location_id');
		$this->db->join('[user] u','u.id=ul.user_id');
		$this->db->join('idelete del','del.id=ul.idelete');

		// di order berdasarkan id, supaya bisa dapat initial location user nya
		$this->db->order_by("id", "asc");

		$query = $this->db->get()->result();

		$data   = array();
		foreach($query as $result)
        {
            $data[] = $result;
		}
		return $data;
	}

	public function add_data()
	{
		$name = $this->input->post("name",true);
		$username = $this->input->post("username",true);
		$email = $this->input->post("email",true);
		$department_id = $this->input->post("department_id",true);
		$rank_id = $this->input->post("rank_id",true);
		$group_id = $this->input->post("group_id",true);

		//initial location user barunya
		$location_id = $this->input->post("location_id", true);

		$idelete = 0;
		$create_date = date("Y-m-d H:i:s",time());
		$activation_code = md5(uniqid());
		$data = array("name"=>$name,
            'username'=>$username,
            "email"=>$email,
            'group_id'=>$group_id,
            'rank_id'=>$rank_id,
            'department_id'=>$department_id,
            "idelete"=>$idelete,
            "create_date"=>$create_date,
            "activation_code"=>$activation_code,
            "location_id"=>$location_id);

        if( $this->input->post('password') )
            $data['password'] = $this->input->post("password",true);

		//return $this->db->insert("[user]",$data);
		$bresult = $this->db->insert("[user]",$data);
		return array($bresult, $idUser=$this->db->insert_id(), $location_id);  // idUser->id user yang baru aja dimasukkan ke APPL_GENERAL..user
	}

	// dijalankan setelah add_data().. menambahkan initial location user ke tabel user_location
	public function _add_data($user_id, $location_id){
		$idelete = 0;
		$data = array(
			'user_id'=>$user_id,
			'location_id'=>$location_id,
			'idelete'=>$idelete);

		return $this->db->insert("user_location", $data);
	}

	public function add_data_user_privilege()
	{
		$user_id = $this->input->post("user_id",true);
		$idelete = 0;
		$menu_id = $this->input->post("menu_id",true);
		$read = $this->input->post("read",true);
		$update = $this->input->post("update",true);
		$delete = $this->input->post("delete",true);
		$report = $this->input->post("report",true);
		$approve = $this->input->post("approve",true);
		$cancel = $this->input->post("cancel",true);
		$view_money = $this->input->post("view_money",true);
		$data = array("user_id"=>$user_id,"idelete"=>$idelete,"menu_id"=>$menu_id,"[read]"=>$read,"[update]"=>$update,"[delete]"=>$delete,"report"=>$report,"approve"=>$approve,"cancel"=>$cancel,"view_money"=>$view_money);
		return $this->db->insert("user_privilege",$data);
	}

	//public function add_data_user_location()
	public function add_data_user_location($params = array())
	{
		$user_id = $this->input->post("user_id",true);
		$idelete = 0;
		//$location_id = $this->input->post("location_id",true);
		//$location_id = $this->input->post("WIL",true);
		//$data = array("user_id"=>$user_id,"idelete"=>$idelete,"location_id"=>$location_id);
		$data = array("user_id"=>$params['user_id'],"idelete"=>$idelete,"location_id"=>$params['location_id']);
		return $this->db->insert("user_location",$data);
	}
	public function update_data()
	{
		$id = $this->input->post("id",true);
		$name = $this->input->post("name",true);
		$username = $this->input->post("username",true);
		$email = $this->input->post("email",true);
		$department_id = $this->input->post("department_id",true);
		$rank_id = $this->input->post("rank_id",true);
		$group_id = $this->input->post("group_id",true);

		//initial location user barunya
		$location_id = $this->input->post("location_id", true);

		$edit_date = date("Y-m-d H:i:s",time());
		$data = array("name"=>$name,'username'=>$username,"email"=>$email,'group_id'=>$group_id,'rank_id'=>$rank_id,'department_id'=>$department_id,"edit_date"=>$edit_date);

        if( $this->input->post('password', true) )
            $data['password'] = md5($this->input->post('password', true));

		return $this->db->where("id",$id)->update("[user]",$data);
	}

	public function update_data_user_privilege()
	{
		$id = $this->input->post("id",true);
		$user_id = $this->input->post("user_id",true);
		$menu_id = $this->input->post("menu_id",true);
		$read = $this->input->post("read",true);
		$update = $this->input->post("update",true);
		$delete = $this->input->post("delete",true);
		$report = $this->input->post("report",true);
		$approve = $this->input->post("approve",true);
		$cancel = $this->input->post("cancel",true);
		$view_money = $this->input->post("view_money",true);
		$data = array("user_id"=>$user_id,"menu_id"=>$menu_id,"[read]"=>$read,"[update]"=>$update,"[delete]"=>$delete,"report"=>$report,"approve"=>$approve,"cancel"=>$cancel,"view_money"=>$view_money);
		return $this->db->where("id",$id)->update("user_privilege",$data);
	}
	public function update_data_user_location($params=array())
	{
		//$id = $this->input->post("id",true);
		$id = $params['id'];
		$user_id = $this->input->post("user_id",true);
		$location_id = $this->input->post("location_id",true);
		$isInitLoc = $this->input->post("isInitLoc", true);
		$idelete = 0;

		//$data = array("user_id"=>$user_id,"location_id"=>$location_id);
		$data = array("user_id"=>$params['user_id'],"idelete"=>$idelete,"location_id"=>$params['location_id']);
		$update_ul = $this->db->where("id",$id)->update("user_location",$data);

		//lokasi utama, update juga tabel user nya
		if($isInitLoc==1 && $update_ul==true){
			$data_user = array("location_id"=>$params['location_id']);
			$update_user = $this->db->where("id", $params['user_id'])->update("[user]", $data_user);
			return $update_user;
		}
		else if($isInitLoc==0 && $update_ul==false){
			return false;
		}
		else{
			return $update_ul;
		}
	}
	public function delete_data()
	{
		$id = $this->input->post("id",true);
		$idelete = 1;
		$data = array("idelete"=>$idelete);
		return $this->db->where("id",$id)->update("[user]",$data);
	}
	public function delete_data_user_privilege()
	{
		$id = $this->input->post("id",true);
		$idelete = 1;
		$data = array("idelete"=>$idelete);
		return $this->db->where("id",$id)->update("user_privilege",$data);
	}
	public function delete_data_user_location()
	{
		$id = $this->input->post("id",true);
		$idelete = 1;
		$data = array("idelete"=>$idelete);
		return $this->db->where("id",$id)->update("user_location",$data);
	}

    function login( $params = array() )
    {
        if( empty( $params) )
        {
            return false;
        }

        $this->db->where('username', $params['username']);
        $this->db->where('password', md5($params['password']));

        $query = $this->db->get($params['tablename'])->row();

        if( !isset( $query->id ) )
            return false;
        else
            return $query;
    }
}
?>
