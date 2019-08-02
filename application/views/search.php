<div class="container">
	<div class="row filter-w">
		<div class="col-xs-12 col-md-3">
			<span
				class="filter-heading fBold upper">Search Result</span>
		</div>
	</div>

	<div class="row">
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
		} else {
			?>
			<div class="col-md-12 col-xs-12">
				<span class="fBold upper text-black">Search Result Not Found. Check Product, Brand Or Model Name</span>
			</div>
			<?php
		}
		?>

	</div>
</div>