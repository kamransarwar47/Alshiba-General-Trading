<!-- Header Carousel -->
<header id="myCarousel" class="carousel slide">
	<!-- Indicators -->
	<ol class="carousel-indicators hidden-xs hidden-sm">
		<?php
		if (count($banner_images) > 0) {
			for ($i = 0; $i < count($banner_images); $i++) {
				?>
				<li data-target="#myCarousel"
					data-slide-to="<?php echo $i; ?>" <?php echo ($i == 0) ? 'class="active"' : ''; ?>></li>
				<?php
			}
		}
		?>
	</ol>
	<!-- Wrapper for slides -->
	<div class="carousel-inner">
		<?php
		if (count($banner_images) > 0) {
			foreach ($banner_images as $key => $row) {
				?>
				<div class="item <?php echo ($key == 0) ? 'active' : ''; ?>">
					<div class="fill"
						 style="background-image:url('<?php echo site_url(); ?>uploads/slider/<?php echo $row['slider_image']; ?>');"></div>
					<div class="carousel-caption">
						<h2></h2>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
	<!-- Controls -->
	<a class="left carousel-control hidden" href="#myCarousel" data-slide="prev">
		<span class="icon-prev"></span>
	</a>
	<a class="right carousel-control hidden" href="#myCarousel" data-slide="next">
		<span class="icon-next"></span>
	</a>
</header>
<!-- Page Content -->
<div class="container">
	<div class="row padTB40">
		<div class="col-md-12 text-center text-left">
			<br/>
			<p class="text-gray h6" id="header_text"></p>
			<h3 class="text-black fBlack upper">NEW ARRIVALS</h3>
			<br/>
		</div>
		<?php
		if ($latest_products->num_rows() > 0) {
			foreach ($latest_products->result_array() as $row) {
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
<!-- /.container -->


<!-- Modal -->
<style>
	#newArrivalModal .modal-body {
		padding: 0;
	}

	#newArrivalModal .withPad20 {
		padding: 20px;
	}

	.modal-btn {
		border-top: 1px solid #DD0003;
		border-left: 1px solid #DD0003;
		background: #DD0003;
		color: #FFF;
		display: inline-block;
		padding: 10px 25px;
		border-radius: 3px;
	}

	.modal-btn:hover,
	.modal-btn:focus {
		background: #a90002;
	}

	.vertical-alignment-helper {
		display: table;
		height: 100%;
		width: 100%;
	}

	.vertical-align-center {
		/* To center vertically */
		display: table-cell;
		vertical-align: middle;
	}

	.modal-content {
		/* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
		width: inherit;
		height: inherit;
		/* To center horizontally */
		margin: 0 auto;
	}
</style>
<?php
if ($new_arrival->num_rows() > 0) {
	foreach ($new_arrival->result_array() as $row) {
		?>
		<div class="modal fade" id="newArrivalModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="vertical-alignment-helper">
				<div class="modal-dialog vertical-align-center" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
									aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><strong>NEW ARRIVAL</strong></h4>
						</div>
						<div class="modal-body">
							<div class="row">
								<div class="col-sm-12">
									<img src="<?php echo base_url() . 'uploads/products/new-arrival/' . $row['product_image']; ?>"
										 class="img-responsive"/>
								</div>
							</div>
							<div class="row withPad20">
								<div class="col-sm-12">
									<h4 class="text-red fBold"><?php echo ucwords($row['product_title']); ?></h4>
									<p><?php echo $row['product_description']; ?></p>
									<p>
										<a href="<?php echo site_url() . 'products/details/' . $row['product_url_name']; ?>"
										   class="upper modal-btn pull-right">Read more</a></p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
?>