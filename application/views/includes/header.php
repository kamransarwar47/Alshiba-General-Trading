<?php
$cart_items = 0;
if (!isset($_COOKIE['user_unique_id'])) {
	set_cookie('user_unique_id', md5(time() . $_SERVER['REMOTE_PORT'] . uniqid()), time() + 60 * 60 * 24 * 7, '', '/');
} else {
	set_cookie('user_unique_id', $_COOKIE['user_unique_id'], time() + 60 * 60 * 24 * 7, '', '/');
	$cart_items = get_total_cart_items($_COOKIE['user_unique_id']);
}
$home_tab     = '';
$brand_tab    = '';
$products_tab = '';
$contact_tab  = '';
$about_tab    = '';
if (isset($active_tab)) {
	switch ($active_tab) {
		case 'home':
			$home_tab = 'active';
			break;
		case 'brands':
			$brand_tab = 'active';
			break;
		case 'products':
			$products_tab = 'active';
			break;
		case 'contact':
			$contact_tab = 'active';
			break;
		case 'about':
			$about_tab = 'active';
			break;
	}
}
?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse"
					data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<div class="logo-w">
				<a class="logo" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.jpg"
																	  class="img-responsive center-block"></a>
			</div>

			<div class="contact-details-w hidden-xs hidden-sm">
				<ul>
					<li><a href="http://www.facebook.com">
							<i class="fa fa-facebook animate" aria-hidden="true"></i>
						</a></li>
					<li><a href="http://www.twitter.com">
							<i class="fa fa-twitter animate" aria-hidden="true"></i>
						</a></li>
					<li><a href="http://www.linkedin.com">
							<i class="fa fa-linkedin animate" aria-hidden="true"></i>
						</a></li>
					<li><a href="http://www.instagram.com">
							<i class="fa fa-instagram animate" aria-hidden="true"></i>
						</a></li>
					<li><a href="tel:+97143333666">
							<i class="fa fa-phone animate" aria-hidden="true"></i>
						</a>
					</li>
					<li><a href="mailto:alshiba@eim.ae">
							<i class="fa fa-envelope-o animate" aria-hidden="true"></i>
						</a>
					</li>
				</ul>
			</div>

			<div class="search-w">
				<?php
				echo form_open(base_url('search/product'), array('id' => 'header_search_form'));
				echo form_input(array('id'          => 'search-input', 'name' => 'search_input_header',
									  'placeholder' => 'What are you looking for?'));
				echo form_close();
				?>
			</div>

			<div class="search-cart-w">
				<span id="search-btn"><i class="fa fa-search animate" aria-hidden="true"></i></span>
				<a href="<?php echo base_url() . 'cart/view' ?>" id="cart-btn"><i class="fa fa-shopping-cart animate"
																				  aria-hidden="true"></i>
					<span class="cart-count fBold cart_items"><?php echo $cart_items; ?></span>
				</a>
			</div>
		</div>

		<div class="row bg-black">
			<div class="col-md-12 text-center noPadLR">
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse noPadLR" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav center-block" id="main-menu">
						<li class="<?php echo $home_tab; ?>"><a href="<?php echo base_url(); ?>">Home</a></li>
						<li class="dropdown <?php echo $brand_tab; ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Brands <b class="caret"></b></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<div class="container-fluid">
										<div class="row" id="dropBrands">
											<?php
											$brands = get_brands();
											if ($brands->num_rows() > 0) {
												foreach ($brands->result_array() as $row) {
													?>
													<a href="<?php echo site_url() . 'brands/products/' . $row['brand_url_name']; ?>"
													   class="col-md-15 col-xs-6"><img
															src="<?php echo base_url() . 'uploads/brands/' . $row['brand_image']; ?>"
															class="img-responsive animate"></a>
													<?php
												}
											}
											?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li class="dropdown <?php echo $products_tab; ?>">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b
									class="caret"></b></a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<div class="container-fluid">
										<div class="row" id="dropProducts">
											<?php
											$categories = get_categories();
											if ($categories->num_rows() > 0) {
												foreach ($categories->result_array() as $row) {
													?>
													<a href="<?php echo site_url() . 'categories/products/' . $row['category_url_name']; ?>"
													   class="col-md-15 center-block"><img
															src="<?php echo base_url() . 'uploads/categories/' . $row['category_image']; ?>"
															class="img-responsive animate center-block"></a>
													<?php
												}
											}
											?>
										</div>
									</div>
								</li>
							</ul>
						</li>
						<li class="<?php echo $about_tab; ?>"><a href="<?php echo base_url() . 'about-us'; ?>">About</a>
						</li>

						<li class="<?php echo $contact_tab; ?>"><a
								href="<?php echo base_url() . 'contact'; ?>">Contact</a>
						</li>

					</ul>
				</div>
				<!-- /.navbar-collapse -->
			</div>
		</div>
	</div>
</nav>