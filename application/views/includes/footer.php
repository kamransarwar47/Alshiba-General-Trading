<?php


 $footer_data = get_footer_data();
?>
<footer>
	<div class="container padTB40">
		<div class="row text-white">
			<div class="col-lg-3 text-center text-left">
				<p class="fBold">QUICK LINKS</p>
				<ul class="noBullet">
					<li><a href="<?php echo site_url() ?>">Home</a></li>
					<li><a href="javascript:void (0)">Brands</a></li>
					<li><a href="javascript:void (0)">Products</a></li>
					<li><a href="<?php echo site_url('about-us') ?>">About</a></li>
					<li><a href="<?php echo site_url('contact') ?>">Contact</a></li>
				</ul>
				<br/>
			</div>
			<div class="col-lg-3 text-center text-left">
				<p class="fBold">BRANDS</p>
				<ul class="noBullet">
					<?php
					if ($footer_data['brands']->num_rows() > 0) {
						foreach ($footer_data['brands']->result() as $row) {
							?>
							<li>
								<a href="<?php echo site_url('brands/products/' . $row->brand_url_name) ?>"><?php echo $row->brand_name ?></a>
							</li>
							<?php
						}
					}
					?>
				</ul>
				<br/>
			</div>
			<div class="col-lg-3 text-center text-left">
				<p class="fBold">PRODUCTS</p>
				<ul class="noBullet">
					<?php
					if ($footer_data['products']->num_rows() > 0) {
						foreach ($footer_data['products']->result() as $row) {
							?>
							<li>
								<a href="<?php echo site_url('categories/products/' . $row->category_url_name) ?>"><?php echo $row->category_name ?></a>
							</li>
							<?php
						}
					}
					?>
				</ul>
				</ul>
				<br/>
			</div>
			<div class="col-lg-3 text-center text-left">
				<p class="fBold">CONTACT DETAILS</p>
				<ul class="noBullet">
					<?php
					if ($footer_data['contact']->num_rows() > 0) {
						foreach ($footer_data['contact']->result() as $row) {
							?>
							<li>
								<a href=""><?php echo nl2br($row->footer_text) ?></a>
							</li>
							<?php
						}
					}
					?>
					<li><?php
						?></li>
				</ul>
			</div>
			<div class="col-lg-12 text-center">
				<br/><br/>
				<p>&copy; 2016 Al Shiba General Trading</p>
			</div>
		</div>
	</div>
</footer>
<div class="mockup-content hidden-xs">
	<div class="morph-button morph-button-modal morph-button-modal-2 morph-button-fixed">
		<button type="button" id="morph-button"><img src="<?php echo base_url(); ?>assets/img/message.png"></button>
		<div class="morph-content">
			<div>
				<div id="enquiry_form_message"></div>
				<div class="content-style-form content-style-form-1">
					<span class="icon icon-close"><img src="<?php echo base_url(); ?>assets/img/close.png"></span>
					<h3 class="h6 fBold upper">Quick Enquiry</h3>
					<?php
					$data = array(
						'id' => 'quick_enquiry_message'
					);
					echo form_open('', $data);
					?>
					<p>
						<?php
						$data = array(
							'type'        => 'text',
							'placeholder' => 'Full Name',
							'name'        => 'full_name',
							'id'          => 'full_name'
						);
						echo form_input($data);
						?>
					</p>
					<p>
						<?php
						$data = array(
							'type'        => 'text',
							'placeholder' => 'Email Address',
							'name'        => 'email_address',
							'id'          => 'email_address'
						);
						echo form_input($data);
						?>
					</p>
					<p>
						<?php
						$data = array(
							'type'        => 'text',
							'placeholder' => 'Phone Number',
							'name'        => 'phone_number',
							'id'          => 'phone_number'
						);
						echo form_input($data);
						?>
					</p>
					<p>
						<?php
						$data = array(
							'placeholder' => 'Message',
							'name'        => 'message',
							'id'          => 'message',
							'rows'        => 7,
							'cols'        => 50
						);
						echo form_textarea($data);
						?>
					</p>
					<p>
						<?php
						$data = array(
							'id'      => 'enquiry_message',
							'content' => 'Send'
						);
						echo form_button($data);
						?>
					</p>
					<?php
					echo form_close();
					?>
				</div>
			</div>
		</div>
	</div><!-- morph-button -->
</div><!-- /mockup-content -->
<?php
$string = str_replace("\n", "{@@}", $row->header_text);
$string = str_replace("\r", "{@@}", $string);
?>

<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,700,900" rel="stylesheet">

<script>
	var header_text = '<?php echo $string; ?>';
</script>

<script src="https://use.fontawesome.com/e658f32a3e.js"></script>