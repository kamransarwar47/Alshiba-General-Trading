<div class="panel-heading">
	<img src="<?php echo base_url() . 'assets/admin/images/logo.png' ?>" style="height: 58px;">
</div>
<div class="panel-body">
	<?php
	$attributes = ['class' => 'form-horizontal m-t-20'];
	echo form_open('', $attributes);
	?>
	<?php if (validation_errors() != '') { ?>
		<div class="alert alert-danger alert-dismissible">
			<?php
			$data = ['name'         => 'button',
					 'class'        => 'close',
					 'data-dismiss' => 'alert',
					 'type'         => 'button',
					 'content'      => '<i class = "fa fa-remove"></i>',];
			echo form_button($data);
			?><?php echo validation_errors(); ?>
		</div>
	<?php } ?>
	<?php echo $this->session->flashdata('message'); ?>
	<div class="form-group ">
		<div class="col-xs-12">
			<?php
			$data = ['name'            => 'username',
					 'id'              => 'username',
					 'placeholder'     => 'Username',
					 'value'           => set_value('username'),
					 'class'           => 'form-control',
					 'autofocus'       => 1,
					 'parsley-trigger' => 'change',
					 'required'        => 'required'];
			echo form_input($data);
			?>
		</div>
	</div>
	<div class="form-group">
		<div class="col-xs-12">
			<?php
			$data = ['name'            => 'password',
					 'id'              => 'password',
					 'placeholder'     => 'Password',
					 'class'           => 'form-control',
					 'parsley-trigger' => 'change',
					 'required'        => 'required'];
			echo form_password($data);
			?>
		</div>
	</div>
	<div class="form-group text-center m-t-40">
		<div class="col-xs-12">
			<?php
			$data = ['name'    => 'submit',
					 'value'   => 'Sign_in',
					 'type'    => 'submit',
					 'class'   => 'btn btn-danger btn-custom btn-rounded waves-effect waves-light',
					 'content' => 'LOG IN',];
			echo form_button($data);
			?>
		</div>
	</div>
	<div class="form-group m-t-30 m-b-0">
		<div class="col-sm-12">
			<a href="<?php echo site_url('admin/forgot_password') ?>" class="text-dark"><i
					class="fa fa-lock m-r-5"></i> Forgot your
				password?</a>
		</div>
	</div>
	<?php
	echo form_close();
	?>
</div>