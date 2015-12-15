<style>
.ui-autocomplete { z-index: 2147483647 !important;}
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1> Edit Bengkel </h1>

    <div class="row col-lg-12">
        <a href="<?php echo base_url('bengkel/index') ?>" class="btn btn-primary"><i class="fa fa-file"> List</i></a>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
<?php if( empty( $bengkel)): ?>
    <b class="error">Error: DATA BENGKEL TIDAK DITEMUKAN</b>
<?php else: ?>
     <form class="form" action="<?php echo base_url('bengkel/editBengkel/'.$bengkel->id_bengkel) ?>" method="post" name="header_form">
    <div class="row">
            <div class="col-lg-6">
                <label> ID Bengkel </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="id_bengkel" value="<?php echo $bengkel->id_bengkel ?>" readonly />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Nama Bengkel </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="nama_bengkel" value="<?php echo $bengkel->nama_bengkel ?>" />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Koordinat </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="koordinat" value="<?php echo $bengkel->koordinat ?>" />
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Jenis </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="jenis" value="<?php echo $bengkel->jenis ?>" />
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Deskripsi </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="deskripsi" value="<?php echo $bengkel->deskripsi ?>" />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Rating </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="rating" value="<?php echo $bengkel->rating ?>" />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Kode Kecamatan </label>
                <div class="row">
                    <div class="col-xs-12">
                        <?php $kecamatan = "kode-kec"; ?>
                        <input class="form-control " name="kode-kec" value="<?php echo $bengkel->$kecamatan ?>" />
                    </div>
                </div>
            </div>
        </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Tubeless? </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="isTubeless" value="<?php echo $bengkel->isTubeless ?>" />
                    </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
                <label> Contact Person </label>
                <div class="row">
                    <div class="col-xs-12">
                        <input class="form-control " name="contact_person" value="<?php echo $bengkel->contact_person ?>" />
                    </div>
                </div>
            </div>
    </div>

    <div class="row">
          <div>&nbsp;</div>
            <div class="col-lg-12">
            <input type="submit" class="btn btn-primary" style="margin-bottom: 40px;" name="submit_save" value="<?php echo lang('label_update') ?>" />
    </div>
    </form>
    </div>
</div>

<!--<div class="row col-lg-12 headertotalform">Loading...</div> -->

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