<style>
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1><?php echo lang("label_so") ?></h1>
    <div class="row col-lg-12">
        <a href="<?php echo base_url('so/index') ?>" class="btn btn-primary"><i class="fa fa-file"> List</i></a>
        <a href="<?php echo base_url('so/preferences') ?>" class="btn btn-primary"><i class="fa fa-cog"><?php echo lang('Preferences') ?></i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class="row">
    <?php
    $error = $this->session->flashdata('error');

    if( $error ):
    ?>
    <b class="error"><?php echo $error ?></b>
    <?php endif; ?>
    <form class="form" action="<?php echo base_url('so/add_so_header') ?>" method="post">
        <div class="col-lg-6">
            <label><?php echo lang("NoSO") ?></label>
            <div class="row">
                <!--<div class="col-xs-2">
                    <?php //echo form_dropdown('tag', $tags, null, 'class="form-control"'); ?>
                </div> -->
                <div class="col-xs-12">
                    <input class="form-control " name="strseq" value="<?php echo set_value('strseq') ?>" readonly />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang("label_date") ?></label>
            <input class="form-control" name="TGL" id="date" value="<?php echo set_value('TGL') ?>" />
        </div>
        <div class="col-lg-6">
            <label><?php echo lang("label_delivery_date") ?></label>
            <input class="form-control date" name="TGL_KIRIM" value="<?php echo set_value('TGL_KIRIM') ?>" />
        </div>
        <div class="col-lg-6">
            <label><?php echo lang("NoPoCustomer") ?></label>
            <input class="form-control" name="NO_PO_CUST" value="<?php echo set_value('NO_PO_CUST') ?>" />
        </div>

        <div class="col-lg-6">
            <label><?php echo lang("Customer") ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="CUST" value="<?php echo set_value('CUST') ?>" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_CUST" value="<?php echo set_value('NAMA_CUST') ?>" readonly />
                </div>
                <!--<input class="form-control" name="TIPE_KIRIM" value="0" type='hidden' /> -->
            </div>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang("label_term") ?></label>
            <div class="row">
                <div class="col-xs-12">
                    <input class="form-control " name="TERM" value="<?php echo set_value('TERM') ?>" readonly />
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <label> <?php echo lang('label_actkirim') ?> </label>
            <div class="row">
                <div class="col-xs-12">
                    <input class="form-control" name="TIPE_KIRIM" value="0" readonly />
                </div>
            </div>
        </div>

        <!-- Dibuat jadi hidden, default nya 0 -->
        <!--<div class="col-lg-6">
            <label><?php //echo "Tipe Kirim" ?></label>
            <input class="form-control" name="TIPE_KIRIM" />
        </div> -->

        <div class="col-lg-12">
            <label><?php echo lang("Address") ?></label>

            <div class="form-inline">
              <?php echo lang('label_so_area_code_search') ?>
              <a class="fa fa-folder-open kode_wil_select"> </a>
            </div>

            <!--<textarea class="form-control" rows="3" name="AL_CUST"><?php //echo set_value('alamat customer') ?></textarea>-->
            <input class="form-control" name="al" readonly /> &nbsp;
            <input class="form-control" name="al1" readonly /> &nbsp;  <!-- tambahan -->
            <input class="form-control" name="al2" readonly /> &nbsp;
            <input class="form-control" name="al3" readonly /> &nbsp;
            <!--<input class="form-control" name="al1" /> &nbsp; -->
        </div>
        <div class="col-lg-6">
            <div class="row">
                <div class="col-xs-3">
                    <?php //echo form_dropdown("VLT", $kurs, null, "class='form-control'");?>
                    <label><?php echo lang("Currency") ?></label>
                    <input class="form-control" name="VLT" id="VLT" readonly />
                </div>
                <div class="col-xs-3">
                    <label><?php echo lang("label_so_ntukar") ?></label>
                    <input class="form-control" name="NILAI_TUKAR" id="NILAI_TUKAR" readonly>
                </div>
            </div>
            <label><?php echo lang("label_so_wil") ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="KODE_WIL" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_WILAYAH" readonly />
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <label><?php echo lang("Sales") ?></label>
            <div class="row">
                <div class="col-xs-3">
                    <input class="form-control" name="KODE_SALES" />
                </div>
                <div class="col-xs-9">
                    <input class="form-control " name="NAMA_SALES" readonly />
                </div>
            </div>
            <label><?php echo lang("sales_type") ?></label>
            <div class="row">
                <div class="col-xs-12">
                    <?php echo form_dropdown("SALES_TYPE", $sales_type, set_value('SALES_TYPE'), 'class="form-control"'); ?>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <label><?php echo lang('label_remark') ?></label>
            <textarea class="form-control" rows="3" name="KET"><?php echo set_value('KET') ?></textarea>
        </div>

        <div>&nbsp;</div><div>&nbsp;</div><div>&nbsp;</div>
        <div class="col-lg-12 form-inline">
            <input type="submit" name="save" value="<?php echo lang('button_save') ?>" class="btn btn-primary" />
        </div>
    </form>
    </div>
</div>

<div class="kode_wil_selection modal fade">
   <div class="modal-dialog" style="width: 800px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('label_so_area_code_search') ?></h4>
            </div>
            <div class="modal-body">
                <form class="new_address_form">
                  <div class="col-lg-12">
                      <!-- ini div untuk nambah wilayah baru (ke SIF01) -->
                      <input typpe="text" name="cust_id" id="cust_id" hidden />
                      <label>  <?php echo lang('AddNew') ?> </label>
                      <input class="form-control" type="text" name="al_sif" />
                      <div>&nbsp;</div>
                      <input class="form-control" type="text" name="al1_sif" />
                      <div>&nbsp;</div>
                      <input class="form-control" type="text" name="al2_sif" />
                      <div>&nbsp;</div>
                      <input class="form-control" type="text" name="al3_sif">
                      <div>&nbsp;</div>
                      <!-- <input type="submit" class="btn btn-warning submitnewitem" /> -->
                      <button type="button" class="btn btn-warning new_address_submit" value="" ><?php echo lang('button_save') ?></button>
                  </div>
                </form>
                <div>&nbsp;</div><div>&nbsp;</div>
                <div class="col-lg-12">
                    <!-- <input typpe="text" name="cust_id" id="cust_id" hidden /> -->
                    <label><?php echo lang('label_search') ?></label>
                    <input class="form-control searchitem" />
                    <div>&nbsp;</div>
                    <input type="submit" class="btn btn-primary submitsearchitem" />
                </div>
                <div>&nbsp;</div>
                <div class="col-lg-12 item_list">
                  <!-- buat list item nya -->
                </div>
                <div>&nbsp;</div>
                <div>&nbsp;</div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div>
</div><!-- /.modal -->

<div class="err_tgl_kosong modal fade">
    <div class="modal-dialog" style="width: 500px">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo lang('message_error') ?></h4>
            </div>
            <div class="modal-body">
                <?php echo lang('message_ErrorDateIsNull') ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>
<script>
/*$("select[name='tag']").change(function(){
    $("select[name='type']").val( $(this).val() );
}); */
$(document).ready(function(){
    $(".kode_wil_select").click(function(event){
        event.preventDefault();
        $(".kode_wil_selection").modal('show');
        $(".item_list").load("<?php echo base_url('so/search/') ?>",{term: $(".searchitem").val(), cust_id: jQuery("[name='cust_id']").val() });
        
        //jQuery("[name='AL_']").val( jQuery("[name='al']").val() );
        //jQuery("[name='AL2_']").val( jQuery("[name='al2']").val() );

        jQuery("[name='cust_id']").val( jQuery("[name='CUST']").val() );
    });

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
          // tanggal harus diisi dulu
          if(jQuery("[name='TGL']").val()==''){
              $(".err_tgl_kosong").modal('show');
          }
          else{
            // kosongin dulu
            jQuery("[name='al']").val('');
            jQuery("[name='al1']").val('');
            jQuery("[name='al2']").val('');
            jQuery("[name='al3']").val('');

            jQuery("[name='CUST']").val(ui.item.CUST);
            jQuery("[name='NAMA_CUST']").val(ui.item.NAMA);
            jQuery("[name='TERM']").val(ui.item.TERM);
            jQuery("[name='al']").val(ui.item.AL);
            jQuery("[name='al2']").val(ui.item.AL2);
            jQuery("[name='al3']").val(ui.item.AL3);
            jQuery("[name='VLT']").val(ui.item.VLT);

            jQuery("[name='NILAI_TUKAR']").val('');  

            if(ui.item.VLT == 'IDR'){
                jQuery("[name='NILAI_TUKAR']").val('1');            
            }
            else{
              console.log('TGL : ' + jQuery("[name='TGL']").val());

                jQuery.ajax({
                    url: "<?php echo base_url('gl/getNtukar') ?>",
                    async: false,
                    type: "POST",
                    //data: "term=" + jQuery("[name='VLT']").val(),
                    //dataType : "json",
                    data: "term=" + ui.item.VLT + "&tgl=" + jQuery("[name='TGL']").val(),
                    success: function(msg){
                        //console.log("datanya : " + msg);
                        jQuery("[name='NILAI_TUKAR']").val(msg);           
                    }
                });
            }

            if( jQuery("[name='CUST']").val() == 'UMUM' )
            {
                jQuery("[name='NAMA_CUST']").removeAttr('readonly');
                jQuery("[name='TERM']").removeAttr('readonly');
            }
            else
            {
                jQuery("[name='NAMA_CUST']").attr('readonly','readonly');
                jQuery("[name='TERM']").attr('readonly','readonly');
            }
          }
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.CUST + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };

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

          if( jQuery("[name='KODE_SALES']").val() == UMUM )
          {
              jQuery("[name='NAMA_SALES']").removeAttr('readonly');
          }
          else
          {
              jQuery("[name='NAMA_SALES']").attr('readonly','readonly');
          }
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.SLM + " >> " + item.NAMA +"</a>" )
          .appendTo( ul );
    };

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

          if( jQuery("[name='KODE-WIL']").val() == UMUM )
          {
              jQuery("[name='NAMA_WILAYAH']").removeAttr('readonly');
          }
          else
          {
              jQuery("[name='NAMA_WILAYAH']").attr('readonly','readonly');
          }
          return false;
        }
    }, "appendTo", "form_submit")
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
        return jQuery( "<li>" )
          .append( "<a>" + item.WIL + " >> " + item.NAWIL +"</a>" )
          .appendTo( ul );
    };

    // search alamat related
    $("body").on('click','.new_address_submit', function(event){
        event.preventDefault();
        console.log("hi, i'm clicked");

        $.ajax({
            url : "<?php echo base_url('so/add_new_address') ?>", //. $record_hdr->PO_NO) ?>",
            type : "POST",
            async : false,
            data : $(".new_address_form").serialize() + "&submit=1",
            success : function( msg ){
                //$(".additionalnotes_modal").modal('hide');
                jQuery("[name='al_sif']").val('');
                jQuery("[name='al1_sif']").val('');
                jQuery("[name='al2_sif']").val('');
                jQuery("[name='al3_sif']").val('');

                // reload list
                $(".item_list").load("<?php echo base_url('so/search/') ?>",{term: $(".searchitem").val(), cust_id: jQuery("[name='cust_id']").val() });
            }
        });
    });
    $(".submitnewitem").click(function(event){
        var al = jQuery("[name='al_sif']").val();
        var al1 = jQuery("[name='al1_sif']").val();
        var al2 = jQuery("[name='al2_sif']").val();
        var al3 = jQuery("[name='al3_sif']").val();
        var cust_id = jQuery("[name='cust_id']").val();
        
        // cek apakah sudah pilih customer nya
        if(cust_id!=""){
          /*jQuery.ajax({
              url : "<?php echo base_url('so/wilayah_autocomplete') ?>",
              async: false,
              type : "POST",
              dataType : "json",
              //data : "no_urut_pp="+ val[NO_URUT] + "&pop_no=<?php echo $record_hdr->PO_NO ?>&brg=" + val[ITEM_NO],
              data : "al=" + al + "&al1=" + al1 + "&al2=" + al2 + "&al3=" + al3,
              success : function(data){
                  response(data);
              }
          });*/
        }

        //simpan datanya ke SIF01
    });
    $(".submitsearchitem").click(function(event){
        //$(".item_list").load("<?php echo base_url('so/search/') ?>",{term: $(".searchitem").val(), cust_id: $(".cust_id").val() });
        $(".item_list").load("<?php echo base_url('so/search/') ?>",{term: $(".searchitem").val(), cust_id: jQuery("[name='cust_id']").val() });
    });
    $(".item_list").on("click","a", function(event){
        event.preventDefault();

        var AL = 0,
            AL1 = 1,
            AL2 = 2,
            AL3 = 3;

        var msg = $(this).attr('href').split('@@');

        $("[name='al']").val(msg[AL]);
        $("[name='al1']").val(msg[AL1]);
        $("[name='al2']").val(msg[AL2]);
        $("[name='al3']").val(msg[AL3]);

        console.log("item_list click!");
    });
});
</script>
