<?php
	$file_data = $product_file->row();
?>
<link href="<?php echo base_url('assets/admin/') ?>plugins/bootstrap-select/dist/css/bootstrap-select.min.css"
	  rel="stylesheet"/>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/product') ?>" class="btn btn-primary waves-effect waves-light">Go to
				files</a>
		</div>
		<h4 class="page-title">Edit Product File</h4>
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
						echo form_hidden('file_id', $file_id);
						echo form_hidden('old_file', $file_data->product_file);
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
							echo form_label('File title', 'file_title', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'file_title',
										 'id'          => 'file_title',
										 'value'       => set_value('file_title', $file_data->file_title),
										 'class'       => 'form-control',
										 'placeholder' => 'File Title',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Image', 'product_file', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'      => 'product_file',
										 'id'        => 'product_file',
										 'type'      => 'file',
										 'class'     => 'filestyle',
										 'data-size' => 'sm',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group pull-right m-r-5">
						<a target="_blank" class="  btn btn-inverse waves-effect waves-light"
						   href="<?php echo base_url('uploads/products/files/' . $file_data->product_file) ?>" download>
							View File</a>
						<?php
							$data = ['name'    => 'submit',
									 'type'    => 'submit',
									 'class'   => 'btn btn-primary waves-effect waves-light',
									 'content' => 'Edit File',];
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
<script src="<?php echo base_url('assets/admin/') ?>plugins/bootstrap-select/dist/js/bootstrap-select.min.js"
		type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"
		type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>js/validate.js"></script>
<script type="text/javascript">
	CKEDITOR.replace('product_features');
	CKEDITOR.replace('product_specifications');
	$(document).ready(function() {
		$(":file").filestyle({input: false});
		$('#brand_add_form').validate();
		$('.selectpicker').selectpicker();
	});
</script>