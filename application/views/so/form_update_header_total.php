<style>
.headertotalsub_form input { text-align: right;}
.headertotalsub_form_save_status { margin-left: 10px;}
</style>
<h3 class="page-header"><?php echo lang('label_total') ?></h3>
<form class="form headertotalsub_form">
    <div class="col-lg-6">
        <label><?php echo lang("label_bruto") ?></label>
        <input name="BRUTO" class="form-control" value="<?php echo numberFormat($record->BRUTO) ?>" readonly/>
    </div>
    <div class="row col-lg-6 fit">
        <div class="col-xs-12">
            <label><?php echo lang("label_disc") ?></label>
        </div>
        <div class="col-xs-4">
            <input name="DISCOUNT" class="form-control" value="<?php echo $record->DISCOUNT?>" />
        </div>
        <div class="col-xs-8 fit">
            <input name="NILAI_DISC" class="form-control" value="<?php echo numberFormat($record->NILAI_DISC) ?>" />
        </div>
    </div>
    <div class="row col-lg-6 fit fit-left">
        <div class=" col-xs-12">
            <label><?php echo lang("label_ppn") ?></label>
        </div>
        <div class=" col-xs-4">
            <input name="PPN" class="form-control" value="<?php echo $record->PPN ?>" />
        </div>
        <div class="col-xs-8 fit">
            <input name="NILAI_PPN" class="form-control" value="<?php echo numberFormat($record->NILAI_PPN) ?>" />
        </div>
    </div>
    <div class="col-lg-6">
        <label><?php echo lang("label_net") ?></label>
        <input name="NETTO" class="form-control" value="<?php echo numberFormat($record->NETTO) ?>" readonly/>
    </div>
    <div class="row">&nbsp;</div>
    <div class="row">&nbsp;</div>
    <div class="col-lg-12"><button class="btn btn-primary headertotalsub_form_save"><?php echo lang('button_save') ?></button><span class=headertotalsub_form_save_status></span></div>
</form>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>

<script>

</script>
