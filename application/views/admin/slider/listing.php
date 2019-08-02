<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="btn-group pull-right m-b-15">
			<a href="<?php echo site_url('admin/slider/add') ?>" class="btn btn-primary waves-effect waves-light">Add
				New image</a>
		</div>
		<h4 class="page-title">Slider Images</h4>
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
					<th class="text-center">Image</th>
					<th class="text-center">Status</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
				if ($slider->num_rows() > 0) {
					?>
					<tbody>
					<?php
					foreach ($slider->result() as $image) {
						$status = get_status($image->slider_status);
						?>
						<tr>
							<td class="text-center"><img style="width: 100px; height: 30px;"
														 src="<?php echo base_url("uploads/slider/admin/admin_$image->slider_image") ?>"
														 title="Brand Image" alt="Brand Image"/></td>
							<td class="text-center"><a
									href="<?php echo site_url('admin/slider/change_status/' . $image->id) . '/' . $status['status'] ?>"
									class="btn btn-inverse waves-effect waves-light btn-xs"><?php echo $status['text']; ?></a>

							<td class="text-center">
								<a href="<?php echo site_url('admin/slider/delete/' . $image->id . '/' . urlencode($image->slider_image)) ?>"
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
	$(document).ready(function () {
		$('#datatable').dataTable();
	});
</script>