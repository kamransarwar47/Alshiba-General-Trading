<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/product/add') ?>" class="btn btn-primary waves-effect waves-light">Add
				New Product</a>
		</div>
		<h4 class="page-title">Products</h4>
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
					<th class="text-center">Description</th>
					<th class="text-center">Product model</th>
					<th class="text-center">Brand</th>
					<th class="text-center">Category</th>
					<th class="text-center">Mark Latest</th>
					<th class="text-center">New Arrival</th>
					<th class="text-center">Download Files</th>
					<th class="text-center" style="min-width: 95px !important;">Actions</th>
				</tr>
				</thead>
				<?php
				if ($products->num_rows() > 0) {
					?>
					<tbody>
					<?php
					foreach ($products->result() as $product) {
						$status = get_status($product->category_status);
						?>
						<tr>
							<td class="text-center"><?php echo $product->product_title ?></td>
							<td class="text-center"><?php echo $product->product_description ?></td>
							<td class="text-center"><?php echo $product->product_model ?></td>
							<td class="text-center"><?php echo $product->brand_name ?></td>
							<td class="text-center"><?php echo $product->category_name ?></td>
							<?php
							if ($product->product_mark_number > 0) {
								$mark_status = 0;
								$btn_class   = 'btn-danger';
								$btn_name    = 'UnMark';
							} else {
								$mark_status = 1;
								$btn_class   = 'btn-primary remove_mark_btn';
								$btn_name    = 'Mark';
							}
							?>
							<td class="text-center">
								<a href="<?php echo site_url('admin/product/mark_latest_product/' . $product->product_id . '/' . $mark_status); ?>"
								   class="btn <?php echo $btn_class; ?> waves-effect waves-light btn-xs"><?php echo $btn_name; ?></a>
							</td>
							<?php
							if ($product->product_new_arrival > 0) {
								$mark_status = 0;
								$btn_class   = 'btn-danger';
								$btn_name    = 'Marked';
							} else {
								$mark_status = 1;
								$btn_class   = 'btn-primary';
								$btn_name    = 'Mark';
							}
							?>
							<td class="text-center">
								<a href="<?php echo site_url('admin/product/mark_new_arrival/' . $product->product_id . '/' . $mark_status); ?>"
								   class="btn <?php echo $btn_class; ?> waves-effect waves-light btn-xs"><?php echo $btn_name; ?></a>
							</td>
							<td class="text-center"><a
									href="<?php echo site_url('admin/product/download_files/' . $product->product_id) ?>"
									class="btn btn-inverse waves-effect waves-light btn-xs">Download files</a></td>
							<td class="text-center">
								<a href="<?php echo site_url('admin/product/edit/' . $product->product_id) ?>"
								   class="btn btn-icon waves-effect waves-light btn-warning"><i
										class="fa fa-edit"></i></a>
								<a href="<?php echo site_url('admin/product/delete/' . $product->product_id) ?>"
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
<script src="<?php echo base_url('assets/admin/') ?>plugins/datatables/ellipsis.js"></script>
<script>
	$(document).ready(function () {
		$('#datatable').dataTable({
			columnDefs  : [{
				targets: 1,
				render : $.fn.dataTable.render.ellipsis(30, true)
			}],
			"createdRow": function (row, data, index) {
				<?php if ($latest_products_count >= 8) { ?>
				$('.remove_mark_btn').remove();
				<?php } ?>
			}
		});
	});
</script>