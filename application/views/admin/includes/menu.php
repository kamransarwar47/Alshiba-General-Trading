<?php
$brand_class           = '';
$category_class        = '';
$product_class         = '';
$slider_class          = '';
$order_class           = '';
$latest_products_class = '';
if (isset($active)) {
	switch ($active) {
		case('brands'):
			$brand_class = 'active';
			break;
		case('categories'):
			$category_class = 'active';
			break;
		case('products'):
			$product_class = 'active';
			break;
		case('slider'):
			$slider_class = 'active';
			break;
		case('orders'):
			$order_class = 'active';
			break;
		case('latest_products'):
			$latest_products_class = 'active';
			break;
	}
}
?>
<div class="navbar-custom">
	<div class="container">
		<div id="navigation">
			<ul class="navigation-menu">
				<li class="has-submenu <?php echo $brand_class; ?>">
					<a href="<?php echo site_url('admin/brands') ?>"><i class="md md-account-balance"></i>Brands</a>
				</li>
				<li class="has-submenu <?php echo $category_class; ?>">
					<a href="<?php echo site_url('admin/categories') ?>"><i class="md md-dashboard"></i>Categories</a>
				</li>
				<li class="has-submenu <?php echo $product_class; ?>">
					<a href="<?php echo site_url('admin/product') ?>"><i class="md md-playlist-add"></i>Products</a>
				</li>
				<li class="has-submenu <?php echo $latest_products_class; ?>">
					<a href="<?php echo site_url('admin/product/latest_products') ?>"><i class="md md-format-list-numbered"></i>Latest
						Products / Swapping</a>
				</li>
				<li class="has-submenu <?php echo $order_class; ?>">
					<a href="<?php echo site_url('admin/orders') ?>"><i class="md md-shopping-cart"></i>Orders</a>
				</li>
				<li class="has-submenu <?php echo $slider_class; ?>">
					<a href="<?php echo site_url('admin/slider') ?>"><i class="md md-slideshow"></i>Homepage Slider</a>
				</li>
			</ul>
		</div>
	</div>
</div>