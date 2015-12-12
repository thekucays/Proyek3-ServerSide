<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/
define("_NUMBER_USD",                   0);
define("_NUMBER_USD_FIX",               3);
define("_NUMBER_IDR",                   1);
define("_NUMBER_RUPIAH",                1);
define("_NUMBER_FLOAT",                 2);

define("_DEFAULT_SEPARATOR",            '@@');

function ISSET_($str, $default = '' )
{
    if( !isset($str) )
        return $default;
    else
        return $str;
}

function IS_NULL_($str, $default )
{
    if( is_null($str) )
        return $default;
    else
        return $str;
}

function GROUP_VALUE( $current, $previous, $value )
{
    if( $current == $previous )
        return array( null, $previous);
    else
        return array( $value, $current);
}

function ITEM_UOM( $unit, $stn, $stn2 )
{
    $KECIL = 1;
    $BESAR = 2;

    if( $unit == $KECIL )
        $unitname = $stn;
    else if( $unit == $BESAR )
        $unitname = $stn2;
    else
        $unitname = 'Err';

    return $unitname;
}

function PO_JENIS( $jenis_id = '')
{
    switch( $jenis_id )
    {
        case 1:
            return 'Local';

        case 2:
            return 'Import';

        case 3:
            return 'Inventory';

        case 4:
            return 'Other';

        default:
            return 'N/A';
    }
}

function numberFormat($number, $type = _NUMBER_USD, $float = 2)
{
    switch($type){

      case _NUMBER_USD:

        return @number_format($number,2,".",",");

      case _NUMBER_USD_FIX:

        return @number_format($number,0,".",",");

      case _NUMBER_RUPIAH:

        return @number_format($number,2,",",".");

      case _NUMBER_FLOAT:

        return @number_format($number,$float,".",",");

      default:

    }
}

function formatdatemon( $strdate )
{
    if( $strdate )
    {
        $strdate = reverseDate( $strdate );
        $strdate = date('d-M-Y', strtotime( $strdate ) );
    }

    return $strdate;
}


function reverseDate2( $strdate )
{
    $buffer = explode( '-' , $strDate );
    $first = $buffer[2];
    $mid = $buffer[1];
    $last = $buffer[0];

    return date('d-M-Y', mktime(0,0,0, $mid, $last, $first) );
}

function reverseDate($strDate)
{
    if ( $strDate )
    {
        $buffer = explode( '-' , $strDate );
        $first = $buffer[2];
        $mid = $buffer[1];
        $last = $buffer[0];

        return $first.'-'.$mid.'-'.$last;
    }
    else
    {
        return $strDate;
    }
}

function TX_STATUS( $int )
{
    switch( $int)
    {
        case '':
        case 0:
            return 'Input';

        case 1:
            return 'Printed';

        case 2:
            return 'Batal/Cancel';

        case 3:
            return 'Tunda';

        default:
            return 'ERR';
    }
}

function IS_CANCEL( $istatus, $str )
{
    $CANCEL = 2;
    if( $istatus == $CANCEL )
    {
        return '';
    }
    else
    {
        return $str;
    }
}

function IS_APPROVE( $str, $mode = 'abbreviation')
{
    if( $str != '' )
    {
        if ($mode == 'abbreviation' )
            return 'A';
        else
            return $str;
    }
    else
    {
        if ($mode == 'abbreviation' )
            return 'N';
        else
            return '';
    }
}
function UPDATE_iFLAG( $flag )
{
    if( $flag )
        return lang("message_success_update");
    else
        return lang('message_error_update');
}

function INSERT_iFLAG( $flag )
{
    if( $flag )
        return lang("message_success_insert");
    else
        return lang('message_error_insert');
}

function DATE_FORMAT_( $strdate_db = null, $strdate_direct = null)
{
    if( $strdate_db )
    {
        if( preg_match('/1900/', $strdate_db))
            return null;

        return date( 'd-m-Y', strtotime( $strdate_db) );
    }

    if( $strdate_direct )
    {
        if( preg_match('/1900/', $strdate_direct))
            return null;

        return date( 'd-m-Y', strtotime( $strdate_direct) );
    }

    return null;
}

function IS_DATE_( $str )
{
    $sz = explode('-', $str);

    if( $sz >= 3 )
        return True;

    $sz = explode('/', $str);

    if( $sz >= 3 )
        return True;

    return False;
}

function DUE_DATE_BASED_TERM_( $strdate, $termday)
{
    // @todo validate if month in string
    // yes then convert to int
    $DATE_DAY = 0;
    $DATE_MONTH = 1;
    $DATE_YEAR = 2;

    $buffer  = explode("-",$strdate);

    $newDate = $buffer[$DATE_DAY]+ $termday;

    $dueDate = date("d-M-Y",mktime(0,0,0,
                                $buffer[$DATE_MONTH],
                                $newDate,
                                $buffer[$DATE_YEAR]));

    return $dueDate;
}

function STROFYESNO( $int )
{
    if( $int == 1 )
        return 'Y';
    else
        return 'N';
}

// @var strdate is mm-YYYY
function COMPILE_iFIRSTDATE( $strdate )
{
    $MONTH = 0;
    $YEAR = 1;

    $buffer = explode('-', $strdate);

    return mktime(0,0,0, $buffer[$MONTH], 1 , $buffer[$YEAR]);
}

// @var strdate is mm-YYYY
function COMPILE_iLASTDATE( $strdate )
{
    $MONTH = 0;
    $YEAR = 1;

    $buffer = explode('-', $strdate);

    return mktime(0,0,0, $buffer[$MONTH] + 1, 0 , $buffer[$YEAR]);
}

function DB_QUERY(&$CI_Object, $query)
{
    if( $CI_Object->db->dbdriver == 'sqlsrv' )
        return sqlsrv_query( $CI_Object->db->conn_id, $query );
    else
        return mssql_query( $query );
}

function DB_FREE_RESULT(&$CI_Object, $res )
{
    if( $res )
    {
        if( $CI_Object->db->dbdriver == 'sqlsrv' )
            return sqlsrv_free_stmt( $res );
        else
            return mssql_free_result( $res );
    }
    else
    {
        // Do nothing
    }
}

function RETURN_iFLAG( $bool )
{
    if($bool)
        return 1;
    else
        return 0;
}

/**
 * @var $params     array   consits of $params['date'], $params['tag']
 *                          $params['date'] format is dd-mm-YYYY
 * @var $urut       int
 * @var $mode       int
 */
function CREATE_SEQNO($params, $urut, $mode = 0)
{
    $MONTH = 1;
    $YEAR = 2;
    $STRSEQ = 1;

    if( $mode == $STRSEQ )
        return sprintf('%04d', $urut);

    $date = explode( "-", $params['date']);
    $seqno = sprintf('%s%s%s%04d',
        $params['tag'],
        substr($date[$YEAR],2,2), // get the last 2 digits
        $date[$MONTH],
        $urut
    );

    return $seqno;
}

function IS_INV_NONINV($int)
{
    if( $int )
        return 'INV';
    else
        return 'N-INV';
}
/* End of file hooks.php */
/* Location: ./application/config/hooks.php */
