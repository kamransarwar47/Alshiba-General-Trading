<!-- jQuery -->
<script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.cookie.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/modernizr.custom.js"></script>
<script src="<?php echo base_url(); ?>assets/js/classie.js"></script>
<script src="<?php echo base_url(); ?>assets/js/uiMorphingButton_fixed.js"></script>
<script src="<?php echo base_url(); ?>assets/js/site.js"></script>
<script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.spinner.js"></script>

<!-- Script to Activate the Carousel -->
<script type="text/javascript">    
	$('.carousel').carousel({
		interval: 3000 //changes the speed
	});	
</script>

<script type="text/javascript">
	$(document).ready(function () {
	
	$('#newArrivalModal').modal('show');
		
		/* Setting text on homepage */
		header_text = header_text.replace(/{@@}/g, '<br/>');
		$('#header_text').html(header_text);
		/* Setting text on homepage */
		/* Setting product slider */
		$('.slide-image').slick({
			slidesToShow  : 1,
			slidesToScroll: 1,
			dots          : false,
			infinite      : false
		});
		$('.slider-related-products').slick({
			slidesToShow  : 4,
			slidesToScroll: 1,
			dots          : true,
			arrows        : false,
			autoplay      : true,
			autoplaySpeed : 5000,
			responsive    : [
				{
					breakpoint: 1024,
					settings  : {
						slidesToShow  : 4,
						slidesToScroll: 1,
						infinite      : true,
						dots          : true
					}
				},
				{
					breakpoint: 600,
					settings  : {
						slidesToShow  : 2,
						slidesToScroll: 2
					}
				},
				{
					breakpoint: 480,
					settings  : {
						slidesToShow  : 2,
						slidesToScroll: 2
					}
				}
			]
		});
		/* Setting product slider */
	});
</script>
<script type="text/javascript">
	/* dropdown */
	function DropDown(el) {
		this.dd = el;
		this.initEvents();
	}
	DropDown.prototype = {
		initEvents: function () {
			var obj = this;
			obj.dd.on('click', function (event) {
				$(this).toggleClass('active');
				event.stopPropagation();
			});
		}
	}
	$(function () {
		var dd = new DropDown($('.customDD'));
		$(document).click(function () {
			// all dropdowns
			$('.wrapper-dropdown-5').removeClass('active');
		});
	});
	$(function () {
		$('#main-cat li > a').click(function () {
			$('#cat-text').html($(this).html());
		});
	});
	/* dropdown */
	/* Adding product to cart */
	$(function () {
		$('.addToCart').click(function (e) {
			var btn = $(this);
			var prod_id = btn.attr('id');
			var user_id = $.cookie('user_unique_id');
			var success_msg = '<div class="col-md-12 alert alert-dismissible alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success: </strong>Item has been added to your cart successfully</div>';
			var error_msg = '<div class="col-md-12 alert alert-dismissible alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error: </strong>Error occurred while adding item to your cart. Please Try again.</div>';
			$.ajax({
				type    : 'POST',
				url     : '<?Php echo site_url(); ?>cart/add/',
				data    : {prod_id: prod_id, user_id: user_id},
				dataType: 'json',
				success : function (data) {
					if (data.msg == 'success') {
						$('.add_cart_msg').css('display', 'block').html(success_msg);
						$('.cart_items').html(data.total_item);
					}
					else {
						$('.add_cart_msg').css('display', 'block').html(error_msg);
					}
				},
				error   : function () {
					$('.add_cart_msg').css('display', 'block').html(error_msg);
				}
			});
		});
	});
	/* Adding product to cart */
	/* removing product to cart */
	$(function () {
		$('.remove-item-cart').click(function (e) {
			var btn = $(this);
			var cart_id = btn.attr('id');
			var user_id = $.cookie('user_unique_id');
			var success_msg = '<div class="col-md-12 alert alert-dismissible alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success: </strong>Item is been removed from your cart successfully</div>';
			var error_msg = '<div class="col-md-12 alert alert-dismissible alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error: </strong>Error occurred while deleting item to your cart. Please Try again.</div>';
			$.ajax({
				type    : 'POST',
				url     : '<?Php echo site_url(); ?>cart/delete/',
				data    : {cart_id: cart_id, user_id: user_id},
				dataType: 'json',
				success : function (data) {
					if (data.msg == 'success') {
						$('.del_cart_msg').css('display', 'block').html(success_msg);
						$('.cart_items').html(data.total_item);
						$('div#cart_product_' + cart_id).remove();
					}
					else {
						$('.del_cart_msg').css('display', 'block').html(error_msg);
					}
				},
				error   : function () {
					$('.del_cart_msg').css('display', 'block').html(error_msg);
				}
			});
		});
	});
	/* removing product to cart */
	/* Quote form display and submission */
	$(function () {
		$('#proceed_quote').click(function () {
			$($(this).attr('href')).css('display', 'block');
			$('html, body').animate({
				scrollTop: $($(this).attr('href')).offset().top - 200
			}, 500);
			return false;
		});
		$('#submit_quote_form').click(function () {
			$('#quote_form').submit();
		});
		$("#quote_form").validate({
			rules   : {
				full_name    : "required",
				email_address: {
					required: true,
					email   : true
				},
				phone_number : {
					required: true,
					number  : true
				},
				address      : "required",
			},
			messages: {
				full_name    : "Please enter your full name",
				email_address: "Please enter your email address",
				phone_number : "Please enter your phone number",
				address      : "Please enter your address"
			}
		});
	});
	/* Quote form display and submission */
	/* category lisiting on sidebar */
	$(function () {
		$('.category_listing > li > a').click(function () {
			$('.category_listing > li > a').removeClass('active-filter link-disabled');
			$(this).addClass('active-filter link-disabled');
			var str = $(this).attr('id').split(',');
			var brand_id = str[0];
			var category_id = str[1];
			get_brand_products(brand_id, category_id);
			$('.brand_name:checkbox').removeAttr('checked');
		});
		$('.brand_name').click(function () {
			var str = $('.category_listing > li > a.active-filter').attr('id').split(',');
			var brand_id = str[0];
			var category_id = str[1];
			var brands = [];
			brands.push(brand_id);
			$('.brand_name:checked').each(function () {
				brands.push($(this).attr('id'));
			});
			get_brand_products(brands.join(","), category_id);
		});
	});
	function get_brand_products(brand_id, category_id) {
		$.ajax({
			type   : 'POST',
			url    : '<?Php echo site_url(); ?>brands/brand_product_listing/',
			data   : {brand_id: brand_id, category_id: category_id},
			success: function (data) {
				if (data != '') {
					$('#brand_product_listing').html(data);
				} else {
					$('#brand_product_listing').html('');
				}
			}
		});
	}
	/* category lisiting on sidebar */
	/* category search */
	$(function () {
		$('#main-cat > li > a').click(function () {
			$('#main-cat > li > a').removeClass('active');
			$(this).addClass('active');
			$('#search-input-filter').val('');
			search_category_brand_product();
		});
		$('#search-filter').click(function () {
			search_category_brand_product();
		});
	});
	function search_category_brand_product() {
		var str = $('#main-cat > li > a.active').attr('id').split(',');
		var category_id = str[0];
		var brand_id = str[1];
		var product_title = $('#search-input-filter').val();
		$.ajax({
			type   : 'POST',
			url    : '<?Php echo site_url(); ?>categories/categories_product_listing/',
			data   : {category_id: category_id, brand_id: brand_id, product_title: product_title},
			success: function (data) {
				if (data != '') {
					$('#category_product_listing').html(data);
				} else {
					$('#category_product_listing').html('');
				}
			}
		});
	}
	/* category search */
	/* contact form */
	$(function () {
		$("#contact_form").validate({
			rules   : {
				full_name    : "required",
				email_address: {
					required: true,
					email   : true
				},
				phone_number : {
					required: true,
					number  : true
				},
				message      : "required",
			},
			messages: {
				full_name    : "Please enter your full name",
				email_address: "Please enter your email address",
				phone_number : "Please enter your phone number",
				message      : "Please enter your message"
			}
		});
		$('#enquiry_message').click(function () {
			var form = $("#quick_enquiry_message");
			var success_msg = '<div style="z-index: 100;" class="alert alert-dismissible alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success: </strong>Message sent successfully</div>';
			var error_msg = '<div style="z-index: 100;" class="alert alert-dismissible alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error: </strong>Message not sent. Try again.</div>';
			if (form.valid()) {
				var name = $('#quick_enquiry_message #full_name').val();
				var email = $('#quick_enquiry_message #email_address').val();
				var phone = $('#quick_enquiry_message #phone_number').val();
				var message = $('#quick_enquiry_message #message').val();
				$.ajax({
					type    : 'POST',
					url     : '<?Php echo site_url(); ?>home/send_contact_form_email/',
					data    : {
						full_name    : name,
						email_address: email,
						phone_number : phone,
						message      : message,
						quick_enquiry: 1
					},
					dataType: 'json',
					success : function (data) {
						if (data.msg == 'success') {
							$('#enquiry_form_message').html(success_msg);
							$('#quick_enquiry_message')[0].reset();
						} else {
							$('#enquiry_form_message').html(error_msg);
						}
					}
				});
			}
		});
		$("#quick_enquiry_message").validate({
			rules         : {
				full_name    : "required",
				email_address: {
					required: true,
					email   : true
				},
				phone_number : {
					required: true,
					number  : true
				},
				message      : "required",
			},
			messages      : {
				full_name    : "Please enter your full name",
				email_address: "Please enter your email address",
				phone_number : "Please enter your phone number",
				message      : "Please enter your message"
			},
			errorPlacement: function (error, element) {
				element.attr("placeholder", error.text()).addClass('error');
			}
		});
		/* contact form */
	});
</script>
<script>
	/* cart quantity spinner */
	$(function () {
		$('.cart-quantity-spinner').spinner('changed', function (e, newVal, oldVal) {
			var cart_id = e.target.getAttribute('id');
			var quantity = newVal;
			$.ajax({
				type    : 'POST',
				url     : '<?Php echo site_url(); ?>cart/add_quantity/',
				data    : {
					cart_id : cart_id,
					quantity: quantity,
				},
				dataType: 'json',
				success : function (data) {
					if (data.msg == 'success') {
						console.log('Cart Quantity Updated');
					} else {
						console.log('Error Updating Cart Quantity');
					}
				}
			});
		});
	});
	/* cart quantity spinner */
</script>
<?php
if (isset($_POST['search_input_header'])) {
	?>
	<script>
		$(document).ready(function () {
			$(".search-w").fadeIn("fast", function () {
				$("#search-input").val('<?php echo $_POST['search_input_header']; ?>');
			});
		});
	</script>
	<?php
}
?>