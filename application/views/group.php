<style>
	div.dataTables_scrollHeadInner table { margin-bottom: 5px !important }
	div.dataTables_scrollBody  > table.dataTable thead .sorting:after {
		content: "";
	}
	div.dataTables_scrollBody  > table.dataTable thead .sorting_asc:after {
		content: "";
	}
	div.dataTables_scrollBody  > table.dataTable thead .sorting_desc:after {
		content: "";
	}
	#winTableGroupDetail .modal-dialog{
		width: 75% !important;
	}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('header_group') ?></h1>
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
<div class="modal fade" id="winFormGroup" tabindex="-1" role="dialog" aria-labelledby="winFormGroupLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formGroup" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormGroupLabel"><?php echo lang('title_add_group') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="id" value="0" hidden>
				<div class="form-group">
					<label for="name"><?php echo lang('label_name') ?></label>
					<input type="text" class="form-control" id="name" name="name" data-minlength="5" placeholder="<?php echo lang('placeholder_field_name') ?>" required>
					<span class="help-block"><?php echo lang('hint_min5char') ?></span>
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

<div class="modal fade" id="winTableGroupDetail" tabindex="-1" role="dialog" aria-labelledby="winTableGroupDetailLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winTableGroupDetailLabel"><?php echo lang('header_group_detail') ?></h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-primary btn-sm"  onclick="addDataDetail();">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<br/>
				<div class="dataTable_wrapper">
					<input type="text" id="group_id" value="0" hidden>
					<div id="view-message-group-detail"></div>
					<div id="view-data-group-detail"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			</div>
		</div>
	</div>
</div>

<!--Form -->
<div class="modal fade" id="winFormGroupDetail" tabindex="-1" role="dialog" aria-labelledby="winFormGroupDetailLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formGroupDetail" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormGroupDetailLabel"><?php echo lang('title_add_group_detail') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="id" value="0" hidden>
				<div class="form-group">
					<label><?php echo lang('label_menu') ?></label>
					<?php echo form_dropdown('menu_id', $option_menu, '', 'class="form-control" id="menu_id" required'); ?>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_read') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="read" name="read" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_update') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="update" name="update" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_delete') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="delete" name="delete" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_report') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="report" name="report" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_approve') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="approve" name="approve" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_cancel') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="cancel" name="cancel" value="">.
					</label>
				</div>
				<div class="form-group">
					<label><?php echo lang('label_view_money') ?></label>
					<label class="checkbox-inline">
						<input type="checkbox" id="view_money" name="view_money" value="">.
					</label>
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
<!-- Form Validator -->
<script src="<?php echo base_url(); ?>resources/validator/validator.min.js"></script>
<script>
	function addData(){
		$('#winFormGroup').modal('show');
		$('#winFormGroupLabel').html("<?php echo lang('title_add_group') ?>");
	}
	function addDataDetail(){
		$("#menu_id").val("");
		$("#read").prop('checked', false);
		$("#update").prop('checked', false);
		$("#delete").prop('checked', false);
		$("#report").prop('checked', false);
		$("#approve").prop('checked', false);
		$("#cancel").prop('checked', false);
		$("#view_money").prop('checked', false);
		$('#winFormGroupDetail').modal('show');
		$('#winFormGroupDetailLabel').html("<?php echo lang('title_add_group_detail') ?>");
	}
	$('#winFormGroup').on('hidden.bs.modal', function(){
		$(this).find('form')[0].reset();
	});
	$('#formGroup').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var name = $("#name").val();
			var datap = "";
			datap = "id="+id+"&name="+name;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."group/save_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
				$('#winFormGroup').modal('hide');
			});
			$('.form-group').removeClass('help-block');
			return false;
		}
	})
	$('#formGroupDetail').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var group_id = $("#group_id").val();
			var menu_id = $("#menu_id").val();
			var read = 0;
			var update = 0;
			var del = 0;
			var report = 0;
			var approve = 0;
			var cancel = 0;
			var view_money = 0;
			if ($('#read').is(":checked")){
				read = 1;
			}
			if ($('#update').is(":checked")){
				update = 1;
			}
			if ($('#delete').is(":checked")){
				del = 1;
			}
			if ($('#report').is(":checked")){
				report = 1;
			}
			if ($('#approve').is(":checked")){
				approve = 1;
			}
			if ($('#cancel').is(":checked")){
				cancel = 1;
			}
			if ($('#view_money').is(":checked")){
				view_money = 1;
			}
			var datap = "";
			datap = "id="+id+"&group_id="+group_id+"&menu_id="+menu_id+"&read="+read+"&update="+update+"&delete="+del+"&report="+report+"&approve="+approve+"&cancel="+cancel+"&view_money="+view_money;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."group/save_data_group_dtl" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageDetail(obj.success,obj.message);
				viewDataDetail(obj.data);
				$('#winFormGroupDetail').modal('hide');
			});
			//alert(datap);
			$('.form-group').removeClass('help-block');
			return false;
		}
	})
	function editData(id){
		$('#winFormGroup').modal('show');
		$('#winFormGroupLabel').html("<?php echo lang('title_edit_group') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."group/get_data_detail" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$('#name').val(obj.name);
		});
	}
	function editDataDetail(id){
		$('#winFormGroupDetail').modal('show');
		$('#winFormGroupDetailLabel').html("<?php echo lang('title_edit_group_detail') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."group/get_data_detail_group_dtl" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$("#menu_id").val(obj.menu_id);
			$("#read").prop('checked', obj.read);
			$("#update").prop('checked', obj.update);
			$("#delete").prop('checked', obj.delete);
			$("#report").prop('checked', obj.report);
			$("#approve").prop('checked', obj.approve);
			$("#cancel").prop('checked', obj.cancel);
			$("#view_money").prop('checked', obj.view_money);
		});
	}
	function detailData(group_id){
		$.ajax({
			type: 'POST',
			data: "group_id="+group_id,
			url: "<?php echo base_url()."group/get_data_group_dtl" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$("#group_id").val(group_id);
			$("#view-message-group-detail").html( "" );
			viewDataDetail(obj);
		});
	}
	function viewDataDetail(obj) {
		$('#winTableGroupDetail').modal('show');
		var items = [];
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-group-detail' width=1500>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_group') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_menu') ?></th>" );
		items.push( "<th><?php echo lang('label_read') ?></th>" );
		items.push( "<th><?php echo lang('label_update') ?></th>" );
		items.push( "<th><?php echo lang('label_delete') ?></th>" );
		items.push( "<th><?php echo lang('label_report') ?></th>" );
		items.push( "<th><?php echo lang('label_approve') ?></th>" );
		items.push( "<th><?php echo lang('label_cancel') ?></th>" );
		items.push( "<th><?php echo lang('label_view_money') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );
		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.id + "</td>" );
			items.push( "<td>" + val.group_name + "</td>" );
			items.push( "<td>" + val.idelete_name + "</td>" );
			items.push( "<td>" + val.menu_name + "</td>" );
			items.push( "<td>" + val.read + "</td>" );
			items.push( "<td>" + val.update + "</td>" );
			items.push( "<td>" + val.delete + "</td>" );
			items.push( "<td>" + val.report + "</td>" );
			items.push( "<td>" + val.approve + "</td>" );
			items.push( "<td>" + val.cancel + "</td>" );
			items.push( "<td>" + val.view_money + "</td>" );
			items.push( "<td>" );
			items.push( "<a class='btn btn-success btn-sm' onclick=editDataDetail(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteDataDetail(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#view-data-group-detail").html( html );
		$('#dataTables-group-detail').DataTable({
			responsive: true,
			"scrollX": true,
			"columnDefs": [
				{ "width": "100", "targets": 0 },
				{ "width": "200", "targets": 1 },
				{ "width": "150", "targets": 2 },
				{ "width": "150", "targets": 3 },
				{ "width": "150", "targets": 4 },
				{ "width": "150", "targets": 5 },
				{ "width": "150", "targets": 6 },
				{ "width": "150", "targets": 7 },
				{ "width": "150", "targets": 8 },
				{ "width": "150", "targets": 9 },
				{ "width": "150", "targets": 10 },
				{ "width": "150", "targets": 11 }
			]
		});
	}
	function deleteData(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."group/delete_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
			});
		}
		return false;
	}
	function deleteDataDetail(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."group/delete_data_group_dtl" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageDetail(obj.success,obj.message);
				viewDataDetail(obj.data);
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
	function viewMessageDetail(success,message) {
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
		$("#view-message-group-detail").html( html );
	}
	function viewData(obj) {
		var items = [];
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-group'>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_name') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_priv') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );
		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.id + "</td>" );
			items.push( "<td>" + val.name + "</td>" );
			items.push( "<td>" + val.idelete_name + "</td>" );
			items.push( "<td>" + val.priv_n + "</td>" );
			items.push( "<td>" );
			items.push( "<a class='btn btn-success btn-sm' onclick=editData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-info btn-sm' onclick=detailData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-list-alt' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#data_table").html( html );
		$('#dataTables-group').DataTable({
			responsive: true
		});
	}
	$(document).ready(function() {
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url()."group/get_data" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			viewData(obj);
		});
	});
</script>
