<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
  .new-input{
  	display: block;
  	width: 100% !important;
  	background-color: #ffffff;
    border: 1px #ddd solid;
    padding: 8px 10px;
    outline: none;
    color: #aaa;
  }
  input.new-input::placeholder {
	    color: #c7c7c7;
	}
  .bb-1-d{
  	border-bottom: 1px solid #ddd;
  }
  .new-btn{
  	    color: #e62263;
	    background: #fff;
	    border: 1px solid #e62263;
	    font-size: 14px;
	    padding: 0px 10px;
	    outline: none;
  }
  .checkoutImg{
	    max-width: 20%;
	    vertical-align: inherit;
	    height: auto;
	    max-height: 50px;
	    width: auto;
	    float: right;
	}
  .checkoutLabel{
  	width: 80%;
  	padding-right: 10px;
  }
  @media only screen and (min-width: 800px)
  {
  	.row.row-eq-height{
		  display: -webkit-box;
		  display: -webkit-flex;
		  display: -ms-flexbox;
		  display: flex;
	  }
  }
  @media only screen and (max-width: 479px) and (min-width: 320px)
  {
  	.customPad{
  		padding: 0 8px;
  	}
  	.mt-xs{
  		margin-top: 10px;
  	}
  }
</style>
<body class="checkout-page">
	<div id="page">
	<?php
	$this->load->view('includes/header');
	$this->load->view('includes/navigation');
	?>
		<div id="payment_form">
		  	<div class="main-container col2-right-layout">
			    <div class="main container">
				    <div class="row">
				      	<form action="<?= base_url('user/confirmorder') ?>" id="checkOutForm" method="post">
					        <section class="col-sm-12 col-xs-12 customPad">
						        <div class="col-main">
						            <div class="page-title">
						              <h1>Checkout</h1>
						            </div>
						            <input type="hidden" name="language" value="EN"> 
								    
								    
								    <input type="hidden" name="redirect_url" value="https://www.frinza.com/ccavResponseHandler.php"> 
								    <input type="hidden" name="cancel_url" value="https://www.frinza.com/ccavResponseHandler.php">
						            <div class="row clearfix row-eq-height">
						            	<div class="col-md-6 col-sm-12 col-xs-12 bb-1-d">
						            		 <fieldset>
											    <legend>Billing Details: <button type="button" class="new-btn pull-right" onclick="clearForm('billing')">New*</button></legend>
											    <div class="">
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">First Name:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="billing[name]" class="new-input bill-require" placeholder="First Name" value="<?= @$billing->name ?>">
												    		<input type="hidden" name="billing[hdnID]" value="<?= @$billing->address_id ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Last Name:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="billing[last_name]" class="new-input bill-require" placeholder="Last Name" value="<?= @$billing->last_name ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-12">
											    			<label class="control-label">Email:<span class="required">*</span></label>
											    			<br>
											    			<input type="text" name="billing[email]" class="new-input bill-require" placeholder="Email Address" value="<?= @$billing->email ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-12">
											    			<label class="control-label">Address:<span class="required">*</span></label>
											    			<br>
											    			<input type="text" name="billing[address_1]" class="new-input bill-require" placeholder="Enter your Address" value="<?= @$billing->address_1 ?>">
											    			<br>
											    			<input type="text" name="billing[address_2]" class="new-input" value="<?= @$billing->address_2 ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">City:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="billing[city]" class="new-input bill-require" placeholder="City" value="<?= @$billing->city ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">State:<span class="required">*</span></label>
												    		<br>
												    		<select class="new-input bill-require" name="billing[state]">
												    			<option value="">Select State</option>
												    			<?php
												    				for ($st=0; $st < count($states); $st++) { 
												    					$stateselection = $states[$st]->state_id == @$billing->state ? 'selected' : '';
												    					echo "<option value='".$states[$st]->state_id."' ".$stateselection.">".$states[$st]->state_name."</option>";
												    				}
												    			?>
												    		</select>
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Pincode:<span class="required">*</span></label>
												    		<br>
												    		<input type="number" maxlength="6" name="billing[pin_code]" class="new-input bill-require" placeholder="Pin Code" value="<?= @$billing->pin_code ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Telephone:<span class="required">*</span></label>
												    		<br>
												    		<input type="number" maxlength="10" name="billing[contact]" class="new-input bill-require" placeholder="Telephone No." value="<?= @$billing->contact ?>">
											    		</div>
											    	</div>
											    </div>
											  </fieldset>
						            	</div>
						            	<div class="col-md-6 col-sm-12 col-xs-12 mt-xs bb-1-d">
						            		 <fieldset>
											    <legend>
											    	<button type="button" class="new-btn pull-right" style="display: none;" id="shipAddNewBtn" onclick="clearForm('shipping')">New*</button>
											    	<label class="chkCont" style="margin-bottom: 10px">Deliver to a different address?<input type="checkbox" id="shipAdd" name="sameAdd" value="1"><span class="checkmark"></span></label>
											    </legend>
											    <div id="shipAddContainer" style="display: none;">
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">First Name:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="shipping[name]" class="new-input ship-require" placeholder="First Name" value="<?= @$shipping->name ?>">
												    		<input type="hidden" name="shipping[hdnID]" value="<?= @$shipping->address_id ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Last Name:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="shipping[last_name]" class="new-input ship-require" placeholder="Last Name" value="<?= @$shipping->last_name ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-12">
											    			<label class="control-label">Email:<span class="required">*</span></label>
											    			<br>
											    			<input type="email" name="shipping[email]" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,3}$" title="Please Enter Valid Email" class="new-input ship-require" placeholder="Email Address" value="<?= @$shipping->email ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-12">
											    			<label class="control-label">Address:<span class="required">*</span></label>
											    			<br>
											    			<input type="text" name="shipping[address_1]" class="new-input ship-require" placeholder="Enter your Address" value="<?= @$shipping->address_1 ?>">
											    			<br>
											    			<input type="text" name="shipping[address_2]" class="new-input" value="<?= @$shipping->address_2 ?>">
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">City:<span class="required">*</span></label>
												    		<br>
												    		<input type="text" name="shipping[city]" class="new-input ship-require" placeholder="City" value="<?= @$shipping->city ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">State:<span class="required">*</span></label>
												    		<br>
												    		<select class="new-input ship-require" name="shipping[state]">
												    			<option value="">Select State</option>
												    			<?php
												    				for ($st=0; $st < count($states); $st++) { 
												    					$stateselection = $states[$st]->state_id ==  @$shipping->state ? 'selected' : '';
												    					echo "<option value='".$states[$st]->state_id."'>".$states[$st]->state_name."</option>";
												    				}
												    			?>
												    		</select>
											    		</div>
											    	</div>
											    	<div class="form-group clearfix">
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Pincode:<span class="required">*</span></label>
												    		<br>
												    		<input type="number" maxlength="6" name="shipping[pin_code]" class="new-input ship-require" placeholder="Pin Code" value="<?= @$shipping->pin_code ?>">
											    		</div>
											    		<div class="col-md-6 col-xs-6">
											    			<label class="control-label">Telephone:<span class="required">*</span></label>
												    		<br>
												    		<input type="number" maxlength="10" name="shipping[contact]" class="new-input ship-require" placeholder="Telephone No." value="<?= @$shipping->contact ?>">
											    		</div>
											    	</div>
											    </div>
											  </fieldset>
						            	</div>
						            </div>
						            <div class="row clearfix">
						            	<div class="col-md-8 col-sm-12">
						            		<br>
						            		 <legend>Your Order:</legend>
						            		<table class="table table-bordered">
							            		<tr>
							            			<th>Products</th>
							            			<th>Delivery Date/Time</th>
							            			<th class="text-center" style="min-width: 60px;">Total</th>
							            		</tr>
							            		<?php
													$tax_ids = array_values(array_unique(array_filter(array_column($cartData,'tax_id'), function($ar){ 
														return $ar; 
													})));
													$tax_rates = array();
													if(count($tax_ids)) {
														$tax_rates = getTaxRates($tax_ids);
													}
													$totalTax = 0;
							            			for ($i=0; $i < count($cartData); $i++) { 
														if($cartData[$i]['tax_id']) {
															$totalTax += ($cartData[$i]['price'] * $cartData[$i]['qty'] * $tax_rates[$cartData[$i]['tax_id']]) / ($tax_rates[$cartData[$i]['tax_id']] + 100);
														}
														$totalTax += $tax_rates[$cartData[$i]['tax_id']] ? : 0; 
														?>
							            				<tr>
							            					<td><label class="checkoutLabel"><?= @$cartData[$i]['product_title'] ?>&nbsp;x&nbsp; <?= @$cartData[$i]['qty'] ?></label><img src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.@$cartData[$i]['product_img'] ?>" class='checkoutImg'></td>
							            					<td><?= @$cartData[$i]['time'] ?></td>
							            					<td class="text-right">₹<?= @$cartData[$i]['qty']*@$cartData[$i]['price'] ?></td>
							            				</tr>
							            		<?php
							            			}
							            		?>
							            		<tr>
							            			<th colspan="2" class="text-right">Sub Total</th>
							            			<td class="text-right">₹<?= round(@$cartTotal - @$totalTax, 2) ?></td>
							            		</tr>
							            		<tr>
							            			<th colspan="2" class="text-right">Shipping Charge</th>
							            			<td class="text-right">₹<?= @$shipTotal ?></td>
							            		</tr>
							            		<tr>
							            			<th colspan="2" class="text-right">Total Tax</th>
							            			<td class="text-right">₹<?= round(@$totalTax, 2) ?></td>
							            		</tr>
							            		<tr>
							            			<th colspan="2" class="text-right">Grand Total</th>
							            			<th class="text-right">₹<?= @$cartTotal + @$shipTotal ?></th>
							            		</tr>
							            		<tr>
							            			<th colspan="2" class="text-right">Paid From Wallet</th>
							            			<th class="text-right"><font color="red">- ₹<?= @$payableWal ?></font></th>
							            		</tr>
							            		<tr>
							            			<th colspan="2" class="text-right">Remaining Payable</th>
							            			<th class="text-right">₹<?= @$payableAmount ?></th>
							            		</tr>
							            		<tr>
							            			<td colspan="3" style="vertical-align: middle;">
							            				<label class="control-label col-md-3 col-xs-12">Message on Card / Cake:</label>
							            				<div class="col-md-9 col-xs-12">
							            					<input type="hidden" name="walletpay" value="<?= @$payableWal ?>">
							            					<input type="text" name="msg_card" placeholder="Message on Card and Cake(If applicable)" class="new-input">
							            				</div>
							            			</td>
							            		</tr>
							            		<tr>
							            			<th colspan="1" style="vertical-align: middle;">
							            				Payment Method:
							            			</th>
							            			<td colspan="2" style="vertical-align: middle;">
														<input type="radio" name="payment_method" value="payu" class="radio" checked>PayUmoney<br>
							            				<!-- <input type="radio" name="payment_method" value="paypal" class="radio">PayPal -->
							            			</td>
							            		</tr>
							            		<tr>
							            			<td colspan="3" class="text-right">
							            				<label class="chkCont pull-left" style="margin-bottom: 10px"><input type="checkbox" name="tnc" required value="1">I Agree to the <a href="<?= base_url('terms') ?>" target="_blank" style="color: #e62263">Terms & Conditions</a>.<span class="checkmark"></span></label>
							            				<input type="submit" name="place_order" class="button coupon" value='Pay & Place Order' />
							            			</td>
							            		</tr>
							            	</table>
						            	</div>
						            </div>
						        </div>
					    	</section>
						</form>
					</div>
				</div>
			</div>
		</div>
		<?php
			$this->load->view('includes/brands');
			$this->load->view('includes/footer');
		?>
	</div>
	<?php
		$this->load->view('includes/mobilemenu');
		$this->load->view('includes/footerlinks');
	?>
	<script type="text/javascript">
		<?php
	      if ($this->session->flashdata('txnError')) {
	          echo 'alert("'.$this->session->flashdata('txnError').'");';
	      }
	    ?>
		$(function() {
			$('#shipAdd').on('change', function() {
				if ($(this).is(":checked")) {
					$('#shipAddContainer').slideDown(500);
					$('#shipAddNewBtn').fadeIn(500);
				}else{
					$('#shipAddContainer').slideUp(500);
					$('#shipAddNewBtn').fadeOut(500);
				}
			});
			$('input[type=number]').on('keyup',function(e){
				var maxLength =  Number($(this).attr('maxlength'));
				var Val = $(this).val();
				if (Val.length > maxLength) {
					$(this).val(Val.substring(0,maxLength));
				}else if(isNaN(Val) || $(this).is(":invalid")){
					$(this).val('');
				}
			});
			$('#checkOutForm').on('submit',function(e){
				$('.bill-require').each(function(){
					if ($(this).val() == '') {
						$(this).focus();
						Toast.fire({
							type: 'error',
							title: 'Please Fill Required Fields!'
						});
						// alert('Please Fill Required Fields!');
						e.preventDefault();
						return false;
					}
					if ($(this).is(":invalid")) {
						$(this).focus();
						Toast.fire({
							type: 'error',
							title: 'Please Enter Correct Data!'
						});
						// alert('Please Enter Correct Data!');
						e.preventDefault();
						return false;
					}
				});
				if ($('#shipAdd').is(':checked')) {
					$('.ship-require').each(function(){
						if ($(this).val() == '') {
						$(this).focus();
						Toast.fire({
							type: 'error',
							title: 'Please Fill Required Fields!'
						});
						// alert('Please Fill Required Fields!');
						e.preventDefault();
						return false;
						}
						if ($(this).is(":invalid")) {
							$(this).focus();
							Toast.fire({
								type: 'error',
								title: 'Please Enter Correct Data!'
							});
							// alert('Please Enter Correct Data!');
							e.preventDefault();
							return false;
						}
					});
				}
			});
		});
		function clearForm(name)
		{
			$('[name*='+name+']').val('');
		}
	</script>
</body>
</html>