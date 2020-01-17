<?php
if (isset($vendors)) { ?>
	<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Name:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$vendors[0]->vendor_name ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			E-Mail:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$vendors[0]->vendor_email ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Contact No:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$vendors[0]->vendor_contact ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Wallet Balance:
		</label>
	</div>
	<div class="col-7">
		<label>
			₹<?= @$vendors[0]->wallet_add - @$vendors[0]->wallet_deduct ?>
		</label>
	</div>
</div>

<?php if (@$vendors[0]->vendor_address != '') {
	# code...
?>
	<div class="row">
		<div class="col-5">
			<label class='font-weight-semibold'>
				Vendor Address:
			</label>
		</div>
		<div class="col-7">
			<label class="d-block">
				<?= @$vendors[0]->vendor_address ?>
			</label>
			<label class="d-block">
				<?= @$vendors[0]->city_name.' - '.@$vendors[0]->pin_code ?>
			</label>
		</div>
	</div>
<?php }}else{
?>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Name:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$userData[0]->first_name.' '.@$userData[0]->last_name ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			E-Mail:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$userData[0]->user_email ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Contact No:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$userData[0]->user_contact ?>
		</label>
	</div>
</div>
<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Wallet Balance:
		</label>
	</div>
	<div class="col-7">
		<label>
			₹<?= @$userData[0]->wallet_add - @$userData[0]->wallet_deduct ?>
		</label>
	</div>
</div>

<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Total Orders:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= @$userData[0]->order_count ?>
		</label>
	</div>
</div>

<div class="row">
	<div class="col-5">
		<label class='font-weight-semibold'>
			Date of Account Create:
		</label>
	</div>
	<div class="col-7">
		<label>
			<?= date("d-m-Y", strtotime(@$userData[0]->registered_at)) ?>
		</label>
	</div>
</div>

<?php if (@$userData[0]->bill_name != '') {
	# code...
?>
	<div class="row">
		<div class="col-5">
			<label class='font-weight-semibold'>
				Last Billing Details:
			</label>
		</div>
		<div class="col-7">
			<label class="d-block">
				<?= @$userData[0]->bill_name.' '.@$userData[0]->bill_lastname ?>
			</label>
			<label class="d-block">
				<?= @$userData[0]->bill_contact ?>
			</label>
			<label class="d-block">
				<?= @$userData[0]->bill_email ?>
			</label>
			<label class="d-block">
				<?= @$userData[0]->address_1 ?>
			</label>
			<label class="d-block">
				<?= @$userData[0]->address_2 ?>
			</label>
			<label class="d-block">
				<?= @$userData[0]->city.' - '.@$userData[0]->pin_code.', '.@$userData[0]->state_name ?>
			</label>
		</div>
	</div>
<?php }} ?>