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
    <h1><?php echo lang('label_so') ?></h1>

    <div class="row col-lg-12">
        <a href="<?php echo base_url('so/add_so_header') ?>" class="btn btn-primary"><i class="fa fa-plus"><?php echo lang('AddNew') ?></i></a>
        <a href="<?php echo base_url('so/preferences') ?>" class="btn btn-primary"><i class="fa fa-cog"><?php echo lang('Preferences') ?></i></a>
        <a href="<?php echo base_url('so/pending_list') ?>" class="btn btn-primary bulkapproval"><i class="fa fa-check"> Bulk Approval</i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="row col-lg-6">
        <form name="search_form" id="search_form">
            <legend>Search</legend>
            <div class="form-inline">
                <label class="" ><?php echo lang('label_datefrom') ?></label>
                <input class="" name="datefrom" id="date" />
                <label class=""><?php echo lang('label_dateto') ?></label>
                <input class="" name="dateto" id="date" />
            </div>

            <!--<div class="form-inline">
                <label class="">
                    <?php //echo lang('label_itemno') ?>
                    <a class="fa fa-folder-open"> </a>
                    </label>
                <input class="" name="item_no"/>
                <input class="" style="width:210px;" name="itemdescription"/>
            </div> -->

            <div class="form-inline">
                <label class=""> <?php echo lang('NoSO') ?> <!--No. Bukti--></label>
                <input class="" name="NO_BUKTI"/>
            </div>
             <div class="form-inline">
                <label class=""><?php echo lang('label_po_no') ?></label>
                <input class="" name="NO_PO_CUST"/>
            </div>
            <div class="form-inline">
                <label class="">
                    <?php echo lang('label_itemno') ?>
                    <a class="fa fa-folder-open item_select"> </a>
                    </label>
                <input class="" name="item_no"/>
                <input class="" style="width:210px;" name="item_description"/>
            </div>

            <!-- <div class="form-inline">
                <label class=""><?php //echo lang('Customer') ?></label>
                <input class="" name="NAMA_CUST"/>
            </div> -->
            <div class="form-inline">
                <label><?php echo lang('Customer') ?></label>
                <input class="" name="customer_code" />
                <input style=" width:210px;" name="customer_name" readonly />
            </div>

            <div class="form-inline">
                <label class=""><?php echo lang('label_so_area_code') ?></label>
                <?php 
                    echo form_dropdown("KODE_WIL", $wil, null, "class='form-control'");
                ?>
            </div>
            <div class="form-inline">
                <label class=""><?php echo lang('Sales') ?></label>
                <input class="" name="sales_code">
                <input style=" width:210px;" name="sales_name" readonly />
            </div>

            <div class="row">&nbsp;</div>
            <button class="btn btn-primary searchdata"><?php echo lang('label_search') ?></button>
            <button class="btn btn-primary recapdata"><?php echo lang('label_recap') ?></button>
            <button class="btn btn-primary excelrecap"><?php echo lang('label_excel') ?></button>
        </form>
    </div>
    <div class="row">&nbsp;</div>
    <div>&nbsp;</div>
    <div class="row datacontainer">

    </div>
</div>

<div class="bulkapprovalmodal modal fade"> </div>

<div class="item_selection modal fade">
    <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('label_itemname') ?></h4>
            </div>
            <div class="modal-body">
                <div class="col-lg-12">
                    <label><?php echo lang('label_search') ?></label>
                    <input class="form-control searchitem" />
                    <div>&nbsp;</div>
                    <input type="submit" class="btn btn-primary submitsearchitem" />
                </div>
                <div>&nbsp;</div>
                <div class="col-lg-12 item_list">

                </div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- <div class="excelrecap_frame hide"></div> -->

<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>

<script>
$.ajaxSetup({cache: false, async: false});
$(document).ready(function(){

    jQuery( "[name='sales_code']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          jQuery.ajax({
              url : "<?php echo base_url('so/sales_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              data : "term=" + jQuery("[name='sales_code']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {

          jQuery("[name='sales_code']").val(ui.item.SLM);
          jQuery("[name='sales_name']").val(ui.item.NAMA);

          /*if( jQuery("[name='sales_code']").val() == UMUM )
          {
              jQuery("[name='supplier_name']").removeAttr('readonly');
          }
          else
          { */
              jQuery("[name='sales_name']").attr('readonly','readonly');
          //}
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.SLM + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };
    jQuery( "[name='sales_code']" ).bind('input propertychange', function(){
        //console.log("I'm changing");
        jQuery("[name='sales_name']").val('');
    });

    jQuery( "[name='customer_code']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          jQuery.ajax({
              url : "<?php echo base_url('so/customer_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              data : "term=" + jQuery("[name='customer_code']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {
          jQuery("[name='customer_code']").val(ui.item.CUST);
          jQuery("[name='customer_name']").val(ui.item.NAMA);

          if( jQuery("[name='customer_code']").val() == UMUM )
          {
              jQuery("[name='customer_name']").removeAttr('readonly');
          }
          else
          {
              jQuery("[name='customer_name']").attr('readonly','readonly');
          }
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.CUST + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };


    // item related
    $(".excelrecap").click(function(event){
        event.preventDefault();
        $("#search_form").attr("action", "<?php echo base_url('so/excel_recap_data') ?>").attr("method", "post");
        $("#search_form").submit();
    });

    $(".item_select").click(function(event){
        event.preventDefault();
        $(".item_selection").modal('show');
    });
    $(".submitsearchitem").click(function(event){
        $(".item_list").load("<?php echo base_url('item/search/') ?>",{term: $(".searchitem").val()});
    });
    $(".item_list").on("click","a", function(event){
        event.preventDefault();

        var CODE = 0,
            DESC = 1,
            UOMS = 2;

        var msg = $(this).attr('href').split('@@');

        $("[name='item_no']").val(msg[CODE]);
        $("[name='item_description']").val(msg[DESC]);
    });
    jQuery( "[name='item_no']" ).bind('input propertychange', function(){
        //console.log("I'm changing");
        jQuery("[name='item_description']").val('');
    });


    $(".searchdata").click(function(event){

        event.preventDefault();
        $.ajax({
            url : "<?php echo base_url('so/list_data_ajax') ?>",
            data : $("form[name='search_form']").serialize(),
            type : "POST",
            success : function(msg){
                $(".datacontainer").html(msg);
            }
        });
    });

    $(".recapdata").click(function(event){

        event.preventDefault();
        $.ajax({
            url : "<?php echo base_url('so/recap_data_ajax') ?>",
            data : $("form[name='search_form']").serialize(),
            type : "POST",
            success : function(msg){
                $(".datacontainer").html(msg);
            }
        });
    });

    $(".bulkapproval").click(function(event){

        event.preventDefault();

        $(".bulkapprovalmodal").load("<?php echo base_url('so/pending_list') ?>");
        $(".bulkapprovalmodal").modal("show");
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

// $(".excelrecap").click(function(event){

//     event.preventDefault();
//     $(".excelrecap_frame").html('<iframe src="<?php echo  base_url('so/excel_recap_data')?>"></iframe>');
// });
</script>
