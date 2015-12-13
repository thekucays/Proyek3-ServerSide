<style>
.sidebar { display: none;}
#page-wrapper{ margin: 0 !important; }
</style>
<div class="row col-lg-12">
    <h1> Tambah Jenis </h1>
    <?php if(validation_errors()){ ?>
	<div class="row col-lg-12">
        <div class='alert alert-danger alert-dismissible' role='alert'>
			<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
			<strong><?php echo lang('message_error_insert').validation_errors(); ?></strong>
		</div>
    </div>
	<?php } ?>
	<div class="row col-lg-12">
        <a href="<?php echo base_url('jenis/index') ?>" class="btn btn-primary"><i class="fa fa-file"> List</i></a>
    </div>
    <div class="row">
    <br/>
		
    <form class="form" action="<?php echo base_url('jenis/tambahJenis') ?>" method="post">
        <div class="col-lg-2">
            <label><?php echo "Deskripsi" ?></label>
            <input class="form-control" name="deskripsi" />
        </div>
        <div>&nbsp;</div>
        <div>&nbsp;</div>
        <div class="col-lg-12 form-inline">
            <input type="submit" name="save" value="<?php echo lang('button_save') ?>" class="btn btn-primary" />
        </div>
    </form>
    </div>
</div>

<link href="<?php echo base_url('resources/jqueryui/jquery-ui.min.css') ?>" rel="stylesheet"/>
<script src="<?php echo base_url('resources/jqueryui/jquery-ui.min.js') ?>"></script>
