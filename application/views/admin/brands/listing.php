<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/brands/add') ?>" class="btn btn-primary waves-effect waves-light">Add
				New Brand</a>
		</div>
		<h4 class="page-title">Brands</h4>
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
					<th class="text-center">Name</th>
					<th class="text-center">description</th>
					<th class="text-center">Image</th>
					<th class="text-center">Header Image</th>
					<th class="text-center">Status</th>
					<th class="text-center">Date</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
				if ($brands->num_rows() > 0) {
					?>
					<tbody>
					<?php
					foreach ($brands->result() as $brand) {
						$status = get_status($brand->brand_status);
						?>
						<tr>
							<td class="text-center"><?php echo $brand->brand_name ?></td>
							<td class="text-center"><?php echo $brand->brand_description ?></td>
							<td class="text-center"><img style="width: 40px;"
														 src="<?php echo base_url("uploads/brands/admin/admin_$brand->brand_image") ?>"
														 title="Brand Image" alt="Brand Image"/></td>
							<td class="text-center"><img style="width: 130px; height: 40px;"
														 src="<?php echo base_url("uploads/brands/admin/admin_$brand->brand_header_image") ?>"
														 title="Brand Image" alt="Brand Image"/></td>
							<td class="text-center"><a
									href="<?php echo site_url('admin/brands/change_status/' . $brand->id) . '/' . $status['status'] ?>"
									class="btn btn-inverse waves-effect waves-light btn-xs"><?php echo $status['text']; ?></a>
							</td>
							<td class="text-center"><?php echo date('d-m-Y', $brand->brand_time_date) ?></td>
							<td class="text-center">
								<a href="<?php echo site_url('admin/brands/edit/' . $brand->id) ?>"
								   class="btn btn-icon waves-effect waves-light btn-warning"><i
										class="fa fa-edit"></i></a>
								<a href="<?php echo site_url('admin/brands/delete/' . $brand->id) ?>"
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
			columnDefs: [{
				targets: 1,
				render : $.fn.dataTable.render.ellipsis(30, true)
			}]
		});
	});
</script>