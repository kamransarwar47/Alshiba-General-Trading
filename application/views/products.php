<div class="container">

	<div class="row padTB40 marT20">
		<div class="col-md-12">
			<div class="add_cart_msg" style="display: none;"></div>
			<div class="card">
				<div class="col-xs-12 col-md-6">
					<div class="slide-image">
						<?php
						if ($product_images->num_rows() > 0) {
							foreach ($product_images->result_array() as $row) {
								?>
								<div><img src="<?php echo base_url() . 'uploads/products/' . $row['product_image']; ?>"
										  class="center-block img-responsive"></div>
								<?php
							}
						}
						?>
					</div>
				</div>

				<div class="col-xs-12 col-md-6 single-item-details-w">
					<div class="row text-w">
						<div class="col-xs-12 col-md-12 noPadLR">
							<div class="breadcrumbs upper fThin">
								<a href="<?php echo base_url(); ?>">Home</a> <span class="text-gray">&#8594;</span>
								<a href="javascript:;">Products</a> <span class="text-gray">&#8594;</span>
								<a href="<?php echo site_url() . 'categories/products/' . $product_details[0]['category_url_name']; ?>"><?php echo strtoupper($product_details[0]['category_name']); ?></a>
							</div>

							<h2 class="h2 text-black fBold noMarT">
								<?php echo $product_details[0]['product_title']; ?>
							</h2>
							<br/>
							<p><?php echo $product_details[0]['product_description']; ?></p>
						</div>
					</div>

					<div class="row item-footer item-footer-single">
						<div class="col-md-6 text-center">
							<span
								class="text-gray fThin upper">MODEL # <?php echo $product_details[0]['product_model']; ?></span>
						</div>

						<div class="col-xs-12 col-md-6 noPadLR text-center">
							<a href="javascript:;" id="<?php echo $product_details[0]['id']; ?>"
							   class="upper fBold single-addToCart addToCart">
								<i class="fa fa-cart-plus animate" aria-hidden="true"></i>
								&nbsp;&nbsp;&nbsp;Add to Enquiry Cart
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-12">
			<div class="card card-table">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#features" aria-controls="features" role="tab"
															  data-toggle="tab" class="fBold">FEATURES</a></li>
					<li role="presentation"><a href="#specifications" aria-controls="specifications" role="tab"
											   data-toggle="tab" class="fBold">SPECIFICATIONS</a></li>
					<li role="presentation"><a href="#downloads" aria-controls="downloads" role="tab" data-toggle="tab"
											   class="fBold">DOWNLOADS</a></li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content padTB40">
					<div role="tabpanel" class="tab-pane fade in active tab-text" id="features">
						<div class="row">
							<div class="col-md-12">
								<?php echo $product_details[0]['product_features']; ?>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade tab-text" id="specifications">
						<div class="row">
							<div class="col-md-12">
								<?php echo $product_details[0]['product_specifications']; ?>
							</div>
						</div>
					</div>
					<div role="tabpanel" class="tab-pane fade tab-text" id="downloads">

						<?php
						if ($product_downloads->num_rows() > 0) {
							foreach ($product_downloads->result_array() as $row) {
								?>
								<i class="fa fa-file-o animate" aria-hidden="true"></i>
								<a href="<?php echo site_url() . 'uploads/products/files/' . $row['product_file']; ?>"
								   class="withUnderline"
								   target="_blank">
									<?php echo $row['file_title']; ?>
								</a>
								<br/>
								<?php
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row padB40">
		<div class="col-md-12">
			<h2 class="text-black fBlack upper">RELATED PRODUCTS</h2><br/>
		</div>

		<div class="col-md-12">
			<div class="row">
				<div class="slider-related-products">
					<?php
					if ($related_products->num_rows() > 0) {
						foreach ($related_products->result_array() as $row) {
							?>
							<div class="col-md-3 col-xs-6">
								<a href="<?php echo site_url() . 'products/details/' . $row['product_url_name']; ?>"
								   class="boxed">
									<img src="<?php echo base_url() . 'uploads/products/' . $row['product_image']; ?>"
										 class="img-responsive center-block">
									<h3 class="h4 text-red fBold"><?php echo ucwords($row['product_title']); ?></h3>
									<p class="text-gray fThin upper"><?php echo strtoupper($row['category_name']); ?></p>
								</a>
							</div>
							<?php
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>