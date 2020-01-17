<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/headerlinks.php') ?>
<style type="text/css">
	.wishlist:hover {
		color: #fff;
	}
	
	.btn-r,
	.btn-c {
		border: 1px #ccc solid;
		border-radius: 0;
		width: 40px;
		border-collapse: collapse;
		text-align: center;
	}
	
	.btn-c {
		margin-bottom: 2px;
		background-image: none;
		outline: 0;
		background: #E62263;
		color: #fff;
		border-color: #ffff;
	}
	
	.btn-r {
		color: #666;
		text-shadow: none;
	}
	
	@media only screen and (max-width: 479px) and (min-width: 320px) {
		#wishlist-table .description.std {
			display: none;
		}
	}
</style>

<body class="shopping-cart-page">
	<div id="page">
		<!-- Header -->
		<?php include_once('includes/header.php') ?>
		<!-- end header -->
		
		<!-- Navigation -->
		
		<?php include_once('includes/navigation.php') ?>
		<!-- end nav -->
		<div class="main-container col2-right-layout">
			<div class="main container">
				<div class="row">
					<section class="col-sm-9 noPadding">
						<div class="col-main">
							<div class="my-account">
								<div class="page-title">
									<h1>My Wishlist</h1>
								</div>
								<div class="my-wishlist">
									<div class="table-responsive">
										
										<fieldset>
											<input type="hidden" value="ROBdJO5tIbODPZHZ" name="form_key">
											<table id="wishlist-table" class="clean-table linearize-table data-table">
												<thead>
													<tr class="first last">
														<th class="customer-wishlist-item-image">Image</th>
														<th class="customer-wishlist-item-info">Description</th>
														<th class="customer-wishlist-item-price">Price</th>
														<th class="customer-wishlist-item-remove">Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (count($wishlist) != 0) {
														foreach ($wishlist as $r) {
															$img = json_decode($r->product_img);
															$title = $r->product_title;
															$id = $r->product_id;
															$prourl = base_url('').url_title($title,'-',TRUE).'/p'.$id;
															?>
															<tr id="item_<?= $id ?>" class="first odd">
																<td class="wishlist-cell0 customer-wishlist-item-image"><a
																	title="<?= $title ?>" href="<?= $prourl ?>"
																	class="product-image"> <img width="120"
																	alt="<?= $title ?>"
																	src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$img[0] ?>">
																</a></td>
																<td class="wishlist-cell1 customer-wishlist-item-info">
																	<h3 class="product-name"><a title="<?= $title ?>"
																		href="<?= $prourl ?>"><?= $title ?></a></h3>
																		<div class="description std">
																			<div class="inner">
																				<?= word_limiter($r->product_desc,100) ?></div>
																			</div>
																		</td>
																		
																		<td data-rwd-label="Price"
																		class="wishlist-cell3 customer-wishlist-item-price">
																		<div class="cart-cell">
																			<div class="price-box"> <span class="regular-price">
																				<span class="price">₹<?= $r->price ?></span>
																			</span> </div>
																		</div>
																	</td>
																	
																	<td class="wishlist-cell5 customer-wishlist-item-remove last">
																		<a class="btn btn-c" title="Add to Cart"
																		href="<?= $prourl ?>"><i
																		class="fa fa-shopping-cart"></i></a>
																		<a class="btn btn-r" title="Remove Item from Wishlist"
																		href="javascript:void(0)"
																		onclick='addToWish(<?= $id ?>)'><i
																		class="fa fa-trash"></i></a>
																	</td>
																</tr>
																<?php }
															}
															?>
															
														</tbody>
													</table>
													<div class="buttons-set buttons-set2">
														<a href="<?= base_url() ?>" class="button btn-update wishlist"
															title="Update Wishlist" name="do" type="submit"><span>Update
																Wishlist</span></a>
															</div>
														</fieldset>
													</div>
												</div>
											</div>
										</div>
									</section>
									<aside class="col-right sidebar col-sm-3 col-xs-12 noPadding">
										<div class="block block-account">
											<div class="block-title">
												<h3>My Account</h3>
											</div>
											<div class="block-content">
												<ul>
													<li><a href="<?= base_url('dashboard') ?>">Account Dashboard</a></li>
													<li><a href="<?= base_url('myprofile') ?>">My Personal Details</a></li>
													<li class="current"><a href="<?= base_url('wishlist') ?>">My Wishlist</a></li>
													<li><a href="<?= base_url('mycart') ?>">My Cart</a></li>
													<li class=""><a href="<?= base_url('walletTransaction') ?>">My Frinza Wallet</a>
													</li>
													<li class="last"><a href="<?= base_url('order') ?>">My Orders</a></li>
												</ul>
											</div>
										</div>
										<?php if (isset($_SESSION['compareProduct'])) { ?>
											<div class="block block-compare" id="compareBox">
												<?php include_once('includes/comparebox.php') ?>
											</div>
											<?php } ?>
										</aside>
									</div>
								</div>
							</div>
							
							<!-- Brand Logo -->
							<?php include_once('includes/brands.php') ?>
							<!-- Footer -->
							<?php include_once('includes/footer.php') ?>
						</div>
						<?php include_once('includes/mobilemenu.php') ?>
						
						<!-- End Footer -->
						
						<!-- JavaScript -->
						<?php include_once('includes/footerlinks.php') ?>
					</body>
					
					</html>