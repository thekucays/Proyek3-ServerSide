<form name="form_submit" method="POST" role="form" class="form-horizontal form_submit">
    <h4><?php echo lang('label_so_detail') ?></h4>
    <div class="modal-error error"></div>
    <input type="hidden" name="NO_BUKTI" value="<?php echo $record->NO_BUKTI ?>">
    <input type="hidden" name="NO_URUT" value="<?php echo $record->NO_URUT ?>" />
    <div class="col-lg-12">
        <label><?php echo lang('label_itemname') ?></label>
        <div class="row">
            <div class="col-xs-1" style="width:10px;">
                <a href="" class="fa fa-folder-open fa-fw item_select"> </a>
            </div>
            <div class="col-xs-4">
                <input class="form-control" name="BRG" value="<?php echo $record->BRG ?>" />
            </div>
            <div class="col-xs-7 col-fit">
                <input class="form-control" name="BRG_DESC" value="<?php echo $record->NAMA ?>" />
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="row">
            <!--<div class="col-xs-4">
                <label><?php echo "Barang Cust." ?></label>
                <input class="form-control" name="BRG_CUST" value="<?php echo $record->BRG_CUST ?>" />
            </div>-->
            <div class="col-xs-2">
                <label><?php echo lang('label_uom') ?></label>
                <?php
                echo form_dropdown('SATUAN', $uoms, $record->SATUAN, 'class="form-control"' );
                ?>
            </div>
            <div class="col-xs-3">
                <label><?php echo lang('label_qty') ?></label>
                <input class="form-control" name="QTY" value="<?php echo $record->QTY ?>" />
            </div>         
            <div class="col-xs-3">
                <label><?php echo lang('label_unitprice') ?></label>
                <input class="form-control" name="H_SATUAN" value="<?php echo $record->H_SATUAN ?>" />
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
                    <input class="form-control" name="DISCOUNT" value="<?php echo $record->DISCOUNT ?>" />
                </div>
                <div class="col-xs-7">
                    <input class="form-control" name="NILAI_DISC_1" value="<?php echo $record->NILAI_DISC_1 ?>" />
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tingkat_disc >= 2) : ?>
        <div class="col-lg-8">
        <label><?php echo lang('label_disc')." 2" ?></label>
            <div class="row">
                <div class="col-xs-4">
                    <input class="form-control" name="DISCOUNT_2" value="<?php echo $record->DISCOUNT_2 ?>" />
                </div>
                <div class="col-xs-7">
                    <input class="form-control" name="NILAI_DISC_2" value="<?php echo $record->NILAI_DISC_2 ?>" />
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tingkat_disc >= 3) : ?>
        <div class="col-lg-8">
        <label><?php echo lang('label_disc')." 3" ?></label>
            <div class="row">
                <div class="col-xs-4">
                    <input class="form-control" name="DISCOUNT_3" value="<?php echo $record->DISCOUNT_3 ?>" />
                </div>
                <div class="col-xs-7">
                    <input class="form-control" name="NILAI_DISC_3" value="<?php echo $record->NILAI_DISC_3 ?>" />
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tingkat_disc >= 4) : ?>
        <div class="col-lg-8">
        <label><?php echo lang('label_disc')." 4" ?></label>
            <div class="row">
                <div class="col-xs-4">
                    <input class="form-control" name="DISCOUNT_4" value="<?php echo $record->DISCOUNT_4 ?>" />
                </div>
                <div class="col-xs-7">
                    <input class="form-control" name="NILAI_DISC_4" value="<?php echo $record->NILAI_DISC_4 ?>" />
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($tingkat_disc >= 5) : ?>
        <div class="col-lg-8">
        <label><?php echo lang('label_disc')." 5" ?></label>
            <div class="row">
                <div class="col-xs-4">
                    <input class="form-control" name="DISCOUNT_5" value="<?php echo $record->DISCOUNT_5 ?>" />
                </div>
                <div class="col-xs-7">
                    <input class="form-control" name="NILAI_DISC_5" value="<?php echo $record->NILAI_DISC_5 ?>" />
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="col-lg-12">
        <label><?php echo lang('label_remark') ?></label>
        <textarea class="form-control" name="CATATAN" rows="4"><?php echo $record->CATATAN; ?></textarea>
    </div>
    <div>&nbsp;</div>
    <div class="col-lg-12">
        <input type="submit" class="btn btn-primary editdetail_submit" style="margin-bottom: 40px;" value="<?php echo lang('label_update') ?>" />
    </div>
</form>
<script type="text/javascript">
    //Calculating Price
    jQuery("[name='Price']").focus(function(){
        var QTY = parseFloat($("[name='QTY']").val());
        var H_SATUAN = parseFloat($("[name='H_SATUAN']").val());
        $(this).val(QTY * H_SATUAN); 
    });
</script>