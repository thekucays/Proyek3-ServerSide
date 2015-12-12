<?php
$po_no = null;
//var_dump( $records );
?>
<style>
label:first-child {width: 80px;}
.ui-autocomplete { z-index: 2147483647 !important;}
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1><?php echo "Kendaraan" ?></h1>

    <div class="row col-lg-12">
        <a href="<?php echo base_url('kendaraan/addKendaraan') ?>" class="btn btn-primary"><i class="fa fa-plus"><?php echo lang('AddNew') ?></i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="row col-lg-6">
        <form name="search_form" id="search_form">
            <legend>Search</legend>
            <div class="form-inline">
                <label class=""> Jenis Kendaraan </label>
                <input class="" name="jenis" />
            </div>
            <div class="row">&nbsp;</div>
            <button class="btn btn-primary searchdata"><?php echo lang('label_search') ?></button>
        </form>
    </div>
    <div class="row">&nbsp;</div>
    <div>&nbsp;</div>
    <div class="row datacontainer">

    </div>
</div>

<!-- <div class="excelrecap_frame hide"></div> -->

<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>

<script>
$.ajaxSetup({cache: false, async: false});
$(document).ready(function(){

    $(".searchdata").click(function(event){

        event.preventDefault();
        $.ajax({
            url : "<?php echo base_url('kendaraan/list_data_ajax') ?>",
            data : $("form[name='search_form']").serialize(),
            type : "POST",
            success : function(msg){
                $(".datacontainer").html(msg);
            }
        });
    });
});

$("body").on("click",".bulkapprove_submit", function(event){

    event.preventDefault();

    $.ajax({
        url : "<?php echo base_url('so/pending_list') ?>",
        type: "POST",
        data : $(".bulkcommitform").serialize() + "&submit=1",
        success : function(msg){

            $(".bulkapprovalmodal").modal('hide');
        }
    });
});
</script>
