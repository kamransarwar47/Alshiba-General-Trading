<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12" style="margin-bottom: 20px;">
		<h4 class="page-title">Latest Products</h4>
	</div>
</div>
<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<?php echo $this->session->flashdata('message'); ?>
			<table class="table table-striped table-bordered">
				<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Title</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
				if ($latest_products->num_rows() > 0) {
					$count      = 1;
					$total_rows = $latest_products->num_rows();
					?>
					<tbody>
					<?php
					foreach ($latest_products->result() as $row) {
						?>
						<tr>
							<td class="text-center"><?php echo $count; ?></td>
							<td class="text-center"><?php echo $row->product_title; ?></td>
							<td class="text-center">
								<?php
								if ($total_rows > 1) {
									if ($count == 1) {
										?>
										<a href="<?php echo site_url() . 'admin/product/shift_products/' . $row->id . '/' . $row->product_mark_number . '/down'; ?>"
										   class="btn btn-icon waves-effect waves-light btn-danger"><i
												class="fa fa-chevron-down"></i></a>
										<?php
									} else if ($count == $total_rows) {
										?>
										<a href="<?php echo site_url() . 'admin/product/shift_products/' . $row->id . '/' . $row->product_mark_number . '/up'; ?>"
										   class="btn btn-icon waves-effect waves-light btn-success"><i
												class="fa fa-chevron-up"></i></a>
										<?php
									} else {
										?>
										<a href="<?php echo site_url() . 'admin/product/shift_products/' . $row->id . '/' . $row->product_mark_number . '/down'; ?>"
										   class="btn btn-icon waves-effect waves-light btn-danger"><i
												class="fa fa-chevron-down"></i></a>
										<a href="<?php echo site_url() . 'admin/product/shift_products/' . $row->id . '/' . $row->product_mark_number . '/up'; ?>"
										   class="btn btn-icon waves-effect waves-light btn-success"><i
												class="fa fa-chevron-up"></i></a>
										<?php
									}
								}
								?>
							</td>
						</tr>
						<?php
						$count++;
					}
					?>
					</tbody>
					<?php
				} else {
					?>
					<tr>
						<td colspan="3">No data available in table</td>
					</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>
</div>