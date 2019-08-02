<!DOCTYPE html>
<html lang="en">

<head>
	<?php $this->load->view('includes/head_files'); ?>
</head>

<body>

<!-- Navigation -->
<?php $this->load->view('includes/header'); ?>

<?php echo $content; ?>

<!-- Footer -->
<?php $this->load->view('includes/footer'); ?>

<?php $this->load->view('includes/footer_files'); ?>

</body>

</html>