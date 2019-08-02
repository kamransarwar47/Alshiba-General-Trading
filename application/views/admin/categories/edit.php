<?php $category_data = $category->row(); ?>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/categories') ?>" class="btn btn-primary waves-effect waves-light">Go to
				Categories</a>
		</div>
		<h4 class="page-title">Edit Category</h4>
	</div>
</div>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="card-box">
			<div class="row">
				<div class="col-md-12">
					<?php
						$attributes = ['class' => 'form-horizontal', 'id' => 'Category_add_form'];
						echo form_open_multipart('', $attributes);
						echo form_hidden('id', $category_data->id);
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
							echo form_label('Name', 'name', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'category_name',
										 'id'          => 'category_name',
										 'value'       => set_value('category_name', $category_data->category_name),
										 'class'       => 'form-control',
										 'placeholder' => 'Category Name',
										 'required'    => '',];
								echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Name', 'name', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'        => 'category_description',
										 'id'          => 'category_description',
										 'value'       => set_value('category_description', $category_data->category_description),
										 'class'       => 'form-control',
										 'placeholder' => 'Category Description...',
										 'rows'        => 5,
										 'required'    => '',];
								echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('', '', $attributes);
						?>
						<div class="col-md-10 pull-right">
							<img class="admin-image" style="width: 120px; height: 50px;"
								src="<?php echo base_url("uploads/categories/admin/admin_$category_data->category_image") ?>"
								title="Category Image" alt="Category Image"/>
						</div>
					</div>
					<div class="form-group">
						<?php
							$attributes = ['class' => 'col-md-2 control-label',];
							echo form_label('Category Image', 'image', $attributes);
						?>
						<div class="col-md-10">
							<?php
								$data = ['name'      => 'image',
										 'id'        => 'image',
										 'type'      => 'file',
										 'class'     => 'filestyle',
										 'data-size' => 'sm',];
								echo form_input($data);
								echo form_hidden('old_image', $category_data->category_image);
							?>
							<span class="help-block"><small>Minimum image size required 275x90 pixels</small></span>
						</div>
					</div>
					<div class="form-group pull-right m-r-5">
						<?php
							$data = ['name'    => 'submit',
									 'type'    => 'submit',
									 'class'   => 'btn btn-primary waves-effect waves-light',
									 'content' => 'Edit Category',];
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
<script src="<?php echo base_url('assets/admin/') ?>plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js"
		type="text/javascript"></script>
<script src="<?php echo base_url('assets/admin/') ?>js/validate.js"></script>
<script>
	$(document).ready(function() {
		$(":file").filestyle({input: false});
		$('#Category_add_form').validate();
	});
</script>