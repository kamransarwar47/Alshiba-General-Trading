<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="pull-right m-b-15">
			<a href="<?php echo site_url('admin/product/add_file/' . $product_id) ?>"
			   class="btn btn-primary waves-effect waves-light">Add
				New File</a>
			<a href="<?php echo site_url('admin/product/') ?>"
			   class="btn btn-inverse waves-effect waves-light m-l-10">Back to products</a>
		</div>
		<h4 class="page-title">Product Files</h4>
	</div>
</div>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<?php echo $this->session->flashdata('message'); ?>
			<table id="datatable" class="table table-striped table-bordered">
				<thead>
				<tr>
					<th class="text-center">Title</th>
					<th class="text-center">file</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
					if($product_files->num_rows() > 0){
						?>
						<tbody>
						<?php
							foreach($product_files->result() as $download){
								?>
								<tr>
									<td class="text-center"><?php echo $download->file_title ?></td>
									<td class="text-center"><a target="_blank"
															   href="<?php echo base_url('uploads/products/files/' . $download->product_file) ?>"
															   download> <?php echo $download->file_title ?></a></td>
									<td class="text-center">
										<a href="<?php echo site_url('admin/product/edit_file/' . $product_id . '/' . $download->id) ?>"
										   class="btn btn-icon waves-effect waves-light btn-warning"><i
												class="fa fa-edit"></i></a>
										<a href="<?php echo site_url('admin/product/delete_file/' . $download->id . '/' . $product_id) ?>"
										   class="btn btn-icon waves-effect waves-light btn-danger"><i
												class="fa fa-remove"></i></a>
									</td>
								</tr>
								<?php
							}
						?>
						</tbody>
						<?php
					}
				?>
			</table>
		</div>
	</div>
</div>
<script src="<?php echo base_url('assets/admin/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/admin/') ?>plugins/datatables/dataTables.bootstrap.js"></script>
<script>
	$(document).ready(function() {
		$('#datatable').dataTable();
	});
</script>