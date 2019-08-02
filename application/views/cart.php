<div class="container-fluid page-cart-title-w">
	<div class="row noPadLR">
		<div class="container">
			<div class="col-md-12">
				<div class="text-white">
					<h1 class="h1 fBold noMarT upper">Enquiry cart</h1>
					<p class="noMarB">Your enquiry cart contains <span
							class="cart-items fBold"><?php echo $cart_items; ?></span> items.</p>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="del_cart_msg" style="display: none;"></div>
			<?php
			echo $this->session->flashdata('error_message');
			?>
			<div class="card-cart">
				<h3 class="noMarT noMarB h4 fBold padLR40">PRODUCT</h3>

				<?php
				if ($cart_products->num_rows() > 0) {
					foreach ($cart_products->result_array() as $row) {
						?>
						<div class="row padTB40 withTBorder noMarLR" id="cart_product_<?php echo $row['id']; ?>">
							<div class="col-md-3 col-xs-12">
								<img
									src="<?php echo base_url() . 'uploads/products/admin/admin_' . $row['product_image']; ?>"
									class="img-reponsive center-block"
									alt="<?php echo $row['product_title']; ?>">
							</div>
							<div class="col-md-4 col-xs-5">
								<p class="text-gray noMarB">Model # <?php echo strtoupper($row['product_model']); ?></p>
								<p><a href="<?php echo site_url() . 'products/details/' . $row['product_url_name']; ?>"
									  class="linkToProduct"><?php echo ucwords($row['product_title']); ?></a></p>
							</div>
							<div class="col-md-2 col-xs-5">
								<label class="linkToProduct">Product Quantity</label>
								<div class="input-group spinner cart-quantity-spinner" data-trigger="spinner">
									<input type="text" class="form-control text-center" id="<?php echo $row['id']; ?>"
										   value="<?php echo $row['product_quantity']; ?>"
										   data-rule="quantity">
									<div class="input-group-addon">
										<a href="javascript:;" class="spin-up" data-spin="up"><i
												class="fa fa-caret-up"></i></a>
										<a href="javascript:;" class="spin-down" data-spin="down"><i
												class="fa fa-caret-down"></i></a>
									</div>
								</div>
							</div>
							<div class="col-md-2 col-xs-2 text-right">
								<a href="javascript:;" id="<?php echo $row['id']; ?>" class="remove-item-cart"
								   data-toggle="tooltip" title="Remove from Cart">
									<i class="fa fa-minus-circle animate" aria-hidden="true"></i>
								</a>
							</div>
						</div>
						<?php
					}
				}
				?>
				<div class="row">
					<div class="col-md-6 text-center noPadR">
						<a href="<?php echo site_url(); ?>" class="upper fBold continueShopping">
							<i class="fa fa-shopping-basket animate" aria-hidden="true"></i>
							&nbsp;&nbsp;&nbsp;CONTINUE SHOPPING
						</a>
					</div>
					<div class="col-md-6 text-center noPadL">
						<a href="#enquiry_form" id="proceed_quote" class="upper fBold getQuote">
							PROCEED TO QUOTE&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right animate"
																 aria-hidden="true"></i>
						</a>
					</div>
				</div>
			</div>

			<div class="col-md-12">
				<?php
				if (validation_errors() != '') {
					$css = 'display: block;';
				} else {
					$css = 'display: none;';
				}
				?>
				<div class="card-cart" id="enquiry_form" style="<?php echo $css; ?>">
					<h3 class="noMarT noMarB h4 fBold padLR40">ENQUIRY FORM</h3>
					<div class="row padTB40 withTBorder noMarLR">
						<div class="col-md-12 col-xs-12">
							<?php
							$data = array(
								'class' => 'form-horizontal',
								'id'    => 'quote_form'
							);
							echo form_open('', $data);
							?>
							<div class="form-group">
								<label for="full_name" class="col-sm-2 control-label">Name</label>
								<div class="col-sm-10">
									<?php
									$data = array(
										'type'        => 'text',
										'class'       => 'form-control',
										'id'          => 'full_name',
										'name'        => 'full_name',
										'placeholder' => 'Enter your full name'
									);
									echo form_input($data, set_value('full_name'));
									?>
									<?php echo form_error('full_name', '<label class="error">', '</label>'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="email_address" class="col-sm-2 control-label">Email</label>
								<div class="col-sm-10">
									<?php
									$data = array(
										'type'        => 'email',
										'class'       => 'form-control',
										'id'          => 'email_address',
										'name'        => 'email_address',
										'placeholder' => 'Enter your email address'
									);
									echo form_input($data, set_value('email_address'));
									?>
									<?php echo form_error('email_address', '<label class="error">', '</label>'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="phone_number" class="col-sm-2 control-label">Phone</label>
								<div class="col-sm-10">
									<?php
									$data = array(
										'type'        => 'text',
										'class'       => 'form-control',
										'id'          => 'phone_number',
										'name'        => 'phone_number',
										'placeholder' => 'Enter your phone number'
									);
									echo form_input($data, set_value('phone_number'));
									?>
									<?php echo form_error('phone_number', '<label class="error">', '</label>'); ?>
								</div>
							</div>
							<div class="form-group">
								<label for="address" class="col-sm-2 control-label">Address</label>
								<div class="col-sm-10">
									<?php
									$data = array(
										'class'       => 'form-control',
										'id'          => 'address',
										'name'        => 'address',
										'placeholder' => 'Enter your address',
										'rows'        => 5
									);
									echo form_textarea($data, set_value('address'));
									?>
									<?php echo form_error('address', '<label class="error">', '</label>'); ?>
								</div>
							</div>
							<?php
							echo form_close();
							?>
						</div>
					</div>
					<div class="row" style="border-top: 1px solid #dadada;">
						<div class="col-md-6 col-md-offset-6 text-center noPadL">
							<a href="javascript:;" id="submit_quote_form" class="upper fBold getQuote">
								GET A QUOTE&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right animate"
																aria-hidden="true"></i>
							</a>
						</div>
					</div>
				</div>
			</div>

		</div>

	</div>
</div>