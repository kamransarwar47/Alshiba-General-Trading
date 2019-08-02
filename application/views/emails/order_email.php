<p>
	<br><br>
<table>
	<tr>
		<td>
			<p>
				<span style="color: #000000; font-weight: bold;">{salutation}</span>,<br/>
			</p>
			<p>New Order has been placed. Details are as follows:</p>
			<p>
			<table class="table-enquiry-details">
				<tr>
					<th>NAME</th>
					<th>EMAIL ADDRESS</th>
					<th>PHONE NUMBER</th>
					<th>ADDRESS</th>
				</tr>
				<tr>
					<td>{name}</td>
					<td>{email}</td>
					<td>{phone}</td>
					<td>{address}</td>
				</tr>
			</table>
			</p>
		</td>
	</tr>
	<tr>
		<td>
			<p><br>Order Detials are as follows:<br><br></p>
			<p>
			<table class="table-enquiry-details">
				<tr>
					<th>PRODUCT TITLE</th>
					<th>PRODUCT MODEL</th>
					<th>PRODUCT QUANTITY</th>
					<th>BRAND</th>
					<th>CATEGORY</th>
				</tr>
				<?php
				if (count($cart_products) > 0) {
					foreach ($cart_products as $row) {
						?>
						<tr>
							<td><?php echo ucwords($row['product_title']); ?></td>
							<td><?php echo strtoupper($row['product_model']); ?></td>
							<td><?php echo strtoupper($row['product_quantity']); ?></td>
							<td><?php echo ucwords($row['brand_title']); ?></td>
							<td><?php echo ucwords($row['category_title']); ?></td>
						</tr>
						<?php
					}
				}
				?>
			</table>
			</p>
		</td>
	</tr>
</table>
</p>