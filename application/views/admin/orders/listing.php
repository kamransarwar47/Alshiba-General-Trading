<!-- Page-Title -->
<div class="row">
	<div class="col-sm-12" style="margin-bottom: 20px;">
		<h4 class="page-title">Orders</h4>
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
					<th class="text-center">Sr #</th>
					<th class="text-center">Name</th>
					<th class="text-center">Email</th>
					<th class="text-center">Phone</th>
					<th class="text-center">Address</th>
					<th class="text-center">Date</th>
					<th class="text-center">Actions</th>
				</tr>
				</thead>
				<?php
					if($orders->num_rows() > 0){
						?>
						<tbody>
						<?php
							$i=0;
							foreach($orders->result() as $order){
								$i++;
								?>
								<tr>
									<td class="text-center"><?php echo $i; ?></td>
									<td class="text-center"><?php echo $order->name ?></td>
									<td class="text-center"><?php echo $order->email ?></td>
									<td class="text-center"><?php echo $order->phone ?></td>
									<td class="text-left"><?php echo $order->address ?></td>
									<td class="text-center"><?php echo date('d-m-Y', $order->orders_time_date); ?></td>
									<td class="text-center">
										<a href="<?php echo site_url('admin/orders/details/' . $order->id) ?>"
										   class="btn btn-icon waves-effect waves-light btn-primary"><i
												class="fa fa-search"></i></a>
										<a href="<?php echo site_url('admin/orders/delete/' . $order->id) ?>"
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
				targets: 4,
				render : $.fn.dataTable.render.ellipsis(30, true)
			}]
		});
	});
</script>