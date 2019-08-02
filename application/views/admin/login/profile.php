<?php
$admin_data	=	$admin_data->row();
?>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
		</div>
		<h4 class="page-title m-b-15">Profile</h4>
	</div>
</div>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<div class="row">
				<div class="col-md-12">
					<?php
						$attributes = ['class' => 'form-horizontal', 'id' => 'brand_add_form'];
						echo form_open_multipart('', $attributes);
						if(validation_errors() != ''){ ?>
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
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Name', 'admin_name', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'admin_name',
										 'id'          => 'admin_name',
										 'value'       => set_value('admin_name',$admin_data->admin_name),
										 'class'       => 'form-control',
										 'placeholder' => 'Name',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('User name', 'admin_user_name', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'admin_user_name',
										 'id'          => 'admin_user_name',
										 'value'       => set_value('admin_user_name',$admin_data->admin_user_name),
										 'class'       => 'form-control',
										 'placeholder' => 'User Name',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Email', 'admin_email', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'admin_email',
										 'id'          => 'admin_email',
										 'value'       => set_value('admin_email',$admin_data->admin_email),
										 'class'       => 'form-control',
										 'placeholder' => 'Email',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Phone', 'phone', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'phone',
										 'id'          => 'phone',
										 'value'       => set_value('phone',$admin_data->phone),
										 'class'       => 'form-control',
										 'placeholder' => 'Email',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Header Text', 'header_text', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'header_text',
										 'id'          => 'header_text',
										 'value'       => set_value('header_text',$admin_data->header_text),
										 'class'       => 'form-control',
										 'placeholder' => 'Header text',
										 'rows'=>5,
										 'required'    => '',];
								echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Footer Text', 'name', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'footer_text',
										 'id'          => 'footer_text',
										 'value'       => set_value('footer_text',$admin_data->footer_text),
										 'class'       => 'form-control',
										 'rows'=>5,
										 'placeholder' => 'footer text',
										 'required'    => '',];
								echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Password', 'admin_password', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'admin_password',
'type'=>'password',
										 'id'          => 'admin_password',
										 'value'       => set_value('admin_password'),
										 'class'       => 'form-control',
										 'placeholder' => 'Password',
										 ];
								echo form_input($data);
							?>
						</div>
					</div>

					<div class="form-group pull-right m-r-5">
						<?php
							$data = ['name'    => 'submit',
									 'type'    => 'submit',
									 'class'   => 'btn btn-primary waves-effect waves-light',
									 'content' => 'Update Profile',];
							echo form_button($data);
						?>
					</div>
					<?php
						echo form_close();
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Parsleyjs -->
<script src="<?php echo base_url('assets/admin/') ?>js/validate.js"></script>
<script>
	$(document).ready(function() {
		$('#brand_add_form').validate();
	});
</script>