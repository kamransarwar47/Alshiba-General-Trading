<?php $order_data = $order_details->result_array() ?>
<!-- Page-Title -->
<div class="row no-print">
	<div class="col-sm-12">
		<div class="pull-right m-b-15">
			<button onclick="window.print();" class="btn btn-info waves-effect waves-light"><i class="fa fa-print"></i> Print</button>
			<a href="<?php echo site_url('admin/orders') ?>" class="btn btn-primary waves-effect waves-light m-l-10">Go to
				Orders</a>
		</div>
		<h4 class="page-title">Order Details</h4>
	</div>
</div>
<!-- Page-Title -->
<div class="row remove_top_margin">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-right"><img style="width: 250px;"
													src="<?php echo base_url('assets/admin/images/logo.png') ?>"
													alt="Al shiba"></h4>
					</div>
					<div class="pull-right">
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<div class="pull-left m-t-30 col-md-8">
							<address>
								<strong>Name : </strong><?php echo $order_data[0]['name']; ?><br>
								<strong>Email : </strong><?php echo $order_data[0]['email']; ?><br>
								<strong>Phone : </strong><?php echo $order_data[0]['phone']; ?><br>
								<strong>Address : </strong><?php echo $order_data[0]['address']; ?><br>
							</address>
						</div>
						<div class="pull-right m-t-30">
							<p><strong>Order
									Date: </strong><?php echo date('M d, Y', $order_data[0]['orders_time_date']) ?></p>
						</div>
					</div>
				</div>
				<div class="m-h-50"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table m-t-30">
								<thead>
								<tr>
									<th>#</th>
									<th>PRODUCT NAME</th>
									<th>PRODUCT MODEL</th>
									<th>PRODUCT QUANTITY</th>
									<th>BRAND</th>
									<th>CATEGORY</th>
								</tr>
								</thead>
								<?php
								$i = 0;
								foreach ($order_data as $row) {
									$i++;
									?>
									<tbody>
									<tr>
										<td>
											<?php echo $i ?>
										</td>
										<td>
											<?php echo $row['product_title'] ?>
										</td>
										<td>
											<?php echo $row['product_model'] ?>
										</td>
										<td>
											<?php echo $row['product_quantity'] ?>
										</td>
										<td>
											<?php echo $row['brand_title'] ?>
										</td>
										<td>
											<?php echo $row['category_title'] ?>
										</td>
									</tr>
									</tbody>
									<?php
								}
								?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>