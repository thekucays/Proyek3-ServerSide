<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('header_location') ?></h1>
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
<div class="modal fade" id="winFormLocation" tabindex="-1" role="dialog" aria-labelledby="winFormLocationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formLocation" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormLocationLabel"><?php echo lang('title_add_location') ?></h4>
			</div>
			<div class="modal-body">						
				<input type="text" id="id" value="0" hidden>
				<div class="form-group">								
					<label for="name"><?php echo lang('label_name') ?></label>								
					<input type="text" class="form-control" id="name" name="name" data-minlength="5" placeholder="<?php echo lang('placeholder_field_name') ?>" required>
					<span class="help-block"><?php echo lang('hint_min5char') ?></span>
				</div>
				<div class="form-group">								
					<label for="left_id"><?php echo lang('label_left_id') ?></label>								
					<input type="number" class="form-control" id="left_id" name="left_id" placeholder="<?php echo lang('placeholder_field_left_id') ?>" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">								
					<label for="right_id"><?php echo lang('label_right_id') ?></label>								
					<input type="number" class="form-control" id="right_id" name="right_id" placeholder="<?php echo lang('placeholder_field_right_id') ?>" required>
					<div class="help-block with-errors"></div>
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
		$('#winFormLocation').modal('show');
		$('#winFormLocationLabel').html("<?php echo lang('title_add_location') ?>");			
	}
	$('#winFormLocation').on('hidden.bs.modal', function(){
		$(this).find('form')[0].reset();
	});
	$('#formLocation').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var name = $("#name").val();
			var left_id = $("#left_id").val();
			var right_id = $("#right_id").val();
			var datap = "";
			datap = "id="+id+"&name="+name+"&left_id="+left_id+"&right_id="+right_id;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."location/save_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
				$('#winFormLocation').modal('hide');
			});
			$('.form-location').removeClass('help-block');
			return false;
		}
	})
	function editData(id){
		$('#winFormLocation').modal('show');			
		$('#winFormLocationLabel').html("<?php echo lang('title_edit_location') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."location/get_data_detail" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$('#name').val(obj.name);
			$('#left_id').val(obj.left_id);
			$('#right_id').val(obj.right_id);
		});
	}
	function deleteData(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."location/delete_data" ?>"
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
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-location'>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_name') ?></th>" );
		items.push( "<th><?php echo lang('label_left_id') ?></th>" );
		items.push( "<th><?php echo lang('label_right_id') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );	
		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.id + "</td>" );
			items.push( "<td>" + val.name + "</td>" );
			items.push( "<td>" + val.left_id + "</td>" );
			items.push( "<td>" + val.right_id + "</td>" );
			items.push( "<td>" + val.idelete_name + "</td>" );
			items.push( "<td>" );
			items.push( "<a class='btn btn-success btn-sm' onclick=editData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#data_table").html( html );
		$('#dataTables-location').DataTable({
			responsive: true
		});
	}
	$(document).ready(function() {	
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url()."location/get_data" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			viewData(obj);
		});		
	});
</script>
