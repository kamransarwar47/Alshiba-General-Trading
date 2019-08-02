<!DOCTYPE html>
<html>
<head>
	<?php $this->load->view('admin/includes/head'); ?>
</head>
<body>
<header id="topnav">
	<?php $this->load->view('admin/includes/header'); ?>
	<?php $this->load->view('admin/includes/menu'); ?>
</header>
<div class="wrapper">
	<div class="container">
		<?php echo $content; ?>
		<!-- Footer -->
		<?php $this->load->view('admin/includes/footer') ?>
		<!-- End Footer -->
	</div>
</div>
<?php $this->load->view('admin/includes/scripts') ?>
</body>
</html>