<div class="container-fluid">
	<div class="row">
		<iframe
			src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d115551.10141722609!2d55.330377!3d25.170426000000003!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x38bf22b811138b77!2sAL+SHIBA+GENERAL+TRADING!5e0!3m2!1sen!2sus!4v1477404391725"
			height="500" frameborder="0" style="border:0; width: 100%;" allowfullscreen></iframe>
	</div>
</div>

<div class="container">
	<div class="row padTB40">
		<div class="container-fluid" id="who-we-are">
			<div class="container">
				<div class="row marB40">
					<div class="col-sm-12">
						<h2 class="fweight700 heading2 black noLS text-center">CONTACT INFORMATION</h2>
						<br/>
						<br/>
						<br/>
						<ul class="row address" style="list-style:none;">
							<li class="col-xs-12 col-sm-4 text-center" style="list-style-type: none;">
								<div class="address">
									<span><b class="fa fa-arrow-up" style="font-size: 60px; color:#DD0003;"></b></span>
									<h3>Address</h3>
									RAS AL KHOR AREA , INDUSTRIAL AREA NO 1,<br>
									AL MANAMA ST, BESDIE EMARAT PETROL FILLING STATION,
									P.O.Box No 24242 , Dubai - UAE
								</div>
							</li>
							<li class="col-xs-12 col-sm-4 text-center ">
								<div class="phone">
									<span><b class="fa fa-phone" style="font-size: 60px; color:#DD0003;"></b></span>
									<h3>Phones</h3>
									<div>
										<span><i class="fa fa-phone"
												 style="color:#DD0003;"></i> +971 4 333 3666</span><br>
										<span><i class="fa fa-fax" style="color:#DD0003;"></i> +971 4 333 3133</span>
									</div>
								</div>

							</li>
							<li class="col-xs-12 col-sm-4 last text-center">
								<div class="email">
									<span><b class="fa fa-envelope" style="font-size: 60px; color:#DD0003;"></b></span>
									<h3>Email</h3>
									<a href="mailto:alshiba@eim.ae">alshiba@eim.ae</a><br>
									<a href="mailto:alshibag@eim.ae">alshibag@eim.ae</a>
								</div>
							</li>
						</ul>
					</div>

				</div>
				<div class="container-fluid">

					<div class=" col-md-12" style=" background-color: #ddd;">
						<h2 style="text-align: center;">CONTACT US</h2><br/>
						<?php echo $this->session->flashdata('contact_form_message'); ?>
						<div class="row">
							<?php
							$data = array(
								'id' => 'contact_form'
							);
							echo form_open('', $data);
							?>
							<div class="col-sm-4">
								<div class="control-group form-group">
									<div class="controls">
										<label>Full Name</label>
										<?php
										$data = array(
											'type'  => 'text',
											'class' => 'form-control',
											'id'    => 'full_name',
											'name'  => 'full_name',
										);
										echo form_input($data, set_value('full_name'));
										?>
										<?php echo form_error('full_name', '<label class="error">', '</label>'); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="control-group form-group">
									<div class="controls">
										<label>Email Address</label>
										<?php
										$data = array(
											'type'  => 'email',
											'class' => 'form-control',
											'id'    => 'email_address',
											'name'  => 'email_address',
										);
										echo form_input($data, set_value('email_address'));
										?>
										<?php echo form_error('email_address', '<label class="error">', '</label>'); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-4">
								<div class="control-group form-group">
									<div class="controls">
										<label>Phone Number</label>
										<?php
										$data = array(
											'type'  => 'text',
											'class' => 'form-control',
											'id'    => 'phone_number',
											'name'  => 'phone_number',
										);
										echo form_input($data, set_value('phone_number'));
										?>
										<?php echo form_error('phone_number', '<label class="error">', '</label>'); ?>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<div class="control-group form-group">
									<div class="controls">
										<label>Message</label>
										<?php
										$data = array(
											'class' => 'form-control',
											'id'    => 'message',
											'name'  => 'message',
											'rows'  => 10,
											'cols'  => 100,
											'style' => 'resize:none'
										);
										echo form_textarea($data, set_value('message'));
										?>
										<?php echo form_error('message', '<label class="error">', '</label>'); ?>
									</div>
								</div>
							</div>

							<!-- For success/fail messages -->
							<div class="col-sm-5"></div>
							<div class="col-sm-7" style="text-align: left;">
								<?php
								$data = array(
									'class' => 'btn btn-primary learn-more animate upper text-white fBold',
									'style' => 'background:#DD0003; border:0px;',
									'name'  => 'submit',
									'value' => 'Send Message'
								);
								echo form_submit($data);
								?>
								<br><br>
							</div>
							<?php
							echo form_close();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>