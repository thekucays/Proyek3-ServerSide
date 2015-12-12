<style>
.ui-autocomplete { z-index: 2147483647 !important;}
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1><?php echo lang('label_so') ?></h1>

    <div class="row col-lg-12">
        <a href="<?php echo base_url('so/index') ?>" class="btn btn-primary"><i class="fa fa-file"> List</i></a>
        <a href="<?php echo base_url('so/preferences') ?>/<?php echo $record_hdr->NO_BUKTI ?>" class="btn btn-primary"><i class="fa fa-cog"><?php echo lang('Preferences') ?></i></a>
        <a href="<?php echo base_url('so/approve_header') ?>/<?php echo $record_hdr->NO_BUKTI ?>" class="btn btn-primary submitapproveheader"><i class="fa fa-check"> <?php echo lang('label_approve') ?></i></a>
        <a href="<?php echo base_url('so/voucher') ?>/<?php echo $record_hdr->NO_BUKTI ?>" class="btn btn-primary voucher"><i class="fa fa-file"> <?php echo lang('Voucher') ?></i></a>
        <a href="<?php echo $record_hdr->NO_BUKTI ?>" class="btn btn-primary cancel"><i class="fa fa-close"> <?php echo lang('label_cancel') ?></i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
<?php if( empty( $record_hdr)): ?>
    <b class="error">Error: SO Header BLANK</b>
<?php else: ?>
    <div class="row">
        <form class="form" action="<?php echo base_url('so/add_so_header') ?>" method="post" name="header_form">
        <div class="col-lg-6">
            <label><?php echo lang('NoSO') ?></label>
            <div class="row">
                <!--<div class="col-xs-2">
                    <?php //echo form_dropdown('tag', $tags, null, 'class="form-control"'); ?>
                </div> -->
                <div class="col-xs-12">
                    <input class="form-control " name="NO_BUKTI" value="<?php echo $record_hdr->NO_BUKTI ?>" readonly />
                    <!-- <input class="form-control" type="hidden" name="NO_BUKTI" value="<?php echo $record_hdr->NO_BUKTI ?>" /> -->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('label_date') ?></label>
            <input class="form-control date" name="TGL" value="<?php echo DATE_FORMAT_($record_hdr->TGL) ?>" />
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('label_delivery_date') ?></label>
            <input class="form-control date" name="TGL_KIRIM" value="<?php echo DATE_FORMAT_($record_hdr->TGL_KIRIM) ?>" />
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('NoPoCustomer') ?></label>
            <input class="form-control" name="NO_PO_CUST" value="<?php echo $record_hdr->NO_PO_CUST ?>" />
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('Customer') ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="CUST" value="<?php echo $record_hdr->CUST ?>" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_CUST" value="<?php echo $record_hdr->NAMA_CUST ?>" readonly />
                </div>
            </div>
        </div>

        <!-- ASK -->
        <div class="col-lg-6">
            <label><?php echo lang("label_term") ?></label>
            <div class="row">
                <div class="col-xs-12">
                    <input class="form-control " name="TERM" value="<?php echo $record_hdr->TERM ?>" readonly />
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <label><?php echo lang('label_actkirim') ?></label>
            <input class="form-control" name="TIPE_KIRIM" value="<?php echo $record_hdr->TIPE_KIRIM ?>" readonly />
        </div>

        <div class="col-lg-12">
            <label><?php echo lang('Address') ?></label>
            <textarea class="form-control" rows="3" name="AL_CUST"><?php echo $record_hdr->AL_CUST ?></textarea>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('Currency') ?></label>
            <div class="row">
                <div class="col-xs-4">
                    <?php
                    echo form_dropdown("VLT" , $kurs, $record_hdr->VLT, "class='form-control'");
                    ?>
                </div>
            </div>
            <label><?php echo lang('label_so_wil') ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="KODE_WIL" value="<?php echo $record_hdr->KODE_WIL ?>" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_WILAYAH" value="<?php echo $record_hdr->NAWIL ?>" readonly />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang('Sales') ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="KODE_SALES" value="<?php echo $record_hdr->KODE_SALES ?>" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_SALES" value="<?php echo $record_hdr->NAMA ?>" readonly />
                </div>
            </div>
            <label><?php echo lang("sales_type") ?></label>
            <div class="row">
                <div class="col-xs-12">
                    <!-- <input class="form-control" name="KODE" /> -->
                    <?php echo form_dropdown('SALES_TYPE', $sales_type, $record_hdr->SALES_TYPE, 'class="form-control"'); ?>
                </div>
                <!-- <div class="col-xs-9">
                    <input class="form-control " name="KET" readonly />
                </div> -->
            </div>
        </div>
        <div class="col-lg-12">
            <label><?php echo lang('label_remark') ?></label>
            <textarea class="form-control" rows="3" name="KET"><?php echo $record_hdr->KET ?></textarea>
        </div>

        <div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
        <div class="col-lg-12 form-inline">
            <!--<input type="submit" name="button_update_header" value="<?php echo lang('button_save') ?>" class="btn btn-primary" /> -->
            <button class="btn btn-primary" name="button_update_header"><?php echo lang('label_update') ?></button>
            &nbsp;&nbsp;
            <label class="form-horizontal" > <?php echo lang('NoSO') ?> <!--No. Bukti --></label>
            <input class="form-control form-horizontal" name="NO_BUKTI" value="<?php echo $record_hdr->NO_BUKTI ?>" readonly />
            <label class="form-horizontal" ><?php echo lang('label_approve') ?></label>
            <input class="form-control form-horizontal" name="APPROVE_1" value="<?php echo $record_hdr->User_Approve ?>" readonly />
            <label class="form-horizontal" ><?php echo lang('label_approve') ?> 2</label>
            <input class="form-control form-horizontal" name="APPROVE_2" value="<?php echo $record_hdr->USER_APPROVE_2 ?>" readonly />
            <span id="header_form_status"></span>
        </div>
    </form>
    </div>
    <div>&nbsp;</div>
    <div class="row col-lg-12">
        <table class="table">
            <th> <?php echo lang('label_action') ?> <!-- Action --> </th>
            <th> <?php echo lang('label_itemno') ?> </th>
            <th> <?php echo lang('label_itemname') ?> </th>
            <th> <?php echo lang('label_qty') ?> </th>
            <th> <?php echo lang('label_unitprice') ?></th>
            <th> <?php echo lang('label_discprice') ?></th>
            <th> <?php echo lang('label_price') ?></th>
            <th> <?php echo lang('label_uom') ?> </th>
            <th> <?php echo lang('label_remark') ?> </th>
            <?php if( !empty( $record_dtl)) : ?>
            <?php foreach( $record_dtl as $iRow => $detail ): ?>
            <tr>
                <td>
                    <a href="<?php echo $detail->NO_URUT ?>" class="fa fa-pencil editdetail" style="color:green;"> </a>
                    <a href="<?php echo $detail->NO_BUKTI. '/' .$detail->NO_URUT ?>" class="fa fa-remove deletedetail" style="color:red;"> </a>
                </td>
                <td><?php echo $detail->BRG ?></td>
                <td><?php echo $detail->NAMA ?></td>
                <td><?php echo $detail->QTY ?></td>
                <td><?php echo number_format($detail->H_SATUAN) ?></td>
                <td><?php echo number_format($detail->NILAI_DISC) ?></td>
                <td><?php echo number_format($detail->HARGA) ?></td>
                <td>
                    <?php echo ITEM_UOM( $detail->SATUAN, $detail->STN, $detail->STN2 ); ?>
                </td>
                <td><textarea class="form-control" rows="2"><?php echo $detail->CATATAN ?></textarea></td>
            </tr>
            <!--<tr>
                <td colspan="2" align="right"> Alias : </td>
                <td colspan="6"> <textarea class="form-control"><?php echo $detail->BRG_CUST ?></textarea> </td>
            </tr>-->
            <?php endforeach; ?>
            <?php endif; ?>
        </table>
        <div class="col-lg-12">&nbsp;</div>
        <div class="col-lg-12 editdetail_pan">
            <form name="form_submit" method="POST" role="form" class="form-horizontal">
                <h4><?php echo lang('label_so_detail') ?></h4>
                <div class="modal-error error"></div>
                <input type="hidden" name="NO_BUKTI" value="<?php echo $record_hdr->NO_BUKTI ?>" />
                <div class="col-lg-12">
                    <label><?php echo lang('label_itemname') ?></label>
                    <div class="row">
                        <div class="col-xs-1" style="width:10px;">
                            <a href="" class="fa fa-folder-open fa-fw item_select"> </a>
                        </div>
                        <div class="col-xs-4">
                            <input class="form-control" name="BRG" />
                        </div>
                        <div class="col-xs-7 col-fit">
                            <input class="form-control" name="BRG_DESC" />
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-12">
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Alias</label>
                            <textarea class="form-control" name="BRG_CUST"></textarea>        
                        </div>
                    </div>
                </div>-->
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-xs-2">
                            <label><?php echo lang('label_uom') ?></label>
                            <?php
                            $KECIL = 0;
                            $options = array(
                                1 => 'KECIL',
                                2 => 'BESAR',
                            );

                            echo form_dropdown('SATUAN', $options, $KECIL, 'class="form-control"' );
                            ?>
                        </div>
                        <div class="col-xs-3">
                            <label><?php echo lang('label_qty') ?></label>
                            <input class="form-control" name="QTY" />
                        </div>
                        <div class="col-xs-3">
                            <label><?php echo lang('label_unitprice') ?></label>
                            <input class="form-control" name="H_SATUAN" />
                        </div>
                        <div class="col-xs-4">
                            <label><?php echo lang('label_price') ?></label>
                            <input class="form-control" name="Price" readonly>
                        </div>
                    </div>
                </div>
                <?php $tingkat_disc = (int)$tingkat_disc->TINGKAT_DISC; ?>
                <?php if($tingkat_disc >= 1) : ?>
                    <div class="col-lg-8">
                    <label><?php echo lang('label_disc') ?></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <input class="form-control" name="DISCOUNT" />
                            </div>
                            <div class="col-xs-7">
                                <input class="form-control" name="NILAI_DISC_1" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($tingkat_disc >= 2) : ?>
                    <div class="col-lg-8">
                    <label><?php echo lang('label_disc')." 2" ?></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <input class="form-control" name="DISCOUNT_2" />
                            </div>
                            <div class="col-xs-7">
                                <input class="form-control" name="NILAI_DISC_2" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($tingkat_disc >=3) : ?>
                    <div class="col-lg-8">
                    <label><?php echo lang('label_disc')." 3" ?></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <input class="form-control" name="DISCOUNT_3" />
                            </div>
                            <div class="col-xs-7">
                                <input class="form-control" name="NILAI_DISC_3" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($tingkat_disc >= 4) : ?>
                    <div class="col-lg-8">
                    <label><?php echo lang('label_disc')." 4" ?></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <input class="form-control" name="DISCOUNT_4" />
                            </div>
                            <div class="col-xs-7">
                                <input class="form-control" name="NILAI_DISC_4" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if($tingkat_disc >= 5) : ?>
                    <div class="col-lg-8">
                    <label><?php echo lang('label_disc')." 5" ?></label>
                        <div class="row">
                            <div class="col-xs-4">
                                <input class="form-control" name="DISCOUNT_5" />
                            </div>
                            <div class="col-xs-7">
                                <input class="form-control" name="NILAI_DISC_5" />
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-12">
                    <label><?php echo lang('label_remark') ?></label>
                    <textarea class="form-control" name="CATATAN" rows="4"></textarea>
                </div>
                <div>&nbsp;</div>
                <div class="col-lg-12">
                    <input type="submit" class="btn btn-primary" style="margin-bottom: 40px;" name="submit_save" value="<?php echo lang('label_add') ?>" />
                </div>
            </form>
        </div>
    </div>
</div>

<div class="row col-lg-12 headertotalform">Loading...</div>

<div class="modal actionapproveform fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('Verification') ?></h4>
            </div>
            <div class="modal-body">
                <p> Confirm Approve?</p>
                <div>&nbsp;</div>
                <div class="actionapproveform_status"></div>
                <div>&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary actionapprove_submit" value="" ><?php echo lang('button_approve') ?></button>
              <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
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
<div class="modal errordialog fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('Info') ?></h4>
            </div>
            <div class="modal-body">
                <p class="errorpan"></p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" ><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="voucher_frame hide"></div>

<?php endif; ?>
<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>
<script>
$.ajaxSetup({cache: false, async: false});

$(document).ready(function(){
    $(".item_select").focus();

    $(".item_list").on("click","a", function(event){
        event.preventDefault();

        var CODE = 0,
            DESC = 1,
            UOMS = 2;

        var msg = $(this).attr('href').split('@@');

        $("[name='BRG']").val(msg[CODE]);
        $("[name='BRG_DESC']").val(msg[DESC]);
        $("[name='SATUAN']").html(msg[UOMS]);
    });

    $(".submitsearchitem").click(function(event){
        $(".item_list").load("<?php echo base_url('item/search/') ?>",{term: $(".searchitem").val(), type: $("[name='inv']:checked").val() });
    });

    $(".item_select").click(function(event){
        event.preventDefault();
        $(".item_selection").modal('show');
    });

    $(".item_selection").on("hidden.bs.modal", function(){
        $("[name='quantity']").focus();
    });

    $(".add_new").click(function(){
        $(".add_pan").modal("show");
    });

    $("button[name='button_update_header']").click(function(event){

        event.preventDefault();
        //console.log('button update header just clicked broh');

        $.ajax({
            url : "<?php echo base_url('so/update_so_header') ?>",
            type : "POST",
            data : $("form[name='header_form']").serialize(),
            success : function(msg)
            {
                var FLAG = 1,
                    MSG = 2;
                msg = msg.split('@@');

                $("#header_form_status").html( msg[MSG] );
            }
        });
    });
    
    $("[name='submit_save']").click(function(event){

        event.preventDefault();
        $.ajax({
            url : '<?php echo base_url('so/add_so_detail_ajax') ?>',
            type: "POST",
            data : $("form[name='form_submit']").serialize(),
            success : function(msg)
            {
                var FLAG = 1,
                    MESSAGE = 2;

                msg = msg.split('@@');

                if( msg[FLAG] == '1')
                {
                    window.location.reload();
                }
                else
                {
                    $('.modal-error').html( msg[MESSAGE] );
                }
            }
        });
        //window.location.reload();
        return false;
    });

    $( "[name='BRG']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          $.ajax({
              url : "<?php echo base_url('item/item_autocomplete') ?>",
              type : "POST",
              dataType : "json",
              data : "term=" + $("[name='BRG']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {
          $("[name='BRG']").val(ui.item.BRG);
          $("[name='BRG_DESC']").val(ui.item.NAMA);

          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li>" )
          .append( "<a>" + item.BRG + " >> " + item.NAMA + "<br/>" + item.KET_SORT1 + "</a>" )
          .appendTo( ul );
    };

    $(".editdetail").click(function(event){
        event.preventDefault();

        $(".editdetail_pan").load("<?php echo base_url('so/update_so_detail') ?>/"+ $(this).attr('href') +'/'+Math.random());
        $(".form_submit").attr( 'action', $(this).attr('href'));
    });

    $("body").on("click", ".editdetail_submit", function(event){

        event.preventDefault();

        $.ajax({
            url : "<?php echo base_url('so/update_so_detail') ?>/" + $(".form_submit").attr('action') + "/" + Math.random(),
            type: "POST",
            async : false,
            data : $(".form_submit").serialize() + "&submit=1",
            success : function(msg){

                var FLAG = 1, MSG = 2;
                msg = msg.split('@@');
                if ( msg[FLAG] == '1' )
                {
                    window.location.reload();
                }
                else
                {
                    $(".modal-error").html( msg[MSG] );
                }

            }
        });

        return false;
    });

    //Calculating Price
    jQuery("[name='Price']").focus(function(){
        var QTY = parseFloat($("[name='QTY']").val());
        var H_SATUAN = parseFloat($("[name='H_SATUAN']").val());
        $(this).val(QTY * H_SATUAN); 
    });

    //Customer autocomplete
    jQuery( "[name='CUST']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          jQuery.ajax({
              url : "<?php echo base_url('so/customer_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              data : "term=" + jQuery("[name='CUST']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {

          jQuery("[name='CUST']").val(ui.item.CUST);
          jQuery("[name='NAMA_CUST']").val(ui.item.NAMA);
          jQuery("[name='TERM']").val(ui.item.TERM);

          if( jQuery("[name='CUST']").val() == UMUM )
          {
              jQuery("[name='NAMA_CUST']").removeAttr('readonly');
              jQuery("[name='TERM']").removeAttr('readonly');
          }
          else
          {
              jQuery("[name='NAMA_CUST']").attr('readonly','readonly');
              jQuery("[name='TERM']").attr('readonly','readonly');
          }
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.CUST + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };

    //Sales Autocomplete JQuery
    jQuery( "[name='KODE_SALES']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          jQuery.ajax({
              url : "<?php echo base_url('so/sales_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              data : "term=" + jQuery("[name='KODE_SALES']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {

          jQuery("[name='KODE_SALES']").val(ui.item.SLM);
          jQuery("[name='NAMA_SALES']").val(ui.item.NAMA);

          /*if( jQuery("[name='KODE_SALES']").val() == UMUM )
          { */
              jQuery("[name='NAMA_SALES']").removeAttr('readonly');
          /*}
          else
          {
              jQuery("[name='NAMA_SALES']").attr('readonly','readonly');
          }*/
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.SLM + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };

    //Wilayah autocomplete JQUERY
    jQuery( "[name='KODE_WIL']" ).autocomplete({
        minLength: 2,
        source: function(request, response){
          jQuery.ajax({
              url : "<?php echo base_url('so/wilayah_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              data : "term=" + jQuery("[name='KODE_WIL']").val() ,
              success : function(data){
                  response(data);
              }
          });
        },
        select: function( event, ui ) {

          jQuery("[name='KODE_WIL']").val(ui.item.WIL);
          jQuery("[name='NAMA_WILAYAH']").val(ui.item.NAWIL);

          /*if( jQuery("[name='KODE-WIL']").val() == UMUM )
          {*/
              jQuery("[name='NAMA_WILAYAH']").removeAttr('readonly');
          /*}
          else
          {
              jQuery("[name='NAMA_WILAYAH']").attr('readonly','readonly');
          }*/
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.WIL + " >> " + item.NAWIL +"</a>" )
          .appendTo( ul );
    };

    $(".headertotalform").load("<?php echo base_url('so/update_header_total/'. $record_hdr->NO_BUKTI) ?>");
});

$(".deletedetail").click(function(event)
{
    event.preventDefault();

    $.ajax({
        url : "<?php echo base_url('so/delete_so_detail_ajax') ?>/" + $(this).attr('href'),
        success : function(msg)
        {
            var RES = 1,
                MSG = 2;

            msg = msg.split('@@');

            if( msg[RES] == '1' )
            {
                $(".errordialog").modal('show');
                $(".errorpan").html(msg[MSG]);
            }
            window.location.reload();
        }
    });
});

$(".cancel").click(function(event)
{
    event.preventDefault();

    $.ajax({
        url : "<?php echo base_url('so/cancel') ?>/" + $(this).attr('href'),
        
        success : function(msg)
        {
            var RES = 1,
                MSG = 2;

            msg = msg.split('@@');

            if( msg[RES] == '1' )
            {
                $(".errordialog").modal('show');
                $(".errorpan").html(msg[MSG]);
            } else {
                window.location.reload();
            }
        }
    });
});


$("body").on('click', '.headertotalsub_form_save', function(event){

    event.preventDefault();

    $.each($('.headertotalsub_form input'), function(idx, elm) {
        $(elm).val( $(elm).val().replace(/,/g,'') );
    });

    $.ajax({
        url : "<?php echo base_url('so/update_header_total/'. $record_hdr->NO_BUKTI) ?>/" + Math.random(),
        type : "POST",
        async : false,
        data : $(".headertotalsub_form").serialize() + "&submit=1",
        success : function( msg ){

            if( msg.length == 0 )
            {
                msg = "<?php echo lang('label_update') ?>";
            }
            $(".headertotalform").load("<?php echo base_url('so/update_header_total/'. $record_hdr->NO_BUKTI) ?>/" + Math.random() );
            $(".headertotalsub_form_save_status").html(msg).show();
            $(".headertotalsub_form_save_status").hide(3000);
        }
    });
});
/*$(".voucher").click(function(event){

    event.preventDefault();
    $(".voucher_frame").html('<iframe src="<?php echo  base_url('pb/voucher/'. $record_hdr->ID)?>"></iframe>');
    return false;
});*/
</script>
