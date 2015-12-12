<style>
.ui-autocomplete { z-index: 2147483647 !important;}
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1> Edit Kendaraan </h1>

    <div class="row col-lg-12">
        <a href="<?php echo base_url('kendaraan/index') ?>" class="btn btn-primary"><i class="fa fa-file"> List</i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
<?php if( empty( $kendaraan)): ?>
    <b class="error">Error: DATA KENDARAAN TIDAK DITEMUKAN</b>
<?php else: ?>
    <div class="row">
        <form class="form" action="<?php echo base_url('kendaraan/editKendaraan/'.$kendaraan->id_kendaraan) ?>" method="post" name="header_form">
            <div class="col-lg-6">
                <label> ID Kendaraan </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="id_kendaraan" value="<?php echo $kendaraan->id_kendaraan ?>" readonly />
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <label> Jenis Kendaraan </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="jenis_kendaraan" value="<?php echo $kendaraan->jenis_kendaraan ?>" />
                    </div>
                </div>
            </div>
            <div>&nbsp;</div>
            <div class="col-lg-12">
                <input type="submit" class="btn btn-primary" style="margin-bottom: 40px;" name="submit_save" value="<?php echo lang('label_update') ?>" />
            </div>
        </form>
        </div>
    </div>
</div>

<div class="row col-lg-12 headertotalform">Loading...</div>

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

<?php endif; ?>
<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>