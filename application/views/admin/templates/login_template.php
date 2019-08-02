<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="<?php echo site_url() . 'assets/admin/images/favicon.png'; ?>">
	<title><?php echo config_item('site_name'); ?></title>
	<link href="<?php echo site_url('assets/admin/') ?>css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url('assets/admin/') ?>css/core.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url('assets/admin/') ?>css/components.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url('assets/admin/') ?>css/icons.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url('assets/admin/') ?>css/pages.css" rel="stylesheet" type="text/css"/>
	<link href="<?php echo site_url('assets/admin/') ?>css/responsive.css" rel="stylesheet" type="text/css"/>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->
	<script src="<?php echo site_url('assets/admin/') ?>js/modernizr.min.js"></script>
</head>
<body>
<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
	<div class=" card-box">
		<?php echo $content ?>
	</div>
</div>
<!-- jQuery  -->
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.min.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/bootstrap.min.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/detect.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/fastclick.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.slimscroll.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.blockUI.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/waves.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/wow.min.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.nicescroll.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.scrollTo.min.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.core.js"></script>
<script src="<?php echo site_url('assets/admin/') ?>js/jquery.app.js"></script>
<!-- Parsleyjs -->
<script type="text/javascript"
		src="<?php echo site_url('assets/admin/') ?>plugins/parsleyjs/dist/parsley.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
		$('form').parsley();
	});
</script>
</body>
</html>