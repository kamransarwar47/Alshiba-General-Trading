<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/categories/add') ?>" class="btn btn-primary waves-effect waves-light">Add
				New Category</a>
		</div>
		<h4 class="page-title">Categories</h4>
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
					<th class="text-center">Status</th>
					<th class="text-center">Date</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
				if ($categories->num_rows() > 0) {
					?>
					<tbody>
					<?php
					foreach ($categories->result() as $category) {
						$status = get_status($category->category_status);
						?>
						<tr>
							<td class="text-center"><?php echo $category->category_name ?></td>
							<td class="text-center"><?php echo $category->category_description ?></td>
							<td class="text-center"><img style="width: 120px; height: 40px;" src="<?php echo base_url("uploads/categories/admin/admin_$category->category_image") ?>"
														 title="Brand Image" alt="Brand Image"/></td>
							<td class="text-center"><a
									href="<?php echo site_url('admin/categories/change_status/' . $category->id) . '/' . $status['status'] ?>"
									class="btn btn-inverse waves-effect waves-light btn-xs"><?php echo $status['text']; ?></a>
							</td>
							<td class="text-center"><?php echo date('d-m-Y', $category->category_time_date) ?></td>
							<td class="text-center">
								<a href="<?php echo site_url('admin/categories/edit/' . $category->id) ?>"
								   class="btn btn-icon waves-effect waves-light btn-warning"><i
										class="fa fa-edit"></i></a>
								<a href="<?php echo site_url('admin/categories/delete/' . $category->id) ?>"
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