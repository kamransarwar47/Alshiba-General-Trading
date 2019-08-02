<?php
$brands_option   = [];
$category_option = [];
if ($brands->num_rows() > 0) {
	foreach ($brands->result() as $row) {
		$brands_option[$row->id] = $row->brand_name;
	}
}
if ($categories->num_rows() > 0) {
	foreach ($categories->result() as $row) {
		$category_option[$row->id] = $row->category_name;
	}
}
?>
<link href="<?php echo base_url('assets/admin/') ?>plugins/bootstrap-select/dist/css/bootstrap-select.min.css"
	  rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url(); ?>ckeditor/ckeditor.js"></script>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/product') ?>" class="btn btn-primary waves-effect waves-light">Go to
				products</a>
		</div>
		<h4 class="page-title">Add Product</h4>
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
					if (validation_errors() != '') { ?>
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
						echo form_label('Select Brand', 'brand', $attributes);
						?>
						<div class="col-md-4">
							<?php
							$attributes = ['class' => 'selectpicker', 'data-style' => 'btn-primary btn-custom'];
							echo form_dropdown('product_brand_id', $brands_option, set_value('brand'), $attributes);
							?>
						</div><?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Select Category', 'category', $attributes);
						?>
						<div class="col-md-4">
							<?php
							$attributes = ['class' => 'selectpicker', 'data-style' => 'btn-primary btn-custom'];
							echo form_dropdown('product_category_id', $category_option, set_value('product_category_id'), $attributes);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Product title', 'product_title', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'        => 'product_title',
									 'id'          => 'product_title',
									 'value'       => set_value('product_title'),
									 'class'       => 'form-control',
									 'placeholder' => 'Product Name',
									 'required'    => '',];
							echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Product Model', 'product_model', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'        => 'product_model',
									 'id'          => 'product_model',
									 'value'       => set_value('product_model'),
									 'class'       => 'form-control',
									 'placeholder' => 'Product Model',
									 'required'    => '',];
							echo form_input($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Product description', 'product_description', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'        => 'product_description',
									 'id'          => 'product_description',
									 'value'       => set_value('product_description'),
									 'class'       => 'form-control',
									 'placeholder' => 'product Description...',
									 'rows'        => 5,
									 'required'    => '',];
							echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Product features', 'product_features', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'     => 'product_features',
									 'id'       => 'product_features',
									 'value'    => set_value('product_features'),
									 'class'    => 'form-control',
									 'rows'     => 5,
									 'required' => '',];
							echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Product specifications', 'product_specifications', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'     => 'product_specifications',
									 'id'       => 'product_specifications',
									 'value'    => set_value('product_specifications'),
									 'class'    => 'form-control',
									 'rows'     => 5,
									 'required' => '',];
							echo form_textarea($data);
							?>
						</div>
					</div>
					<div class="form-group">
						<?php
						$attributes = ['class' => 'col-md-2 control-label',];
						echo form_label('Image', 'image', $attributes);
						?>
						<div class="col-md-10">
							<?php
							$data = ['name'      => 'image[]',
									 'id'        => 'image',
									 'type'      => 'file',
									 'required'  => '',
									 'class'     => 'filestyle',
									 'data-size' => 'sm',
									 'multiple'  => ''];
							echo form_input($data);
							?>
							<span class="help-block"><small>You can select and upload multiple images at once. Minimum image size required 360x265 pixels*
								</small></span>
						</div>
					</div>
					<div class="form-group pull-right m-r-5">
						<?php
						$data = ['name'    => 'submit',
								 'type'    => 'submit',
								 'class'   => 'btn btn-primary waves-effect waves-light',
								 'content' => 'Add Product',];
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
	$(document).ready(function () {
		$(":file").filestyle({input: false});
		$('#brand_add_form').validate();
		$('.selectpicker').selectpicker();
	});
</script>