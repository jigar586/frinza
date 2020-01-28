<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style type="text/css">
.select2-container--default .select2-selection--single .select2-selection__rendered:focus {
	border: 1px solid #000;
}

.btn-buynow:before {
	content: "\f290" !important;
}

.fnp-cart-md {
	display: block;
}

.fnp-cart-sm {
	display: none;
}

@media only screen and (max-width: 600px) {
	.fnp-cart-sm {
		display: block;
		position: fixed;
		left: 0;
		z-index: 99;
		bottom: 0;
		width: 100%;
	}

	.fnp-cart-md {
		display: none;
	}

	.fnp-cart-sm .btn-cart:before {
		font-family: FontAwesome;
		margin-right: 10px;
		content: "\f07a";
	}

	.fnp-cart-sm .btn-cart {
		font-size: 16px;
		text-shadow: none;
		padding: 15px 10px;
		float: left;
		margin-top: 0;
		font-weight: 700;
		margin-left: 0;
		border: 0;
		text-transform: uppercase;
		background: #e62263;
		color: #fff;
		display: inline-block;
		width: 50%;
	}

	.fnp-cart-sm .btn-cart:hover {
		padding: 15px 10px;
	}

	#mobHeadWrap {
		margin-bottom: -10px !important;
	}
}

.btn-file {
	position: relative;
	overflow: hidden;
}

.btn-file input[type=file] {
	position: absolute;
	top: 0;
	right: 0;
	min-width: 100%;
	min-height: 100%;
	font-size: 100px;
	text-align: right;
	filter: alpha(opacity=0);
	opacity: 0;
	outline: none;
	background: white;
	cursor: inherit;
	display: block;
}

.uploadBtn {
	font-size: 12px;
}

/*#img-upload{
		width: 10%;
		height: 10%;
	}*/
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<body class="product-page">
	<div id="page">
		<div class="fnp-cart-sm">
			<button onclick="buyCart(0)" class="button btn-cart" title="Add to Cart" type="button" style="background: #777;">Add to Cart</button>
			<button onclick="buyCart(1)" class="button btn-cart btn-buynow" title="Buy Now" type="button">Buy Now</button>
		</div>
		<?php include_once('includes/header.php') ?>

		<?php include_once('includes/navigation.php') ?>

		<section class="main-container col1-layout">
			<div class="main">
				<div class="container">
					<div class="row">
						<div class="col-main">
							<div class="product-view noMargin">
								<div class="product-essential">
									<form action="#" method="post" id="productDataForm" enctype="multipart/form-data">

										<div class="product-img-box col-lg-4 col-sm-5 col-xs-12 noPadding">
											<?php
											if (compareDate($product[0]->created_at,3)) { ?>
											<div class="new-label new-top-left"> New </div>
											<?php  }
												$imgs = json_decode($product[0]->product_img);
												?>
											<div class="product-image">
												<div class="product-full">

													<img id="product-zoom" class="lazy" src="<?= PLACEHOLDER_IMAGE ?>"
														data-src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>"
														data-zoom-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>"
														alt="<?= $product[0]->product_title ?>" />
												</div>
												<div class="more-views">
													<div class="slider-items-products">
														<div id="gallery_01"
															class="product-flexslider hidden-buttons product-img-thumb">
															<div class="slider-items slider-width-col4 block-content">
																<?php
																	for ($i=0; $i < count($imgs); $i++) { ?>
																<div class="more-views-items">
																	<a href="#"
																		data-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>"
																		data-zoom-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>">
																		<img id="product-zoom" class="lazy"
																			src="<?= PLACEHOLDER_IMAGE ?>"
																			data-src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>" />
																	</a>
																</div>
																<?php  }
																		?>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- end: more-images -->
										</div>
										<div class="product-shop col-lg-8 col-sm-7 col-xs-12">
											<div class="product-name">
												<h1><?= $product[0]->product_title ?></h1>
											</div>
											<div class="ratings">
												<div class="rating-box">
													<div style="width:<?= getAvgRating($product[0]->product_id) ?>%"
														class="rating"></div>
												</div>
												<p class="rating-links"> <a href="#product-detail-tab"
														onclick="scrollToReview()"><?= getRatingCount($product[0]->product_id) ?>
														Review(s)</a> <span class="separator">|</span> <a
														href="#product-detail-tab" onclick="scrollToReview()">Add Your
														Review</a> </p>
											</div>
											<div class="price-block">
												<div class="price-box" id="ppBox">
													<?php
														$price = $product[0]->price;
														$sPrice = offeredPrice($price,$product[0]->product_id);
														if ($price > $sPrice) { 
													?>
													<p class="special-price"> <span class="price-label"></span> <span
															id="product-price-48" class="price"> ₹<span
																id="currentPrice"><?= $sPrice ?></span></span> </p>
													<p class="old-price"> <span class="price-label"></span> <span
															class="price"> ₹<span id="oldPrice"><?= $price ?></span>
														</span> </p>
													<?php  }elseif( $price < $sPrice ){ ?>
													<p class="regular-price"> <span class="price-label"></span> <span
															id="product-price-48" class="price"> ₹<span
																id="currentPrice"><?= $sPrice ?></span></span> </p>
													<?php  }else{ ?>
													<p class="regular-price"> <span class="price-label"></span> <span
															id="product-price-48" class="price"> ₹<span
																id="currentPrice"><?= $price ?></span></span> </p>
													<?php }
																	?>
													<p class="availability in-stock pull-right"><span>In Stock</span>
													</p>
												</div>
											</div>
											<div class="short-description">
												<h2>Quick Overview</h2>
												<p><?= word_limiter(nl2br($product[0]->product_desc),100) ?></p>
												<a href="#product-detail-tab" onclick="scrollToDesc()"><b>Read More...</b></a>
											</div>
											<div class="add-to-box">
												<div class="citySelector col-lg-12">
													<div class="row">
														<div class="col-md-5 col-xs-12" style="margin-bottom: 15px;">
															<div class="input-group">
																<input type="hidden" name="citysec" class="citysel">
																<span class="input-group-addon pincode"><i class="fa fa-map-marker"></i></span>
																<input type="text" class="input-text pincode"  title="Pincode" id="pincode" placeholder="Enter Pincode" name="pincode" style="margin: 0;">
																<button type="button" id="btnVerify" class="button btn-continue" onclick="pincodeVerify()" style="padding:15px 15px 12px 15px;">Check</button>
																<button type="button" id="btnChange" class="button btn-continue" onclick="pincodechange()" style="padding:15px 15px 12px 15px;">change</button>
															</div>
														</div>

														<div class="col-md-3 col-xs-12" style="margin-bottom: 15px;">
															<?php
																if (@$sizeList) {
																	echo '<select class="sizeExtra priceUpdate" name="extraCharge[]">';
																		echo '<option value="">Default Size</option>'; 
																		foreach ($sizeList as $sList) {
															?>
															<option value="<?= $sList->charge_id ?>">
																<?= $sList->charge_name ?></option>
															<?php
																	}
																	echo "</select>";
																}
															?>
														</div>
													</div>
													<div class="row">
														<div class="msg text-danger col-md-12" style="margin-top: 5px;">
														</div>
													</div>
												</div>

												<div class="col-lg-12" style="margin-bottom: 15px;">

													<?php
														foreach ($chargeList as $ch) {
													?>
													<label class="chkCont"><?= $ch->charge_name ?>
														<input type="checkbox" name="extraCharge[]" value="<?= $ch->charge_id ?>" class="extraCharge priceUpdate">
														<span class="checkmark"></span>
													</label>
													<?php } ?>
												</div>

												<?php if ($product[0]->is_personalize) {
																			?>
												<label>Upload Image/Text</label>
												<div class="input-group col-md-5">
													<span class="input-group-btn">
														<span class="btn btn-default btn-file">
															Browse… <input type="file" id="imgInp" multiple
																accept=".doc,.docx,application/msword,.pdf,image/png, image/jpeg">
														</span>
													</span>
													<input type="text" class="form-control uploadBtn"
														placeholder="JPG, PNG, Doc, PDF of max 2 MB Allowed." readonly>
												</div><span id="file_error" class="text-danger"></span><br>
												<div id="img-upload"></div>
												<?php } ?>

												<div class="add-to-cart ">
													<div class="pull-left">
														<div class="custom pull-left">
															<button
																onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) result.value--;updatePrice();return false;"
																class="reduced items-count" type="button"><i
																	class="fa fa-minus">&nbsp;</i></button>
															<input type="number" class="input-text priceUpdate qty"
																title="Qty" value="1" min="1" max="5" id="qty"
																name="qty" maxlength="1" style="margin: 0;" disabled>
															<button
																onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &lt; 5 ) result.value++;updatePrice();return false;"
																class="increase items-count" type="button"><i
																	class="fa fa-plus">&nbsp;</i></button>
														</div>
													</div>
													<div class="fnp-cart-md">
														<button onclick="buyCart(0)" class="button btn-cart" title="Add to Cart" type="button" style="background: #777;">Add to Cart</button>
														<button onclick="buyCart(1)" class="button btn-cart btn-buynow" title="Buy Now" type="button">Buy Now</button>
													</div>
												</div>

												<div class="email-addto-box noMargin">
													<ul class="add-to-links">
														<li> <a class="link-wishlist" href="javascript:void(0)"
																onclick='addToWish(<?= $product[0]->product_id ?>)'><span>Add
																	to Wishlist</span></a></li>
													</ul>
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="product-collateral col-lg-12 col-sm-12 col-xs-12 noPadding">
							<div class="add_info">
								<ul id="product-detail-tab" class="nav nav-tabs product-tabs">
									<li class="active"> <a href="#product_tabs_description" data-toggle="tab"> Product
											Description </a> </li>
									<li> <a href="#reviews_tabs" data-toggle="tab">Reviews
											(<?= getRatingCount($product[0]->product_id) ?>)</a> </li>
								</ul>
								<div id="productTabContent" class="tab-content" style="width: 100%">
									<div class="tab-pane fade in active" id="product_tabs_description">
										<div class="std">
											<p><?= nl2br($product[0]->product_desc) ?></p>
										</div>
									</div>
									<div class="tab-pane fade" id="reviews_tabs">
										<div class="box-collateral box-reviews" id="customer-reviews">
											<?php if(count($myReview) == 0){ ?>
											<div class="box-reviews1">
												<div class="form-add">
													<form id="review-form" method="post">
														<h3>Write Your Own Review</h3>
														<fieldset>
															<span id="input-message-box"></span>
															<table id="product-review-table" class="data-table">
																<colgroup>
																	<col>
																	<col width="1">
																	<col width="1">
																	<col width="1">
																	<col width="1">
																	<col width="1">
																</colgroup>
																<thead>
																	<tr class="first last">
																		<th>&nbsp;</th>
																		<th><span class="nobr">1 *</span></th>
																		<th><span class="nobr">2 *</span></th>
																		<th><span class="nobr">3 *</span></th>
																		<th><span class="nobr">4 *</span></th>
																		<th><span class="nobr">5 *</span></th>
																	</tr>
																</thead>
																<tbody>
																	<tr class="first odd">
																		<th>
																			<h4>How do you rate this product? <em class="required">*</em></h4>
																		</th>
																		<td class="value"><input type="radio" class="radio" value="11" id="Price_1" name="ratings[1]"></td>
																		<td class="value"><input type="radio" class="radio" value="12" id="Price_2" name="ratings[1]"></td>
																		<td class="value"><input type="radio" class="radio" value="13" id="Price_3" name="ratings[1]"></td>
																		<td class="value"><input type="radio" class="radio" value="14" id="Price_4" name="ratings[1]"></td>
																		<td class="value last-odd"><input type="radio" class="radio" value="15" id="Price_5" name="ratings[1]" checked></td>
																	</tr>
																</tbody>
															</table>
															<input type="hidden" value="<?= $product[0]->product_id ?>"
																class="validate-rating" name="validate_rating">
															<div class="review1">
																<ul class="form-list">
																	<li>
																		<label class="required"
																			for="nickname_field">Nickname<em>*</em></label>
																		<div class="input-box">
																			<input type="text" class="input-text"
																				id="nickname_field" name="nickname">
																		</div>
																	</li>
																	<li>
																		<label class="required"
																			for="summary_field">Summary<em>*</em></label>
																		<div class="input-box">
																			<input type="text" class="input-text"
																				id="summary_field" name="title">
																		</div>
																	</li>
																</ul>
															</div>
															<div class="review2">
																<ul>
																	<li>
																		<label class="required "
																			for="review_field">Review<em>*</em></label>
																		<div class="input-box">
																			<textarea rows="3" cols="5"
																				id="review_field"
																				name="detail"></textarea>
																		</div>
																	</li>
																</ul>
																<div class="buttons-set">
																	<button class="button submit" title="Submit Review"
																		type="submit"><span>Submit
																			Review</span></button>
																	<div class="myMsg"></div>
																</div>
															</div>
														</fieldset>
													</form>
												</div>
											</div>
											<?php } ?>
											<div class="box-reviews2">
												<?php if (count($myReview) != 0) { ?>
												<h3>Your Review</h3>
												<div class="box visible">
													<ul>
														<li>
															<div class="review">
																<h6><a href="#"><?= $myReview[0]->review_title ?></a>
																</h6>
																<div class="rating-box">
																	<div class="rating"
																		style="width:<?= $myReview[0]->review_stars*20 ?>%;">
																	</div>
																</div>
																<small>Review by
																	<span><?= $myReview[0]->reviewer_name ?> </span>on
																	<?= date('Y-m-d',strtotime($myReview[0]->created_at)) ?>
																</small>
																<div class="review-txt">
																	<?= $myReview[0]->review_desc ?></div>
															</div>
														</li>
													</ul>
												</div>
												<?php } ?>
												<h3>Customer Reviews</h3>
												<div class="box visible">
													<ul>
														<?php
															if (count($customerReview) == 0) { ?>
														<p style="color:green">Sorry! There are No Reviews to Show!</p>
														<?php }else{
															foreach ($customerReview as $r) { ?>
														<li>
															<div class="review">
																<h6><a href="#"><?= $r->review_title ?></a></h6>
																<div class="rating-box">
																	<div class="rating"
																		style="width:<?= $r->review_stars*20 ?>%;">
																	</div>
																</div>
																<small>Review by <span><?= $r->reviewer_name ?>
																	</span>on
																	<?= date('Y-m-d',strtotime($r->created_at)) ?>
																</small>
																<div class="review-txt"> <?= $r->review_desc ?></div>
															</div>
														</li>
														<?php  }}
																										?>
													</ul>
												</div>
												<!-- <div class="actions"> <a class="button view-all" id="revies-button" href="#"><span><span>View all</span></span></a> </div> -->
											</div>
											<div class="clear"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- Main container End -->

		<!-- Related Products Slider -->
		<?php if (count($related) != 0) { ?>


		<div class="container noPadding">

			<!-- Related Slider -->
			<div class="related-pro">

				<div class="slider-items-products">
					<div class="related-block">
						<div id="related-products-slider" class="product-flexslider hidden-buttons">
							<div class="home-block-inner">
								<div class="block-title">
									<h2>Related<br>
										<em> Products</em></h2>
								</div>
								<a href="<?= base_url('productlist/').@$product[0]->category_id ?>"
									class="view_more_bnt">View All</a>
							</div>
							<div class="slider-items slider-width-col4 products-grid block-content">
								<?php foreach ($related as $rp) {
									$imgs = json_decode($rp->product_img);
								?>
								<div class="item">
									<div class="item-inner">
										<div class="item-img">
											<div class="item-img-info">
												<a class="product-image" title="<?= $rp->product_title ?>"
													href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>">
													<img alt="<?= $rp->product_title ?>" class="lazy"
														src="<?= PLACEHOLDER_IMAGE ?>"
														data-src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>">
												</a>
												<?php
													if (compareDate($rp->created_at,3)) { ?>
												<div class="new-label new-top-left">new</div>
												<?php  } ?>
												<div class="box-hover">
													<ul class="add-to-links">
														<?php if (0) { ?>
														<li><a class="link-quickview" href="#">Quick View</a>
														</li>
														<?php } ?>
														<li><a class="link-wishlist"
																href="<?= base_url('wishlist') ?>">Wishlist</a>
														</li>
													</ul>
												</div>
											</div>
										</div>
										<div class="item-info">
											<div class="info-inner">
												<div class="item-title">
													<h4>
														<a title="<?= $rp->product_title ?>" href="<?= base_url('').url_title($rp->product_title,'-',TRUE).'/p'.$rp->product_id ?>"><?= $rp->product_title ?></a>
													</h4>
												</div>
												<div class="rating">
													<div class="ratings">
														<div class="rating-box">
															<div class="rating" style="width: <?= getAvgRating($rp->product_id) ?>%">
															</div>
														</div>
														<p class="rating-links"> <a href="#"><?= getRatingCount($rp->product_id) ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Review</a> </p>
													</div>
												</div>
												<div class="item-content">
													<div class="item-price">
														<div class="price-box">
															<?php
																$price = $rp->price;
																$sPrice = offeredPrice($price,$rp->product_id);
																if ($price != $sPrice) { ?>
															<p class="special-price">
																<span class="price-label">Special Price</span>
																<span class="price">₹<?= $sPrice ?></span>
															</p>
															<p class="old-price">
																<span class="price-label">Regular Price:</span>
																<span class="price">₹<?= $price ?></span>
															</p>
															<?php }else{ ?>
															<span class="regular-price">
																<span class="price">₹<?= $price ?></span>
															</span>
															<?php } ?>
														</div>
													</div>

												</div>
											</div>
										</div>
									</div>
								</div>
								<?php } ?>

							</div>
						</div>
					</div>
				</div>

			</div>
			<!-- End related products Slider -->
			<div id="timeSlotCart" class="modal fade" role='dialog'>

				<div class="modal-dialog">

					<!-- Modal content-->
					<div class="modal-content">
						<div class="delivertimebox1">
							<div class="modal-header">
								<button type="button" class="back pull-left"
									style="color: #333;font-size: 14px;background: none;display: none;"><i
										class="fa fa-arrow-left" aria-hidden="true"></i></button>
								<button type="button" class="close" data-dismiss="modal"
									style="color: black;    font-size: 30px;">×</button>
								<h4 class="modal-title1 text-center">Choose Delivery Details</h4>
							</div>
							<div class="modal-body">
								<div class="form-group">
									<div class="row">
										<div class="col-md-12">
											<form id="addCart" action="#" method="post">
												<div id="datetimepicker12" style="display: block;">
													<input type="hidden" name="ddate" id="dDate" value="">
												</div>
												<div id="shippingType" class="text-center" style="display: none;">

												</div>
												<div id="timeSlotPick" style="display: none;">

												</div>
												<div class="form-group clearfix text-center submitBut"
													style="display: none;">

												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>



		</div>
		
		<?php } ?>
		
		<?php include_once('includes/brands.php') ?>
		
		<?php include_once('includes/footer.php') ?>
	</div>
	<?php include_once('includes/mobilemenu.php') ?>
	
	<?php include_once('includes/footerlinks.php') ?>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	<script type="text/javascript">
	<?php $currentCartCityArr = currentCartCity(); ?>
	var productSpecial = '<?= @$product[0]->order_till ?>';
	var productAvailability = <?= @$product[0]->avail_at ? $product[0]->avail_at : '[]' ?>;
	var btnTxt = 0;
	jQuery(document).ready(function() {
		$('#yourAddonsModal').on('hidden.bs.modal', function(){
			location.reload();
		});
		$('#datetimepicker12').datepicker({
			inline: true,
			sideBySide: true,
			startDate: new Date('<?= date('Y-m-d', strtotime('+'.@$product[0]->order_till)) ?>')
		});
		$('.citysel').on('change', function() {
			var city = $('.citysel').val();
			$('.btn-cart').attr('disabled',true);			
			$.ajax({
				url: '<?= base_url('product/shipratepick') ?>',
				data: {
					city_id: city,
					courier: '<?= $product[0]->is_courier ?>'
				},
				type: 'post',
				success: function(a) {
					$('#shippingType').html(a);					
					$('.btn-cart').removeAttr('disabled');

				}
			})
		});
		
		$('#dDate').on('change', function() {
			$('#datetimepicker12').hide();
			$('#shippingType').show();
			$('.back').show();
		});
		$('.back').click(function() {
			$('#datetimepicker12').show();
			$('#shippingType').hide();
			$('#timeSlotPick').hide();
		});
		$('#addCart').on('submit', function(e) {
			e.preventDefault();
			var forrs = new FormData(this);
			forrs.set('product_id', '<?= $product[0]->product_id ?>');
			var city = $('.citysel').val();
			var qtty = $('#qty').val();
			var pinc = $('#pincode').val();
			var exxtra = [];
			if ($('.sizeExtra').val() != '') {
				exxtra.push($('.sizeExtra').val());
			}
			$('.extraCharge').each(function(index, value) {
				if ($(this).is(':checked')) {
					exxtra.push($(this).val());
				}
			});
			forrs.set('qty', qtty);
			forrs.set('city', city);
			forrs.set('pincode', pinc);
			<?php
				if ($product[0]->is_personalize) {
			?>
			$.each($('#imgInp')[0].files, function(i, file) {
				forrs.set('personalize_img[' + i + ']', file);
			});
			
			<?php
				} 
			?>
			if (exxtra.length) {
				forrs.set('extra', exxtra);
			}
			$.ajax({
				url: '<?= base_url('product/cart') ?>',
				contentType: false,
				processData: false,
				type: 'post',
				data: forrs,
				dataType: 'json',
				success: function(a) {
					if (a['success']) {
						if (btnTxt == 1) {
							window.location.href = '<?= base_url('mycart?addon=') ?>'+a['cart_id'];
						} else {
							$('#timeSlotCart').modal('hide');
							yourAddonsModal(a['cart_id']);
						}

					} else if (a['err1']) {
						Toast.fire({
							type: 'error',
							title: a['err1']
						});
						window.location.href = '<?= base_url('login') ?>';
					} else {
						Toast.fire({
							type: 'error',
							title: a['err']
						});
						location.reload();
					}
				}
			});
		});
		
		$('#review-form').on('submit', function(e) {
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url: '<?= base_url('review/submit') ?>',
				contentType: false,
				processData: false,
				type: 'post',
				data: formData,
				success: function(a) {
					$('.myMsg').html(a);
					$('#review-form').trigger('reset');
				}
			})
		});
		$('.priceUpdate').on('change', function() {
			updatePrice();
		});
	})

	function updatePrice() {
		var extra = [];
		if ($('.sizeExtra').val() != '') {
			extra.push($('.sizeExtra').val());
		}
		$('.extraCharge').each(function(index, value) {
			if ($(this).is(':checked')) {
				extra.push($(this).val());
			}
		});
		var qty = $('#qty').val();
		var priceData = new FormData();
		if (extra.length) {
			priceData.set('extra', extra);
		}
		priceData.set('product_id', <?= $product[0]->product_id ?>);
		priceData.set('qty', qty);
		$.ajax({
			url: '<?= base_url('getpricebox') ?>',
			data: priceData,
			type: 'post',
			processData: false,
			contentType: false,
			success: function(a) {
				$('#ppBox').html(a);
			}
		})
	}

	function scrollToReview() {
		$('.nav-tabs a[href="#reviews_tabs"]').tab('show');
	}

	function scrollToDesc() {
		$('.nav-tabs a[href="#product_tabs_description"]').tab('show');
	}

	function submitCart() {
		var shipCity = $('.citySelector input.citysel').val();
		if(pincodeVerify() == false ){
			Toast.fire({
				type: 'error',
				title: 'Please verify pincode first!'
			})
			$('.msg').html('Please verify pincode first!');
			$('.pincode').css({
				"outline": "1px solid red"
			}).focus();
			return false;
		}
		if (shipCity == '') {
			Toast.fire({
				type: 'error',
				title: 'Please verify pincode first!'
			})
			$('.msg').html('Please verify pincode first!');
			$('.pincode').css({
				"outline": "1px solid red"
			}).focus();
			return false;
		}
		
		<?php 
			if ($product[0]->is_personalize){
		?>
			var personalizeImg = $("#imgInp").val();
			if (personalizeImg == '') {
				Toast.fire({
					type: 'error',
					title: 'Please Upload Image to proceed!'
				})
				$('.msg').html('Please Upload Image to proceed!');
				return false;
			}
		<?php } ?>
		$('#timeSlotCart').modal('toggle');
	}

	function buyCart(arg) {
		btnTxt = arg;
		submitCart();
	}
	</script>
	<script type="text/javascript">
	$(document).ready(function() {
		$('#btnChange').hide();
		$('input[type=number]').on('keyup', function(e) {
			var maxLength = Number($(this).attr('maxlength'));
			var Val = $(this).val();
			if (Val.length > maxLength) {
				$(this).val(Val.substring(0, maxLength));
			} else if (isNaN(Val) || $(this).is(":invalid")) {
				$(this).val('');
			}
		});
		
		<?php
																								
			if(count($currentCartCityArr)){
				$currentCartCity = $currentCartCityArr[0];
				$currentCartPin = $currentCartCityArr[1];
				if ($currentCartPin != '' && $currentCartCity != '') {
		?>
					$('#pincode').val('<?= @$currentCartPin ?>').attr('readonly', 'true');
					pincodeVerify();
					$('.citysel').val('<?= @$currentCartCity ?>').trigger('change');
		<?php
				}
			}
		?>
	});
	function pincodechange(){
		$('#btnChange').hide();
		$('#btnVerify').show();
		$('#pincode').removeAttr('disabled');
	}
	function pincodeVerify() {
		var pincode = $('#pincode').val();
		// if(pincode.length != 6){
		// 	Toast.fire({
		// 		type: 'error',
		// 		title: 'Please enter proper Pincode!'
		// 	});
		// 	return false;
		// }
		$('#pincode').attr('disabled',true);		
		var pincode = $('#pincode').val();
		if($('.citysel').val()) {
			$('.citysel').val('').change();
		}
		// if (pincode.length != 6) {
		// 	$('.pincode').css({
		// 		"outline": "1px solid red"
		// 	});			
		// 	return false;
		// }

		var chkPin = '<?= $product[0]->pincode_block ?>';
		if(chkPin.indexOf(pincode+',') > -1){
			$('.pincode').css({
				"outline": "1px solid red"
			});
			Toast.fire({
				type: 'error',
				title: 'This Product is not available at your location!'
			});
			$('.msg').html('This Product is not available at your location!');
			$('.citysel').val('').change();			
			$('#pincode').removeAttr('disabled');
		}else{
			$.ajax({
				url: '<?= base_url('AvailablePincode') ?>',
				data: {
					pincode: pincode
				},
				type: 'post',
				dataType: 'json',
				success: function(a) {
					if (a['success']) {
						if (productAvailability.indexOf(a['success']) >= 0) {
							$('.msg').html('');
							<?php 
								if(count($currentCartCityArr)){
									$currentCartCity = $currentCartCityArr[0];
									$currentCartPin = $currentCartCityArr[1];
									if ($currentCartPin != '' && $currentCartCity != '') {
							?>
								$('.msg').html(
									'All products of a single order can be delivered to one address only. Kindly complete this order/clear your cart to choose another pincode.'
								);
								$('#btnVerify').hide();
								$('#btnChange').show();
							<?php 
								}
							} ?>
								$('.pincode').css({
									"outline": "1px solid green"
								});
								$('#btnChange').show();
								$('#btnVerify').hide();
								$('.citysel').val(a['success']).change();
							} else {
							<?php 
								if(count($currentCartCityArr)){
									$currentCartCity = $currentCartCityArr[0];
									$currentCartPin = $currentCartCityArr[1];
									if ($currentCartPin != '' && $currentCartCity != '') {
							?>
									Toast.fire({
										type: 'error',
										title: 'Product is not available in your selected pincode of delivery. All products of a single order can be delivered to one address only. Kindly complete this order/clear your cart to get your items delivered to another pincode.'
									});
									$('.msg').html(
										'Product is not available in your selected pincode of delivery. All products of a single order can be delivered to one address only. Kindly complete this order/clear your cart to get your items delivered to another pincode.'
									);									
									$('#btnChange').show();
									$('#btnVerify').hide();
							<?php }
								}
								else{
							?>
								Toast.fire({
									type: 'error',
									title: 'This Product is not available at your location!'
								});
								$('.msg').html(
									'This Product is not available at your location!');								
								$('#pincode').removeAttr('disabled');
							<?php
								}
							?>
							$('.pincode').css({
								"outline": "1px solid red"
							});
							$('.citysel').val('').change();
							$('#pincode').removeAttr('disabled');
						}
					} else {
						Toast.fire({
							type: 'error',
							title: 'This Product is not available at your location!'
						});
						$('.msg').html('This Product is not available at your location!');
						$('.pincode').css({
							"outline": "1px solid red"
						});
						$('.citysel').val('').change();
						$('#pincode').removeAttr('disabled');
					}
				}
			})
		}
	}
</script>
	<?php 
		if ($product[0]->is_personalize){
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$(document).on('change', '.btn-file :file', function() {
						var input = $(this);
						if (input[0].files.length > 1) {
							var label = input[0].files.length + ' files selected.';
						} else {
							var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
						}
						input.trigger('fileselect', [label]);
					});
					$('.btn-file :file').on('fileselect', function(event, label) {

						var input = $(this).parents('.input-group').find(':text'),
							log = label;

						if (input.length) {
							input.val(log);
						} else {
							if (log) alert(log);
						}
					});

					function readURL(input, i) {
						if (input.files && input.files[i]) {
							var ext = input.files[i].name.split('.').pop().toLowerCase();
							if (ext == 'pdf') {
								$('#img-upload').append(
									`<img src="<?= FOLDER_ASSETS_PERSONALIZE ?>pdf.png" style="margin-bottom:10px;margin-right:10px;max-width:120px;max-height:80px">`
									);
								return false;
							}
							if (ext == 'doc' || ext == 'rtf' || ext == 'docx') {
								$('#img-upload').append(
									`<img src="<?= FOLDER_ASSETS_PERSONALIZE ?>doc.png" style="margin-bottom:10px;margin-right:10px;max-width:120px;max-height:80px">`
									);
								return false;
							}
							var reader = new FileReader();
							reader.onload = function(e) {
								$('#img-upload').append(`<img src="` + e.target.result +
									`" style="margin-bottom:10px;margin-right:10px;max-width:120px;max-height:80px">`
									);
							}
							reader.readAsDataURL(input.files[i]);
						}
					}
					
					$("#imgInp").change(function() {
						$('#img-upload').html('');
						var file_array = $(this)[0].files;
						if (file_array.length > 6) {
							Toast.fire({
								type: 'error',
								title: 'You can select upto 6 files only!'
							});
							$("#file_error").html("You can select upto 6 files only!");
							$("#imgInp").val('');
							$("#imgInp").parents('.input-group').find(':text').val('');
							return false;
						}
						for (var i = 0; i < file_array.length; i++) {
							var file_size = $(this)[0].files[i].size;
							if (file_size > 2097152) {
								Toast.fire({
									type: 'error',
									title: 'File size is greater than 2M'
								});
								$("#file_error").html("File size is greater than 2MB");
								$("#imgInp").val('');
								$("#imgInp").parents('.input-group').find(':text').val('');
								return false;
							}

							(function(ele, pep) {
								readURL(ele, pep);
							})(this, i);
						}
						$("#file_error").html("");
					});
				});

			</script>
	<?php
		}
	?>
	<script src="https://cdn.jsdelivr.net/npm/lazyload@2.0.0-beta.2/lazyload.js"></script>
	<script type="text/javascript">
	jQuery(function() {
		$("img.lazy").lazyload();
	})
	</script>

</body>

</html>