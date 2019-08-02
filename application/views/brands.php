<?php
$brand_detail = $brand_details->result_array();
?>
<div class="container">

	<div class="row prod-hero">
		<div class="col-md-12 noPadLR">
			<img
				src="<?php echo base_url() . 'uploads/brands/header_image/' . $brand_detail[0]['brand_header_image']; ?>"
				class="img-responsive center-block ">
		</div>
	</div>

	<div class="row">
		<div class="col-md-3">
			<div class="card-filter-w">
				<img src="<?php echo base_url() . 'uploads/brands/' . $brand_detail[0]['brand_image']; ?>"
					 class="img-responsive center-block">
				<br/>

				<ul class="noBullet category_listing">
					<li><a href="javascript:;" id="<?php echo $brand_id; ?>,0"
						   class="upper active-filter link-disabled">All
							Products</a></li>
					<?php
					if ($categories->num_rows() > 0) {
						foreach ($categories->result_array() as $row) {
							?>
							<li><a href="javascript:;" id="<?php echo $brand_id . ',' . $row['id']; ?>"
								   class="upper"><?php echo strtoupper($row['category_name']); ?></a></li>
							<?php
						}
					}
					?>

				</ul>
			</div>

			<div class="card-filter-other-w">
				<h3 class="noMarT noMarB h4 fBold padLR40">BRANDS</h3>
				<div class="checkbox-w">
					<?php
					if ($brands->num_rows() > 0) {
						foreach ($brands->result_array() as $row) {
							if ($row['id'] == $brand_id) {
								continue;
							}
							?>
							<div class="checkbox padLR40"><label><input type="checkbox" class="brand_name"
																		id="<?php echo $row['id']; ?>"><?php echo ucwords($row['brand_name']); ?>
								</label></div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>

		<div class="col-md-9">
			<div class="col-md-12 page-desc-w text-white">
				<h1 class="fBold noMarT"><?php echo strtoupper($brand_detail[0]['brand_name']); ?></h1>
				<p><?php echo $brand_detail[0]['brand_description']; ?></p>
			</div>

			<div class="add_cart_msg" style="display: none;"></div>
			<div id="brand_product_listing">
				<?php
				if ($products_listing->num_rows() > 0) {
					foreach ($products_listing->result_array() as $row) {
						?>
						<div class="card">
							<div class="col-xs-12 col-md-5 noPadLR img-w">
								<img src="<?php echo base_url() . 'uploads/products/' . $row['product_image']; ?>"
									 class="center-block">
							</div>

							<div class="col-xs-12 col-md-7 item-details-w">
								<div class="row text-w">
									<div class="col-xs-12 col-md-12 noPadLR">
										<h2 class="h3 text-red fBold noMarT"><a
												href="<?php echo site_url() . 'products/details/' . $row['product_url_name']; ?>"
												class="item-name"><?php echo strtoupper($row['product_title']); ?></a>
										</h2>
										<p class=""><?php echo $row['product_description']; ?></p>
									</div>
								</div>

								<div class="row item-footer">
									<div class="col-md-6 hidden-xs hidden-sm text-center">
									<span
										class="text-gray fThin upper"><?php echo strtoupper($row['category_name']); ?></span>
									</div>

									<div class="col-xs-12 col-md-6 noPadLR text-center">
										<a href="javascript:;" id="<?php echo $row['id']; ?>"
										   class="upper fBold addToCart">
											<i class="fa fa-cart-plus animate" aria-hidden="true"></i>
											&nbsp;&nbsp;&nbsp;Add to Enquiry Cart
										</a>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				}
				?>
			</div>
		</div>
	</div>
</div>