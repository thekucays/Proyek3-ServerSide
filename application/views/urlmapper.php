<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('header_urlmapper') ?></h1>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<button type="button" class="btn btn-primary btn-sm"  onclick="addData();">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</button>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<div id="message_table"></div>
						<div id="data_table"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Form -->
<div class="modal fade" id="winFormUrlMapper" tabindex="-1" role="dialog" aria-labelledby="winFormUrlMapperLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUrlMapper" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUrlMapperLabel"><?php echo lang('title_add_urlmapper') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="id" value="0" hidden>
				<div class="form-group">
					<label for="code"><?php echo lang('label_urlmapper_code') ?></label>
					<input type="text" class="form-control" id="code" name="code" placeholder="<?php echo lang('placeholder_field_urlmapper_code') ?>" required>
				</div>
				<div class="form-group">
					<label for="tableprefix"><?php echo lang('label_urlmapper_tableprefix') ?></label>
					<input type="text" class="form-control" id="tableprefix" name="tableprefix" placeholder="<?php echo lang('placeholder_field_urlmapper_tableprefix') ?>" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
				<button type="submit" class="btn btn-primary"><?php echo lang('button_save') ?></button>
			</div>
			</form>
		</div>
	</div>
</div>

<!-- jQuery -->
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/bower_components/metisMenu/dist/metisMenu.min.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="<?php echo base_url(); ?>resources/startbootstrap-sb-admin-2-1.0.7/dist/js/sb-admin-2.js"></script>
<!-- JQuery UI -->
<script src="<?php echo base_url(); ?>resources/jqueryui/jquery-ui.min.js"></script>
<!-- Form Validator -->
<script src="<?php echo base_url(); ?>resources/validator/validator.min.js"></script>
<script>
	function addData(){
		$('#winFormUrlMapper').modal('show');
		$('#winFormUrlMapperLabel').html("<?php echo lang('title_add_urlmapper') ?>");
	}
	$('#winFormUrlMapper').on('hidden.bs.modal', function(){
		$(this).find('form')[0].reset();
	});
	$('#formUrlMapper').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var code = $("#code").val();
			var tableprefix = $("#tableprefix").val();
			var datap = "id="+id+"&code="+code+"&tableprefix="+tableprefix;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."urlmapper/save_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
				$('#winFormUrlMapper').modal('hide');
			});
			$('.form-user').removeClass('help-block');
			return false;
		}
	})
	function editData(id){
		$('#winFormUrlMapper').modal('show');
		$('#winFormUrlMapperLabel').html("<?php echo lang('title_edit_urlmapper') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."urlmapper/get_data_detail" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$('#code').val(obj.CODE);
			$('#tableprefix').val(obj.TABLEPREFIX);
		});
	}
	function deleteData(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."urlmapper/delete_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
			});
		}
		return false;
	}
	function viewMessage(success,message) {
		var items = [];
		if(success == true){
			items.push( "<div class='alert alert-success alert-dismissible' role='alert'>" );
			items.push( "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" );
			items.push( "<strong><?php echo lang('message_success') ?></strong> " + message );
			items.push( "</div>" );
		} else {
			items.push( "<div class='alert alert-danger alert-dismissible' role='alert'>" );
			items.push( "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" );
			items.push( "<strong><?php echo lang('message_error') ?></strong> " + message );
			items.push( "</div>" );
		}
		var html = items.join( "" );
		$("#message_table").html( html );
	}
	function viewData(obj) {
		var items = [];
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-urlmapper'>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_urlmapper_code') ?></th>" );
		items.push( "<th><?php echo lang('label_urlmapper_tableprefix') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );
		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.ID + "</td>" );
			items.push( "<td>" + val.CODE + "</td>" );
			items.push( "<td>" + val.TABLEPREFIX + "</td>" );
			items.push( "<td>" + val.IDELETE_NAME + "</td>" );
			items.push( "<td>" );
			items.push( "<a class='btn btn-success btn-sm' onclick=editData(" + val.ID + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteData(" + val.ID + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#data_table").html( html );
		$('#dataTables-urlmapper').DataTable({
			responsive: true
		});
	}
	$(document).ready(function() {
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url()."urlmapper/get_data" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			viewData(obj);
		});
	});
</script>
<script src="<?php echo base_url('resources/moment.js'); ?>"></script>
<script src="<?php echo base_url('resources/bootstrap-datetimepicker.min.js'); ?>"></script>
