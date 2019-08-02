<div class="container-fluid page-desc-products-w">
	<div class="row noPadLR">
		<div class="container">
			<div class="col-md-12">
				<div class="text-white">
					<h1 class="fBold noMarT upper"><?php echo strtoupper($category_details[0]['category_name']); ?></h1>
					<p><?php echo $category_details[0]['category_description']; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row filter-w">
		<div class="col-xs-12 col-md-3">
			<span
				class="filter-heading fBold upper"><?php echo strtoupper($category_details[0]['category_name']); ?></span>
		</div>
		<div class="col-xs-12 col-md-5 noPadLR">
			<div id="dd" class="wrapper-dropdown-5 customDD" tabindex="1"><span
					class="fBold">BRANDS: </span><span id="cat-text">All Brands</span>
				<ul class="dropdown" id="main-cat">
					<li><a href="javascript:;" class="active" id="<?php echo $category_id . ',0'; ?>">All Brands</a>
					</li>
					<?php
					if ($all_brands->num_rows() > 0) {
						foreach ($all_brands->result_array() as $row) {
							?>
							<li><a href="javascript:;"
								   id="<?php echo $category_id . ',' . $row['id']; ?>"><?php echo ucwords($row['brand_name']); ?></a>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		</div>

		<div class="col-xs-12 col-md-4 noPadLR search-filter-w">
			<input type="text" id="search-input-filter" placeholder="Search Product By Name Or Model#">
			<span id="search-filter"><i class="fa fa-search animate" aria-hidden="true"></i></span>
		</div>
	</div>

	<div class="row" id="category_product_listing">
		<?php
		if ($all_products->num_rows() > 0) {
			foreach ($all_products->result_array() as $row) {
				?>
				<div class="col-md-3 col-xs-6">
					<a href="<?php echo site_url() . 'products/details/' . $row['product_url_name']; ?>" class="boxed">
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