<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/headerlinks.php' ?>
<?php
$cart = getCartData();
$cartTotal = count($cart) ? getCartTotal() : 0;
$shipTotal = count($cart) ? getShippingTotal() : 0;
$wallet = UserWallet();
?>
<body class="shopping-cart-page">
	<div id="page">
		<!-- Header -->
		<?php include_once 'includes/header.php' ?>
		<!-- end header -->

		<!-- Navigation -->

		<?php include_once 'includes/navigation.php' ?>
		<!-- end nav -->
		<style type="text/css">
			.mobileHide {
				display: inline-table;
			}

			.mobileShow {
				display: none;
			}

			.close-button {
				position: absolute;
				right: 4px;
				top: 0;
				background: #f00 !important;
				opacity: 1;
				font-size: 21px;
				font-weight: 700;
				line-height: 1;
				color: #fff;
				padding: 5px 10px 10px 10px !important;
				border-radius: 0 0 50% 50%;
			}
		</style>
		<section class="main-container col1-layout">
			<div class="main container noPadding">
				<div class="col-main">
					<div class="cart noPadding">
						<div class="col-md-12 col-xs-12">
							<?php if ($this->session->flashdata('message') || $this->session->flashdata('success_msg')) { ?>
							<div class="alert alert-success alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?= $this->session->flashdata('message') ?>
								<?= $this->session->flashdata('success_msg') ?>
							</div>
							<?php }else{ ?>
							<div class="alert alert-error alert-dismissible">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<?= $this->session->flashdata('error_msg') ?>
							</div>
							<?php } ?>
							
							<div class="page-title">
								<h1>Shopping Cart</h1>
								<input type="hidden" id="pincode" value="<?= @$cart[0]['pincode'] ?>">
								<input type="hidden" class="citysel" value="<?= @$cart[0]['city_id'] ?>">
							</div>
							<div class="table-responsive">
								<form method="post" action="#">
									<input type="hidden" value="Vwww7itR3zQFe86m" name="form_key">
									<fieldset>
										<table class="mobileHide data-table cart-table" id="shopping-cart-table">
											<colgroup>
												<col width="1">
												<col>
												<col>
												<col width="1">
												<col width="1">
												<col width="1">
												<col width="1">
												<col width="1">
												<col width="1">
											</colgroup>
											<thead>
												<tr class="first last">
													<th rowspan="1">&nbsp;</th>
													<th rowspan="1"><span class="nobr">Product Name</span></th>
													<th rowspan="1"><span class="nobr">Delivery Time</span></th>
													<th colspan="1" class="a-center"><span class="nobr">Unit
															Price</span></th>
													<th class="a-center" rowspan="1">Qty</th>
													<th colspan="1" class="a-center">Subtotal</th>
													<th class="text-center" colspan="2">Coupon</th>
													<th class="a-center" rowspan="1">&nbsp;</th>
												</tr>
											</thead>
											<tfoot>
												<tr class="first last">
													<td class="a-right last" colspan="50"><button
															onclick="window.location.href = '<?= base_url() ?>'"
															class="button btn-continue" title="Continue Shopping"
															type="button"><span>Continue Shopping</span></button>
														<button id="empty_cart_button" onclick="clearCart()"
															class="button btn-empty" title="Clear Cart"
															value="empty_cart" name="update_cart_action"
															type="button"><span>Clear Cart</span></button></td>
												</tr>
											</tfoot>
											<tbody>
												<?php
													$payable = $cartTotal + $shipTotal - $wallet;
													foreach ($cart as $r) {
												 ?>
												<tr>
													<td class="image"><a class="product-image"
															title="<?= $r['product_title'] ?>"
															href="<?= base_url('') . url_title($r['product_title'], '-', true) . '/p' . $r['product_id'] ?>"><img
																width="75" alt="Sample Product"
																src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT . $r['product_img'] ?>"></a>
													</td>
													<td>
														<h2 class="product-name"> <a
																href="<?= base_url('') . url_title($r['product_title'], '-', true) . '/p' . $r['product_id'] ?>"><?= $r['product_title'] ?></a>
														</h2>
														<br>
														<?php
															if ($r['personalize_img'] != 'null' && $r['personalize_img'] != '' ) {
														 ?>
														<button class="button btn-continue" type="button" onclick="openImageModal(`<?= @FOLDER_ASSETS_PERSONALIZE ?>`,`<?= implode(',', json_decode($r['personalize_img'])) ?>`)" style="margin-top: 10px;">Uploaded files</button>
														<?php
															}
															if(!$r['addoncategory_id']) {
														 ?>

														<button class="button btn-continue" type="button"
															onclick="yourAddonsModal(<?= @$r['cart_id'] ?>)"
															style="margin: 10px 0 0 10px;">Addons</button>
															<?php } ?>
													</td>
													<td><?= $r['time'] ?></td>
													<td class="a-right"><span class="cart-price"> <span
																class="price">₹<span
																	class='sPrice'><?= $r['price'] ?></span></span>
														</span></td>
													<td class="a-center">
														<span class="qty input-text" title="Qty"><?= $r['qty'] ?></span>
													</td>
													<td class="a-right"><span class="cart-price"> <span
																class="price">₹<span
																	class='stPrice'><?= $r['price'] * $r['qty'] ?></span></span>
														</span></td>

													<td>
														<?php if(!$r['addoncategory_id']) { ?>
														<input class="form-control" type="text"
															placeholder="Enter Coupon Code"
															id='coupon_code<?= $r['cart_id'] ?>'
															value="<?= $r['coupon_code'] ?>">
														<?php } ?>
													</td>
													<td>
													<?php if(!$r['addoncategory_id']) { ?>
														<a class="button" id="couponbtn<?= $r['cart_id'] ?>"
															onclick="applyCoupon(<?= $r['cart_id'] ?>)"
															title="Apply Coupon"
															href="#"><span><span>Apply</span></span></a>
														<?php } ?>
													</td>
													<td class="a-center last"><a class="button remove-item"
															onclick="removeFromCart(<?= $r['product_id'] ?>,0)"
															title="Remove item" href="#"><span><span>Remove item</span></span></a></td>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										
										<table class="mobileShow table shopping-cart-table-total">
											<colgroup>
												<col width="1">
												<col>
												<col>
											</colgroup>
											<?php
												$redeemableAmount = redeemAmount($cartTotal + $shipTotal);
												$payable = $cartTotal + $shipTotal - $redeemableAmount;

												$tax_ids = array_values(array_unique(array_filter(array_column($cart,'tax_id'), function($ar){ 
													return $ar; 
												})));
												$tax_rates = array();
												if(count($tax_ids)) {
													$tax_rates = getTaxRates($tax_ids);
												}
												$totalTax = 0;
												
												if (count($cart) != 0) {
													foreach ($cart as $r) {
														if($r['tax_id']) {
															$totalTax += ($r['price'] * $r['qty'] * $tax_rates[$r['tax_id']]) / ($tax_rates[$r['tax_id']] + 100);
														}
														$totalTax += $tax_rates[$cartData[$i]['tax_id']] ? : 0; 
											 ?>
											<tbody class="noborcderClass">
												<tr>
													<td rowspan="5"><img width="120" alt="Sample Product"
															src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT . $r['product_img'] ?>">
														<?php
															if ($r['personalize_img']) {
														 ?>
														<button class="button btn-continue" type="button"
															onclick="openImageModal(`<?= @FOLDER_ASSETS_PERSONALIZE ?>`,`<?= implode(',', json_decode($r['personalize_img'])) ?>`)"
															style="margin-top: 10px;">Your Photo</button>
														<?php
															}
														 ?>
													</td>
													<td colspan="1" class="a-left"> Product Name </td>
													<td class="a-right"><a
															href="<?= base_url('') . url_title($r['product_title'], '-', true) . '/p' . $r['product_id'] ?>"><?= $r['product_title'] ?></a>
													</td>
												</tr>
												<tr>
													<td>Delivery Time </td>
													<td><?= $r['time'] ?></td>
												</tr>
												<tr>
													<td>Unit Price</td>
													<td><span class="cart-price"> <span class="price">₹<span
																	class='sPrice'><?= $r['price'] ?></span></span>
														</span></td>
												</tr>
												<tr>
													<td>Qty</td>
													<td><span class="qty input-text" title="Qty"><?= $r['qty'] ?></span>
													</td>
												</tr>
												<tr>
													<td>Sub Total</td>
													<td><span class="cart-price"> <span class="price">₹<span
																	class='stPrice'><?= $r['price'] * $r['qty'] ?></span></span>
														</span></td>
												</tr>
												<tr>
													<td><input class="form-control noMargin" type="text"
															placeholder="Coupon Code"
															id='coupon_codem<?= $r['cart_id'] ?>'
															value="<?= $r['coupon_code'] ?>" style="width:120px;"></td>
													<td style="width: 100px;"><a class="button"
															id="couponbtnm<?= $r['cart_id'] ?>"
															onclick="applyCoupon(<?= $r['cart_id'] ?>,'m')"
															title="Apply Coupon"
															href="#"><span><span>Apply</span></span></a></td>
													<td> <button class="button btn-continue"
															onclick="removeFromCart(<?= $r['product_id'] ?>,0)"
															title="Remove item" href="#"><span><span>Remove
																	item</span></span></button></td>
												</tr>
											</tbody>
											<?php }
												} else {
											 ?>
											<style type="text/css">
												.noitem:before {
													font-size: 50px;
												}
											</style>
											<tbody class="noborcderClass">
												<tr>
													<td colspan="3" class="text-center">
														<p class="a-center noitem noPadding"></p>
														<h2>Your Cart is empty!</h2>
														<h5 style="color: #008000;">But it doesn't have to be.</h5>
													</td>
												</tr>
											</tbody>
											<?php
												}
											 ?>
											<tfoot>
												<tr>
													<td>
														<?php
															if (count($cart) != 0) {
														 ?>
														<button id="empty_cart_button" onclick="clearCart()" class="button btn-empty" title="Clear Cart" value="empty_cart" name="update_cart_action" type="button"><span>Clear Cart</span></button></td>
													<?php } ?>
													<td class="a-right last text-right" colspan="2">
														<button onclick="window.location.href = '<?= base_url() ?>'" class="button btn-continue" title="Continue Shopping" type="button"><span>Continue Shopping</span></button>
													</td>
												</tr>
											</tfoot>
										</table>
									</fieldset>
								</form>
							</div>
						</div>
						<?php
							if (count($cart) != 0) {
						 ?>
						<div class="col-md-12 col-xs-12 m-12 table-responsive noPadding">
							<div class="inner">
								<table class="mobileHide data-table cart-table" id="shopping-cart-totals-table">
									<colgroup>
										<col>
										<col>
										<col>
										<col>
										<col>
										<col>
										<col width="1">
									</colgroup>
									<thead>
										<tr class="first last">
											<th>Subtotal</th>
											<th>Shipping Charge</th>
											<th>Total Tax</th>
											<th>Grand Total</th>
											<th>Cashback</th>
											<th>Wallet Bal</th>
											<th>Payable</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td class="a-center "><strong><span class="price">₹<?= round($cartTotal - $totalTax, 2) ?></span></strong></td>
											<td class="a-center "><strong><span class="price">₹<?= $shipTotal ?></span></strong></td>
											<td class="a-center "><strong><span class="price">₹<?= round($totalTax,2) ?></span></strong></td>
											<td class="a-center "><strong><span class="price">₹<?= $cartTotal + $shipTotal ?></span></strong></td>
											<td class="a-center "><strong><span class="price cashbackvalue">₹<?= getCashBack() ?></span></strong></td>
											<td class="a-center text-danger"><strong><span class="price"> ₹<?= $wallet ?></span></strong></td>
											<td class="text-success" style="font-size: 20px;"> <strong><kbd>&nbsp;₹<?= @$payable > 0 ? $payable : 0 ?>&nbsp;</kbd></strong></td>
											<td></td>
										</tr>
										<tr>
											<td colspan="3"></td>

											<?php if ($wallet != 0) { ?>
											<td>
												<strong><span class="price">Frinza Wallet</span></strong>
											</td>
											<td>
												<form action="<?= base_url('checkout') ?>" id='checkOutForm' method='post'>
													<input class="form-control walletpay" name="walletpay" style="width: 100%" type="number" placeholder="Enter Amount to deduct from wallet" max='<?= $redeemableAmount ?>' value='<?= $redeemableAmount ?>'>
												</form>
											</td>

											<td class="a-center ">
												<strong>
													<span class="price" id="remainPayable">

														₹<?= @$payable > 0 ? $payable : 0 ?>

													</span>
												</strong>
											</td>

											<?php } else { ?>
											<td colspan="3">
											</td>
											<?php } ?>
											<td>
												<button class="button btn-continue" onclick="checkOut()" title="Proceed to Checkout" type="button"
													<?php if (count($cart) == 0) {echo "disabled = 'disabled'";} ?>><span>Checkout</span></button>
											</td>

										</tr>
									</tbody>
								</table>
								<form action="<?= base_url('checkout') ?>" id='checkOutForm' method='post'>
									<table class="mobileShow table " id="shopping-cart-totals-table">
										<colgroup>
											<col>
											<col>
											<col width="1">
										</colgroup>
										<tbody>
											<tr>
												<td colspan="2">Sub Total</td>
												<td class="a-right"><strong><span class="price">₹<?= $cartTotal ?></span></strong></td>
											</tr>
											<tr>
												<td colspan="2">Shipping Charge </td>
												<td class="a-right"><strong><span class="price">₹<?= $shipTotal ?></span></strong></td>
											</tr>
											<tr>
												<td colspan="2">Grand Total </td>
												<td class="a-right"><strong><span class="price">₹<?= $cartTotal + $shipTotal ?></span></strong>
												</td>
											</tr>
											<tr>
												<td colspan="2">Cashback </td>
												<td class="a-right"><strong><span class="price cashbackvalue">₹<?= getCashBack() ?></span></strong>
												</td>
											</tr>
											<tr>
												<td colspan="2">Wallet Balance </td>
												<td class="a-right"><strong><span class="price"> ₹<?= $wallet ?></span></strong></td>
											</tr>
											<?php if ($wallet != 0) { ?>
											<tr>
												<td>
													<strong>
														<span class="price">Frinza Wallet</span>
													</strong>
												</td>
												<td>
													<input class="form-control walletpay" name="walletpay" style="width: 40%" type="number" placeholder="Enter Amount to deduct from wallet" max='<?= $redeemableAmount ?>' value='<?= $redeemableAmount ?>'>
												</td>
												<td class="a-right"><strong>
														<span class="price" id="remainPayable">
															₹<?= @$payable > 0 ? $payable : 0 ?>
														</span>
													</strong>
												</td>
											</tr>
											<?php } ?>
											<tr>
												<td colspan="2">Payble</td>
												<td class="text-success" style="font-size: 20px;">
													<strong><kbd>&nbsp;₹<?= @$payable > 0 ? $payable : 0 ?>&nbsp;</kbd></strong>
												</td>
											</tr>
											<tr>
												<td colspan="3" class="text-right">
													<button class="button btn-continue" title="Proceed to Checkout" type="submit"
													<?php if (count($cart) == 0) {echo "disabled = 'disabled'";} ?>><span>Proceed
													To Checkout</span></button>
												</td>
											</tr>
										</tbody>
									</table>
								</form>
							</div>
							<!--inner-->

						</div>
						<?php
							}
						?>
					</div>
				</div>
			</div>
		</section>
		<div id="yourImgModal" class="modal fade" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Uploaded Files</h4>
					</div>
					<div class="modal-body row">

					</div>
				</div>

			</div>
		</div>

		<!-- Brand Logo -->
		<?php include_once 'includes/brands.php' ?>
		<!-- Footer -->
		<?php include_once 'includes/footer.php' ?>
	</div>
	<?php include_once 'includes/mobilemenu.php' ?>
	<!-- End Footer -->
	<!-- JavaScript -->
	<?php include_once 'includes/footerlinks.php' ?>
	<script type="text/javascript">
		function applyCoupon(arg, mob = '') {
			var coupon = $('input#coupon_code' + mob + arg).val();
			$.ajax({
				url: '<?= base_url('cart/ applycoupon') ?>',
				data: {
					coupon_code: coupon,
					id: arg
				},
				type: 'post',
				success: function (a) {
					a = JSON.parse(a);
					if (a['success']) {
						Swal.fire({
							position: 'top-end',
							type: 'success',
							title: a['success'],
							showConfirmButton: false,
							timer: 1500
						})
						$('input#coupon_code' + mob + arg).prop('disabled', true);
						$('#couponbtn' + mob + arg).text('Remove').attr('onclick', 'removeCoupon(' + arg +
							',"' + mob + '")');
					} else {
						Swal.fire({
							position: 'top-end',
							type: 'error',
							title: a['err'],
							showConfirmButton: false,
							timer: 1500
						})
					}
					$('.cashbackvalue').text('₹' + a['cashback']);
				}
			})
		}

		function removeCoupon(arg, mob = '') {
			var coupon = null;
			$.ajax({
				url: '<?= base_url('cart/ applycoupon') ?>',
				data: {
					coupon_code: coupon,
					id: arg
				},
				type: 'post',
				success: function (a) {
					$('input#coupon_code' + mob + arg).val('').prop('disabled', false);
					$('#couponbtn' + mob + arg).text('Apply').attr('onclick', 'applyCoupon(' + arg + ',"' +
						mob + '")');
					$('.cashbackvalue').text('₹' + a);
				}
				})
			}
		$(document).ready(function () {
			var walmax = <?=  $redeemableAmount  ?>;
			<?php
				if($this->input->get('addon')) {
					echo "yourAddonsModal(`{$this->input->get('addon')}`);";
				}
			?>
			$('body').on('keyup', '.walletpay', function (e) {
				var walp = $('.walletpay').val();
				if (walp > walmax) {
					$('.walletpay').val(walmax);
					const Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000
					});

					Toast.fire({
						type: 'error',
						title: 'You can use only <?= getRedeemRate() ?> % of Order Value from Cashback Amount!'
					})
					return false;
				}
				walp = walmax - walp;
				$('#remainPayable').html('₹' + walp);
			})

		})

		function checkOut() {
			$('#checkOutForm').trigger('submit');
		}

		function openImageModal(src, imgar) {
			$('#yourImgModal .modal-body').html('');
			var imgArr = imgar.split(",");
			for (var i = 0; i < imgArr.length; i++) {
				switch (imgArr[i].split('.')[1]) {
					case 'pdf':
						imgSrc = 'pdf.png';
						break;
					case 'doc':
						imgSrc = 'doc.png';
						break;
					case 'docx':
						imgSrc = 'doc.png';
						break;
					case 'rtf':
						imgSrc = 'doc.png';
						break;
					default:
						imgSrc = imgArr[i];
				}
				$('#yourImgModal .modal-body').append(`<img class="col-md-4 col-xs-12" src="` + src + imgSrc + `" />`);
			}
			$('#yourImgModal').modal('show');
		}

	</script>

</body>

</html>