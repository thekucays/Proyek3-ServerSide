<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class So extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $flag = true;

        $this->load->model('model_so');
        $this->load->model('model_item');

        $this->valid = $this->session->userdata('is_authed');
        $this->lang->load('en','english');

        if ( !$this->valid )
        {
            redirect('user/login');
        }
        else
        {
            $user_info = $this->session->userdata('user_info');
            $this->is_admin = true;
            #if ( $user_info->user_type_id <= $BRANCH )
            #{
            #    $this->is_admin = true;
            #}
            #else
            #{
            #    $object = $this->uri->segment(1);
            #    $method = $this->uri->segment(2);

            #    $params = array(
            #        'user_id' => $user_info->id,
            #        'object' => $object,
            #        'method' => $method,
            #    );
            #    $acl = $this->app_model->acl($params);

            #    if ( $acl )
            #        $this->is_acl = true;
            #    else
            #        $flag = false;
            #}
        }

        #$params = array(
        #    'object' => &$this,
        #    'server' => &$_SERVER,
        #);

        #log_index($params);

        if ( !$flag )
        {
            $this->session->set_flashdata('flash_message', lang('message_ErrorAdminAccessRequired'));
            redirect('so/index');
        }
    }

    function index(){
        $listWilayah = $this->model_so->dropdown_wilayah_search();

        //$data = array();
        $data['wil'] = $listWilayah;
        $this->template2->write_view('content', 'so/list', $data);
        $this->template2->render();
    }

    // autocomplete generators//////////////////////////////////////////////////////////////////
    function customer_autocomplete(){
        $term = $this->input->post('term');

        $result = $this->model_so->customer_autocomplete($term);
        echo json_encode( $result );
        die();
    }
    function sales_autocomplete(){
        $term = $this->input->post('term');

        $result = $this->model_so->sales_autocomplete($term);
        echo json_encode( $result );
        die();
    }
    function wilayah_autocomplete(){
        $term = $this->input->post('term');

        $result = $this->model_so->wilayah_autocomplete($term);
        echo json_encode( $result );
        die();
    }
    // end of autocomplete generators///////////////////////////////////////////////////////////

    function list_data_ajax(){
        $data['records'] = $this->model_so->get_so_header_detail( $this->input->post());

        //Checking status approval
        foreach ( $data['records'] as &$detail ) {
            $detail->B_APP = $this->_str_status_approve_so( $detail );
        }

        die( $this->load->view('so/list_data_ajax', $data, TRUE));
    }

    function _str_status_approve_so( $params )
    {
        $B_APP = '';
        $validasi = IS_APPROVE($params->User_Approve);
        if($validasi == 'A') {
            $APP = 1;
            if(IS_APPROVE($params->USER_APPROVE_2) == 'A') {
                $APP = 2;
            }
            $B_APP = $validasi.'('.$APP.')';
            return $B_APP;
        }
    }

    // query ke tabel SIF02, buat ambil yang paling depan (heading) nya
    function _get_so_heading_number($type){
        $data = $this->model_so->_get_so_heading_number($type);  // buat SO, type nya 6
        return $data;
    }

    // generate nomor SO nya sebelum jalanin add_so_header()
    function _create_so_no($params, $urut , $mode = 0){
        $MONTH = 1;
        $YEAR = 2;
        $STRSEQ = 1;

        if( $mode == $STRSEQ )
            return sprintf('%04d', $urut);

        $heading = $this->_get_so_heading_number(6);          // buat SO, type nya 6
        //$heading = 'SOtes';
        $date = explode( "-", $params['TGL']);
        $popno = sprintf('%s%s%s%04d',
            $heading,
            substr($date[$YEAR],2,2), // get the last 2 digits
            $date[$MONTH],
            $urut
        );

        return $popno;
    }

    function add_so_header($urut=1){
        $save = $this->input->post('save');
        $SO_JENIS = 6; // hard-coded type SO (refer ke tabel SIF02)

        if( $save ){
            $this->db->trans_start();

            // buat sequence number nya dulu
            $_POST['so_jenis'] = $SO_JENIS;
            $_POST['so_name'] = 'SO';
            list($bresult, $urut, $message) = $this->model_so->process_sequence( $_POST );

            if( !$bresult )
            {
                $this->session->set_flashdata('error', $message);
                $this->_add_so_form();
                return;
            }
            unset($_POST['so_jenis']);
            unset($_POST['so_name']);

            // ambil user yang sedang login
            $user_info = $this->session->userdata('user_info');
            $username = $user_info->username;
            $_POST['USER_NAME'] = $username;

            // removing strseq and addding $_POST['NO_BUKTI'].. karena di tabel nama kolom nya NO_BUKTI
            //$_POST['strseq'] = $this->_create_so_no($_POST, $urut); //, $MODE_STRSEQ = 1);
            //$_POST['NO_BUKTI'] = $_POST['strseq'];
            $_POST['strseq'] = $this->_create_so_no($_POST, $urut, $MODE_STRSEQ = 1);
            $_POST['NO_BUKTI'] = $this->_create_so_no($_POST, $urut);
            unset( $_POST['strseq'] );

            // removing unnecessary $_POST[] values that doesn't exist in the table column
            unset( $_POST['NAMA_WILAYAH'] );
            unset( $_POST['NAMA_SALES'] );

            // TODO remove later.. hard-coded $_POST[] values, buat default value.. (sementara) 
            $_POST['status'] = 0;

            // converting to proper date format
            $_POST['TGL'] = formatdatemon($_POST['TGL']);
            $_POST['TGL_KIRIM'] = formatdatemon($_POST['TGL_KIRIM']);

            unset( $_POST['save'] );
            list($bresult, $id, $message) = $this->model_so->add_so_header( $_POST );

            if ( $bresult ){
                $this->db->trans_complete();
                redirect('so/add_so_detail/'.$id);
            }
            else
            {    
                $this->db->trans_rollback();
                $this->session->set_flashdata('error', $message);
            }
        }

        $this->_add_so_form();
    }

    function _add_so_form($params = array()){
        $data['customer'] = $this->model_so->dropdown_customer();
        $data['wilayah'] = $this->model_so->dropdown_wilayah();
        $data['kurs'] = $this->model_so->dropdown_kurs();
        $data['ntukar'] = $this->model_so->dropdown_ntukar();
        $data['sales_type'] = $this->model_so->dropdown_sales_type();

        $this->template2->write_view('content', 'so/form_so_header', $data);
        //$this->template2->write_view('content', 'so/form_so_header');
        $this->template2->render();
    }

    function _add_so_detail_form($params = array())
    {
        if( isset( $params['no_urut']) )
            $pparams = array('no_urut' => $params['no_urut']);
        else
            $pparams = array('no_bukti' => $params['so_header_id']);

        $data['tingkat_disc'] = $this->model_so->_get_tingkat_disc();
        $data['record_hdr'] = $this->model_so->get_so_header( $pparams );
        $data['kurs'] = $this->model_so->dropdown_kurs(); 
        $data['sales_type'] = $this->model_so->dropdown_sales_type();
        
        $dparams = array('no_bukti' => $data['record_hdr']->NO_BUKTI );
        $data['record_dtl'] = $this->model_so->get_so_detail( $dparams );

        $this->template2->write_view('content', 'so/form_so_detail', $data);
        $this->template2->render();
    }

    function add_so_detail($so_header_id)
    {
        $save = $this->input->post('submit_save');

        if ($save)
        {
            
        }

        $params = array('so_header_id' => $so_header_id);
        $this->_add_so_detail_form($params);
    }

    function add_so_detail_ajax()
    {
        $SUCCESS = 0;
        $ERROR = 1;

        $SUCCESS = 0;

        $record_hdr = $this->model_so->get_so_header( array('no_bukti' => $this->input->post('NO_BUKTI') ) );

        //***************************
        //VALIDATION
        if( $this->_is_so_approved( $record_hdr) )
        {
            $message = lang('ErrorTxApproved');
            die(sprintf('@@%s@@%s', 0, lang('ErrorTxApproved')) );
        }

        if( $this->_is_tx_canceled( $record_hdr) )
        {
            $message = lang('ErrorTxCanceled');
            die(sprintf('@@%s@@%s', 0, lang('ErrorTxCanceled') ));
        }
        //****************************


        list( $flag, $id, $message ) = $this->model_so->add_so_detail($this->input->post());
        $this->_process_total( $record_hdr->NO_BUKTI );    
        if( !$flag )
        {
            $SUCCESS = 1;
        }
        die(sprintf('@@%s@@%s', $flag, $message));
        // echo sprintf('@@%s@@%s', $flag, $message );

        // die(); 

        //redirect('so/add_so_detail');   
    }

    // header related
    function update_so_header(){
       $ERROR = 1;

        $id = $this->input->post('NO_BUKTI');
        unset( $_POST['NAMA_WILAYAH'] );
        unset( $_POST['NAMA_SALES'] );
        unset( $_POST['NO_URUT'] );

        //***************************
        //VALIDATION
        $record_hdr = $this->model_so->get_so_header(array('no_bukti' => $id));
        
        if( $this->_is_so_approved( $record_hdr) )
        {
            $message = lang('ErrorTxApproved');
            die(sprintf('@@%s@@%s', 0, lang('ErrorTxApproved')) );
        }

        if( $this->_is_tx_canceled( $record_hdr) )
        {
            $message = lang('ErrorTxCanceled');
            die(sprintf('@@%s@@%s', 0, lang('ErrorTxCanceled') ));
        }
        //****************************

        if( $id )
        {   
            //unset($_POST['strseq']);
            $_POST['TGL'] = formatdatemon( $_POST['TGL']);
            $_POST['TGL_KIRIM'] = formatdatemon( $_POST['TGL_KIRIM']);

            $this->model_so->add_so_header( $_POST , $id);
            die( sprintf('@@%s@@%s', $ERROR, lang('message_success_update')));
        }
        else
        {
            die( sprintf('@@%s@@%s', $ERROR, lang('message_ErrorIdIsNull')));
        } 
    }

    function update_so_detail( $no_urut )
    {
        $CANCEL = 2;
        $TUNDA = 3;
        $FLAG_ERROR = 0;
        $submit = $this->input->post('submit');

        if( $submit )
        {
            unset( $_POST['submit'] );

            // ********************
            // validation
            $record = $this->model_so->get_so_detail( array('no_urut' => $no_urut));
            $params = array('no_bukti' => $record->NO_BUKTI);
            $record_hdr = $this->model_so->get_so_header( $params );
            if( $this->_is_so_approved($record_hdr) OR $record_hdr->STATUS == $CANCEL OR $record_hdr->STATUS == $TUNDA )
            {
                die( sprintf('@@%s@@%s', $FLAG_ERROR, lang('ErrorTxLocked')));
            }

            if( $this->_is_tx_canceled( $record_hdr) )
                die( sprintf('@@%s@@%s', $FLAG_ERROR, lang('ErrorTxCanceled')));

            // ********************

            $this->model_so->add_so_detail( $this->input->post(), $no_urut);
            $this->_process_total($record_hdr->NO_BUKTI);
            
            die(sprintf('@@1@@%s', lang('message_success_update')));
        }
        //Get tingkat diskon
        $data['tingkat_disc'] = $this->model_so->_get_tingkat_disc();
        $params = array('no_urut' => $no_urut);
        $data['record'] = $this->model_so->get_so_detail( $params );

        $params = array('BRG' => $data['record']->BRG);
        $data['uoms'] = $this->model_item->uoms( $params );

        echo $this->load->view('so/form_so_detail_ajax', $data, TRUE);
        die();
    }

    function _is_so_approved( $record_hdr )
    {
        if( $record_hdr->User_Approve != '' )
            return True;
        else
            return False;
    }

    function _is_tx_canceled( $record_hdr )
    {
        $CANCEL = 2;
        if( $record_hdr->STATUS == $CANCEL )
        {
            return True;
        }
        else
        {
            return False;
        }
    }

    function delete_so_detail_ajax( $header_id, $detail_id )
    {
        $record = $this->model_so->get_so_header( array('no_bukti' => $header_id) );

        if ($this->_is_so_approved( $record )){
            echo sprintf('@@%s@@%s', 1, lang('ErrorTxApproved'));
            die();
        } else {
            $this->model_so->delete_so_dtl( $detail_id );
            $this->_process_total($record->NO_BUKTI);
        }

        echo sprintf('@@%s@@%s', 0, '');
        die();
    }

    function approve_header($no_bukti)
    {
        $org_id = $no_bukti;

        $this->_approve_header( $no_bukti );

        redirect('so/add_so_detail/'.$org_id);
    }

    function _approve_header($id)
    {
        $DEBUG = False;
        $DIRECTOR_ID = 15;
        $org_id = $id;
        $this->db->trans_begin();

        $hparams['no_bukti'] = $id;
        $record_hdr = $this->model_so->get_so_header( $hparams );
        $sofsys = $this->model_so->get_so_sys();
        $user_info = $this->session->userdata('user_info');

        $dbparams = array(
            'username' => $user_info->username,
//            'level' => 1,
        );
        list( $verified, $approvaldb) = $this->model_so->get_approval_db( $dbparams );

        if ( $verified == 0 )
            return array(false, 'Not Authorized');

        // validate 1st approval
        if( $record_hdr->User_Approve == '' and $approvaldb->APP_LEVEL >= 1)
        {
            $params = array(
                'User_Approve' => $user_info->username,
                'Date_Approve' => date('d-M-Y H:i:s'),
            );
            list( $flag, $id, $msg ) = $this->model_so->set_approve_oleh( $params , $id);

            if( $DEBUG )
                var_dump('APP 1', $this->db->last_query());
        }

        if( $record_hdr->User_Approve != '' )
        {
            //cast APPROVAL_SO to int
            $app_so = (int)$sofsys->APPROVAL_SO;
            if( $app_so >= 2 )
            {
                // if current user division is GA
                if( $approvaldb->APP_LEVEL >= 2 AND $record_hdr->USER_APPROVE_2 == '' )
                {
                    $params = array(
                        'USER_APPROVE_2' => $user_info->username,
                        'DATE_APPROVE_2' => date('d-M-Y H:i:s'),
                    );
                    list( $flag, $id, $msg ) = $this->model_so->set_approve_oleh( $params , $id);

                    if( $DEBUG )
                        var_dump('APP 2', $this->db->last_query());
                }
            }
        }
        
        if( $DEBUG )
            var_dump('Result flag', $flag );
        /*
        if( $flag == 0 )
            return array(false, lang('message_error_update').' APPROVE_OLEH');  
        */

        if( $flag == 0 )
        {
            $this->db->trans_rollback();
            return array(false, lang('message_error_update').' USER_APPROVE');
        }
        else
        {
            $this->db->trans_commit();
            return array(true, lang('message_success_update').' USER_APPROVE');
        }
    }

    function update_header_total($id)
    {
        $params = array('no_bukti' => $id );
        $submit = $this->input->post('submit');
        if( $submit )
        {
            unset( $_POST['submit']);

            $record = $this->model_so->get_so_header( array('no_bukti' => $id) );
            
            if( $this->_is_so_approved($record) )
            {
                die(lang('ErrorTxLocked'));
            }

            if( $this->_is_tx_canceled($record) )
            {
                die(lang('ErrorTxCancel'));
            }

            if ($_POST['DISCOUNT'] > 0) {
                $_POST['NILAI_DISC'] = 0;
                $_POST['NILAI_DISC'] = $_POST['BRUTO'] * ($_POST['DISCOUNT']/100);
            }
            else if (($_POST['DISCOUNT'] == 0 || $_POST['DISCOUNT'] == '') && $_POST['NILAI_DISC'] > 0)
            {
                $_POST['NILAI_DISC']  = $_POST['NILAI_DISC'];
            } 


            $tmp   = $_POST['BRUTO'] - $_POST['NILAI_DISC'];
            $_POST['NILAI_PPN'] = $tmp * $_POST['PPN'] / 100;
            $_POST['NETTO'] = $tmp + $_POST['NILAI_PPN'];
            
            
            $this->model_so->add_so_header( $this->input->post(), $id );
        }

        $data['record'] = $this->model_so->get_so_header( $params );
        echo $this->load->view('so/form_update_header_total', $data, True);
        die();
    }

    function _process_total( $no_bukti )
    {
        $record_hdr = $this->model_so->get_so_header(array('no_bukti' => $no_bukti ));
        $records = $this->model_so->get_so_detail(array('no_bukti' => $no_bukti ));

        $total = 0;
        foreach( $records as $rec )
        {
            $total += $rec->HARGA;
//            echo $rec->ITEM_NO." ".$total."<br/>\n";
        }

        $record_hdr->BRUTO = $total;
        $record_hdr->NILAI_DISC = $record_hdr->BRUTO * ($record_hdr->DISCOUNT/100);
        $after_disc = $record_hdr->BRUTO - $record_hdr->NILAI_DISC ;

        if( $record_hdr->PPN == 0 AND $record_hdr->NILAI_PPN == 0)
            $record_hdr->PPN = 10;

        $record_hdr->NILAI_PPN = $after_disc * ($record_hdr->PPN/100);
        $record_hdr->NETTO = $after_disc + $record_hdr->NILAI_PPN;

        $sparams = (array)$record_hdr;//die(var_dump($sparams, $total));
        //var_dump($params);
        unset($sparams['NO_BUKTI']);
        unset($sparams['NAMA']);
        unset($sparams['NAWIL']);
        unset($sparams['NO_URUT']);
        unset($sparams['TGL']);
        unset($sparams['TGL_KIRIM']);
        unset($sparams['TGL_INPUT']);
        unset($sparams['Date_Approve']);
        //$sparams['TGL'] = formatdatemon(DATE_FORMAT_($record_hdr->TGL));

        $this->model_so->add_so_header( $sparams, $record_hdr->NO_BUKTI );//die('tes 2');
    }

    function excel_recap_data(){
        $records = $this->model_so->get_so_header_detail( $this->input->post());

        foreach ($records as &$detail){
            $detail->B_APP = $this->_str_status_approve_so($detail);
        }

        $this->load->library('pexcel');
            // Create new PHPExcel object
        $sheet = new PHPExcel();

            // Set document properties
        $sheet->getProperties()->setCreator("MKD.JuiceBoxV2")
        ->setTitle("Office 2007 XLSX User Document")
        ->setSubject("Office 2007 XLSX User Document")
        ->setDescription("User document for Office 2007 XLSX")
        ->setKeywords("office 2007")
        ->setCategory("Recap");

            // Add some data
        $sheet->setActiveSheetIndex(0)
        ->setCellValue('A2', 'NO')
        ->setCellValue('B2', 'NO. BUKTI')
        ->setCellValue('C2', 'TANGGAL')
        ->setCellValue('D2', 'TANGGAL KIRIM')
        ->setCellValue('E2', 'STATUS')
        ->setCellValue('F2', 'NO. PO. CUSTOMER')
        ->setCellValue('G2', 'NAMA CUSTOMER')
        ->setCellValue('H2', 'VALUTA/KURS')
        ->setCellValue('I2', 'KETERANGAN')
        ->setCellValue('J2', 'TANGGAL INPUT')
        ->setCellValue('K2', 'APPROVE');

        $sheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $sheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $sheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $sheet->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $sheet->getActiveSheet()->getColumnDimension('E')->setWidth(5);
        $sheet->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        $sheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);
        $sheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $sheet->getActiveSheet()->getColumnDimension('I')->setWidth(25);
        $sheet->getActiveSheet()->getColumnDimension('J')->setWidth(25);
        $sheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);

        $no = 1;
        $i = 3;
        foreach ($records as $record):
            $sheet->setActiveSheetIndex(0)
                ->setCellValue("A$i", $no)
                ->setCellValue("B$i", $record->NO_BUKTI)
                ->setCellValue("C$i", DATE_FORMAT_($record->TGL))
                ->setCellValue("D$i", DATE_FORMAT_($record->TGL_KIRIM))
                ->setCellValue("E$i", $record->STATUS)
                ->setCellValue("F$i", $record->NO_PO_CUST)
                ->setCellValue("G$i", $record->NAMA_CUST)
                ->setCellValue("H$i", $record->VLT)
                //->setCellValue("H$i", ITEM_UOM( $record->UNIT_CODE, $record->STN, $record->STN2 ))
                ->setCellValue("I$i", $record->KET)
                ->setCellValue("J$i", DATE_FORMAT_($record->TGL_INPUT))
                ->setCellValue("K$i", $record->B_APP);
            $i++; $no++;
        endforeach;

            // Rename worksheet (worksheet, not filename)
        $sheet->getActiveSheet()->setTitle('sheet1');


            // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $sheet->setActiveSheetIndex(0);

            //this is the header given from PHPExcel examples. but the output seems somewhat corrupted in some cases.
            //header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            //so, we use this header instead.
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="recap.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($sheet, 'Excel2007');
        $objWriter->save('php://output');
//        die( $this->load->view('pb/list_data_ajax', $data, TRUE));
        die();
    }

    // alamat customer
    function search(){
        $term['term'] = $this->input->post('term');
        $term['cust_id'] = $this->input->post('cust_id');
        $term['limit'] = 50;

        //if( strlen( $type ) )
          //  $params['type'] = $type;

        $data['records'] = $this->model_so->alamat_autocomplete($term);
        die( $this->load->view('so/search-alamat', $data, TRUE) );
    }

    //function save_new_alamat($al, $al1, $al2, $al3){
    function add_new_address(){
        //$params = array('po_no' => $po_no );
        $params['AL'] = $this->input->post('al_sif');
        $params['AL1'] = $this->input->post('al1_sif');
        $params['AL2'] = $this->input->post('al2_sif');
        $params['AL3'] = $this->input->post('al3_sif');
        $params['CUST'] = $this->input->post('cust_id');

        // generate KODE nya dulu
        $params['KODE'] = $this->model_so->get_next_address_code($this->input->post('cust_id'));

        $submit = $this->input->post('submit');
        $msg = 'Ok';
        if( $submit )
        {
            unset( $_POST['submit']);
            $result = $this->model_so->add_new_address($params);
            //var_dump($result);
        }
        /*$data['record_note'] = $this->model_po->get_po_notes( $params );
        echo $this->load->view('po/form_notes', $data, True);
        die($msg); */
    }

    function voucher($id) 
    {
        $data = array();
        $params = array('no_bukti' => $id);

        // update status menjadi 1 (udah pernah di-print).. baru ambil data nya
        $this->model_so->set_status_and_increment_print($params);
        $data['record_hdr'] = $this->model_so->get_so_header( $params );

        $params = array('no_bukti' => $data['record_hdr']->NO_BUKTI);
        $data['record_dtl'] = $this->model_so->get_so_detail( $params );
        //Sending print out to html
        // $this->template2->write_view('content','so/voucher', $data);
        // $this->template2->render();
        $htmlvoucher = $this->load->view('so/voucher', $data, TRUE);
        //echo $htmlvoucher;
        require_once(APPPATH.'third_party/html2pdf/html2pdf.class.php');
        try
        {
            $html2pdf = new HTML2PDF('P', 'A4', 'en');
            $html2pdf->writeHTML($htmlvoucher);
//            $html2pdf->Output('pb-voucher.pdf','I'); // D->Download, I->Include? :P
            $html2pdf->Output('so-voucher.pdf','D');
        }
        catch(HTML2PDF_exception $e) {
            echo $e;
            exit;
        }
        die();
    }

    function cancel( $id )
    {
        $CANCEL = 2;
        $TUNDA = 3;

        $params = array('no_bukti' => $id);
        $record_hdr = $this->model_so->get_so_header( $params );

        if( $record_hdr->STATUS == $CANCEL OR $record_hdr->STATUS == $TUNDA )
        {
            die(sprintf('@@%s@@%s', 1, lang('ErrorTxIsCancel')));
        }

        $params = array(
            'status' => $CANCEL,
        );

        $this->model_so->add_so_header($params, $id);

        die();
    }
}