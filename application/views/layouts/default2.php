<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

        <link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>" rel='stylesheet'>
		<link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/metisMenu/dist/metisMenu.min.css') ?>" rel='stylesheet'>
		<link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/dist/css/timeline.css') ?>" rel='stylesheet'>
		<link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/dist/css/sb-admin-2.css') ?>" rel='stylesheet'>
		<link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/morrisjs/morris.css') ?>" rel='stylesheet'>
		<link href="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/font-awesome/css/font-awesome.min.css') ?>" rel='stylesheet' type='text/css'>
<!-- jQuery -->
        <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
		<title><?php echo $title; ?></title>
	</head>
	<body>
        <style>
        .error { font-weight: bold; color: red; background: pink; width: 100%; float:left; padding-left: 5px;}
        #flash-message { width: 100%; display: none; visibility: visible; z-index: 22999; position: fixed; text-align: center;}
        .flash-message-text { width: 250px;
        margin-left: auto;
        margin-right: auto;
        background-color: #6ae;
        color: white;
        padding-top: 20px;
        padding-bottom: 20px;
        border-radius: 1em;
        border: 3px solid #428bca;
        margin-top: 10px;}
        .blue {color: #337ab7 }
        </style>
        <div id="flash-message">
            <div class="flash-message-text"><?php echo $this->session->flashdata('flash_message') ?></div>
        </div>

		<div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url('main/dashboard'); ?>"><?php echo $this->session->userdata('prefix_') ?> GENERAL <i class="fa fa-home blue"> </i></a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    
                </ul>
                <?php if( !isset($navs)): ?>
                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">
                            <li>
                                <a href="<?php echo base_url()."main/home"; ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> User Access Control<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        <a href="<?php echo base_url()."main/menu"; ?>">Menu</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."main/group"; ?>">Group</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."main/location"; ?>">Location</a>
                                    </li>
                                    <li>
                                        <a href="<?php echo base_url()."main/user"; ?>">User</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div><!-- .sidebar -->
                <?php else: ?>
                <?php echo $navs ?>
                <?php endif; ?>
            </nav>

            <?php if ( $content ): ?>
            <div id="page-wrapper">
                <?php echo $content;?>
                <!-- /.row -->
            </div>
            <?php endif; ?>
        <!-- /#page-wrapper -->
        </div>
	</body>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/metisMenu/dist/metisMenu.min.js'); ?>"></script>
    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/datatables/media/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js'); ?>"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('resources/startbootstrap-sb-admin-2-1.0.7/dist/js/sb-admin-2.js'); ?>"></script>
    <script src="<?php echo base_url('resources/moment.js'); ?>"></script>
    <script src="<?php echo base_url('resources/bootstrap-datetimepicker.min.js'); ?>"></script>
    <!-- Form Validator -->
    <script src="<?php echo base_url('resources/validator/validator.min.js'); ?>"></script>
    <style>
    .datepicker .prev, .datepicker .next , .datepicker .day { cursor: pointer; cursor: hand;}
    </style>
</html>
