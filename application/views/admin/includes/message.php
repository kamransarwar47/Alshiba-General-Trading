<?php
	$class = 'success';
	if(isset($status)){
		switch($status){
			case'info':
				$class = 'info';
				break;
			case'warning':
				$class = 'warning';
				break;
			case'danger':
				$class = 'danger';
				break;
			case'error':
				$class = '';
				break;
		}
	}
?>
<div class="alert alert-<?php echo $class; ?> alert-dismissable">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php echo $message ?>
</div>