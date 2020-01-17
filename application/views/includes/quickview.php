<div class="product-view">
              <div class="product-essential">
                <form action="#" method="post" id="product_addtocart_form">
                  <input name="form_key" value="6UbXroakyQlbfQzK" type="hidden">
                  <div class="product-img-box col-lg-4 col-sm-5 col-xs-12">
                    <?php
                      if (compareDate($product[0]->created_at,3)) { ?>
                        <div class="new-label new-top-left"> New </div>
                    <?php  }
                    $imgs = json_decode($product[0]->product_img);
                    ?>
                    <div class="product-image">
                      <div class="product-full">
                        
                       <img id="product-zoom" src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>" data-zoom-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[0] ?>" alt="<?= $product[0]->product_title ?>"/> 
                     </div>
                      <div class="more-views">
                        <div class="slider-items-products">
                          <div id="gallery_01" class="product-flexslider hidden-buttons product-img-thumb">
                            <div class="slider-items slider-width-col4 block-content">
                              <?php
                                for ($i=0; $i < count($imgs); $i++) { ?>
                                  <div class="more-views-items"> 
                                    <a href="#" data-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>" data-zoom-image="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>"> 
                                      <img id="product-zoom"  src="<?= FOLDER_ASSETS_TEMPLATEPRODUCT.$imgs[$i] ?>"/> 
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
                    <!-- <div class="product-next-prev"> <a class="product-next" href="#"><span></span></a> <a class="product-prev" href="#"><span></span></a> </div> -->
                    <div class="product-name">
                      <h1><?= $product[0]->product_title ?></h1>
                    </div>
                    <div class="ratings">
                      <div class="rating-box">
                        <div style="width:<?= getAvgRating($product[0]->product_id) ?>%" class="rating"></div>
                      </div>
                      <p class="rating-links"> <a href="#"><?= getRatingCount($product[0]->product_id) ?> Review(s)</a> <span class="separator">|</span> <a href="#">Add Your Review</a> </p>
                    </div>
                    <div class="price-block">
                      <div class="price-box">
                        <?php
                          $price = $product[0]->price;
                          $sPrice = offeredPrice($price,$product[0]->product_id,$product[0]->child_id,$product[0]->category_id);
                          if ($price != $sPrice) { ?>
                            <p class="special-price"> <span class="price-label">Special Price</span> <span id="product-price-48" class="price"> ₹<span id="currentPrice"><?= $sPrice ?></span></span> </p>
                            <p class="old-price"> <span class="price-label">Regular Price:</span> <span class="price"> ₹<span id="oldPrice"><?= $price ?></span> </span> </p>
                        <?php  }else{ ?>
                          <p class="regular-price"> <span class="price-label">Regular Price</span> <span id="product-price-48" class="price"> ₹<span id="currentPrice"><?= $price ?></span></span> </p>
                        <?php }
                        ?>
                        <p class="availability in-stock pull-right"><span>In Stock</span></p>
                      </div>
                    </div>
                    <div class="short-description">
                      <h2>Quick Overview</h2>
                      <p><?= $product[0]->product_desc ?></p>
                    </div>
                    <div class="add-to-box">
                      <div class="citySelector col-lg-12" style="margin-bottom: 15px">
                        <div class="row">
                          <select class="">
                            <option> Select City</option>
                            <?php
                              $cities = json_decode($product[0]->avail_at);
                              for ($i=0; $i < count($cities) ; $i++) { ?>
                               <option value="<?= $cities[$i] ?>"><?= getCityName($cities[$i]) ?></option>
                           <?php  }
                            ?>
                          </select>
                        
                        <?php
                          if ($product[0]->category_id == 1) { ?>
                            <select class="">
                            <option> Select Cake Flavor</option>
                            <option> Chocolate Truffle</option>
                          </select>
                          <select class="">
                            <option> Select Cake Size</option>
                            <option> 1 KG</option>
                            <option> 2 KG</option>
                            <option> 3 KG</option>
                            <option> 4 KG</option>
                            <option> 5 KG</option>
                          </select>
                        </div>
                        </div>
                        <div class="col-lg-12" style="margin-bottom: 15px;">
                          <div class="row">
                            <div class="checkbox">
                              <label><input type="checkbox" id="eggLess">Make it Eggless</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" id="sugarFree">Make it SugarFree</label>
                            </div>
                            <div class="checkbox">
                              <label><input type="checkbox" id="HeartShape">Make it Heart Shape</label>
                            </div>
                          </div>
                        </div>
                        <?php  }else{ ?>
                            </div>
                        </div>
                            <div class="col-lg-12" style="margin-bottom: 15px;">
                              <div class="row">
                                <div class="checkbox">
                                  <label><input type="checkbox" id="doubleFlower">Double the Flowers</label>
                                </div>
                                <div class="checkbox">
                                  <label><input type="checkbox" id="addVase">Add Vase</label>
                                </div>
                              </div>
                            </div>
                        <?php  }
                        ?>
                      <div class="add-to-cart">
                        <div class="pull-left">
                          <div class="custom pull-left">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 0 ) result.value--;return false;" class="reduced items-count" type="button"><i class="fa fa-minus">&nbsp;</i></button>
                            <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="qty" style="margin: 0;">
                            <button onClick="var result = document.getElementById('qty'); var qty = result.value; if( !isNaN( qty )) result.value++;return false;" class="increase items-count" type="button"><i class="fa fa-plus">&nbsp;</i></button>
                          </div>
                        </div>
                        <button onClick="productAddToCartForm.submit(this)" class="button btn-cart" title="Add to Cart" type="button">Add to Cart</button>
                      </div>
                      <div class="email-addto-box">
                        <ul class="add-to-links">
                          <li> <a class="link-wishlist" href="<?= base_url('wishlist') ?>"><span>Add to Wishlist</span></a></li>
                          <li><span class="separator">|</span> <a class="link-compare" href="<?= base_url('compare') ?>"><span>Add to Compare</span></a></li>
                        </ul>
                        <!-- <p class="email-friend"><a href="#" class=""><span>Email to a Friend</span></a></p> -->
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <script src="<?= FOLDER_ASSETS_TEMPLATEDATA ?>js/cloud-zoom.js"></script>