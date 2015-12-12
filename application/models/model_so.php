<?php

class Model_so extends CI_Model{

    function __construct()
    {
        $this->prefix = $this->session->userdata('prefix_');
    }

    // dropdown creators //////////////////////////////////////////////////////////////////////////////////
    function dropdown_customer(){
    	$buffer = array();
        //$PB = 3;
        //$this->db->where('JENIS', $PB );

        $query = $this->db->get($this->prefix.'_AR..ARF01')->result();

        foreach( $query as $q )
            $buffer[$q->CUST] = $q->NAMA;

        return $buffer;
    }
    function dropdown_wilayah(){
    	$buffer = array();
        $query = $this->db->get($this->prefix.'_AR..ARF10')->result();

        foreach( $query as $q )
            $buffer[$q->WIL] = $q->NAWIL;

        return $buffer;
    }

    // digunakan pada index SO nya
    function dropdown_wilayah_search(){
        // get user information
        $user_id = $this->session->userdata('user_info')->id;
        $user_name = $this->session->userdata('user_info')->username;
        $user_rank = $this->session->userdata('user_info')->rank_id;

        $user_location_id = $this->get_user_location_id($user_id);
        $ids = array();
        $buffer = array();

        // ambil priority nya berdasarkan user_rank nya..karena $user_rank isinya adalah id rank nya
        $rank_priority = $this->get_user_rank_priority($user_rank);
        echo("<script>console.log('user id : ' + $user_id);</script>");
        echo("<script>console.log('user rank_priority : ' + $rank_priority);</script>");

        // generate dropdown yang hanya milik user ybs
        //if($user_rank > 30){
        if($rank_priority > 30){
            //$query_uid = $this->get_user_location_id($user_id);
            foreach ($user_location_id as $uid){
                $ids[] = $uid->location_id;
            }
            $this->db->where_in('WIL', $ids);
        }

        $query = $this->db->get($this->prefix.'_AR..ARF10')->result();

        //if($user_rank <= 30)
        //if($rank_priority <= 30)  // manajer atau diatas
        $buffer['ALL'] = 'ALL';

        foreach ($query as $q) {
            $buffer[$q->WIL] = $q->NAWIL;
        }

        return $buffer;
    }

    function get_user_rank_priority($user_rank){
        $this->db->where('id', $user_rank);
        $query = $this->db->get('rank')->row();

        return $query->priority;
    }

    function dropdown_kurs(){
    	$buffer = array();
        $query = $this->db->get($this->prefix.'_GL..GLFVAL')->result();

        foreach( $query as $q )
            $buffer[$q->kurs] = $q->kurs;

        return $buffer;
    }
    function dropdown_ntukar(){
    	$buffer = array();
        $query = $this->db->get($this->prefix.'_GL..GLFVAL2')->result();

        foreach( $query as $q )
            $buffer[$q->TUKAR] = $q->KURS;

        return $buffer;
    }
    function dropdown_slm(){
    	$buffer = array();
        $query = $this->db->get($this->prefix.'_AR..ARF08')->result();

        foreach( $query as $q )
            $buffer[$q->SLM] = $q->NAMA;

        return $buffer;
    }
    function dropdown_wil(){
    	$buffer = array();
        $query = $this->db->get($this->prefix.'_AR..ARF10')->result();

        foreach( $query as $q )
            $buffer[$q->WIL] = $q->NAWIL;

        return $buffer;
    }
    function dropdown_sales_type()
    {
        $buffer = array();
        $query = $this->db->get($this->prefix.'_SO..SOF05')->result();

        foreach ($query as $q)
            $buffer[$q->KODE] = $q->KET;

        return $buffer;
    }

    // end of dropdown creators ///////////////////////////////////////////////////////////////////////
    // autocomplete creators /////////////////////////////////////////////////////////////////////////
    function customer_autocomplete( $term , $params = array() ){
        $this->db->like('NAMA', $term);
        $this->db->or_like('CUST', $term);
        $this->db->order_by('NAMA');
        $this->db->limit(10);

        $query = $this->db->get($this->prefix.'_AR..ARF01')->result();

        return $query;
    }
    function sales_autocomplete( $term , $params = array() ){
        $this->db->like('NAMA', $term);
        $this->db->order_by('NAMA');
        $this->db->limit(10);

        $query = $this->db->get($this->prefix.'_AR..ARF08')->result();

        return $query;
    }
    function wilayah_autocomplete( $term , $params = array() ){
        $this->db->like('NAWIL', $term);
        $this->db->order_by('NAWIL');
        $this->db->limit(10);

        $query = $this->db->get($this->prefix.'_AR..ARF10')->result();

        return $query;
    }
    function alamat_autocomplete($params = array()){
        if(isset($params['term']) && isset($params['cust_id']) && isset($params['limit'])){
            $this->db->where('CUST', $params['cust_id']);
            $this->db->like('AL', $params['term']);
            $this->db->limit($params['limit']);

            $query = $this->db->get($this->prefix.'_SI..SIF01')->result();
            return $query;
        }
        else{
            return null;
        }
    }
    // end of autocomplete creators //////////////////////////////////////////////////////////////////

    function add_new_address( $params=array() ){
        $bresult = $this->db->insert($this->prefix.'_SI..SIF01', $params);

        if($bresult)
            return 1;

        return 0;
    }

    function get_next_address_code($cust_id){
        // dijalanin sebelum add_new_address, buat generatr KODE nya
        $this->db->where('CUST', $cust_id);
        $this->db->select_max('KODE', 'kodee');
        $last_kode = $this->db->get($this->prefix.'_SI..SIF01')->row();
        $int_last_kode = (int)$last_kode->kodee;

        $int_new_kode = $int_last_kode+1;
        if($int_new_kode <= 9)
            return '0'.$int_new_kode;

        return $int_new_kode;
    }

    function get_user_location_id($user_id){
        //$buffer = array();
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('[user_location]')->result();

        /*foreach ($query as $q)
            $buffer[$q->KODE] = $q->KET;

        return $buffer; */
        return $query;
    }

    function get_so_header_detail( $params = array() ){
        $datefrom =
            $dateto = null;
        $dateFlag = True;
        $usrBasePeriode = date('m-Y');


        // get user information
        $user_id = $this->session->userdata('user_info')->id;
        $user_name = $this->session->userdata('user_info')->username;
        $user_rank = $this->session->userdata('user_info')->rank_id;

        $rank_priority = $this->get_user_rank_priority($user_rank);

        $user_location_id = $this->get_user_location_id($user_id);
        $ids = array(); // untuk simpan location user yang bersangkutan..

        /*
			Search by dateto dan datefrom belum 100%
        */

        if( isset( $params['NO_BUKTI']) and $params['NO_BUKTI']!='')
        {
            $this->db->where('a.NO_BUKTI', $params['NO_BUKTI']);
            $dateFlag = False;
        }

        if( isset( $params['NO_PO_CUST']) and $params['NO_PO_CUST']!='')
        {
            $this->db->where('a.NO_PO_CUST', $params['NO_PO_CUST']);
            $dateFlag = False;
        }

        //if( isset( $params['NAMA_CUST']) and $params['NAMA_CUST']!='')
        if( isset( $params['customer_code']) and $params['customer_code']!='')
        {
            //$this->db->where('a.NAMA_CUST', $params['NAMA_CUST']);
            $this->db->where('a.CUST', $params['customer_code']);
            $dateFlag = False;
        }

        if(isset($params['sales_code']) and $params['sales_code']!=''){
            $this->db->where('a.KODE_SALES', $params['sales_code']);
        }

        if(isset($params['KODE_WIL']) and $params['KODE_WIL']!=''){
            if($params['KODE_WIL']!='ALL')
                $this->db->where('a.KODE_WIL', $params['KODE_WIL']);
        }

        //item related
        if(isset($params['item_no']) and $params['item_no'] != ''){
            $this->db->where('b.BRG', $params['item_no']);
        }

        if( $dateFlag )
        {
            if( isset( $params['datefrom']) and $params['datefrom'] != '' )
                $datefrom = formatdatemon( $params['datefrom'] );
            else
                $datefrom = date('d-M-Y', COMPILE_iFIRSTDATE($usrBasePeriode)) ;

            if( isset( $params['dateto']) and $params['dateto'] != '')
                $dateto = formatdatemon( $params['dateto'] );
            else
                $dateto = date('d-M-Y', COMPILE_iLASTDATE($usrBasePeriode)) ;
        }

        if( !is_null( $datefrom))
            $this->db->where('a.TGL >=', $datefrom);

        if( !is_null( $dateto))
            $this->db->where('a.TGL <=', $dateto);


        /*$this->db->select(
            'a.NO_BUKTI, a.TGL, a.TGL_KIRIM, a.STATUS, a.NO_PO_CUST, a.NAMA_CUST, a.VLT, a.KET, a.TGL_INPUT,
            b.NO_URUT, b.BRG, u.username, u.rank_id, ul.location_id, sl.NAMA'
        ); */


        /*$this->db->select(
            'a.NO_BUKTI, a.TGL, a.TGL_KIRIM, a.STATUS, a.NO_PO_CUST, a.NAMA_CUST, a.VLT, a.KET, a.TGL_INPUT,
                b.NO_URUT, b.BRG, u.username, u.rank_id, ul.location_id, sl.NAMA'
        );*/


        $this->db->select(
            'a.*,
            b.NO_URUT, 
            b.BRG, 
            sl.NAMA, 
            brg.NAMA as NAMABARANG'
        );

        // refer to model_po's model
        $this->db->join($this->prefix.'_AR..ARF08 sl', 'sl.SLM = a.KODE_SALES', 'left');
        $this->db->join($this->prefix.'_SO..SOT01B b', 'b.NO_BUKTI = a.NO_BUKTI', 'left');

        $this->db->join($this->prefix.'_ST..STF02 brg', 'brg.BRG = b.BRG', 'left');

        $this->db->join('[user] u', 'a.USER_NAME = u.username', 'left');
        $this->db->join('[user_location] ul', 'ul.user_id = u.id', 'left');
        $this->db->order_by("a.NO_BUKTI", "asc");

        //if($user_rank > 30){
        if($rank_priority > 30){
            foreach ($user_location_id as $id)
                $ids[] = $id->location_id;

            //$this->db->where('ul.location_id', $user_location_id);  // hanya pilih lokasi user nya aja
            //$this->db->where_in('ul.location_id', $ids);
            $this->db->where_in('a.KODE_WIL', $ids);
        }

        $query = $this->db->get($this->prefix.'_SO..SOT01A a')->result();

        return $query;
    }

    function _get_so_heading_number($type){
    	$this->db->where('TYPE', $type);
		$query = $this->db->get($this->prefix.'_SI..SIF02')->row();
		//$query = $this->db->get($this->prefix.'_SI..SIF02');
		return $query->KODE;
		/*$query = $this->db->select('KODE')
			->from($this->prefix.'_SI..SIF02')
			->where('TYPE', $type)
			->get();
		return $query->result();*/
    }

    function add_so_header( $params , $no_so = null){
        if($no_so){
            $this->db->where('NO_BUKTI', $no_so);
            $bresult = $this->db->update($this->prefix.'_SO..SOT01A', $params);

            if( $bresult )
                return array(True, $id = $no_so, null);
            else
                return array(False, null, lang('message_error_update').' SOT01A');
        }
        else{
            $bresult = $this->db->insert($this->prefix.'_SO..SOT01A', $params);

            return array($bresult, $id = $params['NO_BUKTI'], INSERT_iFLAG($bresult));
        }
    }

    // create sequencing number.. (pay attn to this)
    function process_sequence( $params )
    {
        $MONTH = 2; //1;
        $YEAR = 1; //2;

        $date = explode( "-", $params['TGL']);

        $this->db->where('TYPE', $params['so_jenis'] );
        $this->db->where('KODE', $params['so_name'] );
        $this->db->where('BLN', $date[$MONTH] );
        $this->db->where('THN', $date[$YEAR] );

        $query = $this->db->get($this->prefix.'_SI..SIF02B')->row() ;

        if( empty ( $query ))
        {
            $params = array(
                'TYPE' => $params['so_jenis'],
                'KODE' => $params['so_name'],
                'BLN' => $date[$MONTH],
                'THN' => $date[$YEAR],
                'NO_URUT' => 1,
            );

            $bresult = $this->db->insert($this->prefix.'_SI..SIF02B', $params );

            if ( $bresult )
                return array(True, $urut  = 1, $messages = null );
            else
                return array(False, $urut  = null, $messages = lang('message_error_insert').' SEQ SIF02B' );
        }
        else
        {
            $urut = $query->NO_URUT + 1; // nama kolom di tabel SIF02B nya

            $uparams = array(
                //'urut' => $urut,    // nama kolom di tabel SIF02B nya
                'NO_URUT' => $urut,
            );

            $this->db->where('TYPE', $params['so_jenis'] );
            $this->db->where('KODE', $params['so_name'] );
            $this->db->where('BLN', $date[$MONTH] );
            $this->db->where('THN', $date[$YEAR] );
            $this->db->where('NO_URUT', $query->NO_URUT );
            $bresult = $this->db->update($this->prefix.'_SI..SIF02B', $uparams);

            if( $bresult )
                return array(True, $urut, null);
            else
                return array(false, null, lang('message_error_update').' SEQ SIF02B');
        }
    }

    function get_so_header($params)
    {
         if( isset( $params['no_urut']) )
            $this->db->where('no_urut' , $params['no_urut']);
        else
            $this->db->where('h.NO_BUKTI' , $params['no_bukti']);

        $this->db->select(
            'd.NO_URUT,
            h.*,
            h.NO_BUKTI as NO_BUKTI,
            h.KODE_SALES as KODE_SALES,
            h.KODE_WIL as KODE_WIL,
            w.NAWIL,
            s.NAMA,
            t.KET'
            );

        $this->db->join($this->prefix.'_SO..SOF05 t', 'h.SALES_TYPE = t.KODE', 'left');
        $this->db->join($this->prefix.'_AR..ARF10 w', 'h.KODE_WIL = w.WIL', 'left');
        $this->db->join($this->prefix.'_AR..ARF08 s', 'h.KODE_SALES = s.SLM', 'left');
        $this->db->join($this->prefix.'_SO..SOT01B d', 'd.NO_BUKTI = h.NO_BUKTI', 'left');
        $query = $this->db->get($this->prefix.'_SO..SOT01A h')->row();

        return $query;
    }

    function get_so_detail($params)
    {
        $this->db->select('
            d.*,
            b.*,
            d.SATUAN
            ');
        $this->db->join($this->prefix.'_ST..STF02 b', 'b.BRG = d.BRG', 'left');
        if ( isset($params['no_bukti']) )
        {
            $this->db->where('no_bukti', $params['no_bukti']);
            $query = $this->db->get($this->prefix.'_SO..SOT01B d')->result();
            return $query;
        }
        if ( isset($params['no_urut']) )
        {
            $this->db->where('no_urut', $params['no_urut']);
            $query = $this->db->get($this->prefix.'_SO..SOT01B d')->row();
            return $query;
        }
    }

    function _calculate_harga( &$params )
    {
        $user_info = $this->session->userdata('user_info');
        $username = $user_info->username;

        $get_tngkt_disc = $this->_get_tingkat_disc();

        $total_Disc = 0;
        $no_bukti = $params['NO_BUKTI'];
        $brg = $params['BRG'];
        $brg_cust = $params['BRG_CUST'];
        $h_satuan = $params['H_SATUAN'];
        $qty = $params['QTY'];
        $stn = $params['SATUAN'];
        $qty_kirim = 0;
        $qty_retur = 0;
        $disc1 = (double)$params['DISCOUNT'];
        $disc2 = (double)$params['DISCOUNT_2'];
        $disc3 = (double)$params['DISCOUNT_3'];
        $disc4 = (double)$params['DISCOUNT_4'];
        $disc5 = (double)$params['DISCOUNT_5'];
        $nilai_disc_1 = (double)$params['NILAI_DISC_1'];
        $nilai_disc_2 = (double)$params['NILAI_DISC_2'];
        $nilai_disc_3 = (double)$params['NILAI_DISC_3'];
        $nilai_disc_4 = (double)$params['NILAI_DISC_4'];
        $nilai_disc_5 = (double)$params['NILAI_DISC_5'];
        $catatan = $params['CATATAN'];
        $write_konfig = 0;

         $data = array(
            'no_bukti' => $no_bukti,
            'brg' => $brg,
            'brg_cust' => $brg_cust,
            'satuan' => $stn,
            'h_satuan' => $h_satuan,
            'qty' => $qty,
            'discount' => $disc1,
            'discount_2' => $disc2,
            'discount_3' => $disc3,
            'discount_4' => $disc4,
            'discount_5' => $disc5,
            'nilai_disc_1' => 0,
            'nilai_disc_2' => 0,
            'nilai_disc_3' => 0,
            'nilai_disc_4' => 0,
            'nilai_disc_5' => 0,
            'nilai_disc' => 0,
            'catatan' => $catatan,
            'qty_kirim' => $qty_kirim,
            'qty_retur' => $qty_retur,
            'write_konfig' => $write_konfig,
            'harga' => 0,
            'user_name' => $username
            );

        $tempBalance =
            $prevBalance = $h_satuan * $qty;

        $tingkat_disc = (int)$get_tngkt_disc->TINGKAT_DISC;

        if ($tingkat_disc >= 1) {
            if ($disc1 > 0) {
                $nilai_disc_1 = 0;
                $nilai_disc_1 = $prevBalance * ($disc1/100);
                $prevBalance = $nilai_disc_1;
                $total_Disc += $nilai_disc_1;
                $data['nilai_disc_1'] = $nilai_disc_1;
                $data['nilai_disc'] = $total_Disc;

            }
            else if (($disc1 == 0 || $disc1 == '') && (double)$nilai_disc_1 > 0) {
                $total_Disc += $nilai_disc_1;
                $prevBalance = $nilai_disc_1;
                $data['nilai_disc_1'] = $nilai_disc_1;
                $data['nilai_disc'] = $total_Disc;
            }
            else {
                $data['harga'] = $tempBalance - $total_Disc;
                return $data;
            }
        }

        if ($tingkat_disc >= 2) {
            if ($disc2 > 0) {
                $nilai_disc_2 = 0;
                $nilai_disc_2 = $prevBalance * ($disc2/100);
                $prevBalance = $nilai_disc_2;
                $total_Disc += $nilai_disc_2;
                $data['nilai_disc_2'] = $nilai_disc_2;
                $data['nilai_disc'] = $total_Disc;
            }
            else if (($disc2 == 0 || $disc2 == '') && (double)$nilai_disc_2 > 0) {
                $total_Disc += $nilai_disc_2;
                $prevBalance = $nilai_disc_2;
                $data['nilai_disc_2'] = $nilai_disc_2;
                $data['nilai_disc'] = $total_Disc;
            }
            else {
                $data['harga'] = $tempBalance - $total_Disc;
                return $data;
            }
        }

        if ($tingkat_disc >= 3){
            if ($disc3 > 0) {
                $nilai_disc_3 = 0;
                $nilai_disc_3 = $prevBalance * ($disc3/100);
                $prevBalance = $nilai_disc_3;
                $total_Disc += $nilai_disc_3;
                $data['nilai_disc_3'] = $nilai_disc_3;
                $data['nilai_disc'] = $total_Disc;
            }
            else if (($disc3 == 0 || $disc3 == '') && (double)$nilai_disc_3 > 0) {
                $total_Disc += $nilai_disc_3;
                $prevBalance = $nilai_disc_3;
                $data['nilai_disc_3'] = $nilai_disc_3;
                $data['nilai_disc'] = $total_Disc;
            }
            else {
                $data['harga'] = $tempBalance - $total_Disc;
                return $data;
            }
        }

        if ($tingkat_disc >= 4){
            if ($disc4 > 0) {
                $nilai_disc_4 = 0;
                $nilai_disc_4 = $prevBalance * ($disc4/100);
                $prevBalance = $nilai_disc_4;
                $total_Disc += $nilai_disc_4;
                $data['nilai_disc_4'] = $nilai_disc_4;
                $data['nilai_disc'] = $total_Disc;
            }
            else if (($disc4 == 0 || $disc4 == '') && (double)$nilai_disc_4 > 0) {
                $total_Disc += $nilai_disc_4;
                $prevBalance = $nilai_disc_4;
                $data['nilai_disc_4'] = $nilai_disc_4;
                $data['nilai_disc'] = $total_Disc;
            }
            else {
                $data['harga'] = $tempBalance - $total_Disc;
                return $data;
            }
        }

        if ($tingkat_disc >= 5){
            if ($disc5 > 0) {
                $nilai_disc_5 = 0;
                $nilai_disc_5 = $prevBalance * ($disc5/100);
                $prevBalance = $nilai_disc_5;
                $total_Disc += $nilai_disc_5;
                $data['nilai_disc_5'] = $nilai_disc_5;
                $data['nilai_disc'] = $total_Disc;
            }
            else if (($disc5 == 0 || $disc5 == '') && (double)$nilai_disc_5 > 0) {
                $total_Disc += $nilai_disc_5;
                $prevBalance = $nilai_disc_5;
                $data['nilai_disc_5'] = $nilai_disc_5;
                $data['nilai_disc'] = $total_Disc;
            }
            else {
                $data['harga'] = $tempBalance - $total_Disc;
                return $data;
            }
        }

        $data['harga'] = $tempBalance - $total_Disc;
        return $data;

    }

    function add_so_detail2($params, $id = null)
    {
        $message = '';
        if( $id )
        {
            $this->db->where('no_urut', $id);
            $bresult = $this->db->update($this->prefix.'_SO..SOT01B', $params);

            if( !$bresult )
                $message = lang('message_error_update');
        }
        else
        {
            return array(RETURN_iFLAG(false), null, lang('message_error_insert'));
        }

        return array($bresult, $id, $message);
    }

    function add_so_detail($params, $id = null)
    {
        unset($params['BRG_DESC']);
        unset($params['po_quantity']);
        unset($params['Price']);

        $message = '';

        $data = $this->_calculate_harga($params);

        if( $id )
        {
            //kalo ngupdate, $params['NO_URUT'] di unset
            unset($params['NO_URUT']);
            $this->db->where('no_urut', $id);
            $bresult = $this->db->update($this->prefix.'_SO..SOT01B', $data);

            if( !$bresult )
                $message = lang('message_error_update');
        }
        else
        {
            $bresult = $this->db->insert($this->prefix.'_SO..SOT01B', $data);
            $id = $this->db->insert_id();

            if( !$bresult )
                $message = lang('message_error_insert');
        }

        return array( $bresult, $id, $message );
    }

    function delete_so_dtl( $id )
    {
        $this->db->where('NO_URUT', $id);
        $query = $this->db->delete($this->prefix.'_SO..SOT01B');

        return $query;
    }

    function _get_tingkat_disc()
    {
        $this->db->select('TINGKAT_DISC');
        $query = $this->db->get($this->prefix.'_SI..SIFSYS')->row();
        return $query;
    }

    function get_so_sys()
    {
        return $this->db->get($this->prefix.'_SO..SOFSYS')->row();
    }

    function get_approval_db( $params )
    {
        $this->db->where('USERNAME' , $params['username'] );
        $this->db->limit(1);
        $this->db->order_by('APP_LEVEL DESC');

        $query = $this->db->get($this->prefix.'_SO..SOF02B')->row();

        return array( count( $query), $query);
    }

    function set_approve_oleh( $params, $id )
    {
        $this->db->where('NO_BUKTI', $id);
        $bresult = $this->db->update($this->prefix.'_SO..SOT01A', $params);

        if ($bresult) {
            $msg = lang('message_success_update');
        } else {
            $msg = lang('message_error_update');
        }

        return array( $bresult, $id, $msg );
    }

    function get_print_copies($params){
        $this->db->where('NO_BUKTI', $params['no_bukti']);
        $query = $this->db->get($this->prefix.'_SO..SOT01A')->row();
        return array($query->PRINT_COUNT, $query->STATUS);
    }

    function set_status_and_increment_print( $params )
    {
        if( isset($params['no_bukti']) ){
            list($temp_pc, $status) = $this->get_print_copies($params);
            $new_pc = $temp_pc + 1;  // mind the space beetwen plus sign :)

            if($status == '0' OR $status == null) {
                $data = array(
                    'STATUS' => 1,
                    'PRINT_COUNT' => $new_pc
                    );    
            } else {
                $data = array(
                    'PRINT_COUNT' => $new_pc
                    );
            }

            $this->db->where('NO_BUKTI', $params['no_bukti']);
            $bresult = $this->db->update($this->prefix.'_SO..SOT01A', $data);
        }
    }
}
