						<ul class="products-grid tab-pane active in fade" id="product-grid">
							<?php
								$count = count($newProducts);
								for($i=0;$i<$count;$i++) {
								$np = $newProducts[$i];
								$image = json_decode($np->product_img);
							?>
							<li class="item col-lg-4 col-md-4 col-sm-4 col-xs-6">
								<div class="item-inner">
									<div class="item-img">
										<div class="item-img-info">
											<a class="product-image" title="<?= $np->product_title ?>" href="<?= base_url('').url_title($np->product_title,'-',TRUE).'/p'.$np->product_id ?>">
												<img alt="<?= $np->product_title ?>" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$image[0] ?>">
											</a>
											<?php
											if (compareDate($np->created_at,3)) { ?>
												<div class="new-label new-top-left">new</div>
											<?php  }
											?>
											<div class="box-hover">
												<ul class="add-to-links">
													<?php if (0) { ?>
													<li><a class="link-quickview" href="javascript:void(0)" onclick="quickView(<?= $np->product_id ?>)">Quick View</a></li>
												<?php } ?>
													<li><a class="link-wishlist" href="javascript:void(0)" onclick="addToWish(<?= $np->product_id ?>)">Wishlist</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="item-info">
										<div class="info-inner">
											<div class="item-title">
												<h4>
													<a title="<?= $np->product_title ?>" href="<?= base_url('').url_title($np->product_title,'-',TRUE).'/p'.$np->product_id ?>">
														<?= $np->product_title ?>
													</a>
												</h4>
											</div>
											<div class="item-content">
												<div class="rating">
													<div class="ratings">
														<div class="rating-box">
															<div class="rating" style="width: <?= getAvgRating($np->product_id) ?>%"></div>
														</div>
														<p class="rating-links">
															<a href="#"><?= getRatingCount($np->product_id) ?> Review(s)</a>
															<span class="separator">|</span>
															<a href="#">Add Review</a>
														</p>
													</div>
												</div>
												<div class="item-price">
													<div class="price-box">
														<?php
														$price = $np->price;
														$sPrice = newOfferedPrice($price,$np->product_id);
														if ($price > $sPrice) { ?>
															<p class="old-price">
																<span class="price-label">Regular Price:</span>
																<span class="price">₹<?= $price ?></span>
															</p>
															<p class="special-price">
																<span class="price-label">Special Price</span>
																<span class="price">₹<?= $sPrice ?></span>
															</p>
														<?php }elseif($price < $sPrice){ ?>
															<span class="regular-price">
																<span class="price">₹<?= $sPrice ?></span>
															</span>
														<?php }else{ ?>
															<span class="regular-price">
																<span class="price">₹<?= $price ?></span>
															</span>
														<?php }
														?>
													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
							</li>
							<?php
							}
							?>
						<!-- End of Products -->
						</ul>
					
						<script>
							jQuery(document).ready(function(){
								 $('#product-grid .product-image').each(function(){
										$(this).css('height',$(this).width());
									});
							})
						</script>