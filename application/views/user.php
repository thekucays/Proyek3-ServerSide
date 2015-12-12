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
	#winTableUserLocation .modal-dialog{
		width: 60% !important;
	}
	#winTableUserPrivilege .modal-dialog{
		width: 75% !important;
	}
</style>
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header"><?php echo lang('header_user') ?></h1>
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
<div class="modal fade" id="winFormUser" tabindex="-1" role="dialog" aria-labelledby="winFormUserLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUser" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUserLabel"><?php echo lang('title_add_user') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="id" value="0" hidden>
				<div class="form-group">
					<label for="name"><?php echo lang('label_name') ?></label>
					<input type="text" class="form-control" id="name" name="name" data-minlength="5" placeholder="<?php echo lang('placeholder_field_name') ?>" required>
					<span class="help-block"><?php echo lang('hint_min5char') ?></span>
				</div>
				<div class="form-group">
					<label for="username"><?php echo lang('label_username') ?></label>
					<input type="text" class="form-control" id="username" name="username" data-minlength="5" placeholder="<?php echo lang('placeholder_field_username') ?>" required>
					<span class="help-block"><?php echo lang('hint_min5char') ?></span>
				</div>
                <div class="form-group">
					<label for="password"><?php echo lang('label_password') ?></label>
					<input type="password" class="form-control" id="password" name="password" data-minlength="5" placeholder="<?php echo lang('placeholder_field_password') ?>" required>
					<span class="help-block"><?php echo lang('hint_min5char') ?></span>
				</div>
				<div class="form-group">
				<label for="email"><?php echo lang('label_email') ?></label>
					<input type="email" class="form-control" name="email" id="email" data-error="<?php echo lang('invalid_email') ?>" placeholder="<?php echo lang('placeholder_field_email') ?>" required>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="department_id"><?php echo lang('label_department') ?></label>
					<?php echo form_dropdown('department_id', $option_department, '', 'class="form-control" id="department_id" required'); ?>
					<div class="help-block with-errors"></div>
				</div>

				<!-- tambahan untuk initial location user baru -->
				<div class="form-group">
					<label for="location_id"><?php echo lang('label_location') ?></label>
					<?php echo form_dropdown('location_id', $option_location, '', 'class="form-control" id="location_id" required'); ?>
					<div class="help-block with-errors"></div>
				</div>

				<div class="form-group">
					<label for="rank_id"><?php echo lang('label_rank') ?></label>
					<?php echo form_dropdown('rank_id', $option_rank, '', 'class="form-control" id="rank_id" required'); ?>
					<div class="help-block with-errors"></div>
				</div>
				<div class="form-group">
					<label for="group_id"><?php echo lang('label_group') ?></label>
					<?php echo form_dropdown('group_id', $option_group, '', 'class="form-control" id="group_id" required'); ?>
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

<div class="modal fade" id="winTableUserLocation" tabindex="-1" role="dialog" aria-labelledby="winTableUserLocationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winTableUserPrivilegeLabel"><?php echo lang('header_user_location') ?></h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-primary btn-sm"  onclick="addDataUserLocation();">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<br/>
				<div class="dataTable_wrapper">
					<input type="text" id="user_id" value="0" hidden>
					<div id="view-message-user-location"></div>
					<div id="view-data-user-location"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winTableUserPrivilege" tabindex="-1" role="dialog" aria-labelledby="winTableUserPrivilegeLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winTableUserPrivilegeLabel"><?php echo lang('header_user_privilege') ?></h4>
			</div>
			<div class="modal-body">
				<button type="button" class="btn btn-primary btn-sm"  onclick="addDataUserPrivilege();">
					<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				</button>
				<br/>
				<div class="dataTable_wrapper">
					<input type="text" id="user_id" value="0" hidden>
					<div id="view-message-user-privilege"></div>
					<div id="view-data-user-privilege"></div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="winFormUserPrivilege" tabindex="-1" role="dialog" aria-labelledby="winFormUserPrivilegeLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUserPrivilege" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUserPrivilegeLabel"><?php echo lang('title_add_user_privilege') ?></h4>
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

<div class="modal fade" id="winFormUserLocation" tabindex="-1" role="dialog" aria-labelledby="winFormUserLocationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUserLocation" name ="formUserLocation" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUserLocationLabel"><?php echo lang('title_add_user_location') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="idnya" name="idnya" value="0">
				<div class="form-group">
					<label><?php echo lang('label_location') ?></label>
					<?php echo form_dropdown('location_id', $option_location, '', 'class="form-control" id="location_id" required'); ?>
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

<div class="modal fade" id="winFormUserLocation2" tabindex="-1" role="dialog" aria-labelledby="winFormUserLocationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUserLocation2" name ="formUserLocation2" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUserLocationLabel"><?php echo lang('title_add_user_location') ?></h4>
			</div>
			<div class="modal-body">
				
				<div class="form-group">
					<label><?php echo lang('label_location') ?></label>
					<?php echo form_dropdown('location_id', $option_location, '', 'class="form-control" id="location_id2" required'); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
				<button type="submit" class="btn btn-primary kirim2"><?php echo lang('button_save') ?></button>
			</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="winFormUserLocation3" tabindex="-1" role="dialog" aria-labelledby="winFormUserLocationLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<form id="formUserLocation3" name ="formUserLocation3" role="form">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="winFormUserLocationLabel"><?php echo lang('title_edit_location') ?></h4>
			</div>
			<div class="modal-body">
				<input type="text" id="id_ul" name="id_ul" hidden> <input type="text" id="isInitLoc" name="isInitLoc" hidden>
				<div class="form-group">
					<label><?php echo lang('label_location') ?></label>
					<?php echo form_dropdown('location_id', $option_location, '', 'class="form-control" id="location_id3" required'); ?>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('button_close') ?></button>
				<button type="submit" class="btn btn-primary kirim2"><?php echo lang('button_save') ?></button>
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
		$('#winFormUser').modal('show');
		$('#winFormUserLabel').html("<?php echo lang('title_add_user') ?>");
	}
	$('#winFormUser').on('hidden.bs.modal', function(){
		$(this).find('form')[0].reset();
	});



	$('#formUser').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var name = $("#name").val();
			var department_id = $("#department_id").val();
			var rank_id = $("#rank_id").val();
			var group_id = $("#group_id").val();
			var username = $("#username").val();
			var password = $("#password").val();
			var email = $("#email").val();

			// initial location user baruu nya
			var location_id = $("#location_id").val();

			//var datap = "id="+id+"&name="+name+"&username="+username+"&email="+email+"&department_id="+department_id+"&rank_id="+rank_id+"&group_id="+group_id + "&password=" + password;
			var datap = "id="+id+"&location_id="+location_id+"&name="+name+"&username="+username+"&email="+email+"&department_id="+department_id+"&rank_id="+rank_id+"&group_id="+group_id + "&password=" + password;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."user/save_data" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessage(obj.success,obj.message);
				viewData(obj.data);
				$('#winFormUser').modal('hide');
			});
			$('.form-user').removeClass('help-block');
			return false;
		}
	});
	function editData(id){
		$('#winFormUser').modal('show');
		$('#winFormUserLabel').html("<?php echo lang('title_edit_user') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."user/get_data_detail" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$('#name').val(obj.name);
			$('#username').val(obj.username);
			$('#email').val(obj.email);
			$('#department_id').val(obj.department_id);
			$('#rank_id').val(obj.rank_id);
			$('#group_id').val(obj.group_id);
		});
	}
	function deleteData(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."user/delete_data" ?>"
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
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-user' width=2200>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_name') ?></th>" );
		items.push( "<th><?php echo lang('label_username') ?></th>" );
		items.push( "<th><?php echo lang('label_email') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_activation_code') ?></th>" );
		items.push( "<th><?php echo lang('label_created') ?></th>" );
		items.push( "<th><?php echo lang('label_updated') ?></th>" );
		items.push( "<th><?php echo lang('label_department') ?></th>" );
		items.push( "<th><?php echo lang('label_rank') ?></th>" );
		items.push( "<th><?php echo lang('label_group') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );
		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.id + "</td>" );
			items.push( "<td>" + val.name + "</td>" );
			items.push( "<td>" + val.username + "</td>" );
			items.push( "<td>" + val.email + "</td>" );
			items.push( "<td>" + val.idelete_name + "</td>" );
			items.push( "<td>" + val.activation_code + "</td>" );
			items.push( "<td>" + val.create_date + "</td>" );
			items.push( "<td>" + val.edit_date + "</td>" );
			items.push( "<td>" + val.department_name + "</td>" );
			items.push( "<td>" + val.rank_name + "</td>" );
			items.push( "<td>" + val.group_name + "</td>" );
			items.push( "<td>" );
			items.push( "<a class='btn btn-success btn-sm' onclick=editData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteData(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-info btn-sm' onclick=dataUserLocation(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon glyphicon-home' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-warning btn-sm' onclick=dataUserPrivilege(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon glyphicon-wrench' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#data_table").html( html );
		$('#dataTables-user').DataTable({
			responsive: true,
			"scrollX": true
		});
	}
	function dataUserLocation(user_id){
		$.ajax({
			type: 'POST',
			data: "user_id="+user_id,
			url: "<?php echo base_url()."user/get_data_user_location" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$("#user_id").val(user_id);
			$("#view-message-user-location").html( "" );
			viewDataUserLocation(obj);
		});
	}
	function viewDataUserLocation(obj) {
		$('#winTableUserLocation').modal('show');
		var items = [];
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-user-location'>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_username') ?></th>" );
		items.push( "<th><?php echo lang('label_status') ?></th>" );
		items.push( "<th><?php echo lang('label_location') ?></th>" );
		items.push( "<th><?php echo lang('label_action') ?></th>" );
		items.push( "</tr>" );
		items.push( "</thead>" );
		items.push( "<tbody>" );

		// item pertama gabisa di hapus, namun bisa di edit
		var count = 0;

		$.each(obj, function(key, val) {
			items.push( "<tr>" );
			items.push( "<td>" + val.id + "</td>" );
			items.push( "<td>" + val.username + "</td>" );
			items.push( "<td>" + val.idelete_name + "</td>" );
			items.push( "<td>" + val.location_name + "</td>" );
			items.push( "<td>" );

			if(count == 0){
				items.push( "<a class='btn btn-success btn-sm' onclick=editDataUserLocation(" + val.id + ",'1');>");
				items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
				items.push( "</a>" );
				items.push( "&nbsp;" );
			}

			// selain lokasi utama
			if(count != 0){  
				items.push( "<a class='btn btn-success btn-sm' onclick=editDataUserLocation(" + val.id + ",'0');>");
				items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
				items.push( "</a>" );
				items.push( "&nbsp;" );
				items.push( "<a class='btn btn-danger btn-sm' onclick=deleteDataUserLocation(" + val.id + ");>");
				items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			}

			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );

			count++;
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#view-data-user-location").html( html );
		$('#dataTables-user-location').DataTable({
			responsive: true
		});
	}
	function dataUserPrivilege(user_id){
		$.ajax({
			type: 'POST',
			data: "user_id="+user_id,
			url: "<?php echo base_url()."user/get_data_user_privilege" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			$("#user_id").val(user_id);
			$("#view-message-user-privilege").html( "" );
			viewDataUserPrivilege(obj);
		});
	}
	function viewDataUserPrivilege(obj) {
		$('#winTableUserPrivilege').modal('show');
		var items = [];
		items.push( "<table class='table table-striped table-bordered table-hover' id='dataTables-user-privilege' width=1800>" );
		items.push( "<thead>" );
		items.push( "<tr>" );
		items.push( "<th><?php echo lang('label_id') ?></th>" );
		items.push( "<th><?php echo lang('label_username') ?></th>" );
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
			items.push( "<td>" + val.username + "</td>" );
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
			items.push( "<a class='btn btn-success btn-sm' onclick=editDataUserPrivilege(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "&nbsp;" );
			items.push( "<a class='btn btn-danger btn-sm' onclick=deleteDataUserPrivilege(" + val.id + ");>");
			items.push( "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>");
			items.push( "</a>" );
			items.push( "</td>" );
			items.push( "</tr>" );
		});
		items.push( "</tbody>" );
		items.push( "</table>" );
		var html = items.join( "" );
		$("#view-data-user-privilege").html( html );
		$('#dataTables-user-privilege').DataTable({
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
	function addDataUserPrivilege(){
		$("#menu_id").val("");
		$("#read").prop('checked', false);
		$("#update").prop('checked', false);
		$("#delete").prop('checked', false);
		$("#report").prop('checked', false);
		$("#approve").prop('checked', false);
		$("#cancel").prop('checked', false);
		$("#view_money").prop('checked', false);
		$('#winFormUserPrivilege').modal('show');
		$('#winFormUserPrivilegeLabel').html("<?php echo lang('title_add_user_privilege') ?>");
	}
	function addDataUserLocation(){
		$("#idnya").val("0");
		$("#location_id").val("");
		$('#winFormUserLocation2').modal('show');
		$('#winFormUserLocationLabel').html("<?php echo lang('title_add_user_location') ?>");
	}
	function viewMessageUserPrivilege(success,message) {
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
		$("#view-message-user-privilege").html( html );
	}
	function viewMessageUserLocation(success,message) {
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
		$("#view-message-user-location").html( html );
	}
	$('#formUserPrivilege').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#id").val();
			var user_id = $("#user_id").val();
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
			var datap = "id="+id+"&user_id="+user_id+"&menu_id="+menu_id+"&read="+read+"&update="+update+"&delete="+del+"&report="+report+"&approve="+approve+"&cancel="+cancel+"&view_money="+view_money;
			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."user/save_data_user_privilege" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserPrivilege(obj.success,obj.message);
				viewDataUserPrivilege(obj.data);
				$('#winFormUserPrivilege').modal('hide');
			});
			//alert(datap);
			$('.form-group').removeClass('help-block');
			return false;
		}
	})
	$('#formUserLocation').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			var id = $("#idnya").val();
			var user_id = $("#user_id").val();
			var location_id = $("#location_id").val();
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id;
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id; 
			var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id; //TODO replace with serialize
			console.log(datap);
			//data: $("form[name='formUserLocation']").serialize(),

			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."user/save_data_user_location" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserLocation(obj.success,obj.message);
				viewDataUserLocation(obj.data);
				$('#winFormUserLocation').modal('hide');
			});
			//alert(datap);
			$('.form-group').removeClass('help-block');
			return false;
		}
	})

	$('#formUserLocation2').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			//var id = $("#idnya").val();
			var user_id = $("#user_id").val();
			var location_id = $("#location_id2").val();
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id;
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id; 
			var datap = "user_id="+user_id+"&location_id="+location_id; //TODO replace with serialize
			console.log(datap);
			//data: $("form[name='formUserLocation']").serialize(),

			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."user/save_data_user_location" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserLocation(obj.success,obj.message);
				viewDataUserLocation(obj.data);
				$('#winFormUserLocation2').modal('hide');
			});
			//alert(datap);
			$('.form-group').removeClass('help-block');
			return false;
		}
	})

	$('#formUserLocation3').validator().on('submit', function (e) {
		if (e.isDefaultPrevented()) {
			// handle the invalid form...
		} else {
			// everything looks good!
			//var id = $("#idnya").val();
			var id = $("#id_ul").val();
			var user_id = $("#user_id").val();
			var location_id = $("#location_id3").val();
			var isInitLoc = $("#isInitLoc").val();
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id;
			//var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id; 
			var datap = "id="+id+"&user_id="+user_id+"&location_id="+location_id+"&isInitLoc="+isInitLoc; //TODO replace with serialize
			console.log(datap);
			//data: $("form[name='formUserLocation']").serialize(),

			$.ajax({
				type: 'POST',
				data: datap,
				url: "<?php echo base_url()."user/save_data_user_location" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserLocation(obj.success,obj.message);
				viewDataUserLocation(obj.data);
				$('#winFormUserLocation3').modal('hide');
			});
			//alert(datap);
			$('.form-group').removeClass('help-block');
			return false;
		}
	})

	function editDataUserPrivilege(id){
		$('#winFormUserPrivilege').modal('show');
		$('#winFormUserPrivilegeLabel').html("<?php echo lang('title_edit_user_privilege') ?>");
		$("#id").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."user/get_data_detail_user_privilege" ?>"
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
	function editDataUserLocation(id, isInitLoc){
		//console.log("initial location : " + isInitLoc);

		$('#winFormUserLocation3').modal('show');
		$('#winFormUserLocationLabel').html("<?php echo lang('title_edit_user_location') ?>");
		$("#id_ul").val(id);
		$("#isInitLoc").val(isInitLoc);
		//console.log('user_id : ' + $("#user_id").val()); //ini dapet
		//$("#idnya").val(id);
		$.ajax({
			type: 'POST',
			data: "id="+id,
			url: "<?php echo base_url()."user/get_data_detail_user_location" ?>"
		}).done(function(data){
			//$("#idnya").val('0'); 
			var obj = jQuery.parseJSON(data);
			$("#location_id").val(obj.location_id);
		});
	}
	function deleteDataUserPrivilege(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."user/delete_data_user_privilege" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserPrivilege(obj.success,obj.message);
				viewDataUserPrivilege(obj.data);
			});
		}
		return false;
	}
	function deleteDataUserLocation(id) {
		if (confirm("Are you sure?")) {
			$.ajax({
				type: 'POST',
				data: "id="+id,
				url: "<?php echo base_url()."user/delete_data_user_location" ?>"
			}).done(function(data){
				var obj = jQuery.parseJSON(data);
				viewMessageUserLocation(obj.success,obj.message);
				viewDataUserLocation(obj.data);
			});
		}
		return false;
	}
	$(document).ready(function() {
		$.ajax({
			type: 'GET',
			url: "<?php echo base_url()."user/get_data" ?>"
		}).done(function(data){
			var obj = jQuery.parseJSON(data);
			viewData(obj);
		});
	});
</script>
<script src="<?php echo base_url('resources/moment.js'); ?>"></script>
    <script src="<?php echo base_url('resources/bootstrap-datetimepicker.min.js'); ?>"></script>
